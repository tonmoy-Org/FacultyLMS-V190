import re
import sys

def main():
    file_path = 'resources/views/backend/admin/course/edit.blade.php'
    with open(file_path, 'r', encoding='utf-8') as f:
        content = f.read()

    # 1. Move the Masterclass tab in nav
    tab_pattern = re.compile(r'<li class="nav-item" role="presentation">\s*<a class="nav-link tab_change [^>]*?id="masterclass"[\s\S]*?</li>')
    tab_match = tab_pattern.search(content)
    if not tab_match:
        print("Tab not found!")
        return
    masterclass_tab = tab_match.group(0)
    content = content.replace(masterclass_tab, '')

    basic_info_tab_pattern = re.compile(r'(<li class="nav-item" role="presentation">\s*<a class="nav-link[^>]*?id="basicInformation"[\s\S]*?</li>)')
    content = basic_info_tab_pattern.sub(r'\1\n' + masterclass_tab, content)

    # 2. Adjust tab numbers
    # For edit.blade.php, masterclass is 2, others shift by +1
    content = re.sub(r'(<span class="default-tab-count courseMediaImagesIndex">\s*@if \(\$course->course_type == \'live_class\'\)\s*\{\{\s*)2(\s*\}\}\s*@else\s*\{\{\s*)2(\s*\}\}\s*@endif\s*</span>)', r'\g<1>3\g<2>3\g<3>', content)
    content = re.sub(r'(<span class="default-tab-count coursePricingIndex">\s*@if \(\$course->course_type == \'live_class\'\)\s*\{\{\s*)3(\s*\}\}\s*@else\s*\{\{\s*)3(\s*\}\}\s*@endif\s*</span>)', r'\g<1>4\g<2>4\g<3>', content)
    content = re.sub(r'(<span class="default-tab-count courseSeoIndex">\s*@if \(\$course->course_type == \'live_class\'\)\s*\{\{\s*)4(\s*\}\}\s*@else\s*\{\{\s*)4(\s*\}\}\s*@endif\s*</span>)', r'\g<1>5\g<2>5\g<3>', content)
    content = re.sub(r'(<span class="default-tab-count coursecurriculumIndex">\s*@if \(\$course->course_type == \'live_class\'\)\s*\{\{\s*)5(\s*\}\}\s*@else\s*\{\{\s*)5(\s*\}\}\s*@endif\s*</span>)', r'\g<1>6\g<2>6\g<3>', content)
    
    # liveclass is 6->7 (only if live_class) - wait, it is only 1 number
    content = re.sub(r'(<span class="default-tab-count [^>]*>)\s*6\s*(</span>\s*\{\{\s*__\(\'Live Class\'\))', r'\1 7 \2', content)

    # assignment
    content = re.sub(r'(<span class="default-tab-count courseAssignmentIndex">\s*@if \(\$course->course_type == \'live_class\'\)\s*\{\{\s*)7(\s*\}\}\s*@else\s*\{\{\s*)6(\s*\}\}\s*@endif\s*</span>)', r'\g<1>8\g<2>7\g<3>', content)
    # resource
    content = re.sub(r'(<span class="default-tab-count courseresourceIndex">\s*@if \(\$course->course_type == \'live_class\'\)\s*\{\{\s*)8(\s*\}\}\s*@else\s*\{\{\s*)7(\s*\}\}\s*@endif\s*</span>)', r'\g<1>9\g<2>8\g<3>', content)
    # faq
    content = re.sub(r'(<span class="default-tab-count coursefaqIndex">\s*@if \(\$course->course_type == \'live_class\'\)\s*\{\{\s*)9(\s*\}\}\s*@else\s*\{\{\s*)8(\s*\}\}\s*@endif\s*</span>)', r'\g<1>10\g<2>9\g<3>', content)
    
    # masterclass -> 2
    content = re.sub(r'(<span class="default-tab-count masterclassIndex">\s*@if \(\$course->course_type == \'live_class\'\)\s*\{\{\s*)10(\s*\}\}\s*@else\s*\{\{\s*)9(\s*\}\}\s*@endif\s*</span>)', r'\g<1>2\g<2>2\g<3>', content)


    # 3. Move the pane
    pane_pattern = re.compile(r'<!-- Start Masterclass Landing Tab -->[\s\S]*?<!-- End Masterclass Landing Tab -->')
    pane_match = pane_pattern.search(content)
    if not pane_match:
        print("Pane not found!")
        return
    masterclass_pane = pane_match.group(0)
    content = content.replace(masterclass_pane, '')
    
    basic_info_pane_pattern = re.compile(r'(<!-- End Basic Course Information -->)')
    content = basic_info_pane_pattern.sub(r'\1\n' + masterclass_pane, content)

    # 4. Update Buttons
    # basic to masterclass
    content = re.sub(r'(id="basicCourseInformation".*?data-bs-target=")#courseMediaImages(">\{\{\s*__\(\'next\'\)\s*\}\}</a>\s*</div>\s*</div>\s*<!-- End Next Page BTN -->\s*</div>\s*</div>\s*<!-- End Basic Course Information -->)', r'\g<1>#courseMasterclass\g<2>', content, flags=re.DOTALL)
    
    # masterclass buttons (update to have next and back)
    old_mc_btns = re.compile(r'<div class="col-lg-12">\s*<div class="d-flex justify-content-between align-items-center mt-30">\s*<a href="#" class="btn sg-btn-outline-primary btn_action" data-bs-target="#courseFAQ">\{\{\s*__\(\'back\'\)\s*\}\}</a>\s*<button type="submit" class="btn sg-btn-primary">\{\{\s*__\(\'update\'\)\s*\}\}</button>\s*</div>\s*</div>')
    new_mc_btns = '''<div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mt-30 pt-3 border-top">
                                            <a href="#" type="button" class="btn sg-btn-outline-primary btn_action"
                                                data-bs-target="#basicCourseInformation">{{ __('back') }}</a>

                                            <a href="#" type="button" class="btn sg-btn-primary btn_action"
                                                data-bs-target="#courseMediaImages">{{ __('next') }}</a>
                                        </div>
                                    </div>'''
    content = old_mc_btns.sub(new_mc_btns, content)

    # mediaImages back to masterclass
    content = re.sub(r'(id="courseMediaImages".*?data-bs-target=")#basicCourseInformation(">\{\{\s*__\(\'back\'\)\s*\}\}</a>\s*<a[^>]*data-bs-target=")#coursePricing(">\{\{\s*__\(\'next\'\)\s*\}\}</a>\s*</div>\s*</div>\s*<!-- End Next Page BTN -->\s*</div>\s*</div>\s*<!-- End Course Media Images -->)', r'\g<1>#courseMasterclass\g<2>#coursePricing\g<3>', content, flags=re.DOTALL)

    # FAQ next to update button
    # FAQ originally pointed back to resource, and next to masterclass
    content = re.sub(r'(id="courseFAQ".*?data-bs-target="#courseResource">.*?)(<a href="#" type="button"\s*class="btn sg-btn-primary btn_action"\s*data-bs-target="#courseMasterclass">\{\{\s*__\(\'next\'\)\s*\}\}</a>)', r'\1<button type="submit" class="btn sg-btn-primary">{{ __(\'update\') }}</button>', content, flags=re.DOTALL)

    with open(file_path, 'w', encoding='utf-8') as f:
        f.write(content)
        
    print("Done editing edit.blade.php")

if __name__ == '__main__':
    main()
