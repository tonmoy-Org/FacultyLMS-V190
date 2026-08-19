@php
    $mcSettings = [];
    if(isset($course) && !empty($course->masterclass_settings)) {
        $mcSettings = is_string($course->masterclass_settings) ? json_decode($course->masterclass_settings, true) : $course->masterclass_settings;
    }

    if (!function_exists('detectSupportUrlIcon')) {
        function detectSupportUrlIcon($url) {
            $urlLower = strtolower($url ?? '');
            if (str_contains($urlLower, 'facebook.com') || str_contains($urlLower, 'fb.com')) {
                return ['icon' => 'fab fa-facebook-f', 'name' => 'Facebook', 'class' => 'mc-social-fb'];
            }
            if (str_contains($urlLower, 'twitter.com') || str_contains($urlLower, 'x.com')) {
                return ['icon' => 'fab fa-twitter', 'name' => 'Twitter / X', 'class' => 'mc-social-tw'];
            }
            if (str_contains($urlLower, 'youtube.com') || str_contains($urlLower, 'youtu.be')) {
                return ['icon' => 'fab fa-youtube', 'name' => 'YouTube', 'class' => 'mc-social-yt'];
            }
            if (str_contains($urlLower, 'wa.me') || str_contains($urlLower, 'whatsapp.com')) {
                return ['icon' => 'fab fa-whatsapp', 'name' => 'WhatsApp', 'class' => 'mc-social-wa'];
            }
            if (str_contains($urlLower, 't.me') || str_contains($urlLower, 'telegram.')) {
                return ['icon' => 'fab fa-telegram-plane', 'name' => 'Telegram', 'class' => 'mc-social-tg'];
            }
            if (str_contains($urlLower, 'linkedin.com')) {
                return ['icon' => 'fab fa-linkedin-in', 'name' => 'LinkedIn', 'class' => 'mc-social-li'];
            }
            if (str_contains($urlLower, 'instagram.com')) {
                return ['icon' => 'fab fa-instagram', 'name' => 'Instagram', 'class' => 'mc-social-insta'];
            }
            if (str_contains($urlLower, 'tiktok.com')) {
                return ['icon' => 'fab fa-tiktok', 'name' => 'TikTok', 'class' => 'mc-social-custom'];
            }
            if (str_contains($urlLower, 'discord.')) {
                return ['icon' => 'fab fa-discord', 'name' => 'Discord', 'class' => 'mc-social-custom'];
            }
            if (str_contains($urlLower, 'pinterest.com')) {
                return ['icon' => 'fab fa-pinterest-p', 'name' => 'Pinterest', 'class' => 'mc-social-custom'];
            }
            if (str_contains($urlLower, 'github.com')) {
                return ['icon' => 'fab fa-github', 'name' => 'GitHub', 'class' => 'mc-social-custom'];
            }
            return ['icon' => 'fas fa-link', 'name' => 'Support Link', 'class' => 'mc-social-custom'];
        }
    }

    $supportStatus = !empty($mcSettings['support_status']);
    if ($supportStatus) {
        $supportTitle = !empty($mcSettings['support_title']) ? $mcSettings['support_title'] : '';
        $supportDescription = !empty($mcSettings['support_description']) ? $mcSettings['support_description'] : '';
        $supportImageUrl = !empty($mcSettings['support_image_url']) ? dynamic_asset($mcSettings['support_image_url']) : null;

        $socialLinksList = [];

        // 1. Dynamic support_icons_list
        if (!empty($mcSettings['support_icons_list']) && is_array($mcSettings['support_icons_list'])) {
            foreach ($mcSettings['support_icons_list'] as $sItem) {
                $targetUrl = !empty($sItem['url']) ? trim($sItem['url']) : '';
                $hasIconImg = !empty($sItem['icon_image_url']);
                $hasIconClass = !empty($sItem['icon']);

                if ($targetUrl !== '' || $hasIconImg || $hasIconClass) {
                    $detected = detectSupportUrlIcon($targetUrl);
                    $socialLinksList[] = [
                        'name' => !empty($sItem['title']) ? $sItem['title'] : (!empty($sItem['name']) ? $sItem['name'] : $detected['name']),
                        'url' => $targetUrl ?: '#',
                        'icon' => $hasIconClass ? $sItem['icon'] : $detected['icon'],
                        'icon_image_url' => $sItem['icon_image_url'] ?? null,
                        'class' => $detected['class']
                    ];
                }
            }
        }

        // 2. Custom social links fallback
        if (empty($socialLinksList) && !empty($mcSettings['support_custom_social_links']) && is_array($mcSettings['support_custom_social_links'])) {
            foreach ($mcSettings['support_custom_social_links'] as $cItem) {
                $targetUrl = !empty($cItem['url']) ? trim($cItem['url']) : '';
                if ($targetUrl !== '' || !empty($cItem['icon_image_url']) || !empty($cItem['icon'])) {
                    $detected = detectSupportUrlIcon($targetUrl);
                    $socialLinksList[] = [
                        'name' => $cItem['name'] ?? $detected['name'],
                        'url' => $targetUrl ?: '#',
                        'icon' => !empty($cItem['icon']) ? $cItem['icon'] : $detected['icon'],
                        'icon_image_url' => $cItem['icon_image_url'] ?? null,
                        'class' => $detected['class']
                    ];
                }
            }
        }

        // 3. Global / preset links fallback
        if (empty($socialLinksList)) {
            $legacyKeys = [
                ['key' => 'support_facebook_url', 'setting' => 'facebook_link', 'name' => 'Facebook', 'icon' => 'fab fa-facebook-f', 'class' => 'mc-social-fb'],
                ['key' => 'support_twitter_url', 'setting' => 'twitter_link', 'name' => 'Twitter / X', 'icon' => 'fab fa-twitter', 'class' => 'mc-social-tw'],
                ['key' => 'support_youtube_url', 'setting' => 'youtube_link', 'name' => 'YouTube', 'icon' => 'fab fa-youtube', 'class' => 'mc-social-yt'],
                ['key' => 'support_whatsapp_url', 'setting' => 'whatsapp_link', 'name' => 'WhatsApp', 'icon' => 'fab fa-whatsapp', 'class' => 'mc-social-wa'],
                ['key' => 'support_telegram_url', 'setting' => 'telegram_link', 'name' => 'Telegram', 'icon' => 'fab fa-telegram-plane', 'class' => 'mc-social-tg'],
                ['key' => 'support_linkedin_url', 'setting' => 'linkedin_link', 'name' => 'LinkedIn', 'icon' => 'fab fa-linkedin-in', 'class' => 'mc-social-li'],
                ['key' => 'support_instagram_url', 'setting' => 'instagram_link', 'name' => 'Instagram', 'icon' => 'fab fa-instagram', 'class' => 'mc-social-insta'],
            ];

            foreach ($legacyKeys as $lKey) {
                $lUrl = isset($mcSettings[$lKey['key']]) ? $mcSettings[$lKey['key']] : setting($lKey['setting']);
                if ($lUrl !== null && $lUrl !== '') {
                    if ($lKey['key'] == 'support_whatsapp_url' && !str_contains($lUrl, 'http') && is_numeric(preg_replace('/[^0-9]/', '', $lUrl))) {
                        $lUrl = 'https://wa.me/' . preg_replace('/[^0-9]/', '', $lUrl);
                    }
                    $socialLinksList[] = [
                        'name' => $lKey['name'],
                        'url' => $lUrl,
                        'icon' => $lKey['icon'],
                        'class' => $lKey['class']
                    ];
                }
            }
        }

        // 4. Default sample social links if empty
        if (empty($socialLinksList)) {
            $socialLinksList = [
                ['name' => 'Facebook', 'url' => '#', 'icon' => 'fab fa-facebook-f', 'class' => 'mc-social-fb'],
                ['name' => 'Twitter / X', 'url' => '#', 'icon' => 'fab fa-twitter', 'class' => 'mc-social-tw'],
                ['name' => 'YouTube', 'url' => '#', 'icon' => 'fab fa-youtube', 'class' => 'mc-social-yt'],
                ['name' => 'WhatsApp', 'url' => '#', 'icon' => 'fab fa-whatsapp', 'class' => 'mc-social-wa'],
                ['name' => 'Telegram', 'url' => '#', 'icon' => 'fab fa-telegram-plane', 'class' => 'mc-social-tg'],
            ];
        }
>>>>>>> origin/Update-for-icos-and-copy-system
    }
@endphp

@if(isset($supportStatus) && $supportStatus)
<style>
    .mc-support-section-wrapper {
        background-color: #eefaf6;
        background-image: linear-gradient(rgba(16, 185, 129, 0.04) 1px, transparent 1px), linear-gradient(90deg, rgba(16, 185, 129, 0.04) 1px, transparent 1px);
        background-size: 20px 20px;
        border-top: 1px solid #d1fae5;
        border-bottom: 1px solid #d1fae5;
        padding-top: 50px;
        margin-top: 0 !important;
        width: 100%;
    }

    .mc-support-section {
        margin: 0 !important;
        padding: 0 !important;
        border: none !important;
        border-radius: 0 !important;
        background: transparent !important;
    }

    .mc-support-content {
        padding-bottom: 50px;
    }

    .mc-support-title {
        font-family: "Outfit", sans-serif !important;
        font-size: 28px !important;
        font-weight: 700 !important;
        color: #1a1b4b !important;
        margin-bottom: 20px;
        line-height: 1.3 !important;
    }

    .mc-support-description {
        font-family: "Inter", sans-serif !important;
        font-size: 16px !important;
        line-height: 1.8 !important;
        color: #334155 !important;
    }

    .mc-support-description p {
        font-size: 16px !important;
        line-height: 1.8 !important;
        color: #334155 !important;
        margin-bottom: 12px;
    }

    .mc-support-social-group {
        margin-top: 24px;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }

    .mc-support-social-btn {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: #ffffff;
        color: #1a1b4b;
        font-size: 18px;
        text-decoration: none;
        border: 1px solid rgba(26, 27, 75, 0.12);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .mc-support-social-btn:hover {
        transform: translateY(-4px) scale(1.08);
        color: #ffffff !important;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .mc-support-social-btn.mc-social-fb:hover {
        background-color: #1877F2 !important;
        border-color: #1877F2 !important;
    }

    .mc-support-social-btn.mc-social-tw:hover {
        background-color: #1DA1F2 !important;
        border-color: #1DA1F2 !important;
    }

    .mc-support-social-btn.mc-social-yt:hover {
        background-color: #FF0000 !important;
        border-color: #FF0000 !important;
    }

    .mc-support-social-btn.mc-social-wa:hover {
        background-color: #25D366 !important;
        border-color: #25D366 !important;
    }

    .mc-support-social-btn.mc-social-tg:hover {
        background-color: #0088cc !important;
        border-color: #0088cc !important;
    }

    .mc-support-social-btn.mc-social-li:hover {
        background-color: #0A66C2 !important;
        border-color: #0A66C2 !important;
    }

    .mc-support-social-btn.mc-social-insta:hover {
        background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888) !important;
        border-color: #dc2743 !important;
    }

    .mc-support-social-btn.mc-social-custom:hover {
        background-color: #10b981 !important;
        border-color: #10b981 !important;
    }

    .mc-support-img-wrapper {
        height: 100%;
        display: flex;
        align-items: end;
    }

    .mc-support-img {
        max-height: 520px;
        width: auto;
        display: block;
        object-fit: contain;
        margin-bottom: 0;
    }

    @media (max-width: 991px) {
        .mc-support-section-wrapper {
            padding-top: 30px;
        }
        .mc-support-content {
            padding-bottom: 24px;
        }
        .mc-support-title {
            font-size: 24px !important;
            margin-bottom: 12px;
        }
        .mc-support-description,
        .mc-support-description p {
            font-size: 14.5px !important;
            line-height: 1.7 !important;
        }
        .mc-support-img {
            max-height: 400px;
        }
        .mc-support-social-btn {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }
    }
</style>

<section class="mc-support-section-wrapper">
    <div class="container container-1278">
        <div class="mc-support-section" data-aos="fade-up">
            <div class="row align-items-end g-4">
                <!-- Left Side: Content -->
                <div class="col-lg-6 col-md-12 mc-support-content text-start">
                    <h2 class="mc-support-title">{!! $supportTitle !!}</h2>
                    <div class="mc-support-description">
                        {!! $supportDescription !!}
                    </div>

                    <!-- Support Social Media Icons -->
                    @if(!empty($socialLinksList))
                        <div class="mc-support-social-group">
                            @foreach($socialLinksList as $sItem)
                                <a href="{{ $sItem['url'] }}" target="_blank" rel="noopener noreferrer"
                                   class="mc-support-social-btn {{ $sItem['class'] ?? 'mc-social-custom' }}"
                                   title="{{ $sItem['name'] }}" data-bs-toggle="tooltip" data-bs-placement="top">
                                    @if(!empty($sItem['icon_image_url']))
                                        <img src="{{ $sItem['icon_image_url'] }}" alt="{{ $sItem['name'] }}" style="width: 22px; height: 22px; object-fit: contain;">
                                    @else
                                        <i class="{{ $sItem['icon'] ?? 'fas fa-link' }}"></i>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Right Side: Image -->
                <div class="col-lg-6 col-md-12 text-center text-lg-end mc-support-img-wrapper justify-content-center justify-content-lg-end">
                    @if(!empty($supportImageUrl))
                        <img src="{{ $supportImageUrl }}" alt="Support Image" class="mc-support-img img-fluid">
                    @else
                        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Support Image" class="mc-support-img img-fluid" style="padding-bottom: 50px; opacity: 0.85;">
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif
