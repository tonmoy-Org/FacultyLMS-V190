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

    $stripEmojis = function($text) {
        if (empty($text)) return '';
        return trim(preg_replace('/[\x{1F600}-\x{1F64F}\x{1F300}-\x{1F5FF}\x{1F680}-\x{1F6FF}\x{1F700}-\x{1F77F}\x{1F780}-\x{1F7FF}\x{1F800}-\x{1F8FF}\x{1F900}-\x{1F9FF}\x{1FA00}-\x{1FA6F}\x{1FA70}-\x{1FAFF}\x{2600}-\x{26FF}\x{2700}-\x{27BF}]/u', '', $text));
    };

    $defaultItems = "কোর্স ০১: ফ্রিল্যান্স স্মার্ট সিস্টেম \n Daily Income | ৳৩,০০০
কোর্স ০২: ইউটিউব অটোমেশন কোর্স \n USA Channel | ৳৮,০০০
কোর্স ০৩: AI - Passive Income | ৳৩,০০০
Live Support Class with Mentor | ৳২,০০০
Life Time Course Access | ৳২,০০০
30k Bonus Resources & Materials | FREE
Certificate of Participation | ৳৯৯০
Future Updates (if applicable) | FREE";

    $rawItems = !empty($mcSettings['breakdown_items']) ? $mcSettings['breakdown_items'] : $defaultItems;

    $breakdownRows = [];
    $cleanItems = str_replace(['</p>', '<br>', '<br/>', '<br />'], "\n", $rawItems);
    $cleanItems = strip_tags($cleanItems);
    $lines = array_values(array_filter(array_map('trim', explode("\n", $cleanItems))));
    
    $i = 0;
    while ($i < count($lines)) {
        $line = $lines[$i];
        if (str_contains($line, '|')) {
            $parts = explode('|', $line);
            $breakdownRows[] = [
                'title' => trim($parts[0] ?? ''),
                'val'   => trim($parts[1] ?? '')
            ];
            $i++;
        } else {
            if (isset($lines[$i+1]) && str_contains($lines[$i+1], '|')) {
                $parts = explode('|', $lines[$i+1]);
                $breakdownRows[] = [
                    'title' => $line . "\n" . trim($parts[0] ?? ''),
                    'val'   => trim($parts[1] ?? '')
                ];
                $i += 2;
            } else {
                $breakdownRows[] = [
                    'title' => $line,
                    'val'   => ''
                ];
                $i++;
            }
        }
    }

    $todayTitle = !empty($mcSettings['breakdown_today_title']) ? $mcSettings['breakdown_today_title'] : "Today's {Value} Breakdown";
    $subheading = !empty($mcSettings['breakdown_subheading']) ? $mcSettings['breakdown_subheading'] : "Today's Special Token Price: Only ৳২,৯৯০";
    $originalPrice = !empty($mcSettings['breakdown_original_price']) ? $mcSettings['breakdown_original_price'] : "৳১৪,৯৮০/-";
    $ribbonText = !empty($mcSettings['breakdown_ribbon_text']) ? $mcSettings['breakdown_ribbon_text'] : "আজই স্পেশাল ডিসকাউন্ট";

    // Strip all emojis
    $todayTitle = $stripEmojis($todayTitle);
    $subheading = $stripEmojis($subheading);
    $originalPrice = $stripEmojis($originalPrice);
    $ribbonText = $stripEmojis($ribbonText);

    $toNum = function($str) {
        $numStr = preg_replace('/[^\d]/', '', $str);
        $bengaliDigits = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
        $englishDigits = ['0','1','2','3','4','5','6','7','8','9'];
        $numStr = str_replace($bengaliDigits, $englishDigits, $numStr);
        return is_numeric($numStr) ? (float)$numStr : 0;
    };

    $origNum = $toNum($originalPrice);
    $offerNum = $toNum($subheading);
    $savedNum = max(0, $origNum - $offerNum);
    $discountPct = ($origNum > 0 && $savedNum > 0) ? round(($savedNum / $origNum) * 100) : 0;

    $toBengaliNum = function($num) {
        $englishDigits = ['0','1','2','3','4','5','6','7','8','9'];
        $bengaliDigits = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
        $formatted = number_format($num);
        return str_replace($englishDigits, $bengaliDigits, $formatted);
    };

    $savedText = $savedNum > 0 ? get_symbol() . $toBengaliNum($savedNum) : '';
    $discountText = $discountPct > 0 ? "({$toBengaliNum($discountPct)}% ছাড়)" : '';
@endphp

@if(isset($mcSettings['breakdown_status']) ? $mcSettings['breakdown_status'] : true)
<style>
    .offer-breakdown-section-light {
        background-color: #ffffff;
    }

    .mc-breakdown-light-card {
        background: #ffffff;
        border: 2px solid #10b981;
        border-radius: 20px;
        padding: 28px 24px;
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.05);
        max-width: 800px;
        margin: 0 auto;
    }

    .mc-bd-light-header {
        margin-bottom: 20px;
    }

    .mc-bd-light-eyebrow {
        color: #1a1b4b;
        font-size: 26px;
        font-weight: 700;
        margin-bottom: 6px;
        line-height: 1.4;
    }

    .mc-bd-light-title {
        color: #1a1b4b;
        font-size: 26px;
        font-weight: 700;
        text-align: center;
        margin: 0 auto 16px auto;
        line-height: 1.4;
    }

    .mc-bd-light-title mark, .mc-bd-light-title .highlight {
        background: #d1fae5;
        color: #047857;
        padding: 2px 8px;
        border-radius: 6px;
    }

    .mc-bd-light-items-box {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 4px 16px;
        margin-bottom: 20px;
    }

    .mc-bd-light-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 11px 4px;
        border-bottom: 1px solid #f1f5f9;
    }

    .mc-bd-light-row:last-child {
        border-bottom: none;
    }

    .mc-bd-light-icon-badge {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #059669;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .mc-bd-light-item-title {
        font-size: 0.98rem;
        font-weight: 700;
        color: #1e293b;
        line-height: 1.35;
    }

    .mc-bd-light-item-sub {
        font-size: 0.82rem;
        color: #64748b;
        margin-top: 2px;
        font-weight: 400;
    }

    .mc-bd-light-item-val {
        font-size: 1.1rem;
        font-weight: 800;
        color: #059669;
        white-space: nowrap;
    }

    /* Light Mint Green Offer Discount Box */
    .mc-bd-light-discount-box {
        background: #ecfdf5;
        border: 2px solid #10b981;
        border-radius: 16px;
        position: relative;
        padding: 24px 24px 20px 24px;
        margin-bottom: 20px;
    }

    .mc-bd-light-ribbon {
        position: absolute;
        top: -13px;
        left: 20px;
        background: linear-gradient(90deg, #f59e0b, #d97706);
        color: #ffffff;
        font-size: 0.85rem;
        font-weight: 800;
        padding: 4px 16px;
        border-radius: 6px;
        box-shadow: 0 4px 10px rgba(245, 158, 11, 0.3);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .mc-bd-light-ribbon i {
        font-size: 0.85rem;
        color: #ffffff;
    }

    .mc-bd-light-offer-heading {
        color: #065f46;
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .mc-bd-light-price-huge {
        font-size: 2.35rem;
        font-weight: 900;
        color: #047857;
        line-height: 1.15;
        margin-bottom: 6px;
        letter-spacing: -0.5px;
    }

    .mc-bd-light-timer-text {
        font-size: 0.88rem;
        color: #047857;
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 600;
    }

    .mc-bd-light-divider {
        border-right: 1px solid #a7f3d0;
    }

    .mc-bd-light-orig-label {
        color: #64748b;
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 2px;
    }

    .mc-bd-light-orig-price {
        font-size: 1.6rem;
        font-weight: 800;
        color: #047857;
        position: relative;
        display: inline-block;
        margin-bottom: 8px;
        white-space: nowrap;
    }

    .mc-bd-light-saved-box {
        border: 1px dashed #10b981;
        background: #ffffff;
        border-radius: 12px;
        padding: 10px 18px;
        text-align: center;
        width: 100%;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
    }

    .mc-bd-light-saved-label {
        font-size: 0.85rem;
        color: #475569;
        font-weight: 600;
        margin-bottom: 1px;
    }

    .mc-bd-light-saved-val {
        font-size: 1.35rem;
        font-weight: 900;
        color: #047857;
        line-height: 1.15;
    }

    .mc-bd-light-saved-pct {
        font-size: 0.85rem;
        color: #059669;
        font-weight: 700;
    }

    .mc-bd-light-security-note {
        color: #64748b;
        font-size: 0.88rem;
        margin-top: 10px;
        font-weight: 500;
    }

    .mc-bd-light-card .get-access-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 13px 32px !important;
        font-size: 1.05rem !important;
        font-weight: 800 !important;
        line-height: 1.2 !important;
        border-radius: 12px !important;
        background: linear-gradient(135deg, #10b981 0%, #047857 100%) !important;
        border: none !important;
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.35) !important;
        transition: all 0.3s ease !important;
        color: #ffffff !important;
        text-decoration: none !important;
    }

    .mc-bd-light-card .get-access-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(16, 185, 129, 0.45) !important;
        color: #ffffff !important;
    }

    @media (max-width: 767px) {
        .mc-breakdown-light-card {
            padding: 20px 12px;
        }
        .mc-bd-light-eyebrow, .mc-bd-light-title {
            font-size: 20px;
            line-height: 1.35;
        }
        .mc-bd-light-price-huge {
            font-size: 1.75rem;
        }
        .mc-bd-light-divider {
            border-right: none;
            border-bottom: 1px solid #a7f3d0;
            padding-bottom: 14px;
            margin-bottom: 14px;
        }
        .mc-bd-light-items-box {
            padding: 4px 10px;
        }
        .mc-bd-light-row {
            gap: 8px;
        }
        .mc-bd-light-item-title {
            font-size: 0.88rem;
            word-break: break-word;
        }
        .mc-bd-light-item-val {
            font-size: 0.95rem;
        }
    }
</style>

<section class="offer-breakdown-section offer-breakdown-section-light p-t-60 p-b-60 position-relative">
    <div class="container container-1278">
        <div class="mc-breakdown-light-card text-center" data-aos="fade-up">
            
            <div class="mc-bd-light-header">
                @php
                    $titleLines = array_values(array_filter(preg_split('/\r\n|\r|\n|<br\s*\/?>/i', $todayTitle)));
                    $eyebrowText = count($titleLines) > 1 ? trim($titleLines[0]) : '';
                    $mainTitleText = count($titleLines) > 1 ? trim($titleLines[1]) : (count($titleLines) == 1 ? trim($titleLines[0] ?? '') : $todayTitle);
                    
                    $eyebrowText = $stripEmojis($eyebrowText);
                    $mainTitleText = $stripEmojis($mainTitleText);
                @endphp
                @if(!empty($eyebrowText))
                    <div class="mc-bd-light-eyebrow">{!! format_title_highlight($formatCurrencyText($eyebrowText)) !!}</div>
                @endif
                <h3 class="mc-bd-light-title">
                    {!! format_title_highlight($formatCurrencyText($mainTitleText)) !!}
                </h3>
            </div>
            
            <div class="mc-bd-light-items-box text-start">
                @foreach($breakdownRows as $idx => $row)
                    @php
                        $cleanRowTitle = $stripEmojis($row['title']);
                        $itemLines = array_values(array_filter(preg_split('/\r\n|\r|\n|<br\s*\/?>/i', $cleanRowTitle)));
                        $itemMainTitle = trim($itemLines[0] ?? '');
                        $itemSubTitle = trim($itemLines[1] ?? '');
                        $isFree = strtolower(trim($row['val'])) === 'free';
                    @endphp
                    <div class="mc-bd-light-row">
                        <div class="d-flex align-items-center gap-3">
                            <div class="mc-bd-light-icon-badge">
                                @if(str_contains(strtolower($itemMainTitle), 'masterclass') || str_contains(strtolower($itemMainTitle), 'মাস্টারক্লাস'))
                                    <i class="fas fa-graduation-cap"></i>
                                @elseif(str_contains(strtolower($itemMainTitle), 'certificate') || str_contains(strtolower($itemMainTitle), 'সার্টিফিকেট'))
                                    <i class="fas fa-file-alt"></i>
                                @elseif(str_contains(strtolower($itemMainTitle), 'support') || str_contains(strtolower($itemMainTitle), 'সাপোর্ট'))
                                    <i class="fas fa-headphones"></i>
                                @elseif(str_contains(strtolower($itemMainTitle), 'update') || str_contains(strtolower($itemMainTitle), 'আপডেট'))
                                    <i class="fas fa-sync-alt"></i>
                                @else
                                    <i class="fas fa-gift"></i>
                                @endif
                            </div>
                            <div>
                                <div class="mc-bd-light-item-title">{{ $itemMainTitle }}</div>
                                @if(!empty($itemSubTitle))
                                    <div class="mc-bd-light-item-sub">{{ $itemSubTitle }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="mc-bd-light-item-val">
                            {{ $formatCurrencyText($row['val']) }}
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mc-bd-light-discount-box">
                <div class="mc-bd-light-ribbon">
                    <i class="fas fa-tag"></i>
                    <span>{{ $ribbonText }}</span>
                </div>
                
                <div class="row align-items-center gy-3">
                    <div class="col-md-6 text-center text-md-start mc-bd-light-divider pe-md-4">
                        <div class="mc-bd-light-offer-heading">এখনই কোর্সটি কিনুন মাত্র</div>
                        <div class="mc-bd-light-price-huge">{{ $formatCurrencyText($subheading) }}</div>
                        <div class="mc-bd-light-timer-text">
                            <i class="far fa-clock text-success"></i>
                            <span>সীমিত সময়ের অফার – এখনই সুযোগ নিন!</span>
                        </div>
                    </div>
                    
                    @if(!empty($originalPrice))
                        <div class="col-md-6 text-center ps-md-4 d-flex flex-column align-items-center justify-content-center">
                            <div class="mc-bd-light-orig-label">আসল মূল্য</div>
                            <div class="mc-bd-light-orig-price">
                                <span style="position: absolute; width: 110%; height: 2px; background: #ef4444; top: 50%; left: -5%; transform: rotate(-12deg);"></span>
                                <span>{{ $formatCurrencyText($originalPrice) }}</span>
                            </div>
                            
                            @if(!empty($savedText) || !empty($discountText))
                                <div class="mc-bd-light-saved-box">
                                    <div class="mc-bd-light-saved-label">আপনি সেভ করছেন</div>
                                    <div class="mc-bd-light-saved-val">{{ $savedText }}</div>
                                    @if(!empty($discountText))
                                        <div class="mc-bd-light-saved-pct">{{ $discountText }}</div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            
            @php
                $heroBtnText = !empty($mcSettings['overview_btn_text']) ? $mcSettings['overview_btn_text'] : 'Enroll Now';
                $heroBtnUrl = !empty($mcSettings['overview_btn_url']) ? $mcSettings['overview_btn_url'] : ((request()->is('/') || request()->is('home*') || isHome()) ? '#register' : url('/#register'));
                $breakdownCtaText = !empty($mcSettings['breakdown_cta_text']) ? $mcSettings['breakdown_cta_text'] : 'অফার টি নিতে চাই';
                $breakdownCtaLink = !empty($mcSettings['breakdown_cta_link']) ? $mcSettings['breakdown_cta_link'] : $heroBtnUrl;
            @endphp
            <div class="text-center w-100 mt-2">
                <a href="{{ $breakdownCtaLink }}" class="template-btn get-access-btn">
                    <i class="fas fa-shopping-cart me-2"></i>
                    <span>{{ $breakdownCtaText }}</span>
                    <i class="fas fa-arrow-right ms-2"></i>
                </a>
                <div class="mc-bd-light-security-note">
                    <i class="fas fa-lock me-1"></i> ১০০% নিরাপদ পেমেন্ট
                </div>
            </div>
            
        </div>
    </div>
</section>
@endif
