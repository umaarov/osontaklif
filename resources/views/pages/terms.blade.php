@extends('layouts.app')

@section('content')
    <h3 class="page-title">Foydalanish shartlari</h3>

    <div class="content-container">
        <div class="main-content">
            <div class="content-box main-content">
                <p>Platformadan foydalanish quyidagi
                    shartlarga asosan amalga oshiriladi:</p>
                <p><strong>1. Umumiy qoidalar</strong></p>
                <ul>
                    <li>"Osontaklif.uz" faqat axborot maqsadida intervyu savollari bazasini taqdim etadi.</li>
                    <li>Platformadan foydalanish orqali foydalanuvchilar ushbu shartlarga rozilik bildiradilar.</li>
                </ul>

                <p><strong>2. Foydalanuvchining majburiyatlari</strong></p>
                <ul>
                    <li>Platformadagi ma’lumotlardan faqat shaxsiy va ta’limiy maqsadlarda foydalanish mumkin.</li>
                    <li>Har qanday nusxalash, tarqatish va boshqa shakllarda foydalanish faqat manba ko'rsatilishi
                        orqali amalga oshirilishi mumkin.
                    </li>
                </ul>

                <p><strong>3. Mas’uliyat cheklovi</strong></p>
                <ul>
                    <li>"Osontaklif.uz" dagi ma’lumotlarning to‘g‘riligi kafolatlanmaydi va ulardan foydalanish natijasida
                        yuzaga keladigan oqibatlar uchun javobgarlik olinmaydi.
                    </li>
                </ul>

                <p><strong>4. Shartlarga o‘zgartirish kiritish</strong></p>
                <ul>
                    <li>Platforma istalgan vaqtda ushbu shartlarni o‘zgartirish huquqiga ega. Foydalanuvchilar
                        o‘zgarishlarni kuzatib borishlari lozim.
                    </li>
                </ul>
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
