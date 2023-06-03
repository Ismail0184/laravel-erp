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
                            <td style="vertical-align: middle">
                            <select class="form-control select2" name="ledger_id" required="required">
                                <option value=""></option>
                                @foreach($ledgerss as $ledgers)
                                    <option value="{{$ledgers->ledger_id}}" @if(request('id')>0) @if($ledgers->ledger_id==$editValue->ledger_id) selected @endif @endif>{{$ledgers->ledger_id}} : {{$ledgers->ledger_name}}</option>
                                @endforeach
                            </select>
                            </td>
                            <td style="vertical-align: middle">
                            <textarea  name="narration" class="form-control" style="height: 38px">@if(request('id')>0) {{$editValue->narration}} @endif</textarea>
                            </td>
                            <td style="vertical-align: middle"><input type="file" /></td>
                            <td style="vertical-align: middle">
                            <input type="number" name="dr_amt"  class="form-control" @if(request('id')>0) value="{{$editValue->dr_amt}}" @endif autocomplete="off" step="any" min="1" required />
                            </td>
                            <td>
                                @if(request('id')>0)
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{route('acc.voucher.receipt.create')}}" class="btn btn-danger" style="margin-top: 3px">Cancel</a>
                                @else
                                    <button type="submit" class="btn btn-primary">Add</button>
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
               <div class="table-responsive">
                   <table  class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;font-size: 11px">
                       <thead>
                       <tr>
                           <th style="width: 5%; text-align: center">#</th>
                           <th style="width: 5%; text-align: center">Uid</th>
                           <th>Account Head</th>
                           <th>Narration</th>
                           <th>Debit Amount</th>
                           <th>Credit Amount</th>
                           <th class="text-center" style="width: 10%">Option</th>
                       </tr>
                       </thead>
                       <tbody>
                       @php($totalDebit = 0)
                       @php($totalCredit = 0)
                       @foreach($receipts as $receipt)
                           <tr>
                               <td style="text-align: center">{{$loop->iteration}}</td>
                               <td style="text-align: center">{{$receipt->id}}</td>
                               <td>{{$receipt->ledger_id}} : {{$receipt->ledger->ledger_name}}</td>
                               <td>{{$receipt->narration}}</td>
                               <td style="text-align: right">{{number_format($receipt->dr_amt,2)}}</td>
                               <td style="text-align: right;">{{number_format($receipt->cr_amt,2)}}</td>
                               <td class="text-center">
                                   <form action="{{route('acc.voucher.receipt.create', ['id' => $receipt->id])}}" method="post">
                                       @csrf
                                       <a href="{{route('acc.voucher.receipt.edit',['id' => $receipt->id])}}" title="Update" class="btn btn-success btn-sm">
                                           <i class="fa fa-edit"></i>
                                       </a>
                                       <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you confirm to delete?');">
                                           <i class="fa fa-trash"></i>
                                       </button>
                                   </form>
                               </td>
                           </tr>
                           @php($totalDebit = $totalDebit +$receipt->dr_amt)
                           @php($totalCredit = $totalCredit +$receipt->cr_amt)
                       @endforeach
                       <tr>
                           <th colspan="4" style="text-align: right">Total = </th>
                           <th style="text-align: right">{{number_format($totalDebit,2)}}</th>
                           <th style="text-align: right">{{number_format($totalCredit,2)}}</th>
                           <th></th>
                       </tr>
                       </tbody>
                   </table>

               </div>
            </div>
        </div>
    </div>
@endsection
