@extends('layouts.app')

@section('content')
    <h1>Welcome to OsonTaklif</h1>
    <p>Your best place for job interview questions.</p>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
        @foreach ($professions as $profession)
            <a href="{{ route('profession', $profession->name) }}"
               style="border: 1px solid #ccc; padding: 20px; text-align: center; display: block; text-decoration: none; color: black;">
                <h2>{{ $profession->name }}</h2>
            </a>
        @endforeach
    </div>
@endsection
