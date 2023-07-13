@extends('layouts.app')

@section('title')
    @php($title='Product') {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('item_id')) Update @else Create @endif {{$title}} <small class="text-danger float-right">(field marked with * are mandatory)
                    </small></h4>
                <form method="POST" action="@if(request('item_id')>0) {{route('acc.product.sub-group.update', ['item_id'=>$item->item_id])}} @else {{route('acc.product.sub-group.store')}} @endif">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                    <div class="form-group row mb-3">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Sub-Group Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="sub_group_id" required>
                                <option value=""> -- select a choose -- </option>
                                @foreach($subGroups as $item)
                                    <option value="{{$item->item_id}}" @if(request('item_id')>0) @if($item->sub_group_id==$group->group_id) selected @endif @endif>{{$item->sub_group_id}} : {{$item->sub_group_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Consumable Type <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="consumable_type" required>
                                <option value="">-- select a choose --</option>
                                <option @if($item->consumable_type =='Consumable') selected @endif value="Consumable">Consumable</option>
                                <option @if($item->consumable_type =='Non-Consumable') selected @endif value="Non-Consumable">Non-Consumable</option>
                                <option @if($item->consumable_type =='Service') selected @endif value="Service">Service</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Product Nature <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="product_nature" required>
                                <option value="">-- select a choose --</option>
                                <option @if($item->product_nature =='Salable') selected @endif value="Salable">Salable</option>
                                <option @if($item->product_nature =='Purchasable') selected @endif value="Purchasable">Purchasable</option>
                                <option @if($item->product_nature =='Both') selected @endif value="Both">Both</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Brand <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="brand_id" required>
                                <option value=""> -- select a choose -- </option>
                                @foreach($brands as $brand)
                                    <option value="{{$brand->brand_id}}" @if(request('item_id')>0) @if($brand->brand_id==$item->brand_id) selected @endif @endif>{{$brand->brand_id}} : {{$brand->brand_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Custom Code</label>
                        <div class="col-sm-9">
                            <input type="text" name="custom_id" @if(request('item_id')>0) value="{{$item->custom_id}}" @endif class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Item Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="item_name" @if(request('item_id')>0) value="{{$item->item_name}}" @endif class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Item Description</label>
                        <div class="col-sm-9">
                            <textarea name="item_description" class="form-control">{{$item->item_description}}</textarea>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Unit <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="unit" required>
                                <option value=""> -- select a choose -- </option>
                                @foreach($units as $unit)
                                    <option value="{{$unit->unit_id}}" @if(request('item_id')>0) @if($unit->unit_id==$item->unit) selected @endif @endif>{{$unit->unit_id}} : {{$unit->unit_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Pack Size <span class="required text-danger">*</span> </label>
                        <div class="col-sm-9">
                            <input type="number" name="pack_size" class="form-control" @if(request('item_id')>0) value="{{$item->pack_size}}" @endif required />
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Gross Weight</label>
                        <div class="col-sm-9">
                            <input type="number" name="g_weight" class="form-control" @if(request('item_id')>0) value="{{$item->g_weight}}" @endif />
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Shelf Life</label>
                        <div class="col-sm-9">
                            <input type="number" name="shelf_life" class="form-control" @if(request('item_id')>0) value="{{$item->shelf_life}}" @endif />
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Cost</label>
                        <div class="col-sm-3">
                            <input type="number" name="material_cost" class="form-control" @if(request('item_id')>0) value="{{$item->shelf_life}}" @endif placeholder="material cost" />
                        </div>
                        <div class="col-sm-3">
                            <input type="number" name="conversion_cost" class="form-control" @if(request('item_id')>0) value="{{$item->shelf_life}}" @endif placeholder="conversion cost" />
                        </div>
                        <div class="col-sm-3">
                            <input type="number" name="production_cost" class="form-control" @if(request('item_id')>0) value="{{$item->shelf_life}}" @endif placeholder="production cost" />
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Price Level <span class="required text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="number" name="d_price" class="form-control" @if(request('item_id')>0) value="{{$item->d_price}}" @endif placeholder="Dealer Price" title="DP" />
                        </div>
                        <div class="col-sm-3">
                            <input type="number" name="t_price" class="form-control" @if(request('item_id')>0) value="{{$item->t_price}}" @endif placeholder="Trade Price" title="TP" />
                        </div>
                        <div class="col-sm-3">
                            <input type="number" name="m_price" class="form-control" @if(request('item_id')>0) value="{{$item->m_price}}" @endif placeholder="MRP" title="MRP" />
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Supplementary Duty (SD) <span class="required text-danger">*</span></label>
                        <div class="col-sm-5">
                            <input type="number" name="SD_percentage" class="form-control" @if(request('item_id')>0) value="{{$item->SD_percentage}}" @endif placeholder="Percentage" title="Percentage" />
                        </div>
                        <div class="col-sm-4">
                            <input type="number" name="SD" class="form-control" @if(request('item_id')>0) value="{{$item->SD}}" @endif placeholder="SD Price" title="SD Price" />
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Value-added tax (VAT) <span class="required text-danger">*</span></label>
                        <div class="col-sm-5">
                            <input type="number" name="VAT_percentage" class="form-control" @if(request('item_id')>0) value="{{$item->VAT_percentage}}" @endif placeholder="Percentage" title="Percentage" />
                        </div>
                        <div class="col-sm-4">
                            <input type="number" name="VAT" class="form-control" @if(request('item_id')>0) value="{{$item->VAT}}" @endif placeholder="VAT Price" title="VAT Price" />
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">H.S Code <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="H_S_code" required>
                                <option value=""> -- select a choose -- </option>
                                @foreach($units as $unit)
                                    <option value="{{$unit->unit_id}}" @if(request('item_id')>0) @if($unit->unit_id==$item->unit) selected @endif @endif>{{$unit->unit_id}} : {{$unit->unit_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if(request('item_id')>0)
                        <div class="form-group row mb-3">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($item->status =='active') selected @endif value="active">Active</option>
                                    <option @if($item->status =='inactive') selected @endif value="inactive">Inactive</option>
                                    <option @if($item->status =='suspended') selected @endif value="suspended">Suspended</option>
                                    <option @if($item->status =='deleted') selected @endif value="deleted">Deleted</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('acc.product.item.view')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('item_id')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
