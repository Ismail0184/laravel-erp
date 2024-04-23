@extends('layouts.app')

@section('title')
    @php($title = 'Company') {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('id')) Update @else Create @endif {{$title}} <small class="text-danger float-right"> field marked with * are mandatory</small></h4>
                <form method="POST" action="@if(request('id')>0) {{route('dev.company.update', ['id'=>$company->id])}} @else {{route('dev.company.store')}} @endif" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                        <div class="form-group row mb-2">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Mother Company (Group) <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control select2" name="group_id" required="required">
                                    <option value=""> -- Select Group -- </option>
                                    @foreach($groups as $group)
                                        <option value="{{$group->group_id}}" @if(request('id')>0) @if($group->group_id==$company->group_id) selected @endif @endif>{{$group->group_id}} : {{$group->group_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Company ID <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="company_name" @if(request('id')>0) readonly value="{{$company->id}}" @endif class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Company Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="company_name" @if(request('id')>0) value="{{$company->company_name}}" @endif class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Address</label>
                        <div class="col-sm-9">
                            <input type="text" name="address" @if(request('id')>0) value="{{$company->address}}" @endif class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Website</label>
                        <div class="col-sm-9">
                            <input type="text" name="website" @if(request('id')>0) value="{{$company->website}}" @endif class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Telephone</label>
                        <div class="col-sm-9">
                            <input type="text" name="telephone" @if(request('id')>0) value="{{$company->telephone}}" @endif class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Trade License</label>
                        <div class="col-sm-9">
                            <input type="text" name="trade_license" @if(request('id')>0) value="{{$company->trade_license}}" @endif class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">VAT Registration</label>
                        <div class="col-sm-9">
                            <input type="text" name="VAT_registration" @if(request('id')>0) value="{{$company->VAT_registration}}" @endif class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">TIN</label>
                        <div class="col-sm-9">
                            <input type="text" name="TIN" @if(request('id')>0) value="{{$company->TIN}}" @endif class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">BIN</label>
                        <div class="col-sm-9">
                            <input type="text" name="BIN" @if(request('id')>0) value="{{$company->BIN}}" @endif class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Logo</label>
                        <div class="col-sm-9">
                            <input type="file" name="image" class="form-control">
                            <br>
                            @if(request('id')>0)<img src="{{asset($company->logo)}}" alt="" style="height: 50px; width: 50px">@endif
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Logo Color</label>
                        <div class="col-sm-9">
                            <input type="text" name="logo_color" @if(request('id')>0) value="{{$company->logo_color}}" @endif class="form-control" required>
                        </div>
                    </div>
                    @if(request('id')>0)
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($company->status =='active') selected @endif value="active">Active</option>
                                    <option @if($company->status =='inactive') selected @endif value="inactive">Inactive</option>
                                    <option @if($company->status =='suspended') selected @endif value="suspended">Suspended</option>
                                    <option @if($company->status =='deleted') selected @endif value="deleted">Deleted</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('dev.company.view')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('id')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
