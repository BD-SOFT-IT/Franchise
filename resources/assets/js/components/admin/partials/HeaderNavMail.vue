<template>
    <li class="nav-item dropdown mail-dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarMailDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-envelope-o"></i>
            <span class="badge badge-success">5</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarMailDropdown">
            <li class="dropdown-item header">
                You have <span>2</span> new messages
            </li>
            <loading v-if="isLoading" :title="'Please wait till loading'"></loading>
            <li class="dropdown-item main" v-if="!isLoading">
                <div class="list-unstyled">
                    <a class="media unread" href="">
                        <img class="align-self-center mr-3 img-fluid" src="/assets/images/user.png" alt="Jonson Bhowmik" title="Jonson Bhowmik">
                        <div class="media-body">
                            <h5 class="mt-0">Jonson <span class="pull-right"><i class="fa fa-clock-o"></i> 5 mins</span></h5>
                            <p>Cras sit amet nibh libero sit amet nibh libero Cras sit amet nibh </p>
                        </div>
                    </a>
                    <a class="media unread user-online" href="">
                        <img class="align-self-center mr-3 img-fluid" src="/assets/images/user.png" alt="Jonson Bhowmik" title="Jonson Bhowmik">
                        <div class="media-body">
                            <h5 class="mt-0">John <span class="pull-right"><i class="fa fa-clock-o"></i> 38 mins</span></h5>
                            <p>Cras sit amet nibh libero sit </p>
                        </div>
                    </a>

                    <a class="media user-online" href="">
                        <img class="align-self-center mr-3 img-fluid" src="/assets/images/user.png" alt="Jonson Bhowmik" title="Jonson Bhowmik">
                        <div class="media-body">
                            <h5 class="mt-0">Jonson <span class="pull-right"><i class="fa fa-clock-o"></i> 2 hours</span></h5>
                            <p>Cras sit amet nibh libero sit amett nibh </p>
                        </div>
                    </a>
                </div>
            </li>
            <li class="dropdown-item footer">
                <a href="#" class="view-all">View all</a>
                <a href="#" class="mark-read pull-right">Mark all as read</a>
            </li>
        </ul>
    </li>
</template>

<script>
    export default {
        data() {
            return {
                isLoading: false,
            }
        }
    }
</script>
