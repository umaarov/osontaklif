@extends('layouts.app')

@section('content')
    <h1>{{ $profession->name }} Requirements</h1>
    <p>Here are the requirements for the {{ $profession->name }} position.</p>
@endsection
