@extends("backend.layouts.master")
@section('content')



    <h1>Edit Patient History</h1>
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
                            <form class="form-valid" action="{{route('patient-record.store')}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-firstname">Patient Name<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <select class="form-control" name="patient_id">
                                            <option value="" selected>{{$patientRecord->firstname}}</option>
                                            @foreach($patients as $pt)
                                                <option value="{{$pt->patient_id}}">{{$pt->patient_id}} - {{$pt->firstname}} {{$pt->lastname}}</option>
                                            @endforeach
                                        </select>
                                        @error('patient_id')
                                        <span class="alert-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-firstname">Staff Name<span
                                            class="text-danger">*</span>
                                    </label>
                                    <span class="col-lg-6">
                                            <select class="form-control" name="staff_id">
                                                <option value="" selected>Select Staff</option>
                                                @foreach($staff as $st)
                                                    <option value="{{$st->staff_id}}">{{$st->staff_id}}
                                                        -{{$st->firstname}} {{$st->lastname}}</option>
                                                @endforeach
                                            </select>
                                            @error('staff_id')
                                            <span class=" alert-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-sickness">Sickness<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-sickness" name="sickness"
                                               placeholder="Sickness" value="{{old('sickness')}}">
                                        @error('sickness')
                                        <span class="danger alert-danger">{{$message}} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-result">Result<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-result" name="result"
                                               placeholder="Result" value="{{old('result')}}">
                                        @error('result')
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



@endsection
