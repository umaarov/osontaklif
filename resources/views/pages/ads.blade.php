@extends('layouts.app')

@section('content')
    <h3 class="page-title">Reklama</h3>

    <div class="content-container">
        <div class="main-content">
            <div class="content-box main-content">
                <p>Agar siz platformada xizmat yoki mahsulotingizni targ'ib qilmoqchi bo'lsangiz, sizga quyidagi imkoniyatlarni taqdim etamiz:</p>

                <p><strong>Reklama imkoniyatlari:</strong></p>
                <ul>
                    <li>Banner reklama (saytning asosiy sahifalarida).</li>
                    <li>Homiylik maqolalari va mahsus kontent.</li>
                    <li>Maqsadli auditoriyaga yo'naltirigan reklamalar.</li>
                </ul>

                <p>Reklama shartlari va imkoniyatlari bo‘yicha batafsil ma’lumot olish uchun biz bilan <a href="https://t.me/dribbblxr">bog‘laning.</a></p>

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
