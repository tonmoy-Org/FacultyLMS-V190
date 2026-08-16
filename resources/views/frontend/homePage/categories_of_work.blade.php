@php
    $cards = setting('categories_of_work_cards');
    $cards = is_array($cards) ? $cards : [];
    $title = setting('categories_of_work_title') ?: 'The categories of work.';
@endphp

@if(count($cards) > 0 || $title)
<style>
    .cow-wrapper {
        background-color: #f4faf6; /* very light green background */
        border-radius: 20px;
        padding: 60px 40px;
        margin-bottom: 0px;
    }
    .cow-title { 
        color: #1a1b4b;
        font-size: 28px;
        font-weight: 800;
        text-align: center;
        margin-bottom: 50px;
    }
    .cow-card {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        padding: 30px;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .cow-card-title {
        background-color: #dcfce7; /* light green for title bg */
        color: #065f46; /* darker green for text */
        padding: 16px 24px;
        border-radius: 8px;
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 25px;
    }
    .cow-card-body-wrapper {
        position: relative;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        padding-top: 10px;
    }
    .cow-card-content {
        color: #6b7280;
        font-size: 15px;
        line-height: 2.2;
        padding-left: 24px; /* Align with title text */
        padding-right: 24px; 
        min-height: 100px;
    }
    .cow-card-content.has-image {
        padding-right: 140px; /* leaves room for absolute image */
    }
    .cow-card-content strong, .cow-card-content b {
        color: #065f46; /* bold text matches title color */
    }
    .cow-card-content p {
        margin-bottom: 12px;
    }
    .cow-card-img-floating-wrapper {
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
    }
    .cow-card-img-floating {
        max-width: 130px;
        max-height: 90px;
        object-fit: contain;
    }
    .cow-card-only-image {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        background: transparent;
        box-shadow: none;
    }
    .cow-card-only-image img {
        max-width: 100%;
        border-radius: 8px;
    }
    @media (max-width: 768px) {
        .cow-wrapper {
            padding: 30px 16px;
            border-radius: 12px;
        }
        .cow-card-content,
        .cow-card-content.has-image {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
        .cow-card-img-floating-wrapper {
            position: relative;
            transform: none;
            right: 0;
            top: 0;
            margin-top: 25px;
            display: block;
            text-align: center;
        }
    }
</style>

<section class="categories-of-work-section p-t-60 p-b-60 bg-white">
    <div class="container container-1278">
        <div class="cow-wrapper">
            @if($title)
                <h3 class="cow-title">{{ __($title) }}</h3>
            @endif

            <div class="row g-4 justify-content-center">
                @foreach($cards as $card)
                    @php
                        $hasTitle = !empty($card['title']);
                        $hasContent = !empty($card['content']);
                        $hasImage = !empty($card['image']);
                        $hasLink = !empty($card['link']);
                        $onlyImage = !$hasTitle && !$hasContent && $hasImage;
                    @endphp
                    <div class="col-lg-6 col-md-12">
                        @if($onlyImage)
                            <div class="cow-card cow-card-only-image h-100">
                                @if($hasLink)
                                    <a href="{{ $card['link'] }}" {{ str_starts_with($card['link'], '#') ? '' : 'target="_blank"' }}>
                                        <img src="{{ asset($card['image']) }}" alt="Category Image">
                                    </a>
                                @else
                                    <img src="{{ asset($card['image']) }}" alt="Category Image">
                                @endif
                            </div>
                        @else
                            <div class="cow-card">
                                @if($hasTitle)
                                    <div class="cow-card-title">
                                        {{ $card['title'] }}
                                    </div>
                                @endif

                                <div class="cow-card-body-wrapper">
                                    @if($hasContent)
                                        <div class="cow-card-content {{ $hasImage ? 'has-image' : '' }}">
                                            {!! $card['content'] !!}
                                        </div>
                                    @endif

                                    @if($hasImage)
                                        @if($hasLink)
                                            <a href="{{ $card['link'] }}" {{ str_starts_with($card['link'], '#') ? '' : 'target="_blank"' }} class="cow-card-img-floating-wrapper">
                                                <img src="{{ asset($card['image']) }}" class="cow-card-img-floating" alt="{{ $card['title'] ?? 'Category Image' }}">
                                            </a>
                                        @else
                                            <div class="cow-card-img-floating-wrapper">
                                                <img src="{{ asset($card['image']) }}" class="cow-card-img-floating" alt="{{ $card['title'] ?? 'Category Image' }}">
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
