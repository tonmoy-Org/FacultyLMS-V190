@php
    $mcSettings = [];
    if(isset($course) && $course) {
        $mcSettings = is_array($course->masterclass_settings) ? $course->masterclass_settings : json_decode($course->masterclass_settings ?? '[]', true);
        if(!is_array($mcSettings)) $mcSettings = [];
    }

    $benefitsTitle = !empty($mcSettings['benefits_title']) ? $mcSettings['benefits_title'] : 'Who Is This {Masterclass} For?';

    $stripEmojis = function($text) {
        if (empty($text)) return '';
        return trim(preg_replace('/[\x{1F600}-\x{1F64F}\x{1F300}-\x{1F5FF}\x{1F680}-\x{1F6FF}\x{1F700}-\x{1F77F}\x{1F780}-\x{1F7FF}\x{1F800}-\x{1F8FF}\x{1F900}-\x{1F9FF}\x{1FA00}-\x{1FA6F}\x{1FA70}-\x{1FAFF}\x{2600}-\x{26FF}\x{2700}-\x{27BF}]/u', '', $text));
    };

    $benefitsTitle = $stripEmojis($benefitsTitle);

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
            'শিক্ষার্থী | যারা পড়াশলেখার পাশাপাশি আয় করতে চান। | দক্ষতা শিখে স্বাধীন আয় শুরু করুন',
            'বেকার | যারা ফুল টাইম আয় করার পথ খুঁজতে চান। | ঘরে বসে ক্যারিয়ার গড়ার সুযোগ',
            'গৃহিণী | যারা ঘরের কাজের পাশাপাশি আয় করতে চান। | সময় ও দক্ষতার সঠিক ব্যবহার',
            'চাকুরীজীবী | যারা কাজের পরে এক্সট্রা আয় করতে চান। | অতিরিক্ত আয়ের একটি স্মার্ট উপায়'
        ];
    }

    $defaultNotes = [
        'দক্ষতা শিখে স্বাধীন আয় শুরু করুন',
        'ঘরে বসে ক্যারিয়ার গড়ার সুযোগ',
        'সময় ও দক্ষতার সঠিক ব্যবহার',
        'অতিরিক্ত আয়ের একটি স্মার্ট উপায়'
    ];
@endphp

<style>
    .mc-target-audience-card-light {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 24px 22px;
        height: 100%;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
    }

    .mc-target-audience-card-light:hover {
        transform: translateY(-4px);
        border-color: #10b981;
        box-shadow: 0 12px 30px rgba(16, 185, 129, 0.12);
    }

    .mc-audience-icon-box-light {
        width: 66px;
        height: 66px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        flex-shrink: 0;
    }

    .mc-audience-title-light {
        font-size: 18px;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 6px 0;
        line-height: 1.4;
    }

    .mc-audience-desc-light {
        font-size: 14px;
        color: #475569;
        line-height: 1.6;
        margin-bottom: 10px;
    }

    .mc-audience-check-note-light {
        font-size: 13px;
        font-weight: 600;
        color: #059669;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    mark.title-highlight, .title-highlight, h2 mark, .course-section-title mark {
        background: #d1fae5 !important;
        color: #047857 !important;
        padding: 2px 8px;
        border-radius: 6px;
    }
</style>

<section class="benefits-section p-t-60 p-b-60" style="background-color: #ffffff;">
    <div class="container container-1278">
        <div class="mc-benefits-card-wrapper">
            <h2 class="fw-bold course-section-title text-dark mb-5 text-center px-3" data-aos="fade-up" style="max-width: 800px; margin: 0 auto; line-height: 1.4; font-size: 26px; color: #1a1b4b !important;">
                {!! format_title_highlight($benefitsTitle) !!}
            </h2>

            <div class="row g-4 justify-content-center">
                @foreach($benefits as $idx => $benefit)
                    @php
                        $bTitle = '';
                        $bDesc = '';
                        $bNote = '';

                        if (str_contains($benefit, '|')) {
                            $parts = array_map('trim', explode('|', $benefit));
                            $bTitle = $parts[0] ?? '';
                            $bDesc = $parts[1] ?? '';
                            $bNote = $parts[2] ?? '';
                        } else {
                            if (str_contains($benefit, ' - ')) {
                                $parts = array_map('trim', explode(' - ', $benefit, 2));
                                $bTitle = $parts[0] ?? '';
                                $bDesc = $parts[1] ?? '';
                            } elseif (str_contains($benefit, '-')) {
                                $parts = array_map('trim', explode('-', $benefit, 2));
                                $bTitle = $parts[0] ?? '';
                                $bDesc = $parts[1] ?? '';
                            } else {
                                $bTitle = $benefit;
                            }
                        }

                        if (empty($bNote)) {
                            $bNote = $defaultNotes[$idx % count($defaultNotes)];
                        }

                        $bTitle = $stripEmojis($bTitle);
                        $bDesc = $stripEmojis($bDesc);
                        $bNote = $stripEmojis($bNote);

                        if ($idx === 0 || str_contains(strtolower($bTitle), 'শিক্ষার্থী') || str_contains(strtolower($bTitle), 'student')) {
                            $iconClass = 'fas fa-handshake';
                            $iconBg = '#ecfdf5';
                            $iconBorder = '#a7f3d0';
                            $iconColor = '#059669';
                        } elseif ($idx === 1 || str_contains(strtolower($bTitle), 'বেকার') || str_contains(strtolower($bTitle), 'jobless') || str_contains(strtolower($bTitle), 'unemployed')) {
                            $iconClass = 'fas fa-times-circle';
                            $iconBg = '#fef2f2';
                            $iconBorder = '#fecaca';
                            $iconColor = '#ef4444';
                        } elseif ($idx === 2 || str_contains(strtolower($bTitle), 'গৃহিণী') || str_contains(strtolower($bTitle), 'housewife')) {
                            $iconClass = 'fas fa-coins';
                            $iconBg = '#fffbeb';
                            $iconBorder = '#fde68a';
                            $iconColor = '#d97706';
                        } elseif ($idx === 3 || str_contains(strtolower($bTitle), 'চাকুরীজীবী') || str_contains(strtolower($bTitle), 'job') || str_contains(strtolower($bTitle), 'employee')) {
                            $iconClass = 'fas fa-briefcase';
                            $iconBg = '#f0f9ff';
                            $iconBorder = '#bae6fd';
                            $iconColor = '#0284c7';
                        } else {
                            $iconClass = 'fas fa-check-circle';
                            $iconBg = '#ecfdf5';
                            $iconBorder = '#a7f3d0';
                            $iconColor = '#059669';
                        }
                    @endphp

                    <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($idx % 2) * 100 }}">
                        <div class="mc-target-audience-card-light">
                            <div class="d-flex align-items-start gap-3">
                                <div class="mc-audience-icon-box-light" style="background: {{ $iconBg }}; border: 1px solid {{ $iconBorder }}; color: {{ $iconColor }};">
                                    <i class="{{ $iconClass }}"></i>
                                </div>
                                <div style="flex-grow: 1;">
                                    <h4 class="mc-audience-title-light">{{ $bTitle }}</h4>
                                    @if(!empty($bDesc))
                                        <p class="mc-audience-desc-light">{{ $bDesc }}</p>
                                    @endif
                                    @if(!empty($bNote))
                                        <div class="mc-audience-check-note-light">
                                            <i class="far fa-check-circle"></i>
                                            <span>{{ $bNote }}</span>
                                        </div>
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
