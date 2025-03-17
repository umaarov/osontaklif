@extends('layouts.app')

@section('content')
    <a href="{{ route('profession', $question->profession->name) }}">Back to {{ $question->profession->name }} Questions</a>
    <h1>{{ $question->question }}</h1>
    <p><strong>Chance of Asking:</strong> {{ $question->chance }}%</p>
    <p><strong>Content:</strong></p>
    <p>{{ $question->content }}</p>

@endsection
