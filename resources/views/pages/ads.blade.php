@extends('layouts.app')

@section('content')
    <h3 class="page-title">{{ __('ad_title') }}</h3>

    <div class="content-container">
        <div class="main-content">
            <div class="content-box main-content">
                <p>{{ __('ad_desc_1') }}</p>

                <p><strong>{{ __('ad_desc_2') }}</strong></p>
                <ul>
                    <li>{{ __('ad_desc_3') }}</li>
                    <li>{{ __('ad_desc_4') }}</li>
                    <li>{{ __('ad_desc_5') }}</li>
                </ul>

                <p>{{ __('ad_desc_6') }} <a href="https://t.me/dribbblxr">{{ __('ad_desc_7') }}</a>.</p>

            </div>
            <div style="margin-top: 20px;">
                <a href="{{ route('home') }}" class="btn-outline">
                    {{ __('back_to_home') }}
                </a>
            </div>
        </div>
        @include("partials.ad")
    </div>
@endsection
