@extends('backend.layouts.master')
@section('content')


    <h1>Edit Schedule</h1>
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
                            <form class="form-valid" action="{{route('schedule.update',$schedule->schedule_id)}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-firstname">Staff<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <select class="form-control" name="staff">
                                            <option value="{{$schedule->staff_id}}" class="form-control" selected>{{$st->firstname}}</option>
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
                                            <option value="" selected>{{$schedule->weekday}}</option>
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
                                               placeholder="position" value="{{$schedule->start_date}}">
                                        @error('start_date')
                                        <span class="danger alert-danger">{{$message}} </span>
                                        @enderror
                                        <input type="time" class="form-control" id="val-time" name="start_time"
                                               placeholder="position" value="{{$schedule->start_time}}">

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
                                               placeholder="position" value="{{$schedule->end_date}}">
                                        @error('start_date')
                                        <span class="danger alert-danger">{{$message}} </span>
                                        @enderror
                                        <input type="time" class="form-control" id="val-time" name="end_time"
                                               placeholder="position" value="{{$schedule->end_time}}">

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

@endsection

@section('title')

    Edit Schedule

@endsection
