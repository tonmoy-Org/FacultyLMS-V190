<!--====== Start Success Video Section ======-->
<style>
    .video-banner-wrapper {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        border: 8px solid #f9fafb;
    }
    .video-banner-wrapper img {
        width: 100%;
        height: auto;
        min-height: 350px;
        object-fit: cover;
        display: block;
    }
    .play-btn-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80px;
        height: 80px;
        background-color: #12b884;
        color: white;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(18, 184, 132, 0.4);
    }
    .video-banner-wrapper:hover .play-btn-overlay {
        transform: translate(-50%, -50%) scale(1.1);
        background-color: #0fa173;
        color: white;
    }
    .play-btn-overlay i {
        margin-left: 5px;
    }
</style>

<section class="success-video-section p-t-80 p-b-80 bg-white">
    <div class="container container-1278">
        <div class="row align-items-center">
            
            <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-up">
                <span class="d-block fw-bold text-uppercase mb-3" style="color: #12b884; font-size: 14px; letter-spacing: 1.5px;">{{ setting('success_video_subtitle') }}</span>
                <h2 class="fw-bold mb-4" style="font-size: 40px; color: #110B3A; line-height: 1.3;">{{ setting('success_video_title') }}</h2>
                <p class="text-secondary mb-5" style="font-size: 16px; line-height: 1.8;">
                    {{ setting('success_video_description') }}
                </p>
                <a href="{{ isset($course) ? route('course.details', $course->slug) : '#' }}" class="template-btn">
                    {{ setting('success_video_button_text') }}
                </a>
            </div>

            @php
                $videoUrl = setting('success_video_url');
                if ($videoUrl && strpos($videoUrl, '<iframe') !== false && preg_match('/src="([^"]+)"/', $videoUrl, $matches)) {
                    $videoUrl = $matches[1];
                }
                
                $bannerMediaId = setting('success_video_image');
                $bannerImageUrl = '';
                if ($bannerMediaId) {
                    $media = \App\Models\MediaLibrary::find($bannerMediaId);
                    if ($media && $media->image_variants) {
                        $bannerImageUrl = getFileLink('original_image', $media->image_variants);
                    }
                }
            @endphp

            <div class="col-lg-7" data-aos="fade-left" data-aos-delay="100">
                <div class="video-banner-wrapper">
                    @if($bannerImageUrl)
                        <img src="{{ $bannerImageUrl }}" alt="Success Video Banner">
                    @else
                        <div class="bg-secondary d-flex justify-content-center align-items-center text-white" style="height: 350px;">
                            <h5>No Banner Image Uploaded</h5>
                        </div>
                    @endif
                    <a href="{{ $videoUrl ?: '#' }}" class="play-btn-overlay popup-video" target="_blank" title="Play Video">
                        <i class="fas fa-play"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
<!--====== End Success Video Section ======-->
