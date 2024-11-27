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
                                            <th>Photo</th>
                                            <th>Position</th>
                                            <th>Staff Type</th>
                                            <th>Gender</th>
                                            <th>Address</th>
                                            <th>Phone Number</th>
                                            <th>Date Of Birth</th>
                                            <th>Salary</th>
                                            <th>Restore</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($staff as $st)
                                            <tr>
                                                <td>{{$st->firstname}}</td>
                                                <td>{{$st->lastname}}</td>
                                                <td><img src="{{asset('images/staff/'.$st->photo)}}" width="50"
                                                         height="50" alt="Image"/></td>
                                                <td>{{$st->position}}</td>
                                                <td>{{$st->staff_type}}</td>
                                                <td>{{$st->gender}}</td>
                                                <td>{{$st->address}}</td>
                                                <td>{{$st->phone}}</td>
                                                <td>{{$st->DOB}}</td>
                                                <td>{{$st->net_salary}}</td>
                                                <td><a href="{{route('staff.restore',$st->staff_id)}}"
                                                       class="btn btn-success icon-reload"></a></td>
                                                <td>
                                                    <form action="{{route('staff.delete',$st->staff_id)}}"
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

@endsection
@section('title')
    Trash
@endsection
