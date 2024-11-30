@extends('backend.layouts.master')
@section('content')

    @if(Session()->has('add'))
        <h1>Add New Schedule</h1>
        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                </ol>
            </div>
        </div>
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
                                <form class="form-valid" action="{{route('schedule.store')}}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-firstname">Staff<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="staff">
                                                <option value="" class="form-control" selected>Select Staff</option>
                                                @foreach($staff as $st)
                                                    <option value="{{$st->staff_id}}"
                                                            class="form-control">{{$st->firstname}}</option>
                                                @endforeach
                                            </select>
                                            @error('staff')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-weekday">Weekday<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="weekday">
                                                <option value="" selected>Select Weekday</option>
                                                <option value="0" class="form-control">Saturday</option>
                                                <option value="1" class="form-control">Sunday</option>
                                                <option value="2" class="form-control">Monday</option>
                                                <option value="3" class="form-control">Tuesday</option>
                                                <option value="4" class="form-control">Wednesday</option>
                                                <option value="5" class="form-control">Thursday</option>
                                                <option value="6" class="form-control">Friday</option>
                                            </select>
                                            @error('weekday')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-position">From <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="date" class="form-control" id="val-date" name="start_date"
                                                   placeholder="position" value="{{old('position')}}">
                                            @error('start_date')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                            <input type="time" class="form-control" id="val-time" name="start_time"
                                                   placeholder="position" value="{{old('position')}}">

                                            @error('start_time')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-position">To<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="date" class="form-control" id="val-date" name="end_date"
                                                   placeholder="position" value="{{old('position')}}">
                                            @error('start_date')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                            <input type="time" class="form-control" id="val-time" name="end_time"
                                                   placeholder="position" value="{{old('position')}}">

                                            @error('start_time')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-8 ml-auto">
                                            <button type="submit" class="btn btn-primary">Add</button>
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
            <h1>Schedules</h1>
        @endif

        <div class="row page-titles mx-0 test" id="test">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    @if(Session()->has('trash'))
                        <a class="btn icon-home text-black" href="{{route('schedule.index')}}"> Home</a>
                    @else
                        <a class="btn btn-danger icon-trash text-white" href="{{route('schedule.trash')}}"> Trash</a>
                    @endif
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
                        @if(Session()->has('action'))
                            <span class="btn-block alert alert-success" id="mess">{{Session()->get('action')}}</span>
                        @endif


                        <h4 class="card-title">Schedule</h4>
                        <div class="table-responsive">
                            <div class="dataTables_wrapper container-fluid dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-striped table-bordered zero-configuration">
                                            <thead>
                                            <tr>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Weekday</th>
                                                <th>From</th>
                                                <th>To</th>
                                                <th>Phone Number</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($result as $res)
                                                <tr>
                                                    <td>{{$res['firstname']}}</td>
                                                    <td>{{$res['lastname']}}</td>
                                                    <td>{{$res['weekday']}}</td>
                                                    <td>{{$res['start_time']}} / {{$res['start_date']}}</td>
                                                    <td>{{$res['end_time']}} / {{$res['end_date']}}</td>
                                                    <td>{{$res['phone']}}</td>
                                                    @if(Session()->has('trash'))
                                                        <td><a href="{{route('schedule.restore',$res['schedule_id'])}}"
                                                               class="btn btn-success icon-reload"></a></td>
                                                        <td>
                                                            <form
                                                                action="{{route('schedule.delete',$res['schedule_id'])}}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger icon-trash"></button>
                                                            </form>
                                                        </td>
                                                    @else
                                                        <td><a href="{{route('schedule.edit',$res['schedule_id'])}}"
                                                               class="btn btn-success icon-pencil"></a></td>
                                                        <td>
                                                            <form
                                                                action="{{route('schedule.destroy',$res['schedule_id'])}}"
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
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>From</th>
                                                <th>To</th>
                                                <th>Phone Number</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                        <div>
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
        Schedule
@endsection
