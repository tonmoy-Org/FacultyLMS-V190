@php
    $mcSettings = [];
    if(isset($course) && $course) {
        $mcSettings = is_array($course->masterclass_settings) ? $course->masterclass_settings : json_decode($course->masterclass_settings ?? '[]', true);
    }

    $formatCurrencyText = function($text) {
        if (empty($text)) return $text;
        $sym = get_symbol();
        $code = userCurrency();
        if ($code === 'BDT') {
            return str_replace(['$', 'USD', 'TK', 'Tk'], $sym, $text);
        } else {
            return str_replace(['৳', 'TK', 'Tk', 'টাকা'], $sym, $text);
        }
    };
    
    $breakdownRows = [];
    if (!empty($mcSettings['breakdown_items'])) {
        $cleanItems = str_replace(['</p>', '<br>', '<br/>', '<br />'], "\n", $mcSettings['breakdown_items']);
        $cleanItems = strip_tags($cleanItems);
        $lines = array_filter(array_map('trim', explode("\n", $cleanItems)));
        foreach ($lines as $line) {
            $parts = explode('|', $line);
            $breakdownRows[] = [
                'title' => trim($parts[0] ?? ''),
                'val'   => trim($parts[1] ?? '')
            ];
        }
    }
    if (empty($breakdownRows)) {
        $breakdownRows = [
            ['title' => '🎓 ৪০+ ঘণ্টার ফুল স্ট্যাক ওয়েব কোর্স রেকর্ডিং', 'val' => get_symbol().'৪,০০০'],
            ['title' => '🎁 ২৫+ প্রফেশনাল প্রজেক্টের সোর্স কোড ও টেমপ্লেট', 'val' => get_symbol().'৩,০০০'],
            ['title' => '👥 ১-অন-১ লাইভ মেন্টরশিপ ও জুম সাপোর্ট', 'val' => get_symbol().'৩,০০০']
        ];
    }
@endphp

@if(!empty($mcSettings['breakdown_status']))
<section class="offer-breakdown-section p-t-60 p-b-60 bg-white position-relative">
    <div class="container container-1278">
        <div class="mc-content-card" data-aos="fade-up" style="border: 2px solid #10b981; border-radius: 8px; padding: 24px; background: #ffffff;">
            <h3 class="fw-bold text-center mb-4" style="color: #1a1b4b; font-size: 28px;">
                {{ $formatCurrencyText(!empty($mcSettings['breakdown_today_title']) ? $mcSettings['breakdown_today_title'] : 'আজকে এই কোর্সে যুক্ত হলে যা যা পাচ্ছেন:') }}
            </h3>
            
            <div class="breakdown-list">
                @foreach($breakdownRows as $idx => $row)
                    <div class="d-flex justify-content-between align-items-center border-bottom py-3">
                        <div class="d-flex align-items-center gap-2">
                            @if(str_contains(strtolower($row['title']), 'masterclass') || str_contains(strtolower($row['title']), 'মাস্টারক্লাস') || str_contains(strtolower($row['title']), 'master class'))
                                <i class="fas fa-graduation-cap text-secondary fs-5"></i>
                            @else
                                <i class="fas fa-gift text-warning fs-5"></i>
                            @endif
                            <span class="text-dark" style="font-weight: 500; font-size: 15px;">{{ $row['title'] }}</span>
                        </div>
                        <div class="fw-bold text-dark" style="font-size: 16px;">
                            {{ $formatCurrencyText($row['val']) }}
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-4 p-3 rounded d-flex flex-column flex-md-row justify-content-between align-items-center" style="background: #d1fae5;">
                <span class="fw-bold mb-2 mb-md-0" style="color: #047857; font-size: 18px;">
                    {{ $formatCurrencyText(!empty($mcSettings['breakdown_subheading']) ? $mcSettings['breakdown_subheading'] : 'আজকের অফার মূল্য ২৫০০ টাকা মাত্র') }}
                </span>
                @if(!empty($mcSettings['breakdown_original_price']))
                <span class="fw-bold position-relative d-inline-block" style="color: #047857; font-size: 22px; white-space: nowrap;">
                    <span style="position: absolute; width: 120%; height: 2px; background: red; top: 50%; left: -10%; transform: rotate(-20deg);"></span>
                    <span style="position: absolute; width: 120%; height: 2px; background: red; top: 50%; left: -10%; transform: rotate(20deg);"></span>
                    {{ $formatCurrencyText($mcSettings['breakdown_original_price']) }}
                </span>
                @endif
            </div>
            
            @if(!empty($mcSettings['breakdown_cta_text']))
            <div class="text-center w-100 mt-4">
                <a href="{{ !empty($mcSettings['breakdown_cta_link']) ? $mcSettings['breakdown_cta_link'] : (isset($course) ? route('course.details', $course->slug) : '#') }}" class="template-btn">
                    {{ $mcSettings['breakdown_cta_text'] }}
                </a>
            </div>
            @endif
        </div>
    </div>
</section>
@endif
