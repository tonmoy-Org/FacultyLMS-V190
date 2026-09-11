<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $certificate->title ?? 'Certificate' }}</title>
    <style>
        @page {
            margin: 0;
            size: 1024px 682px landscape;
        }
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'DejaVu Serif', Georgia, 'Times New Roman', serif;
            background-color: #ffffff;
            color: #0d2e24;
            width: 1024px;
            height: 682px;
            position: relative;
            overflow: hidden;
            margin: 0 auto;
        }
        .cert-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 1024px;
            height: 682px;
            z-index: 1;
        }
        .cert-content {
            position: relative;
            z-index: 10;
            width: 1024px;
            height: 682px;
            padding: 38px 80px 25px 80px;
            text-align: center;
        }
        .org-name {
            font-size: 26px;
            font-weight: bold;
            color: #0d2e24;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
            font-family: 'DejaVu Serif', Georgia, serif;
        }
        .divider-top {
            margin: 2px auto;
            text-align: center;
        }
        .divider-top img {
            height: 14px;
        }
        .tagline {
            font-size: 13.5px;
            font-weight: bold;
            color: #0d2e24;
            letter-spacing: 0.5px;
            margin: 2px 0;
        }
        .divider-sub {
            margin: 2px auto 4px auto;
            text-align: center;
        }
        .divider-sub img {
            height: 10px;
        }
        .title-table {
            width: 100%;
            margin: 3px 0;
        }
        .cert-title {
            font-size: 24px;
            font-weight: bold;
            color: #0d2e24;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .presented-to {
            font-size: 13px;
            font-style: italic;
            color: #2b3b33;
            margin: 4px 0 2px 0;
        }
        .student-name {
            font-size: 38px;
            color: #0d2e24;
            font-family: 'DejaVu Serif', cursive, serif;
            font-style: italic;
            line-height: 1.1;
            margin: 2px 0 3px 0;
        }
        .student-underline {
            width: 440px;
            height: 1px;
            background-color: rgba(13, 46, 36, 0.4);
            margin: 0 auto 5px auto;
        }
        .course-table {
            width: 100%;
            margin: 3px 0 6px 0;
        }
        .completion-text {
            font-size: 12px;
            color: #2b3b33;
            margin-bottom: 2px;
        }
        .course-name {
            font-size: 20px;
            font-weight: bold;
            color: #0d2e24;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .badges-table {
            width: 90%;
            margin: 4px auto;
            border-collapse: collapse;
        }
        .badge-cell {
            font-size: 9.5px;
            font-weight: bold;
            color: #113329;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            text-align: center;
            font-family: 'DejaVu Sans', sans-serif;
            padding: 0 4px;
        }
        .badge-sep {
            color: #c5cdca;
            width: 10px;
            text-align: center;
        }
        .meta-table {
            width: 92%;
            margin: 6px auto;
            border-top: 1px solid #cbb88a;
            border-bottom: none;
            border-collapse: collapse;
            font-family: 'DejaVu Sans', sans-serif;
            padding: 4px 0;
        }
        .meta-cell {
            text-align: center;
            padding: 4px 6px;
            width: 25%;
        }
        .meta-label {
            font-size: 8px;
            font-weight: bold;
            color: #556b62;
            text-transform: uppercase;
            display: block;
            margin-bottom: 2px;
        }
        .meta-value {
            font-size: 10px;
            font-weight: bold;
            color: #0d2e24;
            display: block;
        }
        .meta-sep {
            width: 1px;
            background-color: #cbb88a;
            padding: 0;
        }
        .signatures-table {
            width: 90%;
            margin: 6px auto 0 auto;
            border-collapse: collapse;
        }
        .sign-cell {
            width: 35%;
            text-align: center;
            vertical-align: bottom;
        }
        .seal-cell {
            width: 30%;
            text-align: center;
            vertical-align: middle;
        }
        .sign-img {
            max-height: 36px;
            max-width: 140px;
            margin-bottom: 3px;
        }
        .sign-line {
            width: 180px;
            height: 1px;
            background-color: #cbb88a;
            margin: 0 auto 3px auto;
        }
        .sign-title {
            font-size: 10.5px;
            font-weight: bold;
            color: #0d2e24;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }
        .seal-img {
            width: 74px;
            height: 74px;
        }
        .web-footer {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px;
            font-weight: bold;
            color: #1b3b31;
            margin-top: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    @php
        $orgName = $certificate->getField('org_name', 'Pro Freelancers Academy');
        $tagline = $certificate->getField('tagline', 'Journey To Make $1,000 Monthly');
        $certTitle = $certificate->getField('certificate_title', 'CERTIFICATE OF COMPLETION');
        $presentedTo = $certificate->getField('presented_to', 'This certificate is proudly presented to');
        $studentName = Auth::check() ? (trim(Auth::user()->first_name . ' ' . Auth::user()->last_name) ?: Auth::user()->name) : $certificate->getField('student_name_preview', 'Student Full Name');
        $completionText = $certificate->getField('completion_text', 'for successfully completing the');
        $courseName = $certificate->getField('course_name', $certificate->title ?? 'FREELANCING MASTERY COURSE');

        $badge1 = $certificate->getField('badge_1', 'QUICK EARNING SYSTEM');
        $badge2 = $certificate->getField('badge_2', 'YOUTUBE AUTOMATION');
        $badge3 = $certificate->getField('badge_3', 'AI & PASSIVE INCOME');
        $badge4 = $certificate->getField('badge_4', 'DIGITAL SKILLS');

        $certId = 'PFA-' . date('Y') . '-' . str_pad($certificate->course_id, 3, '0', STR_PAD_LEFT) . (Auth::check() ? str_pad(Auth::id(), 3, '0', STR_PAD_LEFT) : '001');
        $issueDate = $certificate->getField('issue_date', date('d / m / Y'));
        $duration = $certificate->getField('course_duration', 'XX HOURS');
        $completionDate = $certificate->getField('completion_date', date('d / m / Y'));

        $mentorTitle = $certificate->getField('mentor_title', 'MENTOR');
        $founderTitle = $certificate->getField('founder_title', 'FOUNDER / DIRECTOR');
        $websiteUrl = $certificate->getField('website_url', 'profreelancersacademy.com');

        $bgPath = public_path('admin/certificate/pfa_certificate_frame.png');
        $bgData = file_exists($bgPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($bgPath)) : '';

        $divTopPath = public_path('admin/certificate/divider_top.png');
        $divTopData = file_exists($divTopPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($divTopPath)) : '';

        $divSubPath = public_path('admin/certificate/divider_sub.png');
        $divSubData = file_exists($divSubPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($divSubPath)) : '';

        $flLeftPath = public_path('admin/certificate/flourish_title_left.png');
        $flLeftData = file_exists($flLeftPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($flLeftPath)) : '';

        $flRightPath = public_path('admin/certificate/flourish_title_right.png');
        $flRightData = file_exists($flRightPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($flRightPath)) : '';

        $laurelLPath = public_path('admin/certificate/laurel_left.png');
        $laurelLData = file_exists($laurelLPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($laurelLPath)) : '';

        $laurelRPath = public_path('admin/certificate/laurel_right.png');
        $laurelRData = file_exists($laurelRPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($laurelRPath)) : '';

        $sealPath = public_path('admin/certificate/pfa_seal.png');
        if ($certificate->background_image && !empty($certificate->background_image['original_image'])) {
            $customSeal = public_path($certificate->background_image['original_image']);
            if (file_exists($customSeal)) {
                $sealPath = $customSeal;
            }
        }
        $sealData = file_exists($sealPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($sealPath)) : '';

        $mentorSignPath = public_path('admin/certificate/pfa_mentor_signature.png');
        if ($certificate->instructor_signature && !empty($certificate->instructor_signature['original_image'])) {
            $customSign = public_path($certificate->instructor_signature['original_image']);
            if (file_exists($customSign)) {
                $mentorSignPath = $customSign;
            }
        }
        $mentorSignData = file_exists($mentorSignPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($mentorSignPath)) : '';

        $founderSignPath = public_path('admin/certificate/pfa_founder_signature.png');
        if ($certificate->administrator_signature && !empty($certificate->administrator_signature['original_image'])) {
            $customAdminSign = public_path($certificate->administrator_signature['original_image']);
            if (file_exists($customAdminSign)) {
                $founderSignPath = $customAdminSign;
            }
        }
        $founderSignData = file_exists($founderSignPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($founderSignPath)) : '';
    @endphp

    @if($bgData)
        <img class="cert-bg" src="{{ $bgData }}" alt="Frame">
    @endif

    <div class="cert-content">
        <!-- Header -->
        <div class="org-name">{{ $orgName }}</div>
        @if($divTopData)
            <div class="divider-top"><img src="{{ $divTopData }}" alt=""></div>
        @endif
        <div class="tagline">{{ $tagline }}</div>
        @if($divSubData)
            <div class="divider-sub"><img src="{{ $divSubData }}" alt=""></div>
        @endif

        <!-- Title -->
        <table class="title-table">
            <tr>
                <td style="width: 15%; text-align: right;">
                    @if($flLeftData)<img src="{{ $flLeftData }}" style="height: 18px;" alt="">@endif
                </td>
                <td style="width: 70%; text-align: center;">
                    <div class="cert-title">{{ $certTitle }}</div>
                </td>
                <td style="width: 15%; text-align: left;">
                    @if($flRightData)<img src="{{ $flRightData }}" style="height: 18px;" alt="">@endif
                </td>
            </tr>
        </table>

        <!-- Presentation -->
        <div class="presented-to">{{ $presentedTo }}</div>

        <!-- Student Name -->
        <div class="student-name">{{ $studentName }}</div>
        <div class="student-underline"></div>

        <!-- Course Name with Laurels -->
        <table class="course-table">
            <tr>
                <td style="width: 20%; text-align: right;">
                    @if($laurelLData)<img src="{{ $laurelLData }}" style="height: 42px;" alt="">@endif
                </td>
                <td style="width: 60%; text-align: center;">
                    <div class="completion-text">{{ $completionText }}</div>
                    <div class="course-name">{{ $courseName }}</div>
                </td>
                <td style="width: 20%; text-align: left;">
                    @if($laurelRData)<img src="{{ $laurelRData }}" style="height: 42px;" alt="">@endif
                </td>
            </tr>
        </table>

        <!-- 4 Badges -->
        <table class="badges-table">
            <tr>
                <td class="badge-cell">&#9670; {{ $badge1 }}</td>
                <td class="badge-sep">|</td>
                <td class="badge-cell">&#9658; {{ $badge2 }}</td>
                <td class="badge-sep">|</td>
                <td class="badge-cell">&#9881; {{ $badge3 }}</td>
                <td class="badge-sep">|</td>
                <td class="badge-cell">&#128187; {{ $badge4 }}</td>
            </tr>
        </table>

        <!-- Metadata -->
        <table class="meta-table">
            <tr>
                <td class="meta-cell">
                    <span class="meta-label">CERTIFICATE ID</span>
                    <span class="meta-value">{{ $certId }}</span>
                </td>
                <td class="meta-sep"></td>
                <td class="meta-cell">
                    <span class="meta-label">ISSUE DATE</span>
                    <span class="meta-value">{{ $issueDate }}</span>
                </td>
                <td class="meta-sep"></td>
                <td class="meta-cell">
                    <span class="meta-label">COURSE DURATION</span>
                    <span class="meta-value">{{ $duration }}</span>
                </td>
                <td class="meta-sep"></td>
                <td class="meta-cell">
                    <span class="meta-label">COMPLETION DATE</span>
                    <span class="meta-value">{{ $completionDate }}</span>
                </td>
            </tr>
        </table>

        <!-- Signatures & Seal -->
        <table class="signatures-table">
            <tr>
                <td class="sign-cell">
                    @if($mentorSignData)<img class="sign-img" src="{{ $mentorSignData }}" alt="Mentor Signature">@endif
                    <div class="sign-line"></div>
                    <div class="sign-title">{{ $mentorTitle }}</div>
                </td>
                <td class="seal-cell">
                    @if($sealData)<img class="seal-img" src="{{ $sealData }}" alt="Seal">@endif
                </td>
                <td class="sign-cell">
                    @if($founderSignData)<img class="sign-img" src="{{ $founderSignData }}" alt="Founder Signature">@endif
                    <div class="sign-line"></div>
                    <div class="sign-title">{{ $founderTitle }}</div>
                </td>
            </tr>
        </table>

        <!-- Footer -->
        <div class="web-footer">&#127760; {{ $websiteUrl }}</div>
    </div>
</body>
</html>
