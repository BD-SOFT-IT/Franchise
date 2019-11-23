<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class SiteOptionPolicy
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

    public function manage(Admin $admin) {
        if($admin->isSuperAdmin() || $admin->isAdmin()) {
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
