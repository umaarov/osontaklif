@extends('layouts.app')

@section('content')
    <h3 style="margin-top: 8px; margin-bottom: 8px">Публичные собеседования</h3>

    <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px">
        <div style="flex: 3; min-width: 60%;">
            <form method="GET" action="{{ route('mock') }}"
                  style="margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                <select name="position"
                        style="padding: 4px; border: 1px solid #ccc; border-radius: 5px; font-size: 16px;">
                    <option value="">---------</option>
                    @foreach($positions as $position)
                        <option
                            value="{{ $position->id }}" {{ request('position') == $position->id ? 'selected' : '' }}>
                            {{ $position->name }}
                        </option>
                    @endforeach
                </select>
                <div>
                    <label><input type="radio" name="grade"
                                  value="Junior" {{ request('grade') == 'Junior' ? 'checked' : '' }}> Junior</label>
                    <label><input type="radio" name="grade"
                                  value="Middle" {{ request('grade') == 'Middle' ? 'checked' : '' }}> Middle</label>
                    <label><input type="radio" name="grade"
                                  value="Senior" {{ request('grade') == 'Senior' ? 'checked' : '' }}> Senior</label>
                </div>
                <button type="submit"
                        style="padding: 6px 12px; border: 1px solid #007bff; background-color: #007bff; color: white; border-radius: 5px; cursor: pointer;">
                    Выбрать
                </button>
            </form>

            <table style="margin-top: 20px; width: 100%; border-collapse: collapse;">
                <thead>
                <tr style="border-bottom: 2px solid #ddd;">
                    <th style="padding: 8px; text-align: left;">Название</th>
                    <th style="padding: 8px; text-align: left;">Должность</th>
                    <th style="padding: 8px; text-align: left;">Грейд</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($interviews as $interview)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 8px;"><a href="{{ $interview->link }}"
                                                     style="text-decoration: none; color: #007bff;">{{ $interview->title }}</a>
                        </td>
                        <td style="padding: 8px;">{{ $interview->profession->name }}</td>
                        <td style="padding: 8px;">{{ $interview->grade }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        @include("partials.ad")
    </div>
@endsection
