@extends('layouts.admin')

@section('sub-title', 'Edit Delivery Method')
@section('page-description', 'Edit Delivery Method')

@section('shipping-active', 'active')
@section('shipping-new-active', 'active')


@section('admin-content')
    <div class="all-admins-container">

        @if(Session::has('status'))
            <div class="alert alert-info text-center" role="alert">
                {{ Session::get('status') }}
            </div>
        @endif

        <div class="card new-admin">
            <div class="card-header">
                <strong><i class="fa fa-truck"></i> Edit</strong> Delivery Method
            </div>
            <div class="card-body">
                <form action="{{ route('admin.shipping.edit', ['id' => $method->method_id]) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label for="method_name" class="col-md-3 col-form-label">Method Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control {{ $errors->has('method_name') ? 'is-invalid' : '' }}" value="{{ old('method_name', $method->method_name) }}"
                                   id="method_name" name="method_name" placeholder="Method Name" required autofocus>
                            @if ($errors->has('method_name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('method_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="method_charge" class="col-md-3 col-form-label">Charge</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="sbicon sbicon-bdt"> </i>
                                    </span>
                                </div>
                                <input type="text" class="form-control {{ $errors->has('method_charge') ? 'is-invalid' : '' }}" value="{{ old('method_charge', $method->method_charge) }}"
                                       id="method_charge" name="method_charge" placeholder="Charge"  >
                                @if ($errors->has('method_charge'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('method_charge') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="method_time" class="col-md-3 col-form-label">Estimated Time</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control {{ $errors->has('method_time') ? 'is-invalid' : '' }}" value="{{ old('method_time', $method->method_time) }}"
                                   id="method_time" name="method_time" placeholder="Estimated Time" required>
                            @if ($errors->has('method_time'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('method_time') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="method_note" class="col-md-3 col-form-label">Note</label>
                        <div class="col-md-9">
                            <textarea class="form-control {{ $errors->has('method_note') ? 'is-invalid' : '' }}" name="method_note" id="method_note" rows="4" style="resize: none;">{!! old('method_note', $method->method_note)  !!}</textarea>

                            @if ($errors->has('method_note'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('method_note') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="method_available_outside" class="col-md-3 col-form-label">Outside Dhaka</label>
                        <div class="col-md-9">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="method_available_outside" value="1" class="custom-control-input" @if($method->method_available_outside) checked @endif>
                                <label class="custom-control-label" for="customRadioInline1">Yes</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" name="method_available_outside" value="0" class="custom-control-input" @if(!$method->method_available_outside) checked @endif>
                                <label class="custom-control-label" for="customRadioInline2">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="method_active" class="col-md-3 col-form-label">Status</label>
                        <div class="col-md-9">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline3" name="method_active" value="1" class="custom-control-input" @if($method->method_active) checked @endif>
                                <label class="custom-control-label" for="customRadioInline3">Active</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline4" name="method_active" value="0" class="custom-control-input" @if(!$method->method_active) checked @endif>
                                <label class="custom-control-label" for="customRadioInline4">Inactive</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-9 offset-md-3">
                            <button class="btn btn-success" type="submit">Create Method</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection


@section('custom-script')



@endsection
