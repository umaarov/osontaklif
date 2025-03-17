@extends('layouts.app')

@section('content')
    <h1>{{ $profession->name }} Interview Questions</h1>

    <form method="GET">
        <input type="text" name="search" value="{{ $search }}" placeholder="Search questions..."/>
        <button type="submit">Search</button>

        <select name="sort" onchange="this.form.submit()">
            <option value="desc" {{ $sort == 'desc' ? 'selected' : '' }}>High to Low</option>
            <option value="asc" {{ $sort == 'asc' ? 'selected' : '' }}>Low to High</option>
        </select>

    </form>

    <table border="1" style="margin-top: 20px; width: 100%; border-collapse: collapse;">
        <thead>
        <tr>
            <th>Chance (%)</th>
            <th>Question</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($questions as $q)
            <tr>
                <td>{{ $q->chance }}%</td>
                <td><a href="{{ route('question', $q->id) }}">{{ $q->question }}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="{{ route('home') }}" style="display: block; margin-top: 20px;">Back to Home</a>
@endsection
