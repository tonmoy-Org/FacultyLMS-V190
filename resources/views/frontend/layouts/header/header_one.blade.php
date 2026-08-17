<header
    class="template-header header-layout-1 course-item-active {{ isHome() ? 'nav-white-color position-absolute' : (isAuth() ? 'bg-white' : '')}}">
    <div class="header-navigation sticky-header {{ isHome() ? '': 'header-shadow'}}">
        <div class="container container-1278">
            <style>
                .template-header.header-layout-1 .header-inner { padding-top: 5px !important; padding-bottom: 5px !important; min-height: auto !important; }
                .template-header .nav-menu > ul > li > a { padding-top: 8px !important; padding-bottom: 8px !important; }
                .header-extra { padding-top: 5px !important; padding-bottom: 5px !important; }
                .template-header.header-layout-1 .header-inner { height: 70px !important; }
                .template-header.header-layout-1 .header-inner .brand-logo { max-height: 50px !important; }
                .template-header.header-layout-1 .header-inner .brand-logo img { max-height: 35px !important; }
                .template-header.header-layout-1 .header-inner .nav-menu > ul > li > a { line-height: 60px !important; }
                .template-header.header-layout-1 .header-inner .nav-menu > ul { padding-left: 0 !important; margin-left: 0 !important; justify-content: center; }
                .template-header.header-layout-1 .header-inner .nav-menu > ul > li { flex: 1 1 0px; text-align: center; min-width: 100px; display: flex; justify-content: center; }
                .template-header.header-layout-1 .header-inner .nav-menu > ul > li:last-child { margin-inline-end: 0 !important; }
                @media (max-width: 991.98px) {
                    .template-header.header-layout-1 .header-navigation { padding: 8px 0 !important; }
                    .template-header.header-layout-1 .header-inner { position: relative !important; display: flex !important; align-items: center !important; justify-content: space-between !important; height: 60px !important; min-height: 60px !important; padding-left: 16px !important; padding-right: 16px !important; }
                    .template-header.header-layout-1 .navbar-toggler { position: absolute !important; inset-inline-start: 16px !important; top: 50% !important; transform: translateY(-50%) !important; margin: 0 !important; z-index: 25 !important; display: flex !important; flex-direction: column !important; justify-content: center !important; padding: 6px !important; }
                    .template-header.header-layout-1 .header-left { position: absolute !important; left: 50% !important; top: 50% !important; transform: translate(-50%, -50%) !important; width: auto !important; max-width: 55% !important; display: flex !important; align-items: center !important; justify-content: center !important; z-index: 10 !important; margin: 0 !important; padding: 0 !important; }
                    .template-header.header-layout-1 .header-left .brand-logo { margin-inline-end: 0 !important; display: flex !important; align-items: center !important; justify-content: center !important; margin: 0 !important; }
                    .template-header.header-layout-1 .header-left .brand-logo a { align-items: center; display: flex; }
                    .template-header.header-layout-1 .header-left .brand-logo a.sticky-logo { display: none !important; }
                    .template-header.header-layout-1 .header-navigation.sticky-on .header-left .brand-logo a.sticky-logo { display: flex !important; }
                    .template-header.header-layout-1 .header-navigation.sticky-on .header-left .brand-logo a.main-logo { display: none !important; }
                    .template-header.header-layout-1 .header-left .brand-logo img { max-height: 32px !important; width: auto !important; object-fit: contain !important; }
                    .template-header.header-layout-1 .header-right { position: relative !important; margin-inline-start: auto !important; margin-inline-end: 0 !important; display: flex !important; align-items: center !important; justify-content: flex-end !important; z-index: 20 !important; height: 100% !important; padding-right: 0 !important; }
                    .template-header.header-layout-1 .header-extra { padding: 0 !important; margin: 0 !important; display: flex !important; align-items: center !important; }
                    .template-header.header-layout-1 .header-extra > ul { display: flex !important; align-items: center !important; margin: 0 !important; padding: 0 !important; gap: 8px !important; list-style: none !important; }
                    .template-header.header-layout-1 .header-extra > ul > li { display: flex !important; align-items: center !important; margin: 0 !important; }
                    .template-header.header-layout-1 .header-extra .user-profile-dropdown .dropdown-toggle { padding: 0 !important; margin: 0 !important; display: flex !important; align-items: center !important; text-decoration: none !important; }
                    .template-header.header-layout-1 .header-extra .user-profile-dropdown .dropdown-toggle::after { display: none !important; }
                    .template-header.header-layout-1 .header-extra .user-profile-dropdown .dropdown-toggle span { display: none !important; }
                    .template-header.header-layout-1 .header-extra .user-profile-dropdown .dropdown-toggle img { width: 36px !important; height: 36px !important; min-width: 36px !important; min-height: 36px !important; border-radius: 50% !important; object-fit: cover !important; margin-inline-end: 0 !important; border: 2px solid rgba(255, 255, 255, 0.5) !important; box-shadow: 0 2px 6px rgba(0,0,0,0.12) !important; background-color: #ffffff !important; }
                    .template-header.header-layout-1 .header-extra .login-btn .get-access-btn { padding: 6px 14px !important; font-size: 13px !important; font-weight: 600 !important; border-radius: 20px !important; white-space: nowrap !important; color: #ffffff !important; background-color: var(--theme-clr, #10b981) !important; border: none !important; box-shadow: 0 2px 6px rgba(0,0,0,0.15) !important; display: inline-flex !important; align-items: center !important; }
                    .template-header.header-layout-1 .header-extra .login-btn .get-access-btn span { display: inline-block !important; }
                }
            </style>
            <div class="header-inner d-flex align-items-center justify-content-between py-0 position-relative">
                <div class="header-left" style="flex: 1;">
                    <div class="brand-logo d-flex align-items-center">
                        @if(config('app.demo_mode'))

                            @php
                                $logo           = isHome() ? get_media('images/default/logo/'.setting('theme_color').'/logo-white-text.png') : get_media('images/default/logo/'.setting('theme_color').'/logo-black-text.png');
                                $sticky_logo    = get_media('images/default/logo/'.setting('theme_color').'/logo-black-text.png');
                            @endphp
                            <a href="{{ route('home') }}" class="main-logo">
                                <img
                                    src="{{ $logo }}"
                                    alt="logo">
                            </a>
                            <a href="{{ route('home') }}" class="sticky-logo">
                                <img
                                    src="{{ $sticky_logo }}"
                                    alt="logo">
                            </a>
                        @else
                            <a href="{{ route('home') }}" class="main-logo">
                                <img
                                    src="{{ isHome() ? (setting('light_logo') && @is_file_exists(setting('light_logo')['original_image']) ? get_media(setting('light_logo')['original_image']) : get_media('images/default/logo/logo-green-white.png')) : (setting('dark_logo') && @is_file_exists(setting('dark_logo')['original_image']) ? get_media(setting('dark_logo')['original_image']) : get_media('images/default/logo/logo-green-black.png')) }}"
                                    alt="logo">
                            </a>
                            <a href="{{ route('home') }}" class="sticky-logo">
                                <img
                                    src="{{ (setting('dark_logo') && @is_file_exists(setting('dark_logo')['original_image']) ? get_media(setting('dark_logo')['original_image']) : get_media('images/default/logo/logo-green-black.png')) }}"
                                    alt="logo">
                            </a>
                        @endif
                    </div>
                </div>
                <div class="header-center position-absolute start-50 translate-middle-x d-none d-lg-flex justify-content-center align-items-center" style="z-index: 10;">
                    <nav class="nav-menu">
                        <ul class="mb-0 d-flex align-items-center p-0">
                            @if (setting('show_default_courses_link') != 0)
                                @if (setting('website_mode') == 'single_course')
                                    @php
                                        $singleCourseId = setting('single_course_id');
                                        $featuredCourse = null;
                                        if ($singleCourseId) {
                                            $featuredCourse = \App\Models\Course::where('id', $singleCourseId)->where('status', 'approved')->first();
                                        }
                                        if (! $featuredCourse) {
                                            $featuredCourse = \App\Models\Course::where('status', 'approved')->first();
                                        }
                                    @endphp
                                    <li class="course-active">
                                        <a href="{{ $featuredCourse ? route('course.details', $featuredCourse->slug) : route('courses') }}">{{__("course")}}</a>
                                    </li>
                                @else
                                    @php
                                        $maxCategoriesPerColumn = 5;
                                        $columns = $categories->chunk($maxCategoriesPerColumn);
                                        if ($columns->count() > 4):
                                            $columns = $columns->chunk(ceil($columns->count() / 4));
                                        endif;
                                    @endphp
                                    <li class="course-active">
                                        <a data-bs-toggle="dropdown" href="javascript:void(0)">{{__("course")}}</a>
                                        <div class="mega-menu dropdown-menu">
                                            <h6 class="border-bottom-soft-white fw-semibold m-b-10 p-b-10 m-l-25 m-r-25">{{__('course_by_categories')}}</h6>
                                            <div class="row g-0">
                                                @foreach($columns as $columnSet)
                                                    @if($loop->index < 4)
                                                        <div class="col">
                                                            <ul class="sub-menu">
                                                                @foreach($columnSet as $category)
                                                                    <li>
                                                                        <a href="{{ route('category.courses',$category->slug) }}">{{ $category->lang_title }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endif

                            @if(is_array(headerFooterMenu('header_menu', app()->getLocale())))
                                @foreach(headerFooterMenu('header_menu', app()->getLocale()) as $main_menu)
                                    @php
                                        $menu_path = trim(parse_url($main_menu['url'], PHP_URL_PATH) ?? '', '/');
                                        $is_home_menu = ($main_menu['url'] == '/' || $main_menu['url'] == '' || $menu_path == '');
                                        if ($is_home_menu) {
                                            $is_active = (request()->is('/') || url()->current() == url('/'));
                                        } else {
                                            $is_active = (url($main_menu['url']) == url()->current() 
                                                || url($main_menu['url']) == url()->full() 
                                                || ($menu_path != '' && (request()->is($menu_path . '*') || ($menu_path == 'courses' && request()->is('course*')))));
                                        }
                                    @endphp
                                    <li class="{{ $is_active ? 'active' : '' }}">
                                        <a href="{{ url('') == url($main_menu['url']) ? route('home') : url($main_menu['url']) }}"
                                           data-bs-toggle="dropdown">{{ $main_menu['label'] }}</a>
                                        @if (count($main_menu) > 3)
                                            @if ($main_menu['mega_menu'] == 'true')
                                                @php
                                                    $maxSubmenuPerColumn = 5;
                                                    $megaMenuColumns = collect(array_slice($main_menu, 3))->chunk($maxSubmenuPerColumn);
                                                    if ($megaMenuColumns->count() > 4):
                                                        $megaMenuColumns = $megaMenuColumns->chunk(ceil($megaMenuColumns->count() / 4));
                                                    endif;
                                                @endphp
                                                <div class="mega-menu dropdown-menu">
                                                    <div class="row g-0">
                                                        @foreach($megaMenuColumns as $megaMenuColumn)
                                                            @if($loop->index < 4)
                                                                <div class="col">
                                                                    <ul class="sub-menu">
                                                                        @foreach($megaMenuColumn as $subMenu)
                                                                            <li>
                                                                                <a href="{{url($subMenu['url'])}}">{{$subMenu['label']}}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @else
                                                <ul class="sub-menu">
                                                    @foreach (array_slice($main_menu, 3) as $submenu)
                                                        <li>
                                                            <a href="{{url($submenu['url'])}}">{{ $submenu['label'] }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif

                                        @endif
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </nav>
                </div>
                <div class="header-right d-flex justify-content-end align-items-center" style="flex: 1;">
                    <ul class="header-extra d-flex align-items-center mb-0">
                        <!-- <li>
                            <form class="searchbox search-dark-color" action="{{ route('courses') }}" method="GET">
                                <input type="search" placeholder="{{ __('search') }}" name="search"
                                       class="searchbox-input header_search" data-url="{{ route('header.search') }}">
                                <div class="quick-search-result">

                                </div>
                                <button type="submit" class="searchbox-submit" aria-label="Search">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.4255 17.6289C16.2683 17.6289 16.1173 17.5685 15.9964 17.4537L12.9871 14.4383C11.5247 15.6952 9.70583 16.3297 7.88089 16.3297C5.86863 16.3297 3.85636 15.5623 2.32753 14.0334C0.84099 12.5469 0.0252075 10.5769 0.0252075 8.48006C0.0252075 6.38319 0.84099 4.40719 2.32753 2.92669C5.39124 -0.137023 10.3766 -0.137023 13.4343 2.92669C16.3529 5.84538 16.4859 10.5044 13.8391 13.5863L16.8545 16.6016C17.0902 16.8373 17.0902 17.218 16.8545 17.4537C16.7336 17.5685 16.5826 17.6289 16.4255 17.6289ZM12.5822 3.77873C11.289 2.48557 9.58497 1.83294 7.88089 1.83294C6.17681 1.83294 4.47878 2.47952 3.17957 3.77873C1.92266 5.03564 1.23377 6.70346 1.23377 8.48006C1.23377 10.2567 1.92266 11.9245 3.17957 13.1814C5.77194 15.7738 9.98984 15.7738 12.5822 13.1814C15.1746 10.589 15.1746 6.37111 12.5822 3.77873Z"
                                            fill="#333333"/>
                                    </svg>
                                </button>
                                <span class="searchbox-icon">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.4255 17.6289C16.2683 17.6289 16.1173 17.5685 15.9964 17.4537L12.9871 14.4383C11.5247 15.6952 9.70583 16.3297 7.88089 16.3297C5.86863 16.3297 3.85636 15.5623 2.32753 14.0334C0.84099 12.5469 0.0252075 10.5769 0.0252075 8.48006C0.0252075 6.38319 0.84099 4.40719 2.32753 2.92669C5.39124 -0.137023 10.3766 -0.137023 13.4343 2.92669C16.3529 5.84538 16.4859 10.5044 13.8391 13.5863L16.8545 16.6016C17.0902 16.8373 17.0902 17.218 16.8545 17.4537C16.7336 17.5685 16.5826 17.6289 16.4255 17.6289ZM12.5822 3.77873C11.289 2.48557 9.58497 1.83294 7.88089 1.83294C6.17681 1.83294 4.47878 2.47952 3.17957 3.77873C1.92266 5.03564 1.23377 6.70346 1.23377 8.48006C1.23377 10.2567 1.92266 11.9245 3.17957 13.1814C5.77194 15.7738 9.98984 15.7738 12.5822 13.1814C15.1746 10.589 15.1746 6.37111 12.5822 3.77873Z"
                                            fill="#333333"/>
                                    </svg>
                                </span>
                            </form>
                        </li> -->
                        @if(auth()->check())
                            @if(!auth() || auth()->user()->user_type == 'student')
                                <li class="shopping-mini-cart">
                                    <a href="#" class="cart-btn">
                                        <svg width="16" height="18" viewBox="0 0 16 18" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14.3212 4.16667H12.205C11.9291 1.82368 9.93149 0 7.51563 0C5.09976 0 3.10212 1.82368 2.82625
                                        4.16667H0.710069C0.326528 4.16667 0.015625 4.47757 0.015625 4.86111V17.0833C0.015625 17.4669 0.326528 17.7778 0.710069
                                        17.7778H14.3212C14.7047 17.7778 15.0156 17.4669 15.0156 17.0833V4.86111C15.0156 4.47757 14.7047 4.16667 14.3212 4.16667ZM7.51563 1.38889C9.16438 1.38889
                                         10.5371 2.59219 10.8024 4.16667H4.22885C4.49413 2.59219 5.86688 1.38889 7.51563 1.38889ZM13.6267 16.3889H1.40451V5.55556H2.7934V7.63889C2.7934 8.02243 3.10431 8.33333
                                         3.48785 8.33333C3.87139 8.33333 4.18229 8.02243 4.18229 7.63889V5.55556H10.849V7.63889C10.849 8.02243 11.1599 8.33333 11.5434 8.33333C11.9269 8.33333 12.2378 8.02243 12.2378
                                         7.63889V5.55556H13.6267V16.3889Z"
                                                fill="#333333"/>
                                        </svg>
                                        <input type="text"
                                               class="badge {{ (count($carts['courses'])+count($carts['books']) > 0) ? '' :'d-none'}}"
                                               id="cart_iteam_no"
                                               value="{{ count($carts['courses'])+count($carts['books']) }}">

                                    </a>
                                </li>
                            @endif
                        @endif
                        {{-- <li class="language-selection d-sm-block">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#languageCurrencyModal">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9 15.75C12.7279 15.75 15.75 12.7279 15.75 9C15.75 5.27208 12.7279 2.25 9 2.25C5.27208 2.25 2.25 5.27208 2.25 9C2.25 12.7279 5.27208 15.75 9 15.75Z"
                                        stroke="#333333" stroke-width="1.2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path d="M2.25 9H15.75" stroke="#333333" stroke-width="1.2" stroke-linecap="round"
                                          stroke-linejoin="round"></path>
                                    <path
                                        d="M9 2.25C10.876 4.09839 11.9421 6.49712 12 9C11.9421 11.5029 10.876 13.9016 9 15.75C7.12404 13.9016 6.05794 11.5029 6 9C6.05794 6.49712 7.12404 4.09839 9 2.25V2.25Z"
                                        stroke="#333333" stroke-width="1.2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </a>
                        </li> --}}
                        @if(auth()->check())
                            <li class="user-profile-dropdown">
                                <a href="#" class="dropdown-toggle" id="userProfileDropdown" data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                    <img src="{{ getFileLink('40x40', Auth()->user()->images) }}" width="32" alt="User">
                                    <span>{{ Auth()->user()->first_name }}</span>
                                </a>
                                <div
                                    class="user-profile-dropdown-content dropdown-menu dropdown-menu-end profile-sidebar"
                                    aria-labelledby="userProfileDropdown">
                                    <div class="profile-info">
                                        <div class="profile-picture">
                                            <img src="{{ getFileLink('40x40', Auth()->user()->images) }}"
                                                 alt="Profile Picture">
                                        </div>
                                        <div class="profile-info-content">
                                            <h3>{{ Auth()->user()->first_name }} {{ Auth()->user()->last_name }}</h3>
                                            <p>{{ Auth()->user()->email }}</p>
                                        </div>
                                    </div>
                                    @include('frontend.profile.sidebar',['profile_dropdown' => 1])
                                </div>
                            </li>
                        @else
                            <li class="login-btn dropdown">
                                <a href="javascript:void(0)" class="template-btn get-access-btn dropdown-toggle" id="getAccessDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span>{{ __('get_access') }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end get-access-dropdown-menu" aria-labelledby="getAccessDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('register') }}">
                                            <i class="fal fa-user-plus me-2"></i>{{ __('registration') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('login') }}">
                                            <i class="fal fa-sign-in me-2"></i>{{ __('sign_in') }}
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        <li class="d-lg-none">
                            <a href="#" class="navbar-toggler d-inline-block">
                                <span></span>
                                <span></span>
                                <span></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Language Modal -->
    <div class="modal language-currency-modal fade" id="languageCurrencyModal" tabindex="-1"
         aria-labelledby="languageCurrencyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('change.app.setting') }}" class="ajax_form" method="post">@csrf
                        <input type="hidden" class="global_language" name="lang" value="{{ userLanguage() }}">
                        <input type="hidden" class="global_currency" name="currency_code" value="{{ userCurrency() }}">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <h5 class="list-title p-r-15 p-r-md-0">{{ __('change_language') }}</h5>
                                <ul class="list-groups p-r-15 p-r-md-0">
                                    @foreach(app('languages') as $language)
                                        <li class="{{ $language->locale == userLanguage() ? 'active' : '' }}">
                                            <a href="javascript:void(0)" data-name="lang" data-value="{{ $language->locale }}">
                                                <img src="{{ static_asset($language->flag ?: 'admin/img/flag/united-kingdom.svg') }}" alt="United States">
                                                {{ $language->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-lg-6 m-t-md-20">
                                <h5 class="list-title p-l-15 p-l-md-0">{{ __('change_currency') }}</h5>
                                <ul class="list-groups p-l-15 p-l-md-0">
                                    @foreach(app('currencies') as $currency)
                                        <li class="{{ $currency->code == userCurrency() ? 'active' : '' }}"><a href="javascript:void(0)" data-name="currency_code" data-value="{{ $currency->code }}">{{ $currency->code }} - ({{ $currency->name }})</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-12">
                                <div class="modal-footer m-t-15 pe-0 pb-0">
                                    <button type="submit" class="template-btn">{{ __('save_changes') }}</button>
                                    @include('components.frontend_loading_btn', ['class' => 'template-btn'])
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--====== Mobile Slide Menu ======-->
    <div class="mobile-slide-panel">
        <div class="panel-overlay"></div>
        <div class="panel-inner">
            <div class="mobile-logo">
                <a href="{{url('/')}}">
                    <img
                        src="{{ (setting('dark_logo') && @is_file_exists(setting('dark_logo')['original_image']) ? get_media(setting('dark_logo')['original_image']) : get_media('images/default/logo/logo-green-black.png')) }}"
                        alt="logo">
                </a>
            </div>
            <nav class="mobile-menu">
                <ul>
                    @if (is_array(headerFooterMenu('header_menu')))
                        @foreach ( headerFooterMenu('header_menu') as $main_menu)
                            <li>
                                <a href="{{url($main_menu['url'])}}"
                                   @if(count($main_menu) > 3) data-bs-toggle="dropdown" @endif>{{ $main_menu['label'] }}</a>
                                @if (count($main_menu) > 3)
                                    <ul class="sub-menu">
                                        @foreach (array_slice($main_menu, 3) as $submenu)
                                            <li><a href="{{url($submenu['url'])}}">{{ $submenu['label'] }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    @endif
                </ul>
            </nav>
            <a href="#" class="panel-close">
                <i class="fal fa-times"></i>
            </a>
        </div>
    </div>
    <!--====== Off Canvas Cart Slide ======-->
    <div class="off-canvas-wrapper">
        <div class="canvas-overlay"></div>
        <div class="canvas-inner">
            @include('frontend.cart_component')
        </div>
    </div>
</header>
