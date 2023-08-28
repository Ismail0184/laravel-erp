@extends('layouts.app')

@section('title')
    @php($title = 'Trade Scheme')
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
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Trade Scheme Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="dealer_custom_id" @if(request('dealer_id')>0) value="{{$dealer->dealer_custom_id}}" @endif class="form-control"  />
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Offer for Customer Type <span class="required text-danger">*</span></label>
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
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Scheme Duration <span class="required text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="date" name="contact_person_designation" @if(request('dealer_id')>0) value="{{$dealer->contact_person_designation}}" @endif class="form-control" />
                        </div>
                        <div class="col-sm-3">
                            <input type="date" name="contact_person_designation" @if(request('dealer_id')>0) value="{{$dealer->contact_person_designation}}" @endif class="form-control" />
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Buy Item Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="type_id" required="required">
                                <option value="">-- select buy item --</option>
                                @foreach($types as $type)
                                    <option value="{{$type->type_id}}" @if(request('dealer_id')>0) @if($dealer->type_id==$type->type_id) selected @endif @endif>{{$type->type_id}} : {{$type->type_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Buy Qty <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="dealer_custom_id" @if(request('dealer_id')>0) value="{{$dealer->dealer_custom_id}}" @endif class="form-control"  />
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Get Item Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="type_id" required="required">
                                <option value="">-- select get item --</option>
                                @foreach($types as $type)
                                    <option value="{{$type->type_id}}" @if(request('dealer_id')>0) @if($dealer->type_id==$type->type_id) selected @endif @endif>{{$type->type_id}} : {{$type->type_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Get Qty / Cash amount <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="dealer_custom_id" @if(request('dealer_id')>0) value="{{$dealer->dealer_custom_id}}" @endif class="form-control"  />
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Gift Type <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="type_id" required="required">
                                <option value="">-- select get item --</option>
                                @foreach($types as $type)
                                    <option value="{{$type->type_id}}" @if(request('dealer_id')>0) @if($dealer->type_id==$type->type_id) selected @endif @endif>{{$type->type_id}} : {{$type->type_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Calculation Mode <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="type_id" required="required">
                                <option value="">-- select get item --</option>
                                @foreach($types as $type)
                                    <option value="{{$type->type_id}}" @if(request('dealer_id')>0) @if($dealer->type_id==$type->type_id) selected @endif @endif>{{$type->type_id}} : {{$type->type_name}}</option>
                                @endforeach
                            </select>
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
