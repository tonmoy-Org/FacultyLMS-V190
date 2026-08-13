@extends('frontend.layouts.master')
@section('title', $course->title)
@section('content')

@push('css')
    <link rel="stylesheet" href="{{ static_asset('frontend/css/masterclass.css') }}">
@endpush

@php
    $mcSettings = $course->masterclass_settings ?? [];
    $eyebrowTitle = !empty($mcSettings['eyebrow_title']) ? $mcSettings['eyebrow_title'] : ($category ? $category->lang_title : 'E-commerce শুরু করার hidden path');
    $classScheduleTitle = !empty($mcSettings['class_schedule_title']) ? $mcSettings['class_schedule_title'] : '২ দিনব্যাপী e-commerce live masterclass';
    $classScheduleTime = !empty($mcSettings['class_schedule_time']) ? $mcSettings['class_schedule_time'] : '৬ আগস্ট তারিখ রাত ৮ টায় শুরু';
    $videoCaption = !empty($mcSettings['video_caption']) ? $mcSettings['video_caption'] : 'বিস্তারিত জানতে ভিডিওটি দেখুন';
    $goldBadgeTop = !empty($mcSettings['gold_badge_top']) ? $mcSettings['gold_badge_top'] : 'এখনই সিট বুক করুন';
    $scheduleBadge = !empty($mcSettings['schedule_badge']) ? $mcSettings['schedule_badge'] : 'LIVE ZOOM MASTERCLASS';
    $dualCtaLeft = !empty($mcSettings['dual_cta_left']) ? $mcSettings['dual_cta_left'] : 'রেজিস্ট্রেশন করুন এখনই';
    
    $totalCapacity = !empty($mcSettings['remaining_seats']) && is_numeric($mcSettings['remaining_seats']) 
        ? (int)$mcSettings['remaining_seats'] 
        : ($course->capacity > 0 ? $course->capacity : 100);
    $totalEnrolled = (int)$course->total_enrolled;
    $remainingSeats = max(0, $totalCapacity - $totalEnrolled);
    $progressPercent = min(100, round(($totalEnrolled / max(1, $totalCapacity)) * 100, 1));
    
    if (!empty($mcSettings['dual_cta_seats'])) {
        $dualCtaSeats = preg_match('/\d+/', $mcSettings['dual_cta_seats'])
            ? preg_replace('/\d+/', $remainingSeats, $mcSettings['dual_cta_seats'])
            : $mcSettings['dual_cta_seats'];
    } else {
        $dualCtaSeats = 'আর মাত্র ' . $remainingSeats . ' সিট বাকি';
    }

    $benefitsTitle = !empty($mcSettings['benefits_title']) ? $mcSettings['benefits_title'] : 'এই মাস্টারক্লাস কার জন্য?';
    $orderFormTitle = !empty($mcSettings['order_form_title']) ? $mcSettings['order_form_title'] : 'মাস্টারক্লাসে জয়েন করতে নিচের<br><span class="text-primary">ফর্মটি পূরণ করুন</span>';
    $orderFormSubtitle = !empty($mcSettings['order_form_subtitle']) ? $mcSettings['order_form_subtitle'] : 'Give valid information';
    $faqTitle = !empty($mcSettings['faq_title']) ? $mcSettings['faq_title'] : 'কিছু সাধারণ প্রশ্নের উত্তর';

    $zoomTitle = !empty($mcSettings['zoom_title']) ? $mcSettings['zoom_title'] : 'Zoom লাইভ 104';
    $zoomSubtitle = !empty($mcSettings['zoom_subtitle']) ? $mcSettings['zoom_subtitle'] : 'অনলাইন ইন্টারেক্টিভ সেশন';
    $goldOfferTitle = !empty($mcSettings['gold_offer_title']) ? $mcSettings['gold_offer_title'] : 'আজকের স্পেশাল অফার';
    $primaryCtaText = !empty($mcSettings['primary_cta_text']) ? $mcSettings['primary_cta_text'] : 'রেজিস্ট্রেশন করুন এখনই';
    $scheduleValue = !empty($mcSettings['schedule_value']) ? $mcSettings['schedule_value'] : (!empty($course->duration) ? $course->duration : '2h 40min');
    $levelLabel = !empty($mcSettings['level_label']) ? $mcSettings['level_label'] : __('level');
    $levelValue = !empty($mcSettings['level_value']) ? $mcSettings['level_value'] : ($level ? $level->lang_title : 'beginner');
    $goldCtaText = !empty($mcSettings['gold_cta_text']) ? $mcSettings['gold_cta_text'] : 'এখনই জয়েন করুন';
    
    if (!empty($mcSettings['gold_seats_text'])) {
        $goldSeatsText = preg_match('/\d+/', $mcSettings['gold_seats_text'])
            ? preg_replace('/\d+/', $remainingSeats, $mcSettings['gold_seats_text'])
            : $mcSettings['gold_seats_text'];
    } else {
        $goldSeatsText = 'আর মাত্র ' . $remainingSeats . ' সিট বাকি';
    }

    $hideSpecialGift = !empty($mcSettings['hide_special_gift']);
    $hideExplainer = !empty($mcSettings['hide_explainer']);
    $hideBreakdown = !empty($mcSettings['hide_breakdown']);
    $hideReviews = !empty($mcSettings['hide_reviews']);
    $hideRelated = !empty($mcSettings['hide_related_courses']);
    $hideOverviewSection = !empty($mcSettings['hide_overview_section']);

    $overviewTag = !empty($mcSettings['overview_tag']) ? $mcSettings['overview_tag'] : 'FEATURED COURSE';
    $overviewTitle = !empty($mcSettings['overview_title']) ? $mcSettings['overview_title'] : 'Master Your Skills With Expert Guidance';
    $overviewDesc1 = !empty($mcSettings['overview_desc1']) ? $mcSettings['overview_desc1'] : 'Join our comprehensive single course program designed to take you from beginner to advanced level with real-world projects and direct mentor support.';
    $overviewDesc2 = !empty($mcSettings['overview_desc2']) ? $mcSettings['overview_desc2'] : 'Get lifetime access to premium curriculum, practical assignments, downloadable resources, and a verified completion certificate.';
    $overviewBtnText = !empty($mcSettings['overview_btn_text']) ? $mcSettings['overview_btn_text'] : 'ENROLL NOW';
    $overviewBtnUrl = !empty($mcSettings['overview_btn_url']) ? $mcSettings['overview_btn_url'] : '#register';
    $overviewImageUrl = !empty($mcSettings['overview_image_url']) ? $mcSettings['overview_image_url'] : ($course->image ? getFileLink('original_image', $course->image) : 'https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=1200&auto=format&fit=crop');

    $giftBadge = !empty($mcSettings['gift_badge']) ? $mcSettings['gift_badge'] : '🎁 যারা join করবেন তাদের জন্য special gift';
    $giftTitle = !empty($mcSettings['gift_title']) ? $mcSettings['gift_title'] : '৳১০,০০০ টাকার Ecom Dropshipping Mastery Course — সম্পূর্ণ FREE করার সুযোগ';
    $giftValue = !empty($mcSettings['gift_value']) ? $mcSettings['gift_value'] : '৳১০,০০০';
    $giftDescription = !empty($mcSettings['gift_description']) ? $mcSettings['gift_description'] : 'এই master class-এ যারা join করবেন, তারা আমার ৳১০,০০০ টাকার Ecom Dropshipping Mastery Course টা free তে করার সুযোগ পাবেন। মাস্টারক্লাসে এই বিষয়ে বিস্তারিত আলোচনা।';
    $giftQuote = !empty($mcSettings['gift_quote']) ? $mcSettings['gift_quote'] : '"এই কোর্সে আমি ই-কমার্স বিজনেস, ডিজিটাল মার্কেটিং এর বিভিন্ন বিষয় যেমন Facebook Ads, Google Ads নিয়ে বিস্তারিত শিখিয়েছি। এছাড়াও কিভাবে একটা বিজনেসকে Scale করতে তা নিয়ে ক্লাস আছে।"';
    $giftFooterNote = !empty($mcSettings['gift_footer_note']) ? $mcSettings['gift_footer_note'] : 'যারা একদম নতুন আছেন তারাও এই কোর্স থেকে বেনিফিটেড হতে পারবে।';
    $giftCtaText = !empty($mcSettings['gift_cta_text']) ? $mcSettings['gift_cta_text'] : 'সিট কনফার্ম করুন →';
    if (!empty($mcSettings['gift_seats_text'])) {
        $giftSeatsText = preg_match('/\d+/', $mcSettings['gift_seats_text'])
            ? preg_replace('/\d+/', $remainingSeats, $mcSettings['gift_seats_text'])
            : $mcSettings['gift_seats_text'];
    } else {
        $giftSeatsText = 'বাকি আছে মাত্র ' . $remainingSeats . ' টা seat';
    }

    $explainerTitle = !empty($mcSettings['explainer_title']) ? $mcSettings['explainer_title'] : 'একটা প্রশ্ন আপনার মাথায় আসতে পারে — এত কিছু, মাত্র ৯৯ টাকায় কেন??';
    $explainerText = !empty($mcSettings['explainer_text']) ? $mcSettings['explainer_text'] : null;
    $breakdownSubheading = !empty($mcSettings['breakdown_subheading']) ? $mcSettings['breakdown_subheading'] : null;
    $breakdownItemsRaw = !empty($mcSettings['breakdown_items']) ? $mcSettings['breakdown_items'] : null;
    $breakdownTodayTitle = !empty($mcSettings['breakdown_today_title']) ? $mcSettings['breakdown_today_title'] : 'আজকের মূল্য (token)';
    $originalPriceLabel = !empty($mcSettings['original_price_label']) ? $mcSettings['original_price_label'] : 'মূল প্রাইস';
    $scheduleLabel = !empty($mcSettings['schedule_label']) ? $mcSettings['schedule_label'] : 'সময় / সময়সূচী';

    $nameLabel = !empty($mcSettings['name_label']) ? $mcSettings['name_label'] : 'Your Full Name';
    $namePlaceholder = !empty($mcSettings['name_placeholder']) ? $mcSettings['name_placeholder'] : 'আপনার সম্পূর্ণ নাম';
    $phoneLabel = !empty($mcSettings['phone_label']) ? $mcSettings['phone_label'] : 'Mobile Number';
    $phonePlaceholder = !empty($mcSettings['phone_placeholder']) ? $mcSettings['phone_placeholder'] : '01XXXXXXXXX';
    $emailLabel = !empty($mcSettings['email_label']) ? $mcSettings['email_label'] : 'Email address';
    $emailPlaceholder = !empty($mcSettings['email_placeholder']) ? $mcSettings['email_placeholder'] : 'আপনার ইমেইল এড্রেস';
    $orderSummaryTitle = !empty($mcSettings['order_summary_title']) ? $mcSettings['order_summary_title'] : 'Your order';
    $privacyNotice = !empty($mcSettings['privacy_notice']) ? $mcSettings['privacy_notice'] : 'Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.';
    $payNowBtnText = !empty($mcSettings['pay_now_btn_text']) ? $mcSettings['pay_now_btn_text'] : 'PAY NOW';

    $supportStatus = !empty($mcSettings['support_status']);
    $supportTitle = !empty($mcSettings['support_title']) ? $mcSettings['support_title'] : 'আর সাপোর্ট?';
    $supportDescription = !empty($mcSettings['support_description']) ? $mcSettings['support_description'] : '<p>কোর্সের টপিক রিলেটেড যেকোনো প্রবলেম ফেস করলে সরাসরি সাপোর্ট ফোরাম অথবা আমাদের মেন্টর টিম থেকে ইনস্ট্যান্ট হেল্প পাবেন। লাইভ সাপোর্ট সেশনের মাধ্যমে যেকোনো টেকনিক্যাল প্রবলেম ওয়ান টু ওয়ান সলভ করে দেওয়া হবে।</p><p>এই সাপোর্ট আমাদের টিম মেম্বারদের পক্ষে সরাসরি প্রোভাইড করা হচ্ছে, যাতে করে আপনি ফেস করা যেকোনো সমস্যার দ্রুততম সময়ে নিখুঁত সমাধান পেতে পারেন।</p>';
    $supportImageUrl = !empty($mcSettings['support_image_url']) ? $mcSettings['support_image_url'] : null;

    $breakdownRows = [];
    if (!empty($breakdownItemsRaw)) {
        $cleanItems = str_replace(['</p>', '<br>', '<br/>', '<br />'], "\n", $breakdownItemsRaw);
        $cleanItems = strip_tags($cleanItems);
        $lines = array_filter(array_map('trim', explode("\n", $cleanItems)));
        foreach ($lines as $line) {
            $parts = explode('|', $line);
            $breakdownRows[] = [
                'title' => trim($parts[0] ?? ''),
                'val' => trim($parts[1] ?? '')
            ];
        }
    }
    if (empty($breakdownRows)) {
        $breakdownRows = [
            ['title' => '🎓 ২ দিনের live masterclass — সম্পূর্ণ roadmap সহ', 'val' => '৳৩,০০০'],
            ['title' => '🎁 Ecom Dropshipping Mastery Course free পাওয়ার সুযোগ', 'val' => '৳১০,০০০']
        ];
    }
@endphp

<div class="masterclass-page-wrapper">

    {{-- =========================================================
         1. HERO HEADER SECTION (100% Admin Panel Sync)
         Fields from Admin: $course->title, $course->short_description, $course->category
    ========================================================== --}}
    <section class="mc-hero-header">
        <div class="mc-container">
            <span class="mc-eyebrow-badge">{{ $eyebrowTitle }}</span>

            {{-- Main Title --}}
            <h1 class="mc-main-title">{{ $course->title }}</h1>

            {{-- Short Description --}}
            <p class="mc-sub-title">{{ !empty($course->short_description) ? $course->short_description : 'E-commerce বিজনেস সফলভাবে পরিচালনা করার জন্য ২ দিনব্যাপী জুম লাইভ মাস্টারক্লাস। সকল গাইডলাইন ও প্র্যাকটিক্যাল গাইড পাওয়ার জন্য আজই জয়েন করুন।' }}</p>

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



            {{-- 3. PRIMARY ENROLL / CTA BUTTON --}}
            @if(!auth()->check() || auth()->user()->user_type == 'student')
                <div class="cart_area text-center mb-3">
                    @if($is_enrolled)
                        <a href="{{ route('my-course', $course->slug) }}" class="template-btn">
                            {{ __('go_to_course') }} <i class="fal fa-long-arrow-right ms-2"></i>
                        </a>
                    @else
                        <a href="javascript:void(0)" class="template-btn added_to_cart {{ $is_added_to_cart ? '' : 'd-none' }}">
                            {{ __('added_to_cart') }} <i class="fas fa-check-circle ms-1"></i>
                        </a>
                        <a href="javascript:void(0)" 
                           class="template-btn add_to_cart {{ $is_added_to_cart ? 'd-none' : '' }}" 
                           data-id="{{ $course->id }}" 
                           data-type="course" 
                           data-quantity="1" 
                           data-route="{{ route('add.cart') }}">
                            {{ $primaryCtaText }} <i class="fas fa-bolt ms-1"></i>
                        </a>
                    @endif
                </div>
                
                @include('components.frontend_loading_btn', ['class' => 'template-btn d-none'])

                <div class="mc-seats-counter">
                    <span class="mc-pulse-dot"><span class="ping"></span><span class="dot"></span></span>
                    <span>আর মাত্র <strong class="text-danger fw-bold">{{ $remainingSeats }} সিট বাকি</strong></span>
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
                 7. LIVE ZOOM EXPLAINER & SEATS PROGRESS
            ========================================================== --}}
            <div class="mc-zoom-explainer-section">
                <div class="text-center mb-0">
                    <span class="badge px-3 py-2 rounded-pill fs-7 tracking-wider" style="background-color: #10b981; color: #fff;">LIVE ZOOM MASTERCLASS</span>
                    <h2 class="fw-bold course-section-title text-dark mt-3">{{ $classScheduleTitle }}</h2>
                    <p class="text-secondary mb-0">
                        {{ $classScheduleTime }}। Seat সীমিত — বাকি আছে মাত্র <strong class="text-warning fw-bold">{{ $remainingSeats }}</strong> টা।
                    </p>
                </div>
            </div>

            {{-- Blue Explainer Box --}}
            @if(!$hideExplainer)
                <div class="mc-blue-explainer">
                    <h3 class="fw-bold fs-5 text-dark mb-3">{{ $explainerTitle }}</h3>
                    @if($explainerText)
                        {!! $explainerText !!}
                    @else
                        <p>টু বি অনেস্ট, আমি এই masterclass-টা সম্পূর্ণ free করাতে চেয়েছিলাম।</p>
                        <p>কিন্তু problem হচ্ছে — আমার free session-গুলোতে দেখা যায় কয়েক হাজার মানুষ register করে বা join করে। যেহেতু এই session-টা Zoom-এ live হবে, তাই আমি চাইলেও এখানে বেশি মানুষ নিতে পারব না। Seat limit থাকবে।</p>
                        <p>তাই আমি এখানে ছোট্ট একটা token amount রেখেছি — শুধু audience filter করার জন্য। যেন এই masterclass-এ তারাই join করে, যারা সত্যিই e-commerce business শুরু করার ব্যাপারে serious এবং step-by-step process-টা মনোযোগ দিয়ে শিখতে ready।</p>
                        <p>যদি এই masterclass-এর actual value অনুযায়ী charge করা হতো, তাহলে এর price কয়েক হাজার টাকা হওয়া উচিত ছিল। কিন্তু আমার goal এখানে টাকা নেওয়া না।</p>
                        <p class="fw-bold text-primary m-0">goal হচ্ছে serious মানুষগুলোকে একটা clear guideline দেওয়া।।</p>
                    @endif
                </div>
            @endif

            {{-- =========================================================
                 4. GOLD BORDER MASTERCLASS INFO CARD (100% Admin Sync)
                 Fields: $course->duration, $level->lang_title, $language->name, $course->price, $course->discount_amount
            ========================================================== --}}
            <div class="mc-gold-info-card">
                @php
                    $goldInfoPointsList = !empty($mcSettings['gold_info_points']) && is_array($mcSettings['gold_info_points']) 
                        ? $mcSettings['gold_info_points'] 
                        : [
                            ['icon' => 'fas fa-video', 'title' => $zoomTitle, 'value' => $zoomSubtitle],
                            ['icon' => 'fas fa-clock', 'title' => $scheduleLabel, 'value' => $scheduleValue],
                            ['icon' => 'fas fa-layer-group', 'title' => $levelLabel, 'value' => $levelValue]
                        ];
                @endphp

                @foreach($goldInfoPointsList as $gItem)
                    @if(!empty($gItem['title']) || !empty($gItem['value']))
                        <div class="mc-gold-item-row">
                            <div class="mc-gold-icon-circle"><i class="{{ !empty($gItem['icon']) ? $gItem['icon'] : 'fas fa-check-circle' }}"></i></div>
                            <div>
                                @if(!empty($gItem['title']))
                                    <p class="m-0 fw-bold fs-5 text-dark">{{ $gItem['title'] }}</p>
                                @endif
                                @if(!empty($gItem['value']))
                                    <small class="text-muted">{{ $gItem['value'] }}</small>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach

                {{-- Price Display --}}
                <div class="mc-gold-price-highlight">
                    <span class="fw-bold fs-5 text-dark d-flex align-items-center gap-2">
                        <span style="width: 12px; height: 12px; border-radius: 50%; background: #fdcc0d; display: inline-block;"></span>
                        {{ $goldOfferTitle }}
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
                            {{ $originalPriceLabel }}
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
                            <a href="#register" class="template-btn">
                                {{ $goldCtaText }} - 
                                @if($course->is_discountable == 1)
                                    {{ get_price($course->discount_amount, userCurrency()) }}
                                @else
                                    {{ get_price($course->price, userCurrency()) }}
                                @endif
                                <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                            <div class="mc-seats-counter mt-3">
                                <span class="mc-pulse-dot"><span class="ping"></span><span class="dot"></span></span>
                                <span>{{ $goldSeatsText }}</span>
                            </div>
                        </div>
                    @endif
                @endif
            </div>

            {{-- =========================================================
                 5. BENEFITS GRID ("এই মাস্টারক্লাস কার জন্য?")
                 Field: $course->what_will_learn (From Admin Course Edit)
            ========================================================== --}}
            <style>
                .mc-new-benefit-card {
                    background: #ffffff;
                    color: #1e293b;
                    border-radius: 14px;
                    padding: 30px;
                    box-shadow: 0 4px 20px rgba(0,0,0,0.03);
                    border: 1px solid #e2e8f0;
                    height: 100%;
                    display: flex;
                    flex-direction: column;
                    gap: 15px;
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                }
                .mc-new-benefit-card:hover {
                    transform: translateY(-4px);
                    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.06) !important;
                    border-color: #cbd5e1 !important;
                }
                .mc-new-benefit-card.dark-theme:hover {
                    border-color: #3b82f6 !important;
                    box-shadow: 0 12px 30px rgba(59, 130, 246, 0.12) !important;
                }
            </style>

            <div class="mc-benefits-card-wrapper mb-5 pt-3">
                <h2 class="fw-bold course-section-title text-dark mb-4 text-center px-3" style="max-width: 800px; margin: 0 auto; line-height: 1.4; font-size: 26px;">{{ $benefitsTitle }}</h2>
                <span class="d-block mx-auto mb-5" style="width: 70px; height: 3px; background: #10b981; border-radius: 10px;"></span>

                <div class="row g-4 justify-content-center">
                    @php
                        $benefits = [];
                        if(!empty($mcSettings['benefits_list']) && is_array($mcSettings['benefits_list'])) {
                            $benefits = array_values(array_filter(array_map('trim', $mcSettings['benefits_list'])));
                        }
                        if(empty($benefits) && !empty($mcSettings['benefits_items'])) {
                            $lines = array_filter(array_map('trim', explode("\n", $mcSettings['benefits_items'])));
                            $benefits = array_values($lines);
                        }
                        if(empty($benefits) && !empty($course->what_will_learn)) {
                            $lines = array_filter(array_map('trim', explode("\n", strip_tags($course->what_will_learn))));
                            $benefits = array_values($lines);
                        }
                        if(count($benefits) < 1) {
                            $benefits = [
                                'মার্কেটপ্লেস থেকে ক্লায়েন্ট পাওয়ার জন্য সংগ্রাম করছেন? | বিভিন্ন ফ্রিল্যান্সিং মার্কেটপ্লেসে আপনার মতো আরো হাজারো ফ্রিল্যান্সার বা সার্ভিস প্রোভাইডারের প্রোফাইল রয়েছে। আপনাকে সেখানে তাদের সাথে প্রতিযোগিতা করতে হয়। হাজারো প্রোফাইলের ভিড়ে আপনার প্রোফাইলটি যদি ক্লায়েন্টের চোখে না পড়ে, তাহলে সেখান থেকে কাজ পাওয়া কঠিন হয়ে পড়ে। আর আপনি যদি আউট অফ মার্কেটপ্লেস ক্লায়েন্টকে টার্গেট করতে পারেন তবে ক্লায়েন্ট পাওয়া আপনার জন্য অনেক সহজ হয়ে যায়।',
                                'ক্লায়েন্ট পেতে বারবার রিজেক্ট হচ্ছেন? | বারবার রিজেকশন হওয়া হতাশাজনক তবে এর পেছনে লুকিয়ে থাকতে পারে আপনার প্রাইসিং মডেল, প্রোফাইল অপটিমাইজেশন, বা ড্রাফট পিচিংয়ের ভুল কৌশল। আমরা এই ফানেলগুলো কিভাবে কাটিয়ে উঠতে হয় এবং ক্লায়েন্টের সাথে কিভাবে একটি ট্রাস্টেড সম্পর্ক তৈরি করতে হয়, তা শেখাব।',
                                'আয়ের উপর মার্কেটপ্লেস অতিরিক্ত ফি কাটছে? | মার্কেটপ্লেসের প্ল্যাটফর্মগুলো প্রতিটি আয়ের একটি বড় অংশ ফি হিসেবে কেটে নেয়। এটি অনেক ফ্রিল্যান্সারের জন্য হতাশার কারণ। আমরা যেহেতু শিখব কিভাবে মার্কেটপ্লেসের বাইরে ক্লায়েন্ট খুঁজে পাওয়া যায়, তা এ ফি গুণা বন্ধ সম্ভব হবে।',
                                'আপনার আউটরিচ ইমেইল কোনো রেসপন্স পাচ্ছে না? | আউটরিচ ইমেইলগুলোর কোনো জবাব না পাওয়া মানে সেখানে কিছু ঘাটতি আছে। এটা হতে পারে আপনার মেসেজের ভুল টোন, অসম্পূর্ণ মেসেজ, বা ভুল টার্গেটিং। আপনি এ কোর্সে শিখবেন কিভাবে সঠিকভাবে ইমেইল কপি লিখতে হয় যা ক্লায়েন্টের দৃষ্টি আকর্ষণ করবে এবং রিপ্লাই পাওয়ার সম্ভাবনা বাড়াবে।',
                                'আপনার স্কিল আছে, কিন্তু ক্লায়েন্ট নেই? | ক্লায়েন্ট না থাকার মানে এই নয় যে আপনার স্কিল কম। এটা হতে পারে সঠিক মার্কেটিং ও নেটওয়ার্কিং কৌশলের অভাব। আপনার প্রতিভা বা দক্ষতা থাকা সত্ত্বেও যদি কাজ না পান, তবে এর কারণ হতে পারে আপনার আউটরিচ স্ট্র্যাটেজি বা প্রোফাইল অপটিমাইজেশনের ঘাটতি। আমরা দেখাব কিভাবে সঠিক পদ্ধতিতে ক্লায়েন্টদের কাছে পৌঁছাতে হয় এবং তাদের প্রয়োজন বুঝে অফার করতে হয়।'
                            ];
                        }
                    @endphp

                    @foreach($benefits as $benefit)
                        @php
                            $parts = explode('|', $benefit);
                            $bTitle = trim($parts[0] ?? '');
                            $bDesc = trim($parts[1] ?? '');
                            
                            $idx = $loop->index;
                            
                            // 5th item spans full width, others take 6 columns
                            $colClass = ($idx === 4) ? 'col-lg-12' : 'col-lg-6 col-md-6';
                            
                            if ($idx === 0) {
                                $cardClass = 'mc-new-benefit-card dark-theme';
                                $cardStyle = 'background: #111029; color: #ffffff; border-color: #111029;';
                                $titleColor = '#ffffff';
                                $descColor = '#cbd5e1';
                                $iconHtml = '<div class="mc-icon-wrapper" style="background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; width: 48px; height: 48px; border-radius: 10px; flex-shrink: 0;"><i class="fas fa-handshake" style="color: #60a5fa; font-size: 20px;"></i></div>';
                            } elseif ($idx === 1) {
                                $cardClass = 'mc-new-benefit-card';
                                $cardStyle = '';
                                $titleColor = '#0f172a';
                                $descColor = '#475569';
                                $iconHtml = '<div class="mc-icon-wrapper" style="background: #fef2f2; display: flex; align-items: center; justify-content: center; width: 48px; height: 48px; border-radius: 10px; flex-shrink: 0;"><i class="fas fa-times-circle" style="color: #ef4444; font-size: 20px;"></i></div>';
                            } elseif ($idx === 2) {
                                $cardClass = 'mc-new-benefit-card';
                                $cardStyle = '';
                                $titleColor = '#0f172a';
                                $descColor = '#475569';
                                $iconHtml = '<div class="mc-icon-wrapper" style="background: #fffbeb; display: flex; align-items: center; justify-content: center; width: 48px; height: 48px; border-radius: 10px; flex-shrink: 0;"><i class="fas fa-coins" style="color: #f59e0b; font-size: 20px;"></i></div>';
                            } elseif ($idx === 3) {
                                $cardClass = 'mc-new-benefit-card';
                                $cardStyle = '';
                                $titleColor = '#0f172a';
                                $descColor = '#475569';
                                $iconHtml = '<div class="mc-icon-wrapper" style="background: #e6fbf4; display: flex; align-items: center; justify-content: center; width: 48px; height: 48px; border-radius: 10px; flex-shrink: 0;"><i class="fas fa-envelope-open-text" style="color: #10b981; font-size: 20px;"></i></div>';
                            } elseif ($idx === 4) {
                                $cardClass = 'mc-new-benefit-card';
                                $cardStyle = '';
                                $titleColor = '#0f172a';
                                $descColor = '#475569';
                                $iconHtml = '<div class="mc-icon-wrapper" style="background: #f0f9ff; display: flex; align-items: center; justify-content: center; width: 48px; height: 48px; border-radius: 10px; flex-shrink: 0;"><i class="fas fa-user-tie" style="color: #0284c7; font-size: 20px;"></i></div>';
                            } else {
                                $cardClass = 'mc-new-benefit-card';
                                $cardStyle = '';
                                $titleColor = '#0f172a';
                                $descColor = '#475569';
                                $iconHtml = '<div class="mc-icon-wrapper" style="background: #f0fdf4; display: flex; align-items: center; justify-content: center; width: 48px; height: 48px; border-radius: 10px; flex-shrink: 0;"><i class="fas fa-check-circle" style="color: #10b981; font-size: 20px;"></i></div>';
                                $colClass = 'col-lg-6 col-md-6';
                            }
                        @endphp

                        <div class="{{ $colClass }}">
                            <div class="{{ $cardClass }}" style="{{ $cardStyle }}">
                                <div class="d-flex align-items-start gap-3">
                                    {!! $iconHtml !!}
                                    <div style="flex-grow: 1;">
                                        <h4 style="font-size: 18px; font-weight: 700; color: {{ $titleColor }}; margin: 0 0 8px 0; line-height: 1.45;">{{ $bTitle }}</h4>
                                        @if(!empty($bDesc))
                                            <p style="font-size: 14px; line-height: 1.65; color: {{ $descColor }}; margin: 0;">{{ $bDesc }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- =========================================================
                 9. COURSE SYLLABUS / CURRICULUM ACCORDION (100% Admin Sync)
                 Fields: $sections, $lessons (Admin Curriculum Builder)
            ========================================================== --}}
            @if(setting('hide_curriculum_from_course_details') != '1' && count($sections) > 0)
                <div class="mc-content-card">
                    <h4 class="fw-bold course-section-title text-dark mb-4 text-center">{{ __('course_syllabus') }}</h4>
                    
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
                 AD BANNER 1 (Under Course Syllabus)
            ========================================================== --}}
            @php
                $mcB1Url = !empty($mcSettings['ad_banner_1_image_url']) ? $mcSettings['ad_banner_1_image_url'] : '';
                $mcB1Status = !empty($mcSettings['ad_banner_1_status']);
                $mcB1Link = !empty($mcSettings['ad_banner_1_link']) ? $mcSettings['ad_banner_1_link'] : '';
            @endphp
            @if($mcB1Url && $mcB1Status)
                <div class="mc-ad-banner-1">
                    @if($mcB1Link)
                        <a href="{{ $mcB1Link }}" target="_blank" class="d-block w-100 overflow-hidden">
                    @endif
                        <img src="{{ $mcB1Url }}" alt="Ad Banner 1" class="img-fluid w-100" style="border-radius: 16px; width: 100%; max-height: 280px; object-fit: cover; display: block; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);">
                    @if($mcB1Link)
                        </a>
                    @endif
                </div>
            @endif

            {{-- =========================================================
                 6. SPECIAL GIFT BANNER CARD
            ========================================================== --}}
            @if(!$hideSpecialGift)
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
                        <a href="#register" class="template-btn">
                            {{ $giftCtaText }}
                        </a>
                        <div class="mc-seats-counter mt-3">
                            <span class="mc-pulse-dot"><span class="ping"></span><span class="dot"></span></span>
                            <span>বাকি আছে মাত্র <strong class="text-warning fw-bold">{{ $remainingSeats }}</strong> টা seat</span>
                        </div>
                    </div>
                </div>
            @endif

            {{-- =========================================================
                 FEATURE / OVERVIEW HIGHLIGHT SECTION (Image Left, Text Right)
            ========================================================== --}}
            @if(!$hideOverviewSection)
                @php
                    $isYouTube = false;
                    $youtubeEmbedUrl = '';
                    if (!empty($overviewImageUrl) && (str_contains($overviewImageUrl, 'youtube.com') || str_contains($overviewImageUrl, 'youtu.be'))) {
                        $isYouTube = true;
                        $videoId = '';
                        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $overviewImageUrl, $match)) {
                            $videoId = $match[1];
                        }
                        $youtubeEmbedUrl = "https://www.youtube.com/embed/" . $videoId;
                    }
                @endphp
                <div class="mc-overview-feature-section py-4">
                    <div class="row align-items-center g-4">
                        <!-- Left Side: Content & Action Button -->
                        <div class="col-lg-6 col-md-12">
                            <div class="overview-content pe-lg-4">
                                @if($overviewTag)
                                    <span class="sub-title text-uppercase fw-bold mb-2 d-inline-block" 
                                          style="color: #10b981; letter-spacing: 1.5px; font-size: 14px;">
                                        {{ __($overviewTag) }}
                                    </span>
                                @endif

                                @if($overviewTitle)
                                    <h2 class="mb-3" style="color: #1a1b4b; font-size: 32px; line-height: 1.25; font-weight: 700;">
                                        {{ __($overviewTitle) }}
                                    </h2>
                                @endif

                                @if($overviewDesc1)
                                    <div class="mb-3 text-secondary" style="font-size: 15.5px; line-height: 1.7;">
                                        {!! __($overviewDesc1) !!}
                                    </div>
                                @endif

                                @if($overviewDesc2)
                                    <div class="mb-4 text-secondary" style="font-size: 15.5px; line-height: 1.7;">
                                        {!! __($overviewDesc2) !!}
                                    </div>
                                @endif

                                @if($overviewBtnText)
                                    <a href="{{ $overviewBtnUrl }}" class="template-btn mt-2 d-inline-block">
                                        {{ __($overviewBtnText) }} <i class="fas fa-arrow-right ms-2"></i>
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Right Side: Image / YouTube Video -->
                        <div class="col-lg-6 col-md-12">
                            @if($isYouTube)
                                <div class="overview-video-card ratio ratio-16x9 overflow-hidden shadow-sm" style="border-radius: 16px; background: #000; border: 3px solid #ffffff;">
                                    <iframe src="{{ $youtubeEmbedUrl }}" class="w-100 h-100" style="border: none; display: block; border-radius: 13px;" allowfullscreen></iframe>
                                </div>
                            @else
                                <div class="overview-img-card position-relative overflow-hidden shadow-sm" 
                                     style="border-radius: 16px; background: #ffffff; border: 3px solid #ffffff;">
                                    <img src="{{ $overviewImageUrl }}" alt="{{ $overviewTitle }}" class="img-fluid w-100" 
                                         style="width: 100%; height: auto; max-height: 440px; object-fit: cover; display: block; border-radius: 13px;">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif



            {{-- Breakdown Table --}}
            @if(!$hideBreakdown)
                <div class="mc-breakdown-card">
                    <h2 class="fw-bold course-section-title text-dark mb-3 text-center">
                        এই 
                        @if($course->is_discountable == 1)
                            {{ get_price($course->discount_amount, userCurrency()) }}
                        @else
                            {{ get_price($course->price, userCurrency()) }}
                        @endif
                        টাকায় আপনি পাচ্ছেন:
                    </h2>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <tbody>
                                @foreach($breakdownRows as $row)
                                    <tr>
                                        <td>{{ $row['title'] }}</td>
                                        <td class="text-end fw-bold">{{ $row['val'] }}</td>
                                    </tr>
                                @endforeach
                                <tr class="table-success border-top border-2">
                                    <td class="fw-bold text-success">{{ $breakdownTodayTitle }}</td>
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
            @endif

            {{-- =========================================================
                 8. COURSE FULL DESCRIPTION (100% Admin WYSIWYG Editor Sync)
                 Field: $course->description (Admin Edit Rich Text Editor)
            ========================================================== --}}
            <div class="mc-content-card">
                <h4 class="fw-bold course-section-title text-dark mb-3 text-center">{{ __('about_this_course') }}</h4>
                <div class="description-body text-secondary leading-relaxed fs-6">
                    @if(!empty($course->description))
                        {!! $course->description !!}
                    @else
                        <p>এই লাইভ মাস্টারক্লাসে আমরা ই-কমার্স বিজনেস শুরু থেকে স্কেল আপ করার সব দরকারি ট্রিকস ও স্ট্র্যাটেজি নিয়ে বিস্তারিত আলোচনা করবো। ক্লাসে সরাসরি প্রশ্নোত্তর পর্ব থাকবে।</p>
                    @endif
                </div>
            </div>






        </div>
    </section>

</div>

<input type="hidden" class="text_copied" value="{{ __('text_copied') }}">
<input type="hidden" class="text_copied_fail" value="{{ __('text_copied_fail') }}">

{{-- =========================================================
     13. RELATED COURSES SECTION
========================================================== --}}
@if(setting('disable_related_course_from_course_details') != '1' && setting('website_mode') != 'single_course' && !$hideRelated && count($related_courses) > 0)
    <section class="bg-light py-5 border-top">
        <div class="container container-1278">
            <div class="row justify-content-center mb-4">
                <div class="col-lg-6 text-center">
                    <h3 class="fw-extrabold course-section-title text-dark">{{ __('related_course') }}</h3>
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
                        <a class="template-btn bordered-btn" href="{{ route('courses', ['category_ids' => $course->category_id]) }}">
                            {{ __('see_more') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif

<div class="masterclass-page-wrapper">
    <section class="mc-main-content">
        @if($supportStatus)
            <div class="mc-support-section-wrapper">
                <div class="mc-container">
                    <div class="mc-support-section">
                        <div class="row align-items-end g-4">
                            <!-- Left Side: Content -->
                            <div class="col-lg-6 col-md-12 mc-support-content">
                                <h2 class="mc-support-title">{!! $supportTitle !!}</h2>
                                <div class="mc-support-description">
                                    {!! $supportDescription !!}
                                </div>
                            </div>

                            <!-- Right Side: Image -->
                            <div class="col-lg-6 col-md-12 text-center text-lg-end mc-support-img-wrapper justify-content-center justify-content-lg-end">
                                @if(!empty($supportImageUrl))
                                    <img src="{{ $supportImageUrl }}" alt="Support Image" class="mc-support-img img-fluid">
                                @else
                                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Support Image" class="mc-support-img img-fluid" style="padding-bottom: 50px; opacity: 0.85;">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="mc-container">

            {{-- =========================================================
                 10. REGISTRATION ORDER FORM SECTION (`#register`)
            ========================================================== --}}
            @if(!$is_enrolled)
                <div class="mc-registration-section" id="register">
                    <h2 class="text-center fw-bold course-section-title text-dark mb-2">
                        {!! $orderFormTitle !!}
                    </h2>
                    <p class="text-center text-muted small mb-4">{{ $orderFormSubtitle }}</p>
                    
                    <div class="mc-form-wrapper user-form mx-auto" style="max-width: 700px;">
                        
                        <div class="mb-5">
                            <h4 class="fw-bold mb-4" style="color: #10b981; font-size: 20px;">Give valid information</h4>
                            
                            <form action="{{ route('masterclass.checkout') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $course->id }}">
                                <input type="hidden" name="type" value="course">
                                <input type="hidden" name="quantity" value="1">

                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-dark mb-2">{{ $nameLabel ?? 'Your Full Name' }} <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', auth()->check() ? auth()->user()->name : '') }}" placeholder="{{ $namePlaceholder }}" required style="background-color: #fff; border: 1px solid #d1d5db; color: #111827; padding: 14px; border-radius: 8px;">
                                    @error('name')
                                        <span class="invalid-feedback d-block text-danger small mt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-dark mb-2">{{ $phoneLabel ?? 'Mobile Number' }} <span class="text-danger">*</span></label>
                                    <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', auth()->check() ? auth()->user()->phone : '') }}" placeholder="{{ $phonePlaceholder }}" required style="background-color: #fff; border: 1px solid #d1d5db; color: #111827; padding: 14px; border-radius: 8px;">
                                    @error('phone')
                                        <span class="invalid-feedback d-block text-danger small mt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-dark mb-2">{{ $emailLabel ?? 'Email address' }} <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}" placeholder="{{ $emailPlaceholder }}" required style="background-color: #fff; border: 1px solid #d1d5db; color: #111827; padding: 14px; border-radius: 8px;">
                                    @error('email')
                                        <span class="invalid-feedback d-block text-danger small mt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>



                                <div class="mb-4 text-start" style="color: #94a3b8; font-size: 13.5px; line-height: 1.6;">
                                    {!! $privacyNotice !!}
                                </div>

                                <button type="submit" class="template-btn w-100 text-center border-0">
                                    {{ $payNowBtnText ?? 'PAY NOW' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

            {{-- =========================================================
                 11. FAQ ACCORDION SECTION (100% Admin Sync)
                 Field: $faqs (From Admin Course Edit -> FAQ tab)
            ========================================================== --}}
            @php
                $displayFaqs = [];

                // 1. Primary: Official Course FAQs ($faqs table)
                if (!empty($faqs) && count($faqs) > 0) {
                    foreach ($faqs as $f) {
                        $displayFaqs[] = (object)[
                            'question' => $f->question,
                            'answer'   => $f->answer
                        ];
                    }
                }

                // 2. Secondary: mcSettings custom faq_list array
                if (empty($displayFaqs) && !empty($mcSettings['faq_list']) && is_array($mcSettings['faq_list'])) {
                    foreach ($mcSettings['faq_list'] as $item) {
                        if (!empty($item['question']) || !empty($item['answer'])) {
                            $displayFaqs[] = (object)[
                                'question' => $item['question'] ?? '',
                                'answer'   => $item['answer'] ?? ''
                            ];
                        }
                    }
                }

                // 3. Tertiary: mcSettings faq_items pipe-separated text
                if (empty($displayFaqs) && !empty($mcSettings['faq_items'])) {
                    $lines = array_filter(array_map('trim', explode("\n", $mcSettings['faq_items'])));
                    foreach ($lines as $line) {
                        $parts = explode('|', $line);
                        if (isset($parts[0]) && isset($parts[1])) {
                            $displayFaqs[] = (object)[
                                'question' => trim($parts[0]),
                                'answer'   => trim($parts[1])
                            ];
                        }
                    }
                }
            @endphp

            @if(setting('hide_faq_from_course_details') != '1' && count($displayFaqs) > 0)
                <div class="mc-faq-section">
                    <h2 class="text-center fw-bold course-section-title text-dark mb-2">{{ $faqTitle }}</h2>
                    <span class="d-block mx-auto mb-4" style="width: 70px; height: 3px; background: #10b981; border-radius: 10px;"></span>

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
                                <a href="#register" class="template-btn">
                                    {{ $dualCtaLeft }} - 
                                    @if($course->is_discountable == 1)
                                        {{ get_price($course->discount_amount, userCurrency()) }}
                                    @else
                                        {{ get_price($course->price, userCurrency()) }}
                                    @endif
                                    <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                                <div class="mc-seats-counter mt-3">
                                    <span class="mc-pulse-dot"><span class="ping"></span><span class="dot"></span></span>
                                    <span>{{ $dualCtaSeats }}</span>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            @endif

            {{-- =========================================================
                 AD BANNER 2 (Under FAQ Section)
            ========================================================== --}}
            @php
                $mcB2Url = !empty($mcSettings['ad_banner_2_image_url']) ? $mcSettings['ad_banner_2_image_url'] : '';
                $mcB2Status = !empty($mcSettings['ad_banner_2_status']);
                $mcB2Link = !empty($mcSettings['ad_banner_2_link']) ? $mcSettings['ad_banner_2_link'] : '';
            @endphp
            @if($mcB2Url && $mcB2Status)
                <div class="mc-ad-banner-2">
                    @if($mcB2Link)
                        <a href="{{ $mcB2Link }}" target="_blank" class="d-block w-100 overflow-hidden">
                    @endif
                        <img src="{{ $mcB2Url }}" alt="Ad Banner 2" class="img-fluid w-100" style="border-radius: 16px; width: 100%; max-height: 280px; object-fit: cover; display: block; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);">
                    @if($mcB2Link)
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </section>
</div>

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
