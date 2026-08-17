@if(hasPermission('enrollments.status'))
    <ul class="d-flex gap-30 justify-content-end align-items-center">
        <li>
            <a href="javascript:void(0)"
               onclick="delete_row('{{ route('enrollments.status', $checkout->id) }}')"
               data-toggle="tooltip" title="{{ __('change_status') }}"><i @class([
                'las la-check' => !$checkout->status,
                'las la-times' => $checkout->status
           ])></i></a>
        </li>
        <li>
            <a href="javascript:void(0)"
               onclick="delete_row('{{ route('enrollments.destroy', $checkout->id) }}')"
               data-toggle="tooltip" title="{{ __('delete') }}"><i class="las la-trash text-danger"></i></a>
        </li>
    </ul>
@endif
