@extends('backend.layouts.master')
@section('content')


    <h1>Trash</h1>
    <div class="row page-titles mx-0 test" id="test">
        <div class="col p-md-0">
            <ol class="breadcrumb">

            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Trash</h4>
                    <div class="table-responsive">
                        <div class="dataTables_wrapper container-fluid dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Gender</th>
                                            <th>Address</th>
                                            <th>Phone Number</th>
                                            <th>Date Of Birth</th>
                                            <th>Restore</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($patients as $pt)
                                            <tr>
                                                <td>{{$pt->firstname}}</td>
                                                <td>{{$pt->lastname}}</td>
                                                <td>{{$pt->gender}}</td>
                                                <td>{{$pt->address}}</td>
                                                <td>{{$pt->phone}}</td>
                                                <td>{{$pt->DOB}}</td>
                                                <td><a href="{{route('patient.restore',$pt->patient_id)}}"
                                                       class="btn btn-success icon-reload"></a></td>
                                                <td>
                                                    <form action="{{route('patient.delete',$pt->patient_id)}}"
                                                          method="GET">
                                                        @csrf
                                                        <button class="btn btn-danger icon-trash"></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tfoot>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Gender</th>
                                            <th>Address</th>
                                            <th>Phone Number</th>
                                            <th>Date Of Birth</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                    <div>
                                        {{$patients->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
@section('title')
    Trash
@endsection
