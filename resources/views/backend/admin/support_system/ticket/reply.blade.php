@extends('backend.layouts.master')
@section('title', __('reply_ticket'))
@section('content')
    <style>
        .ticket-card {
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            margin-bottom: 24px;
            overflow: hidden;
        }
        .ticket-card-header {
            padding: 14px 20px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }
        .ticket-card-header.admin-header {
            background: #f8fafc;
            border-bottom-color: #e2e8f0;
        }
        .ticket-card-header.student-header {
            background: #f8fafc;
            border-bottom-color: #e2e8f0;
        }
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ffffff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.08);
        }
        .user-initial-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #10b981;
            color: #ffffff;
            font-weight: 500;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.08);
        }
        .ticket-card-body {
            padding: 20px 24px;
        }
        .ticket-message-container {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-left: 4px solid #10b981;
            border-radius: 8px;
            padding: 18px 22px;
        }
        .ticket-message-container.reply-staff {
            background: #f8fafc;
            border-color: #e2e8f0;
            border-left: 4px solid #10b981;
        }
        .ticket-message-container.reply-student {
            background: #eff6ff;
            border-color: #bfdbfe;
            border-left: 4px solid #3b82f6;
        }
        .ticket-message-header-label {
            font-size: 12px;
            font-weight: 500;
            color: #64748b;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .ticket-message-text {
            color: #1e293b;
            font-size: 15px;
            line-height: 1.75;
            word-break: break-word;
            font-weight: 400;
        }
        .media-attachment-box {
            margin-top: 20px;
            padding-top: 16px;
            border-top: 1px solid #f1f5f9;
        }
        .media-attachment-container {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-top: 10px;
        }
        .media-attachment-item {
            display: inline-block;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            width: 120px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .media-attachment-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.08);
        }
        .media-attachment-item img {
            width: 100%;
            height: 90px;
            object-fit: cover;
            display: block;
        }
        .media-attachment-footer {
            padding: 6px 8px;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid #f1f5f9;
        }
    </style>

    <form action="{{ route('ticket.reply') }}" class="form" method="POST">
        @csrf
        <div class="container-fluid">
            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
            <input type="hidden" name="is_modal" class="is_modal" value="0">
            
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                <div>
                    <h3 class="section-title mb-1">#{{ $ticket->ticket_id }}</h3>
                    <span class="text-muted font-13">Submitted {{ \Carbon\Carbon::parse($ticket->created_at)->format('M d, Y \a\t h:i A') }} ({{ \Carbon\Carbon::parse($ticket->created_at)->diffForHumans() }})</span>
                </div>

                <div class="select-type-v2 pad-rt mb-20">
                    <select id="ticket_update" class="form-select form-select-lg mb-3 without_search"
                            data-route="{{ route('tickets.update', $ticket->id) }}">
                        <option value="">{{ __('select_status') }}</option>
                        <option value="pending" {{ $ticket->status == 'pending' ? 'selected' : '' }}>{{ __('pending') }}</option>
                        <option value="answered" {{ $ticket->status == 'answered' ? 'selected' : '' }}>{{ __('answered') }}</option>
                        <option value="hold" {{ $ticket->status == 'hold' || $ticket->status == 'on_hold' ? 'selected' : '' }}>{{ __('on_hold') }}</option>
                        <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>{{ __('open') }}</option>
                        <option value="close" {{ $ticket->status == 'close' ? 'selected' : '' }}>{{ __('close') }}</option>
                    </select>
                </div>
            </div>

            <div class="bg-white redious-border p-20 p-md-30">
                <div class="row">
                    <!-- Status & Metadata Bar -->
                    <div class="col-lg-12">
                        <div class="mb-30 d-flex gap-20 align-items-center justify-content-between flex-wrap">
                            <button class="btn sg-btn-primary" type="button">
                                {{ ucfirst($ticket->status) }}
                            </button>

                            <div class="d-flex flex-wrap gap-20">
                                <span class="badge badge-light-gray text-capitalize">{{ __('priority') }} : {{ $ticket->priority }}</span>
                                <span class="badge badge-light-gray">{{ __('department') }} : {{ $ticket->department->title ?? 'General' }}</span>
                                @if($replies && count($replies) > 0)
                                    <span class="badge badge-light-gray">{{ __('last_reply') }} : {{ \Carbon\Carbon::parse($replies->last()->created_at)->diffForHumans() }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- 1. ORIGINAL TICKET REQUEST -->
                    <div class="col-lg-12">
                        <div class="ticket-card">
                            @php
                                $studentName = $ticket->name ?: ($ticket->first_name . ' ' . $ticket->last_name);
                                $studentAvatar = ($ticket->user && method_exists($ticket->user, 'getProfilePicAttribute')) 
                                    ? $ticket->user->profile_pic 
                                    : static_asset('images/default/user32x32.jpg');
                                $initial = strtoupper(substr($studentName, 0, 1));
                            @endphp

                            <div class="ticket-card-header student-header">
                                <div class="d-flex align-items-center gap-3">
                                    @if($ticket->user && $ticket->user->images)
                                        <img src="{{ $studentAvatar }}" alt="{{ $studentName }}" class="user-avatar">
                                    @else
                                        <div class="user-initial-avatar" style="background: #3b82f6;">{{ $initial }}</div>
                                    @endif

                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <h5 class="fw-normal mb-0" style="font-size: 15px; color: #1e293b;">{{ $studentName }}</h5>
                                            <span class="badge bg-primary text-white font-11 px-2 py-1">Student</span>
                                        </div>
                                        <span class="text-muted font-12">{{ $ticket->email }}</span>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge badge-light-gray me-2">{{ \Carbon\Carbon::parse($ticket->created_at)->format('M d, Y h:i A') }}</span>
                                    @if(hasPermission('tickets.destroy') || (auth()->check() && auth()->user()->role_id == 1))
                                        <a href="javascript:void(0)" onclick="delete_row('{{ route('tickets.destroy', $ticket->id) }}', null, true)" class="btn btn-sm btn-outline-danger py-1 px-2" title="Delete Ticket"><i class="lar la-trash-alt"></i></a>
                                    @endif
                                </div>
                            </div>

                            <div class="ticket-card-body">
                                <div class="ticket-message-container reply-student">
                                    <div class="ticket-message-header-label">
                                        <i class="las la-comment-alt text-primary" style="font-size: 15px;"></i>
                                        <span>Message Details</span>
                                    </div>
                                    <div class="ticket-message-text">
                                        @if(strip_tags($ticket->body) != $ticket->body)
                                            {!! $ticket->body !!}
                                        @else
                                            {!! nl2br(e($ticket->body)) !!}
                                        @endif
                                    </div>
                                </div>

                                @if(is_array($ticket->file) && count($ticket->file) > 0)
                                    <div class="media-attachment-box">
                                        <h6 class="fw-normal text-secondary mb-2" style="font-size: 13px;">
                                            <i class="las la-paperclip me-1"></i> Attached Files ({{ count($ticket->file) }})
                                        </h6>
                                        <div class="media-attachment-container">
                                            @foreach($ticket->file as $file)
                                                @php
                                                    $isImage = isset($file['file_type']) && $file['file_type'] == 'image';
                                                    $fileUrl = $isImage 
                                                        ? get_media($file['original_image'] ?? '', $file['storage'] ?? 'local') 
                                                        : get_media($file['original_file'] ?? '', $file['storage'] ?? 'local');
                                                    $fileName = $isImage 
                                                        ? str_replace('images/', '', $file['original_image'] ?? 'Image') 
                                                        : str_replace('files/', '', $file['original_file'] ?? 'File');
                                                @endphp
                                                <div class="media-attachment-item">
                                                    @if($isImage)
                                                        <a href="{{ $fileUrl }}" target="_blank" title="Click to view full image">
                                                            <img src="{{ $fileUrl }}" alt="{{ $fileName }}">
                                                        </a>
                                                    @else
                                                        <div class="p-4 text-center bg-light">
                                                            <i class="las la-file-alt la-3x text-secondary"></i>
                                                        </div>
                                                    @endif
                                                    <div class="media-attachment-footer">
                                                        <span class="text-truncate me-1 font-11" style="max-width: 70px;" title="{{ $fileName }}">{{ $fileName }}</span>
                                                        <a href="{{ $fileUrl }}" download="{{ $fileName }}" class="btn btn-sm sg-btn-primary p-1 font-11" title="Download File">
                                                            <i class="las la-download"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- 2. REPLIES / CONVERSATION HISTORY -->
                    @if($replies && count($replies) > 0)
                        <div class="col-lg-12 mt-2">
                            <h3 class="section-title mb-3">{{ __('replies') }} ({{ count($replies) }})</h3>

                            @foreach($replies as $key => $reply)
                                @php
                                    $isStaff = $reply->user && in_array($reply->user->role_id, [1, 2, 4, 5]);
                                    $replyName = $isStaff ? ($reply->user ? $reply->user->name : 'Staff') : $studentName;
                                    $replyAvatar = ($reply->user && method_exists($reply->user, 'getProfilePicAttribute')) 
                                        ? $reply->user->profile_pic 
                                        : ($ticket->user && method_exists($ticket->user, 'getProfilePicAttribute') ? $ticket->user->profile_pic : static_asset('images/default/user32x32.jpg'));
                                    $replyRole = $isStaff ? ($reply->user && $reply->user->role ? $reply->user->role->name : 'Staff') : 'Student';
                                    $initial = strtoupper(substr($replyName, 0, 1));
                                @endphp
                                <div class="ticket-card">
                                    <div class="ticket-card-header {{ $isStaff ? 'admin-header' : 'student-header' }}">
                                        <div class="d-flex align-items-center gap-3">
                                            @if($reply->user && $reply->user->images)
                                                <img src="{{ $replyAvatar }}" alt="{{ $replyName }}" class="user-avatar">
                                            @else
                                                <div class="user-initial-avatar" style="{{ $isStaff ? 'background: #10b981;' : 'background: #3b82f6;' }}">{{ $initial }}</div>
                                            @endif

                                            <div>
                                                <div class="d-flex align-items-center gap-2">
                                                    <h5 class="fw-normal mb-0" style="font-size: 15px; color: #1e293b;">{{ $replyName }}</h5>
                                                    <span class="badge {{ $isStaff ? 'bg-success' : 'bg-primary' }} text-white font-11 px-2 py-1">
                                                        {{ $replyRole }}
                                                    </span>
                                                </div>
                                                <span class="text-muted font-12">{{ \Carbon\Carbon::parse($reply->created_at)->format('M d, Y h:i A') }} ({{ \Carbon\Carbon::parse($reply->created_at)->diffForHumans() }})</span>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center gap-2">
                                            @if(hasPermission('ticket.reply.edit'))
                                                <a href="{{ route('ticket.reply.edit', $reply->id) }}" class="btn btn-sm btn-outline-secondary py-1 px-2" title="Edit"><i class="lar la-edit"></i></a>
                                            @endif
                                            @if(hasPermission('ticket.reply.delete'))
                                                <a href="javascript:void(0)" onclick="delete_row('{{ route('ticket.reply.delete', $reply->id) }}', null, true)" class="btn btn-sm btn-outline-danger py-1 px-2" title="Delete"><i class="lar la-trash-alt"></i></a>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="ticket-card-body">
                                        <div class="ticket-message-container {{ $isStaff ? 'reply-staff' : 'reply-student' }}">
                                            <div class="ticket-message-header-label">
                                                <i class="las la-comment-dots {{ $isStaff ? 'text-success' : 'text-primary' }}" style="font-size: 15px;"></i>
                                                <span>{{ $isStaff ? 'Staff Reply' : 'User Reply' }}</span>
                                            </div>
                                            <div class="ticket-message-text">
                                                {!! $reply->reply !!}
                                            </div>
                                        </div>

                                        @if(is_array($reply->file) && count($reply->file) > 0)
                                            <div class="media-attachment-box">
                                                <h6 class="fw-normal text-secondary mb-2" style="font-size: 13px;">
                                                    <i class="las la-paperclip me-1"></i> Attached Files ({{ count($reply->file) }})
                                                </h6>
                                                <div class="media-attachment-container">
                                                    @foreach($reply->file as $file)
                                                        @php
                                                            $isImage = isset($file['file_type']) && $file['file_type'] == 'image';
                                                            $fileUrl = $isImage 
                                                                ? get_media($file['original_image'] ?? '', $file['storage'] ?? 'local') 
                                                                : get_media($file['original_file'] ?? '', $file['storage'] ?? 'local');
                                                            $fileName = $isImage 
                                                                ? str_replace('images/', '', $file['original_image'] ?? 'Image') 
                                                                : str_replace('files/', '', $file['original_file'] ?? 'File');
                                                        @endphp
                                                        <div class="media-attachment-item">
                                                            @if($isImage)
                                                                <a href="{{ $fileUrl }}" target="_blank" title="Click to view full image">
                                                                    <img src="{{ $fileUrl }}" alt="{{ $fileName }}">
                                                                </a>
                                                            @else
                                                                <div class="p-4 text-center bg-light">
                                                                    <i class="las la-file-alt la-3x text-secondary"></i>
                                                                </div>
                                                            @endif
                                                            <div class="media-attachment-footer">
                                                                <span class="text-truncate me-1 font-11" style="max-width: 70px;" title="{{ $fileName }}">{{ $fileName }}</span>
                                                                <a href="{{ $fileUrl }}" download="{{ $fileName }}" class="btn btn-sm sg-btn-primary p-1 font-11" title="Download File">
                                                                    <i class="las la-download"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- 3. WRITE REPLY FORM -->
                    <div class="col-lg-12">
                        <hr style="margin: 24px 0;">
                        <h3 class="section-title mb-3">{{ __('write_replies') }}</h3>

                        <div class="editor-wrapper mb-4">
                            <textarea id="product-update-editor" name="reply"></textarea>
                            <div class="nk-block-des text-danger">
                                <p class="reply_error error"></p>
                            </div>
                        </div>

                        <div class="custom-checkbox mb-12">
                            <label>
                                <input type="checkbox" value="1" name="return_to_list" checked>
                                <span>{{ __('return_to_ticket_list') }}</span>
                            </label>
                        </div>

                        @include('backend.common.media-input', [
                            'title' => 'Slider Image',
                            'name'  => 'file_media_id',
                            'col'   => 'col-12 mt-4',
                            'size'  => '',
                            'image' => old('image'),
                            'label' => __('file'),
                            'for' => '',
                            'selection' => 'multiple',
                        ])
                    </div>
                </div>
            </div>
        </div>

        <div class="homepageFixBTN bg-white py-2 px-4">
            <button type="submit" class="btn sg-btn-primary">{{ __('submit_response') }}</button>
            @include('backend.common.loading-btn', ['class' => 'btn sg-btn-primary'])
        </div>
    </form>

    @include('backend.common.gallery-modal')
    @include('backend.common.delete-script')
@endsection

@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
@endpush
@push('js_asset')
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
@endpush
@push('js')
    <script src="{{ static_asset('admin/js/media.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).on('change', '#ticket_update', function (e) {
                let value = $(this).val();
                let url = $(this).data('route');
                window.location.href = url + '?status=' + value;
            });
        });
    </script>
@endpush
