@extends('backend.layouts.master')
@section('content')

    @if(!isset($list))
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
    @else
        <h1>Staff List</h1>

        <div class="row page-titles mx-0 test" id="test">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <a class="btn btn-danger icon-trash text-white" href="{{route('staff.trash')}}"> Trash</a>
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
                        <h4 class="card-title">Employees</h4>
                        <div class="table-responsive">
                            <div class="dataTables_wrapper container-fluid dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-striped table-bordered zero-configuration">
                                            <thead>
                                            <tr>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Photo</th>
                                                <th>Position</th>
                                                <th>Staff Type</th>
                                                <th>Gender</th>
                                                <th>Address</th>
                                                <th>Phone Number</th>
                                                <th>Date Of Birth</th>
                                                <th>Salary</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($staff as $st)
                                                <tr>
                                                    <td>{{$st->firstname}}</td>
                                                    <td>{{$st->lastname}}</td>
                                                    <td><img src="{{asset('images/staff/'.$st->photo)}}" width="50" height="50" alt="Image"/></td>
                                                    <td>{{$st->position}}</td>
                                                    <td>{{$st->staff_type}}</td>
                                                    <td>{{$st->gender}}</td>
                                                    <td>{{$st->address}}</td>
                                                    <td>{{$st->phone}}</td>
                                                    <td>{{$st->DOB}}</td>
                                                    <td>{{$st->net_salary}}</td>
                                                    <td><a href="{{route('staff.edit',$st->staff_id)}}" class="btn btn-success icon-pencil"></a></td>
                                                    <td>
                                                        <form action="{{route('staff.destroy',$st->staff_id)}}" method="POST">
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
                                                <th>Photo</th>
                                                <th>Position</th>
                                                <th>Staff Type</th>
                                                <th>Gender</th>
                                                <th>Address</th>
                                                <th>Phone Number</th>
                                                <th>Date Of Birth</th>
                                                <th>Salary</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                        <div>
                                            {{$staff->links()}}
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
        Staff List
@endsection
