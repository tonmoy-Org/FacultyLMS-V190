@extends('backend.layouts.master')
@section('title', __('categories_of_work_section'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                @include('backend.admin.website_setting.sidebar_component')
                <div class="col-xxl-9 col-lg-8 col-md-8">
                    <h3 class="section-title">{{ __('Categories of Work Section') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form action="{{route('website.categories_of_work_section.save')}}" method="POST" class="form" enctype="multipart/form-data">@csrf
                            <div class="row gx-20">
                                <!-- Title -->
                                <div class="col-12 col-lg-12">
                                    <div class="mb-4">
                                        <label for="categories_of_work_title" class="form-label">{{ __('Section Title') }}</label>
                                        <input type="text" class="form-control rounded-2" id="categories_of_work_title"
                                               placeholder="{{ __('e.g. The categories of work.') }}" name="categories_of_work_title" value="{{ setting('categories_of_work_title') ?: 'The categories of work.' }}">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-12">
                                    <h5 class="mb-3">{{ __('Cards') }}</h5>
                                    <div id="cards_container">
                                        @php
                                            $cards = setting('categories_of_work_cards');
                                            $cards = is_array($cards) ? $cards : [];
                                        @endphp
                                        
                                        @forelse($cards as $index => $card)
                                            <div class="card mb-4 card-item" data-index="{{ $index }}">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <h6 class="card-title">{{ __('Card') }} <span class="card-number">{{ $index + 1 }}</span></h6>
                                                        <button type="button" class="btn btn-sm text-danger remove-card-btn"><i class="las la-trash"></i></button>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">{{ __('Title') }}</label>
                                                            <input type="text" class="form-control" name="categories_of_work_cards[{{ $index }}][title]" value="{{ $card['title'] ?? '' }}">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">{{ __('Link (Optional)') }}</label>
                                                            <input type="text" class="form-control" name="categories_of_work_cards[{{ $index }}][link]" value="{{ $card['link'] ?? '' }}" placeholder="#register or https://...">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label class="form-label">{{ __('Content (Modules/Text)') }}</label>
                                                            <textarea class="form-control summernote" rows="4" name="categories_of_work_cards[{{ $index }}][content]">{!! $card['content'] ?? '' !!}</textarea>
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label class="form-label">{{ __('Image (Optional)') }}</label>
                                                            <input type="file" class="form-control" name="categories_of_work_cards[{{ $index }}][image]" accept="image/*">
                                                            @if(!empty($card['image']))
                                                                <div class="mt-2">
                                                                    <img src="{{ asset($card['image']) }}" alt="Card Image" style="max-height: 80px;">
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                    
                                    <button type="button" class="btn btn-outline-primary mt-2" id="add_card_btn"><i class="las la-plus"></i> {{ __('Add Card') }}</button>
                                </div>

                                <div class="d-flex justify-content-start align-items-center mt-30">
                                    <button type="submit" class="btn sg-btn-primary">{{ __('update') }}</button>
                                    @include('backend.common.loading-btn', ['class' => 'btn sg-btn-primary'])
                                </div>

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
        let cardIndex = {{ count(is_array(setting('categories_of_work_cards')) ? setting('categories_of_work_cards') : []) }};
        
        $('#add_card_btn').click(function() {
            let template = `
            <div class="card mb-4 card-item" data-index="${cardIndex}">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="card-title">{{ __('Card') }} <span class="card-number">${cardIndex + 1}</span></h6>
                        <button type="button" class="btn btn-sm text-danger remove-card-btn"><i class="las la-trash"></i></button>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('Title') }}</label>
                            <input type="text" class="form-control" name="categories_of_work_cards[${cardIndex}][title]">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('Link (Optional)') }}</label>
                            <input type="text" class="form-control" name="categories_of_work_cards[${cardIndex}][link]" placeholder="#register or https://...">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">{{ __('Content (Modules/Text)') }}</label>
                            <textarea class="form-control summernote" rows="4" name="categories_of_work_cards[${cardIndex}][content]"></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">{{ __('Image (Optional)') }}</label>
                            <input type="file" class="form-control" name="categories_of_work_cards[${cardIndex}][image]" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>`;
            
            $('#cards_container').append(template);
            
            // Initialize summernote for newly added textarea
            $('#cards_container .card-item').last().find('.summernote').summernote({
                height: 150,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['para', ['ul', 'ol', 'paragraph']],
                ]
            });
            
            cardIndex++;
            updateCardNumbers();
        });

        $(document).on('click', '.remove-card-btn', function() {
            $(this).closest('.card-item').remove();
            updateCardNumbers();
        });

        function updateCardNumbers() {
            $('#cards_container .card-item').each(function(index) {
                $(this).find('.card-number').text(index + 1);
            });
        }
    });
</script>
@endpush
