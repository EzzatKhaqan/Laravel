@extends('backend.layouts.master')
@section('content')


    <h1>Edit Patient</h1>

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
                        <div class="form-validation">
                            <form class="form-valid" action="{{route('patient.update',$patient->patient_id)}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-firstname">First Name <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-firstname" name="firstname"
                                               placeholder="Enter firstname.." value="{{$patient->firstname}}">
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
                                               placeholder="Enter Last Name.." value="{{$patient->lastname}}">
                                        @error('lastname')
                                        <span class="danger alert-danger">{{$message}} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Gender<span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="radio" @if($patient->gender == 'male') checked @endif class="radio" id="val-male" name="gender" value="male">Male
                                        <input type="radio" @if($patient->gender == 'female') checked @endif class="radio" id="val-female" name="gender"
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
                                        <input type="date" class="form-control" id="val-dob" name="dob" value="{{$patient->DOB}}">
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

@endsection
@section('title')
    Edit

@endsection
