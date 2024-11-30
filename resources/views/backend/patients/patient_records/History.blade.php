@extends('backend.layouts.master')
@section('content')


    <h1>Patient History</h1>
    {{dd($patient,$patientRecord->all(),$staff)}}
    <h1>More Detail</h1>
    <h1>News</h1>


@endsection

@section('title')
    Patient History
@endsection
