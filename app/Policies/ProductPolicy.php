<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
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

    /**
     * @param Admin $admin
     * @return bool
     */
    public function view(Admin $admin) {
        if(!$admin->isShipper()) {
            return true;
        }
        return false;
    }

    public function viewDetails(Admin $admin) {
        if(!$admin->isShipper() && !$admin->isCustomerManager()) {
            return true;
        }
        return false;
    }

    public function create(Admin $admin) {
        if(!$admin->isShipper() && !$admin->isCustomerManager() && !$admin->isFranchise()) {
            return true;
        }
        return false;
    }

    public function update(Admin $admin) {
        if(!$admin->isShipper() && !$admin->isCustomerManager() && !$admin->isFranchise()) {
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
}
