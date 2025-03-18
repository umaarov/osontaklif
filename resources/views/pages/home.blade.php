@extends('layouts.app')

@section('content')
    <h3>Требования на должность</h3>

    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-top: 25px">
        @foreach ($professions as $profession)
            <a href="{{ route('profession', $profession->name) }}"
               style="border: 1px solid #ccc; padding: 15px; text-align: center; display: block; text-decoration: none; color: black;">
                <h4>{{ $profession->name }}</h4>
            </a>
        @endforeach
    </div>
@endsection
