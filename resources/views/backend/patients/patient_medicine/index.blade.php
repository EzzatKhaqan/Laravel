@extends("backend.layouts.master")
@Section('title')
    Patient Medicine
@endsection
@section('content')

    @if(empty($patientList))
        <h1>Add New Patient Medicine</h1>
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
                                <span class="alert alert-success">{{Session()->get('success')}}</span>
                            @endif
                            <div class="form-validation">
                                <form class="form-valid" action="{{route('patient-medicine.store')}}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-firstname">Patients<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="patient_id">
                                                <option value="" class="">Select Patient</option>
                                                @foreach($patients as $pt)
                                                    <option value="{{$pt->patient_id}}">{{$pt->patient_id}} - {{$pt->firstname}}</option>
                                                @endforeach
                                            </select>
                                            @error('patient_id')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-firstname">Medicines<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="medicine_id">
                                                <option value="" class="">Select Medicine</option>
                                                @foreach($medicines as $md)
                                                    <option value="{{$md->medicine_id}}">{{$md->medicine_id}} - {{$md->medicine_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('medicine_id')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-unt_price">Unit Price<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="number" class="form-control" id="val-unt_price"
                                                   name="unt_price"
                                                   placeholder="Unit Price"
                                                   @if(Session("edit")) value="{{$medicine->unt_price}}"
                                                   @else value="{{old('unt_price')}}" @endif>
                                            @error('unt_price')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-qnt">Quantity<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="number" placeholder="Enter Quantity" class="form-control"
                                                   id="val-qnt" name="qnt"
                                                   @if(Session("edit")) value="{{$medicine->qnt}}"
                                                   @else value="{{old('qnt')}}" @endif>
                                            @error('qnt')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-total_price">Total Price<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="number" contentEditable="false" class="form-control" id="val-total_price"
                                                   name="total_price"
                                                   placeholder="Total Price"
                                                   @if(Session("edit")) value="{{$medicine->total_price}}"
                                                   @else value="Calc" @endif>
                                            @error('total_price')
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

        <h1>Patient List</h1>

        <div class="row page-titles mx-0 test" id="test">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <a class="btn btn-danger icon-trash text-white" href="{{route('patient.trash')}}"> Trash</a>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if(Session()->has('updated'))
                            <span class="btn-block alert alert-success" id="mess">{{Session()->get('updated')}}</span>
                        @endif
                        <h4 class="card-title">Patients</h4>
                        <div class="table-responsive">
                            <div class="dataTables_wrapper container-fluid dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-striped table-bordered zero-configuration">
                                            <thead>
                                            <tr>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Gender</th>
                                                <th>Address</th>
                                                <th>Phone Number</th>
                                                <th>Date Of Birth</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($patients as $pt)
                                                <tr>
                                                    <td>{{$pt->firstname}}</td>
                                                    <td>{{$pt->lastname}}</td>
                                                    <td>{{$pt->gender}}</td>
                                                    <td>{{$pt->address}}</td>
                                                    <td>{{$pt->phone}}</td>
                                                    <td>{{$pt->DOB}}</td>
                                                    <td><a href="{{route('patient.edit',$pt->patient_id)}}"
                                                           class="btn btn-success icon-pencil"></a></td>
                                                    <td>
                                                        <form action="{{route('patient.destroy',$pt->patient_id)}}"
                                                              method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger icon-trash"></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tfoot>
                                            <tr>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Gender</th>
                                                <th>Address</th>
                                                <th>Phone Number</th>
                                                <th>Date Of Birth</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                        <div>
                                            {{$patients->links()}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    @endif

@endsection
