@extends('backend.layouts.master')
@section('title')
    Laboratory
@endsection
@section('content')

    @if(empty($patientTest) || Session::has("edit"))
        @if(Session()->has("edit"))
            <h1>Edit Patient Test</h1>
        @else
            <h1>Add New Patient Test</h1>
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
                            <div class="form-validation">
                                <form class="form-valid"
                                      @if(Session()->has("edit")) action="{{route('patient-test.update',$viewBag['patient_test_id'])}}"
                                      @else action="{{route('patient-test.store')}}" @endif method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @if(Session()->has("edit"))
                                        @method('PUT')
                                    @endif
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-patient">Patients
                                            <span
                                                    class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="patient_id">
                                                <option class="form-control" @if(Session("edit")) value="{{$viewBag['patient_id']}}" @else value="" @endif>@if(Session("edit")) {{$viewBag['patient_name']}} @else Select Patient @endif</option>
                                                @foreach($patients as $pts)
                                                    <option value="{{$pts->patient_id}}">{{$pts->firstname}}
                                                        - {{$pts->lastname}}</option>
                                                @endforeach
                                            </select>
                                            @error('patient_id')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-patient">Staffs
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="staff_id">
                                                <option @if(Session("edit")) value="{{$viewBag['staff_id']}}" @else value="" @endif>@if(Session("edit")) {{$viewBag['staff_name']}} @else Select Staff @endif</option>
                                                @foreach($staffs as $stf)
                                                    <option value="{{$stf->staff_id}}">{{$stf->firstname}}
                                                        - {{$stf->lastname}}</option>
                                                @endforeach
                                            </select>
                                            @error('staff_id')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-patient">Tests
                                            <span
                                                    class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="test_id">
                                                <option @if(Session("edit")) value="{{$viewBag['test_id']}}" @else value="" @endif>@if(Session("edit")) {{$viewBag['test_name']}} @else Select Test @endif</option>
                                                @foreach($tests as $tst)
                                                    <option value="{{$tst->test_id}}">{{$tst->test_name}} </option>
                                                @endforeach
                                            </select>
                                            @error('test')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-desc">Test Date <span
                                                    class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="date" class="form-control" id="val-desc" name="test_date"
                                                   placeholder="Enter Date"
                                                   @if(Session("edit")) value="{{$viewBag['test_date']}}"
                                                   @else value="{{old('test_date')}}" @endif>
                                            @error('test_date')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-unt_price">Test Result<span
                                                    class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="val-test_result"
                                                   name="test_result"
                                                   placeholder="Test Result"
                                                   @if(Session("edit")) value="{{$viewBag['test_result']}}"
                                                   @else value="{{old('test_result')}}" @endif>
                                            @error('test_result')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-8 ml-auto">
                                            <button type="submit" class="btn btn-primary">@if(Session("edit"))
                                                    Save
                                                @else
                                                    Submit
                                                @endif</button>
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
        @if(Session("trash"))
            <h1>Trash</h1>
        @else
            <h1>Patient Test List</h1>
        @endif
        <div class="row page-titles mx-0 test" id="test">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    @if(Session("trash"))
                        <a class="btn icon-home text-black" href="{{route('patient-test.index')}}">Home</a>
                    @else
                        <a class="btn btn-danger icon-trash text-white" href="{{route('patient-test.trash')}}"> Trash</a>
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
                        <div class="table-responsive">
                            <div class="dataTables_wrapper container-fluid dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-striped table-bordered zero-configuration">
                                            <thead>
                                            <tr>
                                                <th>Patient Name</th>
                                                <th>Staff Name</th>
                                                <th>Test Name</th>
                                                <th>Test Date</th>
                                                <th>Test Result</th>
                                                @if(Session("trash"))
                                                    <th>Restore</th>
                                                    <th>Delete</th>
                                                @else
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                @endif
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($viewBag as $b)
                                                <tr>
                                                    <td>{{$b['patient_name']}}</td>
                                                    <td>{{$b['staff_name']}}</td>
                                                    <td>{{$b['test_name']}}</td>
                                                    <td>{{$b['test_date']}}</td>
                                                    <td>{{$b['test_result']}}</td>
                                                    @if(Session("trash"))
                                                        <td><a href="{{route('patient-test.restore',$b['patient_test_id'])}}"
                                                               class="btn btn-success icon-reload"></a></td>
                                                        <td>
                                                            <form action="{{route('patient-test.delete',$b['patient_test_id'])}}"
                                                                  method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger icon-trash"></button>
                                                            </form>
                                                        </td>
                                                    @else
                                                        <td><a href="{{route('patient-test.edit',$b['patient_test_id'])}}"
                                                               class="btn btn-success icon-pencil"></a></td>
                                                        <td>
                                                            <form
                                                                    action="{{route('patient-test.destroy',$b['patient_test_id'])}}"
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
                                                <th>Staff Name</th>
                                                <th>Test Name</th>
                                                <th>Test Date</th>
                                                <th>Test Result</th>
                                                @if(Session("trash"))
                                                    <th>Restore</th>
                                                    <th>Delete</th>
                                                @else
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                @endif
                                            </tr>
                                            </tfoot>
                                        </table>
                                        <div>
                                            {{$patientTest->links()}}
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

