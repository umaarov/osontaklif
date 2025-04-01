@extends('layouts.app')

@section('content')
    <h3 class="page-title">Foydalanish shartlari</h3>

    <div class="content-container">
        <div class="main-content">
            <div class="content-box main-content">
                <p>Nimadir</p>
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
