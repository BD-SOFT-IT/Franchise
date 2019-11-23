<div class="categories-menu-container">
    <div class="content-title" id="sidebarContentTitle">
        <h3 class="text-uppercase">
            Categories <span class="float-right"> <i class="icon ion-md-list"></i> </span>
        </h3>
    </div>

    <div class="category-menu" id="sidebarMainMenu" @if(Route::currentRouteName() !== 'index') style="display: none;" @endif>
        <ul>
            @foreach(getCategories('parent') as $index => $category)
                @if(getCategories('child', $category->category_id) == null || count(getCategories('child', $category->category_id)) <= 0)
                    <li class="menu-item-parent">
                        <a href="{{ route('category.single', ['slug' => $category->category_slug]) }}">
                            <span><i class="icon ion-logo-buffer"></i></span>
                            {{ $category->category_title }}
                        </a>
                    </li>
                @else
                    <li class="menu-item-parent has-children">
                        <a href="{{ route('category.single', ['slug' => $category->category_slug]) }}">
                            <i class="icon ion-logo-buffer mr-1"></i> {{ $category->category_title }}
                            <span class="float-right d-none d-lg-block"><i class="icon ion-ios-arrow-forward"></i></span>
                            <span class="menu-toggler float-right d-lg-none" style="font-size: 20px;" title="Click To Toggle">
                                <i class="icon ion-ios-add"></i>
                            </span>
                        </a>

                        <ul class="categories-sub-menu">
                            @foreach(getCategories('child', $category->category_id) as $child)
                                @if(getCategories('filtering', $child->category_id) === null || count(getCategories('filtering', $child->category_id)) <= 0)
                                    <li class="menu-item-child">
                                        <a href="{{ route('category.single', ['slug' => $child->category_slug]) }}">
                                            {{ $child->category_title }}
                                        </a>
                                    </li>
                                @else
                                    <li class="menu-item-child has-child">
                                        <a href="{{ route('category.single', ['slug' => $child->category_slug]) }}">
                                            {{ $child->category_title }}
                                        </a>
                                        <ul class="categories-child-sub-menu">
                                            @foreach(getCategories('filtering', $child->category_id) as $filter)
                                                <li class="menu-item-filter">
                                                    <a href="{{ route('category.single', ['slug' => $filter->category_slug]) }}">
                                                        {{ $filter->category_title }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @endforeach
                            <li class="category-image">
                                @if($catBanner = getBanners('category_menu_banner_' . $category->category_id, true))
                                    <a class="d-block p-0" href="{{ $catBanner->banner_target_url }}" @if($catBanner->banner_target_url_type == 'external') target="_blank" @endif>
                                        <img src="{{ imageCache($catBanner->banner_img) }}" class="w-100 h-100" alt="">
                                    </a>
                                @else
                                    <a class="d-block p-0" href="#">
                                        <img src="https://via.placeholder.com/850x140?text=(850x140+px)" class="w-100 h-100" alt="">
                                    </a>
                                @endif
                            </li>
                        </ul>
                    </li>
                @endif
                @break($index == 7)
            @endforeach
        </ul>
    </div>
</div>
