@extends('backend.layouts.master')
@section('title', __('newsletter_settings'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                @include('backend.admin.website_setting.sidebar_component')
                <div class="col-xxl-9 col-lg-8 col-md-8">
                    <h3 class="section-title">{{ __('newsletter_settings') }}</h3>
                    <div class="default-tab-list default-tab-list-v2  bg-white redious-border website-setting-social-link p-20 p-sm-30">
                        @include('backend.admin.website_setting.component.footer_setting_sidebar')
                        <form action="{{ route('footer.update-setting') }}" method="POST" class="form">@csrf
                            <input type="hidden" name="site_lang" value="{{$lang}}">

                            <!-- Section 1: Floating Newsletter Settings -->
                            <div class="mb-4 pb-3" style="border-bottom: 1px solid #eeeeee;">
                                <h6 class="mb-3" style="font-size: 15px; font-weight: 500; color: #333333;">{{ __('Newsletter Section Settings') }}</h6>
                                
                                <div class="d-flex gap-12 sandbox_mode_div mb-3">
                                    <input type="hidden" name="show_newsletter" value="{{ setting('show_newsletter') == 1 ? 1 : 0 }}">
                                    <label class="form-label" for="show_newsletter">{{ __('show_newsletter') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" value="1" id="show_newsletter" class="sandbox_mode" {{ setting('show_newsletter') == 1 ? 'checked' : '' }}>
                                        <label for="show_newsletter"></label>
                                    </div>
                                </div>

                                <div class="row gx-20">
                                    <div class="col-12 mb-3">
                                        <label for="title" class="form-label">{{ __('newsletter_title') }}</label>
                                        <input type="text" class="form-control rounded-2" id="title" name="newsletter_title"
                                               placeholder="{{ __('enter_title') }}" value="{{ setting('newsletter_title',$lang) ?: 'Subscribe Newsletter' }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="title_error error"></p>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="newsletter_description" class="form-label">{{ __('Newsletter Description') }}</label>
                                        <textarea class="form-control rounded-2" id="newsletter_description" name="newsletter_description" rows="2"
                                                  placeholder="{{ __('Enter Newsletter Description') }}">{{ setting('newsletter_description',$lang) ?: '' }}</textarea>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="promo_banner_countdown_title" class="form-label">{{ __('Countdown Title') }}</label>
                                        <input type="text" class="form-control rounded-2" id="promo_banner_countdown_title" name="promo_banner_countdown_title"
                                               placeholder="{{ __('Enter Countdown Title (Leave blank to remove)') }}" value="{{ setting('promo_banner_countdown_title', $lang) }}">
                                        <div class="nk-block-des text-muted mt-1" style="font-size: 12px;">
                                            <p>{{ __('If left blank, the title text above the timer will be completely removed.') }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12 mb-3">
                                        <label for="get_access_btn_title" class="form-label">{{ __('Get Access Button Title') }}</label>
                                        <input type="text" class="form-control rounded-2" id="get_access_btn_title" name="get_access_btn_title"
                                               placeholder="{{ __('Enter Button Title') }}" value="{{ setting('get_access_btn_title', $lang) ?: (setting('get_access_btn_title') ?: 'Get Access') }}">
                                    </div>

                                    <div class="col-md-6 col-12 mb-3">
                                        <label for="get_access_btn_link" class="form-label">{{ __('Get Access Button Link') }}</label>
                                        <input type="text" class="form-control rounded-2" id="get_access_btn_link" name="get_access_btn_link"
                                               placeholder="{{ __('Enter Button Link') }}" value="{{ setting('get_access_btn_link') ?: '' }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Section 2: Footer Logo & About Description -->
                            <div class="mb-4 pb-3" style="border-bottom: 1px solid #eeeeee;">
                                <h6 class="mb-3" style="font-size: 15px; font-weight: 500; color: #333333;">{{ __('Footer Logo & About Section') }}</h6>
                                <div class="row gx-20">
                                    <div class="col-12 mb-3">
                                        <label for="footer_logo_description" class="form-label">{{ __('footer_logo_description') }}</label>
                                        <textarea class="form-control rounded-2" id="footer_logo_description" name="footer_logo_description" rows="3"
                                                  placeholder="{{ __('enter_title') }}">{{ setting('footer_logo_description',$lang) ?: '' }}</textarea>
                                        <div class="nk-block-des text-danger">
                                            <p class="footer_logo_description error"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Section 3: Get In Touch & Contact Information -->
                            <div class="mb-4">
                                <h6 class="mb-3" style="font-size: 15px; font-weight: 500; color: #333333;">{{ __('Get In Touch & Contact Information') }}</h6>
                                <div class="row gx-20">
                                    <div class="col-12 mb-3">
                                        <label for="footer_get_in_touch_title" class="form-label">{{ __('Get In Touch Title') }}</label>
                                        <input type="text" class="form-control rounded-2" id="footer_get_in_touch_title" name="footer_get_in_touch_title"
                                               placeholder="{{ __('Enter Get In Touch Title') }}" value="{{ setting('footer_get_in_touch_title', $lang) ?: (setting('footer_get_in_touch_title') ?: 'Get In Touch') }}">
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="footer_get_in_touch_desc" class="form-label">{{ __('Get In Touch Description') }}</label>
                                        <textarea class="form-control rounded-2" id="footer_get_in_touch_desc" name="footer_get_in_touch_desc" rows="2"
                                                  placeholder="{{ __('Enter Get In Touch Description') }}">{{ setting('footer_get_in_touch_desc',$lang) ?: '' }}</textarea>
                                    </div>

                                    <div class="col-md-4 col-12 mb-3">
                                        <label for="contact_address" class="form-label">{{ __('Contact Address') }}</label>
                                        <input type="text" class="form-control rounded-2" id="contact_address" name="contact_address"
                                               placeholder="{{ __('Enter Address') }}" value="{{ setting('contact_address',$lang) ?: (setting('contact_address') ?: '99 Roving St., Big City') }}">
                                    </div>

                                    <div class="col-md-4 col-12 mb-3">
                                        <label for="contact_email" class="form-label">{{ __('Contact Email') }}</label>
                                        <input type="text" class="form-control rounded-2" id="contact_email" name="contact_email"
                                               placeholder="{{ __('Enter Email') }}" value="{{ setting('contact_email') ?: 'Hello@Awesomesite.Com' }}">
                                    </div>

                                    <div class="col-md-4 col-12 mb-3">
                                        <label for="contact_phone" class="form-label">{{ __('Contact Phone') }}</label>
                                        <input type="text" class="form-control rounded-2" id="contact_phone" name="contact_phone"
                                               placeholder="{{ __('Enter Phone Number') }}" value="{{ setting('contact_phone') ?: '+8801400620055' }}">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-start align-items-center mt-30">
                                <button type="submit" class="btn sg-btn-primary">{{ __('update') }}</button>
                                @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
