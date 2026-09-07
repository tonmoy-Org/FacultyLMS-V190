@php
    $lang = app()->getLocale();
    $status = setting('about_me_status');
    $tag = setting('about_me_tag', $lang) ?: 'ABOUT ME';
    $title = setting('about_me_title', $lang) ?: 'I\'m Teaching Online For About 5+ Years On Programming';
    $desc1 = setting('about_me_description', $lang) ?: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non.';
    $desc2 = setting('about_me_description_2', $lang) ?: 'Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.';
    
    $mcSettings = [];
    if (isset($course) && $course) {
        $mcSettings = is_array($course->masterclass_settings) ? $course->masterclass_settings : json_decode($course->masterclass_settings ?? '[]', true);
    }
    if (isset($hero_course) && $hero_course && empty($mcSettings)) {
        $mcSettings = is_array($hero_course->masterclass_settings) ? $hero_course->masterclass_settings : json_decode($hero_course->masterclass_settings ?? '[]', true);
    }
    
    $heroBtnText = !empty($mcSettings['overview_btn_text']) ? $mcSettings['overview_btn_text'] : null;
    $btnText = $heroBtnText ?: (setting('about_me_btn_text', $lang) ?: 'Enroll Now');
    $rawBtnUrl = setting('about_me_btn_url', $lang);
    if (empty($rawBtnUrl) || $rawBtnUrl === '#') {
        $btnUrl = (request()->is('/') || request()->is('home*') || isHome()) ? '#register' : url('/#register');
    } else {
        $btnUrl = \Illuminate\Support\Str::startsWith($rawBtnUrl, ['http://', 'https://', '/']) ? $rawBtnUrl : url($rawBtnUrl);
    }

    $aboutImgSetting = setting('about_me_image');
    $aboutImgUrl = '';
    if ($aboutImgSetting) {
        $aboutImgUrl = getFileLink('original_image', $aboutImgSetting);
    }
    if (!$aboutImgUrl || str_contains($aboutImgUrl, 'default')) {
        $aboutImgUrl = static_asset('frontend/img/hero/hero-v5-masonry-1.jpg');
    }
@endphp

<style>
    .about-me-description-content {
        font-size: 16px !important;
        line-height: 1.85 !important;
        color: #374151 !important;
    }
    .about-me-description-content p {
        font-size: 16px !important;
        line-height: 1.85 !important;
        color: #374151 !important;
        margin-bottom: 16px;
    }
    .about-me-description-content ul {
        list-style: disc outside !important;
        padding-left: 0 !important;
        margin-bottom: 20px !important;
    }
    .about-me-description-content ol {
        list-style: decimal outside !important;
        padding-left: 0 !important;
        margin-bottom: 20px !important;
    }
    .about-me-description-content li {
        display: list-item !important;
        margin-left: 25px !important;
        margin-bottom: 10px !important;
        font-size: 16px !important;
        line-height: 1.7 !important;
        color: #374151 !important;
    }
</style>

@if($status !== '0')
<section class="about-me-section p-t-80 p-b-80 position-relative overflow-hidden bg-white">
    <div class="container container-1278">
        <div class="row align-items-center g-4 g-lg-5">
            <!-- Left Side Image Card -->
            <div class="col-lg-5 col-md-12" data-aos="fade-right">
                <div class="about-me-card position-relative overflow-hidden shadow-sm" 
                     style="border-radius: 16px; min-height: 500px; background: linear-gradient(135deg, #FFE485 0%, #FCD34D 100%);">
                    
                    <img src="{{ $aboutImgUrl }}" alt="About Me Instructor" 
                         class="img-fluid w-100" 
                         style="object-fit: cover; width: 100%; height: 100%; min-height: 500px; border-radius: 16px; display: block;">
                </div>
            </div>

            <!-- Right Side Text Content -->
            <div class="col-lg-7 col-md-12" data-aos="fade-left" data-aos-delay="100">
                <div class="about-me-text-block ps-lg-4">
                    <div class="common-heading">
                        @if($tag)
                            <span class="sub-title text-uppercase fw-bold m-b-15 d-inline-block" style="color: #10b981; letter-spacing: 2px; font-size: 15px;">
                                {{ __($tag) }}
                            </span>
                        @endif

                        @if($title)
                            <h2 class="m-b-25 fw-bold" style="color: #1a1b4b; font-size: 36px; line-height: 1.3;">
                                {!! format_title_highlight(__($title)) !!}
                            </h2>
                        @endif

                        @if($desc1)
                            <div class="m-b-30 about-me-description-content">
                                {!! __($desc1) !!}
                            </div>
                        @endif

                        @if($btnText)
                            <a href="{{ $btnUrl }}" class="template-btn about-me-btn get-access-btn">
                                {{ __($btnText) }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
