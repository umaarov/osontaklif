@php use Carbon\Carbon; @endphp
@extends('layouts.app')

@section('content')
    <h3 class="page-title">{{ $profession->name }} Requirements</h3>
    <p class="page-subtitle">Here are the key skills required for the {{ $profession->name }} position based on job
        postings in Uzbekistan.</p>

    @if($lastUpdated)
        <p class="page-subtitle">
            Анализ проведен {{ Carbon::parse($lastUpdated)->format('F d, Y') }}, на основе <a
                href="https://hh.uz/search/vacancy?text={{ urlencode($profession->name) }}&area=97">поискового
                запроса</a>.
            Вакансий обработано: {{ $totalProcessed ?? 0 }}.
            Навыков обработано: {{ $totalSkills ?? 0 }}.
        </p>
    @endif

    <div class="content-container">
        <div class="main-content">
            @if($skills->isEmpty() && $page == 1)
                <div class="alert alert-warning">
                    No skills data available for this profession yet.
                </div>
            @else
                <form method="GET" class="search-form">
                    <input type="text" name="search" value="{{ $validatedSearch }}"
                           placeholder="Search questions..." class="search-input">
                    <input type="hidden" name="page" value="1">
                    <button type="submit" class="btn-outline" style="margin-left: 6px;">
                        Search
                    </button>
                </form>

                <table class="data-table" id="skills-table">
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
                            <td>{{ ($page - 1) * $limit + $index + 1 }}</td>
                            <td>{{ $skill->skill_name }}</td>
                            <td>{{ $skill->count }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                @if($hasMoreSkills)
                    <div class="load-more-container">
                        <a href="{{ url('/requirements/'.$name.'?search='.$validatedSearch.'&sort='.$validatedSort.'&page='.($page + 1).'&limit='.$limit) }}"
                           class="load-more-text"
                           id="load-more-btn">
                            Load More
                        </a>
                    </div>
                @endif
            @endif

            <div style="margin-top: 20px;">
                <a href="{{ url('/requirements') }}" class="btn-outline">
                    Back to Requirements
                </a>
            </div>
        </div>

        @include("partials.ad")
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const loadMoreBtn = document.getElementById('load-more-btn');

            if (loadMoreBtn) {
                loadMoreBtn.addEventListener('click', function (e) {
                    e.preventDefault();

                    const url = this.getAttribute('href');

                    fetch(url)
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');

                            const newRows = doc.querySelectorAll('#skills-table tbody tr');

                            const currentTable = document.querySelector('#skills-table tbody');
                            newRows.forEach(row => {
                                currentTable.appendChild(row.cloneNode(true));
                            });

                            const newLoadMoreBtn = doc.querySelector('#load-more-btn');
                            if (newLoadMoreBtn) {
                                loadMoreBtn.setAttribute('href', newLoadMoreBtn.getAttribute('href'));
                            } else {
                                loadMoreBtn.parentNode.removeChild(loadMoreBtn);
                            }
                        })
                        .catch(error => {
                            console.error('Error loading more skills:', error);
                        });
                });
            }
        });
    </script>
@endsection
