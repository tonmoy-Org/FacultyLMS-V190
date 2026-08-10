import re
import sys

def main():
    file_path = 'resources/views/backend/admin/course/create.blade.php'
    with open(file_path, 'r', encoding='utf-8') as f:
        content = f.read()

    # 1. Move the Masterclass tab in nav
    tab_pattern = re.compile(r'<li class="nav-item" role="presentation">\s*<a class="nav-link" id="masterclass"[\s\S]*?</li>')
    tab_match = tab_pattern.search(content)
    if not tab_match:
        print("Tab not found!")
        return
    masterclass_tab = tab_match.group(0)
    content = content.replace(masterclass_tab, '')

    basic_info_tab_pattern = re.compile(r'(<li class="nav-item" role="presentation">\s*<a class="nav-link[^>]*?id="basicInformation"[\s\S]*?</li>)')
    content = basic_info_tab_pattern.sub(r'\1\n' + masterclass_tab, content)

    # 2. Adjust tab numbers in create
    # masterclass -> 2
    content = re.sub(r'(<span class="default-tab-count">)\{\{\s*__\(\'5\'\)\s*\}\}(</span>\{\{\s*__\(\'Masterclass Landing\'\)\s*\}\})', r'\g<1>{{ __(\'2\') }}\g<2>', content)
    # media_images -> 3
    content = re.sub(r'(<span class="default-tab-count[^>]*>)\{\{\s*__\(\'2\'\)\s*\}\}(</span>\{\{\s*__\(\'media_images\'\)\s*\}\})', r'\g<1>{{ __(\'3\') }}\g<2>', content)
    # pricing -> 4
    content = re.sub(r'(<span class="default-tab-count[^>]*>)\{\{\s*__\(\'3\'\)\s*\}\}(</span>\{\{\s*__\(\'pricing\'\)\s*\}\})', r'\g<1>{{ __(\'4\') }}\g<2>', content)
    # seo -> 5
    content = re.sub(r'(<span class="default-tab-count[^>]*>)\{\{\s*__\(\'4\'\)\s*\}\}(</span>\{\{\s*__\(\'seo\'\)\s*\}\})', r'\g<1>{{ __(\'5\') }}\g<2>', content)


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
    old_mc_btns = re.compile(r'<div class="col-lg-12">\s*<div class="d-flex justify-content-between align-items-center mt-30">\s*<a href="#" class="btn sg-btn-outline-primary btn_action"\s*data-bs-target="#courseSEO">\{\{\s*__\(\'back\'\)\s*\}\}</a>\s*<button type="submit" class="btn sg-btn-primary">\{\{\s*__\(\'submit\'\)\s*\}\}</button>\s*</div>\s*</div>')
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

    # SEO next to submit button
    content = re.sub(r'(id="courseSEO".*?data-bs-target="#coursePricing">.*?)(<a href="#" type="button"\s*class="btn sg-btn-primary btn_action"\s*data-bs-target="#courseMasterclass">\{\{\s*__\(\'next\'\)\s*\}\}</a>)', r'\1<button type="submit" class="btn sg-btn-primary">{{ __(\'submit\') }}</button>', content, flags=re.DOTALL)

    with open(file_path, 'w', encoding='utf-8') as f:
        f.write(content)
        
    print("Done editing create.blade.php")

if __name__ == '__main__':
    main()
