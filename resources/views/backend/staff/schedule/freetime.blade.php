@extends('backend.layouts.master')
@section('content')


    @if(isset($staffs) && !(Session()->has('trash')))
        @if(Session()->has("edit"))
            <h1>Edit Freetime</h1>
        @else
            <h1>Add Freetime</h1>
        @endif

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
                                <form class="form-valid"
                                      @if(Session()->has("edit"))
                                          action="{{route('freetime.update',$freetime->id)}}"
                                      @else
                                          action="{{route('freetime.store')}}
                                    @endif" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @if(Session()->has('edit'))
                                        @method('PUT')
                                    @endif
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-staff">Staff<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="staff">

                                                <option @if(Session()->has("edit")) value="{{$staff->staff_id}}" @else value="" @endif selected class="form-control" >@if(Session()->has("edit")) {{$staff->firstname}} @else Select Staff @endif</option>
                                                @foreach($staffs as $st)
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
                                        <label class="col-lg-4 col-form-label" for="val-position">Freetime Date<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="date" class="form-control" id="val-date" name="freetime_date"
                                                   placeholder="Date" @if(Session()->has("edit")) value="{{$freetime->freetime_date}}" @else value="{{old('freetime_date')}}" @endif>
                                            @error('freetime_date')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-position">Hours<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="number" class="form-control" id="val-hours"
                                                   name="freetime_hours"
                                                   placeholder="Hours" @if(Session()->has("edit")) value="{{$freetime->hours}}" @else value="{{old('freetime_hours')}}" @endif>
                                            @error('freetime_hours')
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

        @if(Session()->has("trash"))
            <h1>Trash</h1>
        @else
            <h1>Freetimes</h1>
        @endif
        <div class="row page-titles mx-0 test" id="test">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    @if(Session()->has('trash'))
                        <a class="btn icon-home text-black" href="{{route('freetime.index')}}"> Home</a>
                    @else
                        <a class="btn btn-danger icon-trash text-white" href="{{route('freetime.trash')}}"> Trash</a>
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

                        <div class="table-responsive">
                            <div class="dataTables_wrapper container-fluid dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-striped table-bordered zero-configuration">
                                            <thead>
                                            <tr>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Overtime Date</th>
                                                <th>Hours</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($result as $res)
                                                <tr>
                                                    <td>{{$res['firstname']}}</td>
                                                    <td>{{$res['lastname']}}</td>
                                                    <td>{{$res['freetime_date']}}</td>
                                                    <td>{{$res['hours']}}</td>
                                                    @if(Session()->has('trash'))
                                                        <td><a href="{{route('freetime.restore',$res['id'])}}"
                                                               class="btn btn-success icon-reload"></a></td>
                                                        <td>
                                                            <form
                                                                action="{{route('freetime.delete',$res['id'])}}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger icon-trash"></button>
                                                            </form>
                                                        </td>
                                                    @else
                                                        <td><a href="{{route('freetime.edit',$res['id'])}}"
                                                               class="btn btn-success icon-pencil"></a></td>
                                                        <td>
                                                            <form
                                                                action="{{route('freetime.destroy',$res['id'])}}"
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
                                                <th>Overtime Date</th>
                                                <th>Hours</th>
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
                Free Time
        @endsection
