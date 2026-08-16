@extends('backend.layouts.master')
@section('title', __('success_story'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-top d-flex justify-content-between align-items-center mb-3">
                        <h3 class="section-title" style="font-size: 18px; color: #000000; font-weight: 500;">{{__('success') }}</h3>
                    </div>
                    @include('backend.admin.website_setting.successStory.banner_setting_form')
                    <div class="bg-white redious-border p-20 p-sm-30 pt-sm-30">
                        @if(hasPermission('success-stories.create'))
                            <div class="d-flex justify-content-end align-items-center mb-3">
                                <a href="{{ route('success-stories.create') }}"
                                   class="d-flex align-items-center btn sg-btn-primary gap-2">
                                    <i class="las la-plus"></i>
                                    <span>{{__('add_success_story') }}</span>
                                </a>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="default-list-table table-responsive yajra-dataTable">
                                    {{ $dataTable->table() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('backend.common.delete-script')
@endsection
@push('js')
    {{ $dataTable->scripts() }}
@endpush
