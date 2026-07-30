@extends('frontend.layouts.master')
@section('title', __('Contact Us'))
@section('content')
    <section class="course-details-area p-b-50">
        <!-- Full width theme color header -->
        <div class="course-details-header-wrapper p-t-60 p-b-95 p-t-md-40 p-b-md-50">
            <div class="container container-1278">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="course-details-header color-white">
                            <h2 class="title">{{ __('Contact Us') }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="course-details-overview-wrapper">
            <div class="container container-1278">
                <div class="row justify-content-center">
                    <div class="col-lg-8 p-b-md-40">
                        <div class="course-details-overview p-t-50 p-t-lg-5">
                            <div class="course-details-overview-content" style="background-color: #fff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-top: -60px; position: relative; z-index: 2;">
                                
                                <div class="text-center mb-4">
                                    <h4 style="font-size: 24px; font-weight: 600; color: var(--color-dark);">{{ __('Get In Touch') }}</h4>
                                    <p style="color: var(--color-body); font-size: 15px;">{{ __('Feel free to reach out to us with any questions or inquiries.') }}</p>
                                </div>

                                <form action="{{ route('instructor.contact') }}" method="POST" class="user-form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label style="font-size: 14px; font-weight: 500; color: var(--color-dark);" class="form-label">{{ __('Your Name') }}</label>
                                            <input type="text" name="name" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label style="font-size: 14px; font-weight: 500; color: var(--color-dark);" class="form-label">{{ __('Your Email') }}</label>
                                            <input type="email" name="email" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label style="font-size: 14px; font-weight: 500; color: var(--color-dark);" class="form-label">{{ __('Subject') }}</label>
                                        <input type="text" name="subject" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label style="font-size: 14px; font-weight: 500; color: var(--color-dark);" class="form-label">{{ __('Message') }}</label>
                                        <textarea name="message" class="form-control" rows="5" required></textarea>
                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="submit" class="template-btn" style="padding: 12px 35px; border-radius: 6px; font-size: 15px; font-weight: 600;">
                                            {{ __('Send Message') }} <i class="fas fa-paper-plane ms-2"></i>
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
