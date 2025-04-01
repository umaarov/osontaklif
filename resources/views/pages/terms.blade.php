@extends('layouts.app')

@section('content')
    <h3 class="page-title">{{__('terms_title')}}</h3>

    <div class="content-container">
        <div class="main-content">
            <div class="content-box main-content">
                <p>{{__('terms_desc_0')}}</p>
                <p><strong>{{__('terms_desc_1')}}</strong></p>
                <ul>
                    <li>{{__('terms_desc_2')}}</li>
                    <li>{{__('terms_desc_3')}}</li>
                </ul>

                <p><strong>{{__('terms_desc_4')}}</strong></p>
                <ul>
                    <li>{{__('terms_desc_5')}}</li>
                    <li>{{__('terms_desc_6')}}</li>
                </ul>

                <p><strong>{{__('terms_desc_7')}}</strong></p>
                <ul>
                    <li>{{__('terms_desc_8')}}</li>
                </ul>

                <p><strong>{{__('terms_desc_9')}}</strong></p>
                <ul>
                    <li>{{__('terms_desc_10')}}</li>
                </ul>
            </div>
            <div style="margin-top: 20px;">
                <a href="{{ route('home') }}" class="btn-outline">
                    {{__('back_to_home')}}
                </a>
            </div>
        </div>
        @include("partials.ad")
    </div>
@endsection
