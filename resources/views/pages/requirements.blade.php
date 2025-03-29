@extends('layouts.app')

@section('content')
    <h1 class="page-title">Job Requirements</h1>
    <p class="page-subtitle">Find job interview requirements here.</p>

    <div class="card-grid">
        @foreach ($professions as $profession)
            <a href="{{ route('requirements.show', $profession->name) }}" class="item-card">
                <h4>{{ $profession->name }}</h4>
            </a>
        @endforeach
    </div>
@endsection
