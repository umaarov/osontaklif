@extends('layouts.app')

@section('content')
    <h1>{{ $name }} Interview Questions</h1>

    <table border="1" style="width: 100%; border-collapse: collapse;">
        <thead>
        <tr>
            <th>ID</th>
            <th>Question</th>
            <th>Chance of Asking</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($questions as $q)
            <tr>
                <td>{{ $q['id'] }}</td>
                <td>{{ $q['question'] }}</td>
                <td>{{ $q['chance'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="{{ route('home') }}" style="display: block; margin-top: 20px;">Back to Home</a>
@endsection
