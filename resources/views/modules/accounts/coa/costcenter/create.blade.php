@extends('layouts.app')

@section('title')
    @php($title = 'Cost Center')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('cc_code')) Update @else Create @endif {{$title}}</h4>
                <form method="POST" action="@if(request('cc_code')>0) {{route('acc.cost-center.update', ['cc_code'=>$costcenter->cc_code])}} @else {{route('acc.cost-center.store')}} @endif">
                    @csrf
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Cost Category <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                            <select class="form-control select2" name="category_id" required="required">
                                <option value=""> -- Select Cost Category -- </option>
                                @foreach($costcategories as $costcategory)
                                    <option value="{{$costcategory->id}}" @if(request('cc_code')>0) @if($costcategory->id==$costcenter->category_id) selected @endif @endif>{{$costcategory->id}} : {{$costcategory->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Cost Center <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="center_name" @if(request('cc_code')>0) value="{{$costcenter->center_name}}" @endif class="form-control" required>
                        </div>
                    </div>
                    @if(request('cc_code')>0)
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($costcenter->status =='active') selected @endif value="active">Active</option>
                                    <option @if($costcenter->status =='inactive') selected @endif value="inactive">Inactive</option>
                                    <option @if($costcenter->status =='suspended') selected @endif value="suspended">Suspended</option>
                                    <option @if($costcenter->status =='deleted') selected @endif value="deleted">Deleted</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('acc.cost-center.view')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('cc_code')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
