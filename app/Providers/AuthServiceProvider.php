<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Order'              => 'App\Policies\OrderPolicy',
        'App\Models\Category'           => 'App\Policies\CategoryPolicy',
        'App\Models\Product'            => 'App\Policies\ProductPolicy',
        'App\Models\ProductBrand'       => 'App\Policies\ProductBrandPolicy',
        'App\Models\Admin'              => 'App\Policies\AdminPolicy',
        'App\Models\ApiAgent'           => 'App\Policies\ApiAgentPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gates for Order
        Gate::define('view-order', 'App\Policies\OrderPolicy@view');
        Gate::define('update-order', 'App\Policies\OrderPolicy@update');
        Gate::define('approve-order', 'App\Policies\OrderPolicy@approve');
        Gate::define('process-order', 'App\Policies\OrderPolicy@process');
        Gate::define('deliver-order', 'App\Policies\OrderPolicy@deliver');
        Gate::define('cancel-order', 'App\Policies\OrderPolicy@cancel');
        Gate::define('create-order', 'App\Policies\OrderPolicy@create');
        Gate::define('delete-order', 'App\Policies\OrderPolicy@delete');

        // Gates for Product
        Gate::define('view-product', 'App\Policies\ProductPolicy@view');
        Gate::define('view-product-details', 'App\Policies\ProductPolicy@viewDetails');
        Gate::define('create-product', 'App\Policies\ProductPolicy@create');
        Gate::define('update-product', 'App\Policies\ProductPolicy@update');
        Gate::define('delete-product', 'App\Policies\ProductPolicy@delete');

        // Gates for Product Brand
        Gate::define('view-brand', 'App\Policies\ProductBrandPolicy@view');
        Gate::define('create-brand', 'App\Policies\ProductBrandPolicy@create');
        Gate::define('edit-brand', 'App\Policies\ProductBrandPolicy@edit');
        Gate::define('delete-brand', 'App\Policies\ProductBrandPolicy@delete');

        // Gates for Shop Preferences
        Gate::define('manage-preferences', 'App\Policies\ShopPreferencesPolicy@manage');
        Gate::define('delete-preferences', 'App\Policies\ShopPreferencesPolicy@delete');

        // Gates for Customers
        Gate::define('manage-customers', 'App\Policies\CustomerPolicy@manage');

        // Gates for Banners
        Gate::define('manage-ads', 'App\Policies\BannerPolicy@manage');

        // Gates for Franchise
        Gate::define('manage-franchise', 'App\Policies\FranchisePolicy@manage');

        // Gates for Shop Options
        Gate::define('manage-options', 'App\Policies\SiteOptionPolicy@manage');
        Gate::define('delete-options', 'App\Policies\SiteOptionPolicy@delete');

        // Gates for Category
        Gate::define('control-category', 'App\Policies\CategoryPolicy@control');

        // Gates for Api Agents
        Gate::define('control-api', 'App\Policies\ApiAgentPolicy@control');

        // Gates for Admins
        Gate::define('manage-admin', 'App\Policies\AdminPolicy@manage');
        Gate::define('delete-admin', 'App\Policies\AdminPolicy@delete');
        Gate::define('create-super-admin', 'App\Policies\AdminPolicy@createSuperAdmin');
        Gate::define('manage-shipper', 'App\Policies\AdminPolicy@manageShipper');
    }
}
