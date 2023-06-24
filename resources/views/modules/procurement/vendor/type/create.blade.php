@extends('layouts.app')

@section('title')
    @php($title = 'Vendor Type') {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('id')) Update @else Create @endif {{$title}}</h4>
                <form method="POST" action="@if(request('id')>0) {{route('pro.vendor.type.update', ['id'=>$type->id])}} @else {{route('pro.vendor.type.store')}} @endif">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Type Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="vendor_type" @if(request('id')>0) value="{{$type->vendor_type}}" @endif class="form-control" required>
                        </div>
                    </div>
                    @if(request('id')>0)
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($type->status =='active') selected @endif value="active">Active</option>
                                    <option @if($type->status =='inactive') selected @endif value="inactive">Inactive</option>
                                    <option @if($type->status =='deleted') selected @endif value="deleted">Deleted</option>
                                    </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('pro.vendor.type.view')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('id')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
