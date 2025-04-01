@extends('layouts.app')

@section('content')
    <h3 class="page-title">{{__('sponsorship_title')}}</h3>

    <div class="content-container">
        <div class="main-content">
            <div class="content-box main-content">
                <p>{{__('sponsorship_desc_1')}}</p>

                <p><strong>{{__('sponsorship_desc_2')}}</strong></p>
                <ul>
                    <li>{{__('sponsorship_desc_3')}}</li>
                    <li>{{__('sponsorship_desc_4')}}</li>
                    <li>{{__('sponsorship_desc_5')}}</li>
                </ul>

                <p>{{__('sponsorship_desc_6')}} <a
                        href="https://t.me/dribbblxr">{{__('sponsorship_desc_7')}}</a>.</p>
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
