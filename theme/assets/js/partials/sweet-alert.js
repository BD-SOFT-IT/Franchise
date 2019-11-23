import Vue from 'vue';

import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);

const SweetAlert = {
    install(Vue, options) {
        //Vue.myAddedProperty = 'Example Property'
       /* Vue.myAddedMethod = function() {
            return Vue.myAddedProperty
        }*/
        Vue.prototype.$showErrorSwal = function({ title, text }) {
            Vue.swal({
                toast: true,
                position: 'bottom',
                showConfirmButton: false,
                timer: 5000,
                type: 'error',
                title: title,
                text: text,
                customClass: {
                    popup: 'error-swal'
                }
            });
        };

        Vue.prototype.$showErrorModal = function({ title, text }) {
            Vue.swal({
                toast: false,
                timer: 4000,
                type: 'error',
                title: title,
                text: text,
                customClass: {
                    popup: 'error-swal error-swal-modal'
                }
            });
        };

        Vue.prototype.$showSuccessSwal = function({ title, text }) {
            Vue.swal({
                toast: true,
                position: 'bottom',
                showConfirmButton: false,
                timer: 5000,
                type: 'success',
                title: title,
                text: text,
                customClass: {
                    popup: 'success-swal'
                }
            });
        };

        Vue.prototype.$showSuccessModal = function({ title, text }) {
            Vue.swal({
                toast: false,
                timer: 4000,
                type: 'success',
                title: title,
                text: text,
                customClass: {
                    popup: 'success-swal success-swal-modal'
                }
            });
        };

    }
};

export default SweetAlert;
