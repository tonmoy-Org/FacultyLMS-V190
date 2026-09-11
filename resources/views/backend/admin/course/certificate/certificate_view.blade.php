@php
    $cert = $certificate ?? ($course->certificate ?? null);
    $isLive = $isPreview ?? false;

    // Default values matching the provided reference image
    $orgName         = $cert ? $cert->getField('org_name', 'Pro Freelancers Academy') : 'Pro Freelancers Academy';
    $tagline         = $cert ? $cert->getField('tagline', 'Journey To Make $1,000 Monthly') : 'Journey To Make $1,000 Monthly';
    $certTitle       = $cert ? $cert->getField('certificate_title', 'CERTIFICATE OF COMPLETION') : 'CERTIFICATE OF COMPLETION';
    $presentedTo     = $cert ? $cert->getField('presented_to', 'This certificate is proudly presented to') : 'This certificate is proudly presented to';
    $studentNameVal  = $studentName ?? ($cert ? $cert->getField('student_name_preview', 'Student Full Name') : 'Student Full Name');
    $completionText  = $cert ? $cert->getField('completion_text', 'for successfully completing the') : 'for successfully completing the';
    $courseNameVal   = $cert ? $cert->getField('course_name', ($course->title ?? 'FREELANCING MASTERY COURSE')) : ($course->title ?? 'FREELANCING MASTERY COURSE');

    $badge1          = $cert ? $cert->getField('badge_1', 'QUICK EARNING SYSTEM') : 'QUICK EARNING SYSTEM';
    $badge2          = $cert ? $cert->getField('badge_2', 'YOUTUBE AUTOMATION') : 'YOUTUBE AUTOMATION';
    $badge3          = $cert ? $cert->getField('badge_3', 'AI & PASSIVE INCOME') : 'AI & PASSIVE INCOME';
    $badge4          = $cert ? $cert->getField('badge_4', 'DIGITAL SKILLS') : 'DIGITAL SKILLS';

    $certIdVal       = $certificateId ?? ($cert ? $cert->getField('certificate_id', 'PFA-2026-XXXXX') : 'PFA-2026-XXXXX');
    $issueDateVal    = $issueDate ?? ($cert ? $cert->getField('issue_date', 'DD / MM / YYYY') : 'DD / MM / YYYY');
    $durationVal     = $cert ? $cert->getField('course_duration', 'XX HOURS') : 'XX HOURS';
    $completionDateVal = $completionDate ?? ($cert ? $cert->getField('completion_date', 'DD / MM / YYYY') : 'DD / MM / YYYY');

    $mentorTitle     = $cert ? $cert->getField('mentor_title', 'MENTOR') : 'MENTOR';
    $founderTitle    = $cert ? $cert->getField('founder_title', 'FOUNDER / DIRECTOR') : 'FOUNDER / DIRECTOR';
    $websiteUrl      = $cert ? $cert->getField('website_url', 'profreelancersacademy.com') : 'profreelancersacademy.com';

    // Image links with fallback to extracted assets
    $instructorSignImg = ($cert && $cert->instructor_signature) 
        ? getFileLink('170x74', $cert->instructor_signature) 
        : static_asset('admin/certificate/pfa_mentor_signature.png');

    $adminSignImg = ($cert && $cert->administrator_signature) 
        ? getFileLink('170x74', $cert->administrator_signature) 
        : static_asset('admin/certificate/pfa_founder_signature.png');

    $sealImg = ($cert && $cert->background_image) 
        ? getFileLink('84x85', $cert->background_image) 
        : static_asset('admin/certificate/pfa_seal.png');
@endphp

<div class="pfa-cert-container" id="{{ $isLive ? 'pfaCertPreview' : 'pfaCertDisplay' }}">
    <!-- Ornamental Frame Background -->
    <img class="pfa-cert-frame-bg" src="{{ static_asset('admin/certificate/pfa_certificate_frame.png') }}" alt="Certificate Frame">

    <div class="pfa-cert-inner">

        <!-- Top Header Section -->
        <div class="pfa-header-block">
            <h1 class="pfa-org-name" @if($isLive) id="view_org_name" @endif>{{ $orgName }}</h1>
            <div class="pfa-divider-top">
                <img src="{{ static_asset('admin/certificate/divider_top.png') }}" alt="Divider">
            </div>
            <div class="pfa-tagline" @if($isLive) id="view_tagline" @endif>{{ $tagline }}</div>
            <div class="pfa-divider-sub">
                <img src="{{ static_asset('admin/certificate/divider_sub.png') }}" alt="Divider">
            </div>
        </div>

        <!-- Certificate Title with Left and Right Filigrees -->
        <div class="pfa-title-wrap">
            <img class="pfa-flourish-left" src="{{ static_asset('admin/certificate/flourish_title_left.png') }}" alt="Flourish">
            <h2 class="pfa-cert-title" @if($isLive) id="view_certificate_title" @endif>{{ $certTitle }}</h2>
            <img class="pfa-flourish-right" src="{{ static_asset('admin/certificate/flourish_title_right.png') }}" alt="Flourish">
        </div>

        <!-- Presented To Text -->
        <div class="pfa-presented-to" @if($isLive) id="view_presented_to" @endif>{{ $presentedTo }}</div>

        <!-- Recipient Student Name -->
        <div class="pfa-student-wrap">
            <div class="pfa-student-name" @if($isLive) id="view_student_name" @endif>{{ $studentNameVal }}</div>
            <div class="pfa-student-underline"></div>
        </div>

        <!-- Completion Text and Course Title flanked by Laurels -->
        <div class="pfa-course-wrap">
            <img class="pfa-laurel-left" src="{{ static_asset('admin/certificate/laurel_left.png') }}" alt="Laurel">
            <div class="pfa-course-text-col">
                <div class="pfa-completion-text" @if($isLive) id="view_completion_text" @endif>{{ $completionText }}</div>
                <div class="pfa-course-name" @if($isLive) id="view_course_name" @endif>{{ $courseNameVal }}</div>
            </div>
            <img class="pfa-laurel-right" src="{{ static_asset('admin/certificate/laurel_right.png') }}" alt="Laurel">
        </div>

        <!-- 4 Badges Row -->
        <div class="pfa-badges-row">
            <div class="pfa-badge-item">
                <span class="pfa-badge-icon">
                    <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"></path>
                        <path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"></path>
                        <path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0"></path>
                        <path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5"></path>
                    </svg>
                </span>
                <span class="pfa-badge-text" @if($isLive) id="view_badge_1" @endif>{{ $badge1 }}</span>
            </div>

            <div class="pfa-badge-divider"></div>

            <div class="pfa-badge-item">
                <span class="pfa-badge-icon">
                    <svg viewBox="0 0 24 24" width="13" height="13" fill="currentColor">
                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                    </svg>
                </span>
                <span class="pfa-badge-text" @if($isLive) id="view_badge_2" @endif>{{ $badge2 }}</span>
            </div>

            <div class="pfa-badge-divider"></div>

            <div class="pfa-badge-item">
                <span class="pfa-badge-icon">
                    <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                        <rect x="9" y="9" width="6" height="6"></rect>
                        <path d="M15 2v2"></path><path d="M15 20v2"></path>
                        <path d="M2 15h2"></path><path d="M2 9h2"></path>
                        <path d="M20 15h2"></path><path d="M20 9h2"></path>
                        <path d="M9 2v2"></path><path d="M9 20v2"></path>
                    </svg>
                </span>
                <span class="pfa-badge-text" @if($isLive) id="view_badge_3" @endif>{{ $badge3 }}</span>
            </div>

            <div class="pfa-badge-divider"></div>

            <div class="pfa-badge-item">
                <span class="pfa-badge-icon">
                    <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="12" rx="2"></rect>
                        <path d="M2 20h20"></path>
                    </svg>
                </span>
                <span class="pfa-badge-text" @if($isLive) id="view_badge_4" @endif>{{ $badge4 }}</span>
            </div>
        </div>

        <!-- 4 Metadata Columns -->
        <div class="pfa-meta-grid">
            <div class="pfa-meta-col">
                <div class="pfa-meta-icon">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="16" rx="3"></rect>
                        <circle cx="9" cy="10" r="2"></circle>
                        <path d="M15 8h2"></path><path d="M15 12h2"></path>
                        <path d="M7 16h10"></path>
                    </svg>
                </div>
                <div class="pfa-meta-content">
                    <span class="pfa-meta-label">CERTIFICATE ID</span>
                    <span class="pfa-meta-value" @if($isLive) id="view_certificate_id" @endif>{{ $certIdVal }}</span>
                </div>
            </div>

            <div class="pfa-meta-divider"></div>

            <div class="pfa-meta-col">
                <div class="pfa-meta-icon">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                </div>
                <div class="pfa-meta-content">
                    <span class="pfa-meta-label">ISSUE DATE</span>
                    <span class="pfa-meta-value" @if($isLive) id="view_issue_date" @endif>{{ $issueDateVal }}</span>
                </div>
            </div>

            <div class="pfa-meta-divider"></div>

            <div class="pfa-meta-col">
                <div class="pfa-meta-icon">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
                <div class="pfa-meta-content">
                    <span class="pfa-meta-label">COURSE DURATION</span>
                    <span class="pfa-meta-value" @if($isLive) id="view_course_duration" @endif>{{ $durationVal }}</span>
                </div>
            </div>

            <div class="pfa-meta-divider"></div>

            <div class="pfa-meta-col">
                <div class="pfa-meta-icon">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="6"></circle>
                        <path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"></path>
                        <polyline points="9 8 11 10 15 6"></polyline>
                    </svg>
                </div>
                <div class="pfa-meta-content">
                    <span class="pfa-meta-label">COMPLETION DATE</span>
                    <span class="pfa-meta-value" @if($isLive) id="view_completion_date" @endif>{{ $completionDateVal }}</span>
                </div>
            </div>
        </div>

        <!-- Signatures & Seal Row -->
        <div class="pfa-signatures-seal-row">
            <!-- Mentor Signature -->
            <div class="pfa-sign-col">
                <div class="pfa-sign-img-wrapper">
                    <img id="{{ $isLive ? 'view_instructor_signature' : '' }}" src="{{ $instructorSignImg }}" alt="Mentor Signature">
                </div>
                <div class="pfa-sign-line"></div>
                <div class="pfa-sign-designation" @if($isLive) id="view_mentor_title" @endif>{{ $mentorTitle }}</div>
            </div>

            <!-- Central Official Seal -->
            <div class="pfa-seal-col">
                <img id="{{ $isLive ? 'view_seal_img' : '' }}" src="{{ $sealImg }}" alt="Official Academy Seal">
            </div>

            <!-- Founder/Director Signature -->
            <div class="pfa-sign-col">
                <div class="pfa-sign-img-wrapper">
                    <img id="{{ $isLive ? 'view_administrator_signature' : '' }}" src="{{ $adminSignImg }}" alt="Founder Signature">
                </div>
                <div class="pfa-sign-line"></div>
                <div class="pfa-sign-designation" @if($isLive) id="view_founder_title" @endif>{{ $founderTitle }}</div>
            </div>
        </div>

        <!-- Website Footer -->
        <div class="pfa-cert-web-footer">
            <svg class="pfa-globe-icon" viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="2" y1="12" x2="22" y2="12"></line>
                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
            </svg>
            <span @if($isLive) id="view_website_url" @endif>{{ $websiteUrl }}</span>
        </div>

    </div>
</div>
