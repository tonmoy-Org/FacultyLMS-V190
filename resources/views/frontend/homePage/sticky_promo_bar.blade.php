@php
    $showStickyBar = setting('show_sticky_promo_bar');
    $title = setting('sticky_promo_title') ?: 'অফার শেষ হওয়ার আগেই কিনুন';
    
    $mcSettings = [];
    if (isset($course) && $course) {
        $mcSettings = is_array($course->masterclass_settings) ? $course->masterclass_settings : json_decode($course->masterclass_settings ?? '[]', true);
    }
    $heroBtnText = !empty($mcSettings['overview_btn_text']) ? $mcSettings['overview_btn_text'] : (setting('sticky_promo_btn_text') ?: 'Enroll Now');
    $btnText = $heroBtnText;
    $rawBtnLink = setting('sticky_promo_btn_link');
    if (empty($rawBtnLink) || $rawBtnLink === '#' || $rawBtnLink === '#register') {
        $btnLink = (request()->is('/') || request()->is('home*') || isHome()) ? '#register' : url('/#register');
    } else {
        $btnLink = \Illuminate\Support\Str::startsWith($rawBtnLink, ['http://', 'https://', '/']) ? $rawBtnLink : url($rawBtnLink);
    }
@endphp

@if($showStickyBar == 1)
<style>
    .sticky-promo-container {
        width: 100%;
        margin: 0 auto 40px auto;
        position: relative;
    }
    
    .sticky-promo-wrapper {
        width: 100%;
        background: #d1fae5; /* Match light green bg from above */
        border: 2px solid #10b981;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        z-index: 1040;
    }

    .sp-inner-container {
        display: flex;
        flex-wrap: wrap;
        width: 100%;
        max-width: 1278px;
        margin: 0 auto;
    }
    
    .sticky-promo-wrapper.is-sticky {
        position: fixed;
        bottom: 0;
        left: 0;
        transform: none;
        width: 100%;
        max-width: 100%;
        border-radius: 0;
        margin: 0;
        border-left: none;
        border-right: none;
        border-bottom: none;
        box-shadow: 0 -4px 20px rgba(0,0,0,0.1);
    }

    .sp-left {
        flex: 1;
        min-width: 300px;
        padding: 12px 24px;
        display: flex;
        align-items: center;
        justify-content: flex-start;
    }

    .sp-left h3 {
        color: #047857;
        margin: 0;
        font-size: 20px;
        font-weight: bold;
    }

    .sp-middle {
        padding: 12px 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .sp-countdown {
        display: flex;
        gap: 8px;
    }

    .sp-cd-item {
        background: #ffffff;
        color: #047857;
        border-radius: 4px;
        padding: 6px 12px;
        min-width: 50px;
        text-align: center;
        font-weight: bold;
        border: 1px solid #10b981;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .sp-cd-item .num {
        font-size: 16px;
        font-weight: 700;
        color: #ea580c;
        line-height: 1.2;
    }

    .sp-cd-item span.label {
        font-size: 9px;
        color: #047857;
        text-transform: uppercase;
        margin-top: 4px;
    }

    .sp-right {
        padding: 12px 24px;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        min-width: 200px;
    }

    .sp-right .btn-enroll {
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 28px !important;
        font-size: 15px !important;
        font-weight: 700 !important;
        line-height: 1.2 !important;
        border-radius: 10px !important;
        background-color: #10b981 !important;
        border: 2px solid #10b981 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 14px rgba(16, 185, 129, 0.35);
        overflow: visible !important;
        transition: all 0.3s ease;
    }

    .sp-right .btn-enroll:hover {
        background-color: #059669 !important;
        border-color: #059669 !important;
        color: #ffffff !important;
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(16, 185, 129, 0.45);
    }

    .sp-right .btn-enroll i {
        font-size: 14px;
        margin-left: 0 !important;
        line-height: 1;
    }

    /* Button Border Beam Animation styles */
    .btn-border-beam-svg {
        position: absolute;
        top: -2px !important;
        left: -2px !important;
        width: calc(100% + 4px) !important;
        height: calc(100% + 4px) !important;
        pointer-events: none;
        z-index: 1;
        overflow: visible !important;
    }

    .btn-border-beam-rect {
        stroke-linecap: round;
        animation: btn-border-beam-travel 4s linear infinite;
        will-change: stroke-dashoffset;
        filter: drop-shadow(0 0 4px rgba(251, 191, 36, 0.9)) drop-shadow(0 0 2px rgba(255, 255, 255, 0.9));
    }

    @keyframes btn-border-beam-travel {
        0% {
            stroke-dashoffset: var(--btn-perimeter, 400);
        }
        100% {
            stroke-dashoffset: 0;
        }
    }
    
    .sticky-promo-anchor {
        width: 100%;
        height: 1px;
    }

    @media (max-width: 768px) {
        .sp-inner-container {
            flex-direction: row;
            flex-wrap: wrap;
            padding: 8px 10px;
            align-items: center;
        }
        .sp-left {
            flex: 0 0 100%;
            max-width: 100%;
            justify-content: center;
            padding: 0 0 8px 0;
            min-width: 0;
        }
        .sp-middle {
            flex: 0 0 55%;
            max-width: 55%;
            justify-content: flex-start;
            padding: 0;
            min-width: 0;
        }
        .sp-right {
            flex: 0 0 45%;
            max-width: 45%;
            justify-content: flex-end;
            padding: 0;
            min-width: 0;
        }
        .sp-right .btn-enroll {
            padding: 8px 14px !important;
            font-size: 13px !important;
            border-radius: 8px !important;
        }
        .sp-left h3 {
            font-size: 14px;
            text-align: center;
            line-height: 1.2;
            margin: 0;
        }
        .sp-countdown {
            gap: 4px;
        }
        .sp-cd-item {
            padding: 4px;
            min-width: 38px;
        }
        .sp-cd-item .num {
            font-size: 13px;
        }
        .sp-cd-item span.label {
            font-size: 8px;
            margin-top: 2px;
        }
        .sticky-promo-wrapper.is-sticky {
            border-radius: 0;
            max-width: 100%;
            border-left: none;
            border-right: none;
        }
    }
</style>

<div class="container container-1278 px-lg-0 px-3">
    <div class="sticky-promo-container">
        <div class="sticky-promo-anchor"></div>
        <div class="sticky-promo-wrapper sp-banner">
            <div class="sp-inner-container">
                <div class="sp-left">
                    <h3>{{ $title }}</h3>
                </div>
                <div class="sp-middle">
                    <div class="sp-countdown js-countdown">
                        <div class="sp-cd-item">
                            <span class="num js-hours">00</span>
                            <span class="label">HRS</span>
                        </div>
                        <div class="sp-cd-item">
                            <span class="num js-minutes">00</span>
                            <span class="label">MIN</span>
                        </div>
                        <div class="sp-cd-item">
                            <span class="num js-seconds">00</span>
                            <span class="label">SEC</span>
                        </div>
                    </div>
                </div>
                 <div class="sp-right">
                    <a href="{{ $btnLink }}" class="template-btn btn-enroll position-relative">
                        <!-- Border Beam SVG -->
                        <svg class="btn-border-beam-svg">
                            <defs>
                                <linearGradient id="btn-beam-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#ffc107" stop-opacity="0" />
                                    <stop offset="30%" stop-color="#ffc107" stop-opacity="0.85" />
                                    <stop offset="50%" stop-color="#ffffff" stop-opacity="1" />
                                    <stop offset="70%" stop-color="#ffc107" stop-opacity="0.85" />
                                    <stop offset="100%" stop-color="#ffc107" stop-opacity="0" />
                                </linearGradient>
                            </defs>
                            <rect class="btn-border-beam-rect" fill="none" stroke="url(#btn-beam-gradient)" stroke-width="2.5" rx="3" ry="3" />
                        </svg>
                        <span class="btn-text-content" style="position: relative; z-index: 2; display: inline-flex; align-items: center; justify-content: center; gap: 8px;">
                            <span>{{ $btnText }}</span>
                            <i class="fas fa-arrow-right" style="margin-left: 0 !important; font-size: 14px;"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const containers = document.querySelectorAll('.sticky-promo-container');
    
    containers.forEach(container => {
        const promoBar = container.querySelector('.sp-banner');
        const anchor = container.querySelector('.sticky-promo-anchor');
        
        if (promoBar && anchor) {
            const handleScroll = () => {
                const rect = anchor.getBoundingClientRect();
                const stickyThreshold = window.innerHeight - promoBar.offsetHeight;
                
                // If the anchor is below the point where the sticky bar sits
                if (rect.top > stickyThreshold) {
                    container.style.height = promoBar.offsetHeight + 'px';
                    promoBar.classList.add('is-sticky');
                    const scrollTopBtn = document.getElementById('fixed-scroll-top');
                    if (scrollTopBtn) {
                        scrollTopBtn.style.setProperty('bottom', (promoBar.offsetHeight + 20) + 'px', 'important');
                        scrollTopBtn.style.setProperty('transition', 'bottom 0.3s ease');
                    }
                } else {
                    promoBar.classList.remove('is-sticky');
                    container.style.height = 'auto';
                    const scrollTopBtn = document.getElementById('fixed-scroll-top');
                    if (scrollTopBtn) {
                        scrollTopBtn.style.removeProperty('bottom');
                    }
                }
            };

            window.addEventListener('scroll', handleScroll, { passive: true });
            window.addEventListener('resize', handleScroll, { passive: true });
            // Initial check
            handleScroll();
        }

        // Button Border Beam calculation
        const enrollBtn = container.querySelector('.btn-enroll');
        if (enrollBtn) {
            const btnSvg = enrollBtn.querySelector('.btn-border-beam-svg');
            const btnRect = enrollBtn.querySelector('.btn-border-beam-rect');
            if (btnSvg && btnRect) {
                let btnFrame;
                const updateBtnBeam = () => {
                    if (btnFrame) cancelAnimationFrame(btnFrame);
                    btnFrame = requestAnimationFrame(() => {
                        const w = enrollBtn.offsetWidth;
                        const h = enrollBtn.offsetHeight;
                        if (w <= 0 || h <= 0) return;

                        btnSvg.setAttribute('viewBox', `0 0 ${w} ${h}`);
                        
                        const strokeWidth = 2.5;
                        const inset = strokeWidth / 2;
                        const rectW = Math.max(0, w - strokeWidth);
                        const rectH = Math.max(0, h - strokeWidth);
                        
                        const computedStyle = window.getComputedStyle(enrollBtn);
                        const borderRadius = parseFloat(computedStyle.borderRadius) || 10;
                        const rx = Math.max(0, borderRadius - inset);
                        
                        btnRect.setAttribute('x', inset.toString());
                        btnRect.setAttribute('y', inset.toString());
                        btnRect.setAttribute('width', rectW.toString());
                        btnRect.setAttribute('height', rectH.toString());
                        btnRect.setAttribute('rx', rx.toString());
                        btnRect.setAttribute('ry', rx.toString());
                        
                        const perimeter = 2 * (rectW + rectH);
                        btnRect.style.setProperty('--btn-perimeter', perimeter.toString());
                        
                        // Set beam length to 25% of the perimeter
                        const beamLen = perimeter * 0.25;
                        btnRect.style.strokeDasharray = `${beamLen} ${perimeter - beamLen}`;
                    });
                };
                
                updateBtnBeam();
                window.addEventListener('resize', updateBtnBeam);
                if (window.ResizeObserver) {
                    const ro = new ResizeObserver(updateBtnBeam);
                    ro.observe(enrollBtn);
                }
            }
        }

        const countdownEl = container.querySelector('.js-countdown');
        if (countdownEl) {
            const durationMs = ((1 * 3600) + (59 * 60) + 59) * 1000; // 1 hr 59 min 59 sec
            const storageKey = 'sticky_promo_timer_end_v2';
            let promoEndTime = localStorage.getItem(storageKey);
            let now = new Date().getTime();
            
            if (!promoEndTime || parseInt(promoEndTime) <= now || parseInt(promoEndTime) > (now + durationMs)) {
                promoEndTime = now + durationMs;
                localStorage.setItem(storageKey, promoEndTime);
            }
            
            let countDownDate = parseInt(promoEndTime);

            const x = setInterval(function() {
                let now = new Date().getTime();
                let distance = countDownDate - now;
                
                if (distance <= 0) {
                    countDownDate = now + durationMs;
                    localStorage.setItem(storageKey, countDownDate);
                    distance = countDownDate - now;
                }

                const daysEl = countdownEl.querySelector(".js-days");
                const hoursEl = countdownEl.querySelector(".js-hours");
                const minsEl = countdownEl.querySelector(".js-minutes");
                const secsEl = countdownEl.querySelector(".js-seconds");
                
                const hours = Math.floor(distance / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                
                if(daysEl) daysEl.innerHTML = "00";
                if(hoursEl) hoursEl.innerHTML = hours < 10 ? '0' + hours : hours;
                if(minsEl) minsEl.innerHTML = minutes < 10 ? '0' + minutes : minutes;
                if(secsEl) secsEl.innerHTML = seconds < 10 ? '0' + seconds : seconds;
            }, 1000);
        }
    });
});
</script>
@endif
