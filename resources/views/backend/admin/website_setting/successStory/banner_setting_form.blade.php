<div class="bg-white redious-border p-20 p-sm-30 mb-4">
    <h3 class="section-title mb-4" style="color: #000000; font-weight: 500; font-size: 15px;">{{ __('Success Page Banner Setting') }}</h3>
    <form action="{{ route('website.success_banner.save') }}" method="POST" class="form-validate form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="is_modal" value="0">
        <div class="row gx-20">
            <!-- Banner Tag -->
            <div class="col-lg-12">
                <div class="mb-4">
                    <label for="success_page_banner_tag" class="form-label">{{ __('Banner Tag') }}</label>
                    <input type="text" class="form-control rounded-2" id="success_page_banner_tag" name="success_page_banner_tag" placeholder="{{ __('Banner Tag') }}" value="{{ setting('success_page_banner_tag') ?: 'Success Stories' }}">
                </div>
            </div>

            <!-- Banner Title -->
            <div class="col-lg-12">
                <div class="mb-4">
                    <label for="success_page_banner_title" class="form-label">{{ __('title') }}</label>
                    <input type="text" class="form-control rounded-2" id="success_page_banner_title" name="success_page_banner_title" placeholder="{{ __('enter_title') }}" value="{{ setting('success_page_banner_title') ?: 'Real People. Real Learning. Real Success.' }}">
                </div>
            </div>

            <!-- Banner Description -->
            <div class="col-lg-12">
                <div class="mb-4">
                    <label for="success_page_banner_description" class="form-label">{{ __('description') }}</label>
                    <textarea class="form-control" id="success_page_banner_description" name="success_page_banner_description" rows="3" placeholder="{{ __('description') }}">{{ setting('success_page_banner_description') ?: 'Discover how learners are achieving their goals and building better futures with Faculty.' }}</textarea>
                </div>
            </div>

            <!-- Banner Image Upload -->
            <div class="col-lg-12 input_file_div mb-4">
                <div class="mb-3">
                    <label for="success_page_banner_image" class="form-label mb-1">{{ __('image') }} (1200x500)</label>
                    <label for="success_page_banner_image" class="file-upload-text">
                        <p></p>
                        <span class="file-btn">{{ __('choose_file') }}</span>
                    </label>
                    <input class="d-none file_picker" type="file" name="success_page_banner_image" id="success_page_banner_image" accept="image/*">
                </div>
                <div class="selected-files d-flex flex-wrap gap-20">
                    <div class="selected-files-item">
                        @php
                            $bannerImgSetting = setting('success_page_banner_image');
                            $previewUrl = '';
                            if (is_array($bannerImgSetting)) {
                                if (!empty($bannerImgSetting['image_80x80'])) {
                                    $previewUrl = get_media($bannerImgSetting['image_80x80'], $bannerImgSetting['storage'] ?? 'local');
                                } elseif (!empty($bannerImgSetting['original_image'])) {
                                    $previewUrl = get_media($bannerImgSetting['original_image'], $bannerImgSetting['storage'] ?? 'local');
                                }
                            } elseif (is_string($bannerImgSetting) && !empty($bannerImgSetting)) {
                                $previewUrl = getFileLink('80x80', $bannerImgSetting);
                            }
                            if (empty($previewUrl) || str_contains($previewUrl, 'default-image')) {
                                $previewUrl = static_asset('frontend/img/banner/success_hero_banner.jpg');
                            }
                        @endphp
                        <img class="selected-img" src="{{ $previewUrl }}" alt="Banner Image">
                    </div>
                </div>
            </div>

            <!-- Banner Section Status -->
            <div class="col-lg-12">
                <div class="d-flex gap-12 sandbox_mode_div mb-4">
                    <label class="form-label" for="success_page_banner_status">{{ __('status') }}</label>
                    <div class="setting-check">
                        <input type="hidden" name="success_page_banner_status" value="{{ setting('success_page_banner_status') == 0 ? 0 : 1 }}">
                        <input type="checkbox" value="1" id="success_page_banner_status"
                               class="sandbox_mode" {{ setting('success_page_banner_status') == 0 ? '' : 'checked' }}>
                        <label for="success_page_banner_status"></label>
                    </div>
                </div>
            </div>

            <!-- Form Header Title & Subtitle Settings -->
            <div class="col-12 my-3">
                <hr style="border-top: 1px dashed #e2e8f0;">
                <h4 class="section-title my-3" style="color: #000000; font-weight: 400; font-size: 15px;">{{ __('Form Header Settings') }}</h4>
            </div>

            <div class="col-lg-12">
                <div class="mb-4">
                    <label for="success_form_header_title" class="form-label">{{ __('Form Header Title') }}</label>
                    <input type="text" class="form-control rounded-2" id="success_form_header_title" name="success_form_header_title" placeholder="{{ __('Form Header Title') }}" value="{{ setting('success_form_header_title') ?: 'Your Experience Matters' }}">
                </div>
            </div>

            <div class="col-lg-12">
                <div class="mb-4">
                    <label for="success_form_header_subtitle" class="form-label">{{ __('Form Header Subtitle') }}</label>
                    <input type="text" class="form-control rounded-2" id="success_form_header_subtitle" name="success_form_header_subtitle" placeholder="{{ __('Form Header Subtitle') }}" value="{{ setting('success_form_header_subtitle') ?: 'Share your success story with us.' }}">
                </div>
            </div>

            <!-- Form Right Side Image Settings Divider -->
            <div class="col-12 my-3">
                <hr style="border-top: 1px dashed #e2e8f0;">
                <h4 class="section-title my-3" style="color: #000000; font-weight: 400; font-size: 15px;">{{ __('Form Right Side Image Settings') }}</h4>
            </div>

            <!-- Form Right Image Upload -->
            <div class="col-lg-12 input_file_div mb-4">
                <div class="mb-3">
                    <label for="success_form_right_image" class="form-label mb-1">{{ __('Right Side Image') }} (600x750)</label>
                    <label for="success_form_right_image" class="file-upload-text">
                        <p></p>
                        <span class="file-btn">{{ __('choose_file') }}</span>
                    </label>
                    <input class="d-none file_picker" type="file" name="success_form_right_image" id="success_form_right_image" accept="image/*">
                </div>
                <div class="selected-files d-flex flex-wrap gap-20">
                    <div class="selected-files-item">
                        @php
                            $formRightImgSetting = setting('success_form_right_image');
                            $rightPreviewUrl = '';
                            if (is_array($formRightImgSetting)) {
                                if (!empty($formRightImgSetting['image_80x80'])) {
                                    $rightPreviewUrl = get_media($formRightImgSetting['image_80x80'], $formRightImgSetting['storage'] ?? 'local');
                                } elseif (!empty($formRightImgSetting['original_image'])) {
                                    $rightPreviewUrl = get_media($formRightImgSetting['original_image'], $formRightImgSetting['storage'] ?? 'local');
                                }
                            } elseif (is_string($formRightImgSetting) && !empty($formRightImgSetting)) {
                                $rightPreviewUrl = getFileLink('80x80', $formRightImgSetting);
                            }
                        @endphp
                        @if(!empty($rightPreviewUrl))
                            <img class="selected-img" src="{{ $rightPreviewUrl }}" alt="Right Side Image">
                        @else
                            <div class="p-3 bg-light text-muted border rounded text-center" style="font-size: 12px;">{{ __('No custom image uploaded yet (using default illustration)') }}</div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="col-lg-12 d-flex justify-content-end align-items-center mt-30">
                <button type="submit" class="btn sg-btn-primary">{{ __('update') }}</button>
                @include('backend.common.loading-btn', ['class' => 'btn sg-btn-primary'])
            </div>
        </div>
    </form>
</div>
