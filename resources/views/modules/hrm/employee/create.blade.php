@extends('layouts.app')

@section('title')
    @php($title = 'Employee')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('id')) Update @else Create @endif {{$title}} <small class="text-danger float-right"> field marked with * are mandatory</small></h4>
                <form method="POST" action="@if(request('id')>0) {{route('hrm.employee.update', ['id'=>$grade->id])}} @else {{route('hrm.employee.store')}} @endif">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Employee Code <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="code" @if(request('id')>0) value="{{$grade->code}}" @endif class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Full Name (as per NID) <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="full_name" @if(request('id')>0) value="{{$grade->full_name}}" @endif class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Father's Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="father_name" @if(request('id')>0) value="{{$grade->father_name}}" @endif class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Mother's Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="mother_name" @if(request('id')>0) value="{{$grade->mother_name}}" @endif class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Spouse's Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="spouse_name" @if(request('id')>0) value="{{$grade->spouse_name}}" @endif class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Date of Birth <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="date" name="date_of_birth" @if(request('id')>0) value="{{$grade->date_of_birth}}" @endif class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Blood Group</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="sub_group_id">
                                <option value=""> -- select a blood group -- </option>
                                @foreach($bloods as $blood)
                                    <option value="{{$blood->id}}" @if(request('item_id')>0) @if($blood->id==$item->sub_group_id) selected @endif @endif>{{$blood->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if(request('id')>0)
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($grade->status =='active') selected @endif value="active">Active</option>
                                    <option @if($grade->status =='inactive') selected @endif value="inactive">Inactive</option>
                                    <option @if($grade->status =='suspended') selected @endif value="suspended">Suspended</option>
                                    <option @if($grade->status =='deleted') selected @endif value="deleted">Deleted</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('hrm.employee.view')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('id')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
