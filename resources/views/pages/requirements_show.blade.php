@extends('layouts.app')

@section('content')
    <h3>Требования на должность</h3>
    {{--    <h3>Навыки для профессии: {{ $profession->name }}</h3>--}}

    <table border="1" style="width: 100%; margin-top: 20px; text-align: center;">
        <thead>
        <tr>
            <th>Навык</th>
            <th>Количество упоминаний</th>
        </tr>
        </thead>
        <tbody>
        {{--            @foreach ($skills as $skill => $count)--}}
        {{--                <tr>--}}
        {{--                    <td>{{ ucfirst($skill) }}</td>--}}
        {{--                    <td>{{ $count }}</td>--}}
        {{--                </tr>--}}
        {{--            @endforeach--}}
        </tbody>
    </table>
@endsection
