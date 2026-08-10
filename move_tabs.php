<?php
$files = [
    'resources/views/backend/admin/course/create.blade.php',
    'resources/views/backend/admin/course/edit.blade.php'
];

foreach ($files as $file) {
    if (!file_exists($file)) continue;
    
    $content = file_get_contents($file);

    // 1. Move Tab in Nav Menu
    $tabRegex = '/<li class="nav-item" role="presentation">\s*<a class="nav-link[^"]*" id="masterclass".*?<\/li>/is';
    if (preg_match($tabRegex, $content, $matches)) {
        $masterclassTab = $matches[0];
        $content = preg_replace($tabRegex, '', $content);
        
        $basicInfoTabRegex = '/(<li class="nav-item" role="presentation">\s*<a class="nav-link[^"]*" id="basicInformation".*?<\/li>)/is';
        $content = preg_replace($basicInfoTabRegex, '$1' . "\n" . $masterclassTab, $content);
    }

    // 2. Adjust Tab Numbers
    if (strpos($file, 'create.blade.php') !== false) {
        $content = preg_replace('/(<span[^>]*class="default-tab-count[^"]*">(?:\{\{\s*__\(\')2(\'\)\s*\}\})<\/span>\{\{\s*__\(\')media_images(\'\)\s*\}\}<\/a>)/', '$13$2', $content);
        $content = preg_replace('/(<span[^>]*class="default-tab-count[^"]*">(?:\{\{\s*__\(\')3(\'\)\s*\}\})<\/span>\{\{\s*__\(\')pricing(\'\)\s*\}\}<\/a>)/', '$14$2', $content);
        $content = preg_replace('/(<span[^>]*class="default-tab-count[^"]*">(?:\{\{\s*__\(\')4(\'\)\s*\}\})<\/span>\{\{\s*__\(\')seo(\'\)\s*\}\}<\/a>)/', '$15$2', $content);
        $content = preg_replace('/(<span[^>]*class="default-tab-count[^"]*">(?:\{\{\s*__\(\')5(\'\)\s*\}\})<\/span>\{\{\s*__\(\')Masterclass Landing(\'\)\s*\}\}<\/a>)/', '$12$2', $content);
    } else {
        // Edit blade has dynamic numbers based on course_type
        $content = preg_replace('/(<span class="default-tab-count masterclassIndex">\s*@if \(\$course->course_type == \'live_class\'\)\s*\{\{\s*)10(\s*\}\}\s*@else\s*\{\{\s*)9(\s*\}\}\s*@endif\s*<\/span>)/', '${1}2${2}2$3', $content);
    }

    // 3. Move Pane Content
    $paneRegex = '/<!-- Start Masterclass Landing Tab -->.*?<!-- End Masterclass Landing Tab -->/is';
    if (preg_match($paneRegex, $content, $matches)) {
        $masterclassPane = $matches[0];
        $content = preg_replace($paneRegex, '', $content);
        
        $basicInfoPaneRegex = '/(<!-- End Basic Course Information -->)/is';
        $content = preg_replace($basicInfoPaneRegex, '$1' . "\n" . $masterclassPane, $content);
    }

    // 4. Update Navigation Buttons
    // Basic Info Next -> courseMasterclass
    $content = preg_replace('/(id="basicCourseInformation".*?)data-bs-target="#courseMediaImages"(>\{\{\s*__\(\'next\'\)\s*\}\}<\/a>\s*<\/div>\s*<\/div>\s*<!-- End Next Page BTN -->\s*<\/div>\s*<\/div>\s*<!-- End Basic Course Information -->)/is', '${1}data-bs-target="#courseMasterclass"$2', $content);

    // courseMediaImages Back -> courseMasterclass, Next -> coursePricing
    $content = preg_replace('/(id="courseMediaImages".*?)data-bs-target="#basicCourseInformation"(>\{\{\s*__\(\'back\'\)\s*\}\}<\/a>\s*<a[^>]*data-bs-target=")#coursePricing(">\{\{\s*__\(\'next\'\)\s*\}\}<\/a>\s*<\/div>\s*<\/div>\s*<!-- End Next Page BTN -->\s*<\/div>\s*<\/div>\s*<!-- End Course Media Images -->)/is', '${1}data-bs-target="#courseMasterclass"$2#coursePricing$3', $content);

    // coursePricing Back -> courseMediaImages, Next -> courseSEO (in create) or courseCurriculum (in edit)
    if (strpos($file, 'create.blade.php') !== false) {
        $content = preg_replace('/(id="coursePricing".*?)data-bs-target="#courseMediaImages"(>\{\{\s*__\(\'back\'\)\s*\}\}<\/a>\s*<a[^>]*data-bs-target=")#courseSEO(">\{\{\s*__\(\'next\'\)\s*\}\}<\/a>\s*<\/div>\s*<\/div>\s*<!-- End Next Page BTN -->\s*<\/div>\s*<!-- End Product images section -->\s*<\/div>\s*<!-- End Course Pricing -->)/is', '${1}data-bs-target="#courseMediaImages"$2#courseSEO$3', $content);
    } else {
        $content = preg_replace('/(id="coursePricing".*?)data-bs-target="#courseMediaImages"(>\{\{\s*__\(\'back\'\)\s*\}\}<\/a>\s*<a[^>]*data-bs-target=")#courseCurriculum(">\{\{\s*__\(\'next\'\)\s*\}\}<\/a>\s*<\/div>\s*<\/div>\s*<!-- End Next Page BTN -->\s*<\/div>\s*<!-- End Product images section -->\s*<\/div>\s*<!-- End Course Pricing -->)/is', '${1}data-bs-target="#courseMediaImages"$2#courseCurriculum$3', $content);
    }

    // Replace Masterclass submit button with proper Next/Back
    $oldButtonsRegex = '/<div class="d-flex align-items-center justify-content-between pt-3 border-top">\s*<a href="#" class="btn sg-btn-outline-primary btn_action" data-bs-toggle="tab" data-bs-target="#courseSEO">\{\{\s*__\(\'back\'\)\s*\}\}<\/a>\s*<button type="submit" class="btn sg-btn-primary py-2 px-4 fs-6"><i class="fas fa-check-circle me-1"><\/i> \{\{\s*__\(\'submit\'\)\s*\}\}<\/button>\s*<\/div>/is';
    
    $newButtons = '<div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mt-30 pt-3 border-top">
                                            <a href="#" type="button" class="btn sg-btn-outline-primary btn_action"
                                                data-bs-target="#basicCourseInformation">{{ __(\'back\') }}</a>

                                            <a href="#" type="button" class="btn sg-btn-primary btn_action"
                                                data-bs-target="#courseMediaImages">{{ __(\'next\') }}</a>
                                        </div>
                                    </div>';
    $content = preg_replace($oldButtonsRegex, $newButtons, $content);

    // courseSEO (in create) or faq (in edit) Submit button
    if (strpos($file, 'create.blade.php') !== false) {
        $seoButtonsRegex = '/(id="courseSEO".*?)data-bs-target="#coursePricing">(.*?)(<a href="#" type="button" class="btn sg-btn-primary btn_action"\s*data-bs-target="#courseMasterclass">\{\{\s*__\(\'next\'\)\s*\}\}<\/a>)(.*?<\/div>\s*<\/div>\s*<!-- End Next Page BTN -->\s*<\/div>\s*<\/div>\s*<!-- End Course SEO -->)/is';
        $submitBtn = '<button type="submit" class="btn sg-btn-primary py-2 px-4 fs-6"><i class="fas fa-check-circle me-1"></i> {{ __(\'submit\') }}</button>';
        $content = preg_replace($seoButtonsRegex, '${1}data-bs-target="#coursePricing">$2' . $submitBtn . '$4', $content);
    } else {
        // In edit, faq points back to resource and next to masterclass (which is now step 2)
        // We need to change FAQ next button to submit button
        $faqButtonsRegex = '/(id="courseFaq".*?)data-bs-target="#courseResource">(.*?)(<a href="#" type="button" class="btn sg-btn-primary btn_action"\s*data-bs-target="#courseMasterclass">\{\{\s*__\(\'next\'\)\s*\}\}<\/a>)(.*?<\/div>\s*<\/div>\s*<!-- End Next Page BTN -->\s*<\/div>\s*<\/div>\s*<!-- End Course Faq -->)/is';
        $submitBtn = '<button type="submit" class="btn sg-btn-primary py-2 px-4 fs-6"><i class="fas fa-check-circle me-1"></i> {{ __(\'submit\') }}</button>';
        $content = preg_replace($faqButtonsRegex, '${1}data-bs-target="#courseResource">$2' . $submitBtn . '$4', $content);
    }

    file_put_contents($file, $content);
}
echo "Tabs updated successfully!\n";
?>
