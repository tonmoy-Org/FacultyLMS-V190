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

    <!--====== Start Categories of Work Section ======-->
    @include('frontend.homePage.categories_of_work')

    <!--====== Start Benefits Section ======-->
    @include('frontend.homePage.benefits')

    <!--====== Start Special Gift Section ======-->
    @include('frontend.homePage.special_gift')


    <!--====== Start Ad Banner 1 (Upper Home Section) ======-->
    @php
        $b1ImgSetting = setting('home_ad_banner_image_1') ?: setting('home_ad_banner_image');
        $b1Url = '';
        if ($b1ImgSetting) {
            $b1Url = getFileLink('original_image', $b1ImgSetting);
        }
        $b1Status = setting('home_ad_banner_status_1') !== '0';
        $b1Link = setting('home_ad_banner_link_1') ?: setting('home_ad_banner_link');
        
        if(isset($course) && $course) {
            $mcSettings = is_array($course->masterclass_settings) ? $course->masterclass_settings : json_decode($course->masterclass_settings ?? '[]', true);
            if(is_array($mcSettings)) {
                $b1Url = !empty($mcSettings['ad_banner_1_image_url']) ? $mcSettings['ad_banner_1_image_url'] : $b1Url;
                $b1Status = isset($mcSettings['ad_banner_1_status']) ? !empty($mcSettings['ad_banner_1_status']) : $b1Status;
                $b1Link = !empty($mcSettings['ad_banner_1_link']) ? $mcSettings['ad_banner_1_link'] : $b1Link;
            }
        }
    @endphp
    @if($b1Url && $b1Status && !str_contains($b1Url, 'default'))
    <section class="ad-banner-section-1 p-t-60 p-b-60 bg-white overflow-hidden">
        <div class="container container-1278">
            <div class="row justify-content-center">
                <div class="col-12 text-center" data-aos="fade-up">
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


    <!--====== Start What You Will Learn ======-->
    @if(isset($course) && $course && $course->outcomes)
    <section class="what-you-learn-section p-t-60 p-b-60 position-relative" style="background-color: #F9FAFB;">
        <div class="container container-1278">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="common-heading text-center m-b-40" data-aos="fade-up">
                        <span class="sub-title text-uppercase fw-bold m-b-12 d-inline-block" style="color: #10b981; letter-spacing: 1.5px; font-size: 14px;">
                            {{ __('WHAT YOU WILL LEARN') }}
                        </span>
                        <h2 class="fw-bold m-b-0" style="color: #1a1b4b; font-size: 38px; line-height: 1.25;">
                            {{ __('Course Outcomes & Key Takeaways') }}
                        </h2>
                    </div>
                    <div class="card shadow-lg border-0 p-4 p-md-5" data-aos="fade-up" data-aos-delay="100" style="border-radius: 20px; background: #ffffff;">
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
    <section class="instructor-section p-t-60 p-b-60 bg-white">
        <div class="container container-1278">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="common-heading text-center m-b-40" data-aos="fade-up">
                        <span class="sub-title text-uppercase fw-bold m-b-12 d-inline-block" style="color: #10b981; letter-spacing: 1.5px; font-size: 14px;">
                            {{ __('MEET YOUR INSTRUCTOR') }}
                        </span>
                        <h2 class="fw-bold m-b-0" style="color: #1a1b4b; font-size: 38px; line-height: 1.25;">
                            {{ __('Learn From An Expert Mentor') }}
                        </h2>
                    </div>

                    <div class="instructor-card p-4 p-md-5 bg-white shadow-lg border border-light" data-aos="fade-up" data-aos-delay="100" style="border-radius: 20px;">
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





    <!--====== Start Syllabus Section ======-->
    @include('frontend.homePage.syllabus')

    <!--====== Start Offer Breakdown Section ======-->
    @include('frontend.homePage.offer_breakdown')



    <!--====== Start Ad Banner 2 (Lower Home Section) ======-->
    @php
        $b2ImgSetting = setting('home_ad_banner_image_2');
        $b2Url = '';
        if ($b2ImgSetting) {
            $b2Url = getFileLink('original_image', $b2ImgSetting);
        }
        $b2Status = setting('home_ad_banner_status_2') !== '0';
        $b2Link = setting('home_ad_banner_link_2');
        
        if(isset($course) && $course) {
            $mcSettings = is_array($course->masterclass_settings) ? $course->masterclass_settings : json_decode($course->masterclass_settings ?? '[]', true);
            if(is_array($mcSettings)) {
                $b2Url = !empty($mcSettings['ad_banner_2_image_url']) ? $mcSettings['ad_banner_2_image_url'] : $b2Url;
                $b2Status = isset($mcSettings['ad_banner_2_status']) ? !empty($mcSettings['ad_banner_2_status']) : $b2Status;
                $b2Link = !empty($mcSettings['ad_banner_2_link']) ? $mcSettings['ad_banner_2_link'] : $b2Link;
            }
        }
    @endphp

    @if($b2Url && $b2Status && !str_contains($b2Url, 'default'))
    <section class="ad-banner-section-2 p-t-60 p-b-60 bg-white overflow-hidden">
        <div class="container container-1278">
            <div class="row justify-content-center">
                <div class="col-12 text-center" data-aos="fade-up">
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

    <!--====== Start Success Banner Section ======-->
    @php
        $successBannerImg = setting('success_page_banner_image');
        $successBannerUrl = '';
        if (is_array($successBannerImg) && !empty($successBannerImg['original_image'])) {
            $successBannerUrl = get_media($successBannerImg['original_image'], $successBannerImg['storage'] ?? 'local');
        } elseif ($successBannerImg) {
            $successBannerUrl = getFileLink('original_image', $successBannerImg);
        }
    @endphp
    @if((string)setting('success_page_banner_status') !== '0' && $successBannerUrl && !str_contains($successBannerUrl, 'default'))
    <section class="success-banner-section p-t-60 p-b-20 bg-white overflow-hidden">
        <div class="container container-1278">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <div class="common-heading text-center m-b-40" data-aos="fade-up">
                        <span class="sub-title text-uppercase fw-bold m-b-12 d-inline-block" style="color: #10b981; letter-spacing: 1.5px; font-size: 14px;">
                            {{ setting('success_page_banner_tag') ?: 'Success Stories' }}
                        </span>
                        <h2 class="fw-bold m-b-20" style="color: #1a1b4b; font-size: 38px; line-height: 1.25;">
                            {{ setting('success_page_banner_title') ?: 'Real People. Real Learning. Real Success.' }}
                        </h2>
                        <p class="text-muted font-16">{{ setting('success_page_banner_description') ?: 'Discover how learners are achieving their goals and building better futures with Faculty.' }}</p>
                    </div>
                    <img src="{{ $successBannerUrl }}" alt="Success Banner" class="img-fluid w-100" data-aos="fade-up" data-aos-delay="100" style="border-radius: 20px; max-height: 500px; object-fit: cover; display: block; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);">
                </div>
            </div>
        </div>
    </section>
    @endif

    <!--====== Start Success Story Section ======-->
    @include('frontend.homePage.success')

    <!--====== Start FAQ Section ======-->
    @include('frontend.homePage.faq')

    <!--====== Start Support Section ======-->
    @include('frontend.homePage.support')





    <!--====== Start Coupon Banner Section ======-->
    @if(isset($active_banner_coupon) && $active_banner_coupon && $active_banner_coupon->image)
    <section class="coupon-banner-section p-t-60 p-b-60 bg-white overflow-hidden">
        <style>
            .coupon-code-badge {
                cursor: pointer;
                user-select: none;
                transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
            }
            .coupon-code-badge:hover {
                transform: translateX(-50%) scale(1.05) !important;
                box-shadow: 0 6px 18px rgba(16, 185, 129, 0.35) !important;
            }
            .coupon-code-badge:active {
                transform: translateX(-50%) scale(0.98) !important;
            }
        </style>
        <div class="container container-1278">
            <div class="row justify-content-center">
                <div class="col-12 text-center" data-aos="fade-up">
                    <div class="coupon-banner-wrapper position-relative d-inline-block">
                        <img src="{{ getFileLink('original_image', $active_banner_coupon->image) }}" alt="Special Offer Coupon" class="img-fluid rounded shadow-sm" style="max-width: 100%; max-height: 400px; object-fit: cover; border: 2px dashed #10b981;">
                        <div class="coupon-code-badge position-absolute"
                             id="bannerCouponBadge"
                             onclick="copyCouponCode('{{ $active_banner_coupon->code }}', this)"
                             title="Click to copy coupon code"
                             style="bottom: -15px; left: 50%; transform: translateX(-50%); background: #1a1b4b; color: white; padding: 8px 24px; border-radius: 30px; font-weight: bold; font-size: 18px; box-shadow: 0 4px 10px rgba(0,0,0,0.15); border: 2px solid #10b981;">
                            CODE: <span style="color: #10b981;">{{ $active_banner_coupon->code }}</span>
                            <svg class="ms-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: -2px;">
                                <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-4 text-muted font-15">Use this code at checkout to get {{ $active_banner_coupon->discount_type == 'percent' ? $active_banner_coupon->discount . '%' : get_price($active_banner_coupon->discount, userCurrency()) }} off!</p>
                </div>
            </div>
        </div>
    </section>

    <script>
    function copyCouponCode(code, element) {
        if (!code) return;

        function onSuccess() {
            if (element) {
                const originalContent = element.innerHTML;
                element.innerHTML = '<span style="color: #ffffff;"><svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: -3px;"><polyline points="20 6 9 17 4 12"></polyline></svg> Copied!</span>';
                element.style.background = '#10b981';
                element.style.borderColor = '#047857';

                setTimeout(function() {
                    element.innerHTML = originalContent;
                    element.style.background = '#1a1b4b';
                    element.style.borderColor = '#10b981';
                }, 2000);
            }

            const guestCouponInput = document.getElementById('guest_coupon_code');
            if (guestCouponInput) {
                guestCouponInput.value = code;
                const couponWrapper = document.querySelector('.coupon-form-wrapper');
                if (couponWrapper) {
                    couponWrapper.style.display = 'block';
                }
            }
        }

        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(code).then(onSuccess).catch(function() {
                fallbackCopy();
            });
        } else {
            fallbackCopy();
        }

        function fallbackCopy() {
            try {
                var tempInput = document.createElement("input");
                tempInput.value = code;
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand("copy");
                document.body.removeChild(tempInput);
                onSuccess();
            } catch (err) {
                console.error('Failed to copy coupon code: ', err);
            }
        }
    }
    </script>
    @endif

    <!--====== Start Order Form Section ======-->
    @include('frontend.homePage.order_form')



    <!--====== Global Countdown Script for both timers is now in footer.blade.php ======-->

    <!--====== Start Footer ======-->
    </div>
    @include('frontend.layouts.footer')
@endsection

