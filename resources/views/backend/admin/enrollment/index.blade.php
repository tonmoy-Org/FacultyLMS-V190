@extends('backend.layouts.master')
@section('title', __('enrollment_history'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-top d-flex justify-content-between align-items-center">
                        <h3 class="section-title">{{__('enrollments') }}</h3>
                        @if(hasPermission('bulk.enrollments'))
                            <div class="oftions-content-right mb-12">
                                <a href="#" class="d-flex align-items-center btn sg-btn-primary gap-2"
                                   data-bs-toggle="modal" data-bs-target="#student_modal">
                                    <i class="las la-plus"></i>
                                    <span> {{__('add_students_to_courses') }}</span>
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="bg-white redious-border p-20 p-sm-30 pt-sm-30">
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
        @if(hasPermission('bulk.enrollments'))
            @include('backend.admin.enrollment.enrollment_modal')
        @endif
        @if(hasPermission('enrollments.status'))
            @include('backend.common.delete-script')
        @endif

        <!-- Receipt Modal -->
        <div class="modal fade" id="receiptModal" tabindex="-1" aria-labelledby="receiptModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="receiptModalLabel">{{ __('receipt') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="" id="receiptImage" class="img-fluid" alt="Receipt">
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('js')
    {{ $dataTable->scripts() }}
    <script>
        $(document).on('click', '.view-receipt-btn', function() {
            var url = $(this).data('url');
            $('#receiptImage').attr('src', url);
            var receiptModal = new bootstrap.Modal(document.getElementById('receiptModal'));
            receiptModal.show();
        });
    </script>
@endpush
