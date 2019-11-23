<template>
    <div class="admin-new-product">
        <div class="card">
            <div class="card-header">
                <span v-if="productId === null || productId === undefined"><strong><i class="fa fa-plus"></i> Add</strong> Product</span>
                <span v-else><strong><i class="fa fa-pencil"></i> Update</strong> Product</span>
            </div>
            <div class="card-body">
                <div style="background-color: #eaedf1; padding: 13px;">
                    <div class="row">
                        <div class="col-xl-6">
                            <!-- General Information -->
                            <form method="post" id="generalDataForm" accept-charset="UTF-8" @submit.prevent="saveGeneralData">
                                <div class="card">
                                    <div class="card-header">
                                        <strong><i class="fa fa-pencil"></i> General</strong> Data
                                    </div>

                                    <div class="card-body">

                                        <div class="form-group">
                                            <label for="productSku">SKU<span class="rbt-required-icon">*</span></label>
                                            <input type="text" v-model="product.product_sku" v-validate="'required|max:15|min:10'" data-vv-as="Product SKU" data-vv-validate-on="keyup" name="product_sku" class="form-control"
                                                   :class="{'is-invalid' : errors.has('product_sku')}" id="productSku" aria-describedby="productSkuHelp" placeholder="Product SKU" autofocus>

                                            <small id="productSkuHelp" class="form-text text-muted">Store Keeping Unit(SKU) for the product.</small>
                                            <div class="invalid-feedback" v-if="errors.has('product_sku')">
                                                {{ errors.first('product_sku') }}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="productTitle">Title<span class="rbt-required-icon">*</span></label>
                                            <input type="text" v-model="product.product_title" v-validate="'required|max:70|min:5'" data-vv-as="Product Title" data-vv-validate-on="keyup" name="product_title" class="form-control"
                                                   :class="{'is-invalid' : errors.has('product_title')}" id="productTitle" placeholder="Product Title">

                                            <div class="invalid-feedback" v-if="errors.has('product_title')">
                                                {{ errors.first('product_title') }}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="productTitle">Description<span class="rbt-required-icon">*</span></label>
                                            <wysiwyg v-model="product.product_description" placeholder="Enter Product Description....."></wysiwyg>

                                            <div class="invalid-feedback" v-if="customErrors.description" :class="{ 'd-block' : customErrors.description }">
                                                {{ customErrors.description }}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="productTitleBengali">Title <span class="adorsho-lipi">(বাংলা)</span></label>
                                            <input type="text" v-model="product.product_title_bengali" data-vv-validate-on="keyup" data-vv-as="Product Title (বাংলা)" name="product_title_bengali" class="form-control" id="productTitleBengali"
                                                   :class="{'is-invalid' : errors.has('product_title_bengali')}" placeholder="পণ্যের নাম" v-validate="'min:5|max:70'" style="font-family: 'AdorshoLipi';">

                                            <div class="invalid-feedback" v-if="errors.has('product_title_bengali')">
                                                {{ errors.first('product_title_bengali') }}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="productTitle">Description <span class="adorsho-lipi">(বাংলা)</span></label>
                                            <wysiwyg v-model="product.product_description_bengali" placeholder="পণ্যের বাংলা বিবরণ লিখুন....."></wysiwyg>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4">Categories<span class="rbt-required-icon">*</span></label>
                                            <div class="col-sm-8">
                                                <ul class="list-group pull-right">
                                                    <li class="list-group-item" v-for="(category, index) in selectedCategories">
                                                        {{ category.category_title }} <span class="pull-right text-danger" @click.prevent="removeCategory(index)" style="cursor: pointer;" title="Remove"><i class="fa fa-times"></i></span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-12">
                                                <category-auto-suggest-input @selected="addCategory"></category-auto-suggest-input>

                                                <div class="invalid-feedback" v-if="customErrors.categories" :class="{ 'd-block' : customErrors.categories }">
                                                    {{ customErrors.categories }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="productUnit">Unit<span class="rbt-required-icon">*</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="productUnit" v-validate="'required|decimal:2'" data-vv-as="Product Unit" data-vv-validate-on="keyup" v-model="product.product_unit_quantity"
                                                       :class="{'is-invalid' : errors.has('product_unit_quantity')}" name="product_unit_quantity" aria-describedby="productUnitHelp" placeholder="Enter amount per unit">

                                                <label for="productUnitName" class="sr-only"></label>
                                                <select class="custom-select" id="productUnitName" v-model="product.product_unit_name" data-vv-as="Product Unit Name" name="product_unit_name" v-validate="'required'" data-vv-validate-on="click"
                                                        :class="{'is-invalid' : errors.has('product_unit_name')}">
                                                    <option value="" selected>--- Choose Unit Name ---</option>
                                                    <option value="kg">Kilogram (kg)</option>
                                                    <option value="gm">Gram (gm)</option>
                                                    <option value="litre">Litre (L)</option>
                                                    <option value="ml">Milli Litre (ml)</option>
                                                    <option value="piece">Piece (PC)</option>
                                                    <option value="dozen">Dozen</option>
                                                    <option value="bundle">Bundle</option>
                                                </select>
                                                <div class="invalid-feedback" v-if="errors.has('product_unit_quantity')">
                                                    {{ errors.first('product_unit_quantity') }}
                                                </div>
                                                <div class="invalid-feedback" v-if="errors.has('product_unit_name')">
                                                    {{ errors.first('product_unit_name') }}
                                                </div>
                                            </div>
                                            <small id="productUnitHelp" class="form-text text-muted">Unit of the product. (Ex: 1 piece or 200gm)</small>
                                        </div>

                                        <div class="form-group">
                                            <label for="productUnitCost">Unit Cost<span class="rbt-required-icon">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">BDT</span>
                                                </div>
                                                <input type="text" class="form-control" id="productUnitCost" v-validate="'required|decimal:2'" data-vv-as="Product Unit Cost" data-vv-validate-on="keyup" v-model="product.product_unit_cost"
                                                       :class="{'is-invalid' : errors.has('product_unit_cost')}" name="product_unit_cost" aria-describedby="productUnitCostHelp" placeholder="Enter the cost price per unit...">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="sbicon sbicon-bdt"></i></span>
                                                </div>
                                                <div class="invalid-feedback" v-if="errors.has('product_unit_cost')">
                                                    {{ errors.first('product_unit_cost') }}
                                                </div>
                                            </div>
                                            <small id="productUnitCostHelp" class="form-text text-muted">Cost price per unit for the product.</small>

                                        </div>

                                        <div class="form-group">
                                            <label for="productUnitMRP">Unit MRP<span class="rbt-required-icon">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">BDT</span>
                                                </div>
                                                <input type="text" class="form-control" id="productUnitMRP" v-validate="'required|decimal:2'" data-vv-as="Product Unit MRP" data-vv-validate-on="keyup" v-model="product.product_unit_mrp"
                                                       :class="{'is-invalid' : errors.has('product_unit_mrp')}" name="product_unit_mrp" aria-describedby="productUnitMRPHelp" placeholder="Enter the MRP per unit...">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="sbicon sbicon-bdt"></i></span>
                                                </div>
                                                <div class="invalid-feedback" v-if="errors.has('product_unit_mrp')">
                                                    {{ errors.first('product_unit_mrp') }}
                                                </div>
                                            </div>
                                            <small id="productUnitMRPHelp" class="form-text text-muted">MRP per unit for the product.</small>
                                        </div>

                                        <div class="form-group">
                                            <label for="productUnitMRPFranchise">Unit MRP for Franchise<span class="rbt-required-icon">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">BDT</span>
                                                </div>
                                                <input type="text" class="form-control" id="productUnitMRPFranchise" v-validate="'required|decimal:2'" data-vv-as="Product Unit MRP for Franchise" data-vv-validate-on="keyup" v-model="product.product_unit_mrp_franchise"
                                                       :class="{'is-invalid' : errors.has('product_unit_mrp')}" name="product_unit_mrp" aria-describedby="productUnitMRPFranchiseHelp" placeholder="Enter the Franchise MRP per unit...">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="sbicon sbicon-bdt"></i></span>
                                                </div>
                                                <div class="invalid-feedback" v-if="errors.has('product_unit_mrp_franchise')">
                                                    {{ errors.first('product_unit_mrp_franchise') }}
                                                </div>
                                            </div>
                                            <small id="productUnitMRPFranchiseHelp" class="form-text text-muted">Franchise MRP per unit for the product.</small>
                                        </div>

                                        <div class="form-group">
                                            <label for="productActive">Status:</label>
                                            <toggle-button v-model="product.product_active" :width="90" id="productActive" color="#00a65a" class="rbt-toggle-btn pull-right"
                                                           :sync="true" :labels="{checked: 'Active', unchecked: 'Inactive'}"/>
                                        </div>

                                        <div class="form-group">
                                            <label for="productStockUnits">Units in Stock<span class="rbt-required-icon">*</span></label>
                                            <input type="number" v-model="product.product_units_in_stock" v-validate="'required|numeric'" data-vv-as="Product Units in Stock" data-vv-validate-on="change" name="product_units_in_stock" class="form-control"
                                                   :class="{'is-invalid' : errors.has('product_units_in_stock')}" id="productStockUnits" placeholder="Product Units in Stock">

                                            <div class="invalid-feedback" v-if="errors.has('product_units_in_stock')">
                                                {{ errors.first('product_units_in_stock') }}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="productSubtract">Subtract on Order<span class="rbt-required-icon">*</span>:</label>
                                            <toggle-button v-model="product.product_unit_subtract_on_order" :width="55" id="productSubtract" color="#00a65a" class="rbt-toggle-btn pull-right"
                                                           :sync="true" :labels="{checked: 'Yes', unchecked: 'No'}"/>
                                        </div>

                                        <div class="form-group">
                                            <label for="productStockStatus">Availability Status<span class="rbt-required-icon">*</span></label>
                                            <select class="custom-select" :class="{'is-invalid' : errors.has('product_availability_status')}" data-vv-as="Product Availability Status"
                                                    v-validate="'required'" data-vv-validate-on="click" id="productStockStatus" name="product_availability_status" v-model="product.product_availability_status">
                                                <option value="" selected>----- Select Availability Status -----</option>
                                                <option value="In Stock">In Stock</option>
                                                <option value="Out of Stock">Out of Stock</option>
                                                <option value="Pre-Order">Pre-Order</option>
                                                <option value="In 2-3 Days">In 2-3 Days</option>
                                                <option value="In 5-7 Days">In 5-7 Days</option>
                                                <option value="In 10-15 Days">In 10-15 Days</option>
                                                <option value="In 20-30 Days">In 20-30 Days</option>
                                            </select>
                                            <div class="invalid-feedback" v-if="errors.has('product_availability_status')">
                                                {{ errors.first('product_availability_status') }}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="productGuaranteeTime">Guarantee Status<span class="rbt-required-icon">*</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="productGuaranteeTime" v-model="product.product_guarantee_time"
                                                       :class="{'is-invalid' : customErrors.guarantee}" name="product_guarantee_status_time" aria-describedby="productGuaranteeStatusHelp" placeholder="1 Year or 6 Months">

                                                <label for="productGuaranteeStatus" class="sr-only"></label>
                                                <select class="custom-select" id="productGuaranteeStatus" v-model="product.product_guarantee_status" data-vv-as="Guarantee or Warranty Status" name="product_guarantee_status" v-validate="'required'" data-vv-validate-on="click"
                                                        :class="{'is-invalid' : errors.has('product_guarantee_status')}" style="width: 40%;">

                                                    <option value="">--- Choose Guarantee or Warranty Status ---</option>
                                                    <option value="Not Applicable">Not Applicable</option>
                                                    <option value="Money Back Guarantee">Money Back Guarantee</option>
                                                    <option value="Manufacturer's Replacement Warranty">Manufacturer's Replacement Warranty</option>
                                                    <option value="Manufacturer's Service Warranty">Manufacturer's Service Warranty</option>

                                                </select>
                                                <div class="invalid-feedback" v-if="customErrors.guarantee" :class="{ 'd-block' : customErrors.guarantee }">
                                                    {{ customErrors.guarantee }}
                                                </div>
                                                <div class="invalid-feedback" v-if="errors.has('product_guarantee_status')">
                                                    {{ errors.first('product_guarantee_status') }}
                                                </div>
                                            </div>
                                            <small id="productGuaranteeStatusHelp" class="form-text text-muted">Ex: 15 Days  Money Back Guarantee or 1 Year Manufacturer's Service Warranty</small>
                                        </div>

                                        <div class="form-group">
                                            <label for="productReplacementAvailable">Return or Replacement:</label>
                                            <toggle-button v-model="product.product_replacement_available" :width="110" id="productReplacementAvailable" color="#00a65a" class="rbt-toggle-btn pull-right"
                                                           :sync="true" :labels="{checked: 'Available', unchecked: 'Unavailable'}"/>
                                        </div>

                                        <div class="form-group">
                                            <label for="productAvailableOutside">Availability Outside Selected:</label>
                                            <toggle-button v-model="product.product_available_outside" :width="110" id="productAvailableOutside" color="#00a65a" class="rbt-toggle-btn pull-right"
                                                           :sync="true" :labels="{checked: 'Available', unchecked: 'Unavailable'}"/>
                                        </div>

                                        <div class="form-group">
                                            <label for="productMaxUnits">Max Units on Select<span class="rbt-required-icon">*</span></label>
                                            <input type="number" v-model="product.product_units_max_selection" v-validate="'required|numeric'" data-vv-as="Product Max Units on selection" data-vv-validate-on="change" name="product_units_max_selection" class="form-control"
                                                   :class="{'is-invalid' : errors.has('product_units_max_selection')}" id="productMaxUnits" aria-describedby="productMaxUnitsHelp" placeholder="Product Max Units on Selection">

                                            <small id="productMaxUnitsHelp" class="form-text text-muted">Max units a client can add on single order.</small>
                                            <div class="invalid-feedback" v-if="errors.has('product_units_max_selection')">
                                                {{ errors.first('product_units_max_selection') }}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="productMinUnits">Minimum Units For Franchise<span class="rbt-required-icon">*</span></label>
                                            <input type="number" v-model="product.product_units_min_franchise" v-validate="'required|numeric'" data-vv-as="Product Min Units For Franchise" data-vv-validate-on="change" name="product_units_min_franchise" class="form-control"
                                                   :class="{'is-invalid' : errors.has('product_units_min_franchise')}" id="productMinUnits" aria-describedby="productMinUnits" placeholder="Product Min Units For Franchise">

                                            <small id="productMinUnitsHelp" class="form-text text-muted">Minimum units a Franchise can add on single order.</small>
                                            <div class="invalid-feedback" v-if="errors.has('product_units_min_franchise')">
                                                {{ errors.first('product_units_min_franchise') }}
                                            </div>
                                        </div>

                                        <div class="form-group text-right">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fa fa-floppy-o"></i> {{ (productId === null || productId === undefined) ? 'Add' : 'Save' }}
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </form>
                            <!-- End of General Information -->

                        </div>

                        <div class="col-xl-6">
                            <!-- Product Options -->
                            <form method="post" id="optionsDataForm" accept-charset="UTF-8" @submit.prevent="saveOptionsData">
                                <div class="card">
                                    <div class="card-header">
                                        <strong><i class="fa fa-filter"></i> Product</strong> Options
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="productSizeAvailable">Size Available ?</label>
                                            <toggle-button v-model="sizeAvailable" :width="110" id="productSizeAvailable" color="#00a65a" class="rbt-toggle-btn pull-right"
                                                           :sync="true" :labels="{checked: 'Available', unchecked: 'Unavailable'}"/>
                                        </div>

                                        <div class="form-group row" v-if="sizeAvailable">
                                            <label for="productSizes" class="col-sm-4">Sizes<span class="rbt-required-icon">*</span>:</label>
                                            <div class="col-sm-8">
                                                <ul class="list-group pull-right">
                                                    <li class="list-group-item" v-for="(size, index) in productOptions.product_available_sizes">
                                                        {{ size }} <span class="pull-right text-danger" @click.prevent="removeSize(index)" style="cursor: pointer;" title="Remove"><i class="fa fa-times"></i></span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <input type="text" :class="{ 'is-invalid' : customErrors.size }" class="form-control" id="productSizes" placeholder="Enter Size" v-model="newSize">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" @click.prevent="addSize">Add Size</button>
                                                    </div>
                                                    <div class="invalid-feedback" v-if="customErrors.size">
                                                        {{ customErrors.size }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="productColorAvailable">Colors Available ?</label>
                                            <toggle-button v-model="colorAvailable" :width="110" id="productColorAvailable" color="#00a65a" class="rbt-toggle-btn pull-right"
                                                           :sync="true" :labels="{checked: 'Available', unchecked: 'Unavailable'}"/>
                                        </div>

                                        <div class="form-group row" v-if="colorAvailable">
                                            <label for="productColors" class="col-sm-4">Colors<span class="rbt-required-icon">*</span>:</label>
                                            <div class="col-sm-8">
                                                <ul class="list-group pull-right">
                                                    <li class="list-group-item" v-for="(color, index) in productOptions.product_available_colors">
                                                        {{ color }} <span class="pull-right text-danger" @click.prevent="removeColor(index)" style="cursor: pointer;" title="Remove"><i class="fa fa-times"></i></span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" :class="{ 'is-invalid' : customErrors.color }" id="productColors" placeholder="Enter Color" v-model="newColor">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" @click.prevent="addColor">Add Color</button>
                                                    </div>
                                                    <div class="invalid-feedback" v-if="customErrors.color">
                                                        {{ customErrors.color }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="productFeatured">Featured ?</label>
                                            <toggle-button v-model="productOptions.product_featured" :width="55" id="productFeatured" color="#00a65a" class="rbt-toggle-btn pull-right"
                                                           :sync="true" :labels="{checked: 'Yes', unchecked: 'No'}"/>
                                        </div>

                                        <div class="form-group">
                                            <label for="productOffered">Offered ?</label>
                                            <toggle-button v-model="productOptions.product_offered" :width="55" id="productOffered" color="#00a65a" class="rbt-toggle-btn pull-right"
                                                           :sync="true" :labels="{checked: 'Yes', unchecked: 'No'}"/>
                                        </div>

                                        <div class="form-group">
                                            <label for="productDiscounted">Discounted ?</label>
                                            <toggle-button v-model="productOptions.product_discounted" :width="55" id="productDiscounted" color="#00a65a" class="rbt-toggle-btn pull-right"
                                                           :sync="true" :labels="{checked: 'Yes', unchecked: 'No'}"/>
                                        </div>

                                        <div class="form-group" v-if="productOptions.product_discounted">
                                            <label for="productDiscountPercentage">Discount Percentage</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="productDiscountPercentage" v-validate="'max_value:100|decimal:2'" data-vv-as="Product Discount Percentage" data-vv-validate-on="keyup" v-model="productOptions.product_discount_percentage"
                                                       :class="{'is-invalid' : errors.has('product_discount_percentage')}" name="product_discount_percentage" aria-describedby="productDiscountPercentageHelp" placeholder="Discount Percentage in BDT...">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                                <div class="invalid-feedback" v-if="errors.has('product_discount_percentage')">
                                                    {{ errors.first('product_discount_percentage') }}
                                                </div>
                                            </div>
                                            <small id="productDiscountPercentageHelp" class="form-text text-muted">
                                                Discount Percentage (eg: 33.33)
                                                <br>
                                                Keep Blank if the discount is given by amount (BDT).
                                            </small>
                                        </div>

                                        <div class="form-group" v-if="productOptions.product_discounted">
                                            <label for="productDiscountAmount">Discount Amount</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">BDT</span>
                                                </div>
                                                <input type="text" class="form-control" id="productDiscountAmount" v-validate="'decimal:2'" data-vv-as="Product Discount Amount" v-model="productOptions.product_discount_amount"
                                                       :class="{'is-invalid' : errors.has('product_discount_amount')}" name="product_discount_amount" aria-describedby="productDiscountAmountHelp" placeholder="Discount Amount in BDT...">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="sbicon sbicon-bdt"></i></span>
                                                </div>
                                                <div class="invalid-feedback" v-if="errors.has('product_discount_amount')">
                                                    {{ errors.first('product_discount_amount') }}
                                                </div>
                                            </div>
                                            <small id="productDiscountAmountHelp" class="form-text text-muted">
                                                Discount Amount per unit in BDT.
                                                <br>
                                                Keep Blank if the discount is given by percentages(%).
                                            </small>
                                        </div>

                                        <div class="form-group text-right">
                                            <button :disabled="!showOptionsSaveBtn" type="submit" class="btn btn-success">
                                                <i class="fa fa-floppy-o"></i> Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- End of Product Options -->

                            <!-- Vendor Data -->
                            <form method="post" id="vendorDataForm" accept-charset="UTF-8" @submit.prevent="saveVendorData">
                                <div class="card">
                                    <div class="card-header">
                                        <strong><i class="fa fa-bookmark"></i> Vendor</strong> Data
                                    </div>

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="productVendor">Vendor (Brand)</label>
                                            <select class="custom-select" id="productVendor" v-model="productVendor.product_vendor">
                                                <option value="">--- Choose Brand ---</option>
                                                <option v-for="brand in brands" :value="brand.pb_id">
                                                    {{ brand.pb_name }}
                                                </option>
                                            </select>
                                            <a href="" data-toggle="modal" data-target="#createProductBrandModal" class="text-right d-block" style="font-size: 13px; color: #394263; text-decoration: underline; margin-top: 3px;">
                                                New Brand
                                            </a>
                                        </div>

                                        <div class="form-group">
                                            <label for="productVendorSku">Vendor SKU</label>
                                            <input type="text" v-model="productVendor.product_vendor_sku" v-validate="'max:30'" data-vv-as="Product Vendor SKU" data-vv-validate-on="keyup" name="product_vendor_sku" class="form-control"
                                                   :class="{'is-invalid' : errors.has('product_vendor_sku')}" id="productVendorSku" placeholder="Product Vendor SKU">

                                            <div class="invalid-feedback" v-if="errors.has('product_vendor_sku')">
                                                {{ errors.first('product_vendor_sku') }}
                                            </div>
                                        </div>

                                        <div class="form-group text-right">
                                            <button type="submit" class="btn btn-success" :disabled="!showVendorSaveBtn">
                                                <i class="fa fa-floppy-o"></i> Save
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </form>
                            <!-- End of Vendor Data -->

                            <!-- Meta Data -->
                            <form method="post" id="metaDataForm" accept-charset="UTF-8" @submit.prevent="saveMetaData">
                                <div class="card">
                                    <div class="card-header">
                                        <strong><i class="fa fa-google"></i> Meta</strong> Data
                                    </div>

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="productKeywords">Keywords</label>
                                            <input type="text" v-model="productMeta.product_keywords" v-validate="'max:350|min:50'" data-vv-as="Product Keywords" data-vv-validate-on="keyup" name="product_keywords" class="form-control"
                                                   :class="{'is-invalid' : errors.has('product_keywords')}" id="productKeywords" placeholder="Product Keywords">

                                            <div class="invalid-feedback" v-if="errors.has('product_keywords')">
                                                {{ errors.first('product_keywords') }}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="productDescriptionShort">Short Description</label>
                                            <textarea v-model="productMeta.product_description_short" rows="6" v-validate="'max:512|min:70'" data-vv-as="Product Short Description" data-vv-validate-on="keyup" name="product_description_short" class="form-control" :class="{'is-invalid' : errors.has('product_description_short')}" id="productDescriptionShort" placeholder="Product Short Description...."></textarea>

                                            <div class="invalid-feedback" v-if="errors.has('product_description_short')">
                                                {{ errors.first('product_description_short') }}
                                            </div>
                                        </div>

                                        <div class="form-group text-right">
                                            <button type="submit" class="btn btn-success" :disabled="!showMetaSaveBtn">
                                                <i class="fa fa-floppy-o"></i> Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- End of Meta Data -->

                            <!-- App Data -->
                            <!--<form method="post" id="appDataForm" accept-charset="UTF-8" @submit.prevent="saveAppData">
                                <div class="card">
                                    <div class="card-header">
                                        <strong><i class="fa fa-mobile"></i> Mobile App</strong> Data
                                    </div>

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="productAppDescription">App Description</label>
                                            <textarea v-model="productApp.product_description_app" rows="6" v-validate="'max:1024|min:50'" data-vv-as="Product Short Description" data-vv-validate-on="keyup" name="product_description_app" class="form-control" :class="{'is-invalid' : errors.has('product_description_app')}" id="productAppDescription" placeholder="Product App Description"></textarea>

                                            <div class="invalid-feedback" v-if="errors.has('product_description_app')">
                                                {{ errors.first('product_description_app') }}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="productAppDescriptionBengali">App Description (Bengali)</label>
                                            <textarea v-model="productApp.product_description_bengali_app" rows="6" v-validate="'max:1024|min:50'" data-vv-as="Product Short Description Bengali" data-vv-validate-on="keyup" name="product_description_bengali_app" class="form-control" :class="{'is-invalid' : errors.has('product_description_bengali_app')}" id="productAppDescriptionBengali" placeholder="Product App Description Bengali"></textarea>

                                            <div class="invalid-feedback" v-if="errors.has('product_description_bengali_app')">
                                                {{ errors.first('product_description_bengali_app') }}
                                            </div>
                                        </div>

                                        <div class="form-group text-right">
                                            <button type="submit" class="btn btn-success" :disabled="!showAppSaveBtn">
                                                <i class="fa fa-floppy-o"></i> Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>-->
                            <!-- End of App Data -->

                            <!-- Product Image -->
                            <form method="post" id="imageDataForm" accept-charset="UTF-8" @submit.prevent="saveImageData">
                                <div class="card">
                                    <div class="card-header">
                                        <strong><i class="fa fa-picture-o"></i> Product</strong> Images
                                    </div>

                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="table-responsive product-images">
                                                <table class="table-bordered table-striped w-100">
                                                    <tbody>
                                                    <tr v-for="(image, index) in selectedImages" class="text-center">
                                                        <td style="max-width: 150px">
                                                            <img :src="image.cache">
                                                        </td>
                                                        <td>
                                                            <toggle-button color="#00a65a" class="rbt-toggle-btn" :value="(image.original === productImages.product_img_main)"
                                                                           :disabled="(image.original === productImages.product_img_main)"
                                                                           @change="changeMainImg(image.original)"
                                                                           :sync="true"
                                                                           :labels="false"/>
                                                            Main
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger" title="Remove this image" @click.prevent="removeImg(index, image.original)">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>

                                                    <tr class="text-center" v-if="showAddImageButton">
                                                        <td class="text-center" style="width: 150px;">
                                                            <img src="/assets/images/icon_bw.png">
                                                        </td>
                                                        <td>
                                                            <toggle-button color="#00a65a" class="rbt-toggle-btn" :value="false" :disabled="true" :labels="false"/>
                                                            Main
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#rbtMediaManager">Add New</button>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="form-group text-right">
                                            <button type="submit" class="btn btn-success" :disabled="!showImageSaveBtn">
                                                <i class="fa fa-floppy-o"></i> Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- End of Product Image -->

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <create-product-brand show_as="modal" @brand-added="brandAdded"></create-product-brand>
        <rbt-media-manager directory="products" :user_id="$root.admin.id" url_prefix="/bs-mm-api" show_as="modal" @image-selected="imageAdded"></rbt-media-manager>

    </div>
</template>

<script>
    import CategoryAutoSuggestInput from '../auto-suggest-inputs/CategoryAutoSuggestInput.vue';

    export default {
        props: ['product_id'],
        components: { 'category-auto-suggest-input': CategoryAutoSuggestInput },
        data() {
            return {
                productId: null,
                product: {
                    product_sku: '',
                    product_title: '',
                    product_title_bengali: '',
                    product_description: '',
                    product_description_bengali: '',
                    product_categories: [],
                    product_unit_name: '',
                    product_unit_quantity: '',
                    product_unit_cost: '',
                    product_unit_mrp: '',
                    product_unit_mrp_franchise: 0,
                    product_units_in_stock: 0,
                    product_availability_status: '',
                    product_replacement_available: false,
                    product_guarantee_time: '',
                    product_guarantee_status: 'Not Applicable',
                    product_unit_subtract_on_order: true,
                    product_active: true,
                    product_available_outside: false,
                    product_units_max_selection: 10,
                    product_units_min_franchise: 1
                },
                selectedCategories: [],
                productOptions: {
                    product_available_sizes: [],
                    product_available_colors: [],
                    product_featured: false,
                    product_offered: false,
                    product_discounted: false,
                    product_discount_amount: null,
                    product_discount_percentage: null,
                },
                productVendor: {
                    product_vendor: '',
                    product_vendor_sku: '',
                },
                productMeta: {
                    product_description_short: '',
                    product_keywords: '',
                },
                productApp: {
                    product_description_app: '',
                    product_description_bengali_app: '',
                },
                productImages: {
                    product_img_main: '',
                    product_img_2: '',
                    product_img_3: '',
                    product_img_4: '',
                    product_img_5: '',
                },
                sizeAvailable: false,
                newSize: '',
                colorAvailable: false,
                newColor: '',
                selectedImages: [],
                customErrors: {
                    size: null,
                    color: null,
                    description: null,
                    categories: null,
                    guarantee: null
                },
                showAddImageButton: true,

                categories: [],
                brands: [],
            }
        },
        methods: {
            saveGeneralData() {
                let self = this;
                self.product.product_categories = [];
                self.selectedCategories.forEach(function(category) {
                    self.product.product_categories.push(category.category_id);
                });
                if(isNaN(this.productId)) {
                    axios.post('/bs-admin-api/products/add', this.product)
                        .then((response) => {
                            this.showToastMsg('Product successfully added..!!', 'success', 3000);
                            this.productId = response.data.product_id;
                        })
                        .catch((error) => {
                            this.handleServerErrors(error);
                        });
                }
                else {
                    axios.patch('/bs-admin-api/products/update-general/' + this.productId, this.product)
                        .then((response) => {
                            this.showToastMsg('Product Data successfully updated..!!', 'success', 3000);
                        })
                        .catch((error) => {
                            console.log(error.response);
                            this.handleServerErrors(error);
                        });
                }
            },
            saveOptionsData() {
                if(!this.sizeAvailable || this.productOptions.product_available_sizes.length < 1) {
                    this.productOptions.product_available_sizes = null;
                }
                if(!this.colorAvailable || this.productOptions.product_available_colors.length < 1) {
                    this.productOptions.product_available_colors = null;
                }

                if(this.productOptions.product_discounted && this.productOptions.product_discount_amount <= 0 && this.productOptions.product_discount_percentage <= 0) {
                    this.showToastMsg('Discount amount or percentage is required!');
                }
                else {
                    if(this.productOptions.product_discounted) {
                        if(this.productOptions.product_discount_percentage > 0) {
                            this.productOptions.product_discount_amount = null;
                        }
                        else if(this.productOptions.product_discount_amount > 0) {
                            this.productOptions.product_discount_percentage = null;
                        }
                    }
                    else {
                        this.productOptions.product_discount_percentage = this.productOptions.product_discount_amount = null;
                    }

                    axios.patch('/bs-admin-api/products/update-options/' + this.productId, this.productOptions)
                        .then((response) => {
                            this.showToastMsg('Product Options successfully saved..!!', 'success', 3000);
                        })
                        .catch((error) => {
                            this.handleServerErrors(error);
                        });
                }
            },
            saveMetaData() {
                axios.patch('/bs-admin-api/products/update-meta/' + this.productId, this.productMeta)
                    .then((response) => {
                        this.showToastMsg('Product Meta Data successfully saved..!!', 'success', 3000);
                    })
                    .catch((error) => {
                        this.handleServerErrors(error);
                    });
            },
            saveAppData() {
                axios.patch('/bs-admin-api/products/update-app-data/' + this.productId, this.productApp)
                    .then((response) => {
                        this.showToastMsg('Product App Data successfully saved..!!', 'success', 3000);
                    })
                    .catch((error) => {
                        this.handleServerErrors(error);
                    });
            },
            saveVendorData() {
                axios.patch('/bs-admin-api/products/update-vendor/' + this.productId, this.productVendor)
                    .then((response) => {
                        this.showToastMsg('Product Vendor Data successfully saved..!!', 'success', 3000);
                    })
                    .catch((error) => {
                        this.handleServerErrors(error);
                    });
            },
            saveImageData() {
                axios.patch('/bs-admin-api/products/update-images/' + this.productId, this.productImages)
                    .then((response) => {
                        this.showToastMsg('Product Images successfully saved..!!', 'success', 3000);
                    })
                    .catch((error) => {
                        this.handleServerErrors(error);
                    });
            },
            getCategories() {
                axios.get('/bs-admin-api/categories/all')
                    .then((response) => {
                        this.categories = response.data;
                    })
                    .catch((error) => {
                        this.showToastMsg('Something went wrong! Please try again later..!', 'error', 6000);
                    });
            },
            getBrands() {
                axios.get('/bs-admin-api/product-brands/brand-selector-data')
                    .then((response) => {
                        this.brands = response.data;
                    })
                    .catch((error) => {
                        this.showToastMsg('Something went wrong! Please try again later..!', 'error', 6000);
                    });
            },
            brandAdded(brand) {
                let self = this;
                let newBrand = {
                    pb_id: brand.pb_id,
                    pb_name: brand.pb_name
                };
                self.brands.push(newBrand);
                self.productVendor.product_vendor = brand.pb_id;
            },
            getProduct() {
                axios.get('/bs-admin-api/products/' + this.product_id)
                    .then((response) => {
                        this.product = response.data.general;
                        this.productOptions = response.data.options;
                        this.productMeta = response.data.meta;
                        this.productApp = response.data.app;
                        this.productVendor = response.data.vendor;
                        this.productImages = response.data.images;
                        this.selectedCategories = response.data.categories;

                        if(this.productOptions.product_available_sizes !== null) {
                            this.sizeAvailable = true;
                        }
                        else {
                            this.productOptions.product_available_sizes = [];
                        }
                        if(this.productOptions.product_available_colors !== null) {
                            this.colorAvailable = true;
                        }
                        else {
                            this.productOptions.product_available_colors = [];
                        }

                        let self = this;

                        let serverImages = this.productImages;
                        for(let image in serverImages) {
                            if(serverImages.hasOwnProperty(image) && serverImages[image] !== null && serverImages[image].length > 0) {
                                let item = {
                                    original: serverImages[image],
                                    cache: '/uploads/public/cache/large/' + serverImages[image]
                                };
                                self.selectedImages.push(item);
                            }
                        }
                    })
                    .catch((error) => {
                        this.showToastMsg(error.response.data, 'error', 5000);
                    });
            },
            addSize() {
                if(this.newSize.length > 0) {
                    this.productOptions.product_available_sizes.push(this.newSize);
                    this.newSize = '';
                    this.showToastMsg('Size Added..!', 'success', 2000);
                }
            },
            removeSize(index) {
                if(index > -1) {
                    this.productOptions.product_available_sizes.splice(index, 1);
                }
                this.showToastMsg('Size Removed..!', 'success', 2000);
            },
            addColor() {
                if(this.newColor.length > 0) {
                    this.productOptions.product_available_colors.push(this.newColor);
                    this.newColor = '';
                    this.showToastMsg('Color Added..!', 'success', 2000);
                }
            },
            removeColor(index) {
                if(index > -1) {
                    this.productOptions.product_available_colors.splice(index, 1);
                }
                this.showToastMsg('Color Removed..!', 'success', 2000);
            },
            addCategory(category) {
                let self = this;
                let exists = false;
                if(self.selectedCategories.length > 0) {
                    self.selectedCategories.forEach(function(item) {
                        if(item.category_id === category.category_id) {
                            self.showToastMsg('Already exists..!!', 'error', 3500);
                            exists = true;
                        }
                    });
                }
                if(!exists) {
                    self.selectedCategories.push(category);
                    self.showToastMsg('Category added!!', 'success', 3000);
                }
                self.categoryFilterText = '';
            },
            removeCategory(index) {
                if(index > -1) {
                    this.selectedCategories.splice(index, 1);
                }
                this.showToastMsg('Category Removed..!', 'success', 2000);
            },
            imageAdded(image) {
                let self = this;
                let exists = false;
                self.selectedImages.forEach((item) => {
                    if(item.original === image.original) {
                        exists = true;
                    }
                });
                if(exists) {
                    self.showToastMsg('Oops..! This image is already exists.!', 'error', 6000);
                }
                else {
                    self.selectedImages.push(image);
                    if(self.selectedImages.length === 1) {
                        self.productImages.product_img_main = image.original;
                    }
                    if(self.selectedImages.length === 5) {
                        self.showAddImageButton = false;
                    }
                    self.updateImgData();
                }

            },
            changeMainImg(image) {
                this.productImages.product_img_main = image;
                this.updateImgData();
            },
            removeImg(index, image) {
                if(index > -1) {
                    this.selectedImages.splice(index, 1);
                }
                if(this.productImages.product_img_main === image) {
                    if(this.selectedImages.length < 1) {
                        this.productImages.product_img_main = '';
                    }
                    else {
                        this.productImages.product_img_main = this.selectedImages[0].original;
                    }
                }
                this.updateImgData();
                this.showToastMsg('Image removed.!', 'success', 2500);
                if(this.selectedImages.length < 5) {
                    this.showAddImageButton = true;
                }
            },
            updateImgData() {
                let self = this;
                let count = 2;
                self.productImages.product_img_2 = self.productImages.product_img_3 = self.productImages.product_img_4 = self.productImages.product_img_5 = '';
                if(self.selectedImages.length > 1) {
                    self.selectedImages.forEach((image) => {
                        if(image.original !== self.productImages.product_img_main) {
                            let img_property = 'product_img_' + count;
                            self.productImages[img_property] = image.original;
                            count++;
                        }
                    });
                }
            },
            showToastMsg(msg, method = 'show', duration = 2500) {
                this.$toasted[method](msg, {
                    action : {
                        text : '',
                        icon: 'times',
                        onClick : (e, toastObject) => {
                            toastObject.goAway(0);
                        }
                    },
                    duration: duration
                });
            },
            handleServerErrors(error) {
                let self = this;
                if(error.response.data.hasOwnProperty('error')) {
                    this.showToastMsg(error.response.data.error, 'error', 5000);
                }
                else if(error.response.data.hasOwnProperty('errors')) {
                    let serverErrors = error.response.data.errors;
                    for(let err in serverErrors) {
                        if(serverErrors.hasOwnProperty(err)) {
                            self.showToastMsg(serverErrors[err], 'error', 5000);
                        }
                    }
                }
            }
        },
        created() {
            this.getCategories();
            this.getBrands();
            if(this.product_id !== undefined && !isNaN(this.product_id)) {
                this.getProduct();
            }
            this.productId = this.product_id;
        },
        watch: {
            'product.product_description': function(val) {
                if(val === null || val === '') {
                    this.customErrors.description = 'Product description is required..!';
                }
                else if(val.length < 100) {
                    this.customErrors.description = 'Product description must contain at least 100 characters..!';
                }
                else if(val.length > 1024) {
                    this.customErrors.description = 'Product description is too long..!';
                }
                else {
                    this.customErrors.description = null;
                }
            },
            'product.product_units_in_stock' : function (val) {
                this.product.product_availability_status = (val && val > 0) ? 'In Stock' : '';
            },
            'productOptions.product_available_sizes': function(val) {
                if(this.sizeAvailable && val.length < 1) {
                    this.customErrors.size = 'Product Size is required..!';
                }
                else {
                    this.customErrors.size = null;
                }
            },
            'sizeAvailable': function(val) {
                if(val && this.productOptions.product_available_sizes.length < 1) {
                    this.customErrors.size = 'Product Size is required..!';
                }
                else {
                    this.customErrors.size = null;
                }
            },
            'productOptions.product_available_colors': function(val) {
                if(this.colorAvailable && val.length < 1) {
                    this.customErrors.color = 'Product Color is required..!';
                }
                else {
                    this.customErrors.color = null;
                }
            },
            'colorAvailable': function(val) {
                if(val && this.productOptions.product_available_colors.length < 1) {
                    this.customErrors.color = 'Product Color is required..!';
                }
                else {
                    this.customErrors.color = null;
                }
            },
            'selectedCategories': function(val) {
                if(val.length <= 0) {
                    this.customErrors.categories = 'Categories must be selected..!';
                }
                else {
                    this.customErrors.categories = null;
                }
            },
            'product.product_guarantee_time': function(val) {
                if(this.product.product_guarantee_status === 'Not Applicable' || this.product.product_guarantee_status === '') {
                    if(val !== null && val.length > 0) {
                        this.customErrors.guarantee = 'Guarantee or Warranty Time can\'t be applied while status is blank or Not Applicable!';
                    }
                    else {
                        this.customErrors.guarantee = null;
                    }
                }
                else if(this.product.product_guarantee_status === 'Money Back Guarantee') {
                    this.customErrors.guarantee = null;
                }
                else {
                    if(val === null || val.length <= 0) {
                        this.customErrors.guarantee = 'Guarantee or Warranty Time is required!';
                    }
                    else {
                        this.customErrors.guarantee = null;
                    }
                }
            },
            'product.product_guarantee_status': function(val) {
                if(val === 'Not Applicable' || val === '') {
                    this.product.product_guarantee_time = '';
                    this.customErrors.guarantee = null;
                }
                else if(val === 'Money Back Guarantee') {
                    this.customErrors.guarantee = null;
                }
                else if(val.length > 0) {
                    if(this.product.product_guarantee_time.length === null || this.product.product_guarantee_time.length <= 0) {
                        this.customErrors.guarantee = 'Guarantee or Warranty Time is required!';
                    }
                    else {
                        this.customErrors.guarantee = null;
                    }
                }
            },
        },
        computed: {
            showOptionsSaveBtn() {
                if(this.sizeAvailable && this.productOptions.product_available_sizes.length < 1) {
                    return false;
                }
                if(this.colorAvailable && this.productOptions.product_available_colors.length < 1) {
                    return false;
                }
                if(this.productOptions.product_discounted && this.productOptions.product_discount_amount <= 0 && this.productOptions.product_discount_percentage <= 0) {
                    return false;
                }
                return !(this.productId === undefined || this.productId === null || this.productId <= 0);

            },
            showMetaSaveBtn() {
                return !(this.productId === undefined || this.productId === null || this.productId <= 0);
            },
            showAppSaveBtn() {
                return !(this.productId === undefined || this.productId === null || this.productId <= 0);
            },
            showVendorSaveBtn() {
                return !(this.productId === undefined || this.productId === null || this.productId <= 0);
            },
            showImageSaveBtn() {
                return !(this.productId === undefined || this.productId === null || this.productId <= 0);
            },
            filteredCategories() {
                let self = this;
                return self.categories.filter((category) => {
                    return category.category_title.toLowerCase().indexOf(self.categoryFilterText.toLowerCase()) > -1;
                });
            }
        }
    }
</script>
