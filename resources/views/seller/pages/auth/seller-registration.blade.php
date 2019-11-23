    @extends('seller.seller-master')

    @section('sellerRegistration')
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-2">
                    <div class="do-main-regi">
                        <h3 class="lead" style="margin-bottom: 100px; margin-left: 55px; letter-spacing: 2px;">Seller
                            Registration</h3>
                        <div class="main-input-field">
                            <form action="{{ route('seller.registered') }}" method="post" class="was-validated"
                                  autocomplete="off">
                                @csrf
                                <div class="form-group py-5">
                                    <div class="form-row mb-3 ml-0" style="border-bottom: 1px dashed #c1c1c1">
                                        <h6 class="">Shop Details</h6>
                                    </div>
                                    <div class="custom-control custom-checkbox form-group custom-control-inline">
                                        <input type="checkbox" name="type_of_seller"
                                               class="custom-control-input
                                        form-control"
                                               id="sellerPersonal" value="personal">
                                        <label class="custom-control-label" for="sellerPersonal">Personal</label>
                                    </div>
                                    <div class="custom-control custom-checkbox form-group custom-control-inline">
                                        <input type="checkbox" name="type_of_seller"
                                               class="custom-control-input
                                        form-control"
                                               id="sellerBusiness" value="business">
                                        <label class="custom-control-label" for="sellerBusiness">Business</label>
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="col">
                                            <input type="text" name="shop_name" id="shopName" class="form-control"
                                                   placeholder="What is your Shop name?">
                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="col-6">
                                            <input type="text" name="shop_address" id="shopName" class="form-control"
                                                   placeholder="Shop Address">
                                        </div>
                                        <div class="col">
                                            <input type="text" name="shop_road_number" id="shopName"
                                                   class="form-control"
                                                   placeholder="Road number">
                                        </div>
                                        <div class="col">
                                            <input type="text" name="shop_district" id="shopName" class="form-control"
                                                   placeholder="District">
                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="col-7">
                                            <input type="text" name="shop_url" id="shopName" class="form-control"
                                                   placeholder="Facebook page or Website">
                                        </div>
                                        <div class="col">
                                            <input type="text" name="shop_identity" id="shopName" class="form-control"
                                                   placeholder="Enter National ID or Trade Licence Number">
                                        </div>
                                    </div>

                                    <!-- Seller Details Started from here-->

                                    <div class="form-row mb-3 ml-0" style="border-bottom: 1px dashed #c1c1c1">
                                        <h6 class="">Seller Details</h6>
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="col">
                                            <input type="text" name="seller_first_name" class="form-control"
                                                   placeholder="First name">
                                        </div>
                                        <div class="col">
                                            <input type="text" name="seller_last_name" class="form-control"
                                                   placeholder="Last name">
                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="col">
                                            <input type="email" name="seller_email" id="sellerEmail"
                                                   class="form-control" placeholder="Enter your e-mail address">
                                        </div>
                                    </div>

                                    <div class="form-row mb-3">
                                        <div class="col">
                                            <input type="password" name="seller_password" id="sellerPassword"
                                                   class="form-control" placeholder="Enter your password">
                                        </div>
                                        <div class="col">
                                            <input type="password" name="confirm_seller_password"
                                                   id="confirmSellerPassword"
                                                   class="form-control" placeholder="Confirm your password">
                                            <small name="password_not_match_error"></small>
                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="col">
                                            <input type="tel" name="seller_number" id="sellerNumber" class="form-control"
                                                   placeholder="Phone number">
                                        </div>
                                        <div class="col">
                                            <input type="tel" name="seller_alt_number" id="sellerAltNumber"
                                                   class="form-control"
                                                   placeholder="Alternate Phone number">
                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="custom-control custom-checkbox form-group custom-control-inline">
                                            <input type="checkbox" name="seller_terms_conditions"
                                                   class="custom-control-input
                                            form-control"
                                                   id="termsConditions" value="Agree">
                                            <label class="custom-control-label" for="termsConditions">I've
                                                read and understood ecom's <a href="">Terms & Conditions</a></label>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <input type="submit" name="seller_button" class="btn btn-success"
                                                   value="Submit">
                                        </div>
                                        <div class="col-10">
                                            <p class="lead">Already have a account? <a href="">Sign In</a></p>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
