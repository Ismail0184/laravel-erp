@extends('layouts.app')

@section('title')
    @php($title = 'Department')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('area_id')) Update @else Create @endif {{$title}} <small class="text-danger float-right"> field marked with * are mandatory</small></h4>
                <form method="POST" action="@if(request('id')>0) {{route('hrm.setup.department.update', ['id'=>$department->id])}} @else {{route('hrm.setup.department.store')}} @endif">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Serial</label>
                        <div class="col-sm-9">
                            <input type="text" name="serial" @if(request('id')>0) value="{{$department->serial}}" @endif class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Department Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="department_name" @if(request('id')>0) value="{{$department->department_name}}" @endif class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Department Short Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="department_short_name" @if(request('id')>0) value="{{$department->department_short_name}}" @endif class="form-control" required>
                        </div>
                    </div>
                    @if(request('id')>0)
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($department->status =='active') selected @endif value="active">Active</option>
                                    <option @if($department->status =='inactive') selected @endif value="inactive">Inactive</option>
                                    <option @if($department->status =='suspended') selected @endif value="suspended">Suspended</option>
                                    <option @if($department->status =='deleted') selected @endif value="deleted">Deleted</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('hrm.setup.department.view')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('id')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
