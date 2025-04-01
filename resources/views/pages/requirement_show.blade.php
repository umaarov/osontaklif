@php use Carbon\Carbon; @endphp
@extends('layouts.app')

@section('content')
    <h3 class="page-title">{{__('requirement_show_title')}} {{ $profession->name }}</h3>
    <p class="page-subtitle">{{__('requirement_show_desc_1')}} {{ $profession->name }} {{__('requirement_show_desc_2')}}</p>

    @if($lastUpdated)
        <p class="page-subtitle">
            {{__('requirement_show_desc_3')}} {{ Carbon::parse($lastUpdated)->format('F d, Y') }} {{__('requirement_show_desc_4')}}
            <a
                href="https://hh.uz/search/vacancy?text={{ urlencode($profession->name) }}&area=97">{{__('requirement_show_desc_5')}} </a> {{__('requirement_show_desc_6')}}
            {{__('requirement_show_desc_7')}} {{ $totalProcessed ?? 0 }}.
            {{__('requirement_show_desc_8')}} {{ $totalSkills ?? 0 }}.
        </p>
    @endif

    <div class="content-container">
        <div class="main-content">
            @if($skills->isEmpty() && $page == 1)
                <div class="alert alert-warning">
                    {{__('requirement_show_no_skills_data')}}
                </div>
            @else
                <form method="GET" class="search-form">
                    <input type="text" name="search" value="{{ $validatedSearch }}"
                           placeholder="{{__('requirement_show_search_placeholder')}}" class="search-input">
                    <input type="hidden" name="page" value="1">
                    <button type="submit" class="btn-outline" style="margin-left: 6px;">
                        {{__('requirement_show_search_btn')}}
                    </button>
                </form>

                <table class="data-table" id="skills-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('requirement_show_table_title_1')}}</th>
                        <th>{{__('requirement_show_table_title_2')}}</th>
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
                            {{__('load_more')}}
                        </a>
                    </div>
                @endif
            @endif

            <div style="margin-top: 20px;">
                <a href="{{ url('/requirements') }}" class="btn-outline">
                    {{__('back_to_requirements')}}
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
