@extends('backend.layouts.master')
@section('title', __('newsletter_settings'))
@section('content')
    <section class="options">
        <div class="container-fluid">
            <div class="row">
                @include('backend.admin.website_setting.sidebar_component')
                <div class="col-xxl-9 col-lg-8 col-md-8">
                    <h3 class="section-title mb-4" style="font-weight: 500;">{{ __('Footer & Contact Page Settings') }}</h3>
                    <div class="default-tab-list default-tab-list-v2 bg-white redious-border website-setting-social-link p-20 p-sm-30">
                        @include('backend.admin.website_setting.component.footer_setting_sidebar')
                        
                        <form action="{{ route('footer.update-setting') }}" method="POST" class="form" enctype="multipart/form-data">@csrf
                            <input type="hidden" name="site_lang" value="{{$lang}}">

                            <!-- SECTION 1: FLOATING NEWSLETTER SETTINGS -->
                            <div class="card border mb-4 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                                <div class="card-header bg-light py-3 px-4 d-flex align-items-center justify-content-between">
                                    <h6 class="m-0 text-dark" style="font-size: 15px; font-weight: 500;">
                                        {{ __('Newsletter Section Settings') }}
                                    </h6>
                                    <div class="d-flex align-items-center gap-2 m-0">
                                        <input type="hidden" name="show_newsletter" value="{{ setting('show_newsletter') == 1 ? 1 : 0 }}">
                                        <label class="form-label m-0" for="show_newsletter" style="font-size: 13px; font-weight: 400;">{{ __('Enable Newsletter') }}</label>
                                        <div class="setting-check m-0">
                                            <input type="checkbox" value="1" id="show_newsletter" class="sandbox_mode" {{ setting('show_newsletter') == 1 ? 'checked' : '' }}>
                                            <label for="show_newsletter"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row gx-20 gy-3">
                                        <div class="col-12">
                                            <label for="title" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Newsletter Title') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="title" name="newsletter_title"
                                                   placeholder="{{ __('enter_title') }}" value="{{ setting('newsletter_title',$lang) ?: 'Subscribe Newsletter' }}">
                                        </div>

                                        <div class="col-12">
                                            <label for="newsletter_description" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Newsletter Description') }}</label>
                                            <textarea class="form-control rounded-2 py-2" id="newsletter_description" name="newsletter_description" rows="2"
                                                      placeholder="{{ __('Enter Newsletter Description') }}">{{ setting('newsletter_description',$lang) ?: '' }}</textarea>
                                        </div>

                                        <div class="col-12">
                                            <label for="promo_banner_countdown_title" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Countdown Title') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="promo_banner_countdown_title" name="promo_banner_countdown_title"
                                                   placeholder="{{ __('Enter Countdown Title (Leave blank to remove)') }}" value="{{ setting('promo_banner_countdown_title', $lang) }}">
                                            <div class="nk-block-des text-muted mt-1" style="font-size: 12px;">
                                                <p>{{ __('If left blank, the title text above the timer will be completely removed.') }}</p>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <label for="promo_banner_countdown" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Global Promo Countdown Date (Applies to Footer & Sticky Banner)') }}</label>
                                            <input type="datetime-local" class="form-control rounded-2 py-2" id="promo_banner_countdown" name="promo_banner_countdown"
                                                   value="{{ setting('promo_banner_countdown') }}">
                                        </div>

                                        <div class="col-12">
                                            <label for="promo_banner_countdown_title" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Countdown Title') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="promo_banner_countdown_title" name="promo_banner_countdown_title"
                                                   placeholder="{{ __('Enter Countdown Title (Leave blank to remove)') }}" value="{{ setting('promo_banner_countdown_title', $lang) }}">
                                            <div class="nk-block-des text-muted mt-1" style="font-size: 12px;">
                                                <p>{{ __('If left blank, the title text above the timer will be completely removed.') }}</p>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <label for="get_access_btn_title" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Get Access Button Title') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="get_access_btn_title" name="get_access_btn_title"
                                                   placeholder="{{ __('Enter Button Title') }}" value="{{ setting('get_access_btn_title', $lang) ?: (setting('get_access_btn_title') ?: 'Get Access') }}">
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <label for="get_access_btn_link" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Get Access Button Link') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="get_access_btn_link" name="get_access_btn_link"
                                                   placeholder="{{ __('Enter Button Link (Default: #register)') }}" value="{{ setting('get_access_btn_link') ?: '' }}">
                                            <div class="nk-block-des text-muted mt-1" style="font-size: 12px;">
                                                <p>{{ __('Leave blank to default to the Order Form / Billing Details section (#register).') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- SECTION 2: FOOTER CONTACT & GENERAL INFORMATION -->
                            <div class="card border mb-4 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                                <div class="card-header bg-light py-3 px-4">
                                    <h6 class="m-0 text-dark" style="font-size: 15px; font-weight: 500;">
                                        {{ __('Footer Contact & General Information') }}
                                    </h6>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row gx-20 gy-3">
                                        <div class="col-12">
                                            <label for="footer_logo_description" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Footer Logo Description') }}</label>
                                            <textarea class="form-control rounded-2 py-2" id="footer_logo_description" name="footer_logo_description" rows="2"
                                                      placeholder="{{ __('enter_title') }}">{{ setting('footer_logo_description',$lang) ?: '' }}</textarea>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <label for="footer_get_in_touch_title" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Footer Get In Touch Title') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="footer_get_in_touch_title" name="footer_get_in_touch_title"
                                                   placeholder="{{ __('Enter Get In Touch Title') }}" value="{{ setting('footer_get_in_touch_title', $lang) ?: (setting('footer_get_in_touch_title') ?: 'Get In Touch') }}">
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <label for="footer_get_in_touch_desc" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Footer Get In Touch Description') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="footer_get_in_touch_desc" name="footer_get_in_touch_desc"
                                                   placeholder="{{ __('Enter Description') }}" value="{{ setting('footer_get_in_touch_desc',$lang) ?: '' }}">
                                        </div>

                                        <!-- Contact Address -->
                                        <div class="col-md-6 col-12">
                                            <label for="contact_address" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Contact Address') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="contact_address" name="contact_address"
                                                   placeholder="{{ __('99 Roving St., Big City') }}" value="{{ setting('contact_address',$lang) ?: (setting('contact_address') ?: '99 Roving St., Big City') }}">
                                        </div>

                                        <!-- Contact Phone Number -->
                                        <div class="col-md-6 col-12">
                                            <label for="contact_phone" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Contact Phone Number') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="contact_phone" name="contact_phone"
                                                   placeholder="{{ __('+123-234-1234') }}" value="{{ setting('contact_phone') ?: '+123-234-1234' }}">
                                        </div>

                                        <!-- Phone Schedule / Hours -->
                                        <div class="col-md-4 col-12">
                                            <label for="contact_phone_schedule" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Phone Schedule / Hours') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="contact_phone_schedule" name="contact_phone_schedule"
                                                   placeholder="{{ __('Mon - Fri: 9:00 AM - 6:00 PM') }}" value="{{ setting('contact_phone_schedule', $lang) ?: (setting('contact_phone_schedule') ?: 'Mon - Fri: 9:00 AM - 6:00 PM') }}">
                                        </div>

                                        <!-- Contact Email Address -->
                                        <div class="col-md-4 col-12">
                                            <label for="contact_email" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Contact Email Address') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="contact_email" name="contact_email"
                                                   placeholder="{{ __('Hello@Awesomesite.Com') }}" value="{{ setting('contact_email') ?: 'Hello@Awesomesite.Com' }}">
                                        </div>

                                        <!-- Email Response Info -->
                                        <div class="col-md-4 col-12">
                                            <label for="contact_email_response" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Email Response Info') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="contact_email_response" name="contact_email_response"
                                                   placeholder="{{ __('We reply within 24 hours') }}" value="{{ setting('contact_email_response', $lang) ?: (setting('contact_email_response') ?: 'We reply within 24 hours') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- SECTION 3: CONTACT US PAGE HERO BANNER SETTINGS -->
                            <div class="card border mb-4 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                                <div class="card-header bg-light py-3 px-4 d-flex align-items-center justify-content-between">
                                    <h6 class="m-0 text-dark" style="font-size: 15px; font-weight: 500;">
                                        {{ __('Contact Us Hero Banner Settings') }}
                                    </h6>
                                    <div class="d-flex align-items-center gap-2 m-0">
                                        <input type="hidden" name="contact_page_banner_status" value="{{ setting('contact_page_banner_status') == 0 ? 0 : 1 }}">
                                        <label class="form-label m-0" for="contact_page_banner_status" style="font-size: 13px; font-weight: 400;">{{ __('Enable Hero Banner') }}</label>
                                        <div class="setting-check m-0">
                                            <input type="checkbox" value="1" id="contact_page_banner_status" class="sandbox_mode" {{ setting('contact_page_banner_status') == 0 ? '' : 'checked' }}>
                                            <label for="contact_page_banner_status"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row gx-20 gy-3">


                                        <!-- Banner Main Title -->
                                        <div class="col-md-6 col-12">
                                            <label for="contact_page_banner_title" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Hero Banner Main Title') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="contact_page_banner_title" name="contact_page_banner_title"
                                                   placeholder="{{ __('We\'d Love to Hear From You') }}" value="{{ setting('contact_page_banner_title', $lang) ?: (setting('contact_page_banner_title') ?: 'We\'d Love to Hear From You') }}">
                                        </div>

                                        <!-- Banner Description -->
                                        <div class="col-12">
                                            <label for="contact_page_banner_description" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Hero Banner Description') }}</label>
                                            <textarea class="form-control rounded-2 py-2" id="contact_page_banner_description" name="contact_page_banner_description" rows="2"
                                                      placeholder="{{ __('Enter Description') }}">{{ setting('contact_page_banner_description', $lang) ?: (setting('contact_page_banner_description') ?: 'Have questions, feedback, or need support? Reach out to our team and we will get back to you promptly.') }}</textarea>
                                        </div>

                                        <!-- Banner Image Upload -->
                                        <div class="col-12 input_file_div">
                                            <label for="contact_page_banner_image" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Hero Banner Background Image (1200x500)') }}</label>
                                            <label for="contact_page_banner_image" class="file-upload-text w-100 p-2 border rounded-2 d-flex align-items-center justify-content-between" style="cursor: pointer; background-color: #f8fafc;">
                                                <span class="text-muted" style="font-size: 13px;">{{ __('Choose Banner Image File') }}</span>
                                                <span class="btn btn-sm btn-outline-secondary">{{ __('choose_file') }}</span>
                                            </label>
                                            <input class="d-none file_picker" type="file" name="contact_page_banner_image" id="contact_page_banner_image" accept="image/*">
                                            <div class="selected-files mt-2">
                                                @php
                                                    $contactBannerImg = setting('contact_page_banner_image');
                                                    $contactPreviewUrl = '';
                                                    if (is_array($contactBannerImg)) {
                                                        if (!empty($contactBannerImg['image_80x80'])) {
                                                            $contactPreviewUrl = get_media($contactBannerImg['image_80x80'], $contactBannerImg['storage'] ?? 'local');
                                                        } elseif (!empty($contactBannerImg['original_image'])) {
                                                            $contactPreviewUrl = get_media($contactBannerImg['original_image'], $contactBannerImg['storage'] ?? 'local');
                                                        }
                                                    } elseif (is_string($contactBannerImg) && !empty($contactBannerImg)) {
                                                        $contactPreviewUrl = getFileLink('80x80', $contactBannerImg);
                                                    }
                                                    if (empty($contactPreviewUrl) || str_contains($contactPreviewUrl, 'default-image')) {
                                                        $contactPreviewUrl = static_asset('frontend/img/banner/success_hero_banner.jpg');
                                                    }
                                                @endphp
                                                <img class="selected-img rounded border" src="{{ $contactPreviewUrl }}" alt="Contact Banner Image" style="max-height: 90px; object-fit: cover;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- SECTION 4: CONTACT US PAGE DYNAMIC CONTENT SETTINGS -->
                            <div class="card border mb-4 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                                <div class="card-header bg-light py-3 px-4">
                                    <h6 class="m-0 text-dark" style="font-size: 15px; font-weight: 500;">
                                        {{ __('Contact Us Page Dynamic Content Settings') }}
                                    </h6>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row gx-20 gy-3">
                                        <!-- Top Banner Title -->
                                        <div class="col-md-6 col-12">
                                            <label for="contact_banner_title" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Top Banner Title') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="contact_banner_title" name="contact_banner_title"
                                                   placeholder="{{ __('Contact Us') }}" value="{{ setting('contact_banner_title', $lang) ?: (setting('contact_banner_title') ?: 'Contact Us') }}">
                                        </div>



                                        <!-- Map Card Badge Title & Subtitle -->
                                        <div class="col-md-6 col-12">
                                            <label for="contact_location_title" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Map Card Badge Title') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="contact_location_title" name="contact_location_title"
                                                   placeholder="{{ __('Our Location') }}" value="{{ setting('contact_location_title', $lang) ?: (setting('contact_location_title') ?: 'Our Location') }}">
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label for="contact_location_subtitle" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Map Card Badge Subtitle') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="contact_location_subtitle" name="contact_location_subtitle"
                                                   placeholder="{{ __('We\'d love to hear from you!') }}" value="{{ setting('contact_location_subtitle', $lang) ?: (setting('contact_location_subtitle') ?: 'We\'d love to hear from you!') }}">
                                        </div>

                                        <!-- Company Map URL / Address / Embed Code -->
                                        <div class="col-12">
                                            <label for="contact_map_url" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Company Map URL / Address / Embed Code') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="contact_map_url" name="contact_map_url"
                                                   placeholder="{{ __('e.g. https://maps.google.com/maps?q=99+Roving+St+Big+City or full embed code') }}" value="{{ setting('contact_map_url') ?: (setting('contact_map_iframe') ?: '') }}">
                                            <small class="text-muted mt-1 d-block" style="font-size: 12px;">{{ __('Paste any Google Maps share link, location address, or iframe embed code. Location will update dynamically on the frontend map based on this input.') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- SECTION 4: STICKY PROMO BAR SETTINGS -->
                            <div class="card border mb-4 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                                <div class="card-header bg-light py-3 px-4 d-flex align-items-center justify-content-between">
                                    <h6 class="m-0 text-dark" style="font-size: 15px; font-weight: 500;">
                                        {{ __('Sticky Promo Bar Settings') }}
                                    </h6>
                                    <div class="d-flex align-items-center gap-2 m-0">
                                        <input type="hidden" name="show_sticky_promo_bar" value="0">
                                        <label class="form-label m-0" for="show_sticky_promo_bar" style="font-size: 13px; font-weight: 400;">{{ __('Enable Promo Bar') }}</label>
                                        <div class="setting-check m-0">
                                            <input type="checkbox" name="show_sticky_promo_bar" value="1" id="show_sticky_promo_bar" class="sandbox_mode" {{ setting('show_sticky_promo_bar') == 1 ? 'checked' : '' }}>
                                            <label for="show_sticky_promo_bar"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row gx-20 gy-3">
                                        <div class="col-md-6 col-12">
                                            <label for="sticky_promo_title" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Promo Title') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="sticky_promo_title" name="sticky_promo_title"
                                                   placeholder="{{ __('e.g. অফার শেষ হওয়ার আগেই কিনুন') }}" value="{{ setting('sticky_promo_title', $lang) ?: '' }}">
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <label for="sticky_promo_btn_text" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Button Text') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="sticky_promo_btn_text" name="sticky_promo_btn_text"
                                                   placeholder="{{ __('e.g. Enroll Now') }}" value="{{ setting('sticky_promo_btn_text', $lang) ?: '' }}">
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <label for="sticky_promo_btn_link" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Button Link') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="sticky_promo_btn_link" name="sticky_promo_btn_link"
                                                   placeholder="{{ __('Enter Button Link') }}" value="{{ setting('sticky_promo_btn_link') ?: '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-start align-items-center mt-30 mb-20">
                                <button type="submit" class="btn sg-btn-primary px-4 py-2" style="border-radius: 8px; font-weight: 500;">{{ __('Update Settings') }}</button>
                                @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
