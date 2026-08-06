@if(setting('webinar_status') !== '0')
@php
    $lang = app()->getLocale();
    $subtitle = setting('webinar_subtitle', $lang) ?: 'LIVE WEBINAR';
    $title = setting('webinar_title', $lang) ?: 'Join My Upcoming Webinars';
    $desc1 = setting('webinar_description_1', $lang) ?: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non.';
    $desc2 = setting('webinar_description_2', $lang) ?: 'Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.';
    $btnText = setting('webinar_btn_text', $lang) ?: 'REGISTER NOW';
    $btnLink = setting('webinar_btn_link', $lang) ?: route('student.sign_up');
    $webinarMediaId = setting('webinar_image');
    $webinarImageUrl = '';
    if ($webinarMediaId) {
        $media = \App\Models\MediaLibrary::find($webinarMediaId);
        if ($media && $media->image_variants) {
            $webinarImageUrl = getFileLink('original_image', $media->image_variants);
        } elseif (is_array($webinarMediaId)) {
            $webinarImageUrl = getFileLink('original_image', $webinarMediaId);
        } elseif (is_string($webinarMediaId) && (str_contains($webinarMediaId, '/') || str_contains($webinarMediaId, '.'))) {
            $webinarImageUrl = getFileLink('original_image', $webinarMediaId);
        }
    }
@endphp
<section class="webinar-section p-t-80 p-b-80 bg-white">
    <div class="container" style="max-width: 1240px;">
        <div class="row align-items-center g-5">
            <!-- Left Side: Live Webinar Video Frame -->
            <div class="col-lg-6">
                <div class="webinar-frame-wrapper position-relative overflow-hidden shadow-sm" style="border-radius: 6px; background: #262626;">
                    @if($webinarImageUrl)
                        <div class="webinar-custom-image overflow-hidden" style="max-height: 420px;">
                            <img src="{{ $webinarImageUrl }}" alt="{{ $title }}" class="img-fluid w-100" style="object-fit: cover; width: 100%; display: block; border-radius: 6px;">
                        </div>
                    @else
                        <!-- Default Webinar Grid Preview -->
                        <div class="webinar-grid-preview" style="background: #1e1e1e; padding: 8px; display: grid; grid-template-columns: repeat(4, 1fr); gap: 6px;">
                            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=400&auto=format&fit=crop" style="width: 100%; height: 130px; object-fit: cover; border-radius: 4px;" alt="Participant 1">
                            <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=400&auto=format&fit=crop" style="width: 100%; height: 130px; object-fit: cover; border-radius: 4px;" alt="Participant 2">
                            <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=400&auto=format&fit=crop" style="width: 100%; height: 130px; object-fit: cover; border-radius: 4px;" alt="Participant 3">
                            <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?q=80&w=400&auto=format&fit=crop" style="width: 100%; height: 130px; object-fit: cover; border-radius: 4px;" alt="Participant 4">
                            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=400&auto=format&fit=crop" style="width: 100%; height: 130px; object-fit: cover; border-radius: 4px;" alt="Participant 5">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=400&auto=format&fit=crop" style="width: 100%; height: 130px; object-fit: cover; border-radius: 4px;" alt="Participant 6">
                            <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?q=80&w=400&auto=format&fit=crop" style="width: 100%; height: 130px; object-fit: cover; border-radius: 4px;" alt="Participant 7">
                            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=400&auto=format&fit=crop" style="width: 100%; height: 130px; object-fit: cover; border-radius: 4px;" alt="Participant 8">
                        </div>
                        <!-- Controls bar only for default preview -->
                        <div class="webinar-controls-bar d-flex justify-content-center align-items-center gap-4 py-3" style="background: #242526; border-top: 1px solid #333333;">
                            <span class="control-btn fs-5" style="color: #00bcd4; cursor: pointer;"><i class="fas fa-microphone"></i></span>
                            <span class="control-btn fs-5" style="color: #00bcd4; cursor: pointer;"><i class="fas fa-volume-up"></i></span>
                            <span class="control-btn fs-5" style="color: #00bcd4; cursor: pointer;"><i class="fas fa-video"></i></span>
                            <span class="control-btn bg-danger text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; cursor: pointer;"><i class="fas fa-phone-slash" style="font-size: 13px; transform: rotate(135deg);"></i></span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Side: Content & Action Button -->
            <div class="col-lg-6">
                <div class="webinar-content ps-lg-4">
                    <span class="webinar-subtitle text-uppercase fw-bold mb-3 d-inline-block" style="color: #10b981; font-size: 14px; letter-spacing: 1.5px;">{{ $subtitle }}</span>
                    <h2 class="webinar-main-title fw-bold mb-4" style="color: #1a1b4b; font-size: 38px; line-height: 1.25;">{{ $title }}</h2>
                    @if($desc1)
                        <p class="webinar-desc mb-3" style="color: #64748b; font-size: 16px; line-height: 1.7;">{{ $desc1 }}</p>
                    @endif
                    @if($desc2)
                        <p class="webinar-desc mb-4" style="color: #64748b; font-size: 16px; line-height: 1.7;">{{ $desc2 }}</p>
                    @endif
                    <div class="mt-4">
                        <a href="{{ $btnLink }}" class="template-btn text-uppercase fw-bold" style="border-radius: 6px;">
                            {{ $btnText }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
