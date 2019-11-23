<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class BannerPolicy
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
        if($admin->isSuperAdmin() || $admin->isAdmin() || $admin->isManager() || $admin->isAlpha()) {
            return true;
        }
        return false;
    }
}
