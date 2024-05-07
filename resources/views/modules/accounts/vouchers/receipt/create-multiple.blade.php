@extends('layouts.app')

@section('title')
    @php($title = 'Multiple Receipt Voucher')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Create {{$title}} <small><a href="{{route('acc.voucher.receipt.create')}}">Single Entry</a></small><small class="text-danger float-right">(field marked with * are mandatorys)</small></h4>
                <form style="font-size: 11px" method="POST" action="@if(Session::get('receipt_no')>0) {{route('acc.voucher.receipt.mupdate', ['voucher_no'=>$masterData->voucher_no])}} @else {{route('acc.voucher.receipt.initiate')}} @endif">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="entry_at" value="{{date('Y-m-d H:i:s')}}">
                    <input type="hidden" name="maturity_date" value="2000-01-01">
                    <input type="hidden" name="journal_type" value="receipt">
                    <input type="hidden" name="voucher_type" value="multiple">
                    <input type="hidden" name="status" value="MANUAL">
                    <div class="form-group row mb-2">
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Receipt No <span class="required text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="hidden" name="journal_type" value="receipt" class="form-control" />
                            <input type="text" readonly name="voucher_no" @if(Session::get('receipt_no')>0) value="{{Session::get('receipt_no')}}" @else value="{{$receiptVoucher}}" @endif class="form-control" required />
                        </div>
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Date <span class="required text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="date" name="voucher_date" min="{{ \Carbon\Carbon::now()->subDays($minDatePermission)->format('Y-m-d') }}" max="{{date('Y-m-d')}}" @if(Session::get('receipt_no')>0) value="{{$masterData->voucher_date}}" @endif class="form-control" required />
                        </div>
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Person from</label>
                        <div class="col-sm-3">
                            <input type="text" name="person" @if(Session::get('receipt_no')>0) value="{{$masterData->person}}" @endif class="form-control" />
                        </div>
                    </div>

                    <div class="form-group row mb-3">
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
                            <input type="hidden" name="cash_bank_ledger" value="0" class="form-control" />
                            <input type="hidden" name="amount" value="0" class="form-control" />
                        </div>
                    </div>
                    @if($COUNT_receipts_data > 0)
                    @else
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-7">
                            <div>
                                @if(Session::get('receipt_no'))
                                    <a href="{{route('acc.voucher.receipt.cancelall', ['voucher_no' => $masterData->voucher_no, 'journal_type'=>'receipt','voucher_type'=>'multiple'])}}" class="btn btn-danger w-md" onclick="return window.confirm('Confirm to cancel?');"> <i class="fa fa-window-close"></i> Cancel</a>
                                @else
                                    <a href="{{route('acc.voucher.receipt.view')}}" class="btn btn-danger w-md"> <i class="fa fa-backward"></i> Go back</a>
                                @endif
                                <button type="submit" class="btn btn-success w-md">@if(Session::get('receipt_no')) <i class="fa fa-edit"></i> Update @else <i class="fa fa-save"></i> Initiate & Proceed @endif</button>
                            </div>
                        </div>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    @if(Session::get('receipt_no')>0)
        <form style="font-size: 11px" method="POST" action="@if(request('id')>0) {{route('acc.voucher.receipt.update', ['id'=>$editValue->id])}} @else {{route('acc.voucher.receipt.store')}} @endif" enctype="multipart/form-data">
            @csrf
            @if ($message = Session::get('destroy_message'))
                <p class="text-center text-danger">{{ $message }}</p>
            @elseif( $message = Session::get('store_message'))
                <p class="text-center text-success">{{ $message }}</p>
            @elseif( $message = Session::get('update_message'))
                <p class="text-center text-primary">{{ $message }}</p>
            @endif
            <input type="hidden" name="voucher_no" value="{{$masterData->voucher_no}}">
            <input type="hidden" name="receipt_no" value="{{$masterData->voucher_no}}">
            <input type="hidden" name="receipt_date" value="{{$masterData->voucher_date}}">
            <input type="hidden" name="amount" value="{{$masterData->amount}}">
            <input type="hidden" name="relevant_cash_head" value="{{$masterData->cash_bank_ledger}}">
            <input type="hidden" name="receipt_date" value="{{$masterData->voucher_date}}">
            <input type="hidden" name="entry_by" value="{{$masterData->entry_by}}">
            <input type="hidden" name="voucher_type" value="multiple">
            <table align="center" class="table table-striped table-bordered" style="width:98%; font-size: 11px">
                <thead class="table-success">
                <tr>
                    <th style="text-align: center">Cash , Bank & Others Ledger <span class="required text-danger">*</span></th>
                    <th style="text-align: center; width: 25%">Narration <span class="required text-danger">*</span></th>
                    <th style="text-align: center;width:5%;">Attachment</th>
                    <th style="width:15%; text-align:center">Amount (Dr or Cr)<span class="required text-danger">*</span></th>
                    <th style="text-align:center;width: 10%">Action <span class="required text-danger">*</span></th>
                </tr>
                </thead>
                <tbody>
                <tr style="background-color: white">
                    <td style="vertical-align: middle">
                        <select class="form-control select2" style="width: 100%" name="ledger_id" required="required">
                            <option value=""></option>
                            @foreach($ledgerss as $ledgers)
                                <option value="{{$ledgers->ledger_id}}" @if(request('id')>0) @if($ledgers->ledger_id==$editValue->ledger_id) selected @endif @endif>{{$ledgers->ledger_id}} : {{$ledgers->ledger_name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td style="vertical-align: middle">
                        <textarea  name="narration" class="form-control" style="height: 70px">@if(request('id')>0) {{$editValue->narration}} @else {{Session::get('receipt_narration')}} @endif</textarea>
                    </td>
                    <td style="vertical-align: middle; text-align: right"><input type="file" style="width: 160px"  name="image" />
                        @if(request('id')>0)
                            @if(!empty($editValue->receipt_attachment))
                                <br>
                                <a href="{{asset($editValue->receipt_attachment)}}" style="text-align: center;" class="btn btn-primary btn-sm" title="delete attachment" target="_blank"><i class="fa fa-book-open"></i></a>
                                <a href="{{route('acc.voucher.receipt.deleteAttachmentReceiptVoucher', ['id'=>request('id'),'voucher_type'=>'multiple'])}}" style="text-align: center" class="btn btn-danger btn-sm" title="delete attachment"><i class="fa fa-trash"></i></a>
                            @endif
                        @endif
                    </td>
                    <td style="vertical-align: middle">
                        <input type="number" name="dr_amt" style="text-align: center" class="form-control" @if(request('id')>0) value="{{$editValue->dr_amt}}" @endif autocomplete="off" step="any" placeholder="debit"   />

                        <input type="number" style="margin-top: 5px;text-align: center" name="cr_amt"  class="form-control" @if(request('id')>0) value="{{$editValue->cr_amt}}" @endif autocomplete="off" step="any" placeholder="credit"  />
                    </td>
                    <td style="vertical-align: middle; text-align: center">
                        @if(request('id')>0)
                            <button type="submit" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> Update</button>
                            <a href="{{route('acc.voucher.receipt.multiple.create')}}" class="btn btn-danger btn-sm" style="margin-top: 5px"> <i class="fa fa-window-close"></i> Cancel</a>
                        @else
                            <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Add</button>
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
        </form>

        @if($COUNT_receipts_data > 0)
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
                                    <th class="text-center">Attachment</th>
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
                                        <td style="text-align: center; vertical-align: middle">{{$loop->iteration}}</td>
                                        <td style="text-align: center; vertical-align: middle">{{$receipt->id}}</td>
                                        <td style="vertical-align: middle">{{$receipt->ledger_id}} : {{$receipt->ledger->ledger_name}}</td>
                                        <td style="vertical-align: middle">{{$receipt->narration}}</td>
                                        <td style="vertical-align: middle" class="text-center">{{$receipt->type}}</td>
                                        <td style="vertical-align: middle" class="text-center">
                                            @if(!empty($receipt->receipt_attachment))
                                                <a href="{{asset($receipt->receipt_attachment)}}" target="_blank">View</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td style="text-align: right; vertical-align: middle">
                                            @if($receipt->dr_amt>0)
                                                {{number_format($receipt->dr_amt,2)}}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td style="text-align: right;vertical-align: middle">
                                            @if($receipt->cr_amt>0)
                                                {{number_format($receipt->cr_amt,2)}}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center" style="vertical-align: middle">
                                            <form action="{{route('acc.voucher.receipt.destroy', ['id' => $receipt->id])}}" method="post">
                                                @csrf
                                                <input type="hidden" name="voucher_type" value="multiple">
                                                <a href="{{route('acc.voucher.receipt.editMultiple',['id' => $receipt->id])}}" title="Update" class="btn btn-success btn-sm">
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
                                    <th colspan="6" style="text-align: right">Total = </th>
                                    <th style="text-align: right">{{number_format($totalDebit,2)}}</th>
                                    <th style="text-align: right">{{number_format($totalCredit,2)}}</th>
                                    <th></th>
                                </tr>
                                </tbody>
                            </table>
                            <div>
                                <form action="{{route('acc.voucher.receipt.cancelall', ['voucher_no' => $masterData->voucher_no])}}" method="post">
                                    @csrf
                                    <input type="hidden" name="journal_type" value="receipt">
                                    <input type="hidden" name="voucher_type" value="multiple">
                                    <button type="submit" class="btn btn-danger float-left" onclick="return window.confirm('Are you sure you want to Delete the Voucher?');"><i class="fa fa-trash"></i> Cancel & Delete All</button>
                                </form>
                                @if(number_format($totalDebit,2) === number_format($totalCredit,2))
                                    <form action="{{route('acc.voucher.receipt.confirm', ['voucher_no' => $masterData->voucher_no])}}" method="post">
                                        @csrf
                                        <input type="hidden" name="amount_equality" value="BALANCED">
                                        <input type="hidden" name="voucher_no" value="{{$masterData->voucher_no}}">
                                        <button type="submit" class="btn btn-success float-right" onclick="return window.confirm('Are you confirm?');"> <i class="fa fa-check-double"></i> Confirm & Finish Voucher</button>
                                    </form>
                                @else
                                    <div class="alert alert-danger float-right col-sm-5" role="alert" style="font-size: 11px">
                                        Invalid Voucher. Debit ({{$totalDebit}}) and Credit ({{$totalCredit}}) amount are not equal !!
                                    </div>
                                @endif
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif @endif
@endsection
