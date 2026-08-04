<!--====== Start FAQ Section ======-->
@if(isset($course) && count($course->faqs) > 0)
<style>
    .custom-faq-section {
        background-color: #f0faf9;
        padding: 80px 0;
    }
    .custom-faq-section .subtitle {
        color: #ff6b00;
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 15px;
        display: block;
    }
    .custom-faq-section h2 {
        font-size: 40px;
        font-weight: 700;
        color: #110B3A;
        margin-bottom: 40px;
        line-height: 1.3;
    }
    
    .custom-faq-accordion .accordion-item {
        border: none;
        border-radius: 8px;
        margin-bottom: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        overflow: hidden;
    }
    .custom-faq-accordion .accordion-button {
        background-color: #fff;
        color: #4b5563;
        font-weight: 600;
        font-size: 16px;
        padding: 20px 25px;
        box-shadow: none !important;
        border: none;
    }
    .custom-faq-accordion .accordion-button:not(.collapsed) {
        color: #110B3A;
        background-color: #fff;
    }
    .custom-faq-accordion .accordion-button::after {
        display: none;
    }
    .custom-faq-accordion .accordion-icon {
        font-size: 24px;
        color: #ff6b00;
        margin-left: auto;
        font-weight: 300;
        transition: transform 0.3s;
    }
    .custom-faq-accordion .accordion-button:not(.collapsed) .accordion-icon {
        transform: rotate(45deg);
    }
    .custom-faq-accordion .accordion-body {
        background-color: #fff;
        color: #6b7280;
        font-size: 15px;
        line-height: 1.8;
        padding: 0 25px 25px 25px;
        border-top: 1px solid #f3f4f6;
    }
    .faq-right-image {
        width: 100%;
        height: 100%;
        min-height: 400px;
        border-radius: 12px;
        object-fit: cover;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    }
</style>

<section class="custom-faq-section">
    <div class="container container-1278">
        <div class="row align-items-center">
            
            <div class="col-lg-6 mb-5 mb-lg-0">
                <span class="subtitle">POPULAR QUESTIONS</span>
                <h2>Frequently Asked Questions</h2>
                
                <div class="accordion custom-faq-accordion" id="courseFaqAccordion">
                    @foreach($course->faqs as $key => $faq)
                    <div class="accordion-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <h2 class="accordion-header" id="headingFaq{{ $key }}">
                            <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFaq{{ $key }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapseFaq{{ $key }}">
                                {{ $faq->question }}
                                <span class="accordion-icon">+</span>
                            </button>
                        </h2>
                        <div id="collapseFaq{{ $key }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="headingFaq{{ $key }}" data-bs-parent="#courseFaqAccordion">
                            <div class="accordion-body">
                                {!! $faq->answer !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-6 ps-lg-5" data-aos="fade-left" data-aos-delay="200">
                @if($course->faq_image)
                    <img src="{{ getFileLink('original_image', $course->faq_image) }}" alt="FAQ Image" class="faq-right-image">
                @else
                    <div class="faq-right-image bg-secondary d-flex justify-content-center align-items-center text-white text-center">
                        <div>
                            <h4>No FAQ Image Added</h4>
                            <p class="mb-0">You can upload an image from the course edit page.</p>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
</section>
@endif
<!--====== End FAQ Section ======-->
