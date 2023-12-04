@extends('layouts.app')

@section('title')
    @php($title = 'Salary Info')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('id')) Update @else Create @endif {{$title}}</h4>
                <form method="POST" action="@if(request('id')>0) {{route('hrm.payroll.salaryScale.update', ['id'=>$salaryScale->id])}} @else {{route('hrm.payroll.salaryScale.store')}} @endif" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Basic Amount</label>
                        <div class="col-sm-9">
                            <input type="text" name="basic_amount" @if(request('id')>0) value="{{$salaryScale->basic_amount}}" @endif class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">House Rent</label>
                        <div class="col-sm-9">
                            <input type="text" name="house_rent" @if(request('id')>0) value="{{$salaryScale->house_rent}}" @endif class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Conveyance Bill</label>
                        <div class="col-sm-9">
                            <input type="text" name="conveyance_bill" @if(request('id')>0) value="{{$salaryScale->conveyance_bill}}" @endif class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Phone Bill</label>
                        <div class="col-sm-9">
                            <input type="text" name="phone_bill" @if(request('id')>0) value="{{$salaryScale->phone_bill}}" @endif class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Medical Allowance</label>
                        <div class="col-sm-9">
                            <input type="text" name="medical_allowance" @if(request('id')>0) value="{{$salaryScale->medical_allowance}}" @endif class="form-control">
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Income Tax</label>
                        <div class="col-sm-9">
                            <input type="text" name="income_tax" @if(request('id')>0) value="{{$salaryScale->income_tax}}" @endif required class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Provident Fund</label>
                        <div class="col-sm-9">
                            <input type="text" name="pf_amount" @if(request('id')>0) value="{{$salaryScale->pf_amount}}" @endif required class="form-control">
                        </div>
                    </div>


                    @if(request('id')>0)
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($salaryScale->status =='active') selected @endif value="active">Active</option>
                                    <option @if($salaryScale->status =='inactive') selected @endif value="inactive">Inactive</option>
                                    <option @if($salaryScale->status =='suspended') selected @endif value="suspended">Suspended</option>
                                    <option @if($salaryScale->status =='deleted') selected @endif value="deleted">Deleted</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('hrm.payroll.salaryScale')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('id')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
