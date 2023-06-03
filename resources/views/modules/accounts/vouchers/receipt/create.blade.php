@extends('layouts.app')

@section('title')
    @php($title = 'Receipt Voucher')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Create {{$title}} <small>Single Entry </small><small class="text-danger float-right">(field marked with * are mandatory)
                    </small></h4>
                <form style="font-size: 11px" method="POST" action="@if(Session::get('receipt_no')>0) {{route('acc.voucher.receipt.mupdate', ['voucher_no'=>$masterData->voucher_no])}} @else {{route('acc.voucher.receipt.initiate')}} @endif">
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
                            <input type="date" name="voucher_date" min="" max="{{date('Y-m-d')}}" @if(Session::get('receipt_no')>0) value="{{$masterData->voucher_date}}" @endif class="form-control" required />
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
                            <input type="number" name="amount" @if(Session::get('receipt_no')>0) value="{{$masterData->amount}}" @endif class="form-control" step="any" min="1"/>
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


                <form style="font-size: 11px" method="POST" action="{{route('acc.voucher.receipt.store')}}">
                    @csrf
                    @if ($message = Session::get('destroy_message'))
                        <p class="text-center text-danger">{{ $message }}</p>
                    @elseif( $message = Session::get('store_message'))
                        <p class="text-center text-success">{{ $message }}</p>
                    @elseif( $message = Session::get('update_message'))
                        <p class="text-center text-primary">{{ $message }}</p>
                    @endif
                    <input type="hidden" name="receipt_no" value="{{$masterData->voucher_no}}">
                    <input type="hidden" name="receipt_date" value="{{$masterData->voucher_date}}">
                    <input type="hidden" name="relevant_cash_head" value="{{$masterData->cash_bank_ledger}}">
                    <input type="hidden" name="receipt_date" value="{{$masterData->voucher_date}}">
                    <input type="hidden" name="entry_by" value="{{$masterData->entry_by}}">
                    <table align="center" class="table table-striped table-bordered" style="width:98%; font-size: 11px">
                        <tbody>
                        <tr style="background-color: #3caae4; color:white">
                            <th style="text-align: center">Cash , Bank & Others <span class="required text-danger">*</span></th>
                            <th style="text-align: center">Narration <span class="required text-danger">*</span></th>
                            <th style="text-align: center;width:10%;">Attachment</th>
                            <th style="width:15%; text-align:center">Debit Amount <span class="required text-danger">*</span></th>
                            <th style="text-align:center;width: 5%">Action</th>
                        </tr>
                        <tbody>
                        <tr>
                            <td>
                            <select class="form-control select2" name="ledger_id" required="required">
                                <option value=""></option>
                                @foreach($ledgerss as $ledgers)
                                    <option value="{{$ledgers->ledger_id}}">{{$ledgers->ledger_id}} : {{$ledgers->ledger_name}}</option>
                                @endforeach
                            </select>
                            </td>
                            <td>
                            <textarea  name="narration" class="form-control" style="height: 38px"></textarea>
                            </td>
                            <td><input type="file" /></td>
                            <td>
                            <input type="number" name="dr_amt"  class="form-control" autocomplete="off" step="any" min="1" required />
                            </td>
                            <td>
                            <button type="submit" class="btn btn-primary">Add</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>

@endsection
