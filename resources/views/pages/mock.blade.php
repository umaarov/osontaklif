@extends('layouts.app')

@section('content')
    <h3 class="page-title">Публичные собеседования</h3>

    <div class="content-container">
        <div class="main-content">
            <form method="GET" action="{{ route('mock') }}" class="filter-container">
                <select name="position" class="filter-select">
                    <option value="">---------</option>
                    @foreach($positions as $position)
                        <option
                            value="{{ $position->id }}" {{ request('position') == $position->id ? 'selected' : '' }}>
                            {{ $position->name }}
                        </option>
                    @endforeach
                </select>
                <div class="radio-group">
                    <label><input type="radio" name="grade"
                                  value="Junior" {{ request('grade') == 'Junior' ? 'checked' : '' }}> Junior</label>
                    <label><input type="radio" name="grade"
                                  value="Middle" {{ request('grade') == 'Middle' ? 'checked' : '' }}> Middle</label>
                    <label><input type="radio" name="grade"
                                  value="Senior" {{ request('grade') == 'Senior' ? 'checked' : '' }}> Senior</label>
                </div>
                <button type="submit" class="btn-primary">
                    Выбрать
                </button>
            </form>

            <table class="data-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Название</th>
                    <th>Должность</th>
                    <th>Грейд</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($interviews as $interview)
                    <tr>
                        <td>{{ ($interviews->currentPage() - 1) * $interviews->perPage() + $loop->iteration }}</td>
                        <td>
                            <a href="{{ $interview->link }}" class="table-link">{{ $interview->title }}</a>
                        </td>
                        <td>{{ $interview->profession->name }}</td>
                        <td>{{ $interview->grade }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="pagination-container">
                @if ($interviews->lastPage() > 1)
                    <div class="simple-pagination">
                        @for ($i = 1; $i <= $interviews->lastPage(); $i++)
                            <a href="{{ $interviews->url($i) }}"
                               class="page-button {{ $interviews->currentPage() == $i ? 'active' : '' }}">
                                {{ $i }}
                            </a>
                        @endfor
                    </div>
                @endif
            </div>
        </div>
        @include("partials.ad")
    </div>
@endsection
