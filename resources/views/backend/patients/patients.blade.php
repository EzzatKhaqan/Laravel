@extends('backend.layouts.master')
@section('content')

    @if(empty($patientList))
        <h1>Add New Patients</h1>
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
                                <form class="form-valid" action="{{route('patient.store')}}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-firstname">First Name <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="val-firstname" name="firstname"
                                                   placeholder="Enter firstname.." value="{{old('firstname')}}">
                                            @error('firstname')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-lasname">Last Name <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="val-lastname" name="lastname"
                                                   placeholder="Enter Last Name.." value="{{old('lastname')}}">
                                            @error('lastname')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Gender<span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="radio" class="radio" id="val-male" name="gender" value="male">Male
                                            <input type="radio" class="radio" id="val-female" name="gender"
                                                   value="female">Female
                                            @error('gender')<br>
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-address">Address<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="val-address" name="address"
                                                   placeholder="kabul, 13th,..." value="{{old('address')}}">
                                            @error('address')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-phone">Phone<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="val-phone" name="phone"
                                                   placeholder="Phone Number" value="{{old('phone')}}">
                                            @error('phone')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-dob">Date of Birth<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="date" class="form-control" id="val-dob" name="dob">
                                            @error('dob')
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

            @section('title')
                Patients
        @endsection
