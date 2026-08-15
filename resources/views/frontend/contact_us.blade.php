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

    <!--====== Page Header ======-->
    <section class="page-header-area p-t-80 p-b-80" style="background-color: #110B3A;">
        <div class="container container-1278">
            <div class="row align-items-center text-center">
                <div class="col-12">
                    <span class="sub-title text-uppercase fw-bold mb-2 d-inline-block" style="color: var(--theme-clr, var(--color-secondary-4)); letter-spacing: 1.5px; font-size: 14px; font-family: var(--header-font);">
                        {{ __($banner_sub) }}
                    </span>
                    <h1 class="title fw-bold text-white mb-3" style="font-size: 2.2rem; font-family: var(--header-font);">
                        {{ __($banner_title) }}
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="color: #94a3b8; text-decoration: none; font-family: var(--body-font);">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page" style="font-family: var(--body-font);">{{ __($banner_title) }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

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

        .contact-input-field {
            height: 50px !important;
            background-color: #ffffff !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 10px !important;
            padding: 0 16px !important;
            font-size: 14px !important;
            color: #1e293b !important;
            font-family: var(--body-font) !important;
            transition: all 0.2s ease-in-out;
        }
        .contact-input-field:focus {
            border-color: var(--theme-clr, #10b981) !important;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.12) !important;
            outline: none !important;
        }

        .contact-textarea-field {
            background-color: #ffffff !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 10px !important;
            padding: 14px 16px !important;
            font-size: 14px !important;
            color: #1e293b !important;
            font-family: var(--body-font) !important;
            transition: all 0.2s ease-in-out;
            resize: vertical;
            min-height: 140px;
        }
        .contact-textarea-field:focus {
            border-color: var(--theme-clr, #10b981) !important;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.12) !important;
            outline: none !important;
        }

        .contact-submit-btn {
            height: 50px !important;
            background-color: var(--theme-clr, #10b981) !important;
            color: #ffffff !important;
            border: none !important;
            border-radius: 10px !important;
            font-size: 15px !important;
            font-weight: 600 !important;
            font-family: var(--body-font) !important;
            transition: all 0.3s ease !important;
        }
        .contact-submit-btn:hover {
            background-color: var(--theme-hover-clr, #059669) !important;
            color: #ffffff !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(16, 185, 129, 0.3) !important;
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
    </style>

    <!--====== Main Section ======-->
    <section class="contact-us-page-section">
        <div class="container container-1278">
            <!-- Top Header Section -->
            <div class="text-center mb-5">
                <div class="contact-top-badge mx-auto mb-3">
                    <i class="fas fa-paper-plane" style="transform: rotate(-10deg);"></i>
                </div>
                <h1 class="fw-bold mb-2" style="color: #0f172a; font-size: 2.2rem; font-family: var(--header-font);">
                    {{ __($page_title) }}
                </h1>
                <p class="text-muted mx-auto mb-3" style="max-width: 580px; font-size: 15px; line-height: 1.6; color: #64748b; font-family: var(--body-font);">
                    {!! nl2br(e(__($page_subtitle))) !!}
                </p>
                <div class="mx-auto" style="width: 36px; height: 3px; background-color: var(--theme-clr, #10b981); border-radius: 2px;"></div>
            </div>

            <!-- Main Content 2-Column Row (Form on Left, Map on Right) -->
            <div class="row g-4 align-items-stretch mb-5">
                <!-- Left Column: Form -->
                <div class="col-lg-6">
                    <div class="contact-form-card h-100 p-4 p-md-5" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.04);">
                        <form action="{{ route('instructor.contact') }}" method="POST" class="user-form">
                            @csrf
                            <div class="row g-3">
                                <!-- Your Name & Your Email -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold d-flex align-items-center mb-2" style="font-size: 14px; color: #0f172a;">
                                        <i class="fal fa-user me-2" style="color: var(--theme-clr, #10b981); font-size: 15px;"></i>
                                        {{ __('Your Name') }}
                                    </label>
                                    <input type="text" name="name" class="form-control contact-input-field" placeholder="{{ __('Enter your full name') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold d-flex align-items-center mb-2" style="font-size: 14px; color: #0f172a;">
                                        <i class="fal fa-envelope me-2" style="color: var(--theme-clr, #10b981); font-size: 15px;"></i>
                                        {{ __('Your Email') }}
                                    </label>
                                    <input type="email" name="email" class="form-control contact-input-field" placeholder="{{ __('Enter your email address') }}" required>
                                </div>

                                <!-- Subject -->
                                <div class="col-12">
                                    <label class="form-label fw-semibold d-flex align-items-center mb-2" style="font-size: 14px; color: #0f172a;">
                                        <i class="fal fa-tag me-2" style="color: var(--theme-clr, #10b981); font-size: 15px;"></i>
                                        {{ __('Subject') }}
                                    </label>
                                    <input type="text" name="subject" class="form-control contact-input-field" placeholder="{{ __('Enter subject') }}" required>
                                </div>

                                <!-- Message -->
                                <div class="col-12">
                                    <label class="form-label fw-semibold d-flex align-items-center mb-2" style="font-size: 14px; color: #0f172a;">
                                        <i class="fal fa-comment-alt me-2" style="color: var(--theme-clr, #10b981); font-size: 15px;"></i>
                                        {{ __('Message') }}
                                    </label>
                                    <textarea name="message" class="form-control contact-textarea-field" rows="5" placeholder="{{ __('Write your message here...') }}" required></textarea>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn contact-submit-btn w-100 d-flex align-items-center justify-content-center">
                                        <span>{{ __('Send Message') }}</span>
                                        <i class="fas fa-paper-plane ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right Column: Map with Floating Card Overlay -->
                <div class="col-lg-6">
                    <div class="map-card-wrapper h-100 position-relative" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.04); min-height: 480px;">
                        <!-- Floating Location Overlay -->
                        <div class="map-location-badge position-absolute" style="top: 24px; left: 24px; z-index: 10; background: #ffffff; border-radius: 12px; padding: 16px 20px; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08); border: 1px solid #f1f5f9; max-width: 260px;">
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
                <div class="col-lg-4 col-md-6">
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
                <div class="col-lg-4 col-md-6">
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
                <div class="col-lg-4 col-md-6">
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
