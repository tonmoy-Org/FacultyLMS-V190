@php
    $mcSettings = [];
    if (isset($course) && !empty($course->masterclass_settings)) {
        $mcSettings = is_string($course->masterclass_settings) ? json_decode($course->masterclass_settings, true) : $course->masterclass_settings;
    } elseif (isset($hero_course) && !empty($hero_course->masterclass_settings)) {
        $mcSettings = is_string($hero_course->masterclass_settings) ? json_decode($hero_course->masterclass_settings, true) : $hero_course->masterclass_settings;
    }
    if (!is_array($mcSettings)) $mcSettings = [];

    $supportStatus = !isset($mcSettings['support_status']) || !empty($mcSettings['support_status']);

    if ($supportStatus) {
        $supportTitle = !empty($mcSettings['support_title']) ? $mcSettings['support_title'] : 'লাইফটাইম সাপোর্ট';
        $supportTitleIcon = !empty($mcSettings['support_title_icon']) ? $mcSettings['support_title_icon'] : 'fas fa-headset';
        $supportSubtitle = !empty($mcSettings['support_subtitle']) 
            ? $mcSettings['support_subtitle'] 
            : 'কোর্স শেষ হলেও আপনার শেখার পথ শেষ হবে না।';

        $supportDescription = !empty($mcSettings['support_description']) 
            ? $mcSettings['support_description'] 
            : 'আমাদের এক্সপার্ট সাপোর্ট ইন্সট্রাক্টর টিম প্রতিদিন আপনাকে লাইভ জুম সেশনের মাধ্যমে প্রতিটি কোডিং সমস্যা সমাধানে সাহায্য করবে।';

        $supportImageUrl = !empty($mcSettings['support_image_url']) 
            ? dynamic_asset($mcSettings['support_image_url']) 
            : asset('images/support/support_right_top.png');

        // Feature Cards (Dynamic List)
        $featureCards = [];
        if (!empty($mcSettings['support_features_list']) && is_array($mcSettings['support_features_list'])) {
            $featureCards = array_values($mcSettings['support_features_list']);
        } else {
            $f1Icon = $mcSettings['support_feature_1_icon'] ?? 'fas fa-comment-dots';
            $f1Title = $mcSettings['support_feature_1_title'] ?? 'ডাইরেক্ট সাপোর্ট';
            $f1Desc = $mcSettings['support_feature_1_desc'] ?? 'যেকোনো কোর্স-রিলেটেড সমস্যায় সরাসরি সাপোর্ট পাবেন আমাদের টিমের কাছ থেকে।';

            $f2Icon = $mcSettings['support_feature_2_icon'] ?? 'fas fa-video';
            $f2Title = $mcSettings['support_feature_2_title'] ?? '1-to-1 লাইভ হেল্প';
            $f2Desc = $mcSettings['support_feature_2_desc'] ?? 'প্রয়োজনে জুম মিটিংয়ের মাধ্যমে লাইভে সমস্যার সমাধান নিন সহজেই।';

            $f3Icon = $mcSettings['support_feature_3_icon'] ?? 'fas fa-infinity';
            $f3Title = $mcSettings['support_feature_3_title'] ?? 'লাইফটাইম এক্সেস';
            $f3Desc = $mcSettings['support_feature_3_desc'] ?? 'কোর্স একবার কিনলে আজীবন সাপোর্ট ও মেন্টর গাইডলাইন পেতে থাকবেন।';

            $featureCards = [
                ['title' => $f1Title, 'icon' => $f1Icon, 'desc' => $f1Desc],
                ['title' => $f2Title, 'icon' => $f2Icon, 'desc' => $f2Desc],
                ['title' => $f3Title, 'icon' => $f3Icon, 'desc' => $f3Desc],
            ];
        }

        // Divider
        $supportDividerText = $mcSettings['support_divider_text'] ?? 'সাপোর্ট নিতে যোগাযোগ করুন';

        // Channels List (Dynamic)
        $channelCards = [];
        if (!empty($mcSettings['support_channels_list']) && is_array($mcSettings['support_channels_list'])) {
            $channelCards = array_values($mcSettings['support_channels_list']);
        } else {
            $channelCards = [
                [
                    'title' => $mcSettings['support_channel_1_title'] ?? 'ফেসবুক সাপোর্ট',
                    'desc' => $mcSettings['support_channel_1_desc'] ?? 'আমাদের ফেসবুক পেজে মেসেজ করুন',
                    'icon' => $mcSettings['support_channel_1_icon'] ?? 'fab fa-facebook-f',
                    'team_avatar' => $mcSettings['support_channel_1_team_avatar'] ?? 'images/support/support_avatars.png',
                    'team_label' => $mcSettings['support_channel_1_team_label'] ?? 'সক্রিয় সাপোর্ট টিম',
                    'btn_text' => $mcSettings['support_channel_1_btn_text'] ?? 'মেসেজ করুন',
                    'url' => $mcSettings['support_channel_1_url'] ?? ($mcSettings['support_facebook_url'] ?? setting('facebook_link') ?? '#'),
                    'is_highlighted' => 0
                ],
                [
                    'title' => $mcSettings['support_channel_2_title'] ?? 'হোয়াটসঅ্যাপ সাপোর্ট',
                    'desc' => $mcSettings['support_channel_2_desc'] ?? 'দ্রুত উত্তর পেতে আমাদের হোয়াটসঅ্যাপে নক দিন',
                    'icon' => $mcSettings['support_channel_2_icon'] ?? 'fab fa-whatsapp',
                    'team_avatar' => $mcSettings['support_channel_2_team_avatar'] ?? 'images/support/support_avatars.png',
                    'team_label' => $mcSettings['support_channel_2_team_label'] ?? 'দ্রুত রেসপন্স',
                    'btn_text' => $mcSettings['support_channel_2_btn_text'] ?? 'হোয়াটসঅ্যাপে নক দিন',
                    'url' => $mcSettings['support_channel_2_url'] ?? ($mcSettings['support_whatsapp_url'] ?? setting('whatsapp_link') ?? '#'),
                    'is_highlighted' => 1
                ],
                [
                    'title' => $mcSettings['support_channel_3_title'] ?? 'টেলিগ্রাম সাপোর্ট',
                    'desc' => $mcSettings['support_channel_3_desc'] ?? 'সাপোর্ট কমিউনিটিতে যুক্ত হয়ে সবার সাথে থাকুন',
                    'icon' => $mcSettings['support_channel_3_icon'] ?? 'fab fa-telegram-plane',
                    'team_avatar' => $mcSettings['support_channel_3_team_avatar'] ?? 'images/support/support_avatars.png',
                    'team_label' => $mcSettings['support_channel_3_team_label'] ?? 'অ্যাক্টিভ কমিউনিটি',
                    'btn_text' => $mcSettings['support_channel_3_btn_text'] ?? 'টেলিগ্রামে যোগ দিন',
                    'url' => $mcSettings['support_channel_3_url'] ?? ($mcSettings['support_telegram_url'] ?? setting('telegram_link') ?? '#'),
                    'is_highlighted' => 0
                ]
            ];
        }

        // Backward compatibility
        if (!empty($mcSettings['support_icons_list']) && is_array($mcSettings['support_icons_list'])) {
            foreach ($mcSettings['support_icons_list'] as $sItem) {
                $u = strtolower($sItem['url'] ?? '');
                if (empty($mcSettings['support_channel_1_url']) && (str_contains($u, 'facebook.com') || str_contains($u, 'fb.com'))) {
                    $fbUrl = $sItem['url'];
                } elseif (empty($mcSettings['support_channel_2_url']) && (str_contains($u, 'wa.me') || str_contains($u, 'whatsapp.com'))) {
                    $waUrl = $sItem['url'];
                } elseif (empty($mcSettings['support_channel_3_url']) && (str_contains($u, 't.me') || str_contains($u, 'telegram.'))) {
                    $tgUrl = $sItem['url'];
                }
            }
        }

        if (!empty($waUrl) && $waUrl !== '#' && !str_contains($waUrl, 'http') && is_numeric(preg_replace('/[^0-9]/', '', $waUrl))) {
            $waUrl = 'https://wa.me/' . preg_replace('/[^0-9]/', '', $waUrl);
        }

        // Bottom Strip
        $stripIcon = $mcSettings['support_strip_icon'] ?? 'fas fa-heart';
        $stripText1 = $mcSettings['support_strip_text_1'] ?? 'আপনি একা নন, আমরা আছি আপনার সাথে সবসময়।';
        $stripText2 = $mcSettings['support_strip_text_2'] ?? 'আপনার সফলতাই আমাদের লক্ষ্য।';

        $renderIcon = function($icon, $defaultClass = '') {
            $icon = trim($icon ?: $defaultClass);
            if (preg_match('/\.(png|jpg|jpeg|svg|webp)$/i', $icon) || str_starts_with($icon, 'http') || str_starts_with($icon, '/') || str_contains($icon, 'uploads/') || str_contains($icon, 'images/')) {
                return '<img src="' . dynamic_asset($icon) . '" alt="icon" style="max-width: 100%; max-height: 100%; object-fit: contain; display: inline-block; vertical-align: middle;">';
            }
            return '<i class="' . e($icon) . '"></i>';
        };
    }
@endphp

@if(isset($supportStatus) && $supportStatus)
<style>
    /* Support Section Styles - Standard typography & previous image size */
    .mc-support-section-wrapper {
        background-color: #eefaf6;
        background-image: linear-gradient(rgba(16, 185, 129, 0.04) 1px, transparent 1px), linear-gradient(90deg, rgba(16, 185, 129, 0.04) 1px, transparent 1px);
        background-size: 20px 20px;
        border-top: 1px solid #d1fae5;
        border-bottom: 1px solid #d1fae5;
        padding-top: 50px;
        padding-bottom: 50px;
        margin-top: 0 !important;
        width: 100%;
        position: relative;
        font-family: var(--body-font, "Inter", "Hind Siliguri", sans-serif);
    }

    /* Heading - Balanced primary font size matching other sections */
    .mc-support-title {
        font-family: var(--header-font, "Outfit", "Hind Siliguri", sans-serif) !important;
        font-size: 32px !important;
        font-weight: 700 !important;
        color: #1a1b4b !important;
        line-height: 1.3 !important;
        margin-bottom: 12px !important;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
    }

    .mc-support-title-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #059669;
        font-size: 26px;
    }

    /* Subtitle / Semi-heading */
    .mc-support-subtitle {
        font-family: var(--header-font, "Outfit", "Hind Siliguri", sans-serif) !important;
        font-size: 17px !important;
        font-weight: 700 !important;
        color: #065f46 !important;
        margin-bottom: 12px !important;
        line-height: 1.5 !important;
    }

    /* Description */
    .mc-support-description,
    .mc-support-description p {
        font-family: var(--body-font, "Inter", "Hind Siliguri", sans-serif) !important;
        font-size: 15.5px !important;
        line-height: 1.8 !important;
        color: #334155 !important;
        margin-bottom: 22px !important;
    }

    /* Dynamic Feature Cards */
    .mc-support-feature-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 14px;
        margin-top: 10px;
    }

    .mc-support-feature-card {
        background: #ffffff;
        border: 1px solid #dcf2e8;
        border-radius: 14px;
        padding: 18px 12px 16px 12px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .mc-support-feature-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 22px rgba(16, 185, 129, 0.08);
        border-color: #a7f3d0;
    }

    .mc-feature-icon-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #ecfdf5;
        color: #059669;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        margin-bottom: 10px;
        padding: 6px;
    }

    .mc-feature-icon-circle img {
        width: 24px;
        height: 24px;
        object-fit: contain;
    }

    .mc-feature-title {
        font-family: var(--header-font, "Outfit", "Hind Siliguri", sans-serif) !important;
        font-size: 14.5px !important;
        font-weight: 700 !important;
        color: #1a1b4b !important;
        margin-bottom: 6px !important;
    }

    .mc-feature-desc {
        font-family: var(--body-font, "Inter", "Hind Siliguri", sans-serif) !important;
        font-size: 12px !important;
        line-height: 1.5 !important;
        color: #64748b !important;
        margin: 0 !important;
    }

    /* Right Top Image - Restored to exact previous dimension standards */
    .mc-support-img-wrapper {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .mc-support-img {
        max-height: 520px;
        width: auto;
        display: block;
        object-fit: contain;
        margin-bottom: 0;
    }

    /* Section Divider */
    .mc-support-divider-section {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 40px 0 30px 0;
        position: relative;
    }

    .mc-support-divider-line {
        flex: 1;
        height: 1px;
        background: #cbd5e1;
    }

    .mc-support-divider-text {
        padding: 0 18px;
        font-family: var(--header-font, "Outfit", "Hind Siliguri", sans-serif) !important;
        font-size: 16px;
        font-weight: 700;
        color: #1a1b4b;
        display: flex;
        align-items: center;
        gap: 8px;
        background: transparent;
    }

    .mc-divider-bullet {
        color: #059669;
        font-size: 15px;
    }

    /* Dynamic Channel Support Cards Grid */
    .mc-channel-cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 18px;
    }

    .mc-avatar-default {
        background: #e7f7ed;
        color: #048240;
    }

    .mc-channel-card {
        background: #ffffff;
        border: 1px solid #dcf2e8;
        border-radius: 14px;
        padding: 24px 20px 22px 20px;
        min-height: 205px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: all 0.25s ease;
    }

    .mc-channel-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 22px rgba(16, 185, 129, 0.08);
    }

    .mc-channel-card.highlighted-channel {
        border-color: #6ee7b7;
        box-shadow: 0 4px 18px rgba(5, 150, 105, 0.08);
    }

    .mc-channel-card-top {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 14px;
    }

    .mc-channel-avatar-circle {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: #ffffff;
        flex-shrink: 0;
    }

    .mc-channel-avatar-circle img {
        width: 26px;
        height: 26px;
        object-fit: contain;
    }

    .mc-avatar-fb {
        background-color: #1877F2;
    }

    .mc-avatar-wa {
        background-color: #25D366;
    }

    .mc-avatar-tg {
        background-color: #0088cc;
    }

    .mc-channel-info-title {
        font-family: var(--header-font, "Outfit", "Hind Siliguri", sans-serif) !important;
        font-size: 16px !important;
        font-weight: 700 !important;
        color: #0f172a !important;
        margin: 0 0 2px 0 !important;
        line-height: 1.3 !important;
    }

    .mc-channel-info-desc {
        font-family: var(--body-font, "Inter", "Hind Siliguri", sans-serif) !important;
        font-size: 12.5px !important;
        color: #64748b !important;
        margin: 0 !important;
        line-height: 1.4 !important;
    }

    /* Team Avatars Row */
    .mc-channel-team-row {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
        padding-left: 56px;
    }

    .mc-team-avatars-img {
        height: 20px;
        width: auto;
        object-fit: contain;
    }

    .mc-team-status-label {
        font-family: var(--body-font, "Inter", "Hind Siliguri", sans-serif) !important;
        font-size: 12px;
        color: #475569;
        font-weight: 500;
    }

    /* Channel Action Button */
    .mc-channel-btn {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 9px 16px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none !important;
        transition: all 0.25s ease;
    }

    /* Primary (template-btn) exact match with login & site primary buttons */
    .mc-channel-btn-primary.template-btn {
        width: 100% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        padding: 11.5px 24px !important;
        border-radius: 5px !important;
        font-size: 15px !important;
        font-weight: 600 !important;
        line-height: 1.5 !important;
        text-decoration: none !important;
        text-align: center !important;
        margin: 0 !important;
        background-color: var(--theme-clr, var(--color-secondary-4)) !important;
        border: 2px solid var(--theme-clr, var(--color-secondary-4)) !important;
        color: #ffffff !important;
        transition: all 0.35s ease !important;
        box-shadow: none !important;
    }

    .mc-channel-btn-primary.template-btn:hover {
        background-color: var(--color-hover, var(--theme-clr-deep-1, #1e3a8a)) !important;
        border-color: var(--color-hover, var(--theme-clr-deep-1, #1e3a8a)) !important;
        color: #ffffff !important;
        transform: translateY(-2px);
    }

    .mc-channel-btn-primary.template-btn i {
        margin-left: 6px;
        transition: transform 0.25s ease;
    }

    .mc-channel-btn-primary.template-btn:hover i {
        transform: translateX(3px);
    }

    /* Bottom Banner Strip */
    .mc-support-footer-strip {
        margin-top: 26px;
        background: transparent;
        border: 1px solid #86efac;
        border-radius: 12px;
        padding: 12px 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        text-align: center;
        box-shadow: none;
    }

    .mc-footer-heart-badge {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background-color: #048240;
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        flex-shrink: 0;
    }

    .mc-footer-strip-text {
        font-family: var(--body-font, "Inter", "Hind Siliguri", sans-serif) !important;
        font-size: 14.5px;
        color: #064e3b;
        font-weight: 600;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        justify-content: center;
        gap: 8px;
    }

    .mc-footer-strip-sep {
        color: #94a3b8;
        font-weight: 300;
        margin: 0 4px;
    }

    .mc-footer-strip-highlight {
        font-weight: 500;
        color: #064e3b;
    }

    /* ==========================================================================
       RESPONSIVE DESIGN BREAKPOINTS
       1. Large / High-Resolution Screens (min-width: 1400px)
       2. Standard Desktop Monitors (1200px - 1399px) [Base styles]
       3. Laptops & Compact Desktops (992px - 1199px)
       4. Tablets (768px - 991px)
       5. Small Tablets & Landscape Mobile (576px - 767px)
       6. Mobile Phones (max-width: 575px)
       7. Extra-Small Mobile Screens (max-width: 380px)
       ========================================================================== */

    /* 1. Large / High-Resolution Screens (1400px+) */
    @media (min-width: 1400px) {
        .mc-support-section-wrapper {
            padding-top: 60px;
            padding-bottom: 60px;
        }

        .mc-support-title {
            font-size: 34px !important;
            margin-bottom: 14px !important;
        }

        .mc-support-img {
            max-height: 520px;
        }

        .mc-channel-cards-grid {
            gap: 22px;
        }
    }

    /* 2. Laptops & Compact Desktops (992px - 1199px) */
    @media (min-width: 992px) and (max-width: 1199px) {
        .mc-support-section-wrapper {
            padding-top: 45px;
            padding-bottom: 45px;
        }

        .mc-support-title {
            font-size: 28px !important;
            line-height: 1.3 !important;
        }

        .mc-support-title-icon {
            font-size: 24px;
        }

        .mc-support-subtitle {
            font-size: 15.5px !important;
        }

        .mc-support-description,
        .mc-support-description p {
            font-size: 14.5px !important;
            line-height: 1.7 !important;
            margin-bottom: 18px !important;
        }

        .mc-support-feature-cards {
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }

        .mc-support-feature-card {
            padding: 14px 8px 12px 8px;
        }

        .mc-feature-icon-circle {
            width: 36px;
            height: 36px;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .mc-feature-icon-circle img {
            width: 20px;
            height: 20px;
        }

        .mc-feature-title {
            font-size: 13.5px !important;
            margin-bottom: 4px !important;
        }

        .mc-feature-desc {
            font-size: 11px !important;
            line-height: 1.4 !important;
        }

        .mc-support-img {
            max-height: 420px;
        }

        .mc-channel-cards-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .mc-channel-card {
            padding: 20px 14px 18px 14px;
            min-height: 205px;
        }

        .mc-channel-avatar-circle {
            width: 38px;
            height: 38px;
            font-size: 17px;
        }

        .mc-channel-info-title {
            font-size: 15px !important;
        }

        .mc-channel-info-desc {
            font-size: 11.5px !important;
        }

        .mc-channel-team-row {
            padding-left: 50px;
            margin-bottom: 16px;
        }

        .mc-team-avatars-img {
            height: 18px;
        }

        .mc-team-status-label {
            font-size: 11px;
        }

        .mc-channel-btn-primary.template-btn {
            font-size: 13px !important;
            padding: 9px 12px !important;
        }
    }

    /* 3. Tablets (768px - 991px) */
    @media (min-width: 768px) and (max-width: 991px) {
        .mc-support-section-wrapper {
            padding-top: 40px;
            padding-bottom: 40px;
        }

        .mc-support-title {
            font-size: 28px !important;
            line-height: 1.35 !important;
        }

        .mc-support-subtitle {
            font-size: 16px !important;
        }

        .mc-support-description,
        .mc-support-description p {
            font-size: 15px !important;
            line-height: 1.7 !important;
            margin-bottom: 20px !important;
        }

        .mc-support-feature-cards {
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .mc-support-feature-card {
            padding: 16px 10px 14px 10px;
        }

        .mc-support-img-wrapper {
            margin-top: 20px;
            display: flex;
            justify-content: center !important;
        }

        .mc-support-img {
            max-height: 380px;
        }

        .mc-support-divider-section {
            margin: 32px 0 24px 0;
        }

        .mc-channel-cards-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
        }

        .mc-channel-card {
            padding: 20px 14px 18px 14px;
            min-height: 200px;
        }

        .mc-channel-team-row {
            padding-left: 54px;
            margin-bottom: 16px;
        }

        .mc-channel-info-title {
            font-size: 15px !important;
        }

        .mc-channel-info-desc {
            font-size: 12px !important;
        }

        .mc-channel-btn-primary.template-btn {
            font-size: 13.5px !important;
            padding: 9.5px 14px !important;
        }

        .mc-support-footer-strip {
            padding: 12px 18px;
            gap: 10px;
        }

        .mc-footer-strip-text {
            font-size: 14px;
        }
    }

    /* 4. Small Tablets & Landscape Mobile (576px - 767px) */
    @media (min-width: 576px) and (max-width: 767px) {
        .mc-support-section-wrapper {
            padding-top: 35px;
            padding-bottom: 35px;
        }

        .mc-support-title {
            font-size: 25px !important;
            line-height: 1.35 !important;
            margin-bottom: 10px !important;
        }

        .mc-support-title-icon {
            font-size: 22px;
        }

        .mc-support-subtitle {
            font-size: 15px !important;
            margin-bottom: 10px !important;
        }

        .mc-support-description,
        .mc-support-description p {
            font-size: 14px !important;
            line-height: 1.65 !important;
            margin-bottom: 18px !important;
        }

        .mc-support-feature-cards {
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .mc-support-feature-card {
            padding: 14px 8px 12px 8px;
        }

        .mc-feature-title {
            font-size: 13.5px !important;
        }

        .mc-feature-desc {
            font-size: 11px !important;
        }

        .mc-support-img-wrapper {
            margin-top: 20px;
            display: flex;
            justify-content: center !important;
        }

        .mc-support-img {
            max-height: 300px;
        }

        .mc-support-divider-section {
            margin: 28px 0 20px 0;
        }

        .mc-channel-cards-grid {
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 12px;
        }

        .mc-channel-card {
            padding: 20px 16px 18px 16px;
            min-height: 195px;
        }

        .mc-channel-team-row {
            padding-left: 54px;
            margin-bottom: 16px;
        }

        .mc-support-footer-strip {
            padding: 12px 16px;
            gap: 8px;
            flex-direction: column;
        }

        .mc-footer-strip-sep {
            display: none;
        }

        .mc-footer-strip-text {
            font-size: 13.5px;
        }
    }

    /* 5. Mobile Phones (max-width: 575px) */
    @media (max-width: 575px) {
        .mc-support-section-wrapper {
            padding-top: 30px;
            padding-bottom: 30px;
        }

        .mc-support-title {
            font-size: 22px !important;
            line-height: 1.35 !important;
            margin-bottom: 8px !important;
            gap: 6px;
        }

        .mc-support-title-icon {
            font-size: 20px;
        }

        .mc-support-subtitle {
            font-size: 14px !important;
            line-height: 1.5 !important;
            margin-bottom: 8px !important;
        }

        .mc-support-description,
        .mc-support-description p {
            font-size: 13.5px !important;
            line-height: 1.65 !important;
            margin-bottom: 16px !important;
        }

        /* Feature Cards on Mobile: Compact vertical centered look, stacked one by one */
        .mc-support-feature-cards {
            grid-template-columns: 1fr;
            gap: 10px;
            margin-top: 10px;
        }

        .mc-support-feature-card {
            flex-direction: column;
            text-align: center;
            align-items: center;
            padding: 14px 14px 12px 14px;
            border-radius: 12px;
        }

        .mc-feature-icon-circle {
            margin-bottom: 8px;
            width: 36px;
            height: 36px;
            font-size: 14px;
            padding: 5px;
        }

        .mc-feature-icon-circle img {
            width: 20px;
            height: 20px;
        }

        .mc-feature-title {
            font-size: 14px !important;
            margin-bottom: 4px !important;
            text-align: center !important;
        }

        .mc-feature-desc {
            font-size: 11.5px !important;
            line-height: 1.45 !important;
            text-align: center !important;
        }

        .mc-support-img-wrapper {
            margin-top: 18px;
            display: flex;
            justify-content: center !important;
        }

        .mc-support-img {
            max-height: 250px;
        }

        .mc-support-divider-section {
            margin: 24px 0 18px 0;
        }

        .mc-support-divider-text {
            font-size: 13.5px;
            padding: 0 8px;
        }

        .mc-channel-cards-grid {
            grid-template-columns: 1fr;
            gap: 14px;
        }

        .mc-channel-card {
            padding: 18px 16px 16px 16px;
            min-height: auto;
            border-radius: 12px;
        }

        .mc-channel-card-top {
            gap: 10px;
            margin-bottom: 12px;
        }

        .mc-channel-avatar-circle {
            width: 40px;
            height: 40px;
            font-size: 18px;
        }

        .mc-channel-avatar-circle img {
            width: 24px;
            height: 24px;
        }

        .mc-channel-info-title {
            font-size: 15px !important;
            margin-bottom: 2px !important;
        }

        .mc-channel-info-desc {
            font-size: 12px !important;
            line-height: 1.35 !important;
        }

        .mc-channel-team-row {
            padding-left: 50px;
            margin-bottom: 16px;
            gap: 6px;
        }

        .mc-team-avatars-img {
            height: 18px;
        }

        .mc-team-status-label {
            font-size: 11.5px;
        }

        .mc-channel-btn-primary.template-btn {
            font-size: 13.5px !important;
            padding: 10px 14px !important;
            border-radius: 5px !important;
        }

        .mc-support-footer-strip {
            margin-top: 20px;
            flex-direction: column;
            padding: 12px 14px;
            gap: 6px;
            border-radius: 10px;
        }

        .mc-footer-heart-badge {
            width: 22px;
            height: 22px;
            font-size: 11px;
        }

        .mc-footer-strip-sep {
            display: none;
        }

        .mc-footer-strip-text {
            font-size: 13px;
            line-height: 1.45;
            text-align: center;
        }
    }

    /* 6. Extra-Small Mobile Screens (max-width: 380px) */
    @media (max-width: 380px) {
        .mc-support-title {
            font-size: 20px !important;
        }

        .mc-support-subtitle {
            font-size: 13.5px !important;
        }

        .mc-support-description,
        .mc-support-description p {
            font-size: 13px !important;
        }

        .mc-support-feature-cards {
            gap: 8px;
        }

        .mc-support-feature-card {
            padding: 12px 10px 10px 10px;
            border-radius: 10px;
        }

        .mc-feature-icon-circle {
            width: 32px;
            height: 32px;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .mc-feature-icon-circle img {
            width: 18px;
            height: 18px;
        }

        .mc-feature-title {
            font-size: 13px !important;
            margin-bottom: 3px !important;
        }

        .mc-feature-desc {
            font-size: 11px !important;
            line-height: 1.4 !important;
        }

        .mc-support-img {
            max-height: 200px;
        }

        .mc-channel-card {
            padding: 16px 12px 14px 12px;
        }

        .mc-channel-team-row {
            padding-left: 0;
            margin-top: 6px;
            margin-bottom: 14px;
        }

        .mc-channel-btn-primary.template-btn {
            font-size: 13px !important;
            padding: 9px 12px !important;
            border-radius: 5px !important;
        }

        .mc-footer-strip-text {
            font-size: 12px;
        }
    }
</style>

<section class="mc-support-section-wrapper">
    <div class="container container-1278">
        <!-- Top Half: Content + Right Top Image -->
        <div class="row align-items-center g-4">
            <!-- Left Side: Content -->
            <div class="col-lg-6 col-md-12 text-start">
                <!-- Main Title with Headset Icon -->
                <h2 class="mc-support-title" data-aos="fade-up">
                    <span>{!! format_title_highlight($supportTitle) !!}</span>
                    <span class="mc-support-title-icon">{!! $renderIcon($supportTitleIcon, 'fas fa-headset') !!}</span>
                </h2>

                <!-- Subtitle -->
                <p class="mc-support-subtitle" data-aos="fade-up" data-aos-delay="50">
                    {{ $supportSubtitle }}
                </p>

                <!-- Description -->
                <div class="mc-support-description" data-aos="fade-up" data-aos-delay="100">
                    {!! $supportDescription !!}
                </div>

                @if(!empty($featureCards) && count($featureCards) > 0)
                    <!-- Dynamic Feature Cards -->
                    <div class="mc-support-feature-cards" data-aos="fade-up" data-aos-delay="150">
                        @foreach($featureCards as $fCard)
                            @php
                                $fcTitle = $fCard['title'] ?? '';
                                $fcIcon = $fCard['icon'] ?? 'fas fa-check-circle';
                                $fcDesc = $fCard['desc'] ?? '';
                            @endphp
                            <div class="mc-support-feature-card">
                                <div class="mc-feature-icon-circle">
                                    {!! $renderIcon($fcIcon, 'fas fa-check-circle') !!}
                                </div>
                                @if(!empty($fcTitle))
                                    <h4 class="mc-feature-title">{{ $fcTitle }}</h4>
                                @endif
                                @if(!empty($fcDesc))
                                    <p class="mc-feature-desc">{{ $fcDesc }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Right Top Side: Restored to exact previous image size (max-height: 520px / 400px) -->
            <div class="col-lg-6 col-md-12 text-center text-lg-end mc-support-img-wrapper justify-content-center justify-content-lg-end" data-aos="fade-left" data-aos-delay="150">
                <img src="{{ $supportImageUrl }}" alt="সাপোর্ট টিম ও মেন্টর" class="mc-support-img img-fluid">
            </div>
        </div>

        <!-- Middle Section: Divider with Title -->
        <div class="mc-support-divider-section" data-aos="fade-up">
            <span class="mc-support-divider-line"></span>
            <div class="mc-support-divider-text">
                <span class="mc-divider-bullet">•</span>
                <span>{{ $supportDividerText }}</span>
                <span class="mc-divider-bullet">•</span>
            </div>
            <span class="mc-support-divider-line"></span>
        </div>

        @if(!empty($channelCards) && count($channelCards) > 0)
            <!-- Bottom Row: Dynamic Support Channel Cards -->
            <div class="mc-channel-cards-grid" data-aos="fade-up" data-aos-delay="100">
                @foreach($channelCards as $chCard)
                    @php
                        $cTitle = $chCard['title'] ?? '';
                        $cDesc = $chCard['desc'] ?? '';
                        $cIcon = $chCard['icon'] ?? 'fas fa-comments';
                        $cAvatar = !empty($chCard['team_avatar']) ? dynamic_asset($chCard['team_avatar']) : asset('images/support/support_avatars.png');
                        $cLabel = $chCard['team_label'] ?? 'সক্রিয় টিম';
                        $cBtnText = $chCard['btn_text'] ?? 'যোগাযোগ করুন';
                        $cUrl = $chCard['url'] ?? '#';
                        $isHigh = !empty($chCard['is_highlighted']);

                        $lower = strtolower($cTitle . ' ' . $cIcon . ' ' . $cUrl);
                        $avatarClass = 'mc-avatar-default';
                        if (str_contains($lower, 'face') || str_contains($lower, 'fb')) {
                            $avatarClass = 'mc-avatar-fb';
                        } elseif (str_contains($lower, 'whats') || str_contains($lower, 'wa.me')) {
                            $avatarClass = 'mc-avatar-wa';
                        } elseif (str_contains($lower, 'tele') || str_contains($lower, 't.me')) {
                            $avatarClass = 'mc-avatar-tg';
                        }
                    @endphp
                    <div class="mc-channel-card {{ $isHigh ? 'highlighted-channel' : '' }}">
                        <div>
                            <div class="mc-channel-card-top">
                                <div class="mc-channel-avatar-circle {{ $avatarClass }}">
                                    {!! $renderIcon($cIcon, 'fas fa-comments') !!}
                                </div>
                                <div>
                                    <h4 class="mc-channel-info-title">{{ $cTitle }}</h4>
                                    <p class="mc-channel-info-desc">{{ $cDesc }}</p>
                                </div>
                            </div>
                            <div class="mc-channel-team-row">
                                <img src="{{ $cAvatar }}" alt="{{ $cLabel }}" class="mc-team-avatars-img">
                                <span class="mc-team-status-label">{{ $cLabel }}</span>
                            </div>
                        </div>
                        <a href="{{ $cUrl }}" target="_blank" rel="noopener noreferrer" class="template-btn mc-channel-btn-primary">
                            <span>{{ $cBtnText }}</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Bottom Full-Width Strip Banner -->
        <div class="mc-support-footer-strip" data-aos="fade-up" data-aos-delay="150">
            <div class="mc-footer-heart-badge">
                {!! $renderIcon($stripIcon, 'fas fa-heart') !!}
            </div>
            <div class="mc-footer-strip-text">
                <span>{{ $stripText1 }}</span>
                <span class="mc-footer-strip-sep">|</span>
                <span class="mc-footer-strip-highlight">{{ $stripText2 }}</span>
            </div>
        </div>
    </div>
</section>
@endif
