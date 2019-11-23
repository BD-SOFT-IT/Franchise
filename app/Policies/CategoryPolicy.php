<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
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

    public function control(Admin $admin) {
        if($admin->isSuperAdmin() || $admin->isAdmin()) {
            return true;
        }
        return false;
    }
}
