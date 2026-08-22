@php
    $showStickyBar = setting('show_sticky_promo_bar');
    $title = setting('sticky_promo_title') ?: 'অফার শেষ হওয়ার আগেই কিনুন';
    
    $btnText = setting('sticky_promo_btn_text') ?: 'Enroll Now';
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
        gap: 8px;
        border-radius: 8px !important;
        overflow: visible !important;
    }

    .sp-right .btn-enroll i {
        font-size: 16px;
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
        animation: btn-border-beam-travel 6s linear infinite;
        will-change: stroke-dashoffset;
        filter: drop-shadow(0 0 3px rgba(255, 193, 7, 0.8)) drop-shadow(0 0 1px rgba(255, 255, 255, 0.7));
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
        .sp-right .btn-enroll {
            padding: 6px 8px;
            font-size: 12px;
            gap: 4px;
        }
        .sp-right .btn-enroll i {
            font-size: 12px;
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
                            <rect class="btn-border-beam-rect" fill="none" stroke="url(#btn-beam-gradient)" stroke-width="2.5" rx="8" ry="8" />
                        </svg>
                        <span class="btn-text-content" style="position: relative; z-index: 2; display: inline-flex; align-items: center; gap: 8px;">
                            {{ $btnText }} 
                            <i class="las la-arrow-right"></i>
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
                        btnSvg.setAttribute('viewBox', `0 0 ${w} ${h}`);
                        
                        const strokeWidth = 2.5;
                        const inset = strokeWidth / 2;
                        const rectW = w - strokeWidth;
                        const rectH = h - strokeWidth;
                        
                        btnRect.setAttribute('x', inset.toString());
                        btnRect.setAttribute('y', inset.toString());
                        btnRect.setAttribute('width', rectW.toString());
                        btnRect.setAttribute('height', rectH.toString());
                        
                        const perimeter = 2 * (rectW + rectH);
                        btnRect.style.setProperty('--btn-perimeter', perimeter.toString());
                        
                        // Set beam length to 30% of the perimeter
                        const beamLen = perimeter * 0.3;
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
            let durationHours = 2;
            let promoEndTime = localStorage.getItem('sticky_promo_end_time');
            let now = new Date().getTime();
            
            // Reset cycle: 24 hours. If there's no end time, or end time > 2 hours from now, or it's been more than 24 hours since the end time.
            if (!promoEndTime || promoEndTime > (now + durationHours * 3600 * 1000) || promoEndTime < (now - 24 * 3600 * 1000)) {
                promoEndTime = now + (durationHours * 3600 * 1000);
                localStorage.setItem('sticky_promo_end_time', promoEndTime);
            }
            
            const countDownDate = parseInt(promoEndTime);

            const x = setInterval(function() {
                const now = new Date().getTime();
                const distance = countDownDate - now;
                
                const daysEl = countdownEl.querySelector(".js-days");
                const hoursEl = countdownEl.querySelector(".js-hours");
                const minsEl = countdownEl.querySelector(".js-minutes");
                const secsEl = countdownEl.querySelector(".js-seconds");

                if (distance <= 0) {
                    clearInterval(x);
                    if(daysEl) daysEl.innerHTML = "00";
                    if(hoursEl) hoursEl.innerHTML = "00";
                    if(minsEl) minsEl.innerHTML = "00";
                    if(secsEl) secsEl.innerHTML = "00";
                    
                    // Hide the sticky bar when time expires
                    container.style.display = 'none';
                    const scrollTopBtn = document.getElementById('fixed-scroll-top');
                    if (scrollTopBtn) {
                        scrollTopBtn.style.removeProperty('bottom');
                    }
                    return;
                }
                
                const hours = Math.floor(distance / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                
                if(hoursEl) hoursEl.innerHTML = hours < 10 ? '0' + hours : hours;
                if(minsEl) minsEl.innerHTML = minutes < 10 ? '0' + minutes : minutes;
                if(secsEl) secsEl.innerHTML = seconds < 10 ? '0' + seconds : seconds;
            }, 1000);
        }
    });
});
</script>
@endif
