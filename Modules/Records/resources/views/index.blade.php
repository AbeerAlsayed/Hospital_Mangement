@extends('records::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('records.name') !!}</p>
@endsection
