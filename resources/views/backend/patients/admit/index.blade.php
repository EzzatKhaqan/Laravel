@extends("backend.layouts.master")
@Section('title')
    Admit
@endsection
@section('content')

    @if(empty($admits) || Session()->has("edit"))
        @if(Session()->has("edit"))
            <h1>Edit Admit</h1>
        @else
            <h1>Add New Admit</h1>
        @endif
        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="#">Home</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if(Session()->has("success"))
                                <span class="alert alert-success btn-block">{{Session()->get('success')}}</span>
                            @endif
                                @if(Session()->has("error"))
                                    <span class="alert alert-success btn-block">{{Session()->get('error')}}</span>
                                @endif
                            <div class="form-validation">

                                <form class="form-valid"
                                      @if(Session()->has("edit")) action="{{route('admit.update',$admit->admit_id)}}"
                                      @else action="{{route('admit.store')}}" @endif method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @if(Session("edit"))
                                        @method('PUT')
                                    @else
                                    @endif

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label"
                                               for="val-firstname">Patients<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="patient_id">
                                                @if(Session("edit"))
                                                    <option
                                                        value="{{$admit->patient_id}}">{{$patient->firstname}}</option>
                                                @else
                                                    <option value="" class="">Select Patient</option>
                                                @endif
                                                @foreach($patients as $pt)
                                                    <option value="{{$pt->patient_id}}">{{$pt->patient_id}}
                                                        - {{$pt->firstname}}</option>
                                                @endforeach
                                            </select>
                                            @error('patient_id')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-room">Rooms<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="room_number">
                                                @if(Session("edit"))
                                                    <option value="{{$admit->room_number}}"
                                                            class="">
                                                        {{$admit->room_number}}</option>
                                                @else
                                                    <option value="" class="">Select Room</option>
                                                @endif

                                                @foreach($rooms as $rm)
                                                    <option value="{{$rm->room_number}}"> {{$rm->room_number}}</option>
                                                @endforeach
                                            </select>
                                            @error('room_number')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    @if(Session("edit"))
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-room">Status<span
                                                    class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="form-control" name="status">
                                                        <option value="">Select Admit Status</option>
                                                        <option value="leave">Leave</option>
                                                        <option value="bed">Bed</option>
                                                </select>
                                                @error('status')
                                                <span class="danger alert-danger">{{$message}} </span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group row">
                                        <div class="col-lg-8 ml-auto">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else

        @if(Session()->has("trash"))
            <h1>Trash</h1>
        @else
            <h1>Admits</h1>
        @endif

        <div class="row page-titles mx-0 test" id="test">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    @if(Session("trash"))
                        <a class="btn icon-home text-black" href="{{route('admit.index')}}">
                            Trash</a>
                    @else
                        <a class="btn btn-danger icon-trash text-white" href="{{route('admit.trash')}}">
                            Trash</a>
                    @endif

                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if(Session()->has('success'))
                            <span class="btn-block alert alert-success" id="mess">{{Session()->get('success')}}</span>
                        @endif
                            @if(Session()->has('error'))
                                <span class="btn-block alert alert-success" id="mess">{{Session()->get('error')}}</span>
                            @endif
                        <div class="table-responsive">
                            <div class="dataTables_wrapper container-fluid dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-striped table-bordered zero-configuration">
                                            <thead>
                                            <tr>
                                                <th>Patient Name</th>
                                                <th>Room Number</th>
                                                <th>In Date</th>
                                                <th>Out Date</th>
                                                <th>Status</th>
                                                @if(Session("trash"))
                                                    <th>Restore</th>
                                                    <th>Delete</th>
                                                @else
                                                    <th>Edit</th>
                                                    <th>Delete</th
                                                @endif
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($viewBag as $b)
                                                <tr>
                                                    <td>{{$b['patient_name']}}</td>
                                                    <td>{{$b['room_number']}}</td>
                                                    <td>{{$b['in_date']}}</td>
                                                    <td>{{$b['out_date']}}</td>
                                                    <td>{{$b['status']}}</td>
                                                    @if(Session("trash"))
                                                        <td>
                                                            <a href="{{route('admit.restore',$b['admit_id'])}}"
                                                               class="btn btn-success icon-reload"></a></td>
                                                        <td>
                                                            <form
                                                                action="{{route('admit.delete',$b['admit_id'])}}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger icon-trash"></button>
                                                            </form>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <a href="{{route('admit.edit',$b['admit_id'])}}"
                                                               class="btn btn-success icon-pencil"></a></td>
                                                        <td>
                                                            <form
                                                                action="{{route('admit.destroy',$b['admit_id'])}}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger icon-trash"></button>
                                                            </form>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                            <tfoot>
                                            <tr>
                                                <th>Patient Name</th>
                                                <th>Room Number</th>
                                                <th>In Date</th>
                                                <th>Out Date</th>
                                                <th>Status</th>
                                                @if(Session("trash"))
                                                    <th>Restore</th>
                                                    <th>Delete</th>
                                                @else
                                                    <th>Edit</th>
                                                    <th>Delete</th
                                                @endif
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    @endif

@endsection
