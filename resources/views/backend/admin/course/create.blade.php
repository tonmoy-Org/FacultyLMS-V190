@extends('backend.layouts.master')
@section('title', __('add_new_course'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="section-title">{{ __('add_new_course') }}</h3>
                @php
                    $step_1_error = false;
                    $step_2_error = false;
                    $step_3_error = false;
                    $step_1_errors = ['title', 'category_id', 'subject_id', 'organization_id', 'language_id', 'level_id', 'instructor_ids', 'duration'];
                    $step_3_errors = ['price', 'discount_type', 'discount', 'discount_period', 'renew_after'];

                    foreach ($step_1_errors as $step1) {
                        if ($errors->has($step1)) {
                            $step_1_error = true;
                            break;
                        }
                    }

                    if ($errors->has('video')) {
                        $step_2_error = true;
                    }

                    foreach ($step_3_errors as $step3) {
                        if ($errors->has($step3)) {
                            $step_3_error = true;
                            break;
                        }
                    }
                @endphp
                <div class="default-tab-list bg-white redious-border p-20 p-sm-30">
                    <ul class="nav justify-content-center pb-40 mb-0" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $step_2_error || $step_3_error ? '' : 'active' }} {{ $step_1_error ? 'text-danger' : '' }}"
                                id="basicInformation" data-bs-toggle="pill" data-bs-target="#basicCourseInformation"
                                role="tab" aria-controls="basicCourseInformation" aria-selected="true">
                                <span
                                    class="default-tab-count {{ $step_1_error ? 'bg-danger text-white' : '' }}">{{ __('1') }}</span>{{ __('basic_information') }}</a>
                        </li>
<li class="nav-item" role="presentation">
                            <a class="nav-link" id="masterclass" data-bs-toggle="pill" data-bs-target="#courseMasterclass"
                                role="tab" aria-controls="courseMasterclass" aria-selected="false">
                                <span class="default-tab-count">{{ __('2') }}</span>{{ __('Masterclass Landing') }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $step_2_error ? 'active text-danger' : '' }}" id="mediaImages"
                                data-bs-toggle="pill" data-bs-target="#courseMediaImages" role="tab"
                                aria-controls="courseMediaImages" aria-selected="false">
                                <span
                                    class="default-tab-count {{ $step_2_error ? 'bg-danger text-white' : '' }}">{{ __('3') }}</span>{{ __('media_images') }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $step_3_error && !$step_2_error ? 'active text-danger' : '' }}"
                                id="pricing" data-bs-toggle="pill" data-bs-target="#coursePricing" role="tab"
                                aria-controls="coursePricing" aria-selected="false">
                                <span
                                    class="default-tab-count {{ $step_3_error && !$step_2_error ? 'bg-danger text-white' : '' }}">{{ __('4') }}</span>{{ __('pricing') }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="seo" data-bs-toggle="pill" data-bs-target="#courseSEO"
                                role="tab" aria-controls="courseSEO" aria-selected="false">
                                <span class="default-tab-count">{{ __('5') }}</span>{{ __('seo') }}</a>
                        </li>
                        
                    </ul>
                    <!-- End Add New Course tab menu -->

                    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">@csrf
                        <div class="tab-content" id="mgCourse-tabContent">
                            <div class="tab-pane fade {{ $step_2_error || $step_3_error ? '' : 'show active' }}"
                                id="basicCourseInformation" role="tabpanel" aria-labelledby="basicInformation"
                                tabindex="0">
                                <div class="row gx-20">
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="courseTitle" class="form-label">{{ __('course_title') }}</label>
                                            <input type="text" value="{{ old('title') }}"
                                                class="form-control rounded-2 ai_content_name" id="courseTitle"
                                                name="title" placeholder="{{ __('enter_course_title') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('title') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Course Title -->

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="courseSubtitle" class="form-label">Course Subtitle</label>
                                            <input type="text" class="form-control" name="course_subtitle" id="courseSubtitle" placeholder="Enter Course Subtitle" value="{{ old('course_subtitle') }}">
                                        </div>
                                    </div>
                                    <!-- End Course Subtitle -->

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="select_category"
                                                    class="form-label">{{ __('select_category') }}</label>
                                                <select id="select_category" name="category_id"
                                                    data-route="{{ route('ajax.categories') }}"
                                                    placeholder="{{ __('select_category') }}"
                                                    class="multiple-select-1 form-select-lg rounded-0 mb-3"
                                                    aria-label=".form-select-lg example">
                                                    @if ($category)
                                                        <option value="{{ $category->id }}" selected>
                                                            {{ $category->title }}</option>
                                                    @endif
                                                </select>
                                                <div class="nk-block-des text-danger">
                                                    <p class="error">{{ $errors->first('category_id') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Course Category -->

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="courseType" class="form-label">{{ __('course_type') }}</label>
                                                <select id="courseType" name="course_type"
                                                    class="form-select form-select-lg mb-3 without_search"
                                                    aria-label=".form-select-lg">
                                                    <option value="course"
                                                        {{ old('course_type') == 'course' ? 'selected' : '' }}>
                                                        {{ __('course') }}</option>
                                                    <option value="live_class"
                                                        {{ old('course_type') == 'live_class' ? 'selected' : '' }}>
                                                        {{ __('live_class') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Course Type -->

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="language_id" class="form-label">{{ __('language') }}</label>
                                                <select id="language_id"
                                                    class="form-select form-select-lg mb-3 with_search"
                                                    name="language_id">
                                                    <option value="">{{ __('select_language') }}</option>
                                                    @foreach ($languages as $language)
                                                        <option value="{{ $language->id }}"
                                                            {{ old('language_id') == $language->id ? 'selected' : '' }}>
                                                            {{ $language->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="nk-block-des text-danger">
                                                    <p class="error">{{ $errors->first('language_id') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Language -->

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="select_subject"
                                                    class="form-label">{{ __('select_subject') }}</label>
                                                <select id="select_subject" name="subject_id"
                                                    placeholder="{{ __('select_subject') }}"
                                                    data-route="{{ route('ajax.subjects') }}"
                                                    class="multiple-select-1 form-select-lg rounded-0 mb-3"
                                                    aria-label=".form-select-lg example">
                                                    @if ($subject)
                                                        <option value="{{ $subject->id }}" selected>
                                                            {{ $subject->title }}</option>
                                                    @endif
                                                </select>
                                                <div class="nk-block-des text-danger">
                                                    <p class="error">{{ $errors->first('subject_id') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Subject -->

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="courseLevel"
                                                    class="form-label">{{ __('course_level') }}</label>
                                                <select id="courseLevel"
                                                    class="form-select form-select-lg mb-3 with_search" name="level_id"
                                                    aria-label=".form-select-lg">
                                                    <option value="">{{ __('select_level') }}</option>
                                                    @foreach ($levels as $level)
                                                        <option value="{{ $level->id }}"
                                                            {{ old('level_id') == $level->id ? 'selected' : '' }}>
                                                            {{ $level->title }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="nk-block-des text-danger">
                                                    <p class="error">{{ $errors->first('level_id') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Level -->

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="ins_by_org"
                                                    class="form-label">{{ __('select_organization') }}</label>
                                                <select id="ins_by_org" name="organization_id"
                                                    data-route="{{ route('ajax.organizations') }}"
                                                    class="form-select-lg rounded-0 mb-3 with_search"
                                                    aria-label=".form-select-lg example"
                                                    data-url="{{ route('ajax.instructors') }}">
                                                    <option value="">{{ __('select_organization') }}</option>
                                                    @if ($organization)
                                                        <option value="{{ $organization->id }}" selected>
                                                            {{ $organization->org_name }}</option>
                                                    @endif
                                                </select>
                                                <div class="nk-block-des text-danger">
                                                    <p class="error">{{ $errors->first('organization_id') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Organisation -->

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="instructor_ids"
                                                    class="form-label">{{ __('instructor') }}</label>
                                                <select id="instructor_ids" name="instructor_ids[]" multiple
                                                    class="form-select form-select-lg mb-3 without_search"
                                                    aria-label=".form-select-lg">
                                                    @foreach ($instructors as $instructor)
                                                        <option value="{{ $instructor->id }}"
                                                            {{ old('instructor_ids') && in_array($instructor->id, old('instructor_ids')) ? 'selected' : '' }}>
                                                            {{ $instructor->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="nk-block-des text-danger">
                                                    <p class="error">{{ $errors->first('instructor_ids') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Instructor -->

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="courseDuration"
                                                class="form-label">{{ __('course_duration') }}</label>
                                            <input type="text" class="form-control rounded-2" id="courseDuration"
                                                name="duration" placeholder="{{ __('72_hours') }}"
                                                value="{{ old('duration') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('duration') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Course Duration -->
                                    <div class="col-lg-6">
                                        <div class="multi-select-v2 mb-4">
                                            <label for="tag" class="form-label">{{ __('course_tag') }}</label>
                                            <select id="tag" multiple
                                                class="form-select form-select-lg mb-3 with_search" name="tags[]"
                                                aria-label=".form-select-lg" placeholder="{{ __('select_tags') }}">
                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag->id }}"
                                                        {{ old('tags') && in_array($tag->id, old('tags')) ? 'selected' : '' }}>
                                                        {{ $tag->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- End Course Tag -->

                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <div class="d-flex justify-content-between">
                                                <label for="shortDescription"
                                                    class="form-label">{{ __('short_description') }}</label>
                                                @include('backend.common.ai_btn', [
                                                    'name' => 'ai_short_description',
                                                    'length' => '200',
                                                    'topic' => 'ai_content_name',
                                                    'use_case' => 'short description for course',
                                                ])
                                            </div>
                                            <textarea class="form-control ai_short_description" name="short_description" id="shortDescription"
                                                placeholder="{{ __('enter_short_description') }}">{{ old('short_description') }}</textarea>
                                        </div>
                                    </div>
                                    <!-- End Short Description -->

                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="descriptionSubtitle" class="form-label">Description Subtitle</label>
                                            <input type="text" class="form-control" name="description_subtitle" id="descriptionSubtitle" placeholder="Enter Description Subtitle" value="{{ old('description_subtitle') }}">
                                        </div>
                                    </div>
                                    <!-- End Description Subtitle -->

                                    <div class="col-lg-12">
                                        <div class="editor-wrapper">
                                            <div class="d-flex justify-content-between">
                                                <label class="form-label mb-1">{{ __('description') }}</label>
                                                @include('backend.common.ai_btn', [
                                                    'name' => 'ai_description',
                                                    'length' => '259',
                                                    'topic' => 'ai_content_name',
                                                    'use_case' => 'long description  for course',
                                                    'long_description' => 1,
                                                ])
                                            </div>
                                            <textarea id="product-update-editor" class="ai_description" name="description">{!! old('description') !!}</textarea>
                                        </div>

                                        <div class="custom-checkbox mt-12">
                                            <label>
                                                <input type="checkbox" value="1" name="is_private"
                                                    {{ old('is_private') == 1 ? 'checked' : '' }}>
                                                <span>{{ __('private_course') }}</span>
                                            </label>
                                        </div>
                                    </div>
                                    <!-- End Description -->

                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-end align-items-center mt-30">
                                            <a href="#" type="button" class="btn sg-btn-primary btn_action"
                                                data-bs-target="#courseMasterclass">{{ __('next') }}</a>
                                        </div>
                                    </div>
                                    <!-- End Next Page BTN -->
                                </div>
                            </div>
                            <!-- End Basic Course Information -->
<!-- Start Masterclass Landing Tab -->
                            <div class="tab-pane fade" id="courseMasterclass" role="tabpanel" aria-labelledby="masterclass" tabindex="0">
                                @php
                                    $defEyebrow = old('masterclass_settings.eyebrow_title', 'E-commerce শুরু করার hidden path');
                                    $defPrimaryCta = old('masterclass_settings.primary_cta_text', 'রেজিস্ট্রেশন করুন এখনই');
                                    $defVideoCaption = old('masterclass_settings.video_caption', 'বিস্তারিত জানতে ভিডিওটি দেখুন');
                                    $defRemainingSeats = old('masterclass_settings.remaining_seats', '100');

                                    $defGoldBadgeTop = old('masterclass_settings.gold_badge_top', 'এখনই সিট বুক করুন');
                                    $defZoomTitle = old('masterclass_settings.zoom_title', 'Zoom লাইভ 104');
                                    $defZoomSubtitle = old('masterclass_settings.zoom_subtitle', 'অনলাইন ইন্টারেক্টিভ সেশন');
                                    $defScheduleLabel = old('masterclass_settings.schedule_label', 'সময় / সময়সূচী');
                                    $defScheduleValue = old('masterclass_settings.schedule_value', '2h 40min');
                                    $defLevelLabel = old('masterclass_settings.level_label', 'Level');
                                    $defLevelValue = old('masterclass_settings.level_value', 'beginner');
                                    $defGoldOfferTitle = old('masterclass_settings.gold_offer_title', 'আজকের স্পেশাল অফার');
                                    $defOriginalPriceLabel = old('masterclass_settings.original_price_label', 'মূল প্রাইস');
                                    $defGoldCtaText = old('masterclass_settings.gold_cta_text', 'এখনই জয়েন করুন');
                                    $defGoldSeatsText = old('masterclass_settings.gold_seats_text', 'আর মাত্র ' . $defRemainingSeats . ' ??? ????');

                                    $defBenefitsTitle = old('masterclass_settings.benefits_title', 'চলুন একটু খুঁজে বের করার চেষ্টা করি নিচের সমস্যাগুলোর কোনো একটি বা একাধিক সমস্যা আপনার সাথে মিলে কিনা?');
                                    $benefitsList = old('masterclass_settings.benefits_list', [
                                        'মার্কেটপ্লেস থেকে ক্লায়েন্ট পাওয়ার জন্য সংগ্রাম করছেন? | বিভিন্ন ফ্রিল্যান্সিং মার্কেটপ্লেসে আপনার মতো আরো হাজারো ফ্রিল্যান্সার বা সার্ভিস প্রোভাইডারের প্রোফাইল রয়েছে। আপনাকে সেখানে তাদের সাথে প্রতিযোগিতা করতে হয়। হাজারো প্রোফাইলের ভিড়ে আপনার প্রোফাইলটি যদি ক্লায়েন্টের চোখে না পড়ে, তাহলে সেখান থেকে কাজ পাওয়া কঠিন হয়ে পড়ে। আর আপনি যদি আউট অফ মার্কেটপ্লেস ক্লায়েন্টকে টার্গেট করতে পারেন তবে ক্লায়েন্ট পাওয়া আপনার জন্য অনেক সহজ হয়ে যায়।',
                                        'ক্লায়েন্ট পেতে বারবার রিজেক্ট হচ্ছেন? | বারবার রিজেকশন হওয়া হতাশাজনক তবে এর পেছনে লুকিয়ে থাকতে পারে আপনার প্রাইসিং মডেল, প্রোফাইল অপটিমাইজেশন, বা ড্রাফট পিচিংয়ের ভুল কৌশল। আমরা এই ফানেলগুলো কিভাবে কাটিয়ে উঠতে হয় এবং ক্লায়েন্টের সাথে কিভাবে একটি ট্রাস্টেড সম্পর্ক তৈরি করতে হয়, তা শেখাব।',
                                        'আয়ের উপর মার্কেটপ্লেস অতিরিক্ত ফি কাটছে? | মার্কেটপ্লেসের প্ল্যাটফর্মগুলো প্রতিটি আয়ের একটি বড় অংশ ফি হিসেবে কেটে নেয়। এটি অনেক ফ্রিল্যান্সারের জন্য হতাশার কারণ। আমরা যেহেতু শিখব কিভাবে মার্কেটপ্লেসের বাইরে ক্লায়েন্ট খুঁজে পাওয়া যায়, তা এ ফি গুণা বন্ধ সম্ভব হবে।',
                                        'আপনার আউটরিচ ইমেইল কোনো রেসপন্স পাচ্ছে না? | আউটরিচ ইমেইলগুলোর কোনো জবাব না পাওয়া মানে সেখানে কিছু ঘাটতি আছে। এটা হতে পারে আপনার মেসেজের ভুল টোন, অসম্পূর্ণ মেসেজ, বা ভুল টার্গেটিং। আপনি এ কোর্সে শিখবেন কিভাবে সঠিকভাবে ইমেইল কপি লিখতে হয় যা ক্লায়েন্টের দৃষ্টি আকর্ষণ করবে এবং রিপ্লাই পাওয়ার সম্ভাবনা বাড়াবে।',
                                        'আপনার স্কিল আছে, কিন্তু ক্লায়েন্ট নেই? | ক্লায়েন্ট না থাকার মানে এই নয় যে আপনার স্কিল কম। এটা হতে পারে সঠিক মার্কেটিং ও নেটওয়ার্কিং কৌশলের অভাব। আপনার প্রতিভা বা দক্ষতা থাকা সত্ত্বেও যদি কাজ না পান, তবে এর কারণ হতে পারে আপনার আউটরিচ স্ট্র্যাটেজি বা প্রোফাইল অপটিমাইজেশনের ঘাটতি। আমরা দেখাব কিভাবে সঠিক পদ্ধতিতে ক্লায়েন্টদের কাছে পৌঁছাতে হয় এবং তাদের প্রয়োজন বুঝে অফার করতে হয়।'
                                    ]);

                                    $defGiftBadge = old('masterclass_settings.gift_badge', '🎁 যারা join করবেন তাদের জন্য special gift');
                                    $defGiftTitle = old('masterclass_settings.gift_title', '৳১০,০০০ টাকার Ecom Dropshipping Mastery Course — সম্পূর্ণ FREE করার সুযোগ');
                                    $defGiftValue = old('masterclass_settings.gift_value', '৳১০,০০০');
                                    $defGiftDescription = old('masterclass_settings.gift_description', 'এই master class-এ যারা join করবেন, তারা আমার ৳১০,০০০ টাকার Ecom Dropshipping Mastery Course টা free তে করার সুযোগ পাবেন। মাস্টারক্লাসে এই বিষয়ে বিস্তারিত আলোচনা।');
                                    $defGiftQuote = old('masterclass_settings.gift_quote', '"এই কোর্সে আমি ই-কমার্স বিজনেস, ডিজিটাল মার্কেটিং এর বিভিন্ন বিষয় যেমন Facebook Ads, Google Ads নিয়ে বিস্তারিত শিখিয়েছি। এছাড়াও কিভাবে একটা বিজনেসকে Scale করতে তা নিয়ে ক্লাস আছে।"');
                                    $defGiftFooterNote = old('masterclass_settings.gift_footer_note', 'যারা একদম নতুন আছেন তারাও এই কোর্স থেকে বেনিফিটেড হতে পারবে।');
                                    $defGiftCtaText = old('masterclass_settings.gift_cta_text', 'সিট কনফার্ম করুন →');
                                    $defSupportTitle = old('masterclass_settings.support_title', 'আর সাপোর্ট?');
                                    $defSupportDescription = old('masterclass_settings.support_description', '<p>কোর্সের টপিক রিলেটেড যেকোনো প্রবলেম ফেস করলে সরাসরি সাপোর্ট ফোরাম অথবা আমাদের মেন্টর টিম থেকে ইনস্ট্যান্ট হেল্প পাবেন। লাইভ সাপোর্ট সেশনের মাধ্যমে যেকোনো টেকনিক্যাল প্রবলেম ওয়ান টু ওয়ান সলভ করে দেওয়া হবে।</p><p>এই সাপোর্ট আমাদের টিম মেম্বারদের পক্ষে সরাসরি প্রোভাইড করা হচ্ছে, যাতে করে আপনি ফেস করা যেকোনো সমস্যার দ্রুততম সময়ে নিখুঁত সমাধান পেতে পারেন।</p>');

                                    $defScheduleBadge = old('masterclass_settings.schedule_badge', 'LIVE ZOOM MASTERCLASS');
                                    $defClassScheduleTitle = old('masterclass_settings.class_schedule_title', '২ দিনব্যাপী e-commerce live masterclass');
                                    $defClassScheduleTime = old('masterclass_settings.class_schedule_time', '৬ আগস্ট তারিখ রাত ৮ টায় শুরু');

                                    $defExplainerTitle = old('masterclass_settings.explainer_title', 'একটা প্রশ্ন আপনার মাথায় আসতে পারে — এত কিছু, মাত্র ৯৯ টাকায় কেন??');
                                    $defExplainerText = old('masterclass_settings.explainer_text', '<p>টু বি অনেস্ট, আমি এই masterclass-টা সম্পূর্ণ free করাতে চেয়েছিলাম।</p><p>কিন্তু problem হচ্ছে — আমার free session-গুলোতে দেখা যায় কয়েক হাজার মানুষ register করে বা join করে। যেহেতু এই session-টা Zoom-এ live হবে, তাই আমি চাইলেও এখানে বেশি মানুষ নিতে পারব না। Seat limit থাকবে।</p><p>তাই আমি এখানে ছোট্ট একটা token amount রেখেছি — শুধু audience filter করার জন্য। যেন এই masterclass-এ তারাই join করে, যারা সত্যিই e-commerce business শুরু করার ব্যাপারে serious এবং step-by-step process-টা মনোযোগ দিয়ে শিখতে ready।</p>');

                                    $defBreakdownSubheading = old('masterclass_settings.breakdown_subheading', 'এই $15.00 টাকায় আপনি পাচ্ছেন:');
                                    $defBreakdownTodayTitle = old('masterclass_settings.breakdown_today_title', 'আজকের মূল্য (token)');
                                    $defBreakdownItems = old('masterclass_settings.breakdown_items', "🎓 ২ দিনের live masterclass — সম্পূর্ণ roadmap সহ | ৳৩,০০০
🎁 Ecom Dropshipping Mastery Course free পাওয়ার সুযোগ | ৳১০,০০০");

                                    $defOrderFormTitle = old('masterclass_settings.order_form_title', 'মাস্টারক্লাসে জয়েন করতে নিচের ফর্মটি পূরণ করুন');
                                    $defOrderFormSubtitle = old('masterclass_settings.order_form_subtitle', 'Give valid information');
                                    $defNameLabel = old('masterclass_settings.name_label', 'Your Full Name');
                                    $defNamePlaceholder = old('masterclass_settings.name_placeholder', 'আপনার সম্পূর্ণ নাম');
                                    $defPhoneLabel = old('masterclass_settings.phone_label', 'Mobile Number');

                                    $defOverviewTag = old('masterclass_settings.overview_tag', 'FEATURED COURSE');
                                    $defOverviewTitle = old('masterclass_settings.overview_title', 'Master Web Development With Expert Guidance');
                                    $defOverviewDesc1 = old('masterclass_settings.overview_desc1', 'Join our comprehensive single course program designed to take you from beginner to advanced level with real-world projects and direct mentor support.');
                                    $defOverviewDesc2 = old('masterclass_settings.overview_desc2', 'Get lifetime access to premium curriculum, practical assignments, downloadable resources, and a verified completion certificate.');
                                    $defOverviewBtnText = old('masterclass_settings.overview_btn_text', 'ENROLL NOW');
                                    $defOverviewBtnUrl = old('masterclass_settings.overview_btn_url', '#register');
                                    $defOverviewImageUrl = old('masterclass_settings.overview_image_url', 'https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=1200&auto=format&fit=crop');
                                    $defHideOverviewSection = old('masterclass_settings.hide_overview_section');
                                @endphp
                                 <div class="masterclass-single-page-wrapper">
                                    <!-- Section 3: Benefits & Target Audience -->
                                    <div class="card border mb-4 rounded-3 shadow-sm">
                                        <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                                            <span class="form-label font-16 fw-normal text-dark m-0"> Benefits & Target Audience Section
                                            </span>
                                            <button type="button" class="btn sg-btn-primary btn-sm rounded-2" id="add_new_benefit_btn">
                                                Add New Benefit Point <i class="las la-plus ms-1"></i>
                                            </button>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="mb-4">
                                                <label class="form-label">Benefits Section Heading</label>
                                                <input type="text" name="masterclass_settings[benefits_title]" class="form-control rounded-2"
                                                           value="{{ $defBenefitsTitle }}" placeholder="?? ???????????? ??? ?????">
                                            </div>

                                            <label class="form-label mb-2">Benefit Points (এই মাস্টারক্লাস কার কার জন্য)</label>
                                            <div id="benefits_items_container">
                                                @foreach($benefitsList as $bIdx => $bItem)
                                                    <div class="benefit-single-item d-flex align-items-center gap-2 mb-3">
                                                        <span class="badge bg-light text-dark border p-2 font-13"><span class="benefit-num">{{ $bIdx + 1 }}</span></span>
                                                        <input type="text" name="masterclass_settings[benefits_list][]" class="form-control rounded-2 bg-white"
                                                                       value="{{ $bItem }}" placeholder="?????? / ???????? ?????...">
                                                        <a href="javascript:void(0)" class="btn btn-sm text-danger border-0 remove-benefit-btn ms-1">
                                                            <i class="las la-trash-alt fs-5"></i>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                     </div>

                                    <!-- Section 4: Special Bonus Gift Offer -->
                                    <div class="card border mb-4 rounded-3 shadow-sm">
                                        <div class="card-header bg-white py-3">
                                            <span class="form-label font-16 fw-normal text-dark m-0"> Special Bonus Gift Offer Section
                                            </span>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="row gx-20">
                                                <div class="col-12 mb-4">
                                                    <div class="custom-checkbox">
                                                        <label class="d-flex align-items-center gap-2 cursor-pointer">
                                                            <input type="checkbox" name="masterclass_settings[hide_special_gift]" value="1" id="create_hide_gift"
                                                                {{ old('masterclass_settings.hide_special_gift') == '1' ? 'checked' : '' }}>
                                                            <span class="text-dark font-16">Hide Special Gift Banner Card</span>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label">Gift Pill / Badge Text</label>
                                                    <input type="text" name="masterclass_settings[gift_badge]" class="form-control rounded-2"
                                                           value="{{ $defGiftBadge }}" placeholder="🎁 যারা join করবেন তাদের জন্য special gift">
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label">Gift Title</label>
                                                    <input type="text" name="masterclass_settings[gift_title]" class="form-control rounded-2"
                                                           value="{{ $defGiftTitle }}" placeholder="৳১০,০০০ টাকার Ecom Dropshipping Mastery Course — সম্পূর্ণ FREE করার সুযোগ">
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label">Original Gift Value</label>
                                                    <input type="text" name="masterclass_settings[gift_value]" class="form-control rounded-2"
                                                           value="{{ $defGiftValue }}" placeholder="৳১০,০০০">
                                                </div>

                                                <div class="col-lg-12 col-md-12 mb-4">
                                                    <label class="form-label">Gift Description</label>
                                                    <textarea name="masterclass_settings[gift_description]" class="form-control rounded-2 summernote" rows="3"
                                                              placeholder="এই master class-এ যারা join করবেন, তারা আমার ৳১০,০০০ টাকার Ecom Dropshipping Mastery Course টা free তে করার সুযোগ পাবেন...">{{ $defGiftDescription }}</textarea>
                                                </div>

                                                <div class="col-lg-12 col-md-12 mb-4">
                                                    <label class="form-label">Gift Quote Callout Box</label>
                                                    <textarea name="masterclass_settings[gift_quote]" class="form-control rounded-2 summernote" rows="3"
                                                              placeholder="এই কোর্সে আমি ই-কমার্স বিজনেস, ডিজিটাল মার্কেটিং এর বিভিন্ন বিষয় নিয়ে আলোচনা করেছি...">{{ $defGiftQuote }}</textarea>
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label">Gift Footer Note Text</label>
                                                    <input type="text" name="masterclass_settings[gift_footer_note]" class="form-control rounded-2"
                                                           value="{{ $defGiftFooterNote }}" placeholder="যারা একদম নতুন আছেন তারাও এই কোর্স থেকে বেনিফিটেড হতে পারবে।">
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label">Gift Red CTA Button Text</label>
                                                    <input type="text" name="masterclass_settings[gift_cta_text]" class="form-control rounded-2"
                                                           value="{{ $defGiftCtaText }}" placeholder="সিট কনফার্ম করুন →">
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <!-- Section 8: Registration Order Form -->
                                    <div class="card border mb-4 rounded-3 shadow-sm">
                                        <div class="card-header bg-white py-3">
                                            <span class="form-label font-16 fw-normal text-dark m-0"> Registration Order Form Section
                                            </span>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="row gx-20">
                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label">Registration Form Title</label>
                                                    <input type="text" name="masterclass_settings[order_form_title]" class="form-control rounded-2"
                                                           value="{{ $defOrderFormTitle }}" placeholder="মাস্টারক্লাসে জয়েন করতে নিচের ফর্মটি পূরণ করুন">
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label">Registration Form Subtitle</label>
                                                    <input type="text" name="masterclass_settings[order_form_subtitle]" class="form-control rounded-2"
                                                           value="{{ $defOrderFormSubtitle }}" placeholder="Give valid information">
                                                </div>

                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <label class="form-label">Full Name Field Label</label>
                                                    <input type="text" name="masterclass_settings[name_label]" class="form-control rounded-2"
                                                           value="{{ $defNameLabel }}" placeholder="Your Full Name">
                                                </div>

                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <label class="form-label">Full Name Field Placeholder</label>
                                                    <input type="text" name="masterclass_settings[name_placeholder]" class="form-control rounded-2"
                                                           value="{{ $defNamePlaceholder }}" placeholder="আপনার সম্পূর্ণ নাম">
                                                </div>

                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <label class="form-label">Mobile Number Field Label</label>
                                                    <input type="text" name="masterclass_settings[phone_label]" class="form-control rounded-2"
                                                           value="{{ $defPhoneLabel }}" placeholder="Mobile Number">
                                                </div>

                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <label class="form-label">Mobile Number Field Placeholder</label>
                                                    <input type="text" name="masterclass_settings[phone_placeholder]" class="form-control rounded-2"
                                                           value="{{ $defPhonePlaceholder }}" placeholder="01XXXXXXXXX">
                                                </div>

                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <label class="form-label">Email Address Field Label</label>
                                                    <input type="text" name="masterclass_settings[email_label]" class="form-control rounded-2"
                                                           value="{{ $defEmailLabel }}" placeholder="Email address">
                                                </div>

                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <label class="form-label">Email Address Field Placeholder</label>
                                                    <input type="text" name="masterclass_settings[email_placeholder]" class="form-control rounded-2"
                                                           value="{{ $defEmailPlaceholder }}" placeholder="আপনার ইমেইল এড্রেস">
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label">Order Summary Heading</label>
                                                    <input type="text" name="masterclass_settings[order_summary_title]" class="form-control rounded-2"
                                                           value="{{ $defOrderSummaryTitle }}" placeholder="Your order">
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label">Pay Now Button Text</label>
                                                    <input type="text" name="masterclass_settings[pay_now_btn_text]" class="form-control rounded-2"
                                                           value="{{ $defPayNowBtnText }}" placeholder="PAY NOW">
                                                </div>

                                                <div class="col-lg-12 col-md-12 mb-4">
                                                    <label class="form-label">Privacy Policy Notice Text</label>
                                                    <textarea name="masterclass_settings[privacy_notice]" class="form-control rounded-2 summernote" rows="2"
                                                              placeholder="Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.">{{ $defPrivacyNotice }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section 10: Masterclass Ad Banners (1 & 2) -->
                                    <div class="card border mb-4 rounded-3 shadow-sm">
                                        <div class="card-header bg-white py-3">
                                            <span class="form-label font-16 fw-normal text-dark m-0">Ad Banners (Masterclass Landing Page)</span>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="row gx-20">
                                                <!-- Banner 1 -->
                                                <div class="col-12">
                                                    <label class="form-label font-15 fw-semibold mb-3 border-bottom pb-2 w-100">Ad Banner 1</label>
                                                </div>
                                                <div class="col-lg-12 mb-4">
                                                    <div class="custom-checkbox">
                                                        <label>
                                                            <input type="checkbox" name="masterclass_settings[ad_banner_1_status]" value="1"
                                                                {{ !empty($mcSettings['ad_banner_1_status']) ? 'checked' : '' }}>
                                                            <span>Enable Ad Banner 1</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <label class="form-label">Ad Banner Link URL 1</label>
                                                    <input type="text" name="masterclass_settings[ad_banner_1_link]" class="form-control rounded-2"
                                                           value="{{ $mcSettings['ad_banner_1_link'] ?? '' }}" placeholder="https://example.com/promotion1">
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <label class="form-label mb-2">Banner Image 1 (1200x300)</label>
                                                    <div class="row align-items-center">
                                                        <div class="col-lg-6 mb-2">
                                                            <label class="form-label mb-1">Upload Image File</label>
                                                            <input type="file" name="ad_banner_1_file" class="form-control rounded-2" accept="image/*">
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <label class="form-label mb-1">Or Image URL / Link</label>
                                                            <input type="text" name="masterclass_settings[ad_banner_1_image_url_custom]" class="form-control rounded-2"
                                                                   value="{{ $mcSettings['ad_banner_1_image_url'] ?? '' }}" placeholder="https://example.com/banner1.jpg">
                                                        </div>
                                                    </div>
                                                    @if(!empty($mcSettings['ad_banner_1_image_url']))
                                                        <div class="mt-2">
                                                            <label class="small text-muted d-block mb-1">Current Banner 1 Preview:</label>
                                                            <img src="{{ $mcSettings['ad_banner_1_image_url'] }}" alt="Ad Banner 1 Preview" class="rounded border w-100" style="max-height: 80px; object-fit: cover;">
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Banner 2 -->
                                                <div class="col-12 mt-3">
                                                    <label class="form-label font-15 fw-semibold mb-3 border-bottom pb-2 w-100">Ad Banner 2</label>
                                                </div>
                                                <div class="col-lg-12 mb-4">
                                                    <div class="custom-checkbox">
                                                        <label>
                                                            <input type="checkbox" name="masterclass_settings[ad_banner_2_status]" value="1"
                                                                {{ !empty($mcSettings['ad_banner_2_status']) ? 'checked' : '' }}>
                                                            <span>Enable Ad Banner 2</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <label class="form-label">Ad Banner Link URL 2</label>
                                                    <input type="text" name="masterclass_settings[ad_banner_2_link]" class="form-control rounded-2"
                                                           value="{{ $mcSettings['ad_banner_2_link'] ?? '' }}" placeholder="https://example.com/promotion2">
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <label class="form-label mb-2">Banner Image 2 (1200x300)</label>
                                                    <div class="row align-items-center">
                                                        <div class="col-lg-6 mb-2">
                                                            <label class="form-label mb-1">Upload Image File</label>
                                                            <input type="file" name="ad_banner_2_file" class="form-control rounded-2" accept="image/*">
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <label class="form-label mb-1">Or Image URL / Link</label>
                                                            <input type="text" name="masterclass_settings[ad_banner_2_image_url_custom]" class="form-control rounded-2"
                                                                   value="{{ $mcSettings['ad_banner_2_image_url'] ?? '' }}" placeholder="https://example.com/banner2.jpg">
                                                        </div>
                                                    </div>
                                                    @if(!empty($mcSettings['ad_banner_2_image_url']))
                                                        <div class="mt-2">
                                                            <label class="small text-muted d-block mb-1">Current Banner 2 Preview:</label>
                                                            <img src="{{ $mcSettings['ad_banner_2_image_url'] }}" alt="Ad Banner 2 Preview" class="rounded border w-100" style="max-height: 80px; object-fit: cover;">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section 11: Masterclass Support Section -->
                                    <div class="card border mb-4 rounded-3 shadow-sm">
                                        <div class="card-header bg-white py-3">
                                            <span class="form-label font-16 fw-normal text-dark m-0">Support Section (Masterclass Landing Page)</span>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="row gx-20">
                                                <!-- Status -->
                                                <div class="col-12 mb-3">
                                                    <div class="form-check form-switch mb-0">
                                                        <input type="checkbox" name="masterclass_settings[support_status]" value="1"
                                                               class="form-check-input" id="support_status"
                                                               {{ !empty($mcSettings['support_status']) ? 'checked' : '' }}>
                                                        <label class="form-label mb-0 ms-2 fw-semibold" for="support_status">Show Support Section</label>
                                                    </div>
                                                </div>

                                                <!-- Support Title -->
                                                <div class="col-lg-12 col-md-12 mb-4">
                                                    <label class="form-label">Support Title / Heading</label>
                                                    <input type="text" name="masterclass_settings[support_title]" class="form-control rounded-2"
                                                           value="{{ $mcSettings['support_title'] ?? $defSupportTitle }}" placeholder="আর সাপোর্ট?">
                                                </div>

                                                <!-- Support Description -->
                                                <div class="col-lg-12 col-md-12 mb-4">
                                                    <label class="form-label">Support Description</label>
                                                    <textarea name="masterclass_settings[support_description]" class="form-control rounded-2 summernote" rows="3"
                                                              placeholder="সাপোর্টের বিস্তারিত লিখুন...">{{ $mcSettings['support_description'] ?? $defSupportDescription }}</textarea>
                                                </div>

                                                <!-- Support Image Upload -->
                                                <div class="col-lg-6 mb-2">
                                                    <label class="form-label mb-1">Upload Support Image File (Transparent cut-out recommended)</label>
                                                    <input type="file" name="support_image_file" class="form-control rounded-2" accept="image/*">
                                                </div>
                                                <div class="col-lg-6 mb-2">
                                                    <label class="form-label mb-1">Or Support Image URL / Link</label>
                                                    <input type="text" name="masterclass_settings[support_image_url_custom]" class="form-control rounded-2"
                                                           value="{{ $mcSettings['support_image_url'] ?? '' }}" placeholder="https://example.com/support-person.png">
                                                </div>

                                                @if(!empty($mcSettings['support_image_url']))
                                                    <div class="col-12 mt-2">
                                                        <label class="small text-muted d-block mb-1">Current Support Image Preview:</label>
                                                        <img src="{{ $mcSettings['support_image_url'] }}" alt="Support Image Preview" class="rounded border" style="max-height: 120px; object-fit: contain; background: #eefaf6; padding: 5px;">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                                        <a href="#" class="btn sg-btn-outline-primary btn_action" data-bs-toggle="tab" data-bs-target="#courseSEO">{{ __('back') }}</a>
                                        <button type="submit" class="btn sg-btn-primary py-2 px-4 fs-6"><i class="fas fa-check-circle me-1"></i> {{ __('submit') }}</button>
                                    </div>
                                </div>
                            </div>
                            <!-- End Masterclass Landing Tab -->

                            <div class="tab-pane fade {{ $step_2_error ? 'show active' : '' }}" id="courseMediaImages"
                                role="tabpanel" aria-labelledby="mediaImages" tabindex="0">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="video_source"
                                                    class="form-label">{{ __('video_source') }}</label>
                                                <select id="video_source"
                                                    class="form-select form-select-lg mb-3 without_search"
                                                    name="video_source">
                                                    <option value="">{{ __('select_video_source') }}</option>
                                                    <option value="upload"
                                                        {{ old('video_source') == 'upload' ? 'selected' : '' }}>
                                                        {{ __('upload') }}</option>

                                                    <option value="youtube"
                                                        {{ old('video_source') == 'youtube' ? 'selected' : '' }}>
                                                        {{ __('youtube') }}</option>
                                                    <option value="vimeo"
                                                        {{ old('video_source') == 'vimeo' ? 'selected' : '' }}>
                                                        {{ __('vimeo') }}</option>
                                                    <option value="mp4"
                                                        {{ old('video_source') == 'mp4' ? 'selected' : '' }}>
                                                        {{ __('mp4') }}</option>
                                                </select>
                                                <div class="nk-block-des text-danger">
                                                    <p class="error">{{ $errors->first('video_source') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Video Source -->
                                    <div
                                        class="col-lg-6 upload_div {{ old('video_source') == 'upload' ? '' : 'd-none' }}">
                                        <div class="mb-3">
                                            <label for="thumbnailFile"
                                                class="form-label">{{ __('upload_video') }}</label>
                                            <label for="thumbnailFile" class="file-upload-text">
                                                <p class="file_name">{{ __('video') }}</p>
                                                <span class="file-btn">{{ __('choose_file') }}</span>
                                            </label>
                                            <input class="d-none thumb_picker" name="video" type="file"
                                                id="thumbnailFile">
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('video') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- End Upload Video -->
                                    <div
                                        class="col-lg-6 video_link {{ old('video_source') && old('video_source') != 'upload' ? '' : 'd-none' }}">
                                        <div class="mb-4">
                                            <label for="videoLink" class="form-label">{{ __('video_link') }}</label>
                                            <input type="text" class="form-control rounded-2" name="video_link"
                                                id="videoLink" placeholder="{{ __('enter_video_link') }}"
                                                value="{{ old('video') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('video_link') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    @include('backend.common.media-input', [
                                        'title' => 'Slider Image',
                                        'name' => 'image_media_id',
                                        'col' => 'col-12',
                                        'size' => '(402x248)',
                                        'image' => old('image_media_id'),
                                        'label' => __('thumbnail'),
                                    ])
                                    <div class="col-lg-6">
                                        <div class="custom-checkbox mt-20">
                                            <label>
                                                <input type="checkbox" value="1"
                                                    {{ old('is_downloadable') == 1 ? 'checked' : '' }}>
                                                <span class="">{{ __('downloadable') }}</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mt-30">
                                            <a href="#" type="button"
                                                class="btn sg-btn-outline-primary btn_action"
                                                data-bs-target="#courseMasterclass">{{ __('back') }}</a>

                                            <a href="#" type="button" class="btn sg-btn-primary btn_action"
                                                data-bs-target="#coursePricing">{{ __('next') }}</a>
                                        </div>
                                    </div>
                                    <!-- End Next Page BTN -->
                                </div>
                            </div>
                            <!-- End Course Media Images -->

                            <div class="tab-pane fade {{ $step_3_error && !$step_2_error ? 'show active' : '' }}"
                                id="coursePricing" role="tabpanel" aria-labelledby="pricing" tabindex="0">
                                <div class="row gx-20">
                                    <div class="col-lg-6">
                                        <div class="price-checkbox d-flex gap-12 mb-4">
                                            <label for="is_free">{{ __('free_course') }}</label>
                                            <div class="setting-check">
                                                <input type="checkbox" id="is_free" name="is_free" value="1"
                                                    {{ old('is_free') == 1 ? 'checked' : '' }}>
                                                <label for="is_free"></label>
                                            </div>
                                        </div>
                                        <div
                                            class="price-checkbox d-flex gap-12 mb-4 not_free_div {{ old('is_free') == 1 ? 'd-none' : '' }}">
                                            <label for="discountable_course">{{ __('discountable_course') }}</label>
                                            <div class="setting-check">
                                                <input type="checkbox" id="discountable_course" name="is_discountable"
                                                    value="1" {{ old('is_discountable') == 1 ? 'checked' : '' }}>
                                                <label for="discountable_course"></label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-6"></div>
                                    <!-- End Price Checkbox -->

                                    <div class="col-lg-6 not_free_div {{ old('is_free') == 1 ? 'd-none' : '' }}">
                                        <div class="mb-4">
                                            <label for="coursePrice" class="form-label">{{ __('course_price') }}</label>
                                            <input type="number" class="form-control rounded-2" id="coursePrice"
                                                name="price" value="{{ old('price') }}"
                                                placeholder="{{ __('enter_course_price') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('price') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Course Price -->

                                    <div
                                        class="col-lg-6 discountable_div {{ old('is_discountable') == 1 ? '' : 'd-none' }}">
                                        <div class="">
                                            <label for="discountType" class="form-label">{{ __('discount') }}</label>

                                            <div class="customDiscountField">
                                                <input type="text" class="form-control rounded-2" placeholder="e.g.20"
                                                    id="discountType" name="discount" value="{{ old('discount') }}">

                                                <div class="select-type-v2 selectField">
                                                    <select class="form-select form-select-lg mb-3 without_search"
                                                        name="discount_type">
                                                        <option value="">{{ __('select_discount_type') }}</option>
                                                        <option value="percent"
                                                            {{ old('discount_type') == 'percent' ? 'selected' : 'd-none' }}>
                                                            {{ __('percent') }}</option>
                                                        <option value="amount"
                                                            {{ old('discount_type') == 'amount' ? 'selected' : 'd-none' }}>
                                                            {{ __('amount') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('discount') }}</p>
                                            </div>
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('discount_type') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Discount Type -->

                                    <div
                                        class="col-lg-6 discountable_div {{ old('is_discountable') == 1 ? '' : 'd-none' }}">
                                        <div class="mb-20">
                                            <label for="dateRangePicker"
                                                class="form-label">{{ __('discount_period') }}</label>
                                            <input id="dateRangePicker" name="discount_period" type="text"
                                                class="form-control rounded-2" value="{{ old('discount_period') }}"
                                                placeholder="{{ __('select_date') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="dateRange_error error">{{ $errors->first('price') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Date Range Picker -->

                                    <div class="col-lg-6 renewable_div {{ old('is_renewable') == 1 ? '' : 'd-none' }}">
                                        <div class="">
                                            <div class="select-type-v2">
                                                <label for="renew_after"
                                                    class="form-label">{{ __('access_validity') }}</label>
                                                <input type="number" class="form-control rounded-2" id="renew_after"
                                                    name="renew_after" value="{{ old('renew_after') }}"
                                                    placeholder="e.g.90">
                                                <div class="nk-block-des text-danger">
                                                    <p class="dateRange_error error">{{ $errors->first('renew_after') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Access Validity -->

                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mt-30">
                                            <a href="#" type="button"
                                                class="btn sg-btn-outline-primary btn_action"
                                                data-bs-target="#courseMediaImages">{{ __('back') }}</a>

                                            <a href="#" type="button" class="btn sg-btn-primary btn_action"
                                                data-bs-target="#courseSEO">{{ __('next') }}</a>
                                        </div>
                                    </div>
                                    <!-- End Next Page BTN -->
                                </div>
                                <!-- End Product images section -->
                            </div>
                            <!-- End Course Pricing -->

                            <div class="tab-pane fade" id="courseSEO" role="tabpanel" aria-labelledby="seo"
                                tabindex="0">
                                <div class="row gx-20">
                                    @include('components.meta-fields', [
                                        'meta_title_class' => 'col-lg-6',
                                        'meta_description_class' => 'col-lg-12',
                                        'meta_keywords_class' => 'col-lg-6',
                                        'meta_image_class' => 'col-lg-12',
                                        'meta_title' => old('meta_title'),
                                        'meta_keywords' => old('meta_keywords'),
                                        'meta_description' => old('meta_description'),
                                        'meta_image' => old('meta_image'),
                                        'edit' => true,
                                    ])
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mt-30">
                                            <a href="#" type="button"
                                                class="btn sg-btn-outline-primary btn_action"
                                                data-bs-target="#coursePricing">{{ __('back') }}</a>

                                            <button type="submit" class="btn sg-btn-primary">{{ __(\'submit\') }}</button>
                                        </div>
                                    </div>
                                    <!-- End Next Page BTN -->
                                </div>
                            </div>
                            <!-- End Course SEO -->

                            
                        </div>
                    </form>
                </div>
                <!-- End Default Tab List -->
            </div>
        </div>
    </div>
    @include('backend.common.gallery-modal')
@endsection
@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ static_asset('admin/css/daterangepicker.css') }}">
@endpush
@push('js_asset')
    <!--====== media.js ======-->
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/moment.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/daterangepicker.js') }}"></script>
@endpush
@push('js')
    <script src="{{ static_asset('admin/js/media.js') }}"></script>
    <script src="{{ static_asset('admin/js/ai_writer.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#dateRangePicker').daterangepicker({
                autoUpdateInput: false
            });

            searchCategory($('#select_category'));
            searchSubjects($('#select_subject'));
            searchOrganization($('#ins_by_org'));
            $(document).on('input change', '#mc_total_seats_input', function () {
                let totalSeats = parseInt($(this).val()) || 0;
                let enrolled = parseInt($(this).data('enrolled')) || 0;
                let avail = Math.max(0, totalSeats - enrolled);
                
                let goldVal = $('#mc_gold_seats_input').val();
                if (goldVal && /\d+/.test(goldVal)) {
                    $('#mc_gold_seats_input').val(goldVal.replace(/\d+/, avail));
                } else {
                    $('#mc_gold_seats_input').val('আর মাত্র ' + avail + ' ??? ????');
                }
            });

            $(document).on('click', "#mgCourse-tabContent a.btn_action, .mc-step-btn", function(e) {
                e.preventDefault();
                let target = $(this).attr('data-bs-target');
                if (target) {
                    let navLink = document.querySelector('.nav-link[data-bs-target="' + target + '"]');
                    if (navLink) {
                        let tabInstance = bootstrap.Tab.getOrCreateInstance(navLink);
                        tabInstance.show();
                    }
                }
            });

            // Video Source & File Pickers
            $(document).on('change', "#video_source", function () {
                let video_source = $(this).val();
                if (!video_source) {
                    $('.video_link').addClass('d-none');
                    $('.upload_div').addClass('d-none');
                } else if (video_source == 'upload') {
                    $('.video_link').addClass('d-none');
                    $('.upload_div').removeClass('d-none');
                } else {
                    $('.video_link').removeClass('d-none');
                    $('.upload_div').addClass('d-none');
                }
            });

            $(document).on('change', ".thumb_picker", function (e) {
                let fileName = e.target.files[0] ? e.target.files[0].name : '{{ __("video") }}';
                $(this).closest('.mb-3').find('.file_name').text(fileName);
            });

            $(document).on('change', "#is_free", function () {
                let is_free = $(this).is(':checked');
                if (is_free) {
                    $('.not_free_div').addClass('d-none');
                    $('.discountable_div').addClass('d-none');
                    $("#discountable_course").prop('checked', false);
                } else {
                    $('.not_free_div').removeClass('d-none');
                }
            });

            $(document).on('change', "#discountable_course", function () {
                let is_discountable = $(this).is(':checked');
                if (is_discountable) {
                    $('.discountable_div').removeClass('d-none');
                } else {
                    $('.discountable_div').addClass('d-none');
                }
            });

            // Dynamic Benefit Repeater
            $('#add_new_benefit_btn').on('click', function () {
                let count = $('#benefits_items_container .benefit-single-item').length;
                let html = `
                    <div class="benefit-single-item d-flex align-items-center gap-2 mb-3">
                        <span class="badge bg-light text-dark border p-2 font-13"><span class="benefit-num">${count + 1}</span></span>
                        <input type="text" name="masterclass_settings[benefits_list][]" class="form-control rounded-2 bg-white" placeholder="সুবিধা / পয়েন্টটি লিখুন...">
                        <a href="javascript:void(0)" class="btn btn-sm text-danger border-0 remove-benefit-btn ms-1">
                            <i class="las la-trash-alt fs-5"></i>
                        </a>
                    </div>
                `;
                $('#benefits_items_container').append(html);
            });

            $(document).on('click', '.remove-benefit-btn', function () {
                $(this).closest('.benefit-single-item').remove();
                $('#benefits_items_container .benefit-single-item').each(function (idx) {
                    $(this).find('.benefit-num').text(idx + 1);
                });
            });

            // Dynamic Gold Card Info Point Repeater
            let goldPointCounter = $('#gold_points_container .gold-point-single-item').length;
            $('#add_new_gold_point_btn').on('click', function () {
                let idx = goldPointCounter++;
                let html = `
                    <div class="gold-point-single-item card border p-3 mb-3 bg-light rounded-2">
                        <div class="row gx-2 align-items-center">
                            <div class="col-md-3 col-12 mb-2 mb-md-0">
                                <label class="form-label small text-muted mb-1">Icon Class</label>
                                <input type="text" name="masterclass_settings[gold_info_points][${idx}][icon]" class="form-control rounded-2 bg-white"
                                       value="fas fa-check-circle" placeholder="e.g. fas fa-video">
                            </div>
                            <div class="col-md-4 col-12 mb-2 mb-md-0">
                                <label class="form-label small text-muted mb-1">Title / Label</label>
                                <input type="text" name="masterclass_settings[gold_info_points][${idx}][title]" class="form-control rounded-2 bg-white"
                                       placeholder="যেমন: Zoom লাইভ 104">
                            </div>
                            <div class="col-md-4 col-12 mb-2 mb-md-0">
                                <label class="form-label small text-muted mb-1">Subtitle / Value</label>
                                <input type="text" name="masterclass_settings[gold_info_points][${idx}][value]" class="form-control rounded-2 bg-white"
                                       placeholder="যেমন: অনলাইন সেশন / 4h 40min">
                            </div>
                            <div class="col-md-1 col-12 text-end">
                                <label class="form-label d-none d-md-block opacity-0 mb-1">Del</label>
                                <a href="javascript:void(0)" class="btn btn-sm text-danger border-0 remove-gold-point-btn">
                                    <i class="las la-trash-alt fs-4"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                `;
                $('#gold_points_container').append(html);
            });

            $(document).on('click', '.remove-gold-point-btn', function () {
                $(this).closest('.gold-point-single-item').remove();
            });
        });
    </script>
@endpush

