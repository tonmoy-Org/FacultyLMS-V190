@extends('frontend.layouts.master')
@section('title', __('Contact Us'))

@section('content')
    <!--====== Page Header ======-->
    <section class="page-header-area p-t-80 p-b-80" style="background-color: #110B3A;">
        <div class="container container-1278">
            <div class="row align-items-center text-center">
                <div class="col-12">
                    <span class="sub-title text-uppercase fw-bold mb-2 d-inline-block" style="color: var(--theme-clr, var(--color-secondary-4)); letter-spacing: 1.5px; font-size: 14px; font-family: var(--header-font);">
                        {{ __('WE\'D LOVE TO HEAR FROM YOU') }}
                    </span>
                    <h1 class="title fw-bold text-white mb-3" style="font-size: 2.2rem; font-family: var(--header-font);">
                        {{ __('Contact Us') }}
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="color: #94a3b8; text-decoration: none; font-family: var(--body-font);">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page" style="font-family: var(--body-font);">{{ __('Contact') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <style>
        .contact-info-card {
            background: #ffffff;
            border: 1px solid #f1f5f9;
            border-radius: 16px;
            padding: 30px 20px;
            text-align: center;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .contact-info-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.03);
            border-color: rgba(16, 185, 129, 0.2);
        }
        .contact-card-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(16, 185, 129, 0.08);
            color: var(--theme-clr, #10b981);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        .contact-info-card:hover .contact-card-icon {
            background: var(--theme-clr, #10b981);
            color: #ffffff;
            transform: scale(1.1) rotate(5deg);
        }
        .contact-card-title {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 10px;
            font-family: var(--header-font);
        }
        .contact-card-value {
            font-size: 14.5px;
            color: #64748b;
            line-height: 1.6;
            font-family: var(--body-font);
            word-break: break-word;
            margin-bottom: 0;
        }
        .contact-card-value a {
            color: #64748b;
            text-decoration: none;
            transition: color 0.2s ease;
        }
        .contact-card-value a:hover {
            color: var(--theme-clr, #10b981);
        }
    </style>

    <!--====== Main Content ======-->
    <section class="policy-content-area p-t-50 p-b-60 bg-white">
        <div class="container container-1278">
            @php
                $address = setting('contact_address', app()->getLocale()) ?: (setting('contact_address') ?: (setting('address') ?: '99 Roving St., Big City'));
                $phone = setting('contact_phone') ?: (setting('phone') ?: '+8801400620055');
                $email = setting('contact_email') ?: (setting('email') ?: 'Hello@Awesomesite.Com');
            @endphp

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="contact-wrapper">
                        
                        <div class="text-center mb-5">
                            <h4 class="fw-bold mb-2" style="font-size: 24px; color: var(--color-dark, var(--color-body)); font-family: var(--header-font);">{{ __('Get In Touch') }}</h4>
                            <p style="color: var(--color-body); font-family: var(--body-font); font-size: 15.5px; line-height: 1.8;">{{ __('Feel free to reach out to us with any questions or inquiries. We will get back to you as soon as possible.') }}</p>
                        </div>

                        <form action="{{ route('instructor.contact') }}" method="POST" class="user-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label style="font-size: 14.5px; font-weight: 600; color: var(--color-dark, var(--color-body)); font-family: var(--body-font); margin-bottom: 8px;" class="form-label">{{ __('Your Name') }}</label>
                                    <input type="text" name="name" class="form-control" style="border: 1px solid #e2e8f0; border-radius: 6px; padding: 12px 15px; font-family: var(--body-font);" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label style="font-size: 14.5px; font-weight: 600; color: var(--color-dark, var(--color-body)); font-family: var(--body-font); margin-bottom: 8px;" class="form-label">{{ __('Your Email') }}</label>
                                    <input type="email" name="email" class="form-control" style="border: 1px solid #e2e8f0; border-radius: 6px; padding: 12px 15px; font-family: var(--body-font);" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label style="font-size: 14.5px; font-weight: 600; color: var(--color-dark, var(--color-body)); font-family: var(--body-font); margin-bottom: 8px;" class="form-label">{{ __('Subject') }}</label>
                                <input type="text" name="subject" class="form-control" style="border: 1px solid #e2e8f0; border-radius: 6px; padding: 12px 15px; font-family: var(--body-font);" required>
                            </div>
                            <div class="mb-4">
                                <label style="font-size: 14.5px; font-weight: 600; color: var(--color-dark, var(--color-body)); font-family: var(--body-font); margin-bottom: 8px;" class="form-label">{{ __('Message') }}</label>
                                <textarea name="message" class="form-control" rows="5" style="border: 1px solid #e2e8f0; border-radius: 6px; padding: 12px 15px; font-family: var(--body-font);" required></textarea>
                            </div>
                            <div class="text-center mt-5">
                                <button type="submit" class="btn" style="background-color: var(--theme-clr, var(--color-secondary-4)); color: #ffffff; padding: 12px 35px; border-radius: 6px; font-size: 15.5px; font-weight: 600; border: none; font-family: var(--body-font); transition: opacity 0.3s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                                    {{ __('Send Message') }} <i class="fas fa-paper-plane ms-2"></i>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <!-- Contact Info Cards -->
            <div class="row g-4 mt-5 justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="contact-info-card">
                        <div class="contact-card-icon">
                            <i class="fal fa-map-marker-alt"></i>
                        </div>
                        <h4 class="contact-card-title">{{ __('Our Address') }}</h4>
                        <p class="contact-card-value">{{ $address }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="contact-info-card">
                        <div class="contact-card-icon">
                            <i class="fal fa-phone"></i>
                        </div>
                        <h4 class="contact-card-title">{{ __('Phone Number') }}</h4>
                        <p class="contact-card-value">
                            <a href="tel:{{ str_replace(' ', '', $phone) }}">{{ $phone }}</a>
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="contact-info-card">
                        <div class="contact-card-icon">
                            <i class="fal fa-envelope"></i>
                        </div>
                        <h4 class="contact-card-title">{{ __('Email Address') }}</h4>
                        <p class="contact-card-value">
                            <a href="mailto:{{ $email }}">{{ $email }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
