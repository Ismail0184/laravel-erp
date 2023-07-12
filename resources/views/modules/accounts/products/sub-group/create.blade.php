@extends('layouts.app')

@section('title')
    @php($title='Product Sub-Group') {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('sub_group_id')) Update @else Create @endif {{$title}}</h4>
                <form method="POST" action="@if(request('sub_group_id')>0) {{route('acc.product.sub-group.update', ['sub_group_id'=>$subGroup->sub_group_id])}} @else {{route('acc.product.sub-group.store')}} @endif">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Group Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="group_id" required>
                                <option> -- select a group -- </option>
                                @foreach($groups as $group)
                                    <option value="{{$group->group_id}}" @if(request('sub_group_id')>0) @if($subGroup->group_id==$group->group_id) selected @endif @endif>{{$group->group_id}} : {{$group->group_name}}</option>
                                @endforeach
                            </select>                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Sub-Group Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="sub_group_name" @if(request('sub_group_id')>0) value="{{$subGroup->sub_group_name}}" @endif class="form-control" required>
                        </div>
                    </div>
                    @if(request('sub_group_id')>0)
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($subGroup->status =='active') selected @endif value="active">Active</option>
                                    <option @if($subGroup->status =='inactive') selected @endif value="inactive">Inactive</option>
                                    <option @if($subGroup->status =='suspended') selected @endif value="suspended">Suspended</option>
                                    <option @if($subGroup->status =='deleted') selected @endif value="deleted">Deleted</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('acc.product.sub-group.view')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('sub_group_id')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
