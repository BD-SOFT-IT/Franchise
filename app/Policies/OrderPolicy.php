<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Order;
use App\Models\Shipper;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
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
     * Determine whether the admin can view the order.
     *
     * @param  Admin $admin
     * @param Order $order
     * @return bool
     */
    public function view(Admin $admin, Order $order) {
        if($admin) {
            // if Admin is shipper then check for the shipper id of the Order
            if($admin->isShipper() && ($order->order_shipper_id == null || $admin->id != Shipper::find($order->order_shipper_id)->shipper_user_id)) {
                return false;
            }
            if($admin->isFranchise()) {
                if($order->order_for_franchise && $order->order_for_franchise !== $admin->franchise_id) {
                    return false;
                }
                if($order->order_by_franchise && $order->order_by_franchise !== $admin->franchise_id) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }

    /**
     * Determine whether the admin can edit & update the order.
     *
     * @param  Admin $admin
     * @param Order $order
     * @return bool
     */
    public function update(Admin $admin, Order $order) {

        $progress = strtolower($order->order_progress);

        if($progress == 'pending' || $progress == 'processing' || $progress == 'on delivery') {
            if($admin->isSuperAdmin() || $admin->isAdmin() || $admin->isManager() || $admin->isCustomerManager()) {
                return true;
            }
            if($admin->isFranchise() && ($order->order_for_franchise && $order->order_for_franchise = $admin->franchise_id)) {
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * Determine whether the admin can approve the order.
     *
     * @param  Admin $admin
     * @param Order $order
     * @return bool
     */
    public function approve(Admin $admin, Order $order) {

        if(strtolower($order->order_progress) == 'pending') {
            if($admin->isSuperAdmin() || $admin->isAdmin() || $admin->isManager() || $admin->isCustomerManager()) {
                return true;
            }
            if($admin->isFranchise() && ($order->order_for_franchise && $order->order_for_franchise = $admin->franchise_id)) {
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * Determine whether the admin can process the order.
     *
     * @param  Admin $admin
     * @param Order $order
     * @return bool
     */
    public function process(Admin $admin, Order $order) {

        if(strtolower($order->order_progress) == 'processing') {
            if($admin->isSuperAdmin() || $admin->isAdmin() || $admin->isManager() || $admin->isStoreKeeper()) {
                return true;
            }
            if($admin->isFranchise() && ($order->order_for_franchise && $order->order_for_franchise = $admin->franchise_id)) {
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * Determine whether the admin can deliver the order.
     *
     * @param  Admin $admin
     * @param Order $order
     * @return bool
     */
    public function deliver(Admin $admin, Order $order) {

        if(strtolower($order->order_progress) == 'on delivery') {
            if($admin->isSuperAdmin() || $admin->isAdmin() || $admin->isManager() || $admin->isShipper()) {
                if($admin->isShipper() && ($order->order_shipper_id == null || $admin->id != Shipper::find($order->order_shipper_id)->shipper_user_id)) {
                    return false;
                }
                return true;
            }
            if($admin->isFranchise() && ($order->order_for_franchise && $order->order_for_franchise = $admin->franchise_id)) {
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * Determine whether the admin can cancel the order.
     *
     * @param  Admin $admin
     * @param Order $order
     * @return bool
     */
    public function cancel(Admin $admin, Order $order) {
        $progress = strtolower($order->order_progress);
        if($progress != 'delivered' && $progress != 'canceled') {
            if($admin->isSuperAdmin() || $admin->isAdmin() || $admin->isManager() || $admin->isCustomerManager()) {
                return true;
            }
            if($admin->isFranchise()) {
                if($order->order_for_franchise && $order->order_for_franchise = $admin->franchise_id) {
                    return true;
                }
                if($order->order_by_franchise && $order->order_by_franchise = $admin->franchise_id && strtolower($order->order_progress) === 'pending') {
                    return true;
                }
            }
            return false;
        }
        return false;
    }

    /**
     * Determine whether the admin can create order.
     *
     * @param  Admin $admin
     * @return bool
     */
    public function create(Admin $admin) {
        if($admin->isSuperAdmin() || $admin->isAdmin() || $admin->isManager() || $admin->isCustomerManager()) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the admin can delete the order.
     *
     * @param  Admin $admin
     * @return bool
     */
    public function delete(Admin $admin) {
        return $admin->isSuperAdmin();
    }


}
