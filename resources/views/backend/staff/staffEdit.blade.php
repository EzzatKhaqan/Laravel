@extends('backend.layouts.master')
@section('content')


    <h1>Edit</h1>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="form-valid" action="{{route('staff.update',$staff->staff_id)}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-firstname">First Name <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-firstname" name="firstname"
                                                value="{{$staff->firstname}}">
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
                                               placeholder="Enter Last Name.." value="{{$staff->lastname}}">
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
                                               placeholder="position" value="{{$staff->position}}">

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
                                            <option value="Doctor" @if($staff->staff_type=='doctor') selected @endif>Doctor</option>
                                            <option value="Nurse"  @if($staff->staff_type=='Nurse') selected @endif>Nurse</option>
                                            <option value="Guard"  @if($staff->staff_type=='Guard') selected @endif>Guard</option>
                                            <option value="IT"     @if($staff->staff_type=='IT') selected @endif>IT</option>
                                            <option value="Other"  @if($staff->staff_type=='Other') selected @endif>Other</option>
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
                                        @if($staff->gender == 'male')
                                            <input type="radio" checked class="radio" id="val-male" name="gender" value="male">Male
                                            <input type="radio"  class="radio" id="val-female" name="gender" value="female">Female
                                        @else
                                            <input type="radio" class="radio" id="val-male" name="gender" value="male">Male
                                            <input type="radio" checked class="radio" id="val-female" name="gender" value="female">Female
                                        @endif
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
                                               placeholder="0" value="{{$staff->net_salary}}">
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
                                               placeholder="kabul, 13th,..." value="{{$staff->address}}">
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
                                               placeholder="Phone Number" value="{{$staff->phone}}">
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
                                        <input type="date" class="form-control" id="val-dob" value="{{$staff->DOB}}" name="dob">
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
                                        <img src="{{asset('images/staff/'.$staff->photo)}}" width="50" height="50" alt="Image">
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
@section('title')
    Edit
@endsection
