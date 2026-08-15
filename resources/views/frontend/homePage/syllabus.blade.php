<!--====== Start Syllabus Section ======-->
@if(isset($course) && $course->sections->count() > 0)
<style>
    .custom-syllabus-accordion .accordion-item {
        border: 1px solid #E5E7EB;
        border-radius: 14px !important;
        margin-bottom: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
        overflow: hidden;
        transition: all 0.3s ease;
        background: #ffffff;
    }
    .custom-syllabus-accordion .accordion-item:hover {
        border-color: #10b981;
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.08);
    }
    .custom-syllabus-accordion .accordion-button {
        background: #ffffff !important;
        color: #1a1b4b !important;
        font-weight: 700;
        font-size: 16px;
        padding: 20px 24px;
        box-shadow: none !important;
    }
    .custom-syllabus-accordion .accordion-button:not(.collapsed) {
        background: rgba(16, 185, 129, 0.08) !important;
        color: #10b981 !important;
        border-bottom: 1px solid rgba(16, 185, 129, 0.2) !important;
    }
    .custom-syllabus-accordion .accordion-button::after {
        background-size: 1rem;
    }
    .custom-syllabus-accordion .accordion-body {
        background: #ffffff !important;
        padding: 0;
    }
</style>

<section class="syllabus-section p-t-20 p-b-40 position-relative overflow-hidden bg-white">
    <div class="container container-1278">
        <div class="common-heading text-center m-b-40">
            <h2 class="fw-bold m-b-0" style="color: #1a1b4b; font-size: 28px; line-height: 1.25;">
                {{ __('Course Syllabus') }}
            </h2>
        </div>
        
        <div class="accordion custom-syllabus-accordion accordion-flush" id="curriculumAccordion">
            @foreach($course->sections as $key => $section)
                <div class="accordion-item">
                    <div class="accordion-header" id="course-curriculum-heading{{ $key }}">
                        <div class="accordion-button {{ $key == 0 && (count($course->lessons->where('section_id', $section->id)) > 0 || count($section->quizzes) > 0) ? '' : 'collapsed' }}"
                             role="button" 
                             data-bs-toggle="collapse" 
                             data-bs-target="#course-curriculum-collapse{{ $key }}"
                             {{ $key == 0 && (count($course->lessons->where('section_id', $section->id)) > 0 || count($section->quizzes) > 0) ? 'aria-expanded="true"' : 'aria-expanded="false"' }}
                             aria-controls="course-curriculum-collapse{{ $key }}">
                            <i class="fal fa-book-open me-2 text-warning"></i> {{ $section->title }}
                        </div>
                    </div>
                    <div id="course-curriculum-collapse{{ $key }}"
                         class="accordion-collapse collapse {{ $key == 0 && (count($course->lessons->where('section_id', $section->id)) > 0 || count($section->quizzes) > 0) ? 'show' : '' }}"
                         aria-labelledby="course-curriculum-heading{{ $key }}" 
                         data-bs-parent="#curriculumAccordion">
                        <div class="accordion-body">
                            @if(count($course->lessons) > 0)
                                <div class="course-playlist">
                                    <ul class="list-unstyled mb-0 px-4 py-2">
                                        @foreach($course->lessons->where('section_id', $section->id) as $k => $lesson)
                                            <li class="py-3 border-bottom {{ $loop->last ? 'border-0' : '' }}">
                                                <a href="#" 
                                                   class="d-flex align-items-center justify-content-between text-dark text-decoration-none {{ $lesson->is_free == 1 ? 'player-src' : '' }}"
                                                   @if($lesson->is_free == 1)
                                                       data-poster="{{ $lesson->image ? getFileLink('402x238', $lesson->image) : ($course->image ? getFileLink('402x248', $course->image) : '') }}"
                                                       data-type="{{ $lesson->lesson_type }}" 
                                                       data-source="{{ $lesson->source }}"
                                                       data-video="{{ getVideoId($lesson->source, $lesson->source_data) }}"
                                                   @endif>
                                                    <div class="d-flex align-items-center gap-3">
                                                        @if($lesson->lesson_type == 'video')
                                                            <i class="fal fa-play-circle text-primary fs-5"></i>
                                                        @elseif($lesson->lesson_type == 'audio')
                                                            <i class="fal fa-microphone text-primary fs-5"></i>
                                                        @else
                                                            <i class="fal fa-file-alt text-primary fs-5"></i>
                                                        @endif
                                                        
                                                        <span class="fw-medium text-dark fs-6">{{ $lesson->title }}</span>
                                                        
                                                        @if($lesson->is_free == 1)
                                                            <span class="badge bg-success ms-2">{{ __('free') }}</span>
                                                        @endif
                                                    </div>
                                                    <span class="small text-muted fw-semibold">{{ $lesson->duration }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
