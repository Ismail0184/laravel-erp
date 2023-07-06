@extends('layouts.app')

@section('title')
    Create Class
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('class_id')) Update @else Create @endif Class</h4>
                <form method="POST" action="@if(request('class_id')>0) {{route('acc.class.update', ['class_id'=>$class->class_id])}} @else {{route('acc.class.store')}} @endif">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                    @if(!(request('warehouse_id')))
                        <div class="form-group row mb-4">
                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Warehouse Name <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="warehouse_name" @if(request('warehouse_id')>0) value="{{$class->warehouse_name}}" @endif class="form-control" required>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Nick Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="nick_name" @if(request('warehouse_id')>0) value="{{$class->nick_name}}" @endif class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Address</label>
                        <div class="col-sm-9">
                            <textarea name="address" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">VMS Address</label>
                        <div class="col-sm-9">
                            <textarea name="VMS_address" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">POC Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="poc_name" @if(request('warehouse_id')>0) value="{{$class->poc_name}}" @endif class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">POC Designation</label>
                        <div class="col-sm-9">
                            <input type="text" name="poc_designation" @if(request('warehouse_id')>0) value="{{$class->nick_name}}" @endif class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">POC Number</label>
                        <div class="col-sm-9">
                            <input type="number" name="poc_number" @if(request('warehouse_id')>0) value="{{$class->poc_number}}" @endif class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">POC Email</label>
                        <div class="col-sm-9">
                            <input type="email" name="poc_email" @if(request('warehouse_id')>0) value="{{$class->poc_email}}" @endif class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Use Type <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="use_type" required>
                                <option> -- select a type --</option>
                                <option @if(request('class_id')>0) @if($class->use_type =='WH') selected @endif @endif>Warehouse</option>
                                <option @if(request('class_id')>0) @if($class->use_type =='PL') selected @endif @endif>Production Line</option>
                                <option @if(request('class_id')>0) @if($class->use_type =='SD') selected @endif @endif>SD</option>
                                <option @if(request('class_id')>0) @if($class->use_type =='DM') selected @endif @endif>DM</option>
                                <option @if(request('class_id')>0) @if($class->use_type =='TR') selected @endif @endif>TR</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Use Type <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="ledger_id" required="required">
                                <option value=""></option>
                                @foreach($ledgerss as $ledgers)
                                    <option value="{{$ledgers->ledger_id}}" @if(request('id')>0) @if($ledgers->ledger_id==$editValue->ledger_id) selected @endif @endif>{{$ledgers->ledger_id}} : {{$ledgers->ledger_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if(request('class_id')>0)
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($class->status ==1) selected @endif value="1">Active</option>
                                    <option @if($class->status ==0) selected @endif value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('war.warehouse.view')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('class_id')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
