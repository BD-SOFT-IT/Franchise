<template>
    <li class="nav-item dropdown task-dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarTaskDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-flag-o"></i>
            <span class="badge badge-info" v-if="!isLoading">{{ tasks.length }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarMailDropdown">
            <li class="dropdown-item header">
                <strong><span>{{ tasks.length }}</span> Orders in Progress</strong>
            </li>
            <loading v-if="isLoading" :title="'Please wait till loading'"></loading>
            <li class="dropdown-item main" v-if="!isLoading">
                <div class="list-group list-group-flush">
                    <a class="list-group-item" v-for="task in tasks" :href="'/bs-admin/shop/view-order/' + task.order_no">
                        <p>ORD#{{ task.order_no }} <span class="pull-right text-capitalize" :class="setProgressText(task.order_progress)">{{ task.order_progress }}</span></p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped text-capitalize" :class="setProgressClass(task.order_progress)" role="progressbar"
                                 :style="setProgressStyle(task.order_progress)" :aria-valuenow="setProgressValue(task.order_progress)" aria-valuemin="0" aria-valuemax="100">
                                {{ task.order_progress }}
                            </div>
                        </div>
                    </a>
                </div>
            </li>
            <li class="dropdown-item footer text-center">
                <a href="/bs-admin/shop/orders" class="view-all">View all</a>
            </li>
        </ul>
    </li>
</template>

<script>
    export default {
        data() {
            return {
                isLoading: false,
                apiUrl: this.api_url,
                tasks: [],
                dataError: false
            }
        },
        created() {
            let self = this;
            self.fetchTasks();
            let get_tasks_interval = window.setInterval(function() {
                self.fetchTasks();
            }, 45000);
        },
        methods: {
            fetchTasks() {
                self = this;
                self.isLoading = true;
                axios.get('/bs-admin-api/admin-notification/orders-in-progress')
                    .then(function (response) {
                        self.tasks = response.data;
                        self.isLoading = false;
                    })
                    .catch(function (error) {
                        self.dataError = true;
                    });
            },
            setProgressClass(progress) {
                let pClass = 'bg-warning';
                if (progress.toLowerCase() === 'processing') {
                    pClass = 'bg-info';
                }
                else if (progress.toLowerCase() === 'on delivery') {
                    pClass = 'bg-danger';
                }
                return pClass;
            },
            setProgressStyle(progress) {
                let pStyle = 'width: 25%';
                if (progress.toLowerCase() === 'processing') {
                    pStyle = 'width: 50%';
                }
                else if (progress.toLowerCase() === 'on delivery') {
                    pStyle = 'width: 75%';
                }
                return pStyle;
            },
            setProgressValue(progress) {
                let areaValue = '25';
                if (progress.toLowerCase() === 'processing') {
                    areaValue = '50';
                }
                else if (progress.toLowerCase() === 'on delivery') {
                    areaValue = '75';
                }
                return areaValue;
            },
            setProgressText(progress) {
                let textColor = 'text-warning';
                if (progress.toLowerCase() === 'processing') {
                    textColor = 'text-info';
                }
                else if (progress.toLowerCase() === 'on delivery') {
                    textColor = 'text-danger';
                }
                return textColor;
            }
        }
    }
</script>
