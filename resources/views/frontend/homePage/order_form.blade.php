@php
    $mcSettings = [];
    if(isset($course) && $course) {
        $mcSettings = is_array($course->masterclass_settings) ? $course->masterclass_settings : json_decode($course->masterclass_settings ?? '[]', true);
        if(!is_array($mcSettings)) $mcSettings = [];
    }

    $orderFormTitle = 'Join the Masterclass by filling out the form below.';
    $orderFormSubtitle = 'Give valid information';
    
    $nameLabel = 'Your Full Name';
    $namePlaceholder = 'Your Full Name';
    $phoneLabel = 'Mobile Number';
    $phonePlaceholder = 'Mobile Number';
    $emailLabel = 'Email address';
    $emailPlaceholder = 'Email address';
    
    $addressLabel = 'Full Address';
    $addressPlaceholder = 'Full Address';
    $passwordLabel = 'Create account password';
    $passwordPlaceholder = '.........';
    $termsLabel = 'I have read and agree to the website\'s Terms and Refund Policy';

    $privacyNotice = 'Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.';
    $payNowBtnText = 'PAY NOW';
    
    $is_enrolled = false;
    if(auth()->check() && isset($course)) {
        $is_enrolled = $course->enrolls()->whereHas('checkout', function ($query) {
            $query->where('user_id', auth()->id());
        })->exists();
    }
@endphp

@if(!$is_enrolled && isset($course))
<section class="order-form-section p-t-60 p-b-60" style="background: #ffffff;">
    @include('frontend.homePage.sticky_promo_bar')
    <div class="container container-1278">
        <div class="mc-registration-section" id="register">
            
            <form action="{{ route('masterclass.checkout') }}" method="post" class="form">
                @csrf
                <input type="hidden" name="id" value="{{ $course->id }}">
                <input type="hidden" name="type" value="course">
                <input type="hidden" name="quantity" value="1">
                
                <div class="row gx-lg-5">
                    <!-- Left Column: Billing Details -->
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <h4 class="fw-bold mb-4" style="color: #1a1b4b; font-size: 22px;">Billing Details</h4>
                        
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark mb-2">{{ $nameLabel }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', auth()->check() ? auth()->user()->name : '') }}" placeholder="{{ $namePlaceholder }}" required style="height: 50px; padding: 10px 15px; border-radius: 8px; border: 1px solid #e2e8f0;">
                            @error('name')
                                <span class="invalid-feedback d-block text-danger small mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark mb-2">{{ $addressLabel }} <span class="text-danger">*</span></label>
                            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" placeholder="{{ $addressPlaceholder }}" required style="height: 50px; padding: 10px 15px; border-radius: 8px; border: 1px solid #e2e8f0;">
                            @error('address')
                                <span class="invalid-feedback d-block text-danger small mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark mb-2">{{ $emailLabel }} <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}" placeholder="{{ $emailPlaceholder }}" required style="height: 50px; padding: 10px 15px; border-radius: 8px; border: 1px solid #e2e8f0;">
                            @error('email')
                                <span class="invalid-feedback d-block text-danger small mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark mb-2">{{ $phoneLabel }} <span class="text-danger">*</span></label>
                            <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', auth()->check() ? auth()->user()->phone : '') }}" placeholder="{{ $phonePlaceholder }}" required style="height: 50px; padding: 10px 15px; border-radius: 8px; border: 1px solid #e2e8f0;">
                            @error('phone')
                                <span class="invalid-feedback d-block text-danger small mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        

                    </div>
                    
                    <!-- Right Column: Your Order -->
                    <div class="col-lg-6">
                        <h4 class="fw-bold mb-4" style="color: #1a1b4b; font-size: 22px;">Your Order</h4>
                        
                        <div class="order-summary-box mb-4">
                            <table class="table border-bottom" style="margin-bottom: 0;">
                                <thead>
                                    <tr>
                                        <th class="border-0 fw-bold" style="padding: 12px 0;">Product</th>
                                        <th class="border-0 fw-bold text-end" style="padding: 12px 0;">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-top">
                                        <td class="align-middle py-3 border-0" style="padding-left: 0;">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="{{ getFileLink('295x248', $course->image) }}" alt="{{ $course->title }}" class="rounded shadow-sm" style="width: 80px; height: 50px; object-fit: cover;">
                                                <div>
                                                    <h6 class="mb-1 fw-bold text-dark" style="font-size: 15px;">{{ $course->title }}</h6>
                                                    <span class="text-muted small">x 1</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-end py-3 border-0 fw-semibold" style="padding-right: 0;">
                                            {{ $course->is_free ? __('free') : get_price($course->price, userCurrency()) }}
                                        </td>
                                    </tr>
                                    <tr class="border-top">
                                        <td class="py-3 border-0 fw-bold text-dark" style="padding-left: 0;">Subtotal</td>
                                        <td class="py-3 border-0 text-end fw-semibold" style="padding-right: 0;">
                                            {{ $course->is_free ? __('free') : get_price($course->price, userCurrency()) }}
                                        </td>
                                    </tr>
                                    <tr class="border-top">
                                        <td class="py-3 border-0 fw-bold text-dark" style="padding-left: 0;">Total</td>
                                        <td class="py-3 border-0 text-end fw-bold" style="padding-right: 0; font-size: 20px; color: #10b981;">
                                            {{ $course->is_free ? __('free') : get_price($course->price, userCurrency()) }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        

                        
                        <div class="mb-4">
                            <div class="text-muted small mb-3" style="font-size: 13px; line-height: 1.6;">
                                {!! $privacyNotice ?: 'Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.' !!}
                            </div>
                            <div class="d-flex align-items-start gap-2">
                                <input type="checkbox" name="agree" id="agree_terms" required style="margin-top: 4px; width: 16px; height: 16px;">
                                <label for="agree_terms" class="fw-semibold text-dark small" style="cursor: pointer;">
                                    {!! $termsLabel !!} <a href="#" class="text-primary text-decoration-none">Terms</a> and <a href="#" class="text-primary text-decoration-none">Refund Policy</a>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="template-btn w-100 text-center border-0" style="border-radius: 4px;">
                            {{ $payNowBtnText }} {{ $course->is_free ? __('free') : get_price($course->price, userCurrency()) }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endif
