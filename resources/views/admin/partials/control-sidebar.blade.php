<div class="control-sidebar-content" :class="{ 'show': controlSidebarToggled }">
    @if(auth('admin')->user()->isSuperAdmin() || auth('admin')->user()->isAdmin())
        <div class="card section-card">
            <h3 class="card-header">Theme Color</h3>
            <div class="card-body">
                <form action="{{ route('shop_info.front_theme') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        @php($site_theme = getSiteBasic('site_theme'))
                        <label for="siteTheme" style="font-size: 14px; font-weight: 600;">Shop Theme: </label> &nbsp;&nbsp;&nbsp;
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline1" name="site_theme" value="light" class="custom-control-input" @if($site_theme === 'light') checked @endif>
                            <label style="font-size: 13px; font-weight: 600;" class="custom-control-label" for="customRadioInline1">Light</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline2" name="site_theme" value="dark" class="custom-control-input"  @if($site_theme === 'dark') checked @endif>
                            <label style="font-size: 13px; font-weight: 600;" class="custom-control-label" for="customRadioInline2">Dark</label>
                        </div>
                    </div>

                    <div class="form-group">
                        @php($theme_accent = getSiteBasic('theme_accent') ? getSiteBasic('theme_accent') : '#ea000d')
                        <label for="bgColor" style="font-size: 14px; font-weight: 600;">Theme Accent:</label> &nbsp;&nbsp;&nbsp;
                        <input type="color" id="bgColor" class="form-control d-inline-block" name="theme_accent" value="{{ $theme_accent }}"
                               style="width: 50px; border: 0; background: transparent;padding: 0; height: 25px; cursor: pointer;" title="Click to change the color">
                        <small style="margin-top: -5px;" class="form-text text-muted">Click on the color box to change!</small>
                    </div>

                   {{-- <div class="form-group">
                        @php($theme_accent = getSiteBasic('theme_text') ? getSiteBasic('theme_text') : '#262626')
                        <label for="bgColor" style="font-size: 14px; font-weight: 600;">Theme Text:</label> &nbsp;&nbsp;&nbsp;
                        <input type="color" id="bgColor" class="form-control d-inline-block" name="theme_text" value="{{ $theme_accent }}"
                               style="width: 50px; border: 0; background: transparent;padding: 0; height: 25px; cursor: pointer;" title="Click to change the color">
                        <small style="margin-top: -5px;" class="form-text text-muted">Click on the color box to change!</small>
                    </div>--}}

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" style="margin-top: 10px; padding: 2px 8px; font-size: 14px;">
                            Update Theme
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    @if(auth('admin')->user()->isFranchise())
        <shopping-cart
                @close="toggleControlSidebar">
        </shopping-cart>
    @endif

{{--    <ul class="nav nav-tabs nav-justified" id="controlSidebarTab" role="tablist">--}}
{{--        <li class="nav-item" title="Home">--}}
{{--            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">--}}
{{--                <i class="fa fa-home"></i>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item" title="News">--}}
{{--            <a class="nav-link" id="news-tab" data-toggle="tab" href="#news" role="tab" aria-controls="news" aria-selected="false">--}}
{{--                <i class="fa fa-newspaper-o"></i>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item" title="Settings">--}}
{{--            <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">--}}
{{--                <i class="fa fa-cogs"></i>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--    </ul>  .nav--}}

{{--    <div class="tab-content" id="controlSidebarTabContent">--}}
{{--         Home Tab Content--}}
{{--        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">--}}

{{--            <div class="card user-information">--}}
{{--                <div class="card-body text-center">--}}
{{--                    @if(auth('admin')->user()->img_url)--}}
{{--                        <img src="{{ auth('admin')->user()->img_url }}" alt="{{ auth('admin')->user()->name }}" class="img-fluid">--}}
{{--                    @else--}}
{{--                        <img src="{{ asset('assets/images/user.png') }}" alt="{{ auth('admin')->user()->name }}" class="img-fluid">--}}
{{--                    @endif--}}
{{--                    <p>--}}
{{--                        <span class="admin-name">{{ auth('admin')->user()->name }}</span>--}}
{{--                        <br>--}}
{{--                        <span class="admin-role">{{ auth('admin')->user()->role->title }}</span>--}}
{{--                    </p>--}}
{{--                    <a href="#" class="edit-profile" title="Edit Profile">--}}
{{--                        <i class="fa fa-pencil"></i>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <hr>--}}

{{--            <div class="recent-delivery">--}}
{{--                <h4>Recent Delivery</h4>--}}
{{--                <div class="list-unstyled">--}}
{{--                    <a class="media" href="">--}}
{{--                        <div class="align-self-center mr-3 delivering">--}}
{{--                            <i class="fa fa-truck"></i>--}}
{{--                        </div>--}}
{{--                        <div class="media-body">--}}
{{--                            <h5 class="mt-0">ORD#1805261025</h5>--}}
{{--                            <p>On Delivery</p>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a class="media" href="">--}}
{{--                        <div class="align-self-center mr-3 delivered">--}}
{{--                            <i class="fa fa-check"></i>--}}
{{--                        </div>--}}
{{--                        <div class="media-body">--}}
{{--                            <h5 class="mt-0">ORD#1805261023</h5>--}}
{{--                            <p>Delivered</p>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a class="media" href="">--}}
{{--                        <div class="align-self-center mr-3 canceled">--}}
{{--                            <i class="fa fa-ban"></i>--}}
{{--                        </div>--}}
{{--                        <div class="media-body">--}}
{{--                            <h5 class="mt-0">ORD#1805261023</h5>--}}
{{--                            <p>Delivered</p>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a class="media" href="">--}}
{{--                        <div class="align-self-center mr-3 delivering">--}}
{{--                            <i class="fa fa-truck"></i>--}}
{{--                        </div>--}}
{{--                        <div class="media-body">--}}
{{--                            <h5 class="mt-0">ORD#1805261025</h5>--}}
{{--                            <p>On Delivery</p>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a class="media" href="">--}}
{{--                        <div class="align-self-center mr-3 delivered">--}}
{{--                            <i class="fa fa-check"></i>--}}
{{--                        </div>--}}
{{--                        <div class="media-body">--}}
{{--                            <h5 class="mt-0">ORD#1805261023</h5>--}}
{{--                            <p>Delivered</p>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a class="media" href="">--}}
{{--                        <div class="align-self-center mr-3 canceled">--}}
{{--                            <i class="fa fa-ban"></i>--}}
{{--                        </div>--}}
{{--                        <div class="media-body">--}}
{{--                            <h5 class="mt-0">ORD#1805261023</h5>--}}
{{--                            <p>Delivered</p>--}}
{{--                        </div>--}}
{{--                    </a>--}}

{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}

{{--         News Tab Content--}}
{{--        <div class="tab-pane fade" id="news" role="tabpanel" aria-labelledby="news-tab">--}}
{{--            News--}}
{{--        </div>--}}

{{--         Settings Tab Content--}}
{{--        <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">--}}
{{--            Settings--}}
{{--        </div>--}}
{{--    </div>  .tab-content--}}

</div>

<div class="control-sidebar-back" :class="{ 'show': controlSidebarToggled }"></div>
