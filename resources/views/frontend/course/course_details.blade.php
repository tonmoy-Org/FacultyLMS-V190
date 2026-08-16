@extends('frontend.layouts.master')
@section('title', $course->title)
@section('content')

@push('css')
    <link rel="stylesheet" href="{{ static_asset('frontend/css/masterclass.css') }}?v=1.11">
@endpush

@php
    $mcSettings = $course->masterclass_settings ?? [];
    $eyebrowTitle = !empty($mcSettings['eyebrow_title']) ? $mcSettings['eyebrow_title'] : ($category ? $category->lang_title : '');
    $classScheduleTitle = !empty($mcSettings['class_schedule_title']) ? $mcSettings['class_schedule_title'] : '';
    $classScheduleTime = !empty($mcSettings['class_schedule_time']) ? $mcSettings['class_schedule_time'] : '';
    $videoCaption = !empty($mcSettings['video_caption']) ? $mcSettings['video_caption'] : '';
    $goldBadgeTop = !empty($mcSettings['gold_badge_top']) ? $mcSettings['gold_badge_top'] : '';
    $scheduleBadge = !empty($mcSettings['schedule_badge']) ? $mcSettings['schedule_badge'] : '';
    $dualCtaLeft = !empty($mcSettings['dual_cta_left']) ? $mcSettings['dual_cta_left'] : '';
    
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

    $benefitsTitle = !empty($mcSettings['benefits_title']) ? $mcSettings['benefits_title'] : '';
    $orderFormTitle = !empty($mcSettings['order_form_title']) ? $mcSettings['order_form_title'] : '';
    $orderFormSubtitle = !empty($mcSettings['order_form_subtitle']) ? $mcSettings['order_form_subtitle'] : '';
    $faqTitle = !empty($mcSettings['faq_title']) ? $mcSettings['faq_title'] : '';

    $zoomTitle = !empty($mcSettings['zoom_title']) ? $mcSettings['zoom_title'] : '';
    $zoomSubtitle = !empty($mcSettings['zoom_subtitle']) ? $mcSettings['zoom_subtitle'] : '';
    $goldOfferTitle = !empty($mcSettings['gold_offer_title']) ? $mcSettings['gold_offer_title'] : '';
    $primaryCtaText = !empty($mcSettings['primary_cta_text']) ? $mcSettings['primary_cta_text'] : '';
    $scheduleValue = !empty($mcSettings['schedule_value']) ? $mcSettings['schedule_value'] : (!empty($course->duration) ? $course->duration : '');
    $levelLabel = !empty($mcSettings['level_label']) ? $mcSettings['level_label'] : '';
    $levelValue = !empty($mcSettings['level_value']) ? $mcSettings['level_value'] : ($level ? $level->lang_title : '');
    $goldCtaText = !empty($mcSettings['gold_cta_text']) ? $mcSettings['gold_cta_text'] : '';
    
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

    $overviewTag = !empty($mcSettings['overview_tag']) ? $mcSettings['overview_tag'] : '';
    $overviewTitle = !empty($mcSettings['overview_title']) ? $mcSettings['overview_title'] : '';
    $overviewDesc1 = !empty($mcSettings['overview_desc1']) ? $mcSettings['overview_desc1'] : '';
    $overviewDesc2 = !empty($mcSettings['overview_desc2']) ? $mcSettings['overview_desc2'] : '';
    $overviewBtnText = !empty($mcSettings['overview_btn_text']) ? $mcSettings['overview_btn_text'] : '';
    $overviewBtnUrl = !empty($mcSettings['overview_btn_url']) ? $mcSettings['overview_btn_url'] : '';
    $overviewImageUrl = !empty($mcSettings['overview_image_url']) ? $mcSettings['overview_image_url'] : ($course->image ? getFileLink('original_image', $course->image) : 'https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=1200&auto=format&fit=crop');

    $giftBadge = !empty($mcSettings['gift_badge']) ? $mcSettings['gift_badge'] : '';
    $giftTitle = !empty($mcSettings['gift_title']) ? $mcSettings['gift_title'] : '';
    $giftValue = !empty($mcSettings['gift_value']) ? $mcSettings['gift_value'] : '';
    $giftDescription = !empty($mcSettings['gift_description']) ? $mcSettings['gift_description'] : '';
    $giftQuote = !empty($mcSettings['gift_quote']) ? $mcSettings['gift_quote'] : '';
    $giftFooterNote = !empty($mcSettings['gift_footer_note']) ? $mcSettings['gift_footer_note'] : '';
    $giftCtaText = !empty($mcSettings['gift_cta_text']) ? $mcSettings['gift_cta_text'] : '';
    if (!empty($mcSettings['gift_seats_text'])) {
        $giftSeatsText = preg_match('/\d+/', $mcSettings['gift_seats_text'])
            ? preg_replace('/\d+/', $remainingSeats, $mcSettings['gift_seats_text'])
            : $mcSettings['gift_seats_text'];
    } else {
        $giftSeatsText = 'বাকি আছে মাত্র ' . $remainingSeats . ' টা seat';
    }

    $explainerTitle = !empty($mcSettings['explainer_title']) ? $mcSettings['explainer_title'] : '';
    $explainerText = !empty($mcSettings['explainer_text']) ? $mcSettings['explainer_text'] : null;
    $breakdownSubheading = !empty($mcSettings['breakdown_subheading']) ? $mcSettings['breakdown_subheading'] : null;
    $breakdownItemsRaw = !empty($mcSettings['breakdown_items']) ? $mcSettings['breakdown_items'] : null;
    $breakdownTodayTitle = !empty($mcSettings['breakdown_today_title']) ? $mcSettings['breakdown_today_title'] : '';
    $originalPriceLabel = !empty($mcSettings['original_price_label']) ? $mcSettings['original_price_label'] : '';
    $scheduleLabel = !empty($mcSettings['schedule_label']) ? $mcSettings['schedule_label'] : '';

    $nameLabel = !empty($mcSettings['name_label']) ? $mcSettings['name_label'] : '';
    $namePlaceholder = !empty($mcSettings['name_placeholder']) ? $mcSettings['name_placeholder'] : '';
    $phoneLabel = !empty($mcSettings['phone_label']) ? $mcSettings['phone_label'] : '';
    $phonePlaceholder = !empty($mcSettings['phone_placeholder']) ? $mcSettings['phone_placeholder'] : '';
    $emailLabel = !empty($mcSettings['email_label']) ? $mcSettings['email_label'] : '';
    $emailPlaceholder = !empty($mcSettings['email_placeholder']) ? $mcSettings['email_placeholder'] : '';
    $orderSummaryTitle = !empty($mcSettings['order_summary_title']) ? $mcSettings['order_summary_title'] : '';
    $privacyNotice = !empty($mcSettings['privacy_notice']) ? $mcSettings['privacy_notice'] : '';
    $payNowBtnText = !empty($mcSettings['pay_now_btn_text']) ? $mcSettings['pay_now_btn_text'] : '';

    $supportStatus = !empty($mcSettings['support_status']);
    $supportTitle = !empty($mcSettings['support_title']) ? $mcSettings['support_title'] : '';
    $supportDescription = !empty($mcSettings['support_description']) ? $mcSettings['support_description'] : '';
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
                            <div class="mc-gold-icon-circle"><i class="{{ !empty($gItem['icon']) ? $gItem['icon'] : '' }}"></i></div>
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

            {{-- REGISTRATION ORDER FORM SECTION has been moved to home.blade.php --}}

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
