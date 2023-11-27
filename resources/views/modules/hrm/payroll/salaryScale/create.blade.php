@extends('layouts.app')

@section('title')
    @php($title = 'Salary Scale')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('id')) Update @else Create @endif {{$title}} <small class="text-danger float-right"> field marked with * are mandatory</small></h4>
                <form method="POST" action="@if(request('id')>0) {{route('hrm.employee.update', ['id'=>$employee->id])}} @else {{route('hrm.employee.store')}} @endif" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Basic Amount <span class="required text-danger">*</span></label>
                        <div class="col-sm-5">
                            <input type="text" name="basic_amount" @if(request('code')>0) value="{{$employee->basic_amount}}" @endif class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">House Rent</label>
                        <div class="col-sm-5">
                            <input type="text" name="house_rent" @if(request('code')>0) value="{{$employee->house_rent}}" @endif class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Conveyance Bill</label>
                        <div class="col-sm-5">
                            <input type="text" name="conveyance_bill" @if(request('code')>0) value="{{$employee->conveyance_bill}}" @endif class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Spouse's Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="spouse_name" @if(request('code')>0) value="{{$employee->spouse_name}}" @endif class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Date of Birth <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="date" name="date_of_birth" @if(request('code')>0) value="{{$employee->date_of_birth}}" @endif class="form-control">
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">National ID <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="national_id" @if(request('code')>0) value="{{$employee->national_id}}" @endif required class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Birth Certificate ID <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="birth_certificate_id" @if(request('code')>0) value="{{$employee->birth_certificate_id}}" @endif required class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Passport No</label>
                        <div class="col-sm-9">
                            <input type="text" name="passport_id" @if(request('code')>0) value="{{$employee->passport_id}}" @endif class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Driving License</label>
                        <div class="col-sm-9">
                            <input type="text" name="driving_license" @if(request('code')>0) value="{{$employee->driving_license}}" @endif class="form-control">
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
