@php
    $mcSettings = [];
    if(isset($course) && !empty($course->masterclass_settings)) {
        $mcSettings = is_string($course->masterclass_settings) ? json_decode($course->masterclass_settings, true) : $course->masterclass_settings;
    }

    $supportStatus = !empty($mcSettings['support_status']);
    if ($supportStatus) {
        $supportTitle = !empty($mcSettings['support_title']) ? $mcSettings['support_title'] : '';
        $supportDescription = !empty($mcSettings['support_description']) ? $mcSettings['support_description'] : '';
        $supportImageUrl = !empty($mcSettings['support_image_url']) ? $mcSettings['support_image_url'] : null;
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
