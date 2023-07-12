@extends('layouts.app')

@section('title')
    @php($title='Product Item') {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('item_id')) Update @else Create @endif {{$title}}</h4>
                <form method="POST" action="@if(request('item_id')>0) {{route('acc.product.sub-group.update', ['item_id'=>$item->item_id])}} @else {{route('acc.product.sub-group.store')}} @endif">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                    <div class="form-group row mb-3">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Sub-Group Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="group_id" required>
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
                            <select class="form-control" name="status">
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
                            <select class="form-control" name="product_nature">
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
                            <select class="form-control" name="group_id" required>
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
