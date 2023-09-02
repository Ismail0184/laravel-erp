@extends('layouts.app')

@section('title')
    @php($title = 'leaveType')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('id')) Update @else Create @endif {{$title}} <small class="text-danger float-right"> field marked with * are mandatory</small></h4>
                <form method="POST" action="@if(request('id')>0) {{route('hrm.setup.leaveType.update', ['id'=>$leaveType->id])}} @else {{route('hrm.setup.leaveType.store')}} @endif">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">leave Type Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="leave_type_name" @if(request('id')>0) value="{{$leaveType->leave_type_name}}" @endif class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Yearly Leave Days <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="number" name="yearly_leave_days" @if(request('id')>0) value="{{$leaveType->yearly_leave_days}}" @endif class="form-control" required>
                        </div>
                    </div>
                    @if(request('id')>0)
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($leaveType->status =='active') selected @endif value="active">Active</option>
                                    <option @if($leaveType->status =='inactive') selected @endif value="inactive">Inactive</option>
                                    <option @if($leaveType->status =='suspended') selected @endif value="suspended">Suspended</option>
                                    <option @if($leaveType->status =='deleted') selected @endif value="deleted">Deleted</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('hrm.setup.leaveType.view')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('id')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
