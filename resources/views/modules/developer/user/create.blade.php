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
                <form method="POST" action="@if(request('id')>0) {{route('dev.user.createUser.update', ['id'=>$user->id])}} @else {{route('dev.user.createErpUser.store')}} @endif" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                    @if(request('id')>0)
                    <input type="hidden" name="type" value="{{$user->type}}">
                    @endif
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Company<span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="cid" required="required">
                                <option value=""> -- Select Company -- </option>
                                @foreach($companies as $company)
                                    <option value="{{$company->id}}" @if(request('id')>0) @if($company->id==$user->cid) selected @endif @endif>{{$company->id}} : {{$company->company_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="name" @if(request('id')>0) value="{{$user->name}}" @endif class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Email <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="email" @if(request('id')>0) value="{{$user->email ?? ''}}" @endif class="form-control">
                        </div>
                    </div>

                    @if(!request('id')>0)
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
                    @endif

                    @if(request('id')>0)
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($user->status =='active') selected @endif value="active">Active</option>
                                    <option @if($user->status =='inactive') selected @endif value="inactive">Inactive</option>
                                    <option @if($user->status =='suspended') selected @endif value="suspended">Suspended</option>
                                    <option @if($user->status =='deleted') selected @endif value="deleted">Deleted</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('dev.user.erpUser.view')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('id')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
