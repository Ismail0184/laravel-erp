@extends('layouts.app')

@section('title')
    @php($title = 'Vendor') {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('id')) Update @else Create @endif {{$title}}</h4>
                <form method="POST" action="@if(request('id')>0) {{route('pro.vendor.vendorinfo.update', ['id'=>$vendorinfo->vendor_id])}} @else {{route('pro.vendor.vendorinfo.store')}} @endif">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-2 col-form-label">Category <span class="required text-danger">*</span></label>
                        <div class="col-sm-6">
                            <select class="form-control select2" name="category" required="required">
                                <option value=""> -- select a Category -- </option>
                                @foreach($categorys as $category)
                                    <option value="{{$category->id}}" @if(request('id')>0) @if($vendorinfo->category==$category->id) selected @endif @endif>{{$category->id}} : {{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-2 col-form-label">Vendor Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" name="vendor_name" @if(request('id')>0) value="{{$vendorinfo->vendor_name}}" @endif class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-6">
                            <textarea  name="address" class="form-control">@if(request('id')>0) {{$vendorinfo->address}} @endif</textarea>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-2 col-form-label">Contact No <span class="required text-danger">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" name="contact_no" @if(request('id')>0) value="{{$vendorinfo->contact_no}}" @endif class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-2 col-form-label">Email <span class="required text-danger">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" name="email" @if(request('id')>0) value="{{$vendorinfo->email}}" @endif class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-2 col-form-label">POC Name</label>
                        <div class="col-sm-6">
                            <input type="text" name="poc_name" @if(request('id')>0) value="{{$vendorinfo->poc_name}}" @endif class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-2 col-form-label">POC Designation</label>
                        <div class="col-sm-6">
                            <input type="text" name="poc_designation" @if(request('id')>0) value="{{$vendorinfo->poc_designation}}" @endif class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-2 col-form-label">POC Mobile</label>
                        <div class="col-sm-6">
                            <input type="text" name="poc_mobile" @if(request('id')>0) value="{{$vendorinfo->poc_mobile}}" @endif class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-2 col-form-label">POC Email</label>
                        <div class="col-sm-6">
                            <input type="text" name="poc_email" @if(request('id')>0) value="{{$vendorinfo->poc_email}}" @endif class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-2 col-form-label">TIN</label>
                        <div class="col-sm-6">
                            <input type="text" name="TIN" @if(request('id')>0) value="{{$vendorinfo->TIN}}" @endif class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-2 col-form-label">BIN</label>
                        <div class="col-sm-6">
                            <input type="text" name="BIN" @if(request('id')>0) value="{{$vendorinfo->BIN}}" @endif class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-2 col-form-label">Ledger Id</label>
                        <div class="col-sm-6">
                            <input type="text" name="ledger_id" @if(request('id')>0) value="{{$vendorinfo->ledger_id}}" @endif class="form-control" required>
                        </div>
                    </div>
                    @if(request('id')>0)
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-2 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select class="form-control" name="status">
                                    <option @if($vendorinfo->status =='active') selected @endif value="active">Active</option>
                                    <option @if($vendorinfo->status =='inactive') selected @endif value="inactive">Inactive</option>
                                    <option @if($vendorinfo->status =='deleted') selected @endif value="deleted">Deleted</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('pro.vendor.vendorinfo.view')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('id')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
