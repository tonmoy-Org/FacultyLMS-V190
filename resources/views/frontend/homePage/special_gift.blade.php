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

    $hideSpecialGift = !empty($mcSettings['hide_special_gift']);
    
    $giftBadge = !empty($mcSettings['gift_badge']) ? $mcSettings['gift_badge'] : '🎁 যারা join করবেন তাদের জন্য special gift';
    $giftTitle = !empty($mcSettings['gift_title']) ? $mcSettings['gift_title'] : '৳১০,০০০ টাকার Ecom Dropshipping Mastery Course — সম্পূর্ণ FREE করার সুযোগ';
    $giftValue = !empty($mcSettings['gift_value']) ? $mcSettings['gift_value'] : '৳১০,০০০';
    $giftDescription = !empty($mcSettings['gift_description']) ? $mcSettings['gift_description'] : 'এই master class-এ যারা join করবেন, তারা আমার ৳১০,০০০ টাকার Ecom Dropshipping Mastery Course টা free তে করার সুযোগ পাবেন। মাস্টারক্লাসে এই বিষয়ে বিস্তারিত আলোচনা।';
    $giftQuote = !empty($mcSettings['gift_quote']) ? $mcSettings['gift_quote'] : '"এই কোর্সে আমি ই-কমার্স বিজনেস, ডিজিটাল মার্কেটিং এর বিভিন্ন বিষয় যেমন Facebook Ads, Google Ads নিয়ে বিস্তারিত শিখিয়েছি। এছাড়াও কিভাবে একটা বিজনেসকে Scale করতে তা নিয়ে ক্লাস আছে।"';
    $giftFooterNote = !empty($mcSettings['gift_footer_note']) ? $mcSettings['gift_footer_note'] : 'যারা একদম নতুন আছেন তারাও এই কোর্স থেকে বেনিফিটেড হতে পারবে।';
    $giftCtaText = !empty($mcSettings['gift_cta_text']) ? $mcSettings['gift_cta_text'] : 'সিট কনফার্ম করুন →';
@endphp

@if(!$hideSpecialGift)
<style>
    .mc-special-gift-card {
        background-color: #ebf5f1;
        border: 1px solid #d1e8de;
        border-radius: 20px;
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
        border-radius: 10px;
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
                <div class="mc-special-gift-card text-center d-flex flex-column align-items-center">
                    <span class="mc-gift-pill">
                        {{ $giftBadge }}
                    </span>

                    <h2 class="fw-bold fs-3 text-dark mb-3 text-center">
                        {{ $giftTitle }}
                    </h2>

                    <div class="d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="fs-5 text-muted text-decoration-line-through">{{ $giftValue }}</span>
                        <span class="badge bg-danger fs-6 px-3 py-2 rounded-pill">FREE</span>
                    </div>

                    <div class="text-secondary leading-relaxed fs-6 text-center w-100">
                        {!! $giftDescription !!}
                    </div>

                    <div class="mc-callout-quote w-100 text-start">
                        {!! $giftQuote !!}
                    </div>

                    <p class="small text-muted mb-4 text-center w-100">
                        {{ $giftFooterNote }}
                    </p>

                    <div class="text-center">
                        <a href="{{ isset($course) ? route('course.details', $course->slug) : '#' }}" class="template-btn">
                            {{ $giftCtaText }}
                        </a>
                        <div class="mc-seats-counter mt-3">
                            <span class="mc-pulse-dot"><span class="ping"></span><span class="dot"></span></span>
                            <span>বাকি আছে মাত্র <strong class="text-warning fw-bold">{{ $remainingSeats }}</strong> টা seat</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
