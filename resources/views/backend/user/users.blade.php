@extends('backend.layouts.master')
@section('content')

    <h1>Add New Staff</h1>
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
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
                            @if(Session()->has('success'))
                                <span class="alert alert-success btn-block">
                                     {{Session()->get('success')}}
                                    </span>
                            @endif
                            <form class="form-valid" action="{{route('staff.store')}}" method="POST"
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
                                    <label class="col-lg-4 col-form-label" for="val-position">Position <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-position" name="position"
                                               placeholder="position" value="{{old('position')}}">

                                        @error('position')
                                        <span class="danger alert-danger">{{$message}} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-position">Staff Type<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <select class="select-box form-control" name="select">
                                            <option value="Doctor">Doctor</option>
                                            <option value="Nurse">Nurse</option>
                                            <option value="Guard">Guard</option>
                                            <option value="IT">IT</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        @error('position')
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
                                    <label class="col-lg-4 col-form-label" for="val-salary">Net Salary <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-salary" name="salary"
                                               placeholder="0" value="{{old('salary')}}">
                                        @error('salary')
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
                                    <label class="col-lg-4 col-form-label" id="image">Image<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="file" class="form-control" id="image" name="image">
                                        @error('image')
                                        <p class="danger alert-danger">{{$message}}</p>
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
