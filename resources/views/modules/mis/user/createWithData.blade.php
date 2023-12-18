@extends('layouts.app')

@section('title')
    @php($title = 'User')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Create {{$title}} <small class="text-danger float-right"> field marked with * are mandatory</small></h4>
                <form method="POST" action="{{ route('mis.user.createUser.storeWithData') }}">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Employee Code <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="hidden" name="profile_photo_path" readonly @if(request('id')>0) value="{{$employee->image}}" @endif class="form-control" required>
                            <input type="hidden" name="id" readonly @if(request('id')>0) value="{{$employee->id}}" @endif class="form-control" required>
                            <input type="text" @if (!empty($employee->code)) readonly @endif @if(request('id')>0) value="{{$employee->code}}" @endif class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Full Name (as per NID) <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="name" @if (!empty($employee->full_name)) readonly @endif @if(request('id')>0) value="{{$employee->full_name}}" @endif class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Corporate Email <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="email" @if (!empty($employee->jobInfoTable->corporate_email)) readonly @endif @if(request('id')>0) value="{{$employee->jobInfoTable->corporate_email ?? ''}}" @endif class="form-control">
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Password <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="password" required @if(request('id')>0) value="" @endif class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">{{ __('Confirm Password') }} <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="password_confirmation" required @if(request('id')>0) value="" @endif class="form-control">
                        </div>
                    </div>

                    @if(request('id')>0)
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($employee->status =='active') selected @endif value="active">Active</option>
                                    <option @if($employee->status =='inactive') selected @endif value="inactive">Inactive</option>
                                    <option @if($employee->status =='suspended') selected @endif value="suspended">Suspended</option>
                                    <option @if($employee->status =='deleted') selected @endif value="deleted">Deleted</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('mis.user.createUser')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">Create</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
