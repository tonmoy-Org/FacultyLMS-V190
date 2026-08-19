@extends('backend.layouts.master')
@section('title', __('edit_offline_method'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{__('edit_offline_method') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <div class="row">
                            <form>
                                <div class="col-lg-12">
                                    <input type="hidden" name="r" value="{{ url()->current() }}" class="r">
                                    <div class="mb-4">
                                        <label for="lang" class="form-label">{{__('language') }}</label>
                                        <select id="lang"
                                                class="form-select form-select-lg mb-3 with_search" name="lang">
                                            <option value="">{{__('select_language') }}</option>
                                            @foreach($languages as $language)
                                                <option
                                                    value="{{ $language->locale }}" {{ $lang == $language->locale ? 'selected' : '' }}>{{ $language->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="lang_error error">{{ $errors->first('lang') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('offline-methods.update',$offline_method->id) }}" class="form-validate form"
                                  method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <input type="hidden" name="id" value="{{ $offline_method->id }}">
                                    <input type="hidden" value="{{ $lang }}" name="lang">
                                    <input type="hidden"
                                           value="{{ $offline_method_language->translation_null == 'not-found' ? '' : $offline_method_language->id }}"
                                           name="translate_id">
                                    <input type="hidden" class="is_modal" value="0"/>
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="name" class="form-label">{{ __('name') }} <span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control rounded-2" id="name"
                                                   name="name"
                                                   placeholder="{{ __('name') }}"
                                                   value="{{ $offline_method_language->name }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="name_error error"></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- End Coupon Code -->
                                    <div class="col-lg-6">
                                        <div class="select-type-v2 mb-4">
                                            <label for="couponType"
                                                   class="form-label">{{ __('payment_type') }}</label>
                                            <select class="mb-3 without_search" name="type">
                                                <option
                                                    value="">{{ __('select_payment_type') }}</option>
                                                <option
                                                    value="custom_payment" {{ $offline_method->type == 'custom_payment' ? 'selected' : '' }}>{{ __('custom_payment') }}</option>
                                                <option
                                                    value="bank_payment" {{ $offline_method->type == 'bank_payment' ? 'selected' : '' }}>{{ __('bank_payment') }}</option>
                                                <option
                                                    value="cheque_payment" {{ $offline_method->type == 'cheque_payment' ? 'selected' : '' }}>{{ __('cheque_payment') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    @include('backend.admin.offline_methods.partials',['offline_method' => $offline_method])
                                    @include('backend.common.media-input',[
                                        'title' => __('banner'),
                                        'name'  => 'offline_method_media_id',
                                        'col'   => 'col-12 mb-4',
                                        'size'  => '(147x90)',
                                        'label' => __('banner'),
                                        'image' => $offline_method->image,
                                        'edit'  => $offline_method,
                                        'image_object'  => $offline_method->image,
                                        'media_id'  => $offline_method->offline_method_media_id,
                                    ])

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="video_source" class="form-label">{{ __('video_source') }}</label>
                                                <select id="video_source" class="form-select form-select-lg mb-3 without_search" name="video_source">
                                                    <option value="">{{ __('select_video_source') }}</option>
                                                    <option value="upload" {{ old('video_source', $offline_method->video_source) == 'upload' ? 'selected' : '' }}>{{ __('upload') }}</option>
                                                    <option value="youtube" {{ old('video_source', $offline_method->video_source) == 'youtube' ? 'selected' : '' }}>{{ __('youtube') }}</option>
                                                    <option value="vimeo" {{ old('video_source', $offline_method->video_source) == 'vimeo' ? 'selected' : '' }}>{{ __('vimeo') }}</option>
                                                    <option value="mp4" {{ old('video_source', $offline_method->video_source) == 'mp4' ? 'selected' : '' }}>{{ __('mp4') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 upload_div {{ old('video_source', $offline_method->video_source) == 'upload' ? '' : 'd-none' }}">
                                        <div class="mb-3">
                                            <label for="thumbnailFile" class="form-label">{{ __('upload_video') }}</label>
                                            <label for="thumbnailFile" class="file-upload-text">
                                                <p class="file_name">{{ ($offline_method->video_source == 'upload' && $offline_method->video) ? getFileName(getArrayValue('image',$offline_method->video)) : __('video') }}</p>
                                                <span class="file-btn">{{ __('choose_file') }}</span>
                                            </label>
                                            <input class="d-none thumb_picker" name="video" type="file" id="thumbnailFile">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 video_link {{ old('video_source', $offline_method->video_source) && old('video_source', $offline_method->video_source) != 'upload' ? '' : 'd-none' }}">
                                        <div class="mb-4">
                                            <label for="videoLink" class="form-label">{{ __('video_link') }}</label>
                                            <input type="text" class="form-control rounded-2" name="video_link" id="videoLink" placeholder="{{ __('enter_video_link') }}" value="{{ $offline_method->video_source != 'upload' ? $offline_method->video : '' }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <textarea id="product-update-editor" name="instructions">{{ $offline_method_language->instructions }}</textarea>
                                    </div>
                                    <div class="d-flex justify-content-end align-items-center mt-30">
                                        <button type="submit" class="btn sg-btn-primary">{{__('submit') }}</button>
                                        @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                                    </div>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('backend.common.gallery-modal')
@endsection

@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
@endpush
@push('js_asset')
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/media.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(document).on('change', "#video_source", function() {
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
        });
    </script>
@endpush
