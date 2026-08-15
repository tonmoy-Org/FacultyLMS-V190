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
        background-color: #073527;
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
        background: linear-gradient(90deg, #073527 0%, #0c4333 35%, #2a6851 70%, rgba(42, 104, 81, 0.6) 88%, rgba(42, 104, 81, 0) 100%);
        z-index: 1;
    }
    .success-hero-banner .badge-pill-tag {
        background: rgba(10, 50, 38, 0.85);
        border: 1px solid rgba(255, 255, 255, 0.15);
        color: #ffffff;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.2px;
        padding: 5px 12px;
        border-radius: 4px;
        display: inline-block;
        text-transform: uppercase;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
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
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        border-radius: 50%;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0.85;
    }
    .success-hero-banner .center-logo-badge-inner {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        border: 2px solid rgba(16, 185, 129, 0.8);
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
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                                            {{ $story->title }}
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
                                                {{ $story->title }}
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
        <hr class="m-b-50">
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                
                <div class="section-title-v3 color-dark m-b-20" style="display: flex; align-items: baseline; justify-content: space-between; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                    <h5 style="font-weight: 600; font-size: 18px; margin: 0; color: #333;">{{ __('Your Experience Matters') }}</h5>
                    <p class="m-0" style="font-size: 14px; color: #666;">{{ __('Share your success story with us.') }}</p>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="ticket-replies m-t-30">
                    <form action="{{ route('store.testimonial') }}" method="POST" enctype="multipart/form-data" class="user-form p-0 row">
                        @csrf
                        
                        <!-- Profile Photo -->
                        <div class="col-12 m-b-30">
                            <div class="d-flex align-items-center">
                                <div class="profile-avatar d-flex align-items-center justify-content-center" style="width: 55px; height: 55px; background-color: #f0f0f0; border-radius: 50%; margin-right: 15px; font-size: 18px; color: #888; overflow: hidden; position: relative;">
                                    <i class="fas fa-camera-retro" id="profile-avatar-icon"></i>
                                    <img id="profile-avatar-preview" src="" alt="Profile Preview" style="display: none; width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div class="profile-btn-wrap">
                                    <label class="btn btn-outline-secondary btn-sm mb-1" style="cursor: pointer; font-size: 13px; font-weight: 500; padding: 5px 12px;">
                                        <i class="fas fa-cloud-upload-alt m-r-5"></i> {{ __('PROFILE PHOTO') }}
                                        <input type="file" name="profile_photo" id="profile_photo" style="display: none;" accept="image/*">
                                    </label>
                                    <div class="fz-12 color-gray">{{ __('Optional, but recommended') }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Media Upload -->
                        <div class="col-12 m-b-20">
                            <label for="file" style="font-size: 14px; font-weight: 500; color: #444; margin-bottom: 8px;">{{ __('Add a photo or video to your testimonial') }}</label>
                            <div class="upload-media-box" style="border: 1px dashed #ccc; border-radius: 4px; padding: 20px; text-align: center; position: relative; background: #fafafa; cursor: pointer;">
                                <input type="file" name="file" id="file" accept="image/*,video/*" style="opacity: 0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer;">
                                <div class="upload-content d-flex align-items-center justify-content-center color-gray fw-500" style="font-size: 13px;">
                                    <i class="fas fa-video m-r-10 fz-16"></i> <span id="file-name">{{ __('UPLOAD PHOTO/VIDEO') }}</span>
                                </div>
                            </div>
                            <div id="media-preview-container" class="mt-2 text-center" style="display: none; background: #f8fafc; border-radius: 6px; padding: 10px; border: 1px solid #e2e8f0;">
                                <img id="media-image-preview" src="" alt="Media Preview" style="max-height: 200px; max-width: 100%; border-radius: 6px; display: none; margin: 0 auto; object-fit: cover;">
                                <video id="media-video-preview" src="" controls style="max-height: 220px; max-width: 100%; border-radius: 6px; display: none; margin: 0 auto;"></video>
                            </div>
                            @error('file')
                                <p class="text-danger error" style="font-size: 13px; margin-top: 5px;">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Name & Position -->
                        <div class="col-md-6 m-b-20">
                            <label for="name" style="font-size: 14px; font-weight: 500; color: #444; margin-bottom: 8px;">{{ __('Your Name') }}</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                            @error('name')
                                <p class="text-danger error" style="font-size: 13px; margin-top: 5px;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6 m-b-20">
                            <label for="position" style="font-size: 14px; font-weight: 500; color: #444; margin-bottom: 8px;">{{ __('Position/Title') }}</label>
                            <input type="text" class="form-control" name="position" id="position">
                            @error('position')
                                <p class="text-danger error" style="font-size: 13px; margin-top: 5px;">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Testimonial Text -->
                        <div class="col-12 m-b-20">
                            <label for="description" style="font-size: 14px; font-weight: 500; color: #444; margin-bottom: 8px;">{{ __('Your Testimonial') }}</label>
                            <textarea class="form-control" name="description" id="description" rows="4" required></textarea>
                            @error('description')
                                <p class="text-danger error" style="font-size: 13px; margin-top: 5px;">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Rating -->
                        <div class="col-12 m-b-30">
                            <label style="font-size: 14px; font-weight: 500; color: #444; margin-bottom: 8px;">{{ __('Your Rating') }}</label>
                            <div class="rating-stars" style="color: #ff9800; font-size: 18px; cursor: pointer;">
                                <i class="fas fa-star" data-value="1"></i>
                                <i class="fas fa-star" data-value="2"></i>
                                <i class="fas fa-star" data-value="3"></i>
                                <i class="fas fa-star" data-value="4"></i>
                                <i class="fas fa-star" data-value="5"></i>
                            </div>
                            <input type="hidden" name="rating" id="rating-value" value="5">
                        </div>

                        <!-- Submit -->
                        <div class="col-md-12 m-t-10">
                            <button class="template-btn" type="submit">{{ __('Submit Testimonial') }}</button>
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
        $('.rating-stars i').on('click', function() {
            const value = parseInt($(this).data('value'));
            $('#rating-value').val(value);
            
            $('.rating-stars i').each(function() {
                const sValue = parseInt($(this).data('value'));
                if (sValue <= value) {
                    $(this).removeClass('fal far').addClass('fas');
                } else {
                    $(this).removeClass('fas').addClass('fal'); // using fal as per theme
                }
            });
        });
    });
</script>
@endpush
