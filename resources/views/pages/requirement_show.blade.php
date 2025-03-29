@extends('layouts.app')

@section('content')
    <h3 style="margin-top: 8px; margin-bottom: 8px">{{ $profession->name }} Requirements</h3>
    <p style="margin-top: 10px; font-size: 14px; color: #555;">Here are the key skills required for the {{ $profession->name }} position based on job postings in Uzbekistan.</p>

    @if($needsRefresh)
        <div style="padding: 10px; background-color: #d1ecf1; color: #0c5460; border-radius: 5px; margin-bottom: 15px;">
            Data is being refreshed in the background. Refresh the page in a few minutes to see updated results.
        </div>
    @endif

    @if($lastUpdated)
        <p style="margin-top: 10px; font-size: 14px; color: #555;">Last updated: {{ \Carbon\Carbon::parse($lastUpdated)->format('Y-m-d H:i') }}</p>
    @endif

    <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px">
        <div style="flex: 3; min-width: 60%;">
            @if($skills->isEmpty())
                <div style="padding: 10px; background-color: #fff3cd; color: #856404; border-radius: 5px; margin-bottom: 15px;">
                    No skills data available for this profession yet. Please check back later.
                </div>
            @else
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
                        <th style="padding: 4px; text-align: left;">#</th>
                        <th style="padding: 4px; text-align: left;">Skill</th>
                        <th style="padding: 4px; text-align: left;">Frequency</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($skills as $index => $skill)
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 4px;">{{ $index + 1 }}</td>
                            <td style="padding: 4px;">{{ $skill->skill_name }}</td>
                            <td style="padding: 4px;">{{ $skill->count }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif

            <div style="margin-top: 20px;">
                <a href="{{ route('requirements') }}"
                   style="padding: 4px 6px;
                   border: 1px solid #007bff;
                   background-color: transparent;
                   color: #007bff;
                   font-size: 16px;
                   border-radius: 5px;
                   cursor: pointer;
                   text-decoration: none;
                   transition: 0.3s ease-in-out;">
                    Back to Requirements
                </a>
            </div>
        </div>

        @include("partials.ad")
    </div>
@endsection
