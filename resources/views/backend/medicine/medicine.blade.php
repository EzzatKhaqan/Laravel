@extends('backend.layouts.master')
@section('title')
    Medicine
@endsection
@section('content')

    @if(empty($medicines) || Session::has("edit"))
        @if(Session()->has("edit"))
            <h1>Edit Medicine</h1>
        @else
            <h1>Add New Drug</h1>
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
                                      @if(Session()->has("edit")) action="{{route('medicine.update',$medicine->medicine_id)}}"
                                      @else action="{{route('medicine.store')}}" @endif method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @if(Session()->has("edit"))
                                        @method('PUT')
                                    @endif
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-medicine_name">Medicine Name
                                            <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="val-firstname"
                                                   name="medicine_name"
                                                   placeholder="Enter Medicine Name.."
                                                   @if(Session("edit")) value="{{$medicine->medicine_name}}"
                                                   @else value="{{old('medicine_name')}}" @endif>
                                            @error('medicine_name')
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
                                                   @if(Session("edit")) value="{{$medicine->desc}}"
                                                   @else value="{{old('desc')}}" @endif>
                                            @error('desc')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-exp_date">Expire Date<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="date" class="form-control" id="val-exp_date" name="exp_date"
                                                   placeholder="" @if(Session("edit")) value="{{$medicine->exp_date}}"
                                                   @else value="{{old('exp_date')}}" @endif>
                                            @error('exp_date')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-unt_price">Unit Price<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="number" class="form-control" id="val-unt_price"
                                                   name="unt_price"
                                                   placeholder="Unit Price"
                                                   @if(Session("edit")) value="{{$medicine->unt_price}}"
                                                   @else value="{{old('unt_price')}}" @endif>
                                            @error('unt_price')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-qnt">Quantity<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="number" placeholder="Enter Quantity" class="form-control"
                                                   id="val-qnt" name="qnt"
                                                   @if(Session("edit")) value="{{$medicine->qnt}}"
                                                   @else value="{{old('qnt')}}" @endif>
                                            @error('qnt')
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
            <h1>Medicine List</h1>
        @endif
        <div class="row page-titles mx-0 test" id="test">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    @if(Session("trash"))
                        <a class="btn icon-home text-black" href="{{route('medicine.index')}}">Home</a>
                    @else
                        <a class="btn btn-danger icon-trash text-white" href="{{route('medicine.trash')}}"> Trash</a>
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
                        <div class="table-responsive">
                            <div class="dataTables_wrapper container-fluid dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-striped table-bordered zero-configuration">
                                            <thead>
                                            <tr>
                                                <th>Medicine Name</th>
                                                <th>Description</th>
                                                <th>Expire Date</th>
                                                <th>Unit Price</th>
                                                <th>Quantity</th>
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
                                            @foreach($medicines as $md)
                                                <tr>
                                                    <td>{{$md->medicine_name}}</td>
                                                    <td>{{$md->desc}}</td>
                                                    <td>{{$md->exp_date}}</td>
                                                    <td>{{$md->unt_price}}</td>
                                                    <td>{{$md->qnt}}</td>
                                                    @if(Session("trash"))
                                                        <td><a href="{{route('medicine.restore',$md->medicine_id)}}"
                                                               class="btn btn-success icon-reload"></a></td>
                                                        <td>
                                                            <form action="{{route('medicine.delete',$md->medicine_id)}}"
                                                                  method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger icon-trash"></button>
                                                            </form>
                                                        </td>
                                                    @else
                                                        <td><a href="{{route('medicine.edit',$md->medicine_id)}}"
                                                               class="btn btn-success icon-pencil"></a></td>
                                                        <td>
                                                            <form
                                                                action="{{route('medicine.destroy',$md->medicine_id)}}"
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
                                                <th>Medicine Name</th>
                                                <th>Description</th>
                                                <th>Expire Date</th>
                                                <th>Unit Price</th>
                                                <th>Quantity</th>
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
                                            {{$medicines->links()}}
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

