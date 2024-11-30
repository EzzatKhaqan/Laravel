@extends("backend.layouts.master")
@Section('title')
    Patient Medicine
@endsection
@section('content')

    @if(empty($pml) || Session()->has("edit"))
        @if(Session()->has("edit"))
            <h1>Edit Patient Medicine</h1>
        @else
            <h1>Add New Patient Medicine</h1>
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
                                      @if(Session()->has("edit")) action="{{route('patient-medicine.update',$patientMedicine->patient_medicine_id)}}"
                                      @else action="{{route('patient-medicine.store')}}" @endif method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @if(Session("edit"))
                                        @method('PUT')
                                    @else
                                    @endif

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label"
                                               for="val-firstname">Patients<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="patient_id">
                                                @if(Session("edit"))
                                                    <option
                                                        value="{{$patientMedicine->patient_id}}">{{$patient["patient_name"]}}</option>
                                                @else
                                                    <option value="" class="">Select Patient</option>
                                                @endif
                                                @foreach($patients as $pt)
                                                    <option value="{{$pt->patient_id}}">{{$pt->patient_id}}
                                                        - {{$pt->firstname}}</option>
                                                @endforeach
                                            </select>
                                            @error('patient_id')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-firstname">Medicines<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="medicine_id">
                                                @if(Session("edit"))
                                                    <option value="{{$patientMedicine->medicine_id}}"
                                                            class="">
                                                        {{$patient["medicine_name"]}}</option>
                                                @else
                                                    <option value="" class="">Select Medicine</option>
                                                @endif

                                                @foreach($medicines as $md)
                                                    <option
                                                        value="{{$md->medicine_id}}">{{$md->medicine_id}}
                                                        - {{$md->medicine_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('medicine_id')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-unt_price">Unit
                                            Price<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="number" class="form-control" id="val-unt_price"
                                                   name="unt_price"
                                                   placeholder="Unit Price"
                                                   @if(Session("edit")) value="{{$patientMedicine->unt_price}}"
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
                                            <input type="number" placeholder="Enter Quantity"
                                                   class="form-control"
                                                   id="val-qnt" name="qnt"
                                                   @if(Session("edit")) value="{{$patientMedicine->qnt}}"
                                                   @else value="{{old('qnt')}}" @endif>
                                            @error('qnt')
                                            <span class="danger alert-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-total_price">Total
                                            Price<span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="number" contentEditable="false"
                                                   class="form-control"
                                                   id="val-total_price"
                                                   name="total_price"
                                                   placeholder="Total Price"
                                                   @if(Session("edit")) value="{{$patientMedicine->total_price}}"
                                                   @else value="Calc" @endif>
                                            @error('total_price')
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
    @else

        @if(Session()->has("trash"))
            <h1>Trash</h1>
        @else
            <h1>Patient Medicine List</h1>
        @endif

        <div class="row page-titles mx-0 test" id="test">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    @if(Session("trash"))
                        <a class="btn icon-home text-black" href="{{route('patient-medicine.index')}}">
                            Trash</a>
                    @else
                        <a class="btn btn-danger icon-trash text-white" href="{{route('patient-medicine.trash')}}">
                            Trash</a>
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
                                                <th>Medicine Name</th>
                                                <th>Quantity</th>
                                                <th>Unit Price</th>
                                                <th>Total Price</th>
                                                <th>Apply Date</th>
                                                @if(Session("trash"))
                                                    <th>Restore</th>
                                                    <th>Delete</th>
                                                @else
                                                    <th>Edit</th>
                                                    <th>Delete</th
                                                @endif
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($result as $res)
                                                <tr>
                                                    <td>{{$res['patient_name']}}</td>
                                                    <td>{{$res['medicine_name']}}</td>
                                                    <td>{{$res['qnt']}}</td>
                                                    <td>{{$res['unt_price']}}</td>
                                                    <td>{{$res['total_price']}}</td>
                                                    <td>{{$res['apply_date']}}</td>
                                                    @if(Session("trash"))
                                                        <td>
                                                            <a href="{{route('patient-medicine.restore',$res['patient_medicine_id'])}}"
                                                               class="btn btn-success icon-reload"></a></td>
                                                        <td>
                                                            <form
                                                                action="{{route('patient-medicine.delete',$res['patient_medicine_id'])}}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger icon-trash"></button>
                                                            </form>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <a href="{{route('patient-medicine.edit',$res['patient_medicine_id'])}}"
                                                               class="btn btn-success icon-pencil"></a></td>
                                                        <td>
                                                            <form
                                                                action="{{route('patient-medicine.destroy',$res['patient_medicine_id'])}}"
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
                                                <th>Medicine Name</th>
                                                <th>Quantity</th>
                                                <th>Unit Price</th>
                                                <th>Total Price</th>
                                                <th>Apply Date</th>
                                                @if(Session("trash"))
                                                    <th>Restore</th>
                                                    <th>Delete</th>
                                                @else
                                                    <th>Edit</th>
                                                    <th>Delete</th
                                                @endif
                                            </tr>
                                            </tfoot>
                                        </table>
                                        <div>
                                            {{$pml->links()}}
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
