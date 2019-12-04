<div class="main-sidebar-user">
    <div class="media">
        @if(auth('admin')->user()->img_url && strlen(auth('admin')->user()->img_url) > 10)
            <img src="{{ imageCache(auth('admin')->user()->img_url, '200') }}" alt="{{ auth('admin')->user()->name }}" class="align-self-center img-fluid">
        @else
            <img src="{{ asset('assets/images/user.png') }}" alt="{{ auth('admin')->user()->name }}" class="align-self-center img-fluid">
        @endif
        <div class="media-body" :class="{'hide': mainSidebarToggled}">
            <h5>{{ auth('admin')->user()->name }}</h5>
            <p>
                <a href="{{ route('admin.profile') }}" title="Profile"><i class="fa fa-user"></i></a>
                <a href="{{ route('admin.profile.security') }}" title="Security"><i class="fa fa-cog"></i></a>
                <a href="{{ route('admin.logout') }}" title="Logout" onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i>
                </a>
            </p>

        </div>
    </div>
</div>

<nav class="main-sidebar-nav">
    <ul class="nav flex-column">

        <li class="nav-item menu-header" :class="{'sr-only': mainSidebarToggled}">
            <div class="nav-link">
                Shop Management <span class="pull-right"><i class="fa fa-cubes"></i></span>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link @yield('dashboard-active')" href="{{ route('admin.home') }}">
                <i class="fa fa-tachometer" title="Dashboard"></i> <span :class="{'hide': mainSidebarToggled}">Dashboard</span>
            </a>
        </li>
        {{-- Order Links --}}
        <li class="nav-item dropright">
            <a class="nav-link @yield('orders-active') dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-shopping-cart" title="Orders"></i>
                <span :class="{'hide': mainSidebarToggled}">Orders</span>
                <span class="badge badge-warning pending-orders-count" :class="{'hide': mainSidebarToggled}">{{ getOrderSummary()->pending }}</span>
                <span class="pull-right"><i class="fa fa-angle-right"></i></span>
            </a>
            <div class="dropdown-menu">
                <div class="dropdown-item hidden-menu-title" v-if="mainSidebarToggled">
                    Orders
                </div>
                @can('create-order')
                    <a href="{{ route('admin.orders.create') }}" class="dropdown-item @yield('orders-create-active')">Create New Order</a>
                @endcan
                <a href="{{ route('admin.orders.pending') }}" class="dropdown-item @yield('orders-pending-active')">
                    Pending Orders <span class="badge badge-warning pending-orders-count">{{ getOrderSummary()->pending }}</span>
                </a>
                @if(!auth('admin')->user()->isShipper())
                    <a href="{{ route('admin.orders.confirmed') }}" class="dropdown-item @yield('orders-confirmed-active')">Confirmed Orders</a>
                @endif
                <a href="{{ route('admin.orders.delivered') }}" class="dropdown-item @yield('orders-delivered-active')">Delivered Orders</a>
                <a href="{{ route('admin.orders.canceled') }}" class="dropdown-item @yield('orders-canceled-active')">Canceled Orders</a>
                @if(!auth('admin')->user()->isShipper() && !auth('admin')->user()->isFranchise())
                    <hr style="margin: 5px 24px; border-color: #464646;">
                    <a href="{{ route('admin.orders.for-franchise') }}" class="dropdown-item @yield('orders-for-franchise-active')">Orders For Franchise</a>
                    <a href="{{ route('admin.orders.by-franchise') }}" class="dropdown-item @yield('orders-by-franchise-active')">Orders By Franchise</a>
                    <hr style="margin: 5px 24px; border-color: #464646;">
                @endif
                <a href="{{ route('admin.orders') }}" class="dropdown-item @yield('orders-all-active')">All Orders</a>
                @if(auth('admin')->user()->isFranchise())
                    <hr style="margin: 5px 24px; border-color: #464646;">
                    <a href="{{ route('admin.orders.by-franchise') }}" class="dropdown-item @yield('orders-by-franchise-active')">Orders By Me</a>
                @endif
            </div>
        </li>
        {{-- Products Links --}}
        @if(auth('admin')->user()->can('view-product'))
            <li class="nav-item dropright">
                <a class="nav-link @yield('products-active') dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-product-hunt" title="Products"></i>
                    <span :class="{'hide': mainSidebarToggled}">Products</span>
                    <span class="pull-right"><i class="fa fa-angle-right"></i></span>
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-item hidden-menu-title" v-if="mainSidebarToggled">
                        Products
                    </div>

                    @if(!auth('admin')->user()->isFranchise())
                        <a href="{{ route('admin.products.create') }}" class="dropdown-item @yield('products-new-active')">Add New Product</a>
                        <a href="{{ route('admin.products.returned') }}" class="dropdown-item @yield('products-returned-active')">Returned Products</a>
                        <a href="{{ route('admin.products.damaged') }}" class="dropdown-item @yield('products-damaged-active')">Damaged Products</a>
                    @endif
                    <a href="{{ route('admin.products.all') }}" class="dropdown-item @yield('products-all-active')">All Products</a>
                    @if(auth('admin')->user()->isFranchise())
                        <a href="{{ route('admin.products.franchise') }}" class="dropdown-item @yield('products-own-active')">Own Products</a>
                    @endif
                </div>
            </li>
        @endif
        {{-- Categories Link --}}
        @if(!auth('admin')->user()->isShipper() && !auth('admin')->user()->isFranchise())
            <li class="nav-item dropright">
                <a class="nav-link @yield('categories-active') dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-sitemap" title="Categories"></i>
                    <span :class="{'hide': mainSidebarToggled}">Categories</span>
                    <span class="pull-right"><i class="fa fa-angle-right"></i></span>
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-item hidden-menu-title" v-if="mainSidebarToggled">
                        Categories
                    </div>
                    @if(Auth::guard('admin')->user()->isSuperAdmin() || Auth::guard('admin')->user()->isAdmin())
                        <a href="{{ route('admin.categories.create') }}" class="dropdown-item @yield('categories-new-active')">Add New Category</a>
                    @endif
                    <a href="{{ route('admin.categories') }}" class="dropdown-item @yield('categories-all-active')">All Categories</a>
                </div>
            </li>
        @endif
        {{-- Brands Link --}}
        @can('view-brand')
            @if(!auth('admin')->user()->isFranchise())
                <li class="nav-item dropright">
                    <a class="nav-link @yield('brand-active') dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-superpowers" title="Brands"> </i>
                        <span :class="{'hide': mainSidebarToggled}">Brands</span>
                        <span class="pull-right"><i class="fa fa-angle-right"> </i></span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="dropdown-item hidden-menu-title" v-if="mainSidebarToggled">
                            Brands
                        </div>
                        @can('create-brand')
                            <a href="{{ route('admin.brands.create') }}" class="dropdown-item @yield('brand-new-active')">Add New Brand</a>
                        @endcan
                        <a href="{{ route('admins.brands') }}" class="dropdown-item @yield('brand-all-active')">All Brands</a>
                    </div>
                </li>
            @endif
        @endcan
        @if(auth('admin')->user()->isAlpha() || auth('admin')->user()->isSuperAdmin())
             {{--Supplies Link --}}
            <li class="nav-item dropright">
                <a class="nav-link @yield('supplies-active') dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-truck" title="Supplies"></i>
                    <span :class="{'hide': mainSidebarToggled}">Supplies</span>
                    <span class="pull-right"><i class="fa fa-angle-right"></i></span>
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-item hidden-menu-title" v-if="mainSidebarToggled">
                        Supplies
                    </div>

                    <a href="#" class="dropdown-item @yield('supplies-new-active')">Add New Supply</a>
                    <a href="#" class="dropdown-item @yield('supplies-all-active')">Supplies History</a>
                    <a href="#" class="dropdown-item @yield('supplier-new-active')">Add New Supplier</a>
                    <a href="#" class="dropdown-item @yield('supplier-all-active')">All Suppliers</a>
                </div>
            </li>
             {{--Shippers Link--}}
            <li class="nav-item dropright">
                <a class="nav-link @yield('shippers-active') dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-paper-plane" title="Shippers"></i>
                    <span :class="{'hide': mainSidebarToggled}">Shippers</span>
                    <span class="pull-right"><i class="fa fa-angle-right"></i></span>
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-item hidden-menu-title" v-if="mainSidebarToggled">
                        Shippers
                    </div>

                    <a href="{{ route('admin.shipper.create') }}" class="dropdown-item @yield('shippers-new-active')">Add New Shipper</a>
                    <a href="{{ route('admin.shipper.all') }}" class="dropdown-item @yield('shippers-all-active')">All Shippers</a>
                </div>
            </li>
            {{-- Shipping Method Link --}}
            <li class="nav-item dropright">
                <a class="nav-link @yield('shipping-active') dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-truck" title="Shipping Methods"> </i>
                    <span :class="{'hide': mainSidebarToggled}">Shipping Methods</span>
                    <span class="pull-right"><i class="fa fa-angle-right"> </i></span>
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-item hidden-menu-title" v-if="mainSidebarToggled">
                        Shipping Methods
                    </div>

                    <a href="{{ route('admin.shipping.add') }}" class="dropdown-item @yield('shipping-new-active')">Add New Method</a>
                    <a href="{{ route('admin.shipping') }}" class="dropdown-item @yield('shipping-all-active')">All Shipping Methods</a>
                </div>
            </li>
            {{-- Customers Link --}}
            @can('manage-customers')
                <li class="nav-item dropright">
                <a class="nav-link @yield('customers-active') dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user-secret" title="Customers"></i>
                    <span :class="{'hide': mainSidebarToggled}">Customers</span>
                    <span class="pull-right"><i class="fa fa-angle-right"></i></span>
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-item hidden-menu-title" v-if="mainSidebarToggled">
                        Customers
                    </div>

                    <a href="{{ route('admin.customers.add') }}" class="dropdown-item @yield('customers-new-active')">Add New Customers</a>
                    <a href="{{ route('admin.customers') }}" class="dropdown-item @yield('customers-all-active')">All Customers</a>
                </div>
            </li>
            @endcan
            {{-- Franchise Link --}}
            <li class="nav-item dropright">
                <a class="nav-link @yield('franchise-active') dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-handshake-o" title="Franchise"></i>
                    <span :class="{'hide': mainSidebarToggled}">Merchant</span>
                    <span class="pull-right"><i class="fa fa-angle-right"></i></span>
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-item hidden-menu-title" v-if="mainSidebarToggled">
                        Franchise
                    </div>

                    <a href="{{ route('admin.franchise-control.add') }}" class="dropdown-item @yield('franchise-new-active')">All Products</a>
                    <a href="{{ route('admin.franchise-control.all') }}" class="dropdown-item @yield('franchise-all-active')">All Merchant</a>
                </div>
            </li>


            {{-- Expenses Link --}}
            <li class="nav-item dropright">
                <a class="nav-link @yield('expenses-active') dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-paypal" title="Expenses"></i>
                    <span :class="{'hide': mainSidebarToggled}">Expenses</span>
                    <span class="pull-right"><i class="fa fa-angle-right"></i></span>
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-item hidden-menu-title" v-if="mainSidebarToggled">
                        Expenses
                    </div>

                    <a href="#" class="dropdown-item @yield('expenses-new-active')">Add New Expense</a>
                    <a href="#" class="dropdown-item @yield('expenses-all-active')">All Expenses</a>
                </div>
            </li>
        @endif
        {{-- Shop Preferences Links --}}
        @can('manage-preferences')
            <li class="nav-item dropright">
                <a class="nav-link @yield('shop-preferences-active') dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-wrench" title="Shop Preferences"></i>
                    <span :class="{'hide': mainSidebarToggled}">Shop Preferences</span>
                    <span class="pull-right"><i class="fa fa-angle-right"></i></span>
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-item hidden-menu-title" v-if="mainSidebarToggled">
                        Shop Preferences
                    </div>

                    <a href="{{ route('admin.shop_preferences.delivery_locations') }}" class="dropdown-item @yield('shop-preferences-locations-active')">Delivery Locations</a>
                    <a href="{{ route('admin.shop_preferences.delivery_schedules') }}" class="dropdown-item @yield('shop-preferences-schedules-active')">Delivery Schedules</a>
                </div>
            </li>
        @endcan
        {{--Marketing Links --}}
        @if(auth('admin')->user()->isAlpha() || auth('admin')->user()->isAdmin() || auth('admin')->user()->isSuperAdmin() || auth('admin')->user()->isManager())
            <li class="nav-item dropright">
                <a class="nav-link @yield('marketing-active') dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-sellsy" title="Marketing"></i>
                    <span :class="{'hide': mainSidebarToggled}">Marketing</span>
                    <span class="pull-right"><i class="fa fa-angle-right"></i></span>
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-item hidden-menu-title" v-if="mainSidebarToggled">
                        Marketing
                    </div>
                    <a href="{{ route('admin.coupon.index') }}" class="dropdown-item @yield('marketing-coupons-active')">Coupons</a>
                    <a href="#" class="dropdown-item @yield('marketing-membership-active')">Membership</a>
                    <a href="#" class="dropdown-item @yield('marketing-referral-active')">Referral</a>
                    <a href="#" class="dropdown-item @yield('marketing-sms-active')">SMS Promotion</a>
                    <a href="#" class="dropdown-item @yield('marketing-email-active')">Email Promotion</a>
                    <a href="#" class="dropdown-item @yield('marketing-mobile-active')">Mobile App Promotion</a>
                </div>
            </li>
        @endif
        {{-- Ads Link --}}
        @if(auth('admin')->user()->isAlpha() || auth('admin')->user()->isAdmin() ||auth('admin')->user()->isSuperAdmin())
            <li class="nav-item dropright">
                <a class="nav-link @yield('ads-active') dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-audio-description" title="Product Reviews"></i>
                    <span :class="{'hide': mainSidebarToggled}">Banner Ads</span>
                    <span class="pull-right"><i class="fa fa-angle-right"></i></span>
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-item hidden-menu-title" v-if="mainSidebarToggled">
                        Banner Ads
                    </div>

                    <a href="{{ route('admin.ads.sliders') }}" class="dropdown-item @yield('ads-sliders-active')">
                        Home Sliders
                    </a>
                    <a href="{{ route('admin.ads.index_banners') }}" class="dropdown-item @yield('ads-index-banner-active')">
                        Index Page Banners
                    </a>
                    <a href="{{ route('admin.ads.category_banners') }}" class="dropdown-item @yield('ads-category-banner-active')">
                        Category Banners
                    </a>
                    <a href="{{ route('admin.ads.sidebar_banner') }}" class="dropdown-item @yield('ads-sidebar-active')">Sidebar Ads</a>
                    <a href="#" class="dropdown-item @yield('ads-product-active')">Product Page Ads</a>
                </div>
            </li>
        @endif
        {{-- Review Links --}}
        @if(auth('admin')->user()->isAlpha() || auth('admin')->user()->isAdmin() || auth('admin')->user()->isSuperAdmin() || auth('admin')->user()->isManager())
        <li class="nav-item dropright">
            <a class="nav-link @yield('reviews-active') dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-comments-o" title="Product Reviews"></i>
                <span :class="{'hide': mainSidebarToggled}">Reviews</span>
                <span class="badge badge-warning" :class="{'hide': mainSidebarToggled}">5</span>
                <span class="pull-right"><i class="fa fa-angle-right"></i></span>
            </a>
            <div class="dropdown-menu">
                <div class="dropdown-item hidden-menu-title" v-if="mainSidebarToggled">
                    Reviews
                </div>

                <a href="#" class="dropdown-item @yield('reviews-pending-active')">
                    Pending Reviews <span class="badge badge-warning pending-orders-count">5</span>
                </a>
                <a href="#" class="dropdown-item @yield('reviews-service-active')">Service Reviews</a>
                <a href="#" class="dropdown-item @yield('reviews-all-active')">All Reviews</a>
            </div>
        </li>
        @endif
         Report Link
        <li class="nav-item">
            <a class="nav-link @yield('reports-active')" href="#">
                <i class="fa fa-pie-chart" title="Reports"></i> <span :class="{'hide': mainSidebarToggled}">Reports</span>
            </a>
        </li>

        {{-- Web Contents Navigations --}}
        @if(auth('admin')->user()->isAdmin() || auth('admin')->user()->isSuperAdmin())
            <li class="nav-item menu-header" :class="{'sr-only': mainSidebarToggled}">
                <div class="nav-link">
                    Web Contents <span class="pull-right"><i class="fa fa-globe"></i></span>
                </div>
            </li>

        <li class="nav-item dropright">
            <a class="nav-link @yield('posts-active') dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-rss" title="Posts"></i>
                <span :class="{'hide': mainSidebarToggled}">Posts</span>
                <span class="pull-right"><i class="fa fa-angle-right"></i></span>
            </a>
            <div class="dropdown-menu">
                <div class="dropdown-item hidden-menu-title" v-if="mainSidebarToggled">
                    Posts
                </div>

                <a href="#" class="dropdown-item @yield('posts-new-active')">Add new</a>
                <a href="#" class="dropdown-item @yield('posts-drafts-active')">Drafts</a>
                <a href="#" class="dropdown-item @yield('posts-all-active')">All</a>
            </div>
        </li>

            <li class="nav-item dropright">
                <a class="nav-link @yield('pages-active') dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-file-text-o" title="Pages"></i>
                    <span :class="{'hide': mainSidebarToggled}">Pages</span>
                    <span class="pull-right"><i class="fa fa-angle-right"></i></span>
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-item hidden-menu-title" v-if="mainSidebarToggled">
                        Pages
                    </div>

                    <a href="{{ route('admin.pages.create') }}" class="dropdown-item @yield('pages-new-active')">Add New Page</a>
                    <a href="#" class="dropdown-item @yield('pages-drafts-active')">Drafts</a>
                    <a href="{{ route('admin.pages') }}" class="dropdown-item @yield('pages-all-active')">All Pages</a>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link @yield('pages-active')" href="{{ route('admin.pages') }}">
                    <i class="fa fa-file-text-o" title="Static Pages"></i> <span :class="{'hide': mainSidebarToggled}">Pages</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @yield('media-active')" href="{{ route('admin.media') }}">
                    <i class="fa fa-film" title="Media Manager"></i> <span :class="{'hide': mainSidebarToggled}">Media Manager</span>
                </a>
            </li>
        @endif

        {{-- User Settings Navigation --}}
        <li class="nav-item menu-header" :class="{'sr-only': mainSidebarToggled}">
            <div class="nav-link">
                User Settings <span class="pull-right"><i class="fa fa-cogs"></i></span>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link @yield('profile-details-active')" href="{{ route('admin.profile') }}">
                <i class="fa fa-user-circle-o" title="Personal Details"></i> <span :class="{'hide': mainSidebarToggled}">Personal Details</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link @yield('profile-security-active')" href="{{ route('admin.profile.security') }}">
                <i class="fa fa-shield" title="Account Security"></i> <span :class="{'hide': mainSidebarToggled}">Account Security</span>
            </a>
        </li>

        @if(auth('admin')->user()->isAdmin() || auth('admin')->user()->isSuperAdmin())

            {{-- Admin Controls Navigation --}}
            <li class="nav-item menu-header" :class="{'sr-only': mainSidebarToggled}">
                <div class="nav-link">
                    Admin Controls <span class="pull-right"><i class="fa fa-sliders"></i></span>
                </div>
            </li>

            <li class="nav-item dropright">
                <a class="nav-link @yield('site-information-active') dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-info-circle" title="Site Information"></i>
                    <span :class="{'hide': mainSidebarToggled}">Site Information</span>
                    <span class="pull-right"><i class="fa fa-angle-right"></i></span>
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-item hidden-menu-title" v-if="mainSidebarToggled">
                        Shop Information
                    </div>

                    <a href="{{ route('shop_info.index') }}" class="dropdown-item @yield('site-details-active')">Shop Details</a>
                    <a href="{{ route('shop_info.config') }}" class="dropdown-item @yield('site-config-active')">Shop Configuration</a>
                    <a href="{{ route('shop_info.seo') }}" class="dropdown-item @yield('site-configuration-active')">SEO Configuration</a>
                    <a href="{{ route('shop_info.social') }}" class="dropdown-item @yield('site-social-active')">Social Information</a>
                    {{--<a href="#" class="dropdown-item @yield('site-footer-navigation-active')">Footer Navigation</a>--}}
                </div>
            </li>

            <li class="nav-item dropright">
                <a class="nav-link @yield('admins-active') dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-users" title="Admins" style="font-size: 13px;"></i>
                    <span :class="{'hide': mainSidebarToggled}">Admins</span>
                    <span class="pull-right"><i class="fa fa-angle-right"></i></span>
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-item hidden-menu-title" v-if="mainSidebarToggled">
                        Admins
                    </div>

                    <a href="{{ route('admin.admins.create') }}" class="dropdown-item @yield('admins-new-active')">Add New Admin</a>
                    <a href="{{ route('admin.admins.all') }}" class="dropdown-item @yield('admins-all-active')">All Admins</a>
                </div>
            </li>

            @can('control-api')
                <li class="nav-item dropright">
                    <a class="nav-link @yield('api-active') dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-database" title="Api Agents"></i>
                        <span :class="{'hide': mainSidebarToggled}">Api Agents</span>
                        <span class="pull-right"><i class="fa fa-angle-right"></i></span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="dropdown-item hidden-menu-title" v-if="mainSidebarToggled">
                            Api Agents
                        </div>

                        <a href="{{ route('admin.api_agent.add') }}" class="dropdown-item @yield('api-new-active')">Add new</a>
                        <a href="{{ route('admin.api_agent') }}" class="dropdown-item @yield('api-all-active')">All Agents</a>
                    </div>
                </li>
            @endcan

            @if(auth('admin')->user()->isAlpha())
                <li class="nav-item">
                    <a class="nav-link @yield('media-active')" href="{{ route('admin.features') }}">
                        <i class="fa fa-universal-access" title="Media Manager"></i> <span :class="{'hide': mainSidebarToggled}">Active Features</span>
                    </a>
                </li>
            @endif
        @endif
    </ul>
</nav>
