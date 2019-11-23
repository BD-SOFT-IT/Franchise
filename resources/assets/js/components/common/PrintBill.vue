<template>
    <div id="printBill">
        <div class="bill-header">
            <div class="row">
                <div class="col-8">
                    <img class="bill-logo" src="/assets/images/logo_bw.png">
                    <p class="bill-address">
                        248/A, Bangla Sharak, Rayer Bazaar, Dhaka-1209 <br>
                        Mobile: 880 1619 229227
                    </p>
                </div>
                <div class="col-4 text-right">
                    <p class="invoice">
                        Invoice
                    </p>
                </div>
            </div>
        </div>
        <table class="table">

        </table>
    </div>
</template>

<script>
    export default {
        props: ['order_data', 'order_details', 'created_at'],
        computed: {
            order() {
                return JSON.parse(this.order_data);
            },
            orderDetails() {
                return JSON.parse(this.order_details);
            }
        }
    }
</script>

<style>
    #printBill { max-width: 156mm; background-color: #fff; padding: 15px; }
    .bill-logo { max-width: 180px; }
    .bill-address { font-size: 13px; font-weight: 600; margin: 10px 0 0 10px; }
    .invoice { font-size: 22px; font-weight: 600; }

</style>