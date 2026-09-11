@php
    $mcSettings = [];
    if(isset($course) && $course) {
        $mcSettings = is_array($course->masterclass_settings) ? $course->masterclass_settings : json_decode($course->masterclass_settings ?? '[]', true);
        if(!is_array($mcSettings)) $mcSettings = [];
        
        $totalCapacity = !empty($mcSettings['remaining_seats']) && is_numeric($mcSettings['remaining_seats']) 
            ? (int)$mcSettings['remaining_seats'] 
            : ($course->capacity > 0 ? $course->capacity : 100);
        $totalEnrolled = (int)$course->total_enrolled;
        $remainingSeats = max(0, $totalCapacity - $totalEnrolled);
    } else {
        $remainingSeats = 100;
    }

    $showSpecialGift = isset($mcSettings['show_special_gift']) ? $mcSettings['show_special_gift'] : empty($mcSettings['hide_special_gift']);
    
    $formatCurrencyText = function($text) {
        if (empty($text)) return $text;
        $sym  = get_symbol();
        $code = userCurrency();
        if ($code === 'BDT') {
            return str_replace(['$', 'USD', 'TK', 'Tk'], $sym, $text);
        } else {
            return str_replace(['৳', 'TK', 'Tk'], $sym, $text);
        }
    };

    $stripEmojis = function($text) {
        if (empty($text)) return '';
        return trim(preg_replace('/[\x{1F600}-\x{1F64F}\x{1F300}-\x{1F5FF}\x{1F680}-\x{1F6FF}\x{1F700}-\x{1F77F}\x{1F780}-\x{1F7FF}\x{1F800}-\x{1F8FF}\x{1F900}-\x{1F9FF}\x{1FA00}-\x{1FA6F}\x{1FA70}-\x{1FAFF}\x{2600}-\x{26FF}\x{2700}-\x{27BF}]/u', '', $text));
    };

    $giftBadge = !empty($mcSettings['gift_badge']) ? $stripEmojis($mcSettings['gift_badge']) : '';
    $giftTitle = !empty($mcSettings['gift_title']) ? $stripEmojis($mcSettings['gift_title']) : '';
    $giftValue = !empty($mcSettings['gift_value']) ? $mcSettings['gift_value'] : '';
    $giftDescription = !empty($mcSettings['gift_description']) ? $mcSettings['gift_description'] : '';
    $giftQuote = !empty($mcSettings['gift_quote']) ? $mcSettings['gift_quote'] : '';
    $heroBtnText = !empty($mcSettings['overview_btn_text']) ? $mcSettings['overview_btn_text'] : 'Enroll Now';
    $giftCtaText = !empty($mcSettings['gift_cta_text']) ? $mcSettings['gift_cta_text'] : $heroBtnText;
    $giftCtaLink = !empty($mcSettings['gift_cta_link']) ? $mcSettings['gift_cta_link'] : '';
@endphp

@if($showSpecialGift)
<style>
    .mc-special-gift-card {
        background-color: #ebf5f1;
        border: 1px solid #d1e8de;
        border-radius: 8px;
        padding: 42px 28px;
        margin-bottom: 0;
    }

    .mc-gift-pill {
        display: inline-block;
        background-color: #ffffff;
        border: 1px solid #d1e8de;
        color: #10b981;
        font-size: 0.88rem;
        font-weight: 800;
        padding: 6px 18px;
        border-radius: 50px;
        margin-bottom: 16px;
    }

    .mc-callout-quote {
        background: #ffffff;
        border-left: 4px solid #10b981;
        border-radius: 8px;
        padding: 16px 20px;
        font-style: italic;
        color: #4a5568;
        margin-top: 18px;
        margin-bottom: 18px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
    }
    
    @media (max-width: 767px) {
        .mc-special-gift-card {
            padding: 22px 18px;
        }
    }
</style>
<section class="special-gift-section p-t-60 p-b-60 bg-white">
    <div class="container container-1278">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="mc-special-gift-card text-center d-flex flex-column align-items-center" data-aos="fade-up">
                    @if($giftBadge)
                        <span class="mc-gift-pill">
                            {{ $formatCurrencyText($giftBadge) }}
                        </span>
                    @endif

                    @if($giftTitle)
                        <h2 class="fw-bold text-center mb-3" style="color: #1a1b4b; font-size: 26px; line-height: 1.4;">
                            {!! format_title_highlight($formatCurrencyText($giftTitle)) !!}
                        </h2>
                    @endif

                    @if($giftValue)
                        <div class="d-flex align-items-center justify-content-center gap-3 mb-3">
                            <span class="fw-bold position-relative d-inline-block text-dark" style="font-size: 1.75rem; white-space: nowrap;">
                                <span style="position: absolute; width: 120%; height: 2px; background: red; top: 50%; left: -10%; transform: rotate(-20deg);"></span>
                                <span style="position: absolute; width: 120%; height: 2px; background: red; top: 50%; left: -10%; transform: rotate(20deg);"></span>
                                {{ $formatCurrencyText($giftValue) }}
                            </span>
                            <span class="badge bg-danger fs-6 px-3 py-2 rounded-pill">FREE</span>
                        </div>
                    @endif

                    @if($giftDescription)
                        <div class="text-secondary leading-relaxed fs-6 text-center w-100">
                            {!! $giftDescription !!}
                        </div>
                    @endif

                    @php
                        $giftQuotesList = !empty($mcSettings['gift_quotes_list']) ? $mcSettings['gift_quotes_list'] : [];
                        if (!is_array($giftQuotesList)) $giftQuotesList = [];
                    @endphp
                    @if(count($giftQuotesList) > 0)
                        <div class="w-100 mt-4 mb-4">
                            @foreach($giftQuotesList as $quote)
                                <div class="mc-callout-quote d-flex justify-content-between align-items-center w-100 text-start mt-2 mb-2">
                                    <div class="quote-text me-3">{!! $quote['text'] ?? '' !!}</div>
                                    @if(!empty($quote['price']))
                                        <div class="quote-price fw-bolder px-3 py-1 rounded" style="color: #059669; background-color: #ecfdf5; font-style: normal; white-space: nowrap; font-size: 1.15rem; border: 1px solid #a7f3d0;">
                                            {{ $formatCurrencyText($quote['price']) }}
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @elseif(!empty($giftQuote))
                        <div class="mc-callout-quote w-100 text-start">
                            {!! $formatCurrencyText($giftQuote) !!}
                        </div>
                    @endif

                    @php
                        $heroBtnUrl = !empty($mcSettings['overview_btn_url']) ? $mcSettings['overview_btn_url'] : ((request()->is('/') || request()->is('home*') || isHome()) ? '#register' : url('/#register'));
                        $finalGiftCtaLink = !empty($giftCtaLink) ? $giftCtaLink : $heroBtnUrl;
                    @endphp
                    <div class="text-center w-100 mt-4">
                        <a href="{{ $finalGiftCtaLink }}" class="template-btn get-access-btn">
                            {{ $giftCtaText }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
