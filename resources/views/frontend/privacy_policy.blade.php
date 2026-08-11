@extends('frontend.layouts.master')
@section('title', __('Privacy Policy'))

@section('content')
    <!--====== Page Header ======-->
    <section class="page-header-area p-t-80 p-b-80" style="background-color: #110B3A;">
        <div class="container container-1278">
            <div class="row align-items-center text-center">
                <div class="col-12">
                    <span class="sub-title text-uppercase fw-bold mb-2 d-inline-block" style="color: var(--theme-clr, var(--color-secondary-4)); letter-spacing: 1.5px; font-size: 14px; font-family: var(--header-font);">
                        {{ __('DATA PROTECTION & PRIVACY') }}
                    </span>
                    <h1 class="title fw-bold text-white mb-3" style="font-size: 2.5rem; font-family: var(--header-font);">
                        {{ __('Privacy Policy') }}
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="color: #94a3b8; text-decoration: none; font-family: var(--body-font);">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page" style="font-family: var(--body-font);">{{ __('Privacy Policy') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!--====== Main Content ======-->
    <section class="policy-content-area p-t-50 p-b-60 bg-white">
        <div class="container container-1278">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="policy-wrapper">
                        
                        <div class="policy-section mb-3">
                            <h5 class="fw-bold mb-2" style="color: var(--color-dark, var(--color-body)); font-family: var(--header-font);">
                                {{ __('Information We Collect') }}
                            </h5>
                            <p style="color: var(--color-body); font-family: var(--body-font); line-height: 1.8;">
                                {{ __('We respect your personal privacy. When you register or purchase a course on FacultyLMS, we collect essential account details such as your name, email address, phone number, and transaction history.') }}
                            </p>
                        </div>

                        <hr class="my-3" style="border-color: #f1f5f9;">

                        <div class="policy-section mb-3">
                            <h5 class="fw-bold mb-2" style="color: var(--color-dark, var(--color-body)); font-family: var(--header-font);">
                                {{ __('How We Use Your Data') }}
                            </h5>
                            <p style="color: var(--color-body); font-family: var(--body-font); line-height: 1.8;">
                                {{ __('Your personal information is strictly used to process course enrollments, issue certificates, send course updates, and provide dedicated support. We never sell or share your data with unauthorized third parties.') }}
                            </p>
                        </div>

                        <hr class="my-3" style="border-color: #f1f5f9;">

                        <div class="policy-section">
                            <h5 class="fw-bold mb-2" style="color: var(--color-dark, var(--color-body)); font-family: var(--header-font);">
                                {{ __('Security & Cookies') }}
                            </h5>
                            <p style="color: var(--color-body); font-family: var(--body-font); line-height: 1.8; margin-bottom: 0;">
                                {{ __('We employ industry-standard SSL encryption and secure database servers to protect your user credentials. Cookies are used to remember your logged-in session and course progress.') }}
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
