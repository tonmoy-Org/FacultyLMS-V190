@extends('frontend.layouts.master')
@section('title', __('Refund & Cancellation Policy'))

@section('content')
    <!--====== Page Header ======-->
    <section class="page-header-area p-t-80 p-b-80" style="background-color: #110B3A;">
        <div class="container container-1278">
            <div class="row align-items-center text-center">
                <div class="col-12">
                    <span class="sub-title text-uppercase fw-bold mb-2 d-inline-block" style="color: var(--theme-clr, var(--color-secondary-4)); letter-spacing: 1.5px; font-size: 14px; font-family: var(--header-font);">
                        {{ __('CUSTOMER SATISFACTION GUARANTEE') }}
                    </span>
                    <h1 class="title fw-bold text-white mb-3" style="font-size: 2.5rem; font-family: var(--header-font);">
                        {{ __('Refund & Cancellation Policy') }}
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="color: #94a3b8; text-decoration: none; font-family: var(--body-font);">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page" style="font-family: var(--body-font);">{{ __('Refund Policy') }}</li>
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
                                {{ __('30-Day Money-Back Guarantee') }}
                            </h5>
                            <p style="color: var(--color-body); font-family: var(--body-font); line-height: 1.8;">
                                {{ __('At FacultyLMS, customer satisfaction is our highest priority. If you are not completely satisfied with your course purchase, you are eligible for a full refund within 30 calendar days from the date of purchase, provided the conditions below are met.') }}
                            </p>
                        </div>

                        <hr class="my-3" style="border-color: #f1f5f9;">

                        <div class="policy-section mb-3">
                            <h5 class="fw-bold mb-2" style="color: var(--color-dark, var(--color-body)); font-family: var(--header-font);">
                                {{ __('Refund Eligibility Criteria') }}
                            </h5>
                            <p style="color: var(--color-body); font-family: var(--body-font); line-height: 1.8;">
                                {{ __('To qualify for a full refund:') }}
                            </p>
                            <ul class="list-unstyled ps-3" style="color: var(--color-body); font-family: var(--body-font); line-height: 2;">
                                <li><i class="fas fa-circle me-2" style="font-size: 7px; color: var(--theme-clr, var(--color-secondary-4)); vertical-align: middle;"></i> {{ __('The refund request must be submitted within 30 days of purchasing the course.') }}</li>
                                <li><i class="fas fa-circle me-2" style="font-size: 7px; color: var(--theme-clr, var(--color-secondary-4)); vertical-align: middle;"></i> {{ __('You must not have watched/completed more than 30% of the total course video content.') }}</li>
                                <li><i class="fas fa-circle me-2" style="font-size: 7px; color: var(--theme-clr, var(--color-secondary-4)); vertical-align: middle;"></i> {{ __('You must not have downloaded major course resources, certificates, or proprietary source code files.') }}</li>
                            </ul>
                        </div>

                        <hr class="my-3" style="border-color: #f1f5f9;">

                        <div class="policy-section mb-3">
                            <h5 class="fw-bold mb-2" style="color: var(--color-dark, var(--color-body)); font-family: var(--header-font);">
                                {{ __('Non-Refundable Scenarios') }}
                            </h5>
                            <p style="color: var(--color-body); font-family: var(--body-font); line-height: 1.8;">
                                {{ __('Refunds will not be granted under the following circumstances:') }}
                            </p>
                            <ul class="list-unstyled ps-3" style="color: var(--color-body); font-family: var(--body-font); line-height: 2;">
                                <li><i class="fas fa-times me-2" style="font-size: 12px; color: #ef4444;"></i> {{ __('Requests submitted after the 30-day guarantee period has expired.') }}</li>
                                <li><i class="fas fa-times me-2" style="font-size: 12px; color: #ef4444;"></i> {{ __('Course completed in full or course certificate already generated/downloaded.') }}</li>
                                <li><i class="fas fa-times me-2" style="font-size: 12px; color: #ef4444;"></i> {{ __('Multiple refund requests for the same course by the same account.') }}</li>
                            </ul>
                        </div>

                        <hr class="my-3" style="border-color: #f1f5f9;">

                        <div class="policy-section mb-3">
                            <h5 class="fw-bold mb-2" style="color: var(--color-dark, var(--color-body)); font-family: var(--header-font);">
                                {{ __('How to Request a Refund') }}
                            </h5>
                            <p style="color: var(--color-body); font-family: var(--body-font); line-height: 1.8;">
                                {{ __('Requesting a refund is quick and simple:') }}
                            </p>
                            <ol class="ps-3" style="color: var(--color-body); font-family: var(--body-font); line-height: 2;">
                                <li>{{ __('Log in to your account and go to your Purchase History or Support Ticket section.') }}</li>
                                <li>{{ __('Select the course you wish to refund and click Request Refund.') }}</li>
                                <li>{{ __('Alternatively, send an email to') }} <strong style="color: var(--theme-clr, var(--color-secondary-4));">{{ setting('contact_email') ?: 'support@facultylms.com' }}</strong> {{ __('with your order ID.') }}</li>
                            </ol>
                        </div>

                        <hr class="my-3" style="border-color: #f1f5f9;">

                        <div class="policy-section">
                            <h5 class="fw-bold mb-2" style="color: var(--color-dark, var(--color-body)); font-family: var(--header-font);">
                                {{ __('Refund Processing Time') }}
                            </h5>
                            <p style="color: var(--color-body); font-family: var(--body-font); line-height: 1.8; margin-bottom: 0;">
                                {{ __('Once approved, your refund will be processed back to your original payment method (Credit Card, Mobile Banking, bKash, SSLCommerz, Stripe, PayPal) within 3 to 7 business days.') }}
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
