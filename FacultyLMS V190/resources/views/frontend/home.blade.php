@extends('frontend.layouts.master')
@section('title', isset($course) && $course ? $course->title : __('home'))

@section('base.content')
    <!--====== Start Header ======-->
    @include('frontend.layouts.header.'.$section['header'])
    
    @if(isset($course) && $course)
    <!--====== Start Single Course Hero Section ======-->
    <section class="hero-area hero-area-v5 p-t-120 p-b-100 p-b-md-40" style="background-color: #110B3A;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title m-b-20" style="color: #ffffff;">{{ setting('single_hero_title') ?: $course->title }}</h1>
                    <p class="m-b-30" style="font-size: 1.1rem; line-height: 1.8; color: #d1d5db;">
                        {{ setting('single_hero_description') ?: ($course->short_description ?? strip_tags($course->description)) }}
                    </p>
                    <a href="{{ route('course.details', $course->slug) }}" class="template-btn mt-4">{{ __('Enroll Now') }}</a>
                </div>
                <div class="col-lg-6">
                    @if(setting('single_hero_image') || $course->image)
                        <img src="{{ setting('single_hero_image') ? setting('single_hero_image') : getFileLink('original_image', $course->image) }}" alt="{{ $course->title }}" class="img-fluid rounded shadow-lg w-100">
                    @else
                        <div class="bg-secondary rounded shadow-lg d-flex align-items-center justify-content-center w-100" style="height: 400px; color: #fff;">
                            <h3>No Image Available</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!--====== Start Course Curriculum ======-->
    @php
        $sections = $course->sections;
        $lessons = $course->lessons;
    @endphp
    @if($sections && count($sections) > 0)
    <section class="curriculum-section p-t-80 p-b-80 bg-white">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">Course Curriculum</h2>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="curriculum-tab">
                        <div class="accordion accordion-flush" id="curriculumAccordion">
                            @foreach($sections as $key => $section)
                                <div class="accordion-item shadow-sm mb-3 rounded overflow-hidden border-0">
                                    <div class="accordion-header" id="course-curriculum-heading{{$key}}">
                                        <div class="accordion-button fw-semibold p-4 {{ $key == 0 ? '' : 'collapsed' }}" role="button" data-bs-toggle="collapse" data-bs-target="#course-curriculum-collapse{{$key}}" {{ $key == 0 ? 'aria-expanded="true"' : 'aria-expanded="false"' }} aria-controls="course-curriculum-collapse{{$key}}" style="font-size: 1.1rem; box-shadow: none;">
                                            {{ $section->title }}
                                        </div>
                                    </div>
                                    <div id="course-curriculum-collapse{{$key}}" class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}" aria-labelledby="course-curriculum-heading{{$key}}" data-bs-parent="#curriculumAccordion">
                                        <div class="accordion-body bg-white border-top p-0">
                                            @if($lessons && count($lessons->where('section_id', $section->id)) > 0)
                                                <ul class="list-unstyled mb-0">
                                                    @foreach($lessons->where('section_id', $section->id) as $lesson)
                                                        <li class="d-flex justify-content-between align-items-center border-bottom p-3 p-md-4">
                                                            <div class="d-flex align-items-center">
                                                                @if($lesson->lesson_type == 'video')
                                                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-3"><path d="M15 12.3301L9 16.6603L9 8.00004L15 12.3301Z" fill="#ea580c"/><path fill-rule="evenodd" clip-rule="evenodd" d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22ZM12 20.5C16.6944 20.5 20.5 16.6944 20.5 12C20.5 7.30558 16.6944 3.5 12 3.5C7.30558 3.5 3.5 7.30558 3.5 12C3.5 16.6944 7.30558 20.5 12 20.5Z" fill="#ea580c"/></svg>
                                                                @elseif($lesson->lesson_type == 'audio')
                                                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-3"><path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22ZM11 16V8L16 12L11 16Z" fill="#FDCC0D"/></svg>
                                                                @else
                                                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-3"><path d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M14 2V8H20" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 13H8" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 17H8" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M10 9H8" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                                @endif
                                                                <span class="fw-medium text-secondary">{{ $lesson->title }}</span>
                                                            </div>
                                                            <span class="text-muted small">{{ $lesson->duration }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <p class="text-muted mb-0 p-3 p-md-4">No lessons available in this module.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('course.details', $course->slug) }}" class="template-btn">{{ __('Enroll Now') }}</a>
            </div>
        </div>
    </section>
    @endif

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
    @endif

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

