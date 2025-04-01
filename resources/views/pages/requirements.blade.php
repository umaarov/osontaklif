@extends('layouts.app')

@section('content')
    <h3 class="page-title">{{__('requirement_title')}}</h3>

    <div class="card-grid">
        @foreach ($professions as $profession)
            <a href="{{ route('requirements.show', $profession->name) }}" class="item-card">
                <h4>{{ $profession->name }}</h4>
            </a>
        @endforeach
    </div>
@endsection
