<!--====== Start Success Story Section ======-->
@php
    if(!isset($success_stories)) {
        $success_stories = \App\Models\SuccessStory::active()->get();
    }
@endphp
<style>
    .custom-success-section {
        background-color: #fcf9f6; 
    }
    .custom-testimonial-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
        height: 100%;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        border: 1px solid #f3f4f6;
    }
    .custom-testimonial-card .card-top-image {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }
    .custom-testimonial-card .card-body {
        padding: 30px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    .custom-testimonial-card p {
        color: #4b5563;
        font-size: 15px;
        line-height: 1.6;
        margin-bottom: 25px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .custom-testimonial-author {
        display: flex;
        align-items: center;
        margin-top: auto;
    }
    .custom-testimonial-author > img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        margin-right: 15px;
        object-fit: cover;
        border: 2px solid #e5e7eb;
        padding: 2px;
    }
    .author-details {
        display: flex;
        flex-direction: column;
    }
    .author-details h6 {
        margin: 0 0 2px 0;
        font-size: 15px;
        font-weight: 700;
        color: #12b884; 
    }
    .author-details span {
        font-size: 12px;
        color: #6b7280;
        margin-bottom: 5px;
        font-weight: 500;
    }
    .author-details .stars {
        color: #f59e0b;
        font-size: 12px;
    }
</style>

<section class="success-story-section p-t-80 p-b-80 bg-white">
    <div class="container container-1278">
        <div class="row align-items-center">
            
            <div class="col-lg-7 order-2 order-lg-1">
                @if(count($success_stories)>0)
                <div class="row" data-direction="{{ systemLanguage() ? systemLanguage()->text_direction : 'ltr' }}">
                    @foreach($success_stories as $success)
                    <div class="col-md-6 mb-4 mb-md-0">
                        <div class="custom-testimonial-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <img class="card-top-image" src="{{ getFileLink('473x337', $success->image) }}" alt="Success Story Preview">
                            <div class="card-body">
                                <p>"{{ $success->description }}"</p>
                                <div class="custom-testimonial-author">
                                    <img src="{{ getFileLink('40x40', $success->image) }}" alt="{{ $success->title }}">
                                    <div class="author-details">
                                        <h6>{{ $success->title }}</h6>
                                        <span>{{ $success->position ?? __('Student') }}</span>
                                        <div class="stars">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                    @include('frontend.not_found',$data=['title'=> 'success stories'])
                @endif
            </div>

            <div class="col-lg-5 order-1 order-lg-2 pl-lg-5 mb-5 mb-lg-0">
                <div data-aos="fade-left" dir="{{ systemLanguage() ? systemLanguage()->text_direction : 'ltr' }}">
                    <span class="d-block fw-bold text-uppercase mb-3" style="color: #12b884; font-size: 14px; letter-spacing: 1.5px;">{{__('success_story') }}</span>
                    <h2 class="fw-bold mb-4" style="font-size: 40px; color: #110B3A; line-height: 1.3;">{{ isset($section->contents['title']) && !empty($section->contents['title']) ? $section->contents['title'] : __('What Says My Students About The Platform') }}</h2>
                    <p class="text-secondary mb-4" style="font-size: 16px; line-height: 1.8;">{{ isset($section->contents['sub_title']) && !empty($section->contents['sub_title']) ? $section->contents['sub_title'] : __('Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra.') }}</p>
                    <a href="{{ url('success') }}" class="template-btn">{{ __('View All Success Stories') }}</a>
                </div>
            </div>

        </div>
    </div>
</section>
<!--====== End Success Story Section ======-->
