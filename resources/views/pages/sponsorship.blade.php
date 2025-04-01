@extends('layouts.app')

@section('content')
    <h3 class="page-title">Homiylik</h3>

    <div class="content-container">
        <div class="main-content">
            <div class="content-box main-content">
                <p>Platformani yanada rivojlantirish va foydalanuvchilarga ko‘proq imkoniyat yaratish maqsadida homiylik
                    taklif etamiz.</p>

                <p><strong>Homiy sifatida siz:</strong></p>
                <ul>
                    <li>Platformaning rivojlanishiga bevosita hissa qo‘shishingiz mumkin.</li>
                    <li>O‘z brendingizni IT sohasi mutaxassislariga targ‘ib qilishingiz mumkin.</li>
                    <li>Reklama va hamkorlik imkoniyatlaridan foydalanishingiz mumkin.</li>
                </ul>

                <p>Homiylik shartlari va imkoniyatlari bo‘yicha batafsil ma’lumot olish uchun biz bilan <a href="https://t.me/dribbblxr">bog‘laning.</a></p>
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
