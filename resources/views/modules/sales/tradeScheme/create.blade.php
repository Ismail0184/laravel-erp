@extends('layouts.app')

@section('title')
    @php($title = 'Dealer')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('dealer_id')) Update @else Create @endif {{$title}}  <small class="text-danger float-right"> field marked with * are mandatory</small></h4>
                <form method="POST" action="@if(request('dealer_id')>0) {{route('sales.dealer.update', ['dealer_id'=>$dealer->dealer_id])}} @else {{route('sales.dealer.store')}} @endif">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Territory <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="territory_id" required="required">
                                <option value="">-- select territory --</option>
                                @foreach($territories as $territory)
                                    <option value="{{$territory->territory_id}}" @if(request('dealer_id')>0) @if($dealer->territory_id==$territory->territory_id) selected @endif @endif>{{$territory->territory_id}} : {{$territory->territory_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Town <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="town_id" required="required">
                                <option value="">-- select town --</option>
                                @foreach($towns as $town)
                                    <option value="{{$town->town_id}}" @if(request('dealer_id')>0) @if($dealer->town_id==$town->town_id) selected @endif @endif>{{$town->town_id}} : {{$town->town_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Category <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="category_id" required="required">
                                <option value="">-- select category --</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->cat_id}}" @if(request('dealer_id')>0) @if($dealer->category_id==$category->cat_id) selected @endif @endif>{{$category->cat_id}} : {{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Type <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="type_id" required="required">
                                <option value="">-- select type --</option>
                                @foreach($types as $type)
                                    <option value="{{$type->type_id}}" @if(request('dealer_id')>0) @if($dealer->type_id==$type->type_id) selected @endif @endif>{{$type->type_id}} : {{$type->type_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Serial Number</label>
                        <div class="col-sm-9">
                            <input type="text" name="serial" @if(request('dealer_id')>0) value="{{$dealer->serial}}" @endif class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Dealer Custom Code</label>
                        <div class="col-sm-9">
                            <input type="text" name="dealer_custom_id" @if(request('dealer_id')>0) value="{{$dealer->dealer_custom_id}}" @endif class="form-control"  />
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Dealer Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="dealer_name" @if(request('dealer_id')>0) value="{{$dealer->dealer_name}}" @endif class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Proprietor Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="proprietor_name" @if(request('dealer_id')>0) value="{{$dealer->proprietor_name}}" @endif class="form-control"  />
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Mobile</label>
                        <div class="col-sm-9">
                            <input type="text" name="mobile" @if(request('dealer_id')>0) value="{{$dealer->mobile}}" @endif class="form-control"  />
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" name="email" @if(request('dealer_id')>0) value="{{$dealer->email}}" @endif class="form-control"  />
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Contact Person</label>
                        <div class="col-sm-9">
                            <input type="text" name="contact_person" @if(request('dealer_id')>0) value="{{$dealer->contact_person}}" @endif class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Contact Person Designation</label>
                        <div class="col-sm-9">
                            <input type="text" name="contact_person_designation" @if(request('dealer_id')>0) value="{{$dealer->contact_person_designation}}" @endif class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Contact Person Mobile</label>
                        <div class="col-sm-9">
                            <input type="text" name="contact_person_mobile" @if(request('dealer_id')>0) value="{{$dealer->contact_person_mobile}}" @endif class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Address</label>
                        <div class="col-sm-9">
                            <textarea name="address"  class="form-control" >@if(request('dealer_id')>0) {{$dealer->address}} @endif</textarea>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">National ID</label>
                        <div class="col-sm-9">
                            <input type="text" name="nid" @if(request('dealer_id')>0) value="{{$dealer->nid}}" @endif class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Passport</label>
                        <div class="col-sm-9">
                            <input type="text" name="passport" @if(request('dealer_id')>0) value="{{$dealer->passport}}" @endif class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">TIN</label>
                        <div class="col-sm-9">
                            <input type="text" name="TIN" @if(request('dealer_id')>0) value="{{$dealer->TIN}}" @endif class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">BIN</label>
                        <div class="col-sm-9">
                            <input type="text" name="BIN" @if(request('dealer_id')>0) value="{{$dealer->BIN}}" @endif class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Ledger ID <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="ledger_id" @if(request('dealer_id')>0) value="{{$dealer->ledger_id}}" required @endif class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Commission</label>
                        <div class="col-sm-9">
                            <input type="text" name="commission" @if(request('dealer_id')>0) value="{{$dealer->commission}}" @endif class="form-control" />
                        </div>
                    </div>
                    @if(request('dealer_id')>0)
                        <div class="form-group row mb-2">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($dealer->status =='active') selected @endif value="active">Active</option>
                                    <option @if($dealer->status =='inactive') selected @endif value="inactive">Inactive</option>
                                    <option @if($dealer->status =='suspended') selected @endif value="suspended">Suspended</option>
                                    <option @if($dealer->status =='deleted') selected @endif value="deleted">Deleted</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('sales.dealer.view')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('dealer_id')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
