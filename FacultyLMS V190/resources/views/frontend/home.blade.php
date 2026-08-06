@extends('frontend.layouts.master')
@section('title', isset($course) && $course ? $course->title : __('home'))

@section('base.content')
    <!--====== Start Header ======-->
    @include('frontend.layouts.header.'.$section['header'])
    
    @if(isset($course) && $course)
    @php
        $lang = app()->getLocale();
        
        $resolveImg = function($key, $fallback = '') {
            $settingVal = setting($key);
            if ($settingVal) {
                if (is_numeric($settingVal)) {
                    $media = \App\Models\MediaLibrary::find($settingVal);
                    if ($media && $media->image_variants) {
                        return getFileLink('original_image', $media->image_variants);
                    }
                }
                if (is_array($settingVal)) {
                    return getFileLink('original_image', $settingVal);
                }
                if (is_string($settingVal) && (str_contains($settingVal, '/') || str_contains($settingVal, '.'))) {
                    return getFileLink('original_image', $settingVal);
                }
            }
            return $fallback;
        };

        $heroTitle = setting('hero_title', $lang) ?: (setting('single_hero_title') ?: $course->title);
        $heroDesc = setting('hero_description', $lang) ?: (setting('single_hero_description') ?: ($course->short_description ?? strip_tags($course->description)));
        $heroBtnLabel = setting('hero_main_action_btn_label', $lang) ?: __('Enroll Now');
        $heroBtnUrl = setting('hero_main_action_btn_url') ? url(setting('hero_main_action_btn_url')) : route('course.details', $course->slug);

        $heroImg1 = $resolveImg('header1_hero_image1') ?: ($resolveImg('header2_hero_image1') ?: ($resolveImg('single_hero_image') ?: ($course->image ? getFileLink('original_image', $course->image) : static_asset('frontend/img/hero/hero-v5-masonry-1.jpg'))));
        $heroImg2 = $resolveImg('header1_hero_image2') ?: ($resolveImg('header2_hero_image2') ?: static_asset('frontend/img/hero/hero-v5-masonry-2.jpg'));
        $heroImg3 = $resolveImg('header1_hero_image3') ?: ($resolveImg('header2_hero_image3') ?: static_asset('frontend/img/hero/hero-v5-masonry-3.jpg'));
        $heroImg4 = $resolveImg('header1_hero_image4') ?: ($resolveImg('header2_hero_image4') ?: static_asset('frontend/img/hero/hero-v5-masonry-4.jpg'));
    @endphp
    <!--====== Start Single Course Hero Section ======-->
    <section class="hero-area hero-area-v5 p-t-120 p-b-100 p-b-md-40" style="background-color: #110B3A;">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    @if(setting('hero_subtitle', $lang))
                        <span class="hero-subtitle mb-2 d-inline-block text-uppercase fw-bold" style="color: #10b981; letter-spacing: 1px;">{!! setting('hero_subtitle', $lang) !!}</span>
                    @endif
                    <h1 class="hero-title m-b-20" style="color: #ffffff; font-size: 2.8rem; line-height: 1.25;">{!! $heroTitle !!}</h1>
                    <p class="m-b-30" style="font-size: 1.1rem; line-height: 1.8; color: #d1d5db;">
                        {!! $heroDesc !!}
                    </p>
                    <a href="{{ $heroBtnUrl }}" class="template-btn mt-3">{{ $heroBtnLabel }}</a>
                </div>
                <div class="col-lg-6">
                    <div class="hero-staggered-collage position-relative w-100" style="min-height: 520px; max-width: 580px; margin: 0 auto;">
                        <!-- Top Right Image -->
                        @if($heroImg1)
                        <div class="collage-card card-1 position-absolute shadow-lg overflow-hidden" 
                             style="top: 0; right: 0; width: 55%; height: 320px; border-radius: 24px; z-index: 2; border: 3px solid rgba(255,255,255,0.15); transition: transform 0.3s ease;">
                            <img src="{{ $heroImg1 }}" alt="Hero Image 1" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        @endif

                        <!-- Left Middle Image -->
                        @if($heroImg2)
                        <div class="collage-card card-2 position-absolute shadow-lg overflow-hidden" 
                             style="top: 90px; left: 0; width: 52%; height: 340px; z-index: 1; border-radius: 24px; border: 3px solid rgba(255,255,255,0.15); transition: transform 0.3s ease;">
                            <img src="{{ $heroImg2 }}" alt="Hero Image 2" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        @endif

                        <!-- Bottom Right Image -->
                        @if($heroImg3)
                        <div class="collage-card card-3 position-absolute shadow-lg overflow-hidden" 
                             style="top: 230px; right: 2%; width: 55%; height: 310px; z-index: 3; border-radius: 24px; border: 3px solid rgba(255,255,255,0.2); transition: transform 0.3s ease;">
                            <img src="{{ $heroImg3 }}" alt="Hero Image 3" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        @endif

                        <!-- Fourth Floating Accent Image -->
                        @if($heroImg4)
                        <div class="collage-card card-4 position-absolute shadow-lg overflow-hidden" 
                             style="bottom: -15px; left: 10%; width: 36%; height: 160px; z-index: 4; border-radius: 20px; border: 4px solid #ffffff; transition: transform 0.3s ease;">
                            <img src="{{ $heroImg4 }}" alt="Hero Image 4" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        @endif
                    </div>
            </div>
        </div>
    </section>
    @endif

    <!--====== Start Feature Cards Section (Life Time Access, Free Course Materials, Dedicated Support) ======-->
    @include('frontend.homePage.feature_section')

    <!--====== Promo Banner Restored to Original Position ======-->
    <section class="promo-banner-section p-t-60 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="promo-box rounded-4 p-5 text-center shadow-lg" style="background-color: {{ setting('promo_banner_bg_color') ?: '#fcd34d' }};">
                        <h2 class="fw-bold mb-4" style="font-size: 2.2rem; color: #1e3a8a;">
                            {{ setting('promo_banner_title') ?: 'Admission Is Open For The Next Batch. Take Admission And Get 40% Discount' }}
                        </h2>
                        
                        <div class="countdown-container d-flex justify-content-center gap-3 mb-5" id="promoCountdownMain" data-target="{{ setting('promo_banner_countdown') ?: date('Y-m-d H:i:s', strtotime('+5 days')) }}">
                            <div class="countdown-item bg-white rounded p-3 shadow-sm" style="width: 100px;">
                                <h3 class="days m-0 fw-bold" style="color: #ea580c; font-size: 2rem;">00</h3>
                                <span class="small fw-semibold text-secondary text-uppercase">Days</span>
                            </div>
                            <div class="countdown-item bg-white rounded p-3 shadow-sm" style="width: 100px;">
                                <h3 class="hours m-0 fw-bold" style="color: #ea580c; font-size: 2rem;">00</h3>
                                <span class="small fw-semibold text-secondary text-uppercase">Hours</span>
                            </div>
                            <div class="countdown-item bg-white rounded p-3 shadow-sm" style="width: 100px;">
                                <h3 class="minutes m-0 fw-bold" style="color: #ea580c; font-size: 2rem;">00</h3>
                                <span class="small fw-semibold text-secondary text-uppercase">Minutes</span>
                            </div>
                            <div class="countdown-item bg-white rounded p-3 shadow-sm" style="width: 100px;">
                                <h3 class="seconds m-0 fw-bold" style="color: #ea580c; font-size: 2rem;">00</h3>
                                <span class="small fw-semibold text-secondary text-uppercase">Seconds</span>
                            </div>
                        </div>

                        <a href="{{ setting('promo_banner_btn_link') ?: '#' }}" class="template-btn">
                            {{ setting('promo_banner_btn_text') ?: 'APPLY NOW' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== Start Ad Banner Section ======-->
    @php
        $adBannerMediaId = setting('home_ad_banner_image');
        $adBannerImageUrl = '';
        if ($adBannerMediaId) {
            $media = \App\Models\MediaLibrary::find($adBannerMediaId);
            if ($media && $media->image_variants) {
                $adBannerImageUrl = getFileLink('original_image', $media->image_variants);
            }
        }
    @endphp
    @if($adBannerImageUrl)
    <section class="ad-banner-section" style="padding: 40px 0;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    @if(setting('home_ad_banner_link'))
                        <a href="{{ setting('home_ad_banner_link') }}" target="_blank">
                    @endif
                        <img src="{{ $adBannerImageUrl }}" alt="Ad Banner" class="img-fluid rounded shadow-sm" style="width: 100%; object-fit: cover;">
                    @if(setting('home_ad_banner_link'))
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif

    <!--====== Start What You Will Learn ======-->
    @if($course->outcomes)
    <section class="what-you-learn-section p-t-80 p-b-80 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 class="text-center mb-5 fw-bold">What You Will Learn</h2>
                    <div class="card shadow-sm border-0 rounded p-4 p-md-5">
                        {!! $course->outcomes !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif


    <!--====== Start Instructor Profile ======-->
    @if($course->instructor)
    <section class="instructor-section p-t-80 p-b-80 bg-white">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">Meet Your Instructor</h2>
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <img src="{{ getFileLink('100x100', $course->instructor->image) }}" class="rounded-circle mb-4 shadow" alt="{{ $course->instructor->name }}" style="width: 150px; height: 150px; object-fit: cover;">
                    <h4 class="fw-bold">{{ $course->instructor->name }}</h4>
                    <p class="text-secondary mb-4">{{ $course->instructor->instructor->designation ?? 'Instructor' }}</p>
                    <div class="text-secondary" style="line-height: 1.8;">
                        {!! $course->instructor->about !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!--====== Start Webinar Section ======-->
    @include('frontend.homePage.webinar_section')

    <!--====== Start Success Video Section ======-->
    @include('frontend.homePage.success_video')

    <!--====== Start Success Story Section ======-->
    @include('frontend.homePage.success')

    <!--====== Start FAQ Section ======-->
    @include('frontend.homePage.faq')

    <!--====== Start Newsletter & Countdown Overlapping Footer ======-->
    <section class="newsletter-countdown-section" style="position: relative; z-index: 10; margin-bottom: -120px;">
        <div class="container" style="max-width: 1300px;">
            <div class="newsletter-box rounded-4 p-5 shadow-lg" style="background-color: {{ setting('promo_banner_bg_color') ?: '#ffb606' }};">
                <div class="row align-items-center">
                    
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <h3 class="fw-bold text-dark mb-2" style="font-size: 1.8rem;">Subscribe Newsletter</h3>
                        <p class="text-dark mb-0" style="opacity: 0.8; font-size: 0.95rem;">
                            {{ setting('newsletter_description') ?: 'Get the latest updates, exclusive discounts, and news directly to your inbox.' }}
                        </p>
                    </div>

                    <div class="col-lg-5 mb-4 mb-lg-0">
                        <form action="{{ route('subscribe') }}" method="POST" class="d-flex w-100 bg-white rounded shadow-sm p-1">
                            @csrf
                            <input type="email" name="email" class="form-control border-0 shadow-none px-3" placeholder="Email" required style="background: transparent;">
                            <button type="submit" class="btn btn-dark rounded px-4 py-2 d-flex align-items-center justify-content-center" style="background-color: #111; color: white;">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>

                    <div class="col-lg-3 text-center text-lg-end">
                        <div class="mb-2 fw-bold text-dark text-center" style="font-size: 1.1rem;">Admission Now</div>
                        <div class="mini-countdown d-flex justify-content-center justify-content-lg-center gap-2" id="promoCountdownFooter" data-target="{{ setting('promo_banner_countdown') ?: date('Y-m-d H:i:s', strtotime('+5 days')) }}">
                            <div class="bg-white rounded p-2 text-center shadow-sm" style="width: 50px;">
                                <h4 class="days m-0 fw-bold" style="color: #ea580c; font-size: 1.1rem;">00</h4>
                                <span class="small text-secondary" style="font-size: 10px;">DAYS</span>
                            </div>
                            <div class="bg-white rounded p-2 text-center shadow-sm" style="width: 50px;">
                                <h4 class="hours m-0 fw-bold" style="color: #ea580c; font-size: 1.1rem;">00</h4>
                                <span class="small text-secondary" style="font-size: 10px;">HRS</span>
                            </div>
                            <div class="bg-white rounded p-2 text-center shadow-sm" style="width: 50px;">
                                <h4 class="minutes m-0 fw-bold" style="color: #ea580c; font-size: 1.1rem;">00</h4>
                                <span class="small text-secondary" style="font-size: 10px;">MIN</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!--====== Global Countdown Script for both timers ======-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function initCountdown(elementId) {
                const countdownEl = document.getElementById(elementId);
                if(countdownEl) {
                    const targetDateStr = countdownEl.getAttribute('data-target');
                    const targetDate = new Date(targetDateStr.replace(/-/g, '/')).getTime();

                    const timer = setInterval(function() {
                        const now = new Date().getTime();
                        const distance = targetDate - now;

                        if (distance < 0) {
                            clearInterval(timer);
                            return;
                        }

                        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        if(countdownEl.querySelector('.days')) countdownEl.querySelector('.days').innerText = days;
                        if(countdownEl.querySelector('.hours')) countdownEl.querySelector('.hours').innerText = hours;
                        if(countdownEl.querySelector('.minutes')) countdownEl.querySelector('.minutes').innerText = minutes;
                        if(countdownEl.querySelector('.seconds')) countdownEl.querySelector('.seconds').innerText = seconds;
                    }, 1000);
                }
            }
            initCountdown('promoCountdownMain');
            initCountdown('promoCountdownFooter');
        });
    </script>

    <!--====== Start Footer ======-->
    @include('frontend.layouts.footer')
@endsection

