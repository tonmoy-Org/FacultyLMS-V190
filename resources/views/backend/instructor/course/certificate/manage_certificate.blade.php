@extends('backend.layouts.master')
@section('title', __('edit_certificate'))

@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ static_asset('admin/css/pfa_certificate.css') }}">
@endpush

@push('css')
    <style>
        .cert-info-title {
            font-weight: 400 !important;
            font-size: 16px;
            color: #2b3b33;
        }
        .cert-card-header {
            background: #f8faf9;
            border-bottom: 1px solid #eef2f0;
            padding: 14px 18px;
            border-radius: 8px 8px 0 0;
            font-weight: 400 !important;
            font-size: 14px;
            color: #2b3b33;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .cert-card-header span {
            font-weight: 400 !important;
        }
        .cert-form-group {
            margin-bottom: 16px;
        }
        .cert-form-group label,
        .cert-section-body label,
        .cert-section-body .form-label {
            font-weight: 400 !important;
            font-size: 13px;
            color: #445650;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .cert-form-group .form-control,
        .cert-section-body .form-control,
        .cert-section-body input,
        .cert-section-body textarea {
            border-radius: 6px;
            border: 1px solid #dbe2df;
            padding: 9px 13px;
            font-size: 13.5px;
            font-weight: 400 !important;
            transition: all 0.2s ease;
        }
        .cert-form-group .form-control:focus {
            border-color: #0d2e24;
            box-shadow: 0 0 0 3px rgba(13, 46, 36, 0.12);
        }
        .cert-section-box {
            background: #ffffff;
            border: 1px solid #e3eae7;
            border-radius: 8px;
            margin-bottom: 20px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
        }
        .cert-section-body {
            padding: 18px;
        }
        .preview-sticky-wrapper {
            position: sticky;
            top: 25px;
            z-index: 10;
        }
        .preview-badge-hint {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            background: #e8f5f0;
            color: #0d2e24;
            padding: 4px 10px;
            border-radius: 20px;
            font-weight: 400 !important;
        }
        @media (max-width: 575.98px) {
            .cert-top-header {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 12px !important;
            }
            .cert-top-header .section-title {
                font-size: 16px !important;
                line-height: 1.4 !important;
                word-break: break-word !important;
            }
            .cert-top-header .btn {
                align-self: flex-start !important;
            }
        }
    </style>
@endpush

@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 cert-top-header mb-20">
                        <h3 class="section-title mb-0 flex-grow-1 text-break">{{ __('edit_certificate') }} - {{ $course->title }}</h3>
                        <a href="{{ route('instructor.certificates.index') }}" class="btn btn-sm btn-outline-secondary flex-shrink-0 text-nowrap align-self-start align-self-sm-center">
                            <i class="las la-arrow-left me-1"></i> {{ __('back_to_list') }}
                        </a>
                    </div>

                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form action="{{ route('certificates.update', $course->id) }}" method="POST" class="form" id="certificateForm" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            <input type="hidden" name="title" id="hidden_title" value="{{ $course->certificate ? $course->certificate->title : $course->title }}">
                            <input type="hidden" name="body" id="hidden_body" value="{{ $course->certificate ? $course->certificate->body : ($course->title ?? 'Certificate of Completion') }}">

                            <div class="row gx-20">
                                <!-- LEFT COLUMN: EDITABLE FIELDS -->
                                <div class="col-xl-6 col-md-12">
                                    <div class="d-flex justify-content-between align-items-center mb-15">
                                        <h5 class="mb-0 cert-info-title"><i class="las la-sliders-h me-1 text-success"></i> {{ __('certificate_information') }}</h5>
                                        <span class="text-muted small"><i class="las la-eye me-1"></i> Changes update live on the preview</span>
                                    </div>

                                    <!-- 1. Header & Academy Branding -->
                                    <div class="cert-section-box">
                                        <div class="cert-card-header">
                                            <i class="las la-university text-success fs-5"></i>
                                            <span>{{ __('Academy & Header Information') }}</span>
                                        </div>
                                        <div class="cert-section-body">
                                            <div class="cert-form-group">
                                                <label for="input_org_name"><i class="las la-building text-muted"></i> {{ __('Organization / Academy Name') }}</label>
                                                <input type="text" class="form-control cert-sync" id="input_org_name" name="custom_fields[org_name]" 
                                                       data-target="#view_org_name" 
                                                       value="{{ $course->certificate ? $course->certificate->getField('org_name', 'Pro Freelancers Academy') : 'Pro Freelancers Academy' }}" 
                                                       placeholder="e.g. Pro Freelancers Academy">
                                            </div>

                                            <div class="cert-form-group">
                                                <label for="input_tagline"><i class="las la-compass text-muted"></i> {{ __('Tagline / Subtitle') }}</label>
                                                <input type="text" class="form-control cert-sync" id="input_tagline" name="custom_fields[tagline]" 
                                                       data-target="#view_tagline" 
                                                       value="{{ $course->certificate ? $course->certificate->getField('tagline', 'Journey To Make $1,000 Monthly') : 'Journey To Make $1,000 Monthly' }}" 
                                                       placeholder="e.g. Journey To Make $1,000 Monthly">
                                            </div>

                                            <div class="cert-form-group mb-0">
                                                <label for="input_certificate_title"><i class="las la-award text-muted"></i> {{ __('Certificate Main Title') }}</label>
                                                <input type="text" class="form-control cert-sync" id="input_certificate_title" name="custom_fields[certificate_title]" 
                                                       data-target="#view_certificate_title" 
                                                       value="{{ $course->certificate ? $course->certificate->getField('certificate_title', 'CERTIFICATE OF COMPLETION') : 'CERTIFICATE OF COMPLETION' }}" 
                                                       placeholder="e.g. CERTIFICATE OF COMPLETION">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 2. Recipient & Course Details -->
                                    <div class="cert-section-box">
                                        <div class="cert-card-header">
                                            <i class="las la-user-graduate text-success fs-5"></i>
                                            <span>{{ __('Recipient & Course Details') }}</span>
                                        </div>
                                        <div class="cert-section-body">
                                            <div class="cert-form-group">
                                                <label for="input_presented_to"><i class="las la-hand-holding-heart text-muted"></i> {{ __('Presentation Text') }}</label>
                                                <input type="text" class="form-control cert-sync" id="input_presented_to" name="custom_fields[presented_to]" 
                                                       data-target="#view_presented_to" 
                                                       value="{{ $course->certificate ? $course->certificate->getField('presented_to', 'This certificate is proudly presented to') : 'This certificate is proudly presented to' }}" 
                                                       placeholder="e.g. This certificate is proudly presented to">
                                            </div>

                                            <div class="cert-form-group">
                                                <label for="input_student_name"><i class="las la-signature text-muted"></i> {{ __('Student Name Placeholder (Preview)') }}</label>
                                                <input type="text" class="form-control cert-sync" id="input_student_name" name="custom_fields[student_name_preview]" 
                                                       data-target="#view_student_name" 
                                                       value="{{ $course->certificate ? $course->certificate->getField('student_name_preview', 'Student Full Name') : 'Student Full Name' }}" 
                                                       placeholder="e.g. Student Full Name">
                                                <span class="text-muted small mt-1 d-block"><i class="las la-info-circle"></i> On student downloads, their registered account name will appear automatically.</span>
                                            </div>

                                            <div class="cert-form-group">
                                                <label for="input_completion_text"><i class="las la-check-circle text-muted"></i> {{ __('Completion Statement') }}</label>
                                                <input type="text" class="form-control cert-sync" id="input_completion_text" name="custom_fields[completion_text]" 
                                                       data-target="#view_completion_text" 
                                                       value="{{ $course->certificate ? $course->certificate->getField('completion_text', 'for successfully completing the') : 'for successfully completing the' }}" 
                                                       placeholder="e.g. for successfully completing the">
                                            </div>

                                            <div class="cert-form-group mb-0">
                                                <label for="input_course_name"><i class="las la-graduation-cap text-muted"></i> {{ __('Course Name / Specialization') }}</label>
                                                <input type="text" class="form-control cert-sync" id="input_course_name" name="custom_fields[course_name]" 
                                                       data-target="#view_course_name" 
                                                       value="{{ $course->certificate ? $course->certificate->getField('course_name', ($course->title ?? 'FREELANCING MASTERY COURSE')) : ($course->title ?? 'FREELANCING MASTERY COURSE') }}" 
                                                       placeholder="e.g. FREELANCING MASTERY COURSE">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 3. Key Feature Badges (4 Pills) -->
                                    <div class="cert-section-box">
                                        <div class="cert-card-header">
                                            <i class="las la-tags text-success fs-5"></i>
                                            <span>{{ __('Key Feature Badges (4 Highlights)') }}</span>
                                        </div>
                                        <div class="cert-section-body">
                                            <div class="row gx-15">
                                                <div class="col-sm-6 cert-form-group">
                                                    <label for="input_badge_1"><i class="las la-rocket text-muted"></i> {{ __('Badge 1 (Rocket)') }}</label>
                                                    <input type="text" class="form-control cert-sync" id="input_badge_1" name="custom_fields[badge_1]" 
                                                           data-target="#view_badge_1" 
                                                           value="{{ $course->certificate ? $course->certificate->getField('badge_1', 'QUICK EARNING SYSTEM') : 'QUICK EARNING SYSTEM' }}" 
                                                           placeholder="QUICK EARNING SYSTEM">
                                                </div>

                                                <div class="col-sm-6 cert-form-group">
                                                    <label for="input_badge_2"><i class="lab la-youtube text-muted"></i> {{ __('Badge 2 (YouTube)') }}</label>
                                                    <input type="text" class="form-control cert-sync" id="input_badge_2" name="custom_fields[badge_2]" 
                                                           data-target="#view_badge_2" 
                                                           value="{{ $course->certificate ? $course->certificate->getField('badge_2', 'YOUTUBE AUTOMATION') : 'YOUTUBE AUTOMATION' }}" 
                                                           placeholder="YOUTUBE AUTOMATION">
                                                </div>

                                                <div class="col-sm-6 cert-form-group mb-sm-0">
                                                    <label for="input_badge_3"><i class="las la-microchip text-muted"></i> {{ __('Badge 3 (AI / Passive)') }}</label>
                                                    <input type="text" class="form-control cert-sync" id="input_badge_3" name="custom_fields[badge_3]" 
                                                           data-target="#view_badge_3" 
                                                           value="{{ $course->certificate ? $course->certificate->getField('badge_3', 'AI & PASSIVE INCOME') : 'AI & PASSIVE INCOME' }}" 
                                                           placeholder="AI & PASSIVE INCOME">
                                                </div>

                                                <div class="col-sm-6 cert-form-group mb-0">
                                                    <label for="input_badge_4"><i class="las la-laptop text-muted"></i> {{ __('Badge 4 (Digital Skills)') }}</label>
                                                    <input type="text" class="form-control cert-sync" id="input_badge_4" name="custom_fields[badge_4]" 
                                                           data-target="#view_badge_4" 
                                                           value="{{ $course->certificate ? $course->certificate->getField('badge_4', 'DIGITAL SKILLS') : 'DIGITAL SKILLS' }}" 
                                                           placeholder="DIGITAL SKILLS">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 4. Certificate Metadata Grid -->
                                    <div class="cert-section-box">
                                        <div class="cert-card-header">
                                            <i class="las la-info-circle text-success fs-5"></i>
                                            <span>{{ __('Certificate Metadata (ID & Dates)') }}</span>
                                        </div>
                                        <div class="cert-section-body">
                                            <div class="row gx-15">
                                                <div class="col-sm-6 cert-form-group">
                                                    <label for="input_certificate_id"><i class="las la-id-card text-muted"></i> {{ __('Certificate ID') }}</label>
                                                    <input type="text" class="form-control cert-sync" id="input_certificate_id" name="custom_fields[certificate_id]" 
                                                           data-target="#view_certificate_id" 
                                                           value="{{ $course->certificate ? $course->certificate->getField('certificate_id', 'PFA-2026-XXXXX') : 'PFA-2026-XXXXX' }}" 
                                                           placeholder="e.g. PFA-2026-XXXXX">
                                                </div>

                                                <div class="col-sm-6 cert-form-group">
                                                    <label for="input_issue_date"><i class="las la-calendar-check text-muted"></i> {{ __('Issue Date') }}</label>
                                                    <input type="text" class="form-control cert-sync" id="input_issue_date" name="custom_fields[issue_date]" 
                                                           data-target="#view_issue_date" 
                                                           value="{{ $course->certificate ? $course->certificate->getField('issue_date', 'DD / MM / YYYY') : 'DD / MM / YYYY' }}" 
                                                           placeholder="e.g. DD / MM / YYYY">
                                                </div>

                                                <div class="col-sm-6 cert-form-group mb-sm-0">
                                                    <label for="input_course_duration"><i class="las la-clock text-muted"></i> {{ __('Course Duration') }}</label>
                                                    <input type="text" class="form-control cert-sync" id="input_course_duration" name="custom_fields[course_duration]" 
                                                           data-target="#view_course_duration" 
                                                           value="{{ $course->certificate ? $course->certificate->getField('course_duration', 'XX HOURS') : 'XX HOURS' }}" 
                                                           placeholder="e.g. 24 HOURS">
                                                </div>

                                                <div class="col-sm-6 cert-form-group mb-0">
                                                    <label for="input_completion_date"><i class="las la-calendar text-muted"></i> {{ __('Completion Date') }}</label>
                                                    <input type="text" class="form-control cert-sync" id="input_completion_date" name="custom_fields[completion_date]" 
                                                           data-target="#view_completion_date" 
                                                           value="{{ $course->certificate ? $course->certificate->getField('completion_date', 'DD / MM / YYYY') : 'DD / MM / YYYY' }}" 
                                                           placeholder="e.g. DD / MM / YYYY">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 5. Signatures & Official Seal -->
                                    <div class="cert-section-box">
                                        <div class="cert-card-header">
                                            <i class="las la-stamp text-success fs-5"></i>
                                            <span>{{ __('Signatures & Official Seal') }}</span>
                                        </div>
                                        <div class="cert-section-body">
                                            <div class="row gx-15">
                                                <!-- Mentor Title & Upload -->
                                                <div class="col-sm-6 cert-form-group">
                                                    <label for="input_mentor_title"><i class="las la-user-tie text-muted"></i> {{ __('Left Designation / Title') }}</label>
                                                    <input type="text" class="form-control cert-sync" id="input_mentor_title" name="custom_fields[mentor_title]" 
                                                           data-target="#view_mentor_title" 
                                                           value="{{ $course->certificate ? $course->certificate->getField('mentor_title', 'MENTOR') : 'MENTOR' }}" 
                                                           placeholder="e.g. MENTOR">
                                                </div>

                                                <!-- Founder Title & Upload -->
                                                <div class="col-sm-6 cert-form-group">
                                                    <label for="input_founder_title"><i class="las la-user-shield text-muted"></i> {{ __('Right Designation / Title') }}</label>
                                                    <input type="text" class="form-control cert-sync" id="input_founder_title" name="custom_fields[founder_title]" 
                                                           data-target="#view_founder_title" 
                                                           value="{{ $course->certificate ? $course->certificate->getField('founder_title', 'FOUNDER / DIRECTOR') : 'FOUNDER / DIRECTOR' }}" 
                                                           placeholder="e.g. FOUNDER / DIRECTOR">
                                                </div>
                                            </div>

                                            <div class="row">
                                                @include('backend.common.media-input',[
                                                    'title' => __('Left (Mentor) Signature Image'),
                                                    'name'  => 'instructor_signature_media_id',
                                                    'col'   => 'col-12 mb-3',
                                                    'size'  => '(170x74)',
                                                    'label' => __('Left Signature (Transparent PNG recommended)'),
                                                    'image' => $course->certificate ? $course->certificate->instructor_signature : '',
                                                    'edit'  => $course->certificate ? $course->certificate : '',
                                                    'image_object'  => $course->certificate ? $course->certificate->instructor_signature : '',
                                                    'media_id'  => $course->certificate ? $course->certificate->instructor_signature_media_id : '',
                                                ])

                                                @include('backend.common.media-input',[
                                                    'title' => __('Right (Director) Signature Image'),
                                                    'name'  => 'administrator_signature_media_id',
                                                    'col'   => 'col-12 mb-3',
                                                    'size'  => '(170x74)',
                                                    'label' => __('Right Signature (Transparent PNG recommended)'),
                                                    'image' => $course->certificate ? $course->certificate->administrator_signature : '',
                                                    'edit'  => $course->certificate ? $course->certificate : '',
                                                    'image_object'  => $course->certificate ? $course->certificate->administrator_signature : '',
                                                    'media_id'  => $course->certificate ? $course->certificate->administrator_signature_media_id : '',
                                                ])

                                                @include('backend.common.media-input',[
                                                   'title' => __('Center Seal / Badge Image'),
                                                   'name'  => 'background_image_media_id',
                                                   'col'   => 'col-12 mb-3',
                                                   'size'  => '(84x85)',
                                                   'label' => __('Center Official Seal (Leave blank to use default Pro Freelancers Academy seal)'),
                                                   'image' => $course->certificate ? $course->certificate->background_image : '',
                                                   'edit'  => $course->certificate ? $course->certificate : '',
                                                   'image_object'  => $course->certificate ? $course->certificate->background_image : '',
                                                   'media_id'  => $course->certificate ? $course->certificate->background_image_media_id : '',
                                               ])
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 6. Footer & Website -->
                                    <div class="cert-section-box">
                                        <div class="cert-card-header">
                                            <i class="las la-globe text-success fs-5"></i>
                                            <span>{{ __('Footer Information') }}</span>
                                        </div>
                                        <div class="cert-section-body">
                                            <div class="cert-form-group mb-0">
                                                <label for="input_website_url"><i class="las la-link text-muted"></i> {{ __('Website URL') }}</label>
                                                <input type="text" class="form-control cert-sync" id="input_website_url" name="custom_fields[website_url]" 
                                                       data-target="#view_website_url" 
                                                       value="{{ $course->certificate ? $course->certificate->getField('website_url', 'profreelancersacademy.com') : 'profreelancersacademy.com' }}" 
                                                       placeholder="e.g. profreelancersacademy.com">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="d-flex justify-content-start align-items-center mt-20 mb-30">
                                        <button type="submit" class="btn sg-btn-primary btn-lg px-4" id="submitBtn">
                                            <i class="las la-save me-1"></i> {{ __('Save & Update Certificate') }}
                                        </button>
                                        @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary btn-lg px-4'])
                                    </div>
                                </div>

                                <!-- RIGHT COLUMN: LIVE CERTIFICATE PREVIEW -->
                                <div class="col-xl-6 col-md-12">
                                    <div class="preview-sticky-wrapper">
                                        <div class="d-flex justify-content-between align-items-center mb-15">
                                            <h5 class="mb-0 cert-info-title"><i class="las la-certificate me-1 text-success"></i> {{ __('preview') }}</h5>
                                            <span class="preview-badge-hint"><i class="las la-magic"></i> Live Interactive Preview</span>
                                        </div>

                                        <div class="card p-2 border-0 shadow-sm bg-light" style="border-radius: 10px;">
                                            @include('backend.admin.course.certificate.certificate_view', [
                                                'course' => $course,
                                                'certificate' => $course->certificate,
                                                'isPreview' => true
                                            ])
                                        </div>

                                        <div class="text-center text-muted small mt-2">
                                            <i class="las la-shield-alt text-success"></i> High-resolution vector layout matching Pro Freelancers Academy Certificate standard.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('backend.common.gallery-modal')
@endsection

@push('js_asset')
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/moment.min.js') }}"></script>
@endpush

@push('js')
    <script src="{{ static_asset('admin/js/media.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Live Real-Time Text Binding
            $('.cert-sync').on('input keyup change', function() {
                var target = $(this).data('target');
                var val = $(this).val();
                if (target) {
                    $(target).text(val);
                }

                if ($(this).attr('id') === 'input_course_name') {
                    $('#hidden_title').val(val);
                    $('#hidden_body').val(val);
                }
            });

            function checkMediaChanges() {
                var instImgSrc = $('input[name="instructor_signature_media_id"]').closest('.media-modal-parent').find('.media-image img').attr('src');
                if (instImgSrc && $('#view_instructor_signature').length) {
                    $('#view_instructor_signature').attr('src', instImgSrc);
                }

                var adminImgSrc = $('input[name="administrator_signature_media_id"]').closest('.media-modal-parent').find('.media-image img').attr('src');
                if (adminImgSrc && $('#view_administrator_signature').length) {
                    $('#view_administrator_signature').attr('src', adminImgSrc);
                }

                var sealImgSrc = $('input[name="background_image_media_id"]').closest('.media-modal-parent').find('.media-image img').attr('src');
                if (sealImgSrc && $('#view_seal_img').length) {
                    $('#view_seal_img').attr('src', sealImgSrc);
                }
            }

            setInterval(checkMediaChanges, 1000);
        });
    </script>
@endpush
