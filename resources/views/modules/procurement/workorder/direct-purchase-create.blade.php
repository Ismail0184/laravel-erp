@extends('layouts.app')

@section('title')
    @php($title = 'Purchase')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Create {{$title}} <small class="text-danger float-right">(field marked with * are mandatorys)
                    </small>
                </h4>
                <form style="font-size: 11px" method="POST" action="@if(Session::get('po_no')>0) {{route('pro.workorder.update', ['po_no'=>$masterData->po_no])}} @else {{route('pro.workorder.initiate')}} @endif">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="entry_at" value="{{date('Y-m-d H:i:s')}}">
                    <input type="hidden" name="status" value="MANUAL">
                    <input type="hidden" name="po_type" value="DP">
                    <div class="form-group row mb-2">
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Po No <span class="required text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="hidden" name="journal_type" value="journal" class="form-control" />
                            <input type="text" readonly name="po_no" @if(Session::get('po_no')>0) value="{{Session::get('po_no')}}" @else value="{{$po_no}}" @endif class="form-control" required />
                        </div>
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Po Date <span class="required text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="date" name="po_date" min="" max="{{date('Y-m-d')}}" @if(Session::get('po_no')>0) value="{{$masterData->voucher_date}}" @endif class="form-control" required />
                        </div>
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Warehouse</label>
                        <div class="col-sm-3">
                            <select class="form-control select2" name="warehouse_id" required="required">
                                <option value=""></option>
                                @foreach($warehouses as $warehouse)
                                    <option value="{{$warehouse->warehouse_id}}" @if(request('id')>0) @if($warehouse->vendor_id==$editValue->vendor_id) selected @endif @endif>{{$warehouse->warehouse_id}} : {{$warehouse->warehouse_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Vendor <span class="required text-danger">*</span></label>
                        <div class="col-sm-3">
                            <select class="form-control select2" name="vendor_id" required="required">
                                <option value=""></option>
                                @foreach($vendors as $vendor)
                                    <option value="{{$vendor->vendor_id}}" @if(request('id')>0) @if($vendor->vendor_id==$editValue->vendor_id) selected @endif @endif>{{$vendor->vendor_id}} : {{$vendor->vendor_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Tax(%)</label>
                        <div class="col-sm-3">
                            <input type="number" name="tax" @if(Session::get('po_no')>0) value="{{$masterData->tax}}" @endif class="form-control" />
                        </div>
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">VAT(%)</label>
                        <div class="col-sm-3">
                            <input type="number" name="vat" @if(Session::get('po_no')>0) value="{{$masterData->vat}}" @endif class="form-control" />
                        </div>
                    </div>
                    @if($COUNT_po_datas > 0)
                    @else
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-7">
                                <div>
                                    @if(Session::get('po_no'))
                                        <a href="{{route('acc.voucher.journal.cancelall', ['voucher_no' => $masterData->voucher_no, 'journal_type'=>'journal'])}}" class="btn btn-danger w-md" onclick="return window.confirm('Confirm to cancel?');">Cancel</a>
                                    @endif
                                    <button type="submit" class="btn btn-success w-md">@if(Session::get('po_no')) Update @else Initiate & Proceed @endif</button>
                                </div>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    @if(Session::get('po_no')>0)
        <form style="font-size: 11px" method="POST" action="@if(request('id')>0) {{route('acc.voucher.journal.update', ['id'=>$editValue->id])}} @else {{route('acc.voucher.journal.store')}} @endif">
            @csrf
            @if ($message = Session::get('destroy_message'))
                <p class="text-center text-danger">{{ $message }}</p>
            @elseif( $message = Session::get('store_message'))
                <p class="text-center text-success">{{ $message }}</p>
            @elseif( $message = Session::get('update_message'))
                <p class="text-center text-primary">{{ $message }}</p>
            @endif
            <input type="hidden" name="po_no" value="{{$masterData->voucher_no}}">
            <input type="hidden" name="journal_date" value="{{$masterData->voucher_date}}">
            <input type="hidden" name="amount" value="{{$masterData->amount}}">
            <input type="hidden" name="relevant_cash_head" value="{{$masterData->cash_bank_ledger}}">
            <input type="hidden" name="entry_by" value="{{$masterData->entry_by}}">
            <input type="hidden" name="vouchertype" value="multiple">
            <table align="center" class="table table-striped table-bordered" style="width:98%; font-size: 11px">
                <thead class="table-success">
                <tr>
                    <th style="text-align: center">Item Name <span class="required text-danger">*</span></th>
                    <th style="text-align: center; width: 15%">Item Details</th>
                    <th style="text-align: center; width: 20%">Buy Qty <span class="required text-danger">*</span></th>
                    <th style="text-align: center;width:15%;">Unit Price</th>
                    <th style="width:15%; text-align:center">Amount</th>
                    <th style="text-align:center;width: 5%">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr style="background-color: white">
                    <td style="vertical-align: middle">
                        <select class="form-control select2" name="ledger_id" required="required">
                            <option value=""></option>
                        </select>
                    </td>
                    <td style="vertical-align: middle">
                        <select class="form-control select2" name="cc_code" required="required">
                            <option value=""></option>
                        </select>
                    </td>
                    <td style="vertical-align: middle">
                        <textarea  name="narration" class="form-control" style="height: 70px">@if(request('id')>0) {{$editValue->narration}} @else {{Session::get('journal_narration')}} @endif</textarea>
                    </td>
                    <td style="vertical-align: middle"><input type="file" class="form-control" /></td>
                    <td style="vertical-align: middle">
                        <input type="number" name="dr_amt" style="text-align: center" class="form-control" @if(request('id')>0) value="{{$editValue->dr_amt}}" @endif autocomplete="off" step="any" placeholder="debit"   />
                        <input type="number" style="margin-top: 5px;text-align: center" name="cr_amt"  class="form-control" @if(request('id')>0) value="{{$editValue->cr_amt}}" @endif autocomplete="off" step="any" placeholder="credit"  />
                    </td>
                    <td style="vertical-align: middle">
                        @if(request('id')>0)
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{route('acc.voucher.journal.create')}}" class="btn btn-danger" style="margin-top: 5px">Cancel</a>
                        @else
                            <button type="submit" class="btn btn-success">Add</button>
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
        @if($COUNT_po_datas > 0)
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;font-size: 11px">
                                <thead class="table-success">
                                <tr>
                                    <th style="width: 5%; text-align: center">#</th>
                                    <th style="width: 5%; text-align: center">Uid</th>
                                    <th>Account Head</th>
                                    <th>Narration</th>
                                    <th class="text-center">Type</th>
                                    <th>Debit Amount</th>
                                    <th>Credit Amount</th>
                                    <th class="text-center" style="width: 10%">Option</th>
                                </tr>
                                </thead>
                                <tbody>

                            </table>
                            <div>
                                <form action="" method="post">
                                    @csrf
                                    <input type="hidden" name="journal_type" value="journal">
                                    <input type="hidden" name="vouchertype" value="multiple">
                                    <button type="submit" class="btn btn-danger float-left" onclick="return window.confirm('Are you sure you want to Delete the Voucher?');">Cancel & Delete All</button>
                                </form>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif @endif
@endsection
