@extends('frontend.layouts.master')
@section('title', __('Success'))
@section('content')
@if((string)setting('success_page_banner_status') !== '0')
@php
    $bannerImgSetting = setting('success_page_banner_image');
    $bannerImgUrl = '';
    if (is_array($bannerImgSetting)) {
        if (!empty($bannerImgSetting['original_image'])) {
            $bannerImgUrl = get_media($bannerImgSetting['original_image'], $bannerImgSetting['storage'] ?? 'local');
        } elseif (!empty($bannerImgSetting['image_417x384'])) {
            $bannerImgUrl = get_media($bannerImgSetting['image_417x384'], $bannerImgSetting['storage'] ?? 'local');
        }
    } elseif (is_string($bannerImgSetting) && !empty($bannerImgSetting)) {
        $bannerImgUrl = getFileLink('original_image', $bannerImgSetting);
    }
    if (empty($bannerImgUrl) || str_contains($bannerImgUrl, 'default-image')) {
        $bannerImgUrl = static_asset('frontend/img/banner/success_hero_banner.jpg');
    }
@endphp
<style>
    .success-hero-banner {
        background-color: #1e5341;
        background-image: url('{{ $bannerImgUrl }}');
        background-repeat: no-repeat;
        background-position: center right;
        background-size: cover;
        position: relative;
        overflow: hidden;
        color: #ffffff;
        min-height: 280px;
        display: flex;
        align-items: center;
        padding: 35px 0 40px;
    }
    .success-hero-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 65%;
        background: linear-gradient(90deg, #1e5341 0%, #23614e 35%, #296d58 68%, rgba(41, 109, 88, 0.65) 85%, rgba(41, 109, 88, 0) 100%);
        z-index: 1;
    }
    .success-hero-banner .badge-pill-tag {
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
        color: #ffffff;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.2px;
        padding: 5px 12px;
        border-radius: 4px;
        display: inline-block;
        text-transform: uppercase;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .success-hero-banner .banner-main-title {
        color: #ffffff;
        font-size: 36px;
        font-weight: 800;
        line-height: 1.2;
        letter-spacing: -0.5px;
        margin-top: 12px;
        margin-bottom: 12px;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }
    .success-hero-banner .banner-sub-text {
        color: rgba(255, 255, 255, 0.9);
        font-size: 15px;
        line-height: 1.6;
        max-width: 480px;
        margin-bottom: 0;
        text-shadow: 0 1px 5px rgba(0, 0, 0, 0.2);
    }
    .success-hero-banner .decor-icon-circle {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        border: 1.5px solid rgba(16, 185, 129, 0.5);
        background: rgba(7, 53, 39, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        top: 72%;
        transform: translateY(-50%);
        z-index: 3;
    }
    .success-hero-banner .decor-icon-left {
        left: 25px;
    }
    .success-hero-banner .decor-icon-right {
        right: 25px;
    }
    .success-hero-banner .center-logo-badge {
        position: absolute;
        left: 48%;
        top: 72%;
        transform: translate(-50%, -50%);
        z-index: 4;
        width: 42px;
        height: 42px;
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        border-radius: 50%;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0.85;
    }
    .success-hero-banner .center-logo-badge-inner {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        border: 1.5px solid rgba(16, 185, 129, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.85);
    }
    @media (max-width: 991px) {
        .success-hero-banner::before {
            width: 100%;
            background: linear-gradient(180deg, rgba(7, 53, 39, 0.95) 0%, rgba(42, 104, 81, 0.9) 100%);
        }
        .success-hero-banner .banner-main-title {
            font-size: 30px;
        }
        .success-hero-banner .center-logo-badge {
            display: none !important;
        }
    }
    @media (max-width: 576px) {
        .success-hero-banner {
            padding: 35px 0 45px;
            min-height: auto;
        }
        .success-hero-banner .banner-main-title {
            font-size: 24px;
        }
    }

    /* Testimonial Form Card Styles */
    .testimonial-form-card {
        background: #ffffff;
        border: none !important;
        border-radius: 16px;
        padding-left: 0 !important;
        padding-right: 0 !important;
        box-shadow: none !important;
        margin-top: 20px;
        margin-bottom: 40px;
        width: 100%;
    }
    .testimonial-form-card .card-header-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 18px;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 10px;
    }
    .testimonial-form-card .card-header-title {
        font-size: 28px !important;
        font-weight: 700;
        color: #111827;
        font-family: var(--header-font);
        margin: 0;
        padding-left: 12px;
        border-left: 3.5px solid #10b981;
        line-height: 1.2;
    }
    .testimonial-form-card .card-header-subtitle {
        font-size: 14px;
        color: #64748b;
        margin: 0;
    }
    .testimonial-form-card .profile-upload-row {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 28px;
    }
    .testimonial-form-card .avatar-circle {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: #e6f4ea;
        color: #10b981;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
        overflow: hidden;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }
    .testimonial-form-card .profile-photo-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border: 1.5px solid #10b981;
        color: #10b981;
        background: transparent;
        font-weight: 700;
        font-size: 12px;
        padding: 7px 16px;
        border-radius: 6px;
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.2s;
    }
    .testimonial-form-card .profile-photo-btn:hover {
        background: #10b981;
        color: #ffffff;
    }
    .testimonial-form-card .upload-section-title {
        font-weight: 700;
        font-size: 14px;
        color: #1e293b;
    }
    .testimonial-form-card .upload-drop-zone {
        border: 1.5px dashed #a7f3d0;
        background: #f0fdf4;
        border-radius: 10px;
        padding: 28px 20px;
        text-align: center;
        position: relative;
        cursor: pointer;
        transition: all 0.2s;
    }
    .testimonial-form-card .upload-drop-zone:hover {
        border-color: #10b981;
        background: #e6f4ea;
    }
    .testimonial-form-card .upload-drop-zone input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }
    .testimonial-form-card .upload-drop-title {
        color: #10b981;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-top: 6px;
    }
    .testimonial-form-card .upload-drop-subtext {
        color: #64748b;
        font-size: 13px;
        margin-top: 2px;
    }

    .testimonial-form-card .rating-stars-wrap i {
        color: #f59e0b;
        font-size: 22px;
        cursor: pointer;
        margin-right: 4px;
        transition: color 0.15s;
    }
    @media (max-width: 576px) {
        .testimonial-form-card {
            padding: 20px 16px;
        }
    }
</style>

<section class="success-hero-banner">
    <!-- Decorative Left Trophy Icon -->
    <div class="decor-icon-circle decor-icon-left d-none d-xl-flex">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path>
            <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path>
            <path d="M4 22h16"></path>
            <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path>
            <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path>
            <path d="M18 2H6v7a6 6 0 0 0 12 0V2z"></path>
        </svg>
    </div>

    <!-- Decorative Right Growth Chart Icon -->
    <div class="decor-icon-circle decor-icon-right d-none d-xl-flex">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
            <polyline points="17 6 23 6 23 12"></polyline>
        </svg>
    </div>

    <!-- Central White Graduation Cap Badge -->
    <div class="center-logo-badge d-none d-lg-flex">
        <div class="center-logo-badge-inner">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
            </svg>
        </div>
    </div>

    <div class="container container-1278 position-relative" style="z-index: 2;">
        <div class="row align-items-center">
            <!-- Left Text Column -->
            <div class="col-lg-6 col-md-7 ps-md-4">
                <div class="banner-text-content">
                    <span class="badge-pill-tag">
                        {{ setting('success_page_banner_tag') ?: __('SUCCESS STORIES') }}
                    </span>
                    <h1 class="banner-main-title">
                        {!! nl2br(e(setting('success_page_banner_title') ?: __('Real People. Real Learning. Real Success.'))) !!}
                    </h1>
                    <p class="banner-sub-text">
                        {{ setting('success_page_banner_description') ?: __('Discover how learners are achieving their goals and building better futures with Faculty.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<section class="support-section p-t-35 p-t-sm-30 p-b-md-50 p-b-80">
    <div class="container container-1278">

        @if(isset($successStories) && $successStories->count() > 0)
        <div class="row">

            <!-- Header -->
            <div class="col-12 header">
                <div class="course-shorter justify-content-between course-shorter-v2 color-secondary m-b-40 m-b-sm-30">
                    <ul class="grid-list">
                        <li class="d-none d-md-inline-block style_type {{ $style == 'grid' ? 'active' : '' }}"><a href="{{ request()->fullUrlWithQuery(['style' => 'grid']) }}"><i class="fas fa-th"></i></a></li>
                        <li class="d-none d-md-inline-block style_type {{ $style == 'list' ? 'active' : '' }}"><a href="{{ request()->fullUrlWithQuery(['style' => 'list']) }}"><i class="fas fa-th-list"></i></a></li>
                        <li class="sort-text d-none d-md-inline-block">{{__('showing') }} {{ $total_results }} {{__('of')  }} {{ $total_success_stories }} {{__('results') }}</li>
                    </ul>
                    <div class="sort-right">
                        <div class="course-dropdown d-none d-sm-block">
                            <select class="course-sort" name="sorting" onchange="document.getElementById('success-filter-form').submit()" form="success-filter-form">
                                <option value="latest" {{ $sorting == 'latest' ? 'selected':'' }}>{{__('latest') }}</option>
                                <option value="top_rated" {{ $sorting == 'top_rated' ? 'selected':'' }} >{{__('top_rated') }}</option>
                                <option value="oldest" {{ $sorting == 'oldest' ? 'selected':'' }} >{{__('oldest') }}</option>
                            </select>
                        </div>
                        <form method="get" action="{{ url()->current() }}" id="success-filter-form" class="search-form">
                            <input type="hidden" name="style" value="{{ $style }}">
                            <input type="text" placeholder="{{__('search') }}" name="q" value="{{ $q ?? '' }}" class="keyword">
                            <button type="submit" class="search-btn"><i class="bx bx-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Header -->
        </div>

        <div class="row {{ $style == 'list' ? 'course-items-v3 list-view m-b-50' : 'course-items-v3 grid-view course-list m-b-50' }}">
            @foreach($successStories as $story)
                @if($style == 'list')
                    <div class="col-md-12 col-sm-6 m-b-30" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="course-item" style="display: flex; flex-direction: column; background-color: #fff; border-radius: 6px; overflow: hidden;">
                            <a href="{{ route('success.details', $story->slug) }}" class="course-item-thumb" style="display: block; margin-bottom: 0; line-height: 0; height: 248px; overflow: hidden;">
                                @if($story->video)
                                    <video src="{{ asset($story->video) }}" controls style="width: 100%; height: 248px; object-fit: cover; border-top-left-radius: 6px; border-bottom-left-radius: 6px;"></video>
                                @else
                                    <img src="{{ getFileLink('473x337', $story->image) }}" alt="{{ $story->title }}" style="width: 100%; height: 248px; object-fit: cover; border-top-left-radius: 6px; border-bottom-left-radius: 6px;">
                                @endif
                            </a>
                            <div class="course-item-body" style="padding: 15px 20px; flex-grow: 1; display: flex; flex-direction: column; justify-content: flex-start;">
                                <div class="course-item-info mb-3" style="display: block; font-size: 14px; line-height: 1.6; color: #333;">
                                    "{{ Str::limit($story->description, 200) }}"
                                </div>
                                <div class="d-flex align-items-center mt-2">
                                    <div class="author-img m-r-10" style="flex-shrink: 0;">
                                        <img src="{{ getFileLink('40x40', $story->image) }}" alt="{{ $story->title }}" class="rounded-circle" style="width: 55px; height: 55px; object-fit: cover; border: 2px solid #e0e0e0; padding: 2px;">
                                    </div>
                                    <div class="author-details" style="min-width: 0; flex: 1;">
                                        <h5 class="m-b-0" style="font-size: 15px; font-weight: 600; line-height: 1.2; color: var(--theme-clr);">
                                            <a href="{{ route('success.details', $story->slug) }}" style="color: inherit; text-decoration: none;">{{ $story->title }}</a>
                                        </h5>
                                        <div class="color-gray" style="font-size: 14px; margin-bottom: 3px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $story->position ?? __('Student') }}</div>
                                        @if($story->rating)
                                            <div class="rating-review">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fa{{ $i <= $story->rating ? 's' : 'l' }} fa-star" style="color: #ff9800; font-size: 15px;"></i>
                                                @endfor
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-lg-3 col-md-4 col-sm-6 m-b-30" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="course-item" style="height: 100%; display: flex; flex-direction: column; background-color: #fff; border-radius: 6px; overflow: hidden;">
                            <a href="{{ route('success.details', $story->slug) }}" class="course-item-thumb" style="display: block; margin-bottom: 0; line-height: 0; height: 200px; overflow: hidden;">
                                @if($story->video)
                                    <video src="{{ asset($story->video) }}" controls style="width: 100%; height: 200px; object-fit: cover; border-top-left-radius: 6px; border-top-right-radius: 6px;"></video>
                                @else
                                    <img src="{{ getFileLink('473x337', $story->image) }}" alt="{{ $story->title }}" style="width: 100%; height: 200px; object-fit: cover;">
                                @endif
                            </a>
                            <div class="course-item-body p-0 m-0" style="flex-grow: 1; background-color: #fff; display: flex; flex-direction: column; justify-content: flex-start;">
                                <div class="course-item-body-inner" style="padding: 15px; margin-bottom: auto;">
                                    <div class="course-item-info mb-2" style="display: block; font-size: 13px; line-height: 1.5;">
                                        "{{ Str::limit($story->description, 130) }}"
                                    </div>
                                    <div class="d-flex align-items-center mt-2">
                                        <div class="author-img m-r-10" style="flex-shrink: 0;">
                                            <img src="{{ getFileLink('40x40', $story->image) }}" alt="{{ $story->title }}" class="rounded-circle" style="width: 45px; height: 45px; object-fit: cover; border: 2px solid #e0e0e0; padding: 2px;">
                                        </div>
                                        <div class="author-details" style="min-width: 0; flex: 1;">
                                            <h5 class="m-b-0" style="font-size: 14px; font-weight: 600; line-height: 1.2; color: var(--theme-clr);">
                                                <a href="{{ route('success.details', $story->slug) }}" style="color: inherit; text-decoration: none;">{{ $story->title }}</a>
                                            </h5>
                                            <div class="color-gray mt-1" style="font-size: 12px; margin-bottom: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $story->position ?? __('Student') }}</div>
                                            @if($story->rating)
                                                <div class="rating-review">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fa{{ $i <= $story->rating ? 's' : 'l' }} fa-star" style="color: #ff9800; font-size: 13px;"></i>
                                                    @endfor
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="testimonial-form-card px-0 py-3">
                    <!-- Header Bar -->
                    <div class="card-header-bar mb-4">
                        <h3 class="card-header-title">{{ setting('success_form_header_title') ?: __('Your Experience Matters') }}</h3>
                        <p class="card-header-subtitle">{{ setting('success_form_header_subtitle') ?: __('Share your success story with us.') }}</p>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success mb-4 rounded-3">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('store.testimonial') }}" method="POST" enctype="multipart/form-data" class="user-form p-0">
                        @csrf

                        <!-- Top: Profile Photo -->
                        <div class="profile-upload-row mb-4">
                            <div class="avatar-circle">
                                <i class="fas fa-camera" id="profile-avatar-icon"></i>
                                <img id="profile-avatar-preview" src="" alt="Profile Preview" style="display: none; width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <div>
                                <label class="profile-photo-btn">
                                    <i class="fas fa-cloud-upload-alt"></i> {{ __('PROFILE PHOTO') }}
                                    <input type="file" name="profile_photo" id="profile_photo" class="d-none" accept="image/*">
                                </label>
                                <div class="text-muted" style="font-size: 13px; margin-top: 4px; color: #64748b;">{{ __('Optional, but recommended') }}</div>
                            </div>
                        </div>

                        <!-- Section Title Above Grid -->
                        <div class="mb-2">
                            <label class="upload-section-title mb-2 d-block fw-bold">{{ __('Add a photo or video to your testimonial') }}</label>
                        </div>

                        <!-- 2-Column Grid: Height strictly matches from top of green upload box to bottom of Your Rating -->
                        <div class="row g-4 align-items-stretch mb-2">
                            <!-- Left Column: Fields from green upload box to Your Rating -->
                            <div class="col-lg-7">
                                <!-- Add Photo or Video Box -->
                                <div class="mb-2">
                                    <div class="upload-drop-zone">
                                        <input type="file" name="file" id="file" accept="image/*,video/*">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <i class="fas fa-video text-success" style="font-size: 26px; color: #10b981;"></i>
                                            <span class="upload-drop-title" id="file-name">{{ __('UPLOAD PHOTO/VIDEO') }}</span>
                                            <span class="upload-drop-subtext">{{ __('Click to upload or drag and drop') }}</span>
                                        </div>
                                    </div>
                                    <div id="media-preview-container" class="mt-2 text-center" style="display: none; background: #f8fafc; border-radius: 8px; padding: 12px; border: 1px solid #e2e8f0;">
                                        <img id="media-image-preview" src="" alt="Media Preview" style="max-height: 180px; max-width: 100%; border-radius: 6px; display: none; margin: 0 auto; object-fit: cover;">
                                        <video id="media-video-preview" src="" controls style="max-height: 180px; max-width: 100%; border-radius: 6px; display: none; margin: 0 auto;"></video>
                                    </div>
                                    @error('file')
                                        <p class="text-danger mt-1" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Name & Position Fields -->
                                <div class="row gx-3 mb-2">
                                    <div class="col-md-6 mb-2">
                                        <label for="name" class="form-label mb-1">{{ __('Your Name') }}</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="{{ __('Enter your full name') }}" required>
                                        @error('name')
                                            <p class="text-danger mt-1" style="font-size: 13px;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="position" class="form-label mb-1">{{ __('Position/Title') }}</label>
                                        <input type="text" class="form-control" name="position" id="position" placeholder="{{ __('Enter your position or title') }}">
                                        @error('position')
                                            <p class="text-danger mt-1" style="font-size: 13px;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Testimonial Description -->
                                <div class="mb-2">
                                    <label for="description" class="form-label mb-1">{{ __('Your Testimonial') }}</label>
                                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="{{ __('Share your experience with us...') }}" maxlength="500" required></textarea>
                                    <div class="text-end text-muted mt-1 mb-1" style="font-size: 12.5px; color: #64748b;" id="char-count">0 / 500</div>
                                    @error('description')
                                        <p class="text-danger mt-1" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Star Rating -->
                                <div class="mt-1">
                                    <label for="rating-value" class="form-label mb-1">{{ __('Your Rating') }}</label>
                                    <div class="d-flex align-items-center gap-2 mt-0">
                                        <div class="rating-stars-wrap">
                                            <i class="fas fa-star rating-star-icon" data-value="1"></i>
                                            <i class="fas fa-star rating-star-icon" data-value="2"></i>
                                            <i class="fas fa-star rating-star-icon" data-value="3"></i>
                                            <i class="fas fa-star rating-star-icon" data-value="4"></i>
                                            <i class="fas fa-star rating-star-icon" data-value="5"></i>
                                        </div>
                                        <span class="text-muted ms-2" style="font-size: 13px; color: #64748b;">{{ __('Click on a star to rate') }}</span>
                                    </div>
                                    <input type="hidden" name="rating" id="rating-value" value="5">
                                </div>
                            </div>

                            <!-- Right Column: Admin Upload Image Only (Height strictly matches from green box to Your Rating) -->
                            <div class="col-lg-5">
                                @php
                                    $formRightImgSetting = setting('success_form_right_image');
                                    $formRightImgUrl = '';

                                    if (!empty($formRightImgSetting)) {
                                        if (is_array($formRightImgSetting)) {
                                            if (!empty($formRightImgSetting['original_image'])) {
                                                $formRightImgUrl = get_media($formRightImgSetting['original_image'], $formRightImgSetting['storage'] ?? 'local');
                                            } elseif (!empty($formRightImgSetting['image_417x384'])) {
                                                $formRightImgUrl = get_media($formRightImgSetting['image_417x384'], $formRightImgSetting['storage'] ?? 'local');
                                            } elseif (!empty($formRightImgSetting['image_320x320'])) {
                                                $formRightImgUrl = get_media($formRightImgSetting['image_320x320'], $formRightImgSetting['storage'] ?? 'local');
                                            }
                                        } elseif (is_string($formRightImgSetting)) {
                                            $unserialized = @unserialize($formRightImgSetting);
                                            if ($unserialized && is_array($unserialized)) {
                                                $formRightImgUrl = getFileLink('original_image', $unserialized);
                                            } elseif (str_starts_with($formRightImgSetting, 'http://') || str_starts_with($formRightImgSetting, 'https://') || str_starts_with($formRightImgSetting, '/')) {
                                                $formRightImgUrl = $formRightImgSetting;
                                            } else {
                                                $formRightImgUrl = static_asset($formRightImgSetting);
                                            }
                                        }
                                    }

                                    if (empty($formRightImgUrl) || str_contains($formRightImgUrl, 'default-image')) {
                                        $formRightImgUrl = static_asset('images/default/default-image-391x541.png');
                                    }
                                @endphp
                                <div class="success-form-right-card h-100 w-100 position-relative overflow-hidden" style="border: 1px solid #e2e8f0; border-radius: 16px; background: #f8fafc;">
                                    <img src="{{ $formRightImgUrl }}" alt="Right Side Image" class="w-100 h-100" style="object-fit: cover; border-radius: 16px; display: block; width: 100%; height: 100%;">
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button Row (In Left Side Grid Column width below) -->
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="mt-2">
                                    <button type="submit" class="template-btn w-100 d-flex align-items-center justify-content-center">
                                        <span>{{ __('Submit Testimonial') }}</span>
                                        <i class="fas fa-paper-plane ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        // Profile Photo Preview
        $('#profile_photo').on('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    $('#profile-avatar-preview').attr('src', event.target.result).show();
                    $('#profile-avatar-icon').hide();
                };
                reader.readAsDataURL(file);
            } else {
                $('#profile-avatar-preview').hide().attr('src', '');
                $('#profile-avatar-icon').show();
            }
        });

        // File preview for media
        $('#file').on('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                $('#file-name').text(file.name);
                const fileType = file.type;
                const reader = new FileReader();

                reader.onload = function(event) {
                    $('#media-preview-container').show();
                    if (fileType.startsWith('image/')) {
                        $('#media-video-preview').hide().attr('src', '');
                        $('#media-image-preview').attr('src', event.target.result).show();
                    } else if (fileType.startsWith('video/')) {
                        $('#media-image-preview').hide().attr('src', '');
                        $('#media-video-preview').attr('src', event.target.result).show();
                    } else {
                        $('#media-image-preview').hide();
                        $('#media-video-preview').hide();
                    }
                };
                reader.readAsDataURL(file);
            } else {
                $('#file-name').text('{{ __("UPLOAD PHOTO/VIDEO") }}');
                $('#media-preview-container').hide();
                $('#media-image-preview').hide().attr('src', '');
                $('#media-video-preview').hide().attr('src', '');
            }
        });

        // Star rating
        $('.rating-star-icon, .rating-stars i').on('click', function() {
            const value = parseInt($(this).data('value'));
            $('#rating-value').val(value);
            
            $('.rating-star-icon, .rating-stars i').each(function() {
                const sValue = parseInt($(this).data('value'));
                if (sValue <= value) {
                    $(this).css('color', '#f59e0b').removeClass('fal far').addClass('fas');
                } else {
                    $(this).css('color', '#cbd5e1').removeClass('fas').addClass('far');
                }
            });
        });

        // Character Counter
        $('#description').on('input', function() {
            var len = $(this).val().length;
            $('#char-count').text(len + ' / 500');
        });
    });
</script>
@endpush
