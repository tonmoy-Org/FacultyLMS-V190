@extends('frontend.layouts.master')
@section('title', __('Contact Us'))

@section('content')
    @php
        $banner_sub = setting('contact_banner_sub_title', app()->getLocale()) ?: (setting('contact_banner_sub_title') ?: 'WE\'D LOVE TO HEAR FROM YOU');
        $banner_title = setting('contact_banner_title', app()->getLocale()) ?: (setting('contact_banner_title') ?: 'Contact Us');

        $page_title = setting('contact_page_title', app()->getLocale()) ?: (setting('contact_page_title') ?: 'Get In Touch');
        $page_subtitle = setting('contact_page_subtitle', app()->getLocale()) ?: (setting('contact_page_subtitle') ?: 'Feel free to reach out to us with any questions or inquiries. We will get back to you as soon as possible.');

        $location_title = setting('contact_location_title', app()->getLocale()) ?: (setting('contact_location_title') ?: 'Our Location');
        $location_subtitle = setting('contact_location_subtitle', app()->getLocale()) ?: (setting('contact_location_subtitle') ?: 'We\'d love to hear from you!');

        $address = setting('contact_address', app()->getLocale()) ?: (setting('contact_address') ?: (setting('address') ?: '99 Roving St, Big City AC 12345, USA'));
        $phone = setting('contact_phone') ?: (setting('phone') ?: '+123-234-1234');
        $phone_schedule = setting('contact_phone_schedule', app()->getLocale()) ?: (setting('contact_phone_schedule') ?: 'Mon - Fri: 9:00 AM - 6:00 PM');

        $email = setting('contact_email') ?: (setting('email') ?: 'Hello@Awesomesite.Com');
        $email_response = setting('contact_email_response', app()->getLocale()) ?: (setting('contact_email_response') ?: 'We reply within 24 hours');

        // Dynamic Map URL / Embed logic
        $map_input = trim((string)(setting('contact_map_url') ?: setting('contact_map_iframe')));
        $map_iframe_html = null;
        $map_src = null;

        if (!empty($map_input)) {
            if (str_contains($map_input, '<iframe')) {
                $map_iframe_html = $map_input;
            } else {
                // Expand shortlinks like maps.app.goo.gl or goo.gl
                if (str_contains($map_input, 'goo.gl') || str_contains($map_input, 'maps.app.goo.gl')) {
                    try {
                        $headers = @get_headers($map_input, 1);
                        $redirect_loc = $headers['Location'] ?? ($headers['location'] ?? null);
                        if (is_array($redirect_loc)) {
                            $redirect_loc = end($redirect_loc);
                        }
                        if (!empty($redirect_loc)) {
                            $map_input = $redirect_loc;
                        }
                    } catch (\Throwable $e) {
                        // Keep original input if header check fails
                    }
                }

                if (str_contains($map_input, 'google.com/maps/embed') || str_contains($map_input, 'output=embed')) {
                    $map_src = $map_input;
                } else {
                    $query = $map_input;
                    if (str_contains($map_input, '/place/')) {
                        $parts = explode('/place/', $map_input);
                        if (isset($parts[1])) {
                            $sub_parts = explode('/', $parts[1]);
                            $query = urldecode($sub_parts[0]);
                        }
                    } elseif (str_contains($map_input, 'q=')) {
                        parse_str(parse_url($map_input, PHP_URL_QUERY) ?? '', $query_params);
                        if (!empty($query_params['q'])) {
                            $query = $query_params['q'];
                        }
                    }
                    $map_src = 'https://maps.google.com/maps?q=' . urlencode($query) . '&t=&z=15&ie=UTF8&iwloc=&output=embed';
                }
            }
        } else {
            $map_src = 'https://maps.google.com/maps?q=' . urlencode($address) . '&t=&z=15&ie=UTF8&iwloc=&output=embed';
        }
    @endphp

@if((string)setting('contact_page_banner_status') !== '0')
@php
    $contactBannerSetting = setting('contact_page_banner_image');
    $contactBannerUrl = '';
    if (is_array($contactBannerSetting)) {
        if (!empty($contactBannerSetting['original_image'])) {
            $contactBannerUrl = get_media($contactBannerSetting['original_image'], $contactBannerSetting['storage'] ?? 'local');
        } elseif (!empty($contactBannerSetting['image_417x384'])) {
            $contactBannerUrl = get_media($contactBannerSetting['image_417x384'], $contactBannerSetting['storage'] ?? 'local');
        }
    } elseif (is_string($contactBannerSetting) && !empty($contactBannerSetting)) {
        $contactBannerUrl = getFileLink('original_image', $contactBannerSetting);
    }
    if (empty($contactBannerUrl) || str_contains($contactBannerUrl, 'default-image')) {
        $contactBannerUrl = static_asset('frontend/img/banner/success_hero_banner.jpg');
    }
@endphp
<style>
    .contact-hero-banner {
        background-color: #1e5341;
        background-image: url('{{ $contactBannerUrl }}');
        background-repeat: no-repeat;
        background-position: center right;
        background-size: cover;
        position: relative;
        overflow: hidden;
        color: #ffffff;
        min-height: 280px;
        display: flex;
        align-items: center;
        padding: 35px 0 40px;
    }
    .contact-hero-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 65%;
        background: linear-gradient(90deg, #1e5341 0%, #23614e 35%, #296d58 68%, rgba(41, 109, 88, 0.65) 85%, rgba(41, 109, 88, 0) 100%);
        z-index: 1;
    }
    .contact-hero-banner .badge-pill-tag {
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
        color: #ffffff;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.2px;
        padding: 5px 12px;
        border-radius: 4px;
        display: inline-block;
        text-transform: uppercase;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .contact-hero-banner .banner-main-title {
        color: #ffffff;
        font-size: 36px;
        font-weight: 800;
        line-height: 1.2;
        letter-spacing: -0.5px;
        margin-top: 12px;
        margin-bottom: 12px;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }
    .contact-hero-banner .banner-sub-text {
        color: rgba(255, 255, 255, 0.9);
        font-size: 15px;
        line-height: 1.6;
        max-width: 480px;
        margin-bottom: 14px;
        text-shadow: 0 1px 5px rgba(0, 0, 0, 0.2);
    }
    .contact-hero-banner .decor-icon-circle {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        border: 1.5px solid rgba(16, 185, 129, 0.5);
        background: rgba(7, 53, 39, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        top: 72%;
        transform: translateY(-50%);
        z-index: 3;
    }
    .contact-hero-banner .decor-icon-left {
        left: 25px;
    }
    .contact-hero-banner .decor-icon-right {
        right: 25px;
    }
    .contact-hero-banner .center-logo-badge {
        position: absolute;
        left: 48%;
        top: 72%;
        transform: translate(-50%, -50%);
        z-index: 4;
        width: 42px;
        height: 42px;
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        border-radius: 50%;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0.85;
    }
    .contact-hero-banner .center-logo-badge-inner {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        border: 1.5px solid rgba(16, 185, 129, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.85);
    }
    .contact-hero-banner .breadcrumb-link {
        color: rgba(255, 255, 255, 0.75);
        text-decoration: none;
        transition: color 0.2s;
    }
    .contact-hero-banner .breadcrumb-link:hover {
        color: #ffffff;
    }
    @media (max-width: 991px) {
        .contact-hero-banner::before {
            width: 100%;
            background: linear-gradient(180deg, rgba(7, 53, 39, 0.95) 0%, rgba(42, 104, 81, 0.9) 100%);
        }
        .contact-hero-banner .banner-main-title {
            font-size: 30px;
        }
        .contact-hero-banner .center-logo-badge {
            display: none !important;
        }
    }
    @media (max-width: 576px) {
        .contact-hero-banner {
            padding: 35px 0 45px;
            min-height: auto;
        }
        .contact-hero-banner .banner-main-title {
            font-size: 22px;
        }
    }
</style>

<section class="contact-hero-banner">
    <!-- Decorative Left Support Headset Icon -->
    <div class="decor-icon-circle decor-icon-left d-none d-xl-flex">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
            <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
        </svg>
    </div>

    <!-- Decorative Right Chat/Message Icon -->
    <div class="decor-icon-circle decor-icon-right d-none d-xl-flex">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
        </svg>
    </div>

    <!-- Central White Location Pin Badge -->
    <div class="center-logo-badge d-none d-lg-flex">
        <div class="center-logo-badge-inner">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                <circle cx="12" cy="10" r="3"></circle>
            </svg>
        </div>
    </div>

    <div class="container container-1278 position-relative" style="z-index: 2;">
        <div class="row align-items-center">
            <!-- Left Text Column -->
            <div class="col-lg-7 col-md-8 ps-md-4" data-aos="fade-right">
                <div class="banner-text-content">
                    <span class="badge-pill-tag">
                        {{ setting('contact_page_banner_tag') ?: __('GET IN TOUCH') }}
                    </span>
                    <h1 class="banner-main-title">
                        {!! nl2br(e(setting('contact_page_banner_title') ?: (setting('contact_banner_title') ?: __('We’d Love to Hear From You')))) !!}
                    </h1>
                    <p class="banner-sub-text">
                        {{ setting('contact_page_banner_description') ?: __('Have questions, feedback, or need support? Reach out to our team and we will get back to you promptly.') }}
                    </p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="breadcrumb-link">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">{{ setting('contact_page_banner_title') ?: (setting('contact_banner_title') ?: __('Contact Us')) }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

    <style>
        .contact-us-page-section {
            background-color: #ffffff;
            padding-top: 60px;
            padding-bottom: 70px;
        }

        .contact-top-badge {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: rgba(16, 185, 129, 0.12);
            color: var(--theme-clr, #10b981);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }





        .contact-info-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 32px 24px;
            text-align: center;
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
        }
        .contact-info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px -5px rgba(0, 0, 0, 0.08);
            border-color: rgba(16, 185, 129, 0.4);
        }

        .contact-card-icon-badge {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: rgba(16, 185, 129, 0.12);
            color: var(--theme-clr, #10b981);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        .contact-info-card:hover .contact-card-icon-badge {
            background-color: var(--theme-clr, #10b981);
            color: #ffffff;
            transform: scale(1.08);
        }

        .contact-card-title {
            font-size: 17px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 8px;
            font-family: var(--header-font);
        }

        .contact-card-text {
            font-size: 14px;
            color: #64748b;
            line-height: 1.6;
            font-family: var(--body-font);
            margin-bottom: 0;
        }
        .contact-card-text a {
            color: #64748b;
            text-decoration: none;
            transition: color 0.2s ease;
        }
        .contact-card-text a:hover {
            color: var(--theme-clr, #10b981);
        }

        .map-location-badge {
            transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1), visibility 0.3s cubic-bezier(0.4, 0, 0.2, 1), transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 1;
            visibility: visible;
        }

        .map-card-wrapper:hover .map-location-badge {
            opacity: 0 !important;
            visibility: hidden !important;
            transform: translateY(-8px) scale(0.95);
            pointer-events: none !important;
        }

        .map-iframe-box iframe {
            width: 100% !important;
            height: 100% !important;
            min-height: 480px !important;
            border: 0 !important;
        }
        
        .contact-us-page-section .form-control {
            font-size: 14px;
            padding: 10px 15px;
            border-radius: 8px !important;
        }
        
        .contact-us-page-section label {
            font-size: 14px;
            font-weight: 500;
            color: #334155;
            margin-bottom: 4px;
        }
    </style>

    <!--====== Main Section ======-->
    <section class="contact-us-page-section">
        <div class="container container-1278">
            <!-- Main Content 2-Column Row (Form on Left, Map on Right) -->
            <div class="row g-4 align-items-stretch mb-5">
                <!-- Left Column: Form -->
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="contact-form-card h-100 p-4" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.04);">
                        <form action="{{ route('instructor.contact') }}" method="POST" class="user-form">
                            @csrf
                            <div class="row g-3">
                                <!-- Your Name & Your Email -->
                                <div class="col-md-6">
                                    <label for="name">{{ __('Your Name') }}</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Enter your full name') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email">{{ __('Your Email') }}</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('Enter your email address') }}" required>
                                </div>

                                <!-- Subject -->
                                <div class="col-12">
                                    <label for="subject">{{ __('Subject') }}</label>
                                    <input type="text" name="subject" id="subject" class="form-control" placeholder="{{ __('Enter subject') }}" required>
                                </div>

                                <!-- Message -->
                                <div class="col-12">
                                    <label for="message">{{ __('Message') }}</label>
                                    <textarea name="message" id="message" class="form-control" rows="5" placeholder="{{ __('Write your message here...') }}" required></textarea>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12 mt-4">
                                    <button type="submit" class="template-btn w-100 d-flex align-items-center justify-content-center" style="font-size: 15px; padding: 12px 20px; font-weight: 500; border-radius: 8px;">
                                        <span>{{ __('Send Message') }}</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right Column: Map with Floating Card Overlay -->
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="100">
                    <div class="map-card-wrapper h-100 position-relative" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.04); min-height: 480px;">
                        <!-- Floating Location Overlay -->
                        <div class="map-location-badge position-absolute" style="top: 24px; left: 24px; z-index: 10; background: #ffffff; border-radius: 8px; padding: 16px 20px; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08); border: 1px solid #f1f5f9; max-width: 260px;">
                            <h6 class="fw-bold mb-1" style="color: #0f172a; font-size: 15px; font-family: var(--header-font);">{{ __($location_title) }}</h6>
                            <p class="mb-1 text-secondary" style="font-size: 13px; line-height: 1.4; color: #64748b; font-family: var(--body-font);">{{ $address }}</p>
                            <span style="font-size: 12.5px; color: #64748b; font-family: var(--body-font);">{{ __($location_subtitle) }}</span>
                        </div>

                        <!-- Map Iframe Container -->
                        <div class="map-iframe-box h-100" style="width: 100%; min-height: 480px;">
                            @if(!empty($map_iframe_html))
                                {!! $map_iframe_html !!}
                            @else
                                <iframe 
                                    width="100%" 
                                    height="100%" 
                                    style="border:0; min-height: 480px; width: 100%;" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade" 
                                    src="{{ $map_src }}">
                                </iframe>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Row: 3 Contact Info Cards -->
            <div class="row g-4 justify-content-center">
                <!-- Our Address Card -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="contact-info-card">
                        <div class="contact-card-icon-badge">
                            <i class="fal fa-map-marker-alt fas fa-map-marker-alt"></i>
                        </div>
                        <h5 class="contact-card-title">{{ __('Our Address') }}</h5>
                        <p class="contact-card-text">
                            {!! nl2br(e($address)) !!}
                        </p>
                    </div>
                </div>

                <!-- Phone Number Card -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="contact-info-card">
                        <div class="contact-card-icon-badge">
                            <i class="fal fa-phone fas fa-phone"></i>
                        </div>
                        <h5 class="contact-card-title">{{ __('Phone Number') }}</h5>
                        <p class="contact-card-text">
                            <a href="tel:{{ str_replace(' ', '', $phone) }}">{{ $phone }}</a><br>
                            <span style="font-size: 13px; color: #94a3b8;">{{ __($phone_schedule) }}</span>
                        </p>
                    </div>
                </div>

                <!-- Email Address Card -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="contact-info-card">
                        <div class="contact-card-icon-badge">
                            <i class="fal fa-envelope fas fa-envelope"></i>
                        </div>
                        <h5 class="contact-card-title">{{ __('Email Address') }}</h5>
                        <p class="contact-card-text">
                            <a href="mailto:{{ $email }}">{{ $email }}</a><br>
                            <span style="font-size: 13px; color: #94a3b8;">{{ __($email_response) }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
