@extends('layouts.app')

@section('title')
    @php($title='Product Group') {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('group_id')) Update @else Create @endif {{$title}}</h4>
                <form method="POST" action="@if(request('group_id')>0) {{route('acc.product.group.update', ['group_id'=>$group->group_id])}} @else {{route('acc.product.group.store')}} @endif">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Group Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="group_name" @if(request('group_id')>0) value="{{$group->group_name}}" @endif class="form-control" required>
                        </div>
                    </div>
                    @if(request('group_id')>0)
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($group->status =='active') selected @endif value="active">Active</option>
                                    <option @if($group->status =='inactive') selected @endif value="inactive">Inactive</option>
                                    <option @if($group->status =='suspended') selected @endif value="suspended">Suspended</option>
                                    <option @if($group->status =='deleted') selected @endif value="deleted">Deleted</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('acc.product.group.view')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('group_id')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
