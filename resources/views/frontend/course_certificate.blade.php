@extends('frontend.layouts.master')
@section('title', __('download_certificate'))
@section('content')
    <link rel="stylesheet" href="{{ static_asset('frontend/css/pfa_certificate.css') }}">
    <style>
        .download-certificate-section {
            background-color: #f8faf9;
        }
        .cert-display-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid #eef2f0;
        }
        .cert-actions-bar {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-top: 25px;
        }
        .btn-cert-download {
            background: #0d2e24;
            color: #ffffff !important;
            padding: 12px 28px;
            border-radius: 6px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            text-decoration: none;
            border: none;
        }
        .btn-cert-download:hover {
            background: #154536;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(13, 46, 36, 0.25);
        }
        .btn-cert-print {
            background: #f1f6f4;
            color: #0d2e24 !important;
            border: 1px solid #0d2e24;
            padding: 12px 28px;
            border-radius: 6px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            text-decoration: none;
            cursor: pointer;
        }
        .btn-cert-print:hover {
            background: #0d2e24;
            color: #ffffff !important;
            transform: translateY(-2px);
        }
    </style>

    <!--====== Start Download Certificate Section ======-->
    <section class="download-certificate-section p-t-50 p-t-sm-30 p-b-80 p-b-sm-100">
        <div class="container container-1278">
            <div class="row">
                @include('frontend.profile.sidebar')

                <div class="col-md-8">
                    <div class="download-certificate-wrapper">
                        <div class="section-title-v3 color-dark m-b-30 m-b-sm-15">
                            <h3><i class="fal m-r-10 fa-certificate text-success"></i>{{ __('Your Course Certificate') }}</h3>
                            <p class="text-muted small mt-1">Official verified certificate of completion for <strong>{{ $course->title }}</strong></p>
                        </div>

                        <div class="cert-display-card m-b-30">
                            @php
                                $studentName = Auth::check() 
                                    ? (trim(Auth::user()->first_name . ' ' . Auth::user()->last_name) ?: Auth::user()->name)
                                    : 'Student Full Name';

                                $certId = 'PFA-' . date('Y') . '-' . str_pad($course->id, 3, '0', STR_PAD_LEFT) . (Auth::check() ? str_pad(Auth::id(), 3, '0', STR_PAD_LEFT) : '001');
                                $completionDate = date('d / m / Y');
                            @endphp

                            @include('backend.admin.course.certificate.certificate_view', [
                                'course' => $course,
                                'certificate' => $course->certificate,
                                'studentName' => $studentName,
                                'certificateId' => $certId,
                                'issueDate' => $completionDate,
                                'completionDate' => $completionDate,
                                'isPreview' => false
                            ])

                            <div class="cert-actions-bar">
                                <a href="{{ route('course.certificate-download', $course->id) }}" class="btn-cert-download">
                                    <i class="fas fa-file-pdf"></i> {{ __('download_certificate') }} (PDF)
                                </a>

                                <button type="button" class="btn-cert-print" onclick="window.print()">
                                    <i class="fas fa-print"></i> {{ __('Print / Save High-Res') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Download Certificate Section ======-->
@endsection
