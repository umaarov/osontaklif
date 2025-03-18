@extends('layouts.app')

@section('content')

    <h3>{{ $question->question }}</h3>
    <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px">
        <div style="border: 1px solid #D2D2D2; padding: 20px; min-width: 60%; flex: 3">
            <p>{{ $question->content }}</p>
        </div>

        @include("partials.ad")
    </div>
@endsection
