@extends('frontend.layouts.master')
@section('title', __($page_info->title))
@section('content')
    <section class="course-details-area p-b-50">
        <!-- Full width theme color header -->
        <div class="course-details-header-wrapper p-t-60 p-b-95 p-t-md-40 p-b-md-50">
            <div class="container container-1278">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="course-details-header color-white">
                            <h2 class="title">{{ __($page_info->title) }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="course-details-overview-wrapper">
            <div class="container container-1278">
                <div class="row justify-content-center">
                    <div class="col-lg-10 p-b-md-40">
                        <div class="course-details-overview p-t-50 p-t-lg-5">
                            <div class="course-details-overview-content" style="background-color: #fff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-top: -60px; position: relative; z-index: 2;">
                                {!! __($page_info->content) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
