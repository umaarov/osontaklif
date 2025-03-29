@extends('layouts.app')

@section('content')
    <h3 class="page-title">Вопросы с собеседований на {{ $profession->name }}</h3>
    <p class="page-subtitle">Total Questions: {{ $questions->count() }}</p>

    <div class="content-container">
        <div class="main-content">
            <form method="GET" class="search-form">
                <input type="text" name="search" value="{{ $search }}"
                       placeholder="Search questions..." class="search-input">
                <button type="submit" class="btn-outline" style="margin-left: 6px;">
                    Search
                </button>
            </form>

            <table class="data-table">
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
                        <td>
                            <a href="{{ route('question', ['id' => $q->id, 'profession' => $profession->name]) }}" class="table-link">
                                {{ $q->question }}
                            </a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div style="margin-top: 20px;">
                <a href="{{ route('home') }}" class="btn-outline">
                    Back to Home
                </a>
            </div>

        </div>
        @include("partials.ad")
    </div>
@endsection
