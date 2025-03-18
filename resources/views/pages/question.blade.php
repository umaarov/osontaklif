@extends('layouts.app')

@section('content')
    <h1>{{ $question->question }}</h1>
    <p><strong>Chance of Asking:</strong> {{ $question->chance }}%</p>
    <p><strong>Content:</strong></p>
    <p>{{ $question->content }}</p>

@endsection
