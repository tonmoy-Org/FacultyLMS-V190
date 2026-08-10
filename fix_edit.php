<?php
$file = 'resources/views/backend/admin/course/edit.blade.php';
$content = file_get_contents($file);

// 1. Update Masterclass buttons in edit
$oldMasterclassBtns = '/<div class="col-lg-12">\s*<div class="d-flex justify-content-between align-items-center mt-30">\s*<a href="#" class="btn sg-btn-outline-primary btn_action"\s*data-bs-target="#courseFAQ">.*?<\/button>\s*<\/div>\s*<\/div>/is';

$newMasterclassBtns = '<div class="col-lg-12">
    <div class="d-flex justify-content-between align-items-center mt-30 pt-3 border-top">
        <a href="#" type="button" class="btn sg-btn-outline-primary btn_action"
            data-bs-target="#basicCourseInformation">{{ __(\'back\') }}</a>

        <a href="#" type="button" class="btn sg-btn-primary btn_action"
            data-bs-target="#courseMediaImages">{{ __(\'next\') }}</a>
    </div>
</div>';

$content = preg_replace($oldMasterclassBtns, $newMasterclassBtns, $content);

// 2. Update FAQ Next button to Submit button in edit
$faqBtnsRegex = '/(id="courseFAQ".*?data-bs-target="#courseResource">.*?)(<a href="#" type="button"\s*class="btn sg-btn-primary btn_action"\s*data-bs-target="#courseMasterclass">\{\{\s*__\(\'next\'\)\s*\}\}<\/a>)/is';

$submitBtn = '<button type="submit" class="btn sg-btn-primary">{{ __(\'update\') }}</button>';
$content = preg_replace($faqBtnsRegex, '$1' . $submitBtn, $content);

file_put_contents($file, $content);
echo "Done.\n";
?>
