@extends('frontend.layouts.master')
@section('title', isset($course) && $course ? $course->title : __('home'))

@section('base.content')
    <!--====== Start Header ======-->
    @include('frontend.layouts.header.'.$section['header'])
    
    @if(isset($course) && $course)
    <!--====== Start Single Course Hero Section ======-->
    <section class="hero-section" style="background-color: #110B3A; padding: 180px 0 100px 0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 style="font-size: 3rem; font-weight: bold; color: #ffffff; margin-bottom: 20px;">{{ setting('single_hero_title') ?: $course->title }}</h1>
                    <p style="font-size: 1.1rem; color: #d1d5db; line-height: 1.8; margin-bottom: 30px;">
                        {{ setting('single_hero_description') ?: ($course->short_description ?? strip_tags($course->description)) }}
                    </p>
                    <!-- CTA is hidden for now -->
                </div>
                <div class="col-lg-6">
                    @if(setting('single_hero_image') || $course->image)
                        <img src="{{ setting('single_hero_image') ? setting('single_hero_image') : getFileLink('original_image', $course->image) }}" alt="{{ $course->title }}" class="img-fluid rounded shadow-lg" style="width: 100%; object-fit: cover;">
                    @else
                        <div class="bg-secondary rounded shadow-lg d-flex align-items-center justify-content-center" style="width: 100%; height: 400px; color: #fff;">
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
    <section class="curriculum-section" style="background-color: #f8f9fa; padding: 80px 0;">
        <div class="container">
            <h2 class="text-center mb-5" style="font-weight: 700; color: #110B3A;">Course Curriculum</h2>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="curriculum-tab">
                        <div class="accordion accordion-flush" id="curriculumAccordion">
                            @foreach($sections as $key => $section)
                                <div class="accordion-item shadow-sm mb-3" style="border: none; border-radius: 10px; overflow: hidden;">
                                    <div class="accordion-header" id="course-curriculum-heading{{$key}}">
                                        <div class="accordion-button {{ $key == 0 ? '' : 'collapsed' }}" role="button" data-bs-toggle="collapse" data-bs-target="#course-curriculum-collapse{{$key}}" {{ $key == 0 ? 'aria-expanded="true"' : 'aria-expanded="false"' }} aria-controls="course-curriculum-collapse{{$key}}" style="background-color: #ffffff; color: #110B3A; font-weight: 600; padding: 20px; font-size: 1.1rem; box-shadow: none;">
                                            {{ $section->title }}
                                        </div>
                                    </div>
                                    <div id="course-curriculum-collapse{{$key}}" class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}" aria-labelledby="course-curriculum-heading{{$key}}" data-bs-parent="#curriculumAccordion">
                                        <div class="accordion-body bg-white border-top" style="padding: 0;">
                                            @if($lessons && count($lessons->where('section_id', $section->id)) > 0)
                                                <ul class="list-unstyled mb-0">
                                                    @foreach($lessons->where('section_id', $section->id) as $lesson)
                                                        <li class="d-flex justify-content-between align-items-center border-bottom" style="padding: 15px 25px;">
                                                            <div class="d-flex align-items-center">
                                                                @if($lesson->lesson_type == 'video')
                                                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-3"><path d="M15 12.3301L9 16.6603L9 8.00004L15 12.3301Z" fill="#ea580c"/><path fill-rule="evenodd" clip-rule="evenodd" d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22ZM12 20.5C16.6944 20.5 20.5 16.6944 20.5 12C20.5 7.30558 16.6944 3.5 12 3.5C7.30558 3.5 3.5 7.30558 3.5 12C3.5 16.6944 7.30558 20.5 12 20.5Z" fill="#ea580c"/></svg>
                                                                @elseif($lesson->lesson_type == 'audio')
                                                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-3"><path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22ZM11 16V8L16 12L11 16Z" fill="#FDCC0D"/></svg>
                                                                @else
                                                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-3"><path d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M14 2V8H20" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 13H8" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 17H8" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M10 9H8" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                                @endif
                                                                <span style="font-weight: 500; color: #4b5563;">{{ $lesson->title }}</span>
                                                            </div>
                                                            <span class="text-muted" style="font-size: 14px;">{{ $lesson->duration }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <p class="text-muted mb-0" style="padding: 15px 25px;">No lessons available in this module.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!--====== Start Promotional Banner Section ======-->
    <section class="promo-banner-section" style="padding: 60px 0 0 0;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="promo-box" style="background-color: #fcd34d; border-radius: 20px; padding: 50px 30px; text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                        <h2 style="font-size: 2.2rem; font-weight: 800; color: #1e3a8a; margin-bottom: 40px;">
                            {{ setting('promo_banner_title') ?: 'Admission Is Open For The Next Batch. Take Admission And Get 40% Discount' }}
                        </h2>
                        
                        <div class="countdown-container d-flex justify-content-center gap-3 mb-5" id="promoCountdown" data-target="{{ setting('promo_banner_countdown') ?: date('Y-m-d H:i:s', strtotime('+5 days')) }}">
                            <div class="countdown-item bg-white" style="border-radius: 12px; padding: 20px; width: 100px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                                <h3 class="days m-0" style="color: #ea580c; font-weight: 700; font-size: 2rem;">00</h3>
                                <span style="font-size: 0.8rem; font-weight: 600; color: #6b7280; text-transform: uppercase;">Days</span>
                            </div>
                            <div class="countdown-item bg-white" style="border-radius: 12px; padding: 20px; width: 100px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                                <h3 class="hours m-0" style="color: #ea580c; font-weight: 700; font-size: 2rem;">00</h3>
                                <span style="font-size: 0.8rem; font-weight: 600; color: #6b7280; text-transform: uppercase;">Hours</span>
                            </div>
                            <div class="countdown-item bg-white" style="border-radius: 12px; padding: 20px; width: 100px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                                <h3 class="minutes m-0" style="color: #ea580c; font-weight: 700; font-size: 2rem;">00</h3>
                                <span style="font-size: 0.8rem; font-weight: 600; color: #6b7280; text-transform: uppercase;">Minutes</span>
                            </div>
                            <div class="countdown-item bg-white" style="border-radius: 12px; padding: 20px; width: 100px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                                <h3 class="seconds m-0" style="color: #ea580c; font-weight: 700; font-size: 2rem;">00</h3>
                                <span style="font-size: 0.8rem; font-weight: 600; color: #6b7280; text-transform: uppercase;">Seconds</span>
                            </div>
                        </div>

                        <a href="{{ setting('promo_banner_btn_link') ?: '#' }}" class="btn" style="background-color: #ea580c; color: white; padding: 15px 40px; border-radius: 30px; font-weight: 700; font-size: 1.1rem; text-transform: uppercase; box-shadow: 0 4px 15px rgba(234, 88, 12, 0.4); text-decoration: none;">
                            {{ setting('promo_banner_btn_text') ?: 'APPLY NOW' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== Countdown Script ======-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const countdownEl = document.getElementById('promoCountdown');
            if(countdownEl) {
                const targetDateStr = countdownEl.getAttribute('data-target');
                // Support Safari by replacing dashes with slashes if needed, or parse properly
                const targetDate = new Date(targetDateStr.replace(/-/g, '/')).getTime();

                const timer = setInterval(function() {
                    const now = new Date().getTime();
                    const distance = targetDate - now;

                    if (distance < 0) {
                        clearInterval(timer);
                        return; // Already expired
                    }

                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    countdownEl.querySelector('.days').innerText = days;
                    countdownEl.querySelector('.hours').innerText = hours;
                    countdownEl.querySelector('.minutes').innerText = minutes;
                    countdownEl.querySelector('.seconds').innerText = seconds;
                }, 1000);
            }
        });
    </script>
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
    <section class="what-you-learn-section" style="padding: 80px 0;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 class="text-center mb-5" style="font-weight: 700; color: #110B3A;">What You Will Learn</h2>
                    <div class="card shadow-sm border-0" style="border-radius: 10px; padding: 30px;">
                        {!! $course->outcomes !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif


    <!--====== Start Instructor Profile ======-->
    @if($course->instructor)
    <section class="instructor-section" style="padding: 80px 0;">
        <div class="container">
            <h2 class="text-center mb-5" style="font-weight: 700; color: #110B3A;">Meet Your Instructor</h2>
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <img src="{{ getFileLink('100x100', $course->instructor->image) }}" class="rounded-circle mb-4 shadow" alt="{{ $course->instructor->name }}" style="width: 150px; height: 150px; object-fit: cover;">
                    <h4 style="font-weight: 700; color: #110B3A;">{{ $course->instructor->name }}</h4>
                    <p style="color: #6b7280; margin-bottom: 20px;">{{ $course->instructor->instructor->designation ?? 'Instructor' }}</p>
                    <div style="color: #4b5563; line-height: 1.8;">
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

    <!--====== Start Footer ======-->
    @include('frontend.layouts.footer')
@endsection

