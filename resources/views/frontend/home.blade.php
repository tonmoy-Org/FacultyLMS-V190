@extends('frontend.layouts.master')
@section('title', __('home'))

@section('base.content')
    <!--====== Start Header ======-->
    @include('frontend.layouts.header.'.$section['header'])
    
    @include('frontend.homePage.hero_area.hero_area_one')

    <div class="home-page-sections">
    <!--====== Start Feature Cards Section (Life Time Access, Free Course Materials, Dedicated Support) ======-->
    {{-- @include('frontend.homePage.feature_section') --}}

    <!--====== Start About Me Section ======-->
    @include('frontend.homePage.about_me_section')


    <!--====== Start Ad Banner 1 (Upper Home Section) ======-->
    @php
        $b1ImgSetting = setting('home_ad_banner_image_1') ?: setting('home_ad_banner_image');
        $b1Url = '';
        if ($b1ImgSetting) {
            $b1Url = getFileLink('original_image', $b1ImgSetting);
        }
        $b1Status = setting('home_ad_banner_status_1') !== '0';
        $b1Link = setting('home_ad_banner_link_1') ?: setting('home_ad_banner_link');
    @endphp
    @if($b1Url && $b1Status && !str_contains($b1Url, 'default'))
    <section class="ad-banner-section-1 p-t-60 p-b-60 bg-white overflow-hidden">
        <div class="container container-1278">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    @if($b1Link)
                        <a href="{{ $b1Link }}" target="_blank" class="d-block w-100 overflow-hidden">
                    @endif
                        <img src="{{ $b1Url }}" alt="Ad Banner 1" class="img-fluid w-100" style="border-radius: 0px !important; width: 100%; max-height: 280px; object-fit: cover; display: block; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);">
                    @if($b1Link)
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif

    <!--====== Promo Banner Restored to Original Position ======-->
    <section class="promo-banner-section p-t-60 p-b-60 bg-white">
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
    <!--====== Start What You Will Learn ======-->
    @if(isset($course) && $course && $course->outcomes)
    <section class="what-you-learn-section p-t-80 p-b-80 position-relative" style="background-color: #F9FAFB;">
        <div class="container container-1278">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="common-heading text-center m-b-40">
                        <span class="sub-title text-uppercase fw-bold m-b-12 d-inline-block" style="color: #10b981; letter-spacing: 1.5px; font-size: 14px;">
                            {{ __('WHAT YOU WILL LEARN') }}
                        </span>
                        <h2 class="fw-bold m-b-0" style="color: #1a1b4b; font-size: 38px; line-height: 1.25;">
                            {{ __('Course Outcomes & Key Takeaways') }}
                        </h2>
                    </div>
                    <div class="card shadow-lg border-0 p-4 p-md-5" style="border-radius: 20px; background: #ffffff;">
                        <div class="learn-outcomes-content" style="color: #475569; font-size: 16px; line-height: 1.8;">
                            {!! $course->outcomes !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!--====== Start Instructor Profile ======-->
    @if(isset($course) && $course && $course->instructor)
    <section class="instructor-section p-t-80 p-b-80 bg-white">
        <div class="container container-1278">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="common-heading text-center m-b-40">
                        <span class="sub-title text-uppercase fw-bold m-b-12 d-inline-block" style="color: #10b981; letter-spacing: 1.5px; font-size: 14px;">
                            {{ __('MEET YOUR INSTRUCTOR') }}
                        </span>
                        <h2 class="fw-bold m-b-0" style="color: #1a1b4b; font-size: 38px; line-height: 1.25;">
                            {{ __('Learn From An Expert Mentor') }}
                        </h2>
                    </div>

                    <div class="instructor-card p-4 p-md-5 bg-white shadow-lg border border-light" style="border-radius: 20px;">
                        <img src="{{ getFileLink('100x100', $course->instructor->image) }}" 
                             class="rounded-circle mb-4 shadow" 
                             alt="{{ $course->instructor->name }}" 
                             style="width: 130px; height: 130px; object-fit: cover; border: 4px solid #10b981; padding: 3px;">
                        
                        <h3 class="fw-bold mb-1" style="color: #1a1b4b; font-size: 24px;">{{ $course->instructor->name }}</h3>
                        <span class="d-inline-block fw-semibold mb-4 px-3 py-1 rounded-pill" style="background: rgba(16, 185, 129, 0.12); color: #10b981; font-size: 14px;">
                            {{ $course->instructor->instructor->designation ?? 'Lead Instructor' }}
                        </span>
                        
                        <div class="text-secondary" style="line-height: 1.8; color: #64748b; font-size: 15.5px;">
                            {!! $course->instructor->about !!}
                        </div>
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

    <!--====== Start Why Choose Me Section ======-->
    @include('frontend.homePage.why_choose_section')

    <!--====== Start FAQ Section ======-->
    @include('frontend.homePage.faq')

    <!--====== Start Ad Banner 2 (Lower Home Section) ======-->
    @php
        $b2ImgSetting = setting('home_ad_banner_image_2');
        $b2Url = '';
        if ($b2ImgSetting) {
            $b2Url = getFileLink('original_image', $b2ImgSetting);
        }
        $b2Status = setting('home_ad_banner_status_2') !== '0';
        $b2Link = setting('home_ad_banner_link_2');
    @endphp

    @if($b2Url && $b2Status && !str_contains($b2Url, 'default'))
    <section class="ad-banner-section-2 p-t-60 p-b-60 bg-white overflow-hidden">
        <div class="container container-1278">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    @if($b2Link)
                        <a href="{{ $b2Link }}" target="_blank" class="d-block w-100 overflow-hidden">
                    @endif
                        <img src="{{ $b2Url }}" alt="Ad Banner 2" class="img-fluid w-100" style="border-radius: 0px !important; width: 100%; max-height: 280px; object-fit: cover; display: block; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);">
                    @if($b2Link)
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif



    <!--====== Global Countdown Script for both timers is now in footer.blade.php ======-->

    <!--====== Start Footer ======-->
    </div>
    @include('frontend.layouts.footer')
@endsection

