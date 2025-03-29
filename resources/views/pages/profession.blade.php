@extends('layouts.app')

@section('content')
    <h3 class="page-title">Вопросы с собеседований на {{ $profession->name }}</h3>
    <p class="page-subtitle">Total Questions: {{ $questions->total() }}</p>

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
                    <th>#</th>
                    <th>Question</th>
                    <th>Chance (%)</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($questions as $q)
                    <tr>
                        <td>{{ ($questions->currentPage() - 1) * $questions->perPage() + $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('question', ['id' => $q->id, 'profession' => $profession->name]) }}"
                               class="table-link">
                                {{ $q->question }}
                            </a>
                        </td>
                        <td>{{ $q->chance }}%</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <!-- Simple Numeric Pagination -->
            <div class="pagination-container">
                @if ($questions->lastPage() > 1)
                    <div class="simple-pagination">
                        @for ($i = 1; $i <= $questions->lastPage(); $i++)
                            <a href="{{ $questions->url($i) }}"
                               class="page-button {{ $questions->currentPage() == $i ? 'active' : '' }}">
                                {{ $i }}
                            </a>
                        @endfor
                    </div>
                @endif
            </div>

            <div style="margin-top: 20px;">
                <a href="{{ route('home') }}" class="btn-outline">
                    Back to Home
                </a>
            </div>
        </div>
        @include("partials.ad")
    </div>
@endsection
