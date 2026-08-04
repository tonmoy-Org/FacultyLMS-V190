<!--====== Start Success Video Section ======-->
<style>
    .custom-success-video-section {
        background-color: #ffffff;
        padding: 80px 0;
    }
    .custom-success-video-section .subtitle {
        color: #ff6b00;
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 15px;
        display: block;
    }
    .custom-success-video-section h2 {
        font-size: 40px;
        font-weight: 700;
        color: #110B3A;
        margin-bottom: 20px;
        line-height: 1.3;
    }
    .custom-success-video-section p {
        color: #6b7280;
        font-size: 16px;
        line-height: 1.8;
        margin-bottom: 35px;
    }
    .custom-success-video-section .enroll-btn {
        background-color: #ff6b00;
        color: #ffffff;
        font-weight: 600;
        font-size: 16px;
        padding: 15px 35px;
        border-radius: 30px;
        display: inline-block;
        transition: all 0.3s ease;
        border: 2px solid #ff6b00;
    }
    .custom-success-video-section .enroll-btn:hover {
        background-color: transparent;
        color: #ff6b00;
    }

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
        background-color: #ff6b00;
        color: white;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 107, 0, 0.4);
    }
    .video-banner-wrapper:hover .play-btn-overlay {
        transform: translate(-50%, -50%) scale(1.1);
        background-color: #e65c00;
    }
    .play-btn-overlay i {
        margin-left: 5px;
    }
</style>

<section class="custom-success-video-section">
    <div class="container container-1278">
        <div class="row align-items-center">
            
            <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-up">
                <span class="subtitle">{{ setting('success_video_subtitle') }}</span>
                <h2>{{ setting('success_video_title') }}</h2>
                <p>
                    {{ setting('success_video_description') }}
                </p>
                <a href="{{ isset($course) ? route('course.details', $course->slug) : '#' }}" class="enroll-btn">
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
