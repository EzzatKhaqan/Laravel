@extends('backend.layouts.master')
@section('content')

    @if(!isset($patientRecords))
        <h1>Add New Patient History</h1>
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
                            <div class="form-validation">
                                <form class="form-valid" action="{{route('patient-record.store')}}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-firstname">Patient Name<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="patient_id">
                                                <option value="" selected>Select Patient</option>
                                                @foreach($patients as $pt)
                                                    <option value="{{$pt->patient_id}}">{{$pt->patient_id}} - {{$pt->firstname}} {{$pt->lastname}}</option>
                                                @endforeach
                                            </select>
                                            @error('patient_id')
                                            <span class="alert-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-firstname">Staff Name<span
                                                class="text-danger">*</span>
                                        </label>
                                        <span class="col-lg-6">
                                            <select class="form-control" name="staff_id">
                                                <option value="" selected>Select Staff</option>
                                                @foreach($staff as $st)
                                                    <option value="{{$st->staff_id}}">{{$st->staff_id}}
                                                        -{{$st->firstname}} {{$st->lastname}}</option>
                                                @endforeach
                                            </select>
                                            @error('staff_id')
                                            <span class=" alert-danger">{{$message}}</span>
                                            @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-sickness">Sickness<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="val-sickness" name="sickness"
                                                   placeholder="Sickness" value="{{old('sickness')}}">
                                            @error('sickness')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-result">Result<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="val-result" name="result"
                                                   placeholder="Result" value="{{old('result')}}">
                                            @error('result')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>

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

        @if(Session()->has('trash'))
            <h1>Trash</h1>
        @else
            <h1>Patient History List</h1>
        @endif

        <div class="row page-titles mx-0 test" id="test">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    @if(Session('trash'))
                        <a class="btn icon-home text-black" href="{{route('patient-record.index')}}"> Home</a>

                    @else
                        <a class="btn btn-danger icon-trash text-white" href="{{route('patient.record.trash')}}"> Trash</a>
                    @endif
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if(Session()->has("action"))
                            <span class="btn-block alert alert-success" id="mess">{{Session()->get('action')}}</span>
                        @endif
                        @if(Session()->has('success'))
                            <span class="btn-block alert alert-success" id="mess">{{Session()->get('success')}}</span>
                        @endif
                            @if(Session()->has('trash'))
                                <h4 class="card-title">Trash</h4>
                            @else
                                <h4 class="card-title">Patient History</h4>
                            @endif

                        <div class="table-responsive">
                            <div class="dataTables_wrapper container-fluid dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-striped table-bordered zero-configuration">
                                            <thead>
                                            <tr>
                                                @if(Session()->has('trash'))
                                                    <th>Patient name</th>
                                                    <th>Staff Name</th>
                                                    <th>Result</th>
                                                    <th>Sickness</th>
                                                    <th>Time In</th>
                                                    <th>Time Out</th>
                                                    <th>Restore</th>
                                                    <th>Delete</th>
                                                @else
                                                    <th>Patient name</th>
                                                    <th>Staff Name</th>
                                                    <th>Result</th>
                                                    <th>Sickness</th>
                                                    <th>Time In</th>
                                                    <th>Time Out</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                    <th>More</th>
                                                @endif
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($result as $res)
                                                <tr>
                                                    <td>{{$res["patient_name"]}}</td>
                                                    <td>{{$res["staff_name"]}}</td>
                                                    <td>{{$res["result"]}}</td>
                                                    <td>{{$res['sickness']}}</td>
                                                    <td>{{$res['time_in']}}</td>
                                                    <td>{{$res['time_out']}}</td>

                                                    @if(Session()->has('trash'))
                                                        <td><a href="{{route('patient.record.restore',$res['patient_record_id'])}}"
                                                               class="btn btn-success icon-reload"></a></td>
                                                        <td>
                                                            <form action="{{route('patient.record.delete',$res['patient_record_id'])}}"
                                                                  method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger icon-trash"></button>
                                                            </form>
                                                        </td>
                                                    @else
                                                        <td><a href="{{route('patient-record.edit',$res['patient_record_id'])}}"
                                                               class="btn btn-success icon-pencil"></a></td>
                                                        <td>
                                                            <form action="{{route('patient-record.destroy',$res['patient_record_id'])}}"
                                                                  method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger icon-trash"></button>
                                                            </form>
                                                        </td>
                                                        <td><a class="btn btn-info" href="{{route('patient-record.show',$res["patient_record_id"])}}">More</a></td>
                                                    @endif

                                                </tr>
                                            @endforeach
                                            <tfoot>
                                            @if(Session()->has("trash"))
                                                <tr>
                                                    <th>Patient name</th>
                                                    <th>Staff Name</th>
                                                    <th>Result</th>
                                                    <th>Sickness</th>
                                                    <th>Time In</th>
                                                    <th>Time Out</th>
                                                    <th>Restore</th>
                                                    <th>Delete</th>
                                                </tr>
                                            @else
                                                <tr>
                                                    <th>Patient name</th>
                                                    <th>Staff Name</th>
                                                    <th>Result</th>
                                                    <th>Sickness</th>
                                                    <th>Time In</th>
                                                    <th>Time Out</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            @endif

                                            </tfoot>
                                        </table>

                                        <div>{{$patientRecords->links()}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endif

@endsection
@section('title')
                Patient Record
@endsection
