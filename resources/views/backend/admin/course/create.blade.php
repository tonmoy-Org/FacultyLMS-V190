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
                                    $defEyebrow = old('masterclass_settings.eyebrow_title', 'E-commerce à¦¶à§à¦°à§ à¦•à¦°à¦¾à¦° hidden path');
                                    $defPrimaryCta = old('masterclass_settings.primary_cta_text', 'à¦°à§‡à¦œà¦¿à¦¸à§à¦Ÿà§à¦°à§‡à¦¶à¦¨ à¦•à¦°à§à¦¨ à¦à¦–à¦¨à¦‡');
                                    $defVideoCaption = old('masterclass_settings.video_caption', 'à¦¬à¦¿à¦¸à§à¦¤à¦¾à¦°à¦¿à¦¤ à¦œà¦¾à¦¨à¦¤à§‡ à¦­à¦¿à¦¡à¦¿à¦“à¦Ÿà¦¿ à¦¦à§‡à¦–à§à¦¨');
                                    $defRemainingSeats = old('masterclass_settings.remaining_seats', '100');

                                    $defGoldBadgeTop = old('masterclass_settings.gold_badge_top', 'à¦à¦–à¦¨à¦‡ à¦¸à¦¿à¦Ÿ à¦¬à§à¦• à¦•à¦°à§à¦¨');
                                    $defZoomTitle = old('masterclass_settings.zoom_title', 'Zoom à¦²à¦¾à¦‡à¦­ 104');
                                    $defZoomSubtitle = old('masterclass_settings.zoom_subtitle', 'à¦…à¦¨à¦²à¦¾à¦‡à¦¨ à¦‡à¦¨à§à¦Ÿà¦¾à¦°à§‡à¦•à§à¦Ÿà¦¿à¦­ à¦¸à§‡à¦¶à¦¨');
                                    $defScheduleLabel = old('masterclass_settings.schedule_label', 'à¦¸à¦®à¦¯à¦¼ / à¦¸à¦®à¦¯à¦¼à¦¸à§‚à¦šà§€');
                                    $defScheduleValue = old('masterclass_settings.schedule_value', '2h 40min');
                                    $defLevelLabel = old('masterclass_settings.level_label', 'Level');
                                    $defLevelValue = old('masterclass_settings.level_value', 'beginner');
                                    $defGoldOfferTitle = old('masterclass_settings.gold_offer_title', 'à¦†à¦œà¦•à§‡à¦° à¦¸à§à¦ªà§‡à¦¶à¦¾à¦² à¦…à¦«à¦¾à¦°');
                                    $defOriginalPriceLabel = old('masterclass_settings.original_price_label', 'à¦®à§‚à¦² à¦ªà§à¦°à¦¾à¦‡à¦¸');
                                    $defGoldCtaText = old('masterclass_settings.gold_cta_text', 'à¦à¦–à¦¨à¦‡ à¦œà§Ÿà§‡à¦¨ à¦•à¦°à§à¦¨');
                                    $defGoldSeatsText = old('masterclass_settings.gold_seats_text', 'à¦†à¦° à¦®à¦¾à¦¤à§à¦° ' . $defRemainingSeats . ' à¦¸à¦¿à¦Ÿ à¦¬à¦¾à¦•à¦¿');

                                    $defBenefitsTitle = old('masterclass_settings.benefits_title', 'à¦šà¦²à§à¦¨ à¦à¦•à¦Ÿà§ à¦–à§à¦à¦œà§‡ à¦¬à§‡à¦° à¦•à¦°à¦¾à¦° à¦šà§‡à¦·à§à¦Ÿà¦¾ à¦•à¦°à¦¿ à¦¨à¦¿à¦šà§‡à¦° à¦¸à¦®à¦¸à§à¦¯à¦¾à¦—à§à¦²à§‹à¦° à¦•à§‹à¦¨à§‹ à¦à¦•à¦Ÿà¦¿ à¦¬à¦¾ à¦à¦•à¦¾à¦§à¦¿à¦• à¦¸à¦®à¦¸à§à¦¯à¦¾ à¦†à¦ªà¦¨à¦¾à¦° à¦¸à¦¾à¦¥à§‡ à¦®à¦¿à¦²à§‡ à¦•à¦¿à¦¨à¦¾?');
                                    $benefitsList = old('masterclass_settings.benefits_list', [
                                        'à¦®à¦¾à¦°à§à¦•à§‡à¦Ÿà¦ªà§à¦²à§‡à¦¸ à¦¥à§‡à¦•à§‡ à¦•à§à¦²à¦¾à¦¯à¦¼à§‡à¦¨à§à¦Ÿ à¦ªà¦¾à¦“à¦¯à¦¼à¦¾à¦° à¦œà¦¨à§à¦¯ à¦¸à¦‚à¦—à§à¦°à¦¾à¦® à¦•à¦°à¦›à§‡à¦¨? | à¦¬à¦¿à¦­à¦¿à¦¨à§à¦¨ à¦«à§à¦°à¦¿à¦²à§à¦¯à¦¾à¦¨à§à¦¸à¦¿à¦‚ à¦®à¦¾à¦°à§à¦•à§‡à¦Ÿà¦ªà§à¦²à§‡à¦¸à§‡ à¦†à¦ªà¦¨à¦¾à¦° à¦®à¦¤à§‹ à¦†à¦°à§‹ à¦¹à¦¾à¦œà¦¾à¦°à§‹ à¦«à§à¦°à¦¿à¦²à§à¦¯à¦¾à¦¨à§à¦¸à¦¾à¦° à¦¬à¦¾ à¦¸à¦¾à¦°à§à¦­à¦¿à¦¸ à¦ªà§à¦°à§‹à¦­à¦¾à¦‡à¦¡à¦¾à¦°à§‡à¦° à¦ªà§à¦°à§‹à¦«à¦¾à¦‡à¦² à¦°à¦¯à¦¼à§‡à¦›à§‡à¥¤ à¦†à¦ªà¦¨à¦¾à¦•à§‡ à¦¸à§‡à¦–à¦¾à¦¨à§‡ à¦¤à¦¾à¦¦à§‡à¦° à¦¸à¦¾à¦¥à§‡ à¦ªà§à¦°à¦¤à¦¿à¦¯à§‹à¦—à¦¿à¦¤à¦¾ à¦•à¦°à¦¤à§‡ à¦¹à¦¯à¦¼à¥¤ à¦¹à¦¾à¦œà¦¾à¦°à§‹ à¦ªà§à¦°à§‹à¦«à¦¾à¦‡à¦²à§‡à¦° à¦­à¦¿à¦¡à¦¼à§‡ à¦†à¦ªà¦¨à¦¾à¦° à¦ªà§à¦°à§‹à¦«à¦¾à¦‡à¦²à¦Ÿà¦¿ à¦¯à¦¦à¦¿ à¦•à§à¦²à¦¾à¦¯à¦¼à§‡à¦¨à§à¦Ÿà§‡à¦° à¦šà§‹à¦–à§‡ à¦¨à¦¾ à¦ªà§œà§‡, à¦¤à¦¾à¦¹à¦²à§‡ à¦¸à§‡à¦–à¦¾à¦¨ à¦¥à§‡à¦•à§‡ à¦•à¦¾à¦œ à¦ªà¦¾à¦“à§Ÿà¦¾ à¦•à¦ à¦¿à¦¨ à¦¹à§Ÿà§‡ à¦ªà§œà§‡à¥¤ à¦†à¦° à¦†à¦ªà¦¨à¦¿ à¦¯à¦¦à¦¿ à¦†à¦‰à¦Ÿ à¦…à¦« à¦®à¦¾à¦°à§à¦•à§‡à¦Ÿà¦ªà§à¦²à§‡à¦¸ à¦•à§à¦²à¦¾à¦¯à¦¼à§‡à¦¨à§à¦Ÿà¦•à§‡ à¦Ÿà¦¾à¦°à§à¦—à§‡à¦Ÿ à¦•à¦°à¦¤à§‡ à¦ªà¦¾à¦°à§‡à¦¨ à¦¤à¦¬à§‡ à¦•à§à¦²à¦¾à¦¯à¦¼à§‡à¦¨à§à¦Ÿ à¦ªà¦¾à¦“à§Ÿà¦¾ à¦†à¦ªà¦¨à¦¾à¦° à¦œà¦¨à§à¦¯ à¦…à¦¨à§‡à¦• à¦¸à¦¹à¦œ à¦¹à§Ÿà§‡ à¦¯à¦¾à§Ÿà¥¤',
                                        'à¦•à§à¦²à¦¾à¦¯à¦¼à§‡à¦¨à§à¦Ÿ à¦ªà§‡à¦¤à§‡ à¦¬à¦¾à¦°à¦¬à¦¾à¦° à¦°à¦¿à¦œà§‡à¦•à§à¦Ÿ à¦¹à¦šà§à¦›à§‡à¦¨? | à¦¬à¦¾à¦°à¦¬à¦¾à¦° à¦°à¦¿à¦œà§‡à¦•à¦¶à¦¨ à¦¹à¦“à¦¯à¦¼à¦¾ à¦¹à¦¤à¦¾à¦¶à¦¾à¦œà¦¨à¦• à¦¤à¦¬à§‡ à¦à¦° à¦ªà§‡à¦›à¦¨à§‡ à¦²à§à¦•à¦¿à¦¯à¦¼à§‡ à¦¥à¦¾à¦•à¦¤à§‡ à¦ªà¦¾à¦°à§‡ à¦†à¦ªà¦¨à¦¾à¦° à¦ªà§à¦°à¦¾à¦‡à¦¸à¦¿à¦‚ à¦®à¦¡à§‡à¦², à¦ªà§à¦°à§‹à¦«à¦¾à¦‡à¦² à¦…à¦ªà¦Ÿà¦¿à¦®à¦¾à¦‡à¦œà§‡à¦¶à¦¨, à¦¬à¦¾ à¦¡à§à¦°à¦¾à¦«à¦Ÿ à¦ªà¦¿à¦šà¦¿à¦‚à¦¯à¦¼à§‡à¦° à¦­à§à¦² à¦•à§Œà¦¶à¦²à¥¤ à¦†à¦®à¦°à¦¾ à¦à¦‡ à¦«à¦¾à¦¨à§‡à¦²à¦—à§à¦²à§‹ à¦•à¦¿à¦­à¦¾à¦¬à§‡ à¦•à¦¾à¦Ÿà¦¿à¦¯à¦¼à§‡ à¦‰à¦ à¦¤à§‡ à¦¹à¦¯à¦¼ à¦à¦¬à¦‚ à¦•à§à¦²à¦¾à¦¯à¦¼à§‡à¦¨à§à¦Ÿà§‡à¦° à¦¸à¦¾à¦¥à§‡ à¦•à¦¿à¦­à¦¾à¦¬à§‡ à¦à¦•à¦Ÿà¦¿ à¦Ÿà§à¦°à¦¾à¦¸à§à¦Ÿà§‡à¦¡ à¦¸à¦®à§à¦ªà¦°à§à¦• à¦¤à§ˆà¦°à¦¿ à¦•à¦°à¦¤à§‡ à¦¹à¦¯à¦¼, à¦¤à¦¾ à¦¶à§‡à¦–à¦¾à¦¬à¥¤',
                                        'à¦†à¦¯à¦¼à§‡à¦° à¦‰à¦ªà¦° à¦®à¦¾à¦°à§à¦•à§‡à¦Ÿà¦ªà§à¦²à§‡à¦¸ à¦…à¦¤à¦¿à¦°à¦¿à¦•à§à¦¤ à¦«à¦¿ à¦•à¦¾à¦Ÿà¦›à§‡? | à¦®à¦¾à¦°à§à¦•à§‡à¦Ÿà¦ªà§à¦²à§‡à¦¸à§‡à¦° à¦ªà§à¦²à§à¦¯à¦¾à¦Ÿà¦«à¦°à§à¦®à¦—à§à¦²à§‹ à¦ªà§à¦°à¦¤à¦¿à¦Ÿà¦¿ à¦†à¦¯à¦¼à§‡à¦° à¦à¦•à¦Ÿà¦¿ à¦¬à¦¡à¦¼ à¦…à¦‚à¦¶ à¦«à¦¿ à¦¹à¦¿à¦¸à§‡à¦¬à§‡ à¦•à§‡à¦Ÿà§‡ à¦¨à§‡à¦¯à¦¼à¥¤ à¦à¦Ÿà¦¿ à¦…à¦¨à§‡à¦• à¦«à§à¦°à¦¿à¦²à§à¦¯à¦¾à¦¨à§à¦¸à¦¾à¦°à§‡à¦° à¦œà¦¨à§à¦¯ à¦¹à¦¤à¦¾à¦¶à¦¾à¦° à¦•à¦¾à¦°à¦£à¥¤ à¦†à¦®à¦°à¦¾ à¦¯à§‡à¦¹à§‡à¦¤à§ à¦¶à¦¿à¦–à¦¬ à¦•à¦¿à¦­à¦¾à¦¬à§‡ à¦®à¦¾à¦°à§à¦•à§‡à¦Ÿà¦ªà§à¦²à§‡à¦¸à§‡à¦° à¦¬à¦¾à¦‡à¦°à§‡ à¦•à§à¦²à¦¾à¦¯à¦¼à§‡à¦¨à§à¦Ÿ à¦–à§à¦à¦œà§‡ à¦ªà¦¾à¦“à¦¯à¦¼à¦¾ à¦¯à¦¾à¦¯à¦¼, à¦¤à¦¾ à¦ à¦«à¦¿ à¦—à§à¦£à¦¾ à¦¬à¦¨à§à¦§ à¦¸à¦®à§à¦­à¦¬ à¦¹à¦¬à§‡à¥¤',
                                        'à¦†à¦ªà¦¨à¦¾à¦° à¦†à¦‰à¦Ÿà¦°à¦¿à¦š à¦‡à¦®à§‡à¦‡à¦² à¦•à§‹à¦¨à§‹ à¦°à§‡à¦¸à¦ªà¦¨à§à¦¸ à¦ªà¦¾à¦šà§à¦›à§‡ à¦¨à¦¾? | à¦†à¦‰à¦Ÿà¦°à¦¿à¦š à¦‡à¦®à§‡à¦‡à¦²à¦—à§à¦²à§‹à¦° à¦•à§‹à¦¨à§‹ à¦œà¦¬à¦¾à¦¬ à¦¨à¦¾ à¦ªà¦¾à¦“à¦¯à¦¼à¦¾ à¦®à¦¾à¦¨à§‡ à¦¸à§‡à¦–à¦¾à¦¨à§‡ à¦•à¦¿à¦›à§ à¦˜à¦¾à¦Ÿà¦¤à¦¿ à¦†à¦›à§‡à¥¤ à¦à¦Ÿà¦¾ à¦¹à¦¤à§‡ à¦ªà¦¾à¦°à§‡ à¦†à¦ªà¦¨à¦¾à¦° à¦®à§‡à¦¸à§‡à¦œà§‡à¦° à¦­à§à¦² à¦Ÿà§‹à¦¨, à¦…à¦¸à¦®à§à¦ªà§‚à¦°à§à¦£ à¦®à§‡à¦¸à§‡à¦œ, à¦¬à¦¾ à¦­à§à¦² à¦Ÿà¦¾à¦°à§à¦—à§‡à¦Ÿà¦¿à¦‚à¥¤ à¦†à¦ªà¦¨à¦¿ à¦ à¦•à§‹à¦°à§à¦¸à§‡ à¦¶à¦¿à¦–à¦¬à§‡à¦¨ à¦•à¦¿à¦­à¦¾à¦¬à§‡ à¦¸à¦ à¦¿à¦•à¦­à¦¾à¦¬à§‡ à¦‡à¦®à§‡à¦‡à¦² à¦•à¦ªà¦¿ à¦²à¦¿à¦–à¦¤à§‡ à¦¹à¦¯à¦¼ à¦¯à¦¾ à¦•à§à¦²à¦¾à¦¯à¦¼à§‡à¦¨à§à¦Ÿà§‡à¦° à¦¦à§ƒà¦·à§à¦Ÿà¦¿ à¦†à¦•à¦°à§à¦·à¦£ à¦•à¦°à¦¬à§‡ à¦à¦¬à¦‚ à¦°à¦¿à¦ªà§à¦²à¦¾à¦‡ à¦ªà¦¾à¦“à¦¯à¦¼à¦¾à¦° à¦¸à¦®à§à¦­à¦¾à¦¬à¦¨à¦¾ à¦¬à¦¾à¦¡à¦¼à¦¾à¦¬à§‡à¥¤',
                                        'à¦†à¦ªà¦¨à¦¾à¦° à¦¸à§à¦•à¦¿à¦² à¦†à¦›à§‡, à¦•à¦¿à¦¨à§à¦¤à§ à¦•à§à¦²à¦¾à¦¯à¦¼à§‡à¦¨à§à¦Ÿ à¦¨à§‡à¦‡? | à¦•à§à¦²à¦¾à¦¯à¦¼à§‡à¦¨à§à¦Ÿ à¦¨à¦¾ à¦¥à¦¾à¦•à¦¾à¦° à¦®à¦¾à¦¨à§‡ à¦à¦‡ à¦¨à¦¯à¦¼ à¦¯à§‡ à¦†à¦ªà¦¨à¦¾à¦° à¦¸à§à¦•à¦¿à¦² à¦•à¦®à¥¤ à¦à¦Ÿà¦¾ à¦¹à¦¤à§‡ à¦ªà¦¾à¦°à§‡ à¦¸à¦ à¦¿à¦• à¦®à¦¾à¦°à§à¦•à§‡à¦Ÿà¦¿à¦‚ à¦“ à¦¨à§‡à¦Ÿà¦“à¦¯à¦¼à¦¾à¦°à§à¦•à¦¿à¦‚ à¦•à§Œà¦¶à¦²à§‡à¦° à¦…à¦­à¦¾à¦¬à¥¤ à¦†à¦ªà¦¨à¦¾à¦° à¦ªà§à¦°à¦¤à¦¿à¦­à¦¾ à¦¬à¦¾ à¦¦à¦•à§à¦·à¦¤à¦¾ à¦¥à¦¾à¦•à¦¾ à¦¸à¦¤à§à¦¤à§à¦¬à§‡à¦“ à¦¯à¦¦à¦¿ à¦•à¦¾à¦œ à¦¨à¦¾ à¦ªà¦¾à¦¨, à¦¤à¦¬à§‡ à¦à¦° à¦•à¦¾à¦°à¦£ à¦¹à¦¤à§‡ à¦ªà¦¾à¦°à§‡ à¦†à¦ªà¦¨à¦¾à¦° à¦†à¦‰à¦Ÿà¦°à¦¿à¦š à¦¸à§à¦Ÿà§à¦°à§à¦¯à¦¾à¦Ÿà§‡à¦œà¦¿ à¦¬à¦¾ à¦ªà§à¦°à§‹à¦«à¦¾à¦‡à¦² à¦…à¦ªà¦Ÿà¦¿à¦®à¦¾à¦‡à¦œà§‡à¦¶à¦¨à§‡à¦° à¦˜à¦¾à¦Ÿà¦¤à¦¿à¥¤ à¦†à¦®à¦°à¦¾ à¦¦à§‡à¦–à¦¾à¦¬ à¦•à¦¿à¦­à¦¾à¦¬à§‡ à¦¸à¦ à¦¿à¦• à¦ªà¦¦à§à¦§à¦¤à¦¿à¦¤à§‡ à¦•à§à¦²à¦¾à¦¯à¦¼à§‡à¦¨à§à¦Ÿà¦¦à§‡à¦° à¦•à¦¾à¦›à§‡ à¦ªà§Œà¦à¦›à¦¾à¦¤à§‡ à¦¹à¦¯à¦¼ à¦à¦¬à¦‚ à¦¤à¦¾à¦¦à§‡à¦° à¦ªà§à¦°à¦¯à¦¼à§‹à¦œà¦¨ à¦¬à§à¦à§‡ à¦…à¦«à¦¾à¦° à¦•à¦°à¦¤à§‡ à¦¹à¦¯à¦¼à¥¤'
                                    ]);

                                    $defGiftBadge = old('masterclass_settings.gift_badge', 'ðŸŽ à¦¯à¦¾à¦°à¦¾ join à¦•à¦°à¦¬à§‡à¦¨ à¦¤à¦¾à¦¦à§‡à¦° à¦œà¦¨à§à¦¯ special gift');
                                    $defGiftTitle = old('masterclass_settings.gift_title', 'à§³à§§à§¦,à§¦à§¦à§¦ à¦Ÿà¦¾à¦•à¦¾à¦° Ecom Dropshipping Mastery Course â€” à¦¸à¦®à§à¦ªà§‚à¦°à§à¦£ FREE à¦•à¦°à¦¾à¦° à¦¸à§à¦¯à§‹à¦—');
                                    $defGiftValue = old('masterclass_settings.gift_value', 'à§³à§§à§¦,à§¦à§¦à§¦');
                                    $defGiftDescription = old('masterclass_settings.gift_description', 'à¦à¦‡ master class-à¦ à¦¯à¦¾à¦°à¦¾ join à¦•à¦°à¦¬à§‡à¦¨, à¦¤à¦¾à¦°à¦¾ à¦†à¦®à¦¾à¦° à§³à§§à§¦,à§¦à§¦à§¦ à¦Ÿà¦¾à¦•à¦¾à¦° Ecom Dropshipping Mastery Course à¦Ÿà¦¾ free à¦¤à§‡ à¦•à¦°à¦¾à¦° à¦¸à§à¦¯à§‹à¦— à¦ªà¦¾à¦¬à§‡à¦¨à¥¤ à¦®à¦¾à¦¸à§à¦Ÿà¦¾à¦°à¦•à§à¦²à¦¾à¦¸à§‡ à¦à¦‡ à¦¬à¦¿à¦·à¦¯à¦¼à§‡ à¦¬à¦¿à¦¸à§à¦¤à¦¾à¦°à¦¿à¦¤ à¦†à¦²à§‹à¦šà¦¨à¦¾à¥¤');
                                    $defGiftQuote = old('masterclass_settings.gift_quote', '"à¦à¦‡ à¦•à§‹à¦°à§à¦¸à§‡ à¦†à¦®à¦¿ à¦‡-à¦•à¦®à¦¾à¦°à§à¦¸ à¦¬à¦¿à¦œà¦¨à§‡à¦¸, à¦¡à¦¿à¦œà¦¿à¦Ÿà¦¾à¦² à¦®à¦¾à¦°à§à¦•à§‡à¦Ÿà¦¿à¦‚ à¦à¦° à¦¬à¦¿à¦­à¦¿à¦¨à§à¦¨ à¦¬à¦¿à¦·à¦¯à¦¼ à¦¯à§‡à¦®à¦¨ Facebook Ads, Google Ads à¦¨à¦¿à¦¯à¦¼à§‡ à¦¬à¦¿à¦¸à§à¦¤à¦¾à¦°à¦¿à¦¤ à¦¶à¦¿à¦–à¦¿à¦¯à¦¼à§‡à¦›à¦¿à¥¤ à¦à¦›à¦¾à¦¡à¦¼à¦¾à¦“ à¦•à¦¿à¦­à¦¾à¦¬à§‡ à¦à¦•à¦Ÿà¦¾ à¦¬à¦¿à¦œà¦¨à§‡à¦¸à¦•à§‡ Scale à¦•à¦°à¦¤à§‡ à¦¤à¦¾ à¦¨à¦¿à¦¯à¦¼à§‡ à¦•à§à¦²à¦¾à¦¸ à¦†à¦›à§‡à¥¤"');
                                    $defGiftFooterNote = old('masterclass_settings.gift_footer_note', 'à¦¯à¦¾à¦°à¦¾ à¦à¦•à¦¦à¦® à¦¨à¦¤à§à¦¨ à¦†à¦›à§‡à¦¨ à¦¤à¦¾à¦°à¦¾à¦“ à¦à¦‡ à¦•à§‹à¦°à§à¦¸ à¦¥à§‡à¦•à§‡ à¦¬à§‡à¦¨à¦¿à¦«à¦¿à¦Ÿà§‡à¦¡ à¦¹à¦¤à§‡ à¦ªà¦¾à¦°à¦¬à§‡à¥¤');
                                    $defGiftCtaText = old('masterclass_settings.gift_cta_text', 'à¦¸à¦¿à¦Ÿ à¦•à¦¨à¦«à¦¾à¦°à§à¦® à¦•à¦°à§à¦¨ â†’');
                                    $defSupportTitle = old('masterclass_settings.support_title', 'à¦†à¦° à¦¸à¦¾à¦ªà§‹à¦°à§à¦Ÿ?');
                                    $defSupportDescription = old('masterclass_settings.support_description', '<p>à¦•à§‹à¦°à§à¦¸à§‡à¦° à¦Ÿà¦ªà¦¿à¦• à¦°à¦¿à¦²à§‡à¦Ÿà§‡à¦¡ à¦¯à§‡à¦•à§‹à¦¨à§‹ à¦ªà§à¦°à¦¬à¦²à§‡à¦® à¦«à§‡à¦¸ à¦•à¦°à¦²à§‡ à¦¸à¦°à¦¾à¦¸à¦°à¦¿ à¦¸à¦¾à¦ªà§‹à¦°à§à¦Ÿ à¦«à§‹à¦°à¦¾à¦® à¦…à¦¥à¦¬à¦¾ à¦†à¦®à¦¾à¦¦à§‡à¦° à¦®à§‡à¦¨à§à¦Ÿà¦° à¦Ÿà¦¿à¦® à¦¥à§‡à¦•à§‡ à¦‡à¦¨à¦¸à§à¦Ÿà§à¦¯à¦¾à¦¨à§à¦Ÿ à¦¹à§‡à¦²à§à¦ª à¦ªà¦¾à¦¬à§‡à¦¨à¥¤ à¦²à¦¾à¦‡à¦­ à¦¸à¦¾à¦ªà§‹à¦°à§à¦Ÿ à¦¸à§‡à¦¶à¦¨à§‡à¦° à¦®à¦¾à¦§à§à¦¯à¦®à§‡ à¦¯à§‡à¦•à§‹à¦¨à§‹ à¦Ÿà§‡à¦•à¦¨à¦¿à¦•à§à¦¯à¦¾à¦² à¦ªà§à¦°à¦¬à¦²à§‡à¦® à¦“à§Ÿà¦¾à¦¨ à¦Ÿà§ à¦“à§Ÿà¦¾à¦¨ à¦¸à¦²à¦­ à¦•à¦°à§‡ à¦¦à§‡à¦“à§Ÿà¦¾ à¦¹à¦¬à§‡à¥¤</p><p>à¦à¦‡ à¦¸à¦¾à¦ªà§‹à¦°à§à¦Ÿ à¦†à¦®à¦¾à¦¦à§‡à¦° à¦Ÿà¦¿à¦® à¦®à§‡à¦®à§à¦¬à¦¾à¦°à¦¦à§‡à¦° à¦ªà¦•à§à¦·à§‡ à¦¸à¦°à¦¾à¦¸à¦°à¦¿ à¦ªà§à¦°à§‹à¦­à¦¾à¦‡à¦¡ à¦•à¦°à¦¾ à¦¹à¦šà§à¦›à§‡, à¦¯à¦¾à¦¤à§‡ à¦•à¦°à§‡ à¦†à¦ªà¦¨à¦¿ à¦«à§‡à¦¸ à¦•à¦°à¦¾ à¦¯à§‡à¦•à§‹à¦¨à§‹ à¦¸à¦®à¦¸à§à¦¯à¦¾à¦° à¦¦à§à¦°à§à¦¤à¦¤à¦® à¦¸à¦®à§Ÿà§‡ à¦¨à¦¿à¦–à§à¦à¦¤ à¦¸à¦®à¦¾à¦§à¦¾à¦¨ à¦ªà§‡à¦¤à§‡ à¦ªà¦¾à¦°à§‡à¦¨à¥¤</p>');

                                    $defScheduleBadge = old('masterclass_settings.schedule_badge', 'LIVE ZOOM MASTERCLASS');
                                    $defClassScheduleTitle = old('masterclass_settings.class_schedule_title', 'à§¨ à¦¦à¦¿à¦¨à¦¬à§à¦¯à¦¾à¦ªà§€ e-commerce live masterclass');
                                    $defClassScheduleTime = old('masterclass_settings.class_schedule_time', 'à§¬ à¦†à¦—à¦¸à§à¦Ÿ à¦¤à¦¾à¦°à¦¿à¦– à¦°à¦¾à¦¤ à§® à¦Ÿà¦¾à¦¯à¦¼ à¦¶à§à¦°à§');

                                    $defExplainerTitle = old('masterclass_settings.explainer_title', 'à¦à¦•à¦Ÿà¦¾ à¦ªà§à¦°à¦¶à§à¦¨ à¦†à¦ªà¦¨à¦¾à¦° à¦®à¦¾à¦¥à¦¾à¦¯à¦¼ à¦†à¦¸à¦¤à§‡ à¦ªà¦¾à¦°à§‡ â€” à¦à¦¤ à¦•à¦¿à¦›à§, à¦®à¦¾à¦¤à§à¦° à§¯à§¯ à¦Ÿà¦¾à¦•à¦¾à¦¯à¦¼ à¦•à§‡à¦¨??');
                                    $defExplainerText = old('masterclass_settings.explainer_text', '<p>à¦Ÿà§ à¦¬à¦¿ à¦…à¦¨à§‡à¦¸à§à¦Ÿ, à¦†à¦®à¦¿ à¦à¦‡ masterclass-à¦Ÿà¦¾ à¦¸à¦®à§à¦ªà§‚à¦°à§à¦£ free à¦•à¦°à¦¾à¦¤à§‡ à¦šà§‡à¦¯à¦¼à§‡à¦›à¦¿à¦²à¦¾à¦®à¥¤</p><p>à¦•à¦¿à¦¨à§à¦¤à§ problem à¦¹à¦šà§à¦›à§‡ â€” à¦†à¦®à¦¾à¦° free session-à¦—à§à¦²à§‹à¦¤à§‡ à¦¦à§‡à¦–à¦¾ à¦¯à¦¾à¦¯à¦¼ à¦•à¦¯à¦¼à§‡à¦• à¦¹à¦¾à¦œà¦¾à¦° à¦®à¦¾à¦¨à§à¦· register à¦•à¦°à§‡ à¦¬à¦¾ join à¦•à¦°à§‡à¥¤ à¦¯à§‡à¦¹à§‡à¦¤à§ à¦à¦‡ session-à¦Ÿà¦¾ Zoom-à¦ live à¦¹à¦¬à§‡, à¦¤à¦¾à¦‡ à¦†à¦®à¦¿ à¦šà¦¾à¦‡à¦²à§‡à¦“ à¦à¦–à¦¾à¦¨à§‡ à¦¬à§‡à¦¶à¦¿ à¦®à¦¾à¦¨à§à¦· à¦¨à¦¿à¦¤à§‡ à¦ªà¦¾à¦°à¦¬ à¦¨à¦¾à¥¤ Seat limit à¦¥à¦¾à¦•à¦¬à§‡à¥¤</p><p>à¦¤à¦¾à¦‡ à¦†à¦®à¦¿ à¦à¦–à¦¾à¦¨à§‡ à¦›à§‹à¦Ÿà§à¦Ÿ à¦à¦•à¦Ÿà¦¾ token amount à¦°à§‡à¦–à§‡à¦›à¦¿ â€” à¦¶à§à¦§à§ audience filter à¦•à¦°à¦¾à¦° à¦œà¦¨à§à¦¯à¥¤ à¦¯à§‡à¦¨ à¦à¦‡ masterclass-à¦ à¦¤à¦¾à¦°à¦¾à¦‡ join à¦•à¦°à§‡, à¦¯à¦¾à¦°à¦¾ à¦¸à¦¤à§à¦¯à¦¿à¦‡ e-commerce business à¦¶à§à¦°à§ à¦•à¦°à¦¾à¦° à¦¬à§à¦¯à¦¾à¦ªà¦¾à¦°à§‡ serious à¦à¦¬à¦‚ step-by-step process-à¦Ÿà¦¾ à¦®à¦¨à§‹à¦¯à§‹à¦— à¦¦à¦¿à¦¯à¦¼à§‡ à¦¶à¦¿à¦–à¦¤à§‡ readyà¥¤</p>');

                                    $defBreakdownSubheading = old('masterclass_settings.breakdown_subheading', 'à¦à¦‡ $15.00 à¦Ÿà¦¾à¦•à¦¾à¦¯à¦¼ à¦†à¦ªà¦¨à¦¿ à¦ªà¦¾à¦šà§à¦›à§‡à¦¨:');
                                    $defBreakdownTodayTitle = old('masterclass_settings.breakdown_today_title', 'à¦†à¦œà¦•à§‡à¦° à¦®à§‚à¦²à§à¦¯ (token)');
                                    $defBreakdownItems = old('masterclass_settings.breakdown_items', "ðŸŽ“ à§¨ à¦¦à¦¿à¦¨à§‡à¦° live masterclass â€” à¦¸à¦®à§à¦ªà§‚à¦°à§à¦£ roadmap à¦¸à¦¹ | à§³à§©,à§¦à§¦à§¦
ðŸŽ Ecom Dropshipping Mastery Course free à¦ªà¦¾à¦“à§Ÿà¦¾à¦° à¦¸à§à¦¯à§‹à¦— | à§³à§§à§¦,à§¦à§¦à§¦");

                                    $defOrderFormTitle = old('masterclass_settings.order_form_title', 'à¦®à¦¾à¦¸à§à¦Ÿà¦¾à¦°à¦•à§à¦²à¦¾à¦¸à§‡ à¦œà¦¯à¦¼à§‡à¦¨ à¦•à¦°à¦¤à§‡ à¦¨à¦¿à¦šà§‡à¦° à¦«à¦°à§à¦®à¦Ÿà¦¿ à¦ªà§‚à¦°à¦£ à¦•à¦°à§à¦¨');
                                    $defOrderFormSubtitle = old('masterclass_settings.order_form_subtitle', 'Give valid information');
                                    $defNameLabel = old('masterclass_settings.name_label', 'Your Full Name');
                                    $defNamePlaceholder = old('masterclass_settings.name_placeholder', 'à¦†à¦ªà¦¨à¦¾à¦° à¦¸à¦®à§à¦ªà§‚à¦°à§à¦£ à¦¨à¦¾à¦®');
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
                                                       value="{{ $defBenefitsTitle }}" placeholder="à¦à¦‡ à¦®à¦¾à¦¸à§à¦Ÿà¦¾à¦°à¦•à§à¦²à¦¾à¦¸ à¦•à¦¾à¦° à¦œà¦¨à§à¦¯?">
                                            </div>

                                            <label class="form-label mb-2">Benefit Points (à¦à¦‡ à¦®à¦¾à¦¸à§à¦Ÿà¦¾à¦°à¦•à§à¦²à¦¾à¦¸ à¦•à¦¾à¦° à¦•à¦¾à¦° à¦œà¦¨à§à¦¯)</label>
                                            <div id="benefits_items_container">
                                                @foreach($benefitsList as $bIdx => $bItem)
                                                    <div class="benefit-single-item d-flex align-items-center gap-2 mb-3">
                                                        <span class="badge bg-light text-dark border p-2 font-13"><span class="benefit-num">{{ $bIdx + 1 }}</span></span>
                                                        <input type="text" name="masterclass_settings[benefits_list][]" class="form-control rounded-2 bg-white"
                                                               value="{{ $bItem }}" placeholder="à¦¸à§à¦¬à¦¿à¦§à¦¾ / à¦ªà¦¯à¦¼à§‡à¦¨à§à¦Ÿà¦Ÿà¦¿ à¦²à¦¿à¦–à§à¦¨...">
                                                        <a href="javascript:void(0)" class="btn btn-sm text-danger border-0 remove-benefit-btn ms-1">
                                                            <i class="las la-trash-alt fs-5"></i>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                     </div>

                                     <!-- Section: Feature / Overview Highlight (Image Left, Text Right) -->
                                     <div class="card border mb-4 rounded-3 shadow-sm">
                                         <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                                             <span class="form-label font-16 fw-normal text-dark m-0">Feature / Overview Highlight Section (Image Left, Text Right)</span>
                                             <div class="form-check form-switch mb-0">
                                                 <input class="form-check-input" type="checkbox" name="masterclass_settings[hide_overview_section]" value="1" id="create_hide_overview" {{ $defHideOverviewSection ? 'checked' : '' }}>
                                                 <label class="form-check-label text-muted small" for="create_hide_overview">Hide Section</label>
                                             </div>
                                         </div>
                                         <div class="card-body p-4">
                                             <div class="row gx-20">
                                                 <div class="col-lg-6 col-md-6 mb-4">
                                                     <label class="form-label">Eyebrow / Tag Text</label>
                                                     <input type="text" name="masterclass_settings[overview_tag]" class="form-control rounded-2"
                                                            value="{{ $defOverviewTag }}" placeholder="FEATURED COURSE">
                                                 </div>

                                                 <div class="col-lg-6 col-md-6 mb-4">
                                                     <label class="form-label">Section Title</label>
                                                     <input type="text" name="masterclass_settings[overview_title]" class="form-control rounded-2"
                                                            value="{{ $defOverviewTitle }}" placeholder="Master Web Development With Expert Guidance">
                                                 </div>

                                                 <div class="col-lg-12 mb-4">
                                                     <label class="form-label">Description Paragraph 1</label>
                                                     <textarea name="masterclass_settings[overview_desc1]" class="form-control rounded-2 summernote" rows="2"
                                                               placeholder="Enter description paragraph 1">{{ $defOverviewDesc1 }}</textarea>
                                                 </div>

                                                 <div class="col-lg-12 mb-4">
                                                     <label class="form-label">Description Paragraph 2</label>
                                                     <textarea name="masterclass_settings[overview_desc2]" class="form-control rounded-2 summernote" rows="2"
                                                               placeholder="Enter description paragraph 2">{{ $defOverviewDesc2 }}</textarea>
                                                 </div>

                                                 <div class="col-lg-6 col-md-6 mb-4">
                                                     <label class="form-label">Button Text</label>
                                                     <input type="text" name="masterclass_settings[overview_btn_text]" class="form-control rounded-2"
                                                            value="{{ $defOverviewBtnText }}" placeholder="ENROLL NOW">
                                                 </div>

                                                 <div class="col-lg-6 col-md-6 mb-4">
                                                     <label class="form-label">Button Link URL</label>
                                                     <input type="text" name="masterclass_settings[overview_btn_url]" class="form-control rounded-2"
                                                            value="{{ $defOverviewBtnUrl }}" placeholder="#register">
                                                 </div>

                                                 <div class="col-lg-12 mb-4">
                                                     <label class="form-label mb-2">Section Image (Image on Left Side)</label>
                                                     <div class="row align-items-center">
                                                         <div class="col-lg-6 mb-2">
                                                             <label class="small text-muted mb-1">Upload New Image File:</label>
                                                             <input type="file" name="overview_image_file" class="form-control rounded-2" accept="image/*">
                                                         </div>
                                                         <div class="col-lg-6 mb-2">
                                                             <label class="small text-muted mb-1">Or Image URL / Link:</label>
                                                             <input type="text" name="masterclass_settings[overview_image_url_custom]" class="form-control rounded-2"
                                                                    value="{{ $defOverviewImageUrl }}" placeholder="https://example.com/image.jpg">
                                                         </div>
                                                     </div>
                                                     @if(!empty($defOverviewImageUrl))
                                                         <div class="mt-2">
                                                             <label class="small text-muted d-block mb-1">Current Image Preview:</label>
                                                             <img src="{{ $defOverviewImageUrl }}" alt="Overview Image Preview" class="rounded border" style="max-height: 110px; object-fit: cover;">
                                                         </div>
                                                     @endif
                                                 </div>
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
                                                           value="{{ $defGiftBadge }}" placeholder="ðŸŽ à¦¯à¦¾à¦°à¦¾ join à¦•à¦°à¦¬à§‡à¦¨ à¦¤à¦¾à¦¦à§‡à¦° à¦œà¦¨à§à¦¯ special gift">
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label">Gift Title</label>
                                                    <input type="text" name="masterclass_settings[gift_title]" class="form-control rounded-2"
                                                           value="{{ $defGiftTitle }}" placeholder="à§³à§§à§¦,à§¦à§¦à§¦ à¦Ÿà¦¾à¦•à¦¾à¦° Ecom Dropshipping Mastery Course â€” à¦¸à¦®à§à¦ªà§‚à¦°à§à¦£ FREE à¦•à¦°à¦¾à¦° à¦¸à§à¦¯à§‹à¦—">
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label">Original Gift Value</label>
                                                    <input type="text" name="masterclass_settings[gift_value]" class="form-control rounded-2"
                                                           value="{{ $defGiftValue }}" placeholder="à§³à§§à§¦,à§¦à§¦à§¦">
                                                </div>

                                                <div class="col-lg-12 col-md-12 mb-4">
                                                    <label class="form-label">Gift Description</label>
                                                    <textarea name="masterclass_settings[gift_description]" class="form-control rounded-2 summernote" rows="3"
                                                              placeholder="à¦à¦‡ master class-à¦ à¦¯à¦¾à¦°à¦¾ join à¦•à¦°à¦¬à§‡à¦¨, à¦¤à¦¾à¦°à¦¾ à¦†à¦®à¦¾à¦° à§³à§§à§¦,à§¦à§¦à§¦ à¦Ÿà¦¾à¦•à¦¾à¦° Ecom Dropshipping Mastery Course à¦Ÿà¦¾ free à¦¤à§‡ à¦•à¦°à¦¾à¦° à¦¸à§à¦¯à§‹à¦— à¦ªà¦¾à¦¬à§‡à¦¨...">{{ $defGiftDescription }}</textarea>
                                                </div>

                                                <div class="col-lg-12 col-md-12 mb-4">
                                                    <label class="form-label">Gift Quote Callout Box</label>
                                                    <textarea name="masterclass_settings[gift_quote]" class="form-control rounded-2 summernote" rows="3"
                                                              placeholder="à¦à¦‡ à¦•à§‹à¦°à§à¦¸à§‡ à¦†à¦®à¦¿ à¦‡-à¦•à¦®à¦¾à¦°à§à¦¸ à¦¬à¦¿à¦œà¦¨à§‡à¦¸, à¦¡à¦¿à¦œà¦¿à¦Ÿà¦¾à¦² à¦®à¦¾à¦°à§à¦•à§‡à¦Ÿà¦¿à¦‚ à¦à¦° à¦¬à¦¿à¦­à¦¿à¦¨à§à¦¨ à¦¬à¦¿à¦·à¦¯à¦¼ à¦¨à¦¿à¦¯à¦¼à§‡ à¦†à¦²à§‹à¦šà¦¨à¦¾ à¦•à¦°à§‡à¦›à¦¿...">{{ $defGiftQuote }}</textarea>
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label">Gift Footer Note Text</label>
                                                    <input type="text" name="masterclass_settings[gift_footer_note]" class="form-control rounded-2"
                                                           value="{{ $defGiftFooterNote }}" placeholder="à¦¯à¦¾à¦°à¦¾ à¦à¦•à¦¦à¦® à¦¨à¦¤à§à¦¨ à¦†à¦›à§‡à¦¨ à¦¤à¦¾à¦°à¦¾à¦“ à¦à¦‡ à¦•à§‹à¦°à§à¦¸ à¦¥à§‡à¦•à§‡ à¦¬à§‡à¦¨à¦¿à¦«à¦¿à¦Ÿà§‡à¦¡ à¦¹à¦¤à§‡ à¦ªà¦¾à¦°à¦¬à§‡à¥¤">
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label">Gift Red CTA Button Text</label>
                                                    <input type="text" name="masterclass_settings[gift_cta_text]" class="form-control rounded-2"
                                                           value="{{ $defGiftCtaText }}" placeholder="à¦¸à¦¿à¦Ÿ à¦•à¦¨à¦«à¦¾à¦°à§à¦® à¦•à¦°à§à¦¨ â†’">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section 5: Live Schedule & Progress Bar -->
                                    <div class="card border mb-4 rounded-3 shadow-sm">
                                        <div class="card-header bg-white py-3">
                                            <span class="form-label font-16 fw-normal text-dark m-0"> Live Schedule & Progress Bar Section
                                            </span>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="row gx-20">
                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <label class="form-label">Schedule Pill Badge Text</label>
                                                    <input type="text" name="masterclass_settings[schedule_badge]" class="form-control rounded-2"
                                                           value="{{ $defScheduleBadge }}" placeholder="LIVE ZOOM MASTERCLASS">
                                                </div>

                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <label class="form-label">Live Schedule Headline</label>
                                                    <input type="text" name="masterclass_settings[class_schedule_title]" class="form-control rounded-2"
                                                           value="{{ $defClassScheduleTitle }}" placeholder="à§¨ à¦¦à¦¿à¦¨à¦¬à§à¦¯à¦¾à¦ªà§€ e-commerce live masterclass">
                                                </div>

                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <label class="form-label">Live Schedule Subtitle / Start Time</label>
                                                    <input type="text" name="masterclass_settings[class_schedule_time]" class="form-control rounded-2"
                                                           value="{{ $defClassScheduleTime }}" placeholder="à§¬ à¦†à¦—à¦¸à§à¦Ÿ à¦¤à¦¾à¦°à¦¿à¦– à¦°à¦¾à¦¤ à§® à¦Ÿà¦¾à¦¯à¦¼ à¦¶à§à¦°à§">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section 6: Token Fee Explainer Box -->
                                    <div class="card border mb-4 rounded-3 shadow-sm">
                                        <div class="card-header bg-white py-3">
                                            <span class="form-label font-16 fw-normal text-dark m-0"> Token Fee Explainer Box
                                            </span>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="row gx-20">
                                                <div class="col-12 mb-4">
                                                    <div class="custom-checkbox">
                                                        <label class="d-flex align-items-center gap-2 cursor-pointer">
                                                            <input type="checkbox" name="masterclass_settings[hide_explainer]" value="1" id="create_hide_exp"
                                                                {{ old('masterclass_settings.hide_explainer') == '1' ? 'checked' : '' }}>
                                                            <span class="text-dark font-16">Hide Token Fee Explainer Box</span>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-12 mb-4">
                                                    <label class="form-label">Explainer Heading Question</label>
                                                    <input type="text" name="masterclass_settings[explainer_title]" class="form-control rounded-2"
                                                           value="{{ $defExplainerTitle }}" placeholder="à¦à¦•à¦Ÿà¦¾ à¦ªà§à¦°à¦¶à§à¦¨ à¦†à¦ªà¦¨à¦¾à¦° à¦®à¦¾à¦¥à¦¾à¦¯à¦¼ à¦†à¦¸à¦¤à§‡ à¦ªà¦¾à¦°à§‡ â€” à¦à¦¤ à¦•à¦¿à¦›à§, à¦®à¦¾à¦¤à§à¦° à§¯à§¯ à¦Ÿà¦¾à¦•à¦¾à¦¯à¦¼ à¦•à§‡à¦¨??">
                                                </div>

                                                <div class="col-lg-12 col-md-12 mb-4">
                                                    <div class="editor-wrapper">
                                                        <label class="form-label mb-1">Explainer Content</label>
                                                        <textarea name="masterclass_settings[explainer_text]" class="form-control rounded-2 summernote" rows="5">{{ $defExplainerText }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section 7: Price Breakdown Table -->
                                    <div class="card border mb-4 rounded-3 shadow-sm">
                                        <div class="card-header bg-white py-3">
                                            <span class="form-label font-16 fw-normal text-dark m-0"> Price Breakdown Table
                                            </span>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="row gx-20">
                                                <div class="col-12 mb-4">
                                                    <div class="custom-checkbox">
                                                        <label class="d-flex align-items-center gap-2 cursor-pointer">
                                                            <input type="checkbox" name="masterclass_settings[hide_breakdown]" value="1" id="create_hide_bd"
                                                                {{ old('masterclass_settings.hide_breakdown') == '1' ? 'checked' : '' }}>
                                                            <span class="text-dark font-16">Hide Price Breakdown Table</span>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label">Breakdown Subheading Text</label>
                                                    <input type="text" name="masterclass_settings[breakdown_subheading]" class="form-control rounded-2"
                                                           value="{{ $defBreakdownSubheading }}" placeholder="à¦à¦‡ $15.00 à¦Ÿà¦¾à¦•à¦¾à¦¯à¦¼ à¦†à¦ªà¦¨à¦¿ à¦ªà¦¾à¦šà§à¦›à§‡à¦¨:">
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label">Today Token Price Table Title</label>
                                                    <input type="text" name="masterclass_settings[breakdown_today_title]" class="form-control rounded-2"
                                                           value="{{ $defBreakdownTodayTitle }}" placeholder="à¦†à¦œà¦•à§‡à¦° à¦®à§‚à¦²à§à¦¯ (token)">
                                                </div>

                                                <div class="col-lg-12 col-md-12 mb-4">
                                                    <label class="form-label">Breakdown Items (Format: Item Title | Price Value)</label>
                                                    <textarea name="masterclass_settings[breakdown_items]" class="form-control rounded-2 summernote" rows="4"
                                                              placeholder="ðŸŽ“ à§¨ à¦¦à¦¿à¦¨à§‡à¦° live masterclass â€” à¦¸à¦®à§à¦ªà§‚à¦°à§à¦£ roadmap à¦¸à¦¹ | à§³à§©,à§¦à§¦à§¦&#10;ðŸŽ Ecom Dropshipping Mastery Course free à¦ªà¦¾à¦“à§Ÿà¦¾à¦° à¦¸à§à¦¯à§‹à¦— | à§³à§§à§¦,à§¦à§¦à§¦">{{ $defBreakdownItems }}</textarea>
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
                                                           value="{{ $defOrderFormTitle }}" placeholder="à¦®à¦¾à¦¸à§à¦Ÿà¦¾à¦°à¦•à§à¦²à¦¾à¦¸à§‡ à¦œà¦¯à¦¼à§‡à¦¨ à¦•à¦°à¦¤à§‡ à¦¨à¦¿à¦šà§‡à¦° à¦«à¦°à§à¦®à¦Ÿà¦¿ à¦ªà§‚à¦°à¦£ à¦•à¦°à§à¦¨">
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
                                                           value="{{ $defNamePlaceholder }}" placeholder="à¦†à¦ªà¦¨à¦¾à¦° à¦¸à¦®à§à¦ªà§‚à¦°à§à¦£ à¦¨à¦¾à¦®">
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
                                                           value="{{ $defEmailPlaceholder }}" placeholder="à¦†à¦ªà¦¨à¦¾à¦° à¦‡à¦®à§‡à¦‡à¦² à¦à¦¡à§à¦°à§‡à¦¸">
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
                                                           value="{{ $mcSettings['support_title'] ?? $defSupportTitle }}" placeholder="à¦†à¦° à¦¸à¦¾à¦ªà§‹à¦°à§à¦Ÿ?">
                                                </div>

                                                <!-- Support Description -->
                                                <div class="col-lg-12 col-md-12 mb-4">
                                                    <label class="form-label">Support Description</label>
                                                    <textarea name="masterclass_settings[support_description]" class="form-control rounded-2 summernote" rows="3"
                                                              placeholder="à¦¸à¦¾à¦ªà§‹à¦°à§à¦Ÿà§‡à¦° à¦¬à¦¿à¦¸à§à¦¤à¦¾à¦°à¦¿à¦¤ à¦²à¦¿à¦–à§à¦¨...">{{ $mcSettings['support_description'] ?? $defSupportDescription }}</textarea>
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
                    $('#mc_gold_seats_input').val('à¦†à¦° à¦®à¦¾à¦¤à§à¦° ' + avail + ' à¦¸à¦¿à¦Ÿ à¦¬à¦¾à¦•à¦¿');
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
                        <input type="text" name="masterclass_settings[benefits_list][]" class="form-control rounded-2 bg-white" placeholder="à¦¸à§à¦¬à¦¿à¦§à¦¾ / à¦ªà¦¯à¦¼à§‡à¦¨à§à¦Ÿà¦Ÿà¦¿ à¦²à¦¿à¦–à§à¦¨...">
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
                                       placeholder="à¦¯à§‡à¦®à¦¨: Zoom à¦²à¦¾à¦‡à¦­ 104">
                            </div>
                            <div class="col-md-4 col-12 mb-2 mb-md-0">
                                <label class="form-label small text-muted mb-1">Subtitle / Value</label>
                                <input type="text" name="masterclass_settings[gold_info_points][${idx}][value]" class="form-control rounded-2 bg-white"
                                       placeholder="à¦¯à§‡à¦®à¦¨: à¦…à¦¨à¦²à¦¾à¦‡à¦¨ à¦¸à§‡à¦¶à¦¨ / 4h 40min">
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

