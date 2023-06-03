@extends('layouts.app')

@section('title')
    @php($title = 'Receipt Voucher')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('ledger_id')) Update @else Create @endif {{$title}} <small>Single Entry </small><small class="text-danger float-right">(field marked with * are mandatory)
                    </small></h4>
                <form style="font-size: 11px" method="POST" action="@if(request('ledger_id')>0) {{route('acc.voucher.receipt.update', ['ledger_id'=>$ledger->ledger_id])}} @else {{route('acc.voucher.receipt.initiate')}} @endif">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="entry_at" value="{{date('Y-m-d H:i:s')}}">
                    <input type="hidden" name="maturity_date" value="2000-01-01">
                    <input type="hidden" name="journal_type" value="receipt">
                    <input type="hidden" name="status" value="MANUAL">
                    <div class="form-group row mb-2">
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Receipt No <span class="required text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="hidden" name="journal_type" value="receipt" class="form-control" />
                            <input type="text" readonly name="voucher_no" @if(Session::get('receipt_no')>0) value="{{Session::get('receipt_no')}}" @else value="{{$receiptVoucher}}"  @endif class="form-control" required />
                        </div>
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Date <span class="required text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="date" name="receipt_date" min="" max="{{date('Y-m-d')}}" @if(Session::get('receipt_no')>0) value="{{$masterData->voucher_date}}" @endif class="form-control" required />
                        </div>
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Person from</label>
                        <div class="col-sm-3">
                            <input type="text" name="person" @if(Session::get('receipt_no')>0) value="{{$masterData->person}}" @endif class="form-control" />
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">of Bank</label>
                        <div class="col-sm-3">
                            <input type="text" name="cheque_of_bank" @if(Session::get('receipt_no')>0) value="{{$masterData->cheque_of_bank}}" @endif class="form-control" />
                        </div>
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Cheque No</label>
                        <div class="col-sm-3">
                            <input type="text" name="cheque_no" @if(Session::get('receipt_no')>0) value="{{$masterData->cheque_no}}" @endif class="form-control" />
                        </div>
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Chq. Date</label>
                        <div class="col-sm-3">
                            <input type="date" name="cheque_date" @if(Session::get('receipt_no')>0) value="{{$masterData->cheque_date}}" @endif class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Ledger <span class="required text-danger">*</span></label>
                        <div class="col-sm-7">
                            <select class="form-control select2" name="cash_bank_ledger" required="required">
                                <option value=""> -- receive from ledger -- </option>
                                @foreach($ledgers as $ledgers)
                                    <option value="{{$ledgers->ledger_id}}" @if(Session::get('receipt_no')>0) @if($ledgers->ledger_id==$masterData->cash_bank_ledger) selected @endif @endif>{{$ledgers->ledger_id}} : {{$ledgers->ledger_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Amt. (Cr) <span class="required text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="number" name="amount" @if(Session::get('receipt_no')>0) value="{{$masterData->amount}}" @endif class="form-control" step="any" min="1" tabindex="7" />
                        </div>

                    </div>

                    <div class="form-group row justify-content-end">
                        <div class="col-sm-7">
                            <div>
                                <!--a class="btn btn-danger" href="{{route('acc.voucher.receipt.view')}}">Cancel</a-->
                                <button type="submit" class="btn btn-primary w-md">@if(Session::get('receipt_no')) Update @else Initiate & Proceed @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form style="font-size: 11px" method="POST" action="{{route('acc.voucher.receipt.store')}}">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="entry_at" value="{{date('Y-m-d H:i:s')}}">
                    <input type="hidden" name="maturity_date" value="2000-01-01">
                    <input type="hidden" name="journal_type" value="receipt">
                    <input type="hidden" name="status" value="MANUAL">

                    <div class="form-group row mb-2">
                        <div class="col-sm-5">
                            <select class="form-control select2" name="cash_bank_ledger" required="required">
                                <option value=""> -- Cash or Bank Ledger -- </option>
                                @foreach($ledgerss as $ledgers)
                                    <option value="{{$ledgers->ledger_id}}">{{$ledgers->ledger_id}} : {{$ledgers->ledger_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <input type="number" name="amount" placeholder="Debit Amount" class="form-control" step="any" min="1" tabindex="7" />
                        </div>
                        <div class="col-sm-3">
                            <input type="file" />
                        </div>
                        <div class="col-sm-1">
                            <button type="submit" class="btn btn-primary">Add</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
