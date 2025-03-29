@php use Carbon\Carbon; @endphp
@extends('layouts.app')

@section('content')
    <h3 class="page-title">{{ $profession->name }} Requirements</h3>
    <p class="page-subtitle">Here are the key skills required for the {{ $profession->name }} position based on job
        postings in Uzbekistan.</p>

    @if($lastUpdated)
        <p class="page-subtitle">Last updated: {{ Carbon::parse($lastUpdated)->format('Y-m-d H:i') }}</p>
    @endif

    <div class="content-container">
        <div class="main-content">
            @if($skills->isEmpty())
                <div class="alert alert-warning">
                    No skills data available for this profession yet.
                </div>
            @else
                <form method="GET" class="search-form">
                    <input type="text" name="search" value="{{ $validatedSearch }}"
                           placeholder="Search questions..." class="search-input">
                    <button type="submit" class="btn-outline" style="margin-left: 6px;">
                        Search
                    </button>
                </form>

                <table class="data-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Skill</th>
                        <th>Frequency</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($skills as $index => $skill)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $skill->skill_name }}</td>
                            <td>{{ $skill->count }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif

            <div style="margin-top: 20px;">
                <a href="{{ route('requirements') }}" class="btn-outline">
                    Back to Requirements
                </a>
            </div>
        </div>

        @include("partials.ad")
    </div>
@endsection
