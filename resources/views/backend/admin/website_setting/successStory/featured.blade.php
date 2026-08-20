@if(hasPermission('success-stories.edit'))
    <div class="setting-check">
        <input type="checkbox" class="status-change"
               {{ ($success_story->is_featured == 1) ? 'checked' : '' }} data-id="{{ $success_story->id }}"
               value="success-feature/{{$success_story->id}}"
               id="customSwitchFeatured-{{$success_story->id}}">
        <label for="customSwitchFeatured-{{ $success_story->id }}"></label>
    </div>
@endif
