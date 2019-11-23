<template>
    <div class="checkout-content-wrapper">
        <div class="checkout-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link" :class="{'active': active === 'login', 'disabled': loginDisabled, 'checked': loginChecked}" id="nav-login-tab" data-toggle="tab" href="#nav-login"
                                   role="tab" aria-controls="nav-login" aria-selected="true">
                                    <i class="icon ion-md-checkmark-circle-outline" v-if="loginChecked && active !== 'login'"></i>
                                    <i class="icon ion-ios-contact" v-else></i>
                                    <span class="d-none d-md-inline-block">Login</span>
                                </a>
                                <a class="nav-item nav-link" :class="{'active': active === 'billing', 'disabled': billingDisabled, 'checked': billingChecked}" id="nav-billing-tab" data-toggle="tab" href="#nav-billing"
                                   role="tab" aria-controls="nav-billing" aria-selected="false">
                                    <i class="icon ion-md-checkmark-circle-outline" v-if="billingChecked && active !== 'billing'"></i>
                                    <i class="icon ion-ios-card" v-else></i>
                                    <span class="d-none d-md-inline-block">Order Details</span>
                                </a>
                                <a class="nav-item nav-link" :class="{'active': active === 'payment', 'disabled': paymentDisabled, 'checked': paymentChecked}" id="nav-payment-tab" data-toggle="tab" href="#nav-payment"
                                   role="tab" aria-controls="nav-payment" aria-selected="false">
                                    <i class="icon ion-md-checkmark-circle-outline" v-if="paymentChecked && active !== 'payment'"></i>
                                    <i class="icon ion-ios-cash" v-else></i>
                                    <span class="d-none d-md-inline-block">Delivery & Payment</span>
                                </a>
                                <a class="nav-item nav-link" :class="{'active': active === 'confirm', 'disabled': confirmDisabled}" id="nav-confirm-tab" data-toggle="tab" href="#nav-confirm"
                                   role="tab" aria-controls="nav-confirm" aria-selected="false">
                                    <i class="icon ion-ios-cart"></i>
                                    <span class="d-none d-md-inline-block">Confirm</span>
                                </a>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="checkout-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="tab-content checkout-content-details" id="nav-tabContent">
                            <div class="tab-pane fade" :class="{'show active': active === 'login'}" id="nav-login" role="tabpanel" aria-labelledby="nav-login-tab">
                                Login
                            </div>
                            <!-- Billing Tab -->
                            <div class="tab-pane fade" :class="{'show active': active === 'billing'}" id="nav-billing" role="tabpanel" aria-labelledby="nav-billing-tab">
                                <div class="card bsoft-card mb-4">
                                    <div class="card-header">
                                        <i class="icon ion-ios-card"></i> Billing Address
                                    </div>
                                    <div class="card-body">
                                        <div class="address billing-address">
                                            <form method="post">
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label for="billing_first_name">First Name <span>*</span> </label>
                                                        <input v-validate="'required|max:35|min:2'" data-vv-as="First Name" data-vv-validate-on="keyup" name="billing_first_name" :class="{'is-invalid' : errors.has('billing_first_name')}"
                                                               type="text" v-model="billingAddress.first_name" class="form-control" id="billing_first_name" placeholder="First Name">
                                                        <div class="invalid-feedback" v-if="errors.has('billing_first_name')">
                                                            {{ errors.first('billing_first_name') }}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="billing_last_name">Last Name <span>*</span> </label>
                                                        <input v-validate="'required|max:35|min:2'" data-vv-as="Last Name" data-vv-validate-on="keyup" name="billing_last_name" :class="{'is-invalid': errors.has('billing_last_name')}"
                                                               type="text" v-model="billingAddress.last_name" class="form-control" id="billing_last_name" placeholder="Last Name">
                                                        <div class="invalid-feedback" v-if="errors.has('billing_last_name')">
                                                            {{ errors.first('billing_last_name') }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="billing_address">Address <span>*</span> </label>
                                                    <textarea v-validate="'required|max:180|min:15'" data-vv-as="Address" data-vv-validate-on="keyup" name="billing_address" :class="{'is-invalid': errors.has('billing_address')}"
                                                              v-model="billingAddress.address" id="billing_address" class="form-control" rows="3" style="resize: none;"></textarea>
                                                    <div class="invalid-feedback" v-if="errors.has('billing_address')">
                                                        {{ errors.first('billing_address') }}
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="billing_area">Area </label>
                                                    <input type="text" v-model="billingAddress.area" class="form-control" id="billing_area" placeholder="Area">
                                                </div>

                                                <div class="form-group">
                                                    <label for="billing_city">City/District <span>*</span> </label>
                                                    <input v-validate="'required|max:55|min:4'" data-vv-as="City or District" data-vv-validate-on="keyup" name="billing_city" :class="{'is-invalid': errors.has('billing_city')}"
                                                           type="text" v-model="billingAddress.city" class="form-control" id="billing_city" placeholder="City">
                                                    <div class="invalid-feedback" v-if="errors.has('billing_city')">
                                                        {{ errors.first('billing_city') }}
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label for="billing_state">State/Division <span>*</span></label>
                                                        <select v-validate="'required'" data-vv-as="State or Division" data-vv-validate-on="change" name="billing_state" :class="{'is-invalid': errors.has('billing_state')}"
                                                                id="billing_state" v-model="billingAddress.state" class="form-control py-0 niceSelect wide" required>
                                                            <option value="">Select State</option>
                                                            <option v-for="state in states" :value="state">{{ state }}</option>
                                                        </select>
                                                        <div class="invalid-feedback" v-if="errors.has('billing_state')">
                                                            {{ errors.first('billing_state') }}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="billing_postcode">Postcode </label>
                                                            <input v-validate="'required|max:5|min:4'" data-vv-as="Postcode" data-vv-validate-on="keyup" name="billing_postcode" :class="{'is-invalid': errors.has('billing_postcode')}"
                                                                   type="text" v-model="billingAddress.postcode" class="form-control" id="billing_postcode" placeholder="Postcode">
                                                            <div class="invalid-feedback" v-if="errors.has('billing_postcode')">
                                                                {{ errors.first('billing_postcode') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="billing_email">Email</label>
                                                    <input v-validate="'email'" data-vv-as="Email" data-vv-validate-on="keyup" name="billing_email" :class="{'is-invalid': errors.has('billing_email')}"
                                                           type="email" v-model="billingAddress.email" class="form-control" id="billing_email" placeholder="Enter Your email">
                                                    <div class="invalid-feedback" v-if="errors.has('billing_email')">
                                                        {{ errors.first('billing_email') }}
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="billing_mobile">Mobile <span>*</span> </label>
                                                    <input v-validate="'required|mobile'" data-vv-as="Mobile Number" data-vv-validate-on="keyup" name="billing_mobile" :class="{'is-invalid': errors.has('billing_mobile')}"
                                                           type="tel" v-model="billingAddress.mobile" class="form-control" id="billing_mobile" placeholder="Mobile Number">
                                                    <div class="invalid-feedback" v-if="errors.has('billing_mobile')">
                                                        {{ errors.first('billing_mobile') }}
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" v-model="differentShippingAddress" id="customCheck1">
                                                        <label class="custom-control-label" for="customCheck1">Use Different Shipping Address</label>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <transition name="fade">
                                    <div class="card bsoft-card mb-4" v-show="differentShippingAddress">
                                        <div class="card-header">
                                            <i class="icon ion-ios-card"></i> Shipping Address
                                        </div>
                                        <div class="card-body">
                                            <div class="address shipping-address">
                                                <form method="post">
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="shipping_first_name">First Name <span>*</span> </label>
                                                            <input v-validate="'required|max:35|min:2'" data-vv-as="First Name" data-vv-validate-on="keyup" name="shipping_first_name" :class="{'is-invalid' : errors.has('shipping_first_name')}"
                                                                   type="text" v-model="shippingAddress.first_name" class="form-control" id="shipping_first_name" placeholder="First Name">
                                                            <div class="invalid-feedback" v-if="errors.has('shipping_first_name')">
                                                                {{ errors.first('shipping_first_name') }}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="shipping_last_name">Last Name <span>*</span> </label>
                                                            <input v-validate="'required|max:35|min:2'" data-vv-as="Last Name" data-vv-validate-on="keyup" name="shipping_last_name" :class="{'is-invalid': errors.has('shipping_last_name')}"
                                                                   type="text" v-model="shippingAddress.last_name" class="form-control" id="shipping_last_name" placeholder="Last Name">
                                                            <div class="invalid-feedback" v-if="errors.has('shipping_last_name')">
                                                                {{ errors.first('shipping_last_name') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="shipping_address">Address <span>*</span> </label>
                                                        <textarea v-validate="'required|max:180|min:15'" data-vv-as="Address" data-vv-validate-on="keyup" name="shipping_address" :class="{'is-invalid': errors.has('shipping_address')}"
                                                                  v-model="shippingAddress.address" id="shipping_address" class="form-control" rows="3" style="resize: none;"></textarea>
                                                        <div class="invalid-feedback" v-if="errors.has('shipping_address')">
                                                            {{ errors.first('shipping_address') }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="shipping_area">Area </label>
                                                        <input type="text" v-model="shippingAddress.area" class="form-control" id="shipping_area" placeholder="Area">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="shipping_city">City/District <span>*</span> </label>
                                                        <input v-validate="'required|max:55|min:4'" data-vv-as="City or District" data-vv-validate-on="keyup" name="shipping_city" :class="{'is-invalid': errors.has('shipping_city')}"
                                                               type="text" v-model="shippingAddress.city" class="form-control" id="shipping_city" placeholder="City">
                                                        <div class="invalid-feedback" v-if="errors.has('shipping_city')">
                                                            {{ errors.first('shipping_city') }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="shipping_state">State/Division <span>*</span></label>
                                                            <select v-validate="'required'" data-vv-as="State or Division" data-vv-validate-on="change" name="shipping_state" :class="{'is-invalid': errors.has('shipping_state')}"
                                                                    id="shipping_state" v-model="shippingAddress.state" class="form-control py-0 niceSelect wide" required>
                                                                <option value="">Select State</option>
                                                                <option v-for="state in states" :value="state">{{ state }}</option>
                                                            </select>
                                                            <div class="invalid-feedback" v-if="errors.has('shipping_state')">
                                                                {{ errors.first('shipping_state') }}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="shipping_postcode">Postcode </label>
                                                                <input v-validate="'required|max:5|min:4'" data-vv-as="Postcode" data-vv-validate-on="keyup" name="shipping_postcode" :class="{'is-invalid': errors.has('shipping_postcode')}"
                                                                       type="text" v-model="shippingAddress.postcode" class="form-control" id="shipping_postcode" placeholder="Postcode">
                                                                <div class="invalid-feedback" v-if="errors.has('shipping_postcode')">
                                                                    {{ errors.first('shipping_postcode') }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="shipping_email">Email</label>
                                                        <input name="shipping_email" type="email" v-model="shippingAddress.email" class="form-control" id="shipping_email" placeholder="Enter Shipping email">

                                                    </div>

                                                    <div class="form-group">
                                                        <label for="shipping_mobile">Mobile <span>*</span> </label>
                                                        <input v-validate="'required|mobile'" data-vv-as="Mobile Number" data-vv-validate-on="keyup" name="shipping_mobile" :class="{'is-invalid': errors.has('shipping_mobile')}"
                                                               type="tel" v-model="shippingAddress.mobile" class="form-control" id="shipping_mobile" placeholder="Mobile Number">
                                                        <div class="invalid-feedback" v-if="errors.has('shipping_mobile')">
                                                            {{ errors.first('shipping_mobile') }}
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </transition>

                                <div class="footer-action">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="/shop" class="btn btn-link">Continue Shopping</a>
                                        </div>

                                        <div class="col-6 text-right">
                                            <button type="button" class="btn btn-success float-right" @click="continueToPayment" v-tooltip.top-center="'Continue to Delivery & Payment'">
                                                Continue <i class="icon ion-ios-arrow-forward"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Billing Tab -->

                            <!-- Payment Tab -->
                            <div class="tab-pane fade" :class="{'show active': active === 'payment'}" id="nav-payment" role="tabpanel" aria-labelledby="nav-payment-tab">
                                <div class="payment-delivery">
                                    <div class="card bsoft-card mb-4 shipping">
                                        <div class="card-header">
                                            <i class="icon ion-ios-car"></i> Delivery Method
                                        </div>

                                        <div class="card-info">
                                            Choose one of the delivery method listed below.
                                        </div>

                                        <div class="card-body p-0">
                                            <div class="custom-control custom-radio" v-for="(method, key) in shippingMethods">
                                                <input type="radio" :id="'deliveryMethod' + key" name="methodRadio" :value="method.id" v-model="deliveryMethod" class="custom-control-input">
                                                <label class="custom-control-label w-100" :for="'deliveryMethod' + key">
                                                    <span class="title d-block">
                                                        {{ method.name }} <span class="float-right"> <i class="sbicon sbicon-bdt"></i> {{ method.charge }} </span>
                                                    </span>
                                                    <span class="time d-block">
                                                        Estimated Time: {{ (method.time) ? method.time : 'N/A' }}
                                                    </span>
                                                    <small class="note d-block" v-if="method.note">
                                                        Note: {{ method.note }}
                                                    </small>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card bsoft-card mb-4 payment-method">
                                        <div class="card-header">
                                            <i class="icon ion-md-cash"></i> Payment Method
                                        </div>

                                        <div class="card-info">
                                            Choose one of the Payment method listed below.
                                        </div>

                                        <div class="card-body p-0">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="paymentMethod" name="payment_method" value="cash" v-model="paymentMethod" class="custom-control-input">
                                                <label class="custom-control-label w-100" for="paymentMethod">
                                                    <span class="title d-block">
                                                        Cash on Delivery
                                                        <img src="/images/payment/cod.png" alt="Cash on Delivery">
                                                    </span>
                                                    <span class="time d-block">
                                                        Availability: Only in Dhaka City
                                                    </span>
                                                    <small class="note d-block">
                                                        Note: It will be great if you would pay the Exact Amount of Money as Changes are Awful sometimes!
                                                    </small>
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="paymentMethod1" name="payment_method" value="bKash" v-model="paymentMethod" class="custom-control-input">
                                                <label class="custom-control-label w-100" for="paymentMethod1">
                                                    <span class="title d-block">
                                                        bKash ( 01974 442225  )
                                                        <img src="/images/payment/bkash.png" alt="bKash">
                                                    </span>
                                                    <span class="time d-block">
                                                        Availability: All over Country
                                                    </span>
                                                    <small class="note d-block">
                                                        Note: Please note down the Payment Transaction ID, for Security.
                                                    </small>
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="paymentMethod2" name="payment_method" value="rocket" v-model="paymentMethod" class="custom-control-input">
                                                <label class="custom-control-label w-100" for="paymentMethod2">
                                                    <span class="title d-block">
                                                        Rocket ( 01974 4422258 )
                                                        <img src="/images/payment/rocket.png" alt="Rocket">
                                                    </span>
                                                    <span class="time d-block">
                                                        Availability: All over Country
                                                    </span>
                                                    <small class="note d-block">
                                                        Note: Please note down the Payment Transaction ID, for Security.
                                                    </small>
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="paymentMethod3" name="payment_method" value="nogod" v-model="paymentMethod" class="custom-control-input">
                                                <label class="custom-control-label w-100" for="paymentMethod3">
                                                    <span class="title d-block">
                                                        Nogod ( 01974 442225 )
                                                        <img src="/images/payment/nogod.png" alt="Nogod">
                                                    </span>
                                                    <span class="time d-block">
                                                        Availability: All over Country
                                                    </span>
                                                    <small class="note d-block">
                                                        Note: Please note down the Payment Transaction ID, for Security.
                                                    </small>
                                                </label>
                                            </div>

                                            <transition name="fade">
                                                <div class="bkash-form payment-form" v-if="showPaymentForm">
                                                    <form>
                                                        <div class="form-group">
                                                            <label for="paymentTransaction">Transaction ID <span>*</span> </label>
                                                            <input type="text" id="paymentTransaction" name="payment_transaction" v-model="paymentTransaction" class="form-control">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="paymentAmount">Paid Amount <span>*</span> </label>
                                                            <input type="text" id="paymentAmount" name="payment_amount" v-model="paymentAmount" class="form-control">
                                                        </div>
                                                    </form>
                                                </div>
                                            </transition>

                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="paymentMethod4" name="payment_method" value="card" v-model="paymentMethod" class="custom-control-input" disabled>
                                                <label class="custom-control-label w-100" for="paymentMethod4">
                                                    <span class="title d-block">
                                                        Debit/Credit Card
                                                        <img src="/images/payment/card.png" alt="Cash on Delivery">
                                                    </span>
                                                    <span class="time d-block">
                                                        Availability: All over Country
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="footer-action">
                                        <div class="row">
                                            <div class="col-6">
                                                <a href="/shop" class="btn btn-link">Continue Shopping</a>
                                            </div>

                                            <div class="col-6 text-right">
                                                <button type="button" class="btn btn-secondary" @click="backToBilling" v-tooltip.top-center="'Go Back to Order Details'">
                                                    <i class="icon ion-ios-arrow-back"></i> Back
                                                </button>
                                                <button type="button" class="btn btn-success" @click="continueToConfirm">
                                                    Continue <i class="icon ion-ios-arrow-forward"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Payment Tab -->

                            <!-- Confirm Tab -->
                            <div class="tab-pane fade" :class="{'show active': active === 'confirm'}" id="nav-confirm" role="tabpanel" aria-labelledby="nav-confirm-tab">
                                <div class="confirm-order">
                                    <div class="card bsoft-card mb-4">
                                        <div class="card-header">
                                            <i class="icon ion-ios-card"></i> Billing Information
                                        </div>

                                        <div class="card-body">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Name</th>
                                                        <td><strong>{{ billingAddress.first_name + ' ' + billingAddress.last_name }}</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Email</th>
                                                        <td>{{ billingAddress.email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Mobile</th>
                                                        <td>{{ billingAddress.mobile }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Address</th>
                                                        <td>{{ billingAddress.address }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Area</th>
                                                        <td>{{ billingAddress.area }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">City/District</th>
                                                        <td>{{ billingAddress.city }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">State/Division</th>
                                                        <td>{{ billingAddress.state }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Postcode</th>
                                                        <td>{{ billingAddress.postcode }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="card bsoft-card mb-4" v-if="differentShippingAddress">
                                        <div class="card-header">
                                            <i class="icon ion-ios-card"></i> Shipping Information
                                        </div>

                                        <div class="card-body">
                                            <table class="table table-borderless">
                                                <tbody>
                                                <tr>
                                                    <th scope="row">Name</th>
                                                    <td><strong>{{ shippingAddress.first_name + ' ' + shippingAddress.last_name }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Email</th>
                                                    <td>{{ shippingAddress.email }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Mobile</th>
                                                    <td>{{ shippingAddress.mobile }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Address</th>
                                                    <td>{{ shippingAddress.address }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Area</th>
                                                    <td>{{ shippingAddress.area }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">City/District</th>
                                                    <td>{{ shippingAddress.city }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">State/Division</th>
                                                    <td>{{ shippingAddress.state }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Postcode</th>
                                                    <td>{{ shippingAddress.postcode }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="footer-action">
                                        <div class="row">
                                            <div class="col-6">
                                                <a href="/shop" class="btn btn-link">Continue Shopping</a>
                                            </div>

                                            <div class="col-6 text-right">
                                                <button type="button" class="btn btn-secondary" @click="backToPayment" v-tooltip.top-center="'Go Back to Delivery & Payment'">
                                                    <i class="icon ion-ios-arrow-back"></i> Back
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Confirm Tab -->
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="product-summary checkout-content-details">
                            <div class="card bsoft-card mb-4">
                                <div class="card-header">
                                    <i class="icon ion-md-clipboard"></i> Order Summary
                                </div>
                                <div class="card-info">
                                    The total cost consists of the vat, discount and the shipping charges
                                </div>
                                <div class="card-body">
                                    <div class="products table-responsive">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr v-for="(product, key) in cartItems" :class="{'list-part': (key + 1) === cartItemCount }">
                                                    <td>
                                                        <a :href="productSlug(product)" class="d-block title">{{ product.title }}</a>
                                                        <div class="options">
                                                            <small>
                                                                <span v-if="product.size !== null">
                                                                    Size: {{ product.size }} |
                                                                </span>
                                                                <span v-if="product.color !== null">
                                                                    Color: {{ product.color }} |
                                                                </span>
                                                                <span class="price">
                                                                    {{ product.qty }} x <i class="sbicon sbicon-bdt"></i> {{ product.price }}
                                                                </span>
                                                            </small>
                                                        </div>
                                                    </td>
                                                    <td class="text-right">
                                                        <i class="sbicon sbicon-bdt"></i> {{ (product.qty * product.price).toFixed(2) }}
                                                    </td>
                                                </tr>

                                                <tr class="summary-part summary-footer">
                                                    <td class="price-title">Sub-Total</td>
                                                    <td class="cart-price">{{ subtotal }}</td>
                                                </tr>
                                                <tr class="summary-footer">
                                                    <td class="price-title">
                                                        Discount
                                                        <small>
                                                            {{ discountText }}
                                                        </small>
                                                    </td>
                                                    <td class="cart-price">-{{ discountAmount }}</td>
                                                </tr>
                                                <tr class="summary-footer shipping-price">
                                                    <td class="price-title">
                                                        Shipping
                                                        <small v-if="shipping.name !== null">
                                                            {{ '(' + shipping.name + ')' }}
                                                        </small>
                                                    </td>
                                                    <td class="cart-price">{{ shipping.charge.toFixed(2) }}</td>
                                                </tr>
                                                <tr class="total-price summary-footer">
                                                    <td class="price-title" @click="showCouponForm = !showCouponForm">
                                                        Have a Discount Code?
                                                    </td>
                                                    <td class="cart-price">
                                                        <i class="sbicon sbicon-bdt"></i> {{ cartTotal }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <transition name="fade">
                                        <div class="coupon-form" v-if="showCouponForm">
                                            <form class="form-inline text-center" method="POST" @submit.prevent="validateCoupon">
                                                <label class="sr-only" for="couponCodeInput">Name</label>
                                                <input type="text" class="form-control mb-2 mr-sm-2" v-model="coupon" id="couponCodeInput" placeholder="Coupon Code" autofocus>

                                                <button type="submit" class="btn btn-primary mb-2">Apply</button>
                                            </form>
                                        </div>
                                    </transition>

                                </div>
                            </div>

                            <div class="card bsoft-card" v-if="active === 'confirm'">
                                <div class="card-header">
                                    <i class="icon ion-md-information-circle-outline"></i> Order Instruction
                                </div>

                                <div class="card-body">
                                    <form>
                                        <div class="form-group">
                                            <label for="instruction" class="sr-only">Order Instruction</label>
                                            <textarea name="orderInstruction" v-model="orderInstruction" class="form-control" id="instruction" rows="3" style="resize: none; height: auto !important;"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" v-model="termsCondition" id="customCheck12" required>
                                                <label class="custom-control-label" for="customCheck12">
                                                    I have read and agree to the website
                                                    <a href="/terms-conditions" class="text-danger" style="text-decoration: underline;">terms and conditions</a>.
                                                </label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="confirm-order-btn mt-3" v-if="active === 'confirm'">
                                <button class="btn btn-success w-100" type="submit" @click="placeOrder" :disabled="!termsCondition">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                coupon: null,
                showCouponForm: false,
                states: ['Dhaka', 'Chittagong', 'Rajshahi', 'Mymensingh', 'Khulna', 'Barishal', 'Rangpur', 'Sylhet'],

                billingAddress: {
                    first_name: '',
                    last_name: '',
                    email: '',
                    mobile: '',
                    address: '',
                    area: '',
                    city: '',
                    state: '',
                    postcode: ''
                },
                differentShippingAddress: false,
                shippingAddress: {
                    first_name: '',
                    last_name: '',
                    email: '',
                    mobile: '',
                    address: '',
                    area: '',
                    city: '',
                    state: '',
                    postcode: ''
                },
                orderInstruction: null,

                termsCondition: false,

                deliveryMethod: null,

                paymentMethod: 'cash',
                paymentTransaction: null,
                paymentAmount: null,

                showPaymentForm: false,
                showCardForm: false,

                active: 'billing',
                loginDisabled: true,
                billingDisabled: true,
                paymentDisabled: true,
                confirmDisabled: true,

                loginChecked: true,
                billingChecked: false,
                paymentChecked: false
            }
        },
        methods: {
            increaseItem(id, uid) {
                this.$store.dispatch('addToCart', { id: id, qty: 1, uid: uid }).then(
                    (response) => {
                        this.$showSuccessSwal({ title: 'Added!', text: 'Successfully Added to Cart.' });
                    }, (error) => {
                        //console.log(error.response);
                        this.$showErrorSwal({ title: 'OOPS!', text: 'Something Wrong! Please try again or refresh page.' });
                    });
            },
            deleteItem(uid, destroy) {
                this.$store.dispatch('removeProduct', { uid: uid, destroy: destroy }).then(
                    (response) => {
                        this.$showSuccessSwal({ title: 'Done!', text: 'Successfully Removed.' });
                    }, (error) => {
                        this.$showErrorSwal({ title: 'OOPS!', text: 'Something Wrong! Please try again or refresh page.' });
                    });
            },
            validateCoupon() {
                this.$store.dispatch('validateCoupon', { coupon: this.coupon }).then(
                    (response) => {
                        this.$showSuccessModal({ title: response, text: this.successText });
                    }, (error) => {
                        this.$showErrorSwal({ title: 'OOPS!', text: error });
                    });
            },
            confirmOrder() {

            },
            backToBilling() {
                this.billingChecked = false;
                this.billingDisabled = false;
                this.paymentDisabled = true;
                this.active = 'billing';
            },
            backToPayment() {
                this.paymentChecked = false;
                this.paymentDisabled = false;
                this.confirmDisabled = true;
                this.active = 'payment';
            },
            continueToPayment() {
                let self = this;
                if(!this.differentShippingAddress) {
                    this.shippingAddress = this.billingAddress;
                }
                this.$validator.validate().then(valid => {
                    if (!valid) {
                        this.$showErrorSwal({ title: 'Oops!', text: 'You must fill up all required fields!' });
                    }
                    else {
                        localStorage.setObject('billing_address', self.billingAddress);
                        if(self.differentShippingAddress) {
                            localStorage.setObject('shipping_address', self.shippingAddress);
                        } else {
                            localStorage.removeItem('shipping_address');
                        }
                        this.billingChecked = true;
                        this.billingDisabled = true;
                        this.paymentDisabled = false;
                        this.active = 'payment';
                    }
                });
            },
            continueToConfirm() {
                if(this.paymentMethod === 'bKash' || this.paymentMethod === 'rocket' || this.paymentMethod === 'nogod') {
                    if(!this.paymentTransaction) {
                        this.$showErrorSwal({ title: 'Invalid!', text: 'Payment Transaction ID is required!' }); return;
                    } else if(this.paymentTransaction.length < 8) {
                        this.$showErrorSwal({ title: 'Invalid!', text: 'Invalid bKash Transaction ID!' }); return;
                    } else if(!this.paymentAmount || this.paymentAmount <= 0 || isNaN(this.paymentAmount)) {
                        this.$showErrorSwal({ title: 'Invalid!', text: 'bKash Amount is required!' }); return;
                    }
                }
                this.paymentChecked = true;
                this.paymentDisabled = true;
                this.confirmDisabled = false;
                this.active = 'confirm';
            },
            productSlug(product) {
                let slug = product.slug;
                if(typeof product.fran !== 'undefined' && product.fran !== null) {
                    slug += ('?fra=' + product.fran);
                }
                return slug;
            },
            placeOrder() {
                let order = {
                    billing_address: this.billingAddress,
                    shipping_address: (this.differentShippingAddress) ? this.shippingAddress : null,
                    coupon: this.cartCoupon.code,
                    delivery: this.shipping.id,
                    products: this.cartItems,
                    payment: {
                        method: this.paymentMethod,
                        transaction: this.paymentTransaction,
                        amount: this.paymentAmount
                    },
                    note: this.orderInstruction
                };

                this.$store.dispatch('placeOrder', order).then((response) => {
                    //console.log(response.data);
                    this.$showSuccessModal({ title: 'Order Placed!', text: 'Your Order Has Been Successfully Placed!' });
                    window.localStorage.removeItem('billing_address');
                    window.localStorage.removeItem('shipping_address');
                    window.setTimeout(function () {
                        window.location.href = '/account#accountOrders';
                    }, 3000);
                }, (error) => {
                    console.log(error);
                });
            }
        },
        watch: {
            'deliveryMethod': function(newVal) {
                this.$store.dispatch('addShippingMethod', { id: newVal });
            },
            'coupon': function(newVal) {
                if(newVal) {
                    this.coupon = newVal.toUpperCase();
                }
            },
            'paymentMethod': function(newVal) {
                if(newVal === 'bKash' || newVal === 'rocket' || newVal === 'nogod') {
                    this.showPaymentForm = true;
                    this.showCardForm = false;
                }
                else if(newVal === 'card') {
                    this.showPaymentForm = false;
                    this.showCardForm = true;
                }
                else {
                    this.showPaymentForm = false;
                    this.showCardForm = false;
                }
            }
        },
        computed: {
            cartItems() {
                return this.$store.getters.cartItems;
            },
            cartItemCount() {
                return this.$store.getters.cartItemCount;
            },
            subtotal() {
                return this.$store.getters.cartItemTotal.toFixed(2);
            },
            discountAmount() {
                return this.$store.getters.couponDiscount;
            },
            cartCoupon() {
                return this.$store.state.cart.coupon;
            },
            shipping() {
                return this.$store.state.cart.shipping;
            },
            cartTotal() {
                return this.$store.getters.cartTotal;
            },
            discountText() {
                let text = '';
                if(this.cartCoupon.code !== null) {
                    text = '(' + this.cartCoupon.code;
                    if(this.cartCoupon.percentage !== null) {
                        text += (' - ' + this.cartCoupon.percentage.toFixed(2) + '%)');
                    }
                    else {
                        text += ')';
                    }
                }
                return text;
            },
            successText() {
                let text = '';
                if(this.cartCoupon.code !== null) {
                    if(this.cartCoupon.percentage !== null) {
                        text += ('You have got ' + this.cartCoupon.percentage.toFixed(2) + '% Discount');
                    }
                    else {
                        text += ('You have got ' + this.cartCoupon.amount.toFixed(2) + ' TK Discount');
                    }
                }
                return text;
            },
            user() {
                return this.$store.state.user;
            },
            shippingMethods() {
                return this.$store.state.shippingMethods;
            }
        },
        created() {
            let self = this;
            let billingAddress = localStorage.getObject('billing_address');
            let shippingAddress = localStorage.getObject('shipping_address');
            if(billingAddress) {
                if(shippingAddress) {
                    self.billingAddress = billingAddress;
                    self.shippingAddress = shippingAddress;
                    self.differentShippingAddress = true;
                } else {
                    self.billingAddress = self.shippingAddress = billingAddress;
                }
            } else {
                let intVal = window.setInterval(function () {
                    if(typeof self.user !== 'undefined' && self.user !== null) {
                        self.billingAddress.first_name = self.user.first_name;
                        self.billingAddress.last_name = self.user.last_name;
                        self.billingAddress.email = self.user.email;
                        self.billingAddress.mobile = '0' + self.user.mobile;
                        self.billingAddress.address = self.user.billing_address;
                        self.billingAddress.area = self.user.billing_area;
                        self.billingAddress.city = self.user.billing_city;
                        self.billingAddress.state = self.user.billing_state;
                        self.billingAddress.postcode = self.user.billing_postcode;
                        clearInterval(intVal);
                    }
                }, 500);
            }

            self.$store.watch((state) => state.cart.shipping.id, (newValue, oldValue) => {
                if(self.deliveryMethod === null) {
                    self.deliveryMethod = newValue;
                }
            });
            self.$store.watch((state) => state.cart.coupon.code, (newValue, oldValue) => {
                if(newValue !== null && self.coupon === null) {
                    self.coupon = newValue;
                }
            });
        },
        mounted() {
            let self = this;

            $(document).ready(function () {
                $('#billing_state').change(function() {
                    self.billingAddress.state = $(this).val();
                });

                $('#shipping_state').change(function() {
                    self.shippingAddress.state = $(this).val();
                });
            });
        }
    }
</script>
