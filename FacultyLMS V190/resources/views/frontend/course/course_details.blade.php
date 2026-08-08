@extends('frontend.layouts.master')
@section('title', $course->title)
@section('content')

<style>
    /* ============================================================
       FACULTY LMS - DYNAMIC MASTERCLASS LANDING PAGE (WHITE THEME)
       100% Sync with Admin Panel (/admin/courses/{id}/edit)
       Inherits Theme Fonts & Design Tokens from base.blade.php
       ============================================================ */
    .masterclass-page-wrapper {
        background-color: #ffffff !important;
        color: #1a202c !important;
        font-family: var(--body-font, system-ui, -apple-system, sans-serif);
    }
    
    .mc-container {
        max-width: 840px;
        margin: 0 auto;
        padding-left: 15px;
        padding-right: 15px;
    }

    .mc-hero-header {
        text-align: center;
        padding-top: 40px;
        padding-bottom: 30px;
        background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
        border-bottom: 1px solid #edf2f7;
    }

    .mc-eyebrow-badge {
        display: inline-block;
        background-color: rgba(27, 138, 46, 0.08);
        border: 1px solid rgba(27, 138, 46, 0.2);
        color: #1b8a2e;
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        padding: 6px 18px;
        border-radius: 50px;
        margin-bottom: 16px;
    }

    .mc-main-title {
        font-family: var(--header-font, system-ui, sans-serif);
        font-size: clamp(1.8rem, 4vw, 2.6rem);
        font-weight: 800;
        color: #1a202c !important;
        line-height: 1.25;
        margin-bottom: 16px;
    }

    .mc-sub-title {
        font-size: 1.05rem;
        color: #4a5568;
        line-height: 1.65;
        max-width: 760px;
        margin: 0 auto 20px;
    }

    .mc-meta-bar {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
        font-size: 0.9rem;
        color: #718096;
    }

    .mc-video-box {
        background-color: #000000;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin-bottom: 16px;
        border: 1px solid #e2e8f0;
    }

    .mc-video-box iframe, 
    .mc-video-box video, 
    .mc-video-box .plyr {
        width: 100% !important;
        border-radius: 16px;
    }

    /* Primary High-Converting CTA Button */
    .mc-btn-primary-cta {
        display: block;
        width: 100%;
        max-width: 540px;
        margin: 0 auto;
        background: linear-gradient(180deg, #3CFD59 0%, #1b8a2e 100%) !important;
        color: #000000 !important;
        font-size: 1.25rem !important;
        font-weight: 800 !important;
        text-align: center;
        padding: 16px 28px;
        border-radius: 12px;
        border: none !important;
        box-shadow: 0 6px 22px rgba(60, 253, 89, 0.35);
        text-decoration: none !important;
        transition: all 0.2s ease-in-out;
        cursor: pointer;
    }

    .mc-btn-primary-cta:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 28px rgba(60, 253, 89, 0.5);
        color: #000000 !important;
    }

    .mc-dual-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        overflow: hidden;
        text-decoration: none !important;
        box-shadow: 0 4px 16px rgba(253, 253, 60, 0.3);
        transition: transform 0.2s ease;
    }

    .mc-dual-btn:hover {
        transform: scale(1.02);
    }

    .mc-dual-left {
        background: linear-gradient(90deg, #FDFD3C 10%, #FFFFCE 50%, #FDFD3C 90%);
        color: #000000;
        font-size: 1.1rem;
        font-weight: 800;
        padding: 14px 24px;
    }

    .mc-dual-right {
        background: linear-gradient(90deg, #FDFD3C 10%, #FFFFCE 50%, #FDFD3C 90%);
        color: #000000;
        font-size: 1.1rem;
        font-weight: 800;
        padding: 14px 24px;
        border-left: 1px solid rgba(0,0,0,0.15);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .mc-red-badge-btn {
        display: inline-block;
        background: linear-gradient(90deg, #f7971e, #ff5858);
        color: #ffffff !important;
        font-size: 1.1rem;
        font-weight: 800;
        padding: 15px 36px;
        border-radius: 12px;
        text-decoration: none !important;
        box-shadow: 0 6px 20px rgba(255, 88, 88, 0.35);
        transition: transform 0.2s ease;
    }

    .mc-red-badge-btn:hover {
        transform: scale(1.03);
        color: #ffffff !important;
    }

    /* Pulsing Seats Counter */
    .mc-seats-counter {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 0.92rem;
        color: #4a5568;
        margin-top: 12px;
    }

    .mc-pulse-dot {
        position: relative;
        display: inline-flex;
        height: 10px;
        width: 10px;
    }

    .mc-pulse-dot span.ping {
        position: absolute;
        display: inline-flex;
        height: 100%;
        width: 100%;
        border-radius: 50%;
        background-color: #ff5858;
        opacity: 0.75;
        animation: ping 1.4s cubic-bezier(0, 0, 0.2, 1) infinite;
    }

    .mc-pulse-dot span.dot {
        position: relative;
        display: inline-flex;
        border-radius: 50%;
        height: 10px;
        width: 10px;
        background-color: #ff5858;
    }

    @keyframes ping {
        75%, 100% { transform: scale(2); opacity: 0; }
    }

    /* Gold Info Card */
    .mc-gold-info-card {
        background: #ffffff;
        border: 2px solid #C47942;
        border-radius: 20px;
        padding: 28px;
        margin-top: 32px;
        margin-bottom: 32px;
        box-shadow: 0 8px 25px rgba(196, 121, 66, 0.08);
    }

    .mc-gold-badge-top {
        display: block;
        width: fit-content;
        margin: 0 auto -20px;
        position: relative;
        z-index: 2;
        background: #ffffff;
        border: 2px solid #C47942;
        border-radius: 12px 12px 0 0;
        padding: 6px 22px;
        font-size: 1.05rem;
        font-weight: 800;
        color: #C47942;
    }

    .mc-gold-item-row {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 12px 0;
        border-bottom: 1px solid rgba(196, 121, 66, 0.15);
    }

    .mc-gold-item-row:last-child {
        border-bottom: none;
    }

    .mc-gold-icon-circle {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: #fffaf5;
        border: 1px solid rgba(196, 121, 66, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #C47942;
        font-size: 1.15rem;
        flex-shrink: 0;
    }

    .mc-gold-price-highlight {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #f0fff4;
        border: 1px solid #b2f0c5;
        border-radius: 12px;
        padding: 16px 20px;
        margin-top: 20px;
    }

    .mc-gold-price-old {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 20px;
        color: #718096;
    }

    /* Benefits Grid Card */
    .mc-benefits-card-wrapper {
        background: #ffffff;
        border: 2px solid #fdcc0d;
        border-radius: 20px;
        padding: 32px 24px;
        margin-bottom: 35px;
        box-shadow: 0 6px 25px rgba(253, 204, 13, 0.1);
        text-align: center;
    }

    .mc-benefit-single-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 20px 14px;
        text-align: center;
        height: 100%;
        transition: all 0.2s ease;
    }

    .mc-benefit-single-card:hover {
        border-color: #1b8a2e;
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(27, 138, 46, 0.1);
    }

    .mc-benefit-single-card .check-circle {
        width: 38px;
        height: 38px;
        background: #1b8a2e;
        color: #ffffff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 12px;
        font-size: 1rem;
    }

    .mc-benefit-single-card p {
        font-size: 0.92rem;
        font-weight: 700;
        color: #2d3748;
        margin: 0;
        line-height: 1.45;
    }

    /* Special Gift Box */
    .mc-special-gift-card {
        background: linear-gradient(135deg, #fff7f0 0%, #ffffff 100%);
        border: 2px solid #C47942;
        border-radius: 20px;
        padding: 32px 28px;
        margin-bottom: 35px;
        box-shadow: 0 8px 30px rgba(196, 121, 66, 0.1);
    }

    .mc-gift-pill {
        display: inline-block;
        background: #fffbea;
        border: 1px solid #fce83a;
        color: #b8860b;
        font-size: 0.88rem;
        font-weight: 800;
        padding: 6px 18px;
        border-radius: 50px;
        margin-bottom: 16px;
    }

    .mc-callout-quote {
        background: #ffffff;
        border-left: 4px solid #ff7a30;
        border-radius: 10px;
        padding: 16px 20px;
        font-style: italic;
        color: #4a5568;
        margin-top: 18px;
        margin-bottom: 18px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    }

    /* Progress Bar Box */
    .mc-progress-box {
        background: #eaf3ff;
        border: 1px solid #cfe2ff;
        border-radius: 16px;
        padding: 22px;
        margin-bottom: 28px;
        color: #1a365d;
        text-align: center;
    }

    .mc-progress-bar-bg {
        height: 12px;
        background: #dbe7ff;
        border-radius: 20px;
        overflow: hidden;
        margin-top: 10px;
        margin-bottom: 8px;
    }

    .mc-progress-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, #4A90D9, #1c6dd0);
        border-radius: 20px;
    }

    .mc-blue-explainer {
        background: #ffffff;
        border-left: 5px solid #1c6dd0;
        border-radius: 14px;
        padding: 26px;
        border: 1px solid #e2e8f0;
        border-left-width: 5px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.04);
        margin-bottom: 28px;
    }

    .mc-breakdown-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 26px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.04);
        margin-bottom: 32px;
    }

    /* Registration Form Card */
    .mc-form-wrapper {
        background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
        border: 2px solid #1c6dd0;
        border-radius: 20px;
        padding: 32px 26px;
        box-shadow: 0 10px 35px rgba(28, 109, 208, 0.1);
        margin-bottom: 40px;
    }

    .mc-form-input {
        width: 100%;
        background: #ffffff;
        border: 1px solid #cbd5e0;
        border-radius: 10px;
        padding: 13px 16px;
        font-size: 0.96rem;
        color: #1a202c;
        margin-top: 6px;
        margin-bottom: 18px;
        transition: border-color 0.2s ease;
    }

    .mc-form-input:focus {
        outline: none;
        border-color: #1c6dd0;
        box-shadow: 0 0 0 3px rgba(28, 109, 208, 0.15);
    }

    /* Content Section Card */
    .mc-content-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        padding: 28px;
        margin-bottom: 32px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
    }

    /* FAQ Accordion */
    .mc-faq-accordion .accordion-item {
        border: 1px solid #e2e8f0 !important;
        border-radius: 12px !important;
        margin-bottom: 10px;
        overflow: hidden;
        background: #ffffff !important;
    }

    .mc-faq-accordion .accordion-button {
        background: #ffffff !important;
        color: #1a202c !important;
        font-weight: 700;
        font-size: 1rem;
        padding: 16px 20px;
        box-shadow: none !important;
    }

    .mc-faq-accordion .accordion-button:not(.collapsed) {
        background: #f0fff4 !important;
        color: #1b8a2e !important;
        border-bottom: 1px solid #b2f0c5 !important;
    }

    .mc-faq-accordion .accordion-body {
        background: #fafafa !important;
        color: #4a5568;
        line-height: 1.65;
        font-size: 0.95rem;
        padding: 18px 20px;
    }

    @media (max-width: 768px) {
        .mc-hero-header { padding-top: 30px; }
        .mc-main-title { font-size: 1.55rem; }
        .mc-gold-info-card { padding: 20px 16px; }
        .mc-special-gift-card { padding: 22px 18px; }
        .mc-form-wrapper { padding: 22px 18px; }
    }
</style>

<div class="masterclass-page-wrapper">

    {{-- =========================================================
         1. HERO HEADER SECTION (100% Admin Panel Sync)
         Fields from Admin: $course->title, $course->short_description, $course->category
    ========================================================== --}}
    <section class="mc-hero-header">
        <div class="mc-container">
            @if($category)
                <span class="mc-eyebrow-badge">{{ $category->lang_title }}</span>
            @else
                <span class="mc-eyebrow-badge">E-commerce শুরু করার hidden path</span>
            @endif

            {{-- Main Title --}}
            <h1 class="mc-main-title">{{ $course->title }}</h1>

            {{-- Short Description --}}
            @if($course->short_description)
                <p class="mc-sub-title">{{ $course->short_description }}</p>
            @endif

            {{-- 2. CENTERED INTRO VIDEO / MEDIA (From Admin Video Tab) --}}
            <div class="mc-video-box">
                @include('frontend.components.video', [
                    'source' => $course->video_source, 
                    'video'  => $course->video, 
                    'class'  => 'course-intro-video', 
                    'image'  => $course->image, 
                    'size'   => '780x440'
                ])
            </div>

            <p class="small text-muted mb-4">
                <i class="fas fa-arrow-up me-1"></i> বিস্তারিত জানতে ভিডিওটি দেখুন <i class="fas fa-arrow-up ms-1"></i>
            </p>

            {{-- 3. PRIMARY ENROLL / CTA BUTTON --}}
            @if(!auth()->check() || auth()->user()->user_type == 'student')
                <div class="cart_area text-center mb-3">
                    @if($is_enrolled)
                        <a href="{{ route('my-course', $course->slug) }}" class="mc-btn-primary-cta">
                            {{ __('go_to_course') }} <i class="fal fa-long-arrow-right ms-2"></i>
                        </a>
                    @else
                        <a href="javascript:void(0)" class="mc-btn-primary-cta added_to_cart {{ $is_added_to_cart ? '' : 'd-none' }}">
                            {{ __('added_to_cart') }} <i class="fas fa-check-circle ms-1"></i>
                        </a>
                        <a href="javascript:void(0)" 
                           class="mc-btn-primary-cta add_to_cart {{ $is_added_to_cart ? 'd-none' : '' }}" 
                           data-id="{{ $course->id }}" 
                           data-type="course" 
                           data-quantity="1" 
                           data-route="{{ route('add.cart') }}">
                            রেজিস্ট্রেশন করুন এখনই <i class="fas fa-bolt ms-1"></i>
                        </a>
                    @endif
                </div>
                
                @include('components.frontend_loading_btn', ['class' => 'mc-btn-primary-cta d-none'])

                <div class="mc-seats-counter">
                    <span class="mc-pulse-dot"><span class="ping"></span><span class="dot"></span></span>
                    <span>আর মাত্র <strong class="text-danger fw-bold">৭২ সিট বাকি</strong></span>
                </div>
            @endif
        </div>
    </section>

    {{-- =========================================================
         MAIN STACKED BODY
    ========================================================== --}}
    <section class="py-4">
        <div class="mc-container">

            {{-- =========================================================
                 4. GOLD BORDER MASTERCLASS INFO CARD (100% Admin Sync)
                 Fields: $course->duration, $level->lang_title, $language->name, $course->price, $course->discount_amount
            ========================================================== --}}
            <span class="mc-gold-badge-top">
                এখনই সিট বুক করুন
            </span>
            <div class="mc-gold-info-card">
                <div class="mc-gold-item-row">
                    <div class="mc-gold-icon-circle"><i class="fas fa-video"></i></div>
                    <div>
                        <p class="m-0 fw-bold fs-5 text-dark">Zoom লাইভ মাস্টারক্লাস</p>
                        <small class="text-muted">অনলাইন ইন্টারেক্টিভ সেশন</small>
                    </div>
                </div>

                @if($course->duration)
                    <div class="mc-gold-item-row">
                        <div class="mc-gold-icon-circle"><i class="fas fa-clock"></i></div>
                        <div>
                            <p class="m-0 text-muted small">সময় / সময়সূচী</p>
                            <p class="m-0 fw-bold fs-5 text-dark">{{ $course->duration }}</p>
                        </div>
                    </div>
                @endif

                @if($level)
                    <div class="mc-gold-item-row">
                        <div class="mc-gold-icon-circle"><i class="fas fa-layer-group"></i></div>
                        <div>
                            <p class="m-0 text-muted small">{{ __('level') }}</p>
                            <p class="m-0 fw-bold fs-6 text-dark">{{ $level->lang_title }}</p>
                        </div>
                    </div>
                @endif

                {{-- Price Display --}}
                <div class="mc-gold-price-highlight">
                    <span class="fw-bold fs-5 text-dark d-flex align-items-center gap-2">
                        <span style="width: 12px; height: 12px; border-radius: 50%; background: #fdcc0d; display: inline-block;"></span>
                        আজকের স্পেশাল অফার
                    </span>
                    <span class="fw-bold fs-4 text-success">
                        @if($course->is_free == 1 || $course->price == 0)
                            {{ __('free') }}
                        @elseif($course->is_discountable == 1)
                            {{ get_price($course->discount_amount, userCurrency()) }}
                        @else
                            {{ get_price($course->price, userCurrency()) }}
                        @endif
                    </span>
                </div>

                @if($course->is_discountable == 1 && $course->price > 0)
                    <div class="mc-gold-price-old">
                        <span class="d-flex align-items-center gap-2">
                            <span style="width: 10px; height: 10px; border-radius: 50%; border: 2px solid #cbd5e0; display: inline-block;"></span>
                            মূল প্রাইস
                        </span>
                        <span class="fw-bold text-decoration-line-through">
                            {{ get_price($course->price, userCurrency()) }}
                        </span>
                    </div>
                @endif

                {{-- Dual CTA Button --}}
                @if(!auth()->check() || auth()->user()->user_type == 'student')
                    @if(!$is_enrolled)
                        <div class="text-center mt-4">
                            <a href="#register" class="mc-dual-btn">
                                <span class="mc-dual-left">রেজিস্ট্রেশন করুন এখনই</span>
                                <span class="mc-dual-right">
                                    @if($course->is_discountable == 1)
                                        {{ get_price($course->discount_amount, userCurrency()) }}
                                    @else
                                        {{ get_price($course->price, userCurrency()) }}
                                    @endif
                                    <i class="fas fa-arrow-right ms-1"></i>
                                </span>
                            </a>
                            <div class="mc-seats-counter mt-3">
                                <span class="mc-pulse-dot"><span class="ping"></span><span class="dot"></span></span>
                                <span>আর মাত্র <strong class="text-danger fw-bold">৭২ সিট বাকি</strong></span>
                            </div>
                        </div>
                    @endif
                @endif
            </div>

            {{-- =========================================================
                 5. BENEFITS GRID ("এই মাস্টারক্লাস কার জন্য?")
                 Field: $course->what_will_learn (From Admin Course Edit)
            ========================================================== --}}
            <div class="mc-benefits-card-wrapper">
                <h2 class="fw-bold fs-3 text-dark mb-2">এই মাস্টারক্লাস কার জন্য?</h2>
                <span class="d-block mx-auto mb-4" style="width: 70px; height: 3px; background: #fdcc0d; border-radius: 10px;"></span>

                <div class="row g-3">
                    @php
                        $benefits = [];
                        if(!empty($course->what_will_learn)) {
                            $lines = array_filter(array_map('trim', explode("
", strip_tags($course->what_will_learn))));
                            $benefits = array_values($lines);
                        }
                        if(count($benefits) < 1) {
                            $benefits = [
                                'অনলাইন বিজনেস করতে চান কিন্তু কনফিউজড',
                                'পুঁজি কম নিয়ে বিজনেস শুরু করতে চাচ্ছেন',
                                'ই-কমার্স বিজনেস শুরু করার ভয় আছে',
                                'লস না করে সঠিকভাবে শুরু করতে চান',
                            ];
                        }
                    @endphp

                    @foreach($benefits as $benefit)
                        <div class="col-6 col-md-3">
                            <div class="mc-benefit-single-card">
                                <div class="check-circle"><i class="fas fa-check"></i></div>
                                <p>{{ $benefit }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- =========================================================
                 6. SPECIAL GIFT BANNER CARD
            ========================================================== --}}
            <div class="mc-special-gift-card">
                <span class="mc-gift-pill">
                    🎁 যারা join করবেন তাদের জন্য special gift
                </span>

                <h2 class="fw-bold fs-3 text-dark mb-3">
                    ৳১০,০০০ টাকার Ecom Dropshipping Mastery Course — সম্পূর্ণ FREE করার সুযোগ
                </h2>

                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="fs-5 text-muted text-decoration-line-through">৳১০,০০০</span>
                    <span class="badge bg-danger fs-6 px-3 py-2 rounded-pill">FREE</span>
                </div>

                <p class="text-secondary leading-relaxed fs-6">
                    এই master class-এ যারা join করবেন, তারা আমার ৳১০,০০০ টাকার Ecom Dropshipping Mastery Course টা free তে করার সুযোগ পাবেন। মাস্টারক্লাসে এই বিষয়ে বিস্তারিত আলোচনা।
                </p>

                <div class="mc-callout-quote">
                    "এই কোর্সে আমি ই-কমার্স বিজনেস, ডিজিটাল মার্কেটিং এর বিভিন্ন বিষয় যেমন Facebook Ads, Google Ads নিয়ে বিস্তারিত শিখিয়েছি। এছাড়াও কিভাবে একটা বিজনেসকে Scale করতে তা নিয়ে ক্লাস আছে।"
                </div>

                <p class="small text-muted mb-4">
                    যারা একদম নতুন আছেন তারাও এই কোর্স থেকে বেনিফিটেড হতে পারবে।
                </p>

                <div class="text-center">
                    <a href="#register" class="mc-red-badge-btn">
                        সিট কনফার্ম করুন →
                    </a>
                    <div class="mc-seats-counter mt-3">
                        <span class="mc-pulse-dot"><span class="ping"></span><span class="dot"></span></span>
                        <span>বাকি আছে মাত্র <strong class="text-warning fw-bold">৭২</strong> টা seat</span>
                    </div>
                </div>
            </div>

            {{-- =========================================================
                 7. LIVE ZOOM EXPLAINER & SEATS PROGRESS
            ========================================================== --}}
            <div class="text-center mb-4">
                <span class="badge bg-primary px-3 py-2 rounded-pill fs-7 tracking-wider">LIVE ZOOM MASTERCLASS</span>
                <h2 class="fw-bold fs-3 text-dark mt-3">২ দিনব্যাপী e-commerce live masterclass</h2>
                <p class="text-secondary">
                    ৬ আগস্ট তারিখ রাত ৮ টায় শুরু। Seat সীমিত — বাকি আছে মাত্র <strong class="text-warning fw-bold">৭২</strong> টা।
                </p>
            </div>

            {{-- Progress Bar --}}
            <div class="mc-progress-box">
                <p class="fw-bold m-0 text-dark">
                    ৫০০ seat-এর মধ্যে <span class="text-primary">৪২৮</span>টা বুক হয়ে গেছে — বাকি মাত্র <strong class="text-danger">৭২টা</strong>
                </p>
                <div class="mc-progress-bar-bg">
                    <div class="mc-progress-bar-fill" style="width: 85.6%;"></div>
                </div>
                <div class="d-flex justify-content-between small text-muted">
                    <span>বুক হয়েছে ৪২৮</span>
                    <span>মোট ৫০০ seat</span>
                </div>
            </div>

            {{-- Blue Explainer Box --}}
            <div class="mc-blue-explainer">
                <h3 class="fw-bold fs-5 text-dark mb-3">একটা প্রশ্ন আপনার মাথায় আসতে পারে — এত কিছু, মাত্র ৯৯ টাকায় কেন??</h3>
                <p>টু বি অনেস্ট, আমি এই masterclass-টা সম্পূর্ণ free করাতে চেয়েছিলাম।</p>
                <p>কিন্তু problem হচ্ছে — আমার free session-গুলোতে দেখা যায় কয়েক হাজার মানুষ register করে বা join করে। যেহেতু এই session-টা Zoom-এ live হবে, তাই আমি চাইলেও এখানে বেশি মানুষ নিতে পারব না। Seat limit থাকবে।</p>
                <p>তাই আমি এখানে ছোট্ট একটা token amount রেখেছি — শুধু audience filter করার জন্য। যেন এই masterclass-এ তারাই join করে, যারা সত্যিই e-commerce business শুরু করার ব্যাপারে serious এবং step-by-step process-টা মনোযোগ দিয়ে শিখতে ready।</p>
                <p>যদি এই masterclass-এর actual value অনুযায়ী charge করা হতো, তাহলে এর price কয়েক হাজার টাকা হওয়া উচিত ছিল। কিন্তু আমার goal এখানে টাকা নেওয়া না।</p>
                <p class="fw-bold text-primary m-0">goal হচ্ছে serious মানুষগুলোকে একটা clear guideline দেওয়া।।</p>
            </div>

            {{-- Breakdown Table --}}
            <div class="mc-breakdown-card">
                <h4 class="fw-bold fs-5 text-dark mb-4">এই ৯৯ টাকায় আপনি পাচ্ছেন:</h4>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <tbody>
                            <tr>
                                <td>🎓 ২ দিনের live masterclass — সম্পূর্ণ roadmap সহ</td>
                                <td class="text-end fw-bold">৳৩,০০০</td>
                            </tr>
                            <tr>
                                <td>🎁 Ecom Dropshipping Mastery Course free পাওয়ার সুযোগ</td>
                                <td class="text-end fw-bold">৳১০,০০০</td>
                            </tr>
                            <tr class="border-top border-2">
                                <td class="fw-bold">মোট মূল্য</td>
                                <td class="text-end fw-bold text-decoration-line-through">৳১৩,০০০+</td>
                            </tr>
                            <tr class="table-success">
                                <td class="fw-bold text-success">আজকের মূল্য (token)</td>
                                <td class="text-end fw-black fs-4 text-success">
                                    @if($course->is_discountable == 1)
                                        {{ get_price($course->discount_amount, userCurrency()) }}
                                    @else
                                        {{ get_price($course->price, userCurrency()) }}
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- =========================================================
                 8. COURSE FULL DESCRIPTION (100% Admin WYSIWYG Editor Sync)
                 Field: $course->description (Admin Edit Rich Text Editor)
            ========================================================== --}}
            @if($course->description)
                <div class="mc-content-card">
                    <h4 class="fw-bold fs-4 text-dark mb-3 pb-2 border-bottom">{{ __('about_this_course') }}</h4>
                    <div class="description-body text-secondary leading-relaxed fs-6">
                        {!! $course->description !!}
                    </div>
                </div>
            @endif

            {{-- =========================================================
                 9. COURSE SYLLABUS / CURRICULUM ACCORDION (100% Admin Sync)
                 Fields: $sections, $lessons (Admin Curriculum Builder)
            ========================================================== --}}
            @if(setting('hide_curriculum_from_course_details') != '1' && count($sections) > 0)
                <div class="mc-content-card">
                    <h4 class="fw-bold fs-4 text-dark mb-4 pb-2 border-bottom">{{ __('course_syllabus') }}</h4>
                    
                    @if($hasEnrolled)
                        <div class="bg-light p-3 rounded-3 mb-4 border">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold small text-dark">{{ __('your_progress') }}</span>
                                <span class="fw-bold small text-success">{{ $hasEnrolled->complete_count }}% {{ __('done') }}</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $hasEnrolled->complete_count }}%;"></div>
                            </div>
                        </div>
                    @endif

                    <div class="accordion mc-faq-accordion accordion-flush" id="curriculumAccordion">
                        @foreach($sections as $key => $section)
                            <div class="accordion-item">
                                <div class="accordion-header" id="course-curriculum-heading{{ $key }}">
                                    <div class="accordion-button {{ $key == 0 && (count($lessons->where('section_id', $section->id)) > 0 || count($section->quizzes) > 0) ? '' : 'collapsed' }}"
                                         role="button" 
                                         data-bs-toggle="collapse" 
                                         data-bs-target="#course-curriculum-collapse{{ $key }}"
                                         {{ $key == 0 && (count($lessons->where('section_id', $section->id)) > 0 || count($section->quizzes) > 0) ? 'aria-expanded="true"' : 'aria-expanded="false"' }}
                                         aria-controls="course-curriculum-collapse{{ $key }}">
                                        <i class="fal fa-book-open me-2 text-warning"></i> {{ $section->title }}
                                    </div>
                                </div>
                                <div id="course-curriculum-collapse{{ $key }}"
                                     class="accordion-collapse collapse {{ $key == 0 && (count($lessons->where('section_id', $section->id)) > 0 || count($section->quizzes) > 0) ? 'show' : '' }}"
                                     aria-labelledby="course-curriculum-heading{{ $key }}" 
                                     data-bs-parent="#curriculumAccordion">
                                    <div class="accordion-body">
                                        @if(count($lessons) > 0)
                                            <div class="course-playlist">
                                                <ul class="list-unstyled mb-0">
                                                    @foreach($lessons->where('section_id', $section->id) as $k => $lesson)
                                                        <li class="py-2 border-bottom">
                                                            <a href="#" 
                                                               class="d-flex align-items-center justify-content-between text-dark text-decoration-none {{ $lesson->is_free == 1 ? 'player-src' : '' }}"
                                                               @if($lesson->is_free == 1)
                                                                   data-poster="{{ $lesson->image ? getFileLink('402x238', $lesson->image) : ($course->image ? getFileLink('402x248', $course->image) : '') }}"
                                                                   data-type="{{ $lesson->lesson_type }}" 
                                                                   data-source="{{ $lesson->source }}"
                                                                   data-video="{{ getVideoId($lesson->source, $lesson->source_data) }}"
                                                               @endif>
                                                                <div class="d-flex align-items-center gap-2">
                                                                    @if($lesson->lesson_type == 'video')
                                                                        <i class="fal fa-play-circle text-primary"></i>
                                                                    @elseif($lesson->lesson_type == 'audio')
                                                                        <i class="fal fa-microphone text-primary"></i>
                                                                    @else
                                                                        <i class="fal fa-file-alt text-primary"></i>
                                                                    @endif
                                                                    
                                                                    <span class="fw-medium text-dark">{{ $lesson->title }}</span>
                                                                    
                                                                    @if($lesson->is_free == 1)
                                                                        <span class="badge bg-success ms-2">{{ __('free') }}</span>
                                                                    @endif
                                                                </div>
                                                                <span class="small text-muted">{{ $lesson->duration }}</span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- =========================================================
                 10. REGISTRATION ORDER FORM SECTION (`#register`)
            ========================================================== --}}
            @if(!auth()->check() || auth()->user()->user_type == 'student')
                @if(!$is_enrolled)
                    <div id="register" class="mc-form-wrapper">
                        <h2 class="text-center fw-bold fs-3 text-dark mb-2">
                            মাস্টারক্লাসে জয়েন করতে নিচের<br>
                            <span class="text-primary">ফর্মটি পূরণ করুন</span>
                        </h2>
                        
                        <p class="text-center text-muted small mb-4">Give valid information</p>

                        <form action="{{ route('add.cart') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $course->id }}">
                            <input type="hidden" name="type" value="course">
                            <input type="hidden" name="quantity" value="1">

                            <div class="mb-3">
                                <label class="fw-semibold text-dark mb-1">Your Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="mc-form-input" placeholder="আপনার সম্পূর্ণ নাম" required>
                            </div>

                            <div class="mb-3">
                                <label class="fw-semibold text-dark mb-1">Mobile Number <span class="text-danger">*</span></label>
                                <input type="tel" name="phone" class="mc-form-input" placeholder="01XXXXXXXXX" required>
                            </div>

                            <div class="mb-3">
                                <label class="fw-semibold text-dark mb-1">Email address <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="mc-form-input" placeholder="আপনার ইমেইল এড্রেস" required>
                            </div>

                            <div class="mc-breakdown-card border-0 bg-white p-3 mb-4">
                                <p class="fw-bold text-dark mb-2">Your order</p>
                                <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-3">
                                    <span class="fw-bold text-dark">{{ $course->title }}</span>
                                    <span class="fw-bold text-success fs-5">
                                        @if($course->is_discountable == 1)
                                            {{ get_price($course->discount_amount, userCurrency()) }}
                                        @else
                                            {{ get_price($course->price, userCurrency()) }}
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <p class="small text-muted mb-4">
                                Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.
                            </p>

                            <button type="submit" class="mc-btn-primary-cta w-100 py-3 border-0">
                                PAY NOW <i class="fas fa-lock ms-2"></i>
                            </button>
                        </form>
                    </div>
                @endif
            @endif

            {{-- =========================================================
                 11. FAQ ACCORDION SECTION (100% Admin Sync)
                 Field: $faqs (From Admin Course Edit -> FAQ tab)
            ========================================================== --}}
            @if(setting('hide_faq_from_course_details') != '1')
                <div class="mb-5">
                    <h2 class="text-center fw-bold fs-3 text-dark mb-2">কিছু সাধারণ প্রশ্নের উত্তর</h2>
                    <span class="d-block mx-auto mb-4" style="width: 70px; height: 3px; background: #fdcc0d; border-radius: 10px;"></span>

                    @php
                        $displayFaqs = count($faqs) > 0 ? $faqs : [
                            (object)['question' => 'লাইভ ক্লাসে কিভাবে যুক্ত হবো?', 'answer' => 'আপনি পেমেন্ট করার পর আপনাকে আমাদের একটা প্রাইভেট গ্রুপে জয়েন করানো হবে, এবং যেদিন লাইভ ক্লাসগুলো হবে সেদিন আপনাকে জুমের লিংক শেয়ার করা হবে'],
                            (object)['question' => 'লাইভ ক্লাসগুলো কত ঘন্টার হবে?', 'answer' => 'এইটা সঠিক ভাবে বলা যাচ্ছে না, যে টাইম দেয়া আছে ঠিক সেই সময়েই শুরু হবে কিন্তু শেষ হবে আপনাদের ইচ্ছায়। যতক্ষণ আপনাদের প্রয়োজন আমি লাইভে থাকবো ইনশাআল্লাহ্'],
                            (object)['question' => 'মাষ্টার ক্লাসটিতে ডিস্কাউন্ট দেয়া যাবে না?', 'answer' => 'বর্তমানে বিশাল ডিস্কাউন্ট দেয়া আছে তবে প্রতিনিয়ত প্রোগ্রামটির মূল্য কিছু কিছু করে বাড়ানো হবে। তাই যত দ্রুত যুক্ত হবেন তত বেশি আপনারই লাভ।'],
                            (object)['question' => 'লাইভ ক্লাসের কি কোন রেকর্ড দেয়া হবে?', 'answer' => 'এখনো পর্যন্ত আমরা লাইভ ক্লাসের রেকর্ড দেয়ার কথা চিন্তা করছি না, তবে ভবিষ্যতে প্রয়োজন ভেদে আমরা রেকর্ড ভার্সন দেয়ার কথা চিন্তা করে দেখবো। তবে যারা সত্যিকার অর্থেই সিরিয়াস তারা লাইভ ক্লাসে জয়েন করবেই।'],
                            (object)['question' => 'আপনাদের নেক্সট লাইভ মাষ্টারক্লাস কবে হবে', 'answer' => 'আমরা আপাতত আর লাইভ মাষ্টারক্লাস করানো কোন প্ল্যান রাখছি না, এইবারই লাস্ট। তাই সময় ম্যানেজ করে এইবারই যুক্ত হোন, যত দেরি করবেন শিখতে তত পিছিয়ে পড়বেন'],
                        ];
                    @endphp

                    <div class="accordion mc-faq-accordion accordion-flush mt-4" id="faqAccordion">
                        @foreach($displayFaqs as $key => $faq)
                            <div class="accordion-item">
                                <div class="accordion-header" id="course-faq-heading{{ $key }}">
                                    <div class="accordion-button {{ $key == 0 ? '' : 'collapsed' }}" 
                                         role="button" 
                                         data-bs-toggle="collapse" 
                                         data-bs-target="#course-faq-collapse{{ $key }}"
                                         aria-expanded="{{ $key == 0 ? 'true' : 'false' }}" 
                                         aria-controls="course-faq-collapse{{ $key }}">
                                        {{ $faq->question }}
                                    </div>
                                </div>
                                <div id="course-faq-collapse{{ $key }}" 
                                     class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}" 
                                     aria-labelledby="course-faq-heading{{ $key }}" 
                                     data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        {!! $faq->answer !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Bottom Dual CTA --}}
                    @if(!auth()->check() || auth()->user()->user_type == 'student')
                        @if(!$is_enrolled)
                            <div class="text-center mt-5">
                                <a href="#register" class="mc-dual-btn">
                                    <span class="mc-dual-left">রেজিস্ট্রেশন করুন এখনই</span>
                                    <span class="mc-dual-right">
                                        @if($course->is_discountable == 1)
                                            {{ get_price($course->discount_amount, userCurrency()) }}
                                        @else
                                            {{ get_price($course->price, userCurrency()) }}
                                        @endif
                                        <i class="fas fa-arrow-right ms-1"></i>
                                    </span>
                                </a>
                                <div class="mc-seats-counter mt-3">
                                    <span class="mc-pulse-dot"><span class="ping"></span><span class="dot"></span></span>
                                    <span>আর মাত্র <strong class="text-danger fw-bold">৭২ সিট বাকি</strong></span>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            @endif

            {{-- =========================================================
                 12. REVIEWS SECTION
            ========================================================== --}}
            @if(setting('hide_review_from_course_details') != '1' && $course->total_rating > 0)
                <div class="mc-content-card">
                    <h4 class="fw-bold fs-4 text-dark mb-4 pb-2 border-bottom">{{ __('reviews') }}</h4>
                    
                    <div class="mc-review-summary">
                        <div class="mc-rating-big text-center">
                            <div class="num fs-1 fw-bold text-dark">{{ round($course->total_rating, 1) }}</div>
                            <div class="mc-rating-stars fs-6 my-1 text-warning">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="{{ $i <= round($course->total_rating) ? 'fas' : 'fal' }} fa-star"></i>
                                @endfor
                            </div>
                            <small class="text-muted">{{ __('out_of_5') }}</small>
                        </div>
                        
                        <div class="mc-rating-bars flex-grow-1">
                            @foreach([5 => 'five_star', 4 => 'four_star', 3 => 'three_star', 2 => 'two_star', 1 => 'one_star'] as $starCount => $starKey)
                                <div class="d-flex align-items-center gap-2 mb-1 fs-7">
                                    <span class="stars text-warning me-1">
                                        @for($s = 1; $s <= 5; $s++)
                                            <i class="{{ $s <= $starCount ? 'fas' : 'fal' }} fa-star"></i>
                                        @endfor
                                    </span>
                                    <div class="progress flex-grow-1" style="height: 8px;">
                                        <div class="progress-bar bg-warning" style="width: {{ $ratings[$starKey] }}%;"></div>
                                    </div>
                                    <span class="pct text-muted ms-1">{{ $ratings[$starKey] }}%</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @if(setting('disable_write_review') != '1' && $can_review)
                        <div class="mc-review-form pt-4 border-top" id="comment-respond">
                            <h5 class="fw-bold mb-3 text-dark">{{ __('Write_a_review') }}</h5>
                            <div class="rating-review rating_comment mb-3 all-rating"></div>
                            <span class="live-rating"></span>
                            
                            <form action="{{ route('store.comment') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <textarea name="comment" class="form-control rounded-3" rows="4" placeholder="{{ __('write_your_review') ?? 'Write your review...' }}"></textarea>
                                    <input type="hidden" name="id" value="{{ $course->id }}">
                                    <input type="hidden" name="slug" value="{{ $course->slug }}">
                                    <input type="hidden" name="type" value="course">
                                    <input type="hidden" name="rating" class="give_rating">
                                </div>
                                <button type="submit" class="mc-btn-primary-cta d-inline-block w-auto px-4 py-2 fs-6">
                                    {{ __('post_review') }}
                                </button>
                            </form>
                        </div>
                    @endif

                    @if(count($reviews) > 0)
                        <ul class="comments-list mt-4 list-unstyled">
                            @foreach($reviews as $review)
                                @include('frontend.review_component')
                            @endforeach
                        </ul>
                        
                        @if($reviews->nextPageUrl())
                            <div class="less-more mt-4 text-center">
                                <button class="btn btn-outline-primary rounded-pill px-4 less-more-btn" 
                                        data-page="{{ $reviews->currentPage() }}" 
                                        data-url="{{ route('load.reviews') }}">
                                    {{ __('see_more') }}
                                </button>
                                @include('components.frontend_loading_btn', ['class' => 'btn'])
                            </div>
                        @endif
                    @endif
                </div>
            @endif

        </div>
    </section>

</div>

<input type="hidden" class="text_copied" value="{{ __('text_copied') }}">
<input type="hidden" class="text_copied_fail" value="{{ __('text_copied_fail') }}">

{{-- =========================================================
     13. RELATED COURSES SECTION
========================================================== --}}
@if(setting('disable_related_course_from_course_details') != '1' && count($related_courses) > 0)
    <section class="bg-light py-5 border-top">
        <div class="container container-1278">
            <div class="row justify-content-center mb-4">
                <div class="col-lg-6 text-center">
                    <h3 class="fw-extrabold text-dark">{{ __('related_course') }}</h3>
                    <p class="text-muted">{{ __('Lorem Ipsum is not the simply random text') }}</p>
                </div>
            </div>
            
            <div class="course-items-wrap">
                <div class="row course-items-v3 course-slider" dir="{{ systemLanguage() ? systemLanguage()->text_direction : 'ltr' }}">
                    @foreach($related_courses as $key => $course)
                        @include('frontend.course.component', ['col' => 'col-lg-4'])
                    @endforeach
                </div>
                
                @if(!$related_courses->nextPageUrl())
                    <div class="text-center mt-4">
                        <a class="btn btn-outline-success rounded-pill px-4" href="{{ route('courses', ['category_ids' => $course->category_id]) }}">
                            {{ __('see_more') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif

@endsection

@push('css')
    <link rel="stylesheet" href="{{ static_asset('frontend/css/star-rating-svg.css') }}">
@endpush

@push('js')
    <script src="{{ static_asset('frontend/js/jquery.star-rating-svg.js') }}"></script>
    <script>
        $(document).ready(function () {
            initiateRating();
            let player = new Plyr('.yt_player');
            
            $(".rating_comment").starRating({
                totalStars: 5,
                starShape: 'rounded',
                activeColor: 'salmon',
                starSize: 20,
                emptyColor: 'lightgray',
                hoverColor: '#fdcc0d',
                initialRating: 1,
                strokeWidth: 0,
                useGradient: false,
                disableAfterRate: false,
                minRating: 1,
                useFullStars: true,
                onHover: function (currentIndex, currentRating, $el) {
                    $('.live-rating').text(currentIndex);
                },
                onLeave: function (currentIndex, currentRating, $el) {
                    $('.live-rating').text(currentRating);
                },
                callback: function (currentRating, $el) {
                    $('.give_rating').val(currentRating);
                }
            });

            $(document).on('click', '.less-more-btn', function () {
                let that = this;
                let page = parseInt($(this).data('page')) + 1;
                let url = $(this).data('url');
                let selector = $(this).closest('.less-more');
                $(that).addClass('d-none');
                $(selector).find('.loading_button').removeClass('d-none');
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        page: page,
                        id: '{{ $id }}',
                        type: 'course'
                    },
                    success: function (data) {
                        if (data.success) {
                            $('.comments-list').append(data.html);
                        } else {
                            toastr.error(data.error);
                        }
                        $(that).data('page', page);
                        initiateRating();
                        if (data.next_page_url) {
                            selector.find('.loading_button').addClass('d-none');
                            $(that).removeClass('d-none');
                        } else {
                            selector.find('.loading_button').addClass('d-none');
                            $(that).addClass('d-none');
                        }
                    }
                });
            });

            $(document).on("click", ".copy_text", function () {
                let text = $(this).data("text");
                let success_txt = $(".text_copied").val();
                let error_txt = $(".text_copied_fail").val();
                navigator.clipboard
                    .writeText(text)
                    .then(() => {
                        toastr["success"](success_txt);
                    })
                    .catch((err) => {
                        toastr["error"](error_txt + ": ", err);
                    });
            });

            $(document).on('click', '.player-src', function () {
                let provider = $(this).data("source");
                let video = $(this).data("video");
                let type = $(this).data("type");
                let poster = $(this).data("poster");

                if (provider == 'upload' || provider == 'mp4') {
                    player.source = {
                        type: type,
                        title: 'Example title',
                        sources: [
                            {
                                src: video,
                                type: 'video/mp4',
                                size: 720,
                            }
                        ],
                        poster: poster,
                    };
                } else {
                    player.source = {
                        type: type,
                        poster: poster,
                        sources: [
                            {
                                src: video,
                                provider: provider,
                            },
                        ],
                    };
                }
                player.on('ready', (event) => {
                    player.play();
                });
            });
        });

        function initiateRating() {
            $(".review_list").starRating({
                starShape: 'rounded',
                starSize: 20,
                readOnly: true,
                activeColor: '#fdcc0d',
                useGradient: false
            });
        }
    </script>
@endpush
