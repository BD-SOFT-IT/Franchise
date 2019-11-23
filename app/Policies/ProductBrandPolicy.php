<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\ProductBrand;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductBrandPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(Admin $admin) {
        if($admin->isSuperAdmin() || $admin->isAdmin() || $admin->isStoreKeeper() || $admin->isManager()) {
            return true;
        }
        return false;
    }

    public function edit(Admin $admin) {
        if($admin->isSuperAdmin() || $admin->isAdmin() || $admin->isStoreKeeper() || $admin->isManager()) {
            return true;
        }
        return false;
    }
    public function delete(Admin $admin) {
        if($admin->isSuperAdmin() || $admin->isAdmin()) {
            return true;
        }
        return false;
    }

    public function view(Admin $admin) {
        if(!$admin->isShipper()) {
            return true;
        }
        return false;
    }

}
