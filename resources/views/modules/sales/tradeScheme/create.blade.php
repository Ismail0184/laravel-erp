@extends('layouts.app')

@section('title')
    @php($title = 'Trade Scheme')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('id')) Update @else Create @endif {{$title}}  <small class="text-danger float-right"> field marked with * are mandatory</small></h4>
                <form method="POST" action="@if(request('id')>0) {{route('sales.ts.update', ['id'=>$ts->id])}} @else {{route('sales.ts.store')}} @endif">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">

                    <div class="form-group row mb-2">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Trade Scheme Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="offer_name" @if(request('id')>0) value="{{$ts->offer_name}}" @endif class="form-control"  />
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Offer for Customer Type <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="dealer_type" required="required">
                                <option value="">-- select type --</option>
                                @foreach($types as $type)
                                    <option value="{{$type->type_id}}" @if(request('id')>0) @if($ts->dealer_type==$type->type_id) selected @endif @endif>{{$type->type_id}} : {{$type->type_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Scheme Duration <span class="required text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="date" name="start_date" @if(request('id')>0) value="{{$ts->start_date}}" @endif class="form-control" />
                        </div>
                        <div class="col-sm-3">
                            <input type="date" name="end_date" @if(request('id')>0) value="{{$ts->end_date}}" @endif class="form-control" />
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Buy Item Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="buy_item_id" required="required">
                                <option value="">-- select buy item --</option>
                                @foreach($items as $item)
                                    <option value="{{$item->item_id}}" @if(request('id')>0) @if($ts->buy_item_id==$item->item_id) selected @endif @endif>{{$item->item_id}} : {{$item->item_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Buy Qty <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="buy_item_qty" @if(request('id')>0) value="{{$ts->buy_item_qty}}" @endif class="form-control"  />
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Get Item Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="gift_item_id" required="required">
                                <option value="">-- select get item --</option>
                                @foreach($items as $item)
                                    <option value="{{$item->item_id}}" @if(request('id')>0) @if($ts->gift_item_id==$item->item_id) selected @endif @endif>{{$item->item_id}} : {{$item->item_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Get Qty / Cash amount <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="gift_item_qty" @if(request('id')>0) value="{{$ts->gift_item_qty}}" @endif class="form-control"  />
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Gift Type <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="gift_type" required="required">
                                <option value="">-- select type --</option>
                                <option value="cash"  @if(request('id')>0) @if($ts->gift_type=='cash') selected @endif @endif>Cash</option>
                                <option value="non-cash" @if(request('id')>0) @if($ts->gift_type=='non-cash') selected @endif @endif>Non-Cash</option>
                                <option value="free_own_products" @if(request('id')>0) @if($ts->gift_type=='free_own_products') selected @endif @endif>Free own Products</option>
                                <option value="free_other_SKU" @if(request('id')>0) @if($ts->gift_type=='free_other_SKU') selected @endif @endif>Free other SKU</option>
                                <option value="free_other_products" @if(request('id')>0) @if($ts->gift_type=='free_other_products') selected @endif @endif>Free other Products</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Calculation Mode <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="calculation_mode" required="required">
                                <option value="">-- select mode --</option>
                                <option value="auto" @if(request('id')>0) @if($ts->calculation_mode=='auto') selected @endif @endif>Auto</option>
                                <option value="manual" @if(request('id')>0) @if($ts->calculation_mode=='manual') selected @endif @endif>Manual</option>
                            </select>
                        </div>
                    </div>

                    @if(request('id')>0)
                        <div class="form-group row mb-2">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($ts->status =='active') selected @endif value="active">Active</option>
                                    <option @if($ts->status =='inactive') selected @endif value="inactive">Inactive</option>
                                    <option @if($ts->status =='suspended') selected @endif value="suspended">Suspended</option>
                                    <option @if($ts->status =='deleted') selected @endif value="deleted">Deleted</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('sales.ts.view')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('id')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
