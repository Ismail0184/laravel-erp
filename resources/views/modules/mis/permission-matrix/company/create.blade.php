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
                <form method="POST" action="{{route('mis.user.createUser.store')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="name" @if(request('id')>0) value="{{$employee->full_name}}" @endif class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Email <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="email" @if(request('id')>0) value="{{$employee->jobInfoTable->corporate_email ?? ''}}" @endif class="form-control">
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

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Profile Picture <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="file" name="image"  class="form-control" required>
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
                                <a class="btn btn-danger" href="{{route('mis.user.createUserManual')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">Create</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
