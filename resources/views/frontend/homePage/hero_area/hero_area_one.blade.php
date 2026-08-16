@php
    $lang = App::getLocale();
@endphp

@if(isset($hero_course) && $hero_course)
<section class="hero-area p-t-120 p-b-120 text-center" style="background-color: #123e2b;">
    <div class="container container-1278">
        <div class="row justify-content-center">
            <div class="col-xl-11 col-lg-12 col-md-12">
                <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
                    
                    {{-- Subject --}}
                    @if($hero_course->subject)
                        <div class="mb-3">
                            <span class="badge" style="background-color: rgba(255,255,255,0.15); color: #2db37c; font-size: 14px; padding: 6px 14px; border-radius: 20px; font-weight: 600;">
                                {{ $hero_course->subject->title }}
                            </span>
                        </div>
                    @endif
                    
                    {{-- Title first --}}
                    <h1 class="hero-title mb-2" style="color: #ffffff; font-size: 32px; font-weight: 700; line-height: 1.3;">{{ $hero_course->title }}</h1>

                    {{-- Subtitle second --}}
                    @if($hero_course->course_subtitle)
                        <h4 class="mb-3" style="color: #ffffff; font-size: 24px; font-weight: 500;">{{ $hero_course->course_subtitle }}</h4>
                    @endif
                    
                    {{-- Description --}}
                    @if($hero_course->short_description)
                        <p class="mb-4 mx-auto" style="color: #cbd5e1; font-size: 16px; line-height: 1.6; max-width: 750px;">
                            {{ $hero_course->short_description }}
                        </p>
                    @endif

                    {{-- Video or Image --}}
                    <div class="video-container position-relative mt-4 shadow-lg mx-auto" style="border-radius: 12px; overflow: hidden; background: #000; max-width: 1150px; border: 2px solid rgba(255,255,255,0.15);">
                        @if($hero_course->video_source && $hero_course->video)
                            @include('frontend.components.video', [
                                'source' => $hero_course->video_source, 
                                'video'  => $hero_course->video, 
                                'class'  => 'course-intro-video yt_player w-100', 
                                'image'  => $hero_course->image,
                                'size'   => 'original_image'
                            ])
                        @else
                            <img src="{{ getFileLink('original_image', $hero_course->image) }}" alt="{{ $hero_course->title }}" class="img-fluid w-100" style="object-fit: cover; max-height: 550px;">
                        @endif
                    </div>
                    
                    @php
                        $mcSettings = [];
                        if (isset($hero_course) && $hero_course->masterclass_settings) {
                            $mcSettings = is_array($hero_course->masterclass_settings) 
                                ? $hero_course->masterclass_settings 
                                : json_decode($hero_course->masterclass_settings, true);
                        }
                        $heroBtnText = !empty($mcSettings['overview_btn_text']) ? $mcSettings['overview_btn_text'] : __('Enroll Now');
                        $heroBtnUrl = !empty($mcSettings['overview_btn_url']) ? $mcSettings['overview_btn_url'] : route('course.details', $hero_course->slug);
                    @endphp
                    <ul class="hero-btns d-flex justify-content-center align-items-center mt-5">
                        <li style="width: 100%;">
                            <a href="{{ $heroBtnUrl }}" class="template-btn">
                                {{ $heroBtnText }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@if(isset($hero_course->description) && !empty(strip_tags($hero_course->description)))
<section class="course-description-section" style="padding-top: 80px; padding-bottom: 40px;">
    <div class="container container-1278">
        <div class="description-card p-4 p-md-5" style="background-color: #eaf7f2; border-radius: 8px;">
            @if($hero_course->description_subtitle)
                <h2 class="text-center mb-4" style="color: #111827; font-size: 28px; font-weight: 700;">
                    {{ $hero_course->description_subtitle }}
                </h2>
            @endif
            
            <div class="course-description-content" style="color: #4b5563; font-size: 14px; line-height: 1.8; font-weight: 400; text-align: left;">
                {!! $hero_course->description !!}
            </div>
        </div>
    </div>
</section>
@endif

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof Plyr !== 'undefined') {
            const ytPlayers = document.querySelectorAll('.yt_player');
            ytPlayers.forEach(function(el) {
                new Plyr(el);
            });
            const html5Players = document.querySelectorAll('video.course-intro-video');
            html5Players.forEach(function(el) {
                new Plyr(el);
            });
        }
    });
</script>
@endpush

@else
<section class="hero-area hero-area-v5 p-t-120 p-b-60 p-b-md-40 text-center">
    <div class="container container-1278">
        <h2 class="text-white">No Course Found</h2>
    </div>
</section>
@endif
