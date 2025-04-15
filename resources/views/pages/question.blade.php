@extends('layouts.app')

@section('content')
    <h3 class="page-title">{{ $question->question }}</h3>

    <div class="content-container">
        <div class="main-content">
            <div class="content-box main-content">
                {!! $question->content !!}

                @if($question->created_at)
                    <p class="timestamp">
                        {{ $question->created_at->format('Y-m-d H:i') }}
                    </p>
                @endif
            </div>
            <div style="margin-top: 20px;">
                <a href="{{ route('profession', ['name' => $profession]) }}" class="btn-outline">
                    {{__('back_to_questions')}}
                </a>
            </div>
        </div>
        @include("partials.ad")
    </div>
@endsection
