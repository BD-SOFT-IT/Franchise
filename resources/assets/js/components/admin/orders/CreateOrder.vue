<template>
    <div class="card">
        <div class="card-header" v-html="headerText">

        </div>
        <div class="card-body">

        </div>
    </div>
</template>

<script>
    export default {
        props: ['order_no'],
        data() {
            return {
                order: {
                    order_client_id: '',
                    order_shipping_datetime: '',
                    order_shipping_type: '',
                    order_shipping_fees: '',
                    order_shipping_person: '',
                    order_shipping_phone: '',
                    order_shipping_address: '',
                    order_shipping_city: '',
                    order_shipping_state: '',
                    order_shipping_postcode: '',
                    order_shipper_id: '',
                    order_vat: '',
                    order_products_total: '',
                    order_total: '',
                    order_total_paid_with_account: '',
                    order_total_due: '',
                    order_payment_type: '',
                    order_payment_status: '',
                    order_note: ''
                },
                products: [],
                client: {},
                headerText: '<strong><i class="fa fa-plus"></i> Create</strong> Order',
            }
        },
        methods: {

        },
        created() {
            if(this.order_no === undefined) {
                this.headerText = '<strong><i class="fa fa-plus"></i> Create</strong> Order';
            }
            else {
                this.headerText = '<strong><i class="fa fa-pencil"></i> Edit</strong> Order';
            }
        }
    }
</script>