<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
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

    public function createSuperAdmin(Admin $admin) {
        if($admin->isSuperAdmin()) {
            return true;
        }
        return false;
    }

    public function manage(Admin $admin) {
        if($admin->isSuperAdmin() || $admin->isAdmin()) {
            return true;
        }
        return false;
    }

    public function delete(Admin $admin) {
        if($admin->isSuperAdmin()) {
            return true;
        }
        return false;
    }

    public function manageShipper(Admin $admin) {
        if($admin->isSuperAdmin() || $admin->isAdmin() || $admin->isManager()) {
            return true;
        }
        return false;
    }
}
