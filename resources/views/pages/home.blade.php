@extends('layouts.app')

@section('content')
    <h3 class="page-title">{{ __('home_title') }}</h3>

    <div class="card-grid">
        @foreach ($professions as $profession)
            @if ($profession->questions_count > 0)
                <a href="{{ route('profession', $profession) }}" class="item-card">
                    <h4>{{ $profession->name }}</h4>
                    {{-- <span class="question-count">({{ $profession->questions_count }} {{ trans_choice('messages.questions_count', $profession->questions_count) }})</span> --}}
                </a>
            @else
                <div class="item-card item-card-no-questions" data-profession-name="{{ $profession->name }}"
                     style="cursor: pointer;">
                    <h4>{{ $profession->name }}</h4>
                    {{-- <p class="no-questions-notice">{{ __('No questions yet') }}</p> --}}
                </div>
            @endif
        @endforeach
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toastElement = document.getElementById('infoToast');

            if (toastElement) {
                const bsToast = new bootstrap.Toast(toastElement, {delay: 3000});
                const toastBody = toastElement.querySelector('.toast-body');

                const noQuestionCards = document.querySelectorAll('.item-card-no-questions');

                noQuestionCards.forEach(card => {
                    card.addEventListener('click', function () {
                        const professionName = this.dataset.professionName || this.querySelector('h4').textContent.trim(); // Get profession name
                        if (toastBody) {
                            toastBody.textContent = '"' + professionName + '" has no questions yet.';
                        }
                        bsToast.show();
                    });
                });
            } else {
                console.warn('Toast element with ID "infoToast" not found in the layout. Toast notifications will not work.');
            }
        });
    </script>
@endpush
