@php
    $mcSettings = $mcSettings ?? (old('masterclass_settings') ?: []);
    if (!is_array($mcSettings)) {
        $mcSettings = json_decode($mcSettings ?? '[]', true) ?: [];
    }

    $supportStatus = !empty($mcSettings['support_status']);
    $supportTitle = old('masterclass_settings.support_title', $mcSettings['support_title'] ?? 'লাইফটাইম সাপোর্ট');
    $supportTitleIcon = old('masterclass_settings.support_title_icon', $mcSettings['support_title_icon'] ?? 'fas fa-headset');
    $supportSubtitle = old('masterclass_settings.support_subtitle', $mcSettings['support_subtitle'] ?? 'কোর্স শেষ হলেও আপনার শেখার পথ শেষ হবে না।');
    $supportDescription = old('masterclass_settings.support_description', $mcSettings['support_description'] ?? 'আমাদের এক্সপার্ট সাপোর্ট ইন্সট্রাক্টর টিম প্রতিদিন আপনাকে লাইভ জুম সেশনের মাধ্যমে প্রতিটি কোডিং সমস্যা সমাধানে সাহায্য করবে।');
    $supportImageUrl = old('masterclass_settings.support_image_url_custom', $mcSettings['support_image_url'] ?? 'images/support/support_right_top.png');

    // Feature Cards (Dynamic List)
    $featureCards = old('masterclass_settings.support_features_list');
    if (!is_array($featureCards)) {
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
    }

    // Divider
    $dividerText = old('masterclass_settings.support_divider_text', $mcSettings['support_divider_text'] ?? 'সাপোর্ট নিতে যোগাযোগ করুন');

    // Support Channels (Dynamic List)
    $supportChannels = old('masterclass_settings.support_channels_list');
    if (!is_array($supportChannels)) {
        if (!empty($mcSettings['support_channels_list']) && is_array($mcSettings['support_channels_list'])) {
            $supportChannels = array_values($mcSettings['support_channels_list']);
        } else {
            $supportChannels = [
                [
                    'title' => $mcSettings['support_channel_1_title'] ?? 'ফেসবুক সাপোর্ট',
                    'desc' => $mcSettings['support_channel_1_desc'] ?? 'আমাদের ফেসবুক পেজে মেসেজ করুন',
                    'icon' => $mcSettings['support_channel_1_icon'] ?? 'fab fa-facebook-f',
                    'team_avatar' => $mcSettings['support_channel_1_team_avatar'] ?? 'images/support/support_avatars.png',
                    'team_label' => $mcSettings['support_channel_1_team_label'] ?? 'সক্রিয় সাপোর্ট টিম',
                    'btn_text' => $mcSettings['support_channel_1_btn_text'] ?? 'মেসেজ করুন',
                    'url' => $mcSettings['support_channel_1_url'] ?? ($mcSettings['support_facebook_url'] ?? setting('facebook_link') ?? 'https://facebook.com/yourpage'),
                    'is_highlighted' => 0,
                ],
                [
                    'title' => $mcSettings['support_channel_2_title'] ?? 'হোয়াটসঅ্যাপ সাপোর্ট',
                    'desc' => $mcSettings['support_channel_2_desc'] ?? 'দ্রুত উত্তর পেতে আমাদের হোয়াটসঅ্যাপে নক দিন',
                    'icon' => $mcSettings['support_channel_2_icon'] ?? 'fab fa-whatsapp',
                    'team_avatar' => $mcSettings['support_channel_2_team_avatar'] ?? 'images/support/support_avatars.png',
                    'team_label' => $mcSettings['support_channel_2_team_label'] ?? 'দ্রুত রেসপন্স',
                    'btn_text' => $mcSettings['support_channel_2_btn_text'] ?? 'হোয়াটসঅ্যাপে নক দিন',
                    'url' => $mcSettings['support_channel_2_url'] ?? ($mcSettings['support_whatsapp_url'] ?? setting('whatsapp_link') ?? 'https://wa.me/1234567890'),
                    'is_highlighted' => 1,
                ],
                [
                    'title' => $mcSettings['support_channel_3_title'] ?? 'টেলিগ্রাম সাপোর্ট',
                    'desc' => $mcSettings['support_channel_3_desc'] ?? 'সাপোর্ট কমিউনিটিতে যুক্ত হয়ে সবার সাথে থাকুন',
                    'icon' => $mcSettings['support_channel_3_icon'] ?? 'fab fa-telegram-plane',
                    'team_avatar' => $mcSettings['support_channel_3_team_avatar'] ?? 'images/support/support_avatars.png',
                    'team_label' => $mcSettings['support_channel_3_team_label'] ?? 'অ্যাক্টিভ কমিউনিটি',
                    'btn_text' => $mcSettings['support_channel_3_btn_text'] ?? 'টেলিগ্রামে যোগ দিন',
                    'url' => $mcSettings['support_channel_3_url'] ?? ($mcSettings['support_telegram_url'] ?? setting('telegram_link') ?? 'https://t.me/yourusername'),
                    'is_highlighted' => 0,
                ],
            ];
        }
    }

    // Bottom strip banner
    $stripIcon = old('masterclass_settings.support_strip_icon', $mcSettings['support_strip_icon'] ?? 'fas fa-heart');
    $stripText1 = old('masterclass_settings.support_strip_text_1', $mcSettings['support_strip_text_1'] ?? 'আপনি একা নন, আমরা আছি আপনার সাথে সবসময়।');
    $stripText2 = old('masterclass_settings.support_strip_text_2', $mcSettings['support_strip_text_2'] ?? 'আপনার সফলতাই আমাদের লক্ষ্য।');
@endphp

<!-- Section: Support Section -->
<div class="card border mb-4 rounded-3 shadow-sm">
    <div class="card-header bg-white py-3">
        <span class="form-label font-16 fw-normal text-dark m-0">Support Section</span>
    </div>
    <div class="card-body p-4">
        <div class="row gx-20">
            <!-- Show Support Section Checkbox (Left side, consistent with upper sections) -->
            <div class="col-12 mb-3">
                <div class="d-flex align-items-center gap-2">
                    <div class="setting-check">
                        <input type="checkbox" name="masterclass_settings[support_status]" value="1" id="support_status"
                            {{ $supportStatus ? 'checked' : '' }}>
                        <label for="support_status"></label>
                    </div>
                    <label class="form-label mb-0 fw-semibold cursor-pointer" for="support_status">Show Support Section</label>
                </div>
            </div>

            <!-- Support Title / Heading -->
            <div class="col-lg-6 col-md-6 mb-4">
                <label class="form-label">Support Title / Heading</label>
                <input type="text" name="masterclass_settings[support_title]" class="form-control rounded-2"
                       value="{{ $supportTitle }}" placeholder="লাইফটাইম সাপোর্ট">
                <small class="text-muted d-block mt-1"><i class="las la-info-circle me-1 text-primary"></i>শব্দ হাইলাইট করতে <code>&lt;mark&gt;শব্দ&lt;/mark&gt;</code> অথবা <code>{শব্দ}</code> ব্যবহার করুন (যেমন: <code>লাইফটাইম {সাপোর্ট}</code>)।</small>
            </div>

            <!-- Title Icon -->
            <div class="col-lg-6 col-md-6 mb-4">
                <label class="form-label">Title Icon Class / Image Link</label>
                <input type="text" name="masterclass_settings[support_title_icon]" class="form-control rounded-2 mb-2"
                       value="{{ $supportTitleIcon }}" placeholder="fas fa-headset or image path">
                <label class="form-label small text-muted mb-1">Or Upload Title Icon / Image File</label>
                <input type="file" name="support_title_icon_file" class="form-control form-control-sm rounded-2" accept="image/*">
                @if(!empty($supportTitleIcon))
                    <div class="d-flex align-items-center gap-2 mt-2 p-1 px-2 bg-light border rounded" style="width: fit-content;">
                        <span class="small text-muted">Preview:</span>
                        @if(preg_match('/\.(png|jpg|jpeg|svg|webp)$/i', $supportTitleIcon) || str_contains($supportTitleIcon, '/') || str_starts_with($supportTitleIcon, 'http'))
                            <img src="{{ dynamic_asset($supportTitleIcon) }}" alt="Title Icon" style="width: 24px; height: 24px; object-fit: contain;" onerror="this.style.display='none';">
                            <span class="small text-muted text-truncate" style="max-width: 140px;">{{ basename($supportTitleIcon) }}</span>
                        @else
                            <i class="{{ $supportTitleIcon }} font-16 text-primary"></i>
                            <span class="small text-muted text-truncate" style="max-width: 140px;">{{ $supportTitleIcon }}</span>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Subtitle -->
            <div class="col-lg-12 mb-4">
                <label class="form-label">Support Subtitle / Tagline</label>
                <input type="text" name="masterclass_settings[support_subtitle]" class="form-control rounded-2"
                       value="{{ $supportSubtitle }}" placeholder="কোর্স শেষ হলেও আপনার শেখার পথ শেষ হবে না।">
            </div>

            <!-- Description -->
            <div class="col-lg-12 mb-4">
                <label class="form-label">Support Description</label>
                <textarea name="masterclass_settings[support_description]" class="form-control rounded-2 summernote" rows="3"
                          placeholder="সাপোর্টের বিস্তারিত লিখুন...">{{ $supportDescription }}</textarea>
            </div>

            <!-- Support Image Upload & URL -->
            <div class="col-lg-6 mb-4">
                <label class="form-label mb-2">Upload Support Image File</label>
                <input type="file" name="support_image_file" class="form-control rounded-2" accept="image/*">
            </div>
            <div class="col-lg-6 mb-4">
                <label class="form-label mb-2">Or Support Image URL / Link</label>
                <input type="text" name="masterclass_settings[support_image_url_custom]" class="form-control rounded-2"
                       value="{{ $mcSettings['support_image_url'] ?? 'images/support/support_right_top.png' }}" placeholder="images/support/support_right_top.png">
            </div>
            @if(!empty($mcSettings['support_image_url']))
                <div class="col-12 mb-4">
                    <label class="small text-muted d-block mb-1">Current Support Image Preview:</label>
                    <img src="{{ dynamic_asset($mcSettings['support_image_url']) }}" alt="Support Image Preview" class="rounded border p-1" style="max-height: 100px; object-fit: contain; background: #f8fafc;" onerror="this.onerror=null; this.src='{{ static_asset('images/support/support_right_top.png') }}';">
                </div>
            @endif

            <!-- Dynamic Feature Cards -->
            <div class="col-12 mb-4">
                <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                    <div>
                        <label class="form-label font-15 mb-0 fw-semibold">Feature Cards</label>
                    </div>
                    <button type="button" class="d-inline-flex align-items-center btn sg-btn-primary gap-2" id="add_support_feature_card_btn">
                        <i class="las la-plus"></i>
                        <span>Add Feature Card</span>
                    </button>
                </div>
                <div class="row g-3" id="support_features_container">
                    @forelse($featureCards as $idx => $fCard)
                        <div class="col-md-4 support-feature-card-item" data-index="{{ $idx }}">
                            <div class="p-3 bg-light rounded-3 border h-100 position-relative">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <h6 class="fw-bold mb-0 text-primary font-14 card-num-label">Card {{ $idx + 1 }}</h6>
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-support-card-btn py-0 px-2 font-12" title="Delete Card">
                                        <i class="las la-trash-alt"></i>
                                    </button>
                                </div>
                                <label class="form-label font-12 text-muted mb-1">Title</label>
                                <input type="text" name="masterclass_settings[support_features_list][{{ $idx }}][title]"
                                       class="form-control rounded-2 bg-white mb-2 support-feature-title-input"
                                       value="{{ $fCard['title'] ?? '' }}" placeholder="ফিচার শিরোনাম">

                                <label class="form-label font-12 text-muted mb-1">Icon Class / Image Link</label>
                                <input type="text" name="masterclass_settings[support_features_list][{{ $idx }}][icon]"
                                       class="form-control rounded-2 bg-white mb-2 support-feature-icon-input"
                                       value="{{ $fCard['icon'] ?? '' }}" placeholder="fas fa-comment-dots or image link">

                                <label class="form-label font-12 text-muted mb-1">Or Upload Icon / Image File</label>
                                <input type="file" name="support_feature_icon_files[{{ $idx }}]"
                                       class="form-control font-12 bg-white mb-2 support-feature-file-input" accept="image/*">

                                @if(!empty($fCard['icon']))
                                    <div class="d-flex align-items-center gap-2 mb-2 p-1 px-2 bg-white border rounded">
                                        <span class="font-11 text-muted">Preview:</span>
                                        @if(preg_match('/\.(png|jpg|jpeg|svg|webp)$/i', $fCard['icon']) || str_contains($fCard['icon'], '/') || str_starts_with($fCard['icon'], 'http'))
                                            <img src="{{ dynamic_asset($fCard['icon']) }}" alt="Icon" style="width: 22px; height: 22px; object-fit: contain;" onerror="this.style.display='none';">
                                            <span class="font-11 text-muted text-truncate" style="max-width: 140px;">{{ basename($fCard['icon']) }}</span>
                                        @else
                                            <i class="{{ $fCard['icon'] }} font-16 text-primary"></i>
                                            <span class="font-11 text-muted text-truncate" style="max-width: 140px;">{{ $fCard['icon'] }}</span>
                                        @endif
                                    </div>
                                @endif

                                <label class="form-label font-12 text-muted mb-1">Description</label>
                                <textarea name="masterclass_settings[support_features_list][{{ $idx }}][desc]"
                                          class="form-control rounded-2 bg-white support-feature-desc-input" rows="2"
                                          placeholder="ফিচারের সংক্ষিপ্ত বিবরণ লিখুন...">{{ $fCard['desc'] ?? '' }}</textarea>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-3 text-muted no-cards-placeholder">
                            কোনো ফিচার কার্ড নেই। উপরে "Add Feature Card" বাটনে ক্লিক করে কার্ড যোগ করুন।
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Divider Text -->
            <div class="col-lg-12 mb-4">
                <label class="form-label">Section Divider Text</label>
                <input type="text" name="masterclass_settings[support_divider_text]" class="form-control rounded-2"
                       value="{{ $dividerText }}" placeholder="সাপোর্ট নিতে যোগাযোগ করুন">
            </div>

            <!-- Support Channels Section (Dynamic Repeater) -->
            <div class="col-12 mb-3">
                <div class="d-flex align-items-center justify-content-between border-bottom pb-2 mb-3">
                    <div>
                        <label class="form-label font-15 mb-0 fw-semibold">Support Channels</label>
                    </div>
                    <button type="button" class="d-inline-flex align-items-center btn sg-btn-primary gap-2" id="add_support_channel_btn">
                        <i class="las la-plus"></i>
                        <span>Add Support Channel</span>
                    </button>
                </div>
            </div>
            <div class="col-12 mb-4">
                <div class="row g-3" id="support_channels_container">
                    @forelse($supportChannels as $cIdx => $chCard)
                        <div class="col-md-4 support-channel-card-item" data-index="{{ $cIdx }}">
                            <div class="p-3 bg-light rounded-3 border h-100 position-relative">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <h6 class="fw-bold mb-0 text-primary font-14 channel-num-label">Channel {{ $cIdx + 1 }} {{ !empty($chCard['title']) ? '('.$chCard['title'].')' : '' }}</h6>
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-support-channel-btn py-0 px-2 font-12" title="Delete Channel">
                                        <i class="las la-trash-alt"></i>
                                    </button>
                                </div>

                                <div class="form-check form-switch mb-2">
                                    <input type="checkbox" class="form-check-input support-channel-highlight-input"
                                           name="masterclass_settings[support_channels_list][{{ $cIdx }}][is_highlighted]"
                                           value="1" id="ch_highlight_{{ $cIdx }}"
                                           {{ !empty($chCard['is_highlighted']) ? 'checked' : '' }}>
                                    <label class="form-check-label font-12 text-muted cursor-pointer" for="ch_highlight_{{ $cIdx }}">Highlight / Featured Channel</label>
                                </div>

                                <label class="form-label font-12 text-muted mb-1">Title</label>
                                <input type="text" name="masterclass_settings[support_channels_list][{{ $cIdx }}][title]"
                                       class="form-control rounded-2 bg-white mb-2 support-channel-title-input"
                                       value="{{ $chCard['title'] ?? '' }}" placeholder="চ্যানেলের নাম (যেমন: ফেসবুক সাপোর্ট)">

                                <label class="form-label font-12 text-muted mb-1">Subtitle / Description</label>
                                <input type="text" name="masterclass_settings[support_channels_list][{{ $cIdx }}][desc]"
                                       class="form-control rounded-2 bg-white mb-2 support-channel-desc-input"
                                       value="{{ $chCard['desc'] ?? '' }}" placeholder="আমাদের পেজে মেসেজ করুন">

                                <label class="form-label font-12 text-muted mb-1">Icon Class or Image Link</label>
                                <input type="text" name="masterclass_settings[support_channels_list][{{ $cIdx }}][icon]"
                                       class="form-control rounded-2 bg-white mb-2 support-channel-icon-input"
                                       value="{{ $chCard['icon'] ?? '' }}" placeholder="fab fa-facebook-f or image link">

                                <label class="form-label font-12 text-muted mb-1">Or Upload Icon / Image File</label>
                                <input type="file" name="support_channel_icon_files[{{ $cIdx }}]"
                                       class="form-control font-12 bg-white mb-2 support-channel-icon-file-input" accept="image/*">

                                @if(!empty($chCard['icon']))
                                    <div class="d-flex align-items-center gap-2 mb-2 p-1 px-2 bg-white border rounded">
                                        <span class="font-11 text-muted">Preview:</span>
                                        @if(preg_match('/\.(png|jpg|jpeg|svg|webp)$/i', $chCard['icon']) || str_contains($chCard['icon'], '/') || str_starts_with($chCard['icon'], 'http'))
                                            <img src="{{ dynamic_asset($chCard['icon']) }}" alt="Icon" style="width: 22px; height: 22px; object-fit: contain;" onerror="this.style.display='none';">
                                            <span class="font-11 text-muted text-truncate" style="max-width: 140px;">{{ basename($chCard['icon']) }}</span>
                                        @else
                                            <i class="{{ $chCard['icon'] }} font-16 text-primary"></i>
                                            <span class="font-11 text-muted text-truncate" style="max-width: 140px;">{{ $chCard['icon'] }}</span>
                                        @endif
                                    </div>
                                @endif

                                <label class="form-label font-12 text-muted mb-1">Team Avatars Image</label>
                                <input type="file" name="support_channel_avatar_files[{{ $cIdx }}]"
                                       class="form-control form-control-sm rounded-2 bg-white mb-1 support-channel-file-input" accept="image/*">
                                <input type="text" name="masterclass_settings[support_channels_list][{{ $cIdx }}][team_avatar]"
                                       class="form-control form-control-sm rounded-2 bg-white mb-2 support-channel-avatar-input"
                                       value="{{ $chCard['team_avatar'] ?? 'images/support/support_avatars.png' }}" placeholder="images/support/support_avatars.png">

                                <label class="form-label font-12 text-muted mb-1">Team Status Label</label>
                                <input type="text" name="masterclass_settings[support_channels_list][{{ $cIdx }}][team_label]"
                                       class="form-control rounded-2 bg-white mb-2 support-channel-label-input"
                                       value="{{ $chCard['team_label'] ?? '' }}" placeholder="সক্রিয় সাপোর্ট টিম">

                                <label class="form-label font-12 text-muted mb-1">Button Text</label>
                                <input type="text" name="masterclass_settings[support_channels_list][{{ $cIdx }}][btn_text]"
                                       class="form-control rounded-2 bg-white mb-2 support-channel-btn-text-input"
                                       value="{{ $chCard['btn_text'] ?? '' }}" placeholder="মেসেজ করুন">

                                <label class="form-label font-12 text-muted mb-1">Button URL / Link</label>
                                <input type="text" name="masterclass_settings[support_channels_list][{{ $cIdx }}][url]"
                                       class="form-control rounded-2 bg-white support-channel-url-input"
                                       value="{{ $chCard['url'] ?? '' }}" placeholder="https://example.com">
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-3 text-muted no-channels-placeholder">
                            কোনো সাপোর্ট চ্যানেল নেই। উপরে "Add Support Channel" বাটনে ক্লিক করে চ্যানেল যোগ করুন।
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Bottom Banner Strip -->
            <div class="col-12 mb-3">
                <label class="form-label font-15 mb-3 border-bottom pb-2 w-100">Bottom Banner Strip</label>
            </div>
            <div class="col-md-2 mb-4">
                <label class="form-label font-12 text-muted">Badge Icon</label>
                <input type="text" name="masterclass_settings[support_strip_icon]" class="form-control rounded-2"
                       value="{{ $stripIcon }}" placeholder="fas fa-heart">
            </div>
            <div class="col-md-5 mb-4">
                <label class="form-label font-12 text-muted">Left Text</label>
                <input type="text" name="masterclass_settings[support_strip_text_1]" class="form-control rounded-2"
                       value="{{ $stripText1 }}" placeholder="আপনি একা নন, আমরা আছি আপনার সাথে সবসময়।">
            </div>
            <div class="col-md-5 mb-4">
                <label class="form-label font-12 text-muted">Right Highlight Text</label>
                <input type="text" name="masterclass_settings[support_strip_text_2]" class="form-control rounded-2"
                       value="{{ $stripText2 }}" placeholder="আপনার সফলতাই আমাদের লক্ষ্য।">
            </div>

        </div>
    </div>
</div>

@push('js')
<script>
    (function($) {
        "use strict";
        $(document).ready(function() {
            function renumberSupportCards() {
                var $cards = $('#support_features_container .support-feature-card-item');
                if ($cards.length === 0) {
                    if ($('#support_features_container .no-cards-placeholder').length === 0) {
                        $('#support_features_container').append(
                            '<div class="col-12 text-center py-3 text-muted no-cards-placeholder">' +
                            'কোনো ফিচার কার্ড নেই। উপরে "Add Feature Card" বাটনে ক্লিক করে কার্ড যোগ করুন।' +
                            '</div>'
                        );
                    }
                } else {
                    $('#support_features_container .no-cards-placeholder').remove();
                }

                $cards.each(function(index) {
                    $(this).attr('data-index', index);
                    $(this).find('.card-num-label').text('Card ' + (index + 1));
                    $(this).find('.support-feature-title-input').attr('name', 'masterclass_settings[support_features_list][' + index + '][title]');
                    $(this).find('.support-feature-icon-input').attr('name', 'masterclass_settings[support_features_list][' + index + '][icon]');
                    $(this).find('.support-feature-file-input').attr('name', 'support_feature_icon_files[' + index + ']');
                    $(this).find('.support-feature-desc-input').attr('name', 'masterclass_settings[support_features_list][' + index + '][desc]');
                });
            }

            $(document).on('click', '#add_support_feature_card_btn', function(e) {
                e.preventDefault();
                $('#support_features_container .no-cards-placeholder').remove();
                var count = $('#support_features_container .support-feature-card-item').length;
                var nextIndex = count;
                var nextNum = count + 1;

                var html = `
                    <div class="col-md-4 support-feature-card-item" data-index="${nextIndex}">
                        <div class="p-3 bg-light rounded-3 border h-100 position-relative">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h6 class="fw-bold mb-0 text-primary font-14 card-num-label">Card ${nextNum}</h6>
                                <button type="button" class="btn btn-sm btn-outline-danger remove-support-card-btn py-0 px-2 font-12" title="Delete Card">
                                    <i class="las la-trash-alt"></i>
                                </button>
                            </div>
                            <label class="form-label font-12 text-muted mb-1">Title</label>
                            <input type="text" name="masterclass_settings[support_features_list][${nextIndex}][title]"
                                   class="form-control rounded-2 bg-white mb-2 support-feature-title-input" placeholder="ফিচার শিরোনাম">

                            <label class="form-label font-12 text-muted mb-1">Icon Class / Image Link</label>
                            <input type="text" name="masterclass_settings[support_features_list][${nextIndex}][icon]"
                                   class="form-control rounded-2 bg-white mb-2 support-feature-icon-input" placeholder="fas fa-check-circle or image link">

                            <label class="form-label font-12 text-muted mb-1">Or Upload Icon / Image File</label>
                            <input type="file" name="support_feature_icon_files[${nextIndex}]"
                                   class="form-control font-12 bg-white mb-2 support-feature-file-input" accept="image/*">

                            <label class="form-label font-12 text-muted mb-1">Description</label>
                            <textarea name="masterclass_settings[support_features_list][${nextIndex}][desc]"
                                      class="form-control rounded-2 bg-white support-feature-desc-input" rows="2"
                                      placeholder="ফিচারের সংক্ষিপ্ত বিবরণ লিখুন..."></textarea>
                        </div>
                    </div>
                `;

                $('#support_features_container').append(html);
                renumberSupportCards();
            });

            $(document).on('click', '.remove-support-card-btn', function(e) {
                e.preventDefault();
                $(this).closest('.support-feature-card-item').remove();
                renumberSupportCards();
            });

            // --- Support Channels Repeater ---
            function renumberSupportChannels() {
                var $channels = $('#support_channels_container .support-channel-card-item');
                if ($channels.length === 0) {
                    if ($('#support_channels_container .no-channels-placeholder').length === 0) {
                        $('#support_channels_container').append(
                            '<div class="col-12 text-center py-3 text-muted no-channels-placeholder">' +
                            'কোনো সাপোর্ট চ্যানেল নেই। উপরে "Add Support Channel" বাটনে ক্লিক করে চ্যানেল যোগ করুন।' +
                            '</div>'
                        );
                    }
                } else {
                    $('#support_channels_container .no-channels-placeholder').remove();
                }

                $channels.each(function(index) {
                    $(this).attr('data-index', index);
                    var title = $(this).find('.support-channel-title-input').val();
                    $(this).find('.channel-num-label').text('Channel ' + (index + 1) + (title ? ' (' + title + ')' : ''));
                    $(this).find('.support-channel-highlight-input').attr('name', 'masterclass_settings[support_channels_list][' + index + '][is_highlighted]').attr('id', 'ch_highlight_' + index);
                    $(this).find('label[for^="ch_highlight_"]').attr('for', 'ch_highlight_' + index);
                    $(this).find('.support-channel-title-input').attr('name', 'masterclass_settings[support_channels_list][' + index + '][title]');
                    $(this).find('.support-channel-desc-input').attr('name', 'masterclass_settings[support_channels_list][' + index + '][desc]');
                    $(this).find('.support-channel-icon-input').attr('name', 'masterclass_settings[support_channels_list][' + index + '][icon]');
                    $(this).find('.support-channel-icon-file-input').attr('name', 'support_channel_icon_files[' + index + ']');
                    $(this).find('.support-channel-file-input').attr('name', 'support_channel_avatar_files[' + index + ']');
                    $(this).find('.support-channel-avatar-input').attr('name', 'masterclass_settings[support_channels_list][' + index + '][team_avatar]');
                    $(this).find('.support-channel-label-input').attr('name', 'masterclass_settings[support_channels_list][' + index + '][team_label]');
                    $(this).find('.support-channel-btn-text-input').attr('name', 'masterclass_settings[support_channels_list][' + index + '][btn_text]');
                    $(this).find('.support-channel-url-input').attr('name', 'masterclass_settings[support_channels_list][' + index + '][url]');
                });
            }

            $(document).on('input', '.support-channel-title-input', function() {
                var index = $(this).closest('.support-channel-card-item').data('index');
                var val = $(this).val();
                $(this).closest('.support-channel-card-item').find('.channel-num-label').text('Channel ' + (index + 1) + (val ? ' (' + val + ')' : ''));
            });

            $(document).on('click', '#add_support_channel_btn', function(e) {
                e.preventDefault();
                $('#support_channels_container .no-channels-placeholder').remove();
                var count = $('#support_channels_container .support-channel-card-item').length;
                var nextIndex = count;
                var nextNum = count + 1;

                var html = `
                    <div class="col-md-4 support-channel-card-item" data-index="${nextIndex}">
                        <div class="p-3 bg-light rounded-3 border h-100 position-relative">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h6 class="fw-bold mb-0 text-primary font-14 channel-num-label">Channel ${nextNum}</h6>
                                <button type="button" class="btn btn-sm btn-outline-danger remove-support-channel-btn py-0 px-2 font-12" title="Delete Channel">
                                    <i class="las la-trash-alt"></i>
                                </button>
                            </div>

                            <div class="form-check form-switch mb-2">
                                <input type="checkbox" class="form-check-input support-channel-highlight-input"
                                       name="masterclass_settings[support_channels_list][${nextIndex}][is_highlighted]"
                                       value="1" id="ch_highlight_${nextIndex}">
                                <label class="form-check-label font-12 text-muted cursor-pointer" for="ch_highlight_${nextIndex}">Highlight / Featured Channel</label>
                            </div>

                            <label class="form-label font-12 text-muted mb-1">Title</label>
                            <input type="text" name="masterclass_settings[support_channels_list][${nextIndex}][title]"
                                   class="form-control rounded-2 bg-white mb-2 support-channel-title-input"
                                   placeholder="চ্যানেলের নাম (যেমন: ডিসকর্ড সাপোর্ট)">

                            <label class="form-label font-12 text-muted mb-1">Subtitle / Description</label>
                            <input type="text" name="masterclass_settings[support_channels_list][${nextIndex}][desc]"
                                   class="form-control rounded-2 bg-white mb-2 support-channel-desc-input"
                                   placeholder="সংক্ষিপ্ত বিবরণ লিখুন...">

                            <label class="form-label font-12 text-muted mb-1">Icon Class or Image Link</label>
                            <input type="text" name="masterclass_settings[support_channels_list][${nextIndex}][icon]"
                                   class="form-control rounded-2 bg-white mb-2 support-channel-icon-input"
                                   placeholder="fab fa-discord or image link">

                            <label class="form-label font-12 text-muted mb-1">Or Upload Icon / Image File</label>
                            <input type="file" name="support_channel_icon_files[${nextIndex}]"
                                   class="form-control font-12 bg-white mb-2 support-channel-icon-file-input" accept="image/*">

                            <label class="form-label font-12 text-muted mb-1">Team Avatars Image</label>
                            <input type="file" name="support_channel_avatar_files[${nextIndex}]"
                                   class="form-control form-control-sm rounded-2 bg-white mb-1 support-channel-file-input" accept="image/*">
                            <input type="text" name="masterclass_settings[support_channels_list][${nextIndex}][team_avatar]"
                                   class="form-control form-control-sm rounded-2 bg-white mb-2 support-channel-avatar-input"
                                   value="images/support/support_avatars.png" placeholder="images/support/support_avatars.png">

                            <label class="form-label font-12 text-muted mb-1">Team Status Label</label>
                            <input type="text" name="masterclass_settings[support_channels_list][${nextIndex}][team_label]"
                                   class="form-control rounded-2 bg-white mb-2 support-channel-label-input"
                                   value="সক্রিয় টিম" placeholder="সক্রিয় টিম">

                            <label class="form-label font-12 text-muted mb-1">Button Text</label>
                            <input type="text" name="masterclass_settings[support_channels_list][${nextIndex}][btn_text]"
                                   class="form-control rounded-2 bg-white mb-2 support-channel-btn-text-input"
                                   value="যোগ দিন" placeholder="যোগ দিন">

                            <label class="form-label font-12 text-muted mb-1">Button URL / Link</label>
                            <input type="text" name="masterclass_settings[support_channels_list][${nextIndex}][url]"
                                   class="form-control rounded-2 bg-white support-channel-url-input"
                                   placeholder="https://...">
                        </div>
                    </div>
                `;

                $('#support_channels_container').append(html);
                renumberSupportChannels();
            });

            $(document).on('click', '.remove-support-channel-btn', function(e) {
                e.preventDefault();
                $(this).closest('.support-channel-card-item').remove();
                renumberSupportChannels();
            });
        });
    })(jQuery);
</script>
@endpush

