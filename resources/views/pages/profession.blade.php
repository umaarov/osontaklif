@extends('layouts.app')

@section('content')
    <h3 style="margin-top: 8px; margin-bottom: 8px">Вопросы с собеседований на {{ $profession->name }}</h3>
    <p style="margin-top: 10px; font-size: 14px; color: #555;">Total Questions: {{ $questions->count() }}</p>

    <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px">
        <div style="flex: 3; min-width: 60%;">
            <form method="GET" style="margin-bottom: 20px; display: flex; align-items: center; width: 100%;">
                <input type="text" name="search" value="{{ $search }}" placeholder="Search questions..."
                       style="flex: 1; padding: 4px; border: 1px solid #ccc; border-radius: 5px 0 0 5px; outline: none; transition: 0.3s ease-in-out; font-size: 16px;"
                       onfocus="this.style.borderColor='#007bff';"
                       onblur="this.style.borderColor='#ccc';">
                <button type="submit"
                        style="padding: 4px 6px;
                        border: 1px solid #007bff;
                        background-color: transparent;
                        color: #007bff;
                        font-size: 16px;
                        border-radius: 5px;
                        cursor: pointer;
                        margin-left: 6px;
                        transition: 0.3s ease-in-out;">
                    Search
                </button>

            </form>
            <table style="margin-top: 20px; width: 100%; border-collapse: collapse;">
                <thead>
                <tr style="border-bottom: 2px solid #ddd;">
                    <th style="padding: 4px; text-align: left;">Chance (%)</th>
                    <th style="padding: 4px; text-align: left;">Question</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($questions as $q)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 4px;">{{ $q->chance }}%</td>
                        <td style="padding: 4px;">
                            <a href="{{ route('question', $q->id) }}" style="text-decoration: none; color: #007bff;">
                                {{ $q->question }}
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Ad Space -->
        <div
            style="flex: 1; min-width: 250px; background-color: #f9f9f9; padding: 20px; text-align: center; border-radius: 5px;">
            <p style="color: #888;">Ad Space</p>
        </div>
    </div>
@endsection
