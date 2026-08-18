@php
    $status = setting('counter_section_status');
    
    $counterItems = setting('counter_items');
    if (!is_array($counterItems) || empty($counterItems)) {
        $counterItems = [
            ['title' => setting('counter_1_title') ?: 'Total Course', 'count' => setting('counter_1_count') ?: '22 +'],
            ['title' => setting('counter_2_title') ?: 'Instructors',  'count' => setting('counter_2_count') ?: '9 +'],
            ['title' => setting('counter_3_title') ?: 'Learners',     'count' => setting('counter_3_count') ?: '413 +'],
            ['title' => setting('counter_4_title') ?: 'Satisfied',    'count' => setting('counter_4_count') ?: '2.03 %'],
        ];
    }
@endphp

@if($status !== '0' && count($counterItems) > 0)
<style>
    .counter-section-standalone {
        position: relative;
        z-index: 10;
    }
    .counter-card-box {
        background: #ffffff !important;
        border-radius: 14px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
        padding: 38px 20px 45px 20px;
        text-align: center;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        min-height: 190px;
        border: 1px solid #f1f5f9;
    }
    .counter-card-box:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 32px rgba(0, 0, 0, 0.11);
    }
    .counter-label {
        color: #1f2937 !important;
        font-size: 22px !important;
        font-weight: 700 !important;
        line-height: 1.25;
        margin-bottom: 4px;
        letter-spacing: -0.01em;
    }
    .counter-dot-line {
        width: 85px;
        height: 1px;
        background-color: #a7f3d0;
        margin: 8px auto 12px auto;
        position: relative;
    }
    .counter-dot {
        width: 6px;
        height: 6px;
        background-color: #25ab7c;
        border-radius: 50%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .counter-number {
        color: #25ab7c !important;
        font-size: 34px !important;
        font-weight: 800 !important;
        line-height: 1.1;
        letter-spacing: -0.02em;
        font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }
    .counter-bottom-wave {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 40px;
        pointer-events: none;
        overflow: hidden;
        border-bottom-left-radius: 14px;
        border-bottom-right-radius: 14px;
    }
    @media (max-width: 767.98px) {
        .hero-area {
            padding-bottom: 25px !important;
        }
        .counter-section-standalone {
            padding-top: 25px !important;
            padding-bottom: 0px !important;
        }
        .course-description-section {
            padding-top: 25px !important;
            padding-bottom: 25px !important;
        }
        .about-me-section {
            padding-top: 25px !important;
            padding-bottom: 25px !important;
        }
        .categories-of-work-section {
            padding-top: 25px !important;
            padding-bottom: 25px !important;
        }
        .counter-card-box {
            padding: 22px 10px 28px 10px !important;
            min-height: 135px !important;
            border-radius: 12px;
        }
        .counter-label {
            font-size: 16px !important;
            margin-bottom: 2px;
        }
        .counter-number {
            font-size: 22px !important;
        }
        .counter-dot-line {
            width: 50px;
            margin: 6px auto 8px auto;
        }
        .counter-bottom-wave {
            height: 30px;
        }
    }
    @media (max-width: 380px) {
        .counter-card-box {
            padding: 18px 6px 24px 6px !important;
            min-height: 125px !important;
        }
        .counter-label {
            font-size: 14px !important;
        }
        .counter-number {
            font-size: 20px !important;
        }
        .counter-dot-line {
            width: 40px;
        }
    }
</style>

<section class="counter-section counter-section-standalone bg-white p-t-60 p-b-60" style="background-color: #ffffff !important;">
    <div class="container container-1278">
        <div class="row align-items-stretch justify-content-center g-2 g-sm-3 g-md-4">
            @php
                $itemCount = count($counterItems);
                if ($itemCount == 1) {
                    $colClass = 'col-lg-6 col-md-8 col-12';
                } elseif ($itemCount == 2) {
                    $colClass = 'col-lg-6 col-md-6 col-6';
                } elseif ($itemCount == 3) {
                    $colClass = 'col-lg-4 col-md-6 col-6';
                } else {
                    $colClass = 'col-lg-3 col-md-6 col-6';
                }
            @endphp

            @foreach($counterItems as $index => $item)
                @php
                    $itemTitle = $item['title'] ?? '';
                    $itemVal   = $item['count'] ?? '';
                @endphp
                <div class="{{ $colClass }}" data-aos="fade-up" data-aos-delay="{{ 50 * ($index + 1) }}">
                    <div class="counter-card-box">
                        <span class="counter-label d-block">
                            {{ __($itemTitle) }}
                        </span>
                        <div class="counter-dot-line">
                            <span class="counter-dot"></span>
                        </div>
                        <h3 class="counter-number mb-0" data-count="{{ $itemVal }}">
                            {{ $itemVal }}
                        </h3>
                        <div class="counter-bottom-wave">
                            <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">
                                <path d="M0.00,49.98 C150.00,150.00 349.20,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #eef9f4;"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const counterElements = document.querySelectorAll('.counter-number[data-count]');
    if (!counterElements.length) return;

    function animateCounter(el) {
        const rawString = el.getAttribute('data-count') || el.innerText;
        const match = rawString.match(/([0-9]+(?:\.[0-9]+)?)/);
        if (!match) return;

        const targetNum = parseFloat(match[0]);
        const numStr = match[0];
        const decimals = numStr.includes('.') ? numStr.split('.')[1].length : 0;
        
        const prefix = rawString.substring(0, match.index);
        const suffix = rawString.substring(match.index + match[0].length);

        const duration = 2000;
        const startTime = performance.now();

        function update(currentTime) {
            const elapsedTime = currentTime - startTime;
            const progress = Math.min(elapsedTime / duration, 1);
            
            const easeProgress = 1 - Math.pow(1 - progress, 3);
            const currentNum = easeProgress * targetNum;

            el.innerText = prefix + currentNum.toFixed(decimals) + suffix;

            if (progress < 1) {
                requestAnimationFrame(update);
            } else {
                el.innerText = rawString;
            }
        }

        requestAnimationFrame(update);
    }

    if ('IntersectionObserver' in window) {
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.15
        };

        const observer = new IntersectionObserver((entries, observerInstance) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    observerInstance.unobserve(entry.target);
                }
            });
        }, observerOptions);

        counterElements.forEach(el => observer.observe(el));
    } else {
        counterElements.forEach(el => animateCounter(el));
    }
});
</script>
@endif
