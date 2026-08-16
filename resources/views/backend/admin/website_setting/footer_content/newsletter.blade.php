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
                        
                        <form action="{{ route('footer.update-setting') }}" method="POST" class="form">@csrf
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
                                            <label for="get_access_btn_title" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Get Access Button Title') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="get_access_btn_title" name="get_access_btn_title"
                                                   placeholder="{{ __('Enter Button Title') }}" value="{{ setting('get_access_btn_title', $lang) ?: (setting('get_access_btn_title') ?: 'Get Access') }}">
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <label for="get_access_btn_link" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Get Access Button Link') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="get_access_btn_link" name="get_access_btn_link"
                                                   placeholder="{{ __('Enter Button Link') }}" value="{{ setting('get_access_btn_link') ?: '' }}">
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

                            <!-- SECTION 3: CONTACT US PAGE SETTINGS -->
                            <div class="card border mb-4 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                                <div class="card-header bg-light py-3 px-4">
                                    <h6 class="m-0 text-dark" style="font-size: 15px; font-weight: 500;">
                                        {{ __('Contact Us Page Dynamic Content Settings') }}
                                    </h6>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row gx-20 gy-3">
                                        <!-- Top Banner Subtitle & Title -->
                                        <div class="col-md-6 col-12">
                                            <label for="contact_banner_sub_title" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Top Banner Subtitle') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="contact_banner_sub_title" name="contact_banner_sub_title"
                                                   placeholder="{{ __('WE\'D LOVE TO HEAR FROM YOU') }}" value="{{ setting('contact_banner_sub_title', $lang) ?: (setting('contact_banner_sub_title') ?: 'WE\'D LOVE TO HEAR FROM YOU') }}">
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label for="contact_banner_title" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Top Banner Title') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="contact_banner_title" name="contact_banner_title"
                                                   placeholder="{{ __('Contact Us') }}" value="{{ setting('contact_banner_title', $lang) ?: (setting('contact_banner_title') ?: 'Contact Us') }}">
                                        </div>

                                        <!-- Get In Touch Section Title & Subtitle -->
                                        <div class="col-md-6 col-12">
                                            <label for="contact_page_title" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Get In Touch Section Title') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="contact_page_title" name="contact_page_title"
                                                   placeholder="{{ __('Get In Touch') }}" value="{{ setting('contact_page_title', $lang) ?: (setting('contact_page_title') ?: 'Get In Touch') }}">
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label for="contact_page_subtitle" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Get In Touch Section Subtitle') }}</label>
                                            <textarea class="form-control rounded-2 py-2" id="contact_page_subtitle" name="contact_page_subtitle" rows="2"
                                                      placeholder="{{ __('Enter Description') }}">{{ setting('contact_page_subtitle', $lang) ?: (setting('contact_page_subtitle') ?: 'Feel free to reach out to us with any questions or inquiries. We will get back to you as soon as possible.') }}</textarea>
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
