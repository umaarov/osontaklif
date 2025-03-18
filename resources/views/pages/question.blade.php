@extends('layouts.app')

@section('content')

    <h3>{{ $question->question }}</h3>
    <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px">
        <div
            style="border: 1px solid #D2D2D2; padding-left: 10px; padding-right: 10px; padding-top: 15px; min-width: 60%; flex: 3; position: relative;">
            <p>{{ $question->content }}</p>
            <p style="bottom: -8px; left: 10px; font-size: 0.9em; color: #777;">
                {{ $question->created_at->format('Y-m-d H:i') }}
            </p>
        </div>

        @include("partials.ad")
    </div>
@endsection
