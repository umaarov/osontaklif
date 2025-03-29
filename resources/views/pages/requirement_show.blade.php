@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $profession->name }} Requirements</h1>
        <p>Here are the key skills required for the {{ $profession->name }} position based on job postings in Uzbekistan.</p>

        @if($needsRefresh)
            <div class="alert alert-info">
                Data is being refreshed in the background. Refresh the page in a few minutes to see updated results.
            </div>
        @endif

        @if($lastUpdated)
            <p class="text-muted">Last updated: {{ \Carbon\Carbon::parse($lastUpdated)->format('Y-m-d H:i') }}</p>
        @endif

        @if($skills->isEmpty())
            <div class="alert alert-warning">
                No skills data available for this profession yet. Please check back later.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped">
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
            </div>
        @endif

        <div class="mt-4">
            <a href="{{ route('requirements') }}" class="btn btn-secondary">Back to Requirements</a>
        </div>
    </div>
@endsection
