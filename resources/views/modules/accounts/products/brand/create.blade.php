@extends('layouts.app')

@section('title')
    @php($title='Product Brand') {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('brand_id')) Update @else Create @endif {{$title}}</h4>
                <form method="POST" action="@if(request('brand_id')>0) {{route('acc.product.brand.update', ['brand_id'=>$brand->brand_id])}} @else {{route('acc.product.brand.store')}} @endif">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Company<span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="vendor_id" required>
                                <option> -- select a choose -- </option>
                                <option>1</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Brand Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="brand_name" @if(request('brand_id')>0) value="{{$brand->brand_name}}" @endif class="form-control" required>
                        </div>
                    </div>
                    @if(request('brand_id')>0)
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($brand->status =='active') selected @endif value="active">Active</option>
                                    <option @if($brand->status =='inactive') selected @endif value="inactive">Inactive</option>
                                    <option @if($brand->status =='suspended') selected @endif value="suspended">Suspended</option>
                                    <option @if($brand->status =='deleted') selected @endif value="deleted">Deleted</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('acc.product.group.view')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('brand_id')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
