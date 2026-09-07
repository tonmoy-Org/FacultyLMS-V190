@php
    $mcSettings = [];
    if(isset($course) && $course) {
        $mcSettings = is_array($course->masterclass_settings) ? $course->masterclass_settings : json_decode($course->masterclass_settings ?? '[]', true);
        if(!is_array($mcSettings)) $mcSettings = [];
    }

    $benefitsTitle = !empty($mcSettings['benefits_title']) ? $mcSettings['benefits_title'] : 'Who Is This {Masterclass} For?';
    
    $benefits = [];
    if(!empty($mcSettings['benefits_list']) && is_array($mcSettings['benefits_list'])) {
        $benefits = array_values(array_filter(array_map('trim', $mcSettings['benefits_list'])));
    }
    if(empty($benefits) && !empty($mcSettings['benefits_items'])) {
        $lines = array_filter(array_map('trim', explode("\n", $mcSettings['benefits_items'])));
        $benefits = array_values($lines);
    }
    if(empty($benefits) && isset($course) && !empty($course->what_will_learn)) {
        $lines = array_filter(array_map('trim', explode("\n", strip_tags($course->what_will_learn))));
        $benefits = array_values($lines);
    }

    if(count($benefits) < 1) {
        $benefits = [
            'যাঁরা ই-কমার্স বিজনেসে আসতে চান, কিন্তু কীভাবে শুরু করবেন বুঝতে পারছেন না',
            'যাঁরা নতুন বিজনেস শুরু করেছেন কিন্তু সেলস আসছে না, তাঁরা সেলস বাড়ানোর সিক্রেট স্ট্র্যাটেজি জানতে চান',
            'যাঁরা ড্রপশিপিং করে কোনো ইনভেস্টমেন্ট ছাড়াই, রিস্ক ফ্রি ভাবে ব্যবসা শুরু করতে চান',
            'যাঁরা স্টুডেন্ট বা চাকরিজীবী এবং পার্ট-টাইম কিছু করে এক্সট্রা ইনকাম করতে চান'
        ];
    }
@endphp

<style>
    .mc-new-benefit-card {
        background: #ffffff;
        color: #1e293b;
        border-radius: 8px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        border: 1px solid #e2e8f0;
        height: 100%;
        display: flex;
        flex-direction: column;
        gap: 15px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .mc-new-benefit-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.06) !important;
        border-color: #cbd5e1 !important;
    }
    .mc-new-benefit-card.dark-theme:hover {
        border-color: #3b82f6 !important;
        box-shadow: 0 12px 30px rgba(59, 130, 246, 0.12) !important;
    }
    mark.title-highlight, .title-highlight, h2 mark, .course-section-title mark {
        background: transparent !important;
        color: inherit;
        position: relative;
        display: inline-block;
        padding: 0 8px;
        margin: 0 2px;
        font-weight: 700;
        z-index: 1;
        border: none !important;
        box-shadow: none !important;
    }

    mark.title-highlight::before, .title-highlight::before, h2 mark::before, .course-section-title mark::before {
        content: "";
        position: absolute;
        left: -6px;
        right: -6px;
        top: 12%;
        bottom: 2%;
        background: linear-gradient(98deg, #d1fae5 0%, #a7f3d0 40%, #6ee7b7 85%, #d1fae5 100%);
        opacity: 0.95;
        z-index: -1;
        clip-path: polygon(
            0% 14%, 2% 6%, 8% 10%, 18% 4%, 32% 9%, 48% 3%, 64% 8%, 79% 2%, 92% 7%, 100% 12%,
            99% 88%, 95% 96%, 82% 91%, 66% 97%, 51% 92%, 35% 98%, 19% 93%, 6% 97%, 0% 86%
        );
        transform: rotate(-0.8deg) scaleY(1.04);
        transition: all 0.3s ease;
    }

    mark.title-highlight::after, .title-highlight::after, h2 mark::after, .course-section-title mark::after {
        content: "";
        position: absolute;
        left: -4px;
        right: -4px;
        top: 20%;
        bottom: 6%;
        background: rgba(16, 185, 129, 0.15);
        z-index: -2;
        clip-path: polygon(
            1% 8%, 15% 12%, 30% 6%, 50% 11%, 70% 5%, 88% 10%, 98% 5%,
            99% 92%, 84% 96%, 65% 90%, 45% 95%, 25% 89%, 5% 94%, 0% 85%
        );
        transform: rotate(0.4deg);
    }
</style>

<section class="benefits-section p-t-60 p-b-60" style="background-color: #ffffff;">
    <div class="container container-1278">
        <div class="mc-benefits-card-wrapper">
            <h2 class="fw-bold course-section-title text-dark mb-5 text-center px-3" data-aos="fade-up" style="max-width: 800px; margin: 0 auto; line-height: 1.4; font-size: 26px;">{!! format_title_highlight($benefitsTitle) !!}</h2>

            <div class="row g-4 justify-content-center">
                @foreach($benefits as $benefit)
                    @php
                        $parts = explode('|', $benefit);
                        $bTitle = trim($parts[0] ?? '');
                        $bDesc = trim($parts[1] ?? '');
                        
                        $idx = $loop->index;
                        
                        $colClass = ($idx === 4) ? 'col-lg-12' : 'col-lg-6 col-md-6';
                        
                        if ($idx === 0) {
                            $cardClass = 'mc-new-benefit-card';
                            $cardStyle = 'background: #ebf5f1; border-color: #d1e8de;';
                            $titleColor = '#0f172a';
                            $descColor = '#475569';
                            $iconHtml = '<div class="mc-icon-wrapper" style="background: #ffffff; display: flex; align-items: center; justify-content: center; width: 48px; height: 48px; border-radius: 8px; flex-shrink: 0;"><i class="fas fa-handshake" style="color: #10b981; font-size: 20px;"></i></div>';
                        } elseif ($idx === 1) {
                            $cardClass = 'mc-new-benefit-card';
                            $cardStyle = '';
                            $titleColor = '#0f172a';
                            $descColor = '#475569';
                            $iconHtml = '<div class="mc-icon-wrapper" style="background: #fef2f2; display: flex; align-items: center; justify-content: center; width: 48px; height: 48px; border-radius: 10px; flex-shrink: 0;"><i class="fas fa-times-circle" style="color: #ef4444; font-size: 20px;"></i></div>';
                        } elseif ($idx === 2) {
                            $cardClass = 'mc-new-benefit-card';
                            $cardStyle = '';
                            $titleColor = '#0f172a';
                            $descColor = '#475569';
                            $iconHtml = '<div class="mc-icon-wrapper" style="background: #fffbeb; display: flex; align-items: center; justify-content: center; width: 48px; height: 48px; border-radius: 10px; flex-shrink: 0;"><i class="fas fa-coins" style="color: #f59e0b; font-size: 20px;"></i></div>';
                        } elseif ($idx === 3) {
                            $cardClass = 'mc-new-benefit-card';
                            $cardStyle = '';
                            $titleColor = '#0f172a';
                            $descColor = '#475569';
                            $iconHtml = '<div class="mc-icon-wrapper" style="background: #e6fbf4; display: flex; align-items: center; justify-content: center; width: 48px; height: 48px; border-radius: 10px; flex-shrink: 0;"><i class="fas fa-envelope-open-text" style="color: #10b981; font-size: 20px;"></i></div>';
                        } elseif ($idx === 4) {
                            $cardClass = 'mc-new-benefit-card';
                            $cardStyle = '';
                            $titleColor = '#0f172a';
                            $descColor = '#475569';
                            $iconHtml = '<div class="mc-icon-wrapper" style="background: #f0f9ff; display: flex; align-items: center; justify-content: center; width: 48px; height: 48px; border-radius: 10px; flex-shrink: 0;"><i class="fas fa-user-tie" style="color: #0284c7; font-size: 20px;"></i></div>';
                        } else {
                            $cardClass = 'mc-new-benefit-card';
                            $cardStyle = '';
                            $titleColor = '#0f172a';
                            $descColor = '#475569';
                            $iconHtml = '<div class="mc-icon-wrapper" style="background: #f0fdf4; display: flex; align-items: center; justify-content: center; width: 48px; height: 48px; border-radius: 10px; flex-shrink: 0;"><i class="fas fa-check-circle" style="color: #10b981; font-size: 20px;"></i></div>';
                            $colClass = 'col-lg-6 col-md-6';
                        }
                    @endphp

                    <div class="{{ $colClass }}" data-aos="fade-up" data-aos-delay="{{ ($idx % 2) * 100 }}">
                        <div class="{{ $cardClass }}" style="{{ $cardStyle }}">
                            <div class="d-flex align-items-start gap-3">
                                {!! $iconHtml !!}
                                <div style="flex-grow: 1;">
                                    <h4 style="font-size: 18px; font-weight: 700; color: {{ $titleColor }}; margin: 0 0 8px 0; line-height: 1.45;">{{ $bTitle }}</h4>
                                    @if(!empty($bDesc))
                                        <p style="font-size: 14px; line-height: 1.65; color: {{ $descColor }}; margin: 0;">{{ $bDesc }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
