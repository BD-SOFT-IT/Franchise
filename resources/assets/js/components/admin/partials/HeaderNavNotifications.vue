<template>
    <li class="nav-item dropdown notification-dropdown">
        <a title="Pending Orders" class="nav-link dropdown-toggle" href="#" id="navbarNotificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-shopping-cart"></i>
            <span class="badge badge-warning">{{ notifications.length }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarMailDropdown">
            <li class="dropdown-item header">
                You have <span>{{ notifications.length }}</span> <strong>Pending Orders</strong>
            </li>
            <loading v-if="isLoading" :title="'Please wait till loading'"></loading>
            <li class="dropdown-item main" v-if="!isLoading">
                <div class="list-unstyled">
                    <a class="media unread" v-for="notification in notifications" :href="'/bs-admin/shop/view-order/' + notification.order_no">
                        <div class="media-body">
                            <h5 class="mt-0">
                                {{ notification.order_no }}
                                <span class="pull-right"><i class="fa fa-clock-o"></i> {{ notification.created_before }}</span>
                            </h5>
                            <p>{{ notification.client_name }}</p>
                        </div>
                    </a>
                </div>
            </li>
            <li class="dropdown-item footer">
                <a href="/bs-admin/shop/pending-orders" class="view-all">View all</a>
                <a href="#" @click.prevent="getNotifications" class="mark-read pull-right">
                    <i class="fa fa-refresh"></i> Refresh
                </a>
            </li>
        </ul>
    </li>
</template>

<script>
    export default {
        data() {
            return {
                isLoading: false,
                notifications: []
            }
        },
        methods: {
            getNotifications() {
                this.isLoading = true;
                axios.get('/bs-admin-api/admin-notification/pending-orders')
                    .then((response) => {
                        this.notifications = response.data;
                        let count_elements = document.getElementsByClassName('pending-orders-count');
                        for(let i = 0; i < count_elements.length; i++) {
                            count_elements[i].innerText = response.data.length;
                        }
                        this.isLoading = false;
                    })
                    .catch((error) => { });
            }
        },
        created() {
            let self = this;
            self.getNotifications();
            let get_orders_interval = window.setInterval(function() {
                self.getNotifications();
            }, 45000);

        }
    }
</script>
