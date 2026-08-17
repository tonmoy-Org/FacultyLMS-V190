@php
    $lang = App::getLocale();
@endphp

@if(isset($hero_course) && $hero_course)
<section class="hero-area p-t-120 p-b-120 text-center position-relative overflow-hidden" style="background-color: #123e2b;">
    <!-- Floating background decorative shapes -->
    <div class="hero-bg-shapes">
        <div class="hero-shape hero-shape-1" data-speed="1.5"></div>
        <div class="hero-shape hero-shape-2" data-speed="-1.2"></div>
        <div class="hero-shape hero-shape-3" data-speed="2"></div>
        <div class="hero-shape hero-shape-4" data-speed="-0.8"></div>
    </div>
    <div class="container container-1278">
        <div class="row justify-content-center">
            <div class="col-xl-11 col-lg-12 col-md-12">
                <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
                    
                    {{-- Subject --}}
                    @if($hero_course->subject)
                        <div class="mb-3">
                            <a href="{{ route('courses', ['subject' => $hero_course->subject->id]) }}" style="text-decoration: none; display: inline-block;">
                                <span class="badge hero-badge hero-badge-animated" style="background-color: rgba(255,255,255,0.15); color: #2db37c; padding: 6px 14px; border-radius: 20px; cursor: pointer;">{{ trim($hero_course->subject->title) }}</span>
                            </a>
                        </div>
                    @endif
                    
                    {{-- Title first --}}
                    <h1 class="hero-title mb-2" style="color: #ffffff;">{{ $hero_course->title }}</h1>

                    {{-- Subtitle second --}}
                    @if($hero_course->course_subtitle)
                        <h4 class="hero-subtitle mb-3" style="color: #ffffff;">{{ $hero_course->course_subtitle }}</h4>
                    @endif
                    
                    {{-- Description --}}
                    @if($hero_course->short_description)
                        <p class="hero-description mb-4 mx-auto" style="color: #cbd5e1; max-width: 750px;">
                            {{ $hero_course->short_description }}
                        </p>
                    @endif

                    {{-- Video or Image --}}
                    <div class="hero-video-wrapper video-container position-relative mt-4 shadow-lg mx-auto" style="border-radius: 12px; overflow: hidden; background: #000; max-width: 1150px; border: 2px solid rgba(255, 193, 7, 0.5);">
                        <!-- Border Beam SVG -->
                        <svg class="border-beam-svg">
                            <defs>
                                <linearGradient id="beam-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#ffc107" stop-opacity="0" />
                                    <stop offset="30%" stop-color="#ffc107" stop-opacity="0.85" />
                                    <stop offset="50%" stop-color="#ffffff" stop-opacity="1" />
                                    <stop offset="70%" stop-color="#ffc107" stop-opacity="0.85" />
                                    <stop offset="100%" stop-color="#ffc107" stop-opacity="0" />
                                </linearGradient>
                            </defs>
                            <rect class="border-beam-rect" fill="none" stroke="url(#beam-gradient)" stroke-width="2.5" rx="12" ry="12" />
                        </svg>
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
                    <ul class="hero-btns d-flex justify-content-center align-items-center mt-4">
                        <li>
                            <a href="{{ $heroBtnUrl }}" class="template-btn hero-btn">
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

        // Parallax and cursor glow animation
        const heroSection = document.querySelector('.hero-area');
        if (heroSection) {
            const shapes = heroSection.querySelectorAll('.hero-shape');
            const glow = document.createElement('div');
            glow.className = 'hero-mouse-glow';
            heroSection.appendChild(glow);

            heroSection.addEventListener('mousemove', function(e) {
                const rect = heroSection.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                glow.style.left = x + 'px';
                glow.style.top = y + 'px';

                shapes.forEach(shape => {
                    const speed = parseFloat(shape.getAttribute('data-speed')) || 1;
                    const moveX = (x - rect.width / 2) * (speed / 100);
                    const moveY = (y - rect.height / 2) * (speed / 100);
                    shape.style.transform = `translate(${moveX}px, ${moveY}px)`;
                });
            });

            heroSection.addEventListener('mouseleave', function() {
                shapes.forEach(shape => {
                    shape.style.transform = 'translate(0px, 0px)';
                });
            });
        }

        // Border Beam animation dimensions tracker
        const videoWrapper = document.querySelector('.hero-video-wrapper');
        if (videoWrapper) {
            const beamSvg = videoWrapper.querySelector('.border-beam-svg');
            const beamRect = videoWrapper.querySelector('.border-beam-rect');
            
             if (beamSvg && beamRect) {
                let rAfFrame;
                function updateBeam() {
                    if (rAfFrame) cancelAnimationFrame(rAfFrame);
                    rAfFrame = requestAnimationFrame(() => {
                        const w = videoWrapper.clientWidth;
                        const h = videoWrapper.clientHeight;
                        
                        beamSvg.setAttribute('viewBox', `0 0 ${w} ${h}`);
                        
                        const strokeWidth = 2.5;
                        const inset = strokeWidth / 2;
                        const rectW = w - strokeWidth;
                        const rectH = h - strokeWidth;
                        
                        beamRect.setAttribute('x', inset.toString());
                        beamRect.setAttribute('y', inset.toString());
                        beamRect.setAttribute('width', rectW.toString());
                        beamRect.setAttribute('height', rectH.toString());
                        
                        // Perimeter calculation
                        const perimeter = 2 * (rectW + rectH);
                        beamRect.style.setProperty('--perimeter', perimeter);
                        
                        // Set beam length to 25% of the container perimeter
                        const beamLen = perimeter * 0.25;
                        beamRect.style.strokeDasharray = `${beamLen} ${perimeter - beamLen}`;
                    });
                }
                
                updateBeam();
                window.addEventListener('resize', updateBeam);
                
                if (window.ResizeObserver) {
                    const ro = new ResizeObserver(updateBeam);
                    ro.observe(videoWrapper);
                }
            }
        }
    });
</script>
@endpush

@push('css')
<style>
/* Desktop Default Typography */
.hero-badge {
    font-size: 14px;
    font-weight: 600;
    line-height: 1 !important;
}

.hero-title {
    font-size: 32px;
    font-weight: 700;
    line-height: 1.3;
}

.hero-subtitle {
    font-size: 24px;
    font-weight: 500;
}

.hero-description {
    font-size: 16px;
    line-height: 1.6;
}

.hero-btn {
    font-size: 16px;
    line-height: 1.2;
    font-weight: 600;
    min-height: 52px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

/* Background elements styling */
.hero-area {
    position: relative;
    overflow: hidden;
}

.hero-bg-shapes {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    pointer-events: none;
    z-index: 1;
}

.hero-area .container {
    position: relative;
    z-index: 2;
}

/* Glowing Orbs */
.hero-shape {
    position: absolute;
    opacity: 0.12;
    transition: transform 0.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    will-change: transform;
    pointer-events: none;
}

.hero-shape-1 {
    top: 10%;
    left: 6%;
    width: 250px;
    height: 250px;
    border-radius: 50%;
    background: radial-gradient(circle, #2db37c 0%, transparent 70%);
    filter: blur(40px);
    animation: hero-float-slow 12s ease-in-out infinite;
}

.hero-shape-2 {
    bottom: 12%;
    right: 5%;
    width: 320px;
    height: 320px;
    border-radius: 50%;
    background: radial-gradient(circle, #10b981 0%, transparent 70%);
    filter: blur(50px);
    animation: hero-float-slow-rev 15s ease-in-out infinite;
}

/* Dotted Grid shape */
.hero-shape-3 {
    top: 15%;
    right: 12%;
    width: 140px;
    height: 140px;
    background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1.5px, transparent 1.5px);
    background-size: 18px 18px;
    animation: hero-float-slow 20s ease-in-out infinite;
}

/* Hollow clean geometric ring */
.hero-shape-4 {
    bottom: 22%;
    left: 10%;
    width: 90px;
    height: 90px;
    border: 2px dashed rgba(255, 255, 255, 0.07);
    border-radius: 50%;
    animation: hero-spin 40s linear infinite;
}

/* Floating Animation Keyframes */
@keyframes hero-float-slow {
    0% {
        transform: translateY(0px) rotate(0deg);
    }
    50% {
        transform: translateY(-18px) rotate(8deg);
    }
    100% {
        transform: translateY(0px) rotate(0deg);
    }
}

@keyframes hero-float-slow-rev {
    0% {
        transform: translateY(0px) rotate(0deg);
    }
    50% {
        transform: translateY(18px) rotate(-8deg);
    }
    100% {
        transform: translateY(0px) rotate(0deg);
    }
}

@keyframes hero-spin {
    to {
        transform: rotate(360deg);
    }
}

/* Mouse cursor glow tracker */
.hero-mouse-glow {
    position: absolute;
    width: 450px;
    height: 450px;
    background: radial-gradient(circle, rgba(255, 193, 7, 0.08) 0%, rgba(255, 193, 7, 0) 70%);
    border-radius: 50%;
    pointer-events: none;
    transform: translate(-50%, -50%);
    z-index: 1;
    opacity: 0;
    transition: opacity 0.5s ease;
    mix-blend-mode: screen;
    will-change: left, top, opacity;
}

.hero-area:hover .hero-mouse-glow {
    opacity: 1;
}

/* Video Wrapper styling */
.hero-video-wrapper {
    border-radius: 12px !important;
    border-color: rgba(255, 193, 7, 0.5) !important;
    box-shadow: 0 30px 60px -15px rgba(255, 193, 7, 0.3), 
                0 0 50px 10px rgba(255, 193, 7, 0.08) !important;
    transition: box-shadow 0.6s cubic-bezier(0.16, 1, 0.3, 1), 
                border-color 0.6s cubic-bezier(0.16, 1, 0.3, 1) !important;
    will-change: box-shadow, border-color;
}

.hero-video-wrapper:hover {
    border-color: rgba(255, 193, 7, 0.75) !important;
    box-shadow: 0 30px 70px -10px rgba(255, 193, 7, 0.4), 
                0 0 60px 15px rgba(255, 193, 7, 0.12) !important;
}

/* Border Beam SVG and rect styles */
.border-beam-svg {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 10;
}

.border-beam-rect {
    stroke-linecap: round;
    animation: border-beam-travel 8s linear infinite;
    will-change: stroke-dashoffset;
    filter: drop-shadow(0 0 3px rgba(255, 193, 7, 0.6));
}

@keyframes border-beam-travel {
    0% {
        stroke-dashoffset: var(--perimeter, 2000);
    }
    100% {
        stroke-dashoffset: 0;
    }
}

/* Badge hover transition */
.hero-badge-animated {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}
.hero-badge-animated:hover {
    transform: scale(1.05);
    background-color: rgba(255, 255, 255, 0.25) !important;
    box-shadow: 0 0 15px rgba(45, 179, 124, 0.3);
}

/* Global button hover glow just for hero section */
.hero-btns .template-btn {
    position: relative;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}
.hero-btns .template-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(45, 179, 124, 0.3);
}
.hero-btns .template-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(120deg, transparent, rgba(255, 255, 255, 0.25), transparent);
    transition: all 0.6s ease;
}
.hero-btns .template-btn:hover::before {
    left: 100%;
}

/* Mobile Viewport Styles (< 768px) */
@media (max-width: 767.98px) {
    .hero-area {
        padding-top: 100px !important;
        padding-bottom: 30px !important;
    }

    .hero-badge {
        font-size: 12px !important;
        line-height: 1.2 !important;
        font-weight: 600 !important;
    }

    .hero-title {
        font-size: 24px !important;
        line-height: 1.4 !important;
        font-weight: 700 !important;
        margin-bottom: 8px !important;
    }

    .hero-subtitle {
        font-size: 16px !important;
        line-height: 1.45 !important;
        font-weight: 600 !important;
        margin-bottom: 12px !important;
    }

    .hero-description {
        font-size: 14px !important;
        line-height: 1.65 !important;
        font-weight: 400 !important;
        margin-bottom: 16px !important;
    }

    .hero-btn {
        font-size: 15px !important;
        line-height: 1.2 !important;
        font-weight: 600 !important;
        height: 48px !important;
        min-height: 48px !important;
        padding: 12px 28px !important;
    }

    .course-description-section {
        padding-top: 25px !important;
        padding-bottom: 20px !important;
    }

    .description-card {
        padding: 20px 16px !important;
    }

    .description-card h2 {
        font-size: 20px !important;
        margin-bottom: 12px !important;
    }
}
</style>
@endpush
@else
<section class="hero-area hero-area-v5 p-t-120 p-b-60 p-b-md-40 text-center">
    <div class="container container-1278">
        <h2 class="text-white">No Course Found</h2>
    </div>
</section>
@endif
