@extends('backend.layouts.master')
@section('title')
    Laboratory
@endsection
@section('content')

    @if(empty($tests) || Session::has("edit"))
        @if(Session()->has("edit"))
            <h1>Edit Test</h1>
        @else
            <h1>Add New Test</h1>
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
                                      @if(Session()->has("edit")) action="{{route('test.update',$test->test_id)}}"
                                      @else action="{{route('test.store')}}" @endif method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @if(Session()->has("edit"))
                                        @method('PUT')
                                    @endif
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-medicine_name">Test Name
                                            <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="val-firstname"
                                                   name="test_name"
                                                   placeholder="Enter Test Name.."
                                                   @if(Session("edit")) value="{{$test->test_name}}"
                                                   @else value="{{old('test_name')}}" @endif>
                                            @error('test_name')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-desc">Description <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="val-desc" name="desc"
                                                   placeholder="Enter Description.."
                                                   @if(Session("edit")) value="{{$test->desc}}"
                                                   @else value="{{old('desc')}}" @endif>
                                            @error('desc')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-unt_price">Test Price<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="number" class="form-control" id="val-test_price"
                                                   name="test_price"
                                                   placeholder="Test Price"
                                                   @if(Session("edit")) value="{{$test->test_price}}"
                                                   @else value="{{old('test_price')}}" @endif>
                                            @error('test_price')
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
            <h1>Test List</h1>
        @endif
        <div class="row page-titles mx-0 test" id="test">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    @if(Session("trash"))
                        <a class="btn icon-home text-black" href="{{route('test.index')}}">Home</a>
                    @else
                        <a class="btn btn-danger icon-trash text-white" href="{{route('test.trash')}}"> Trash</a>
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
                                                <th>Test Name</th>
                                                <th>Description</th>
                                                <th>Test Price</th>
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
                                            @foreach($tests as $tst)
                                                <tr>
                                                    <td>{{$tst->test_name}}</td>
                                                    <td>{{$tst->desc}}</td>
                                                    <td>{{$tst->test_price}}</td>
                                                    @if(Session("trash"))
                                                        <td><a href="{{route('test.restore',$tst->test_id)}}"
                                                               class="btn btn-success icon-reload"></a></td>
                                                        <td>
                                                            <form action="{{route('test.delete',$tst->test_id)}}"
                                                                  method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger icon-trash"></button>
                                                            </form>
                                                        </td>
                                                    @else
                                                        <td><a href="{{route('test.edit',$tst->test_id)}}"
                                                               class="btn btn-success icon-pencil"></a></td>
                                                        <td>
                                                            <form
                                                                action="{{route('test.destroy',$tst->test_id)}}"
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
                                                <th>Test Name</th>
                                                <th>Description</th>
                                                <th>Test Price</th>
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
                                            {{$tests->links()}}
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

