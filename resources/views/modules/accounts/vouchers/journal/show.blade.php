@extends('layouts.app')

@section('title')
    Journal Voucher View
@endsection

@section('body')
    <style>
        .invoice-ribbon {
            width:85px;
            height:95px;
            overflow:hidden;
            position:absolute;
            top:-1px;
            right:0px;
        }

        .ribbon-inner {
            text-align:center;
            -webkit-transform:rotate(45deg);
            -moz-transform:rotate(45deg);
            -ms-transform:rotate(45deg);
            -o-transform:rotate(45deg);
            position:relative;
            padding:7px 0;
            left:-5px;
            top:11px;
            width:120px;
            @if($vouchermaster->status=='DELETED')
            background-color:red;
            @elseif($vouchermaster->status=='APPROVED')
            background-color:#66c591;
            @elseif($vouchermaster->status=='CHECKED')
            background-color:#66c591;
            @elseif($vouchermaster->status=='AUDITED')
            background-color:#66c591;
            @elseif($vouchermaster->status=='UNCHECKED')
            background-color:#555555;
            @endif
            font-size:15px;
            color:#fff;
        }

        .ribbon-inner:before,.ribbon-inner:after {
            content:"";
            position:absolute;
        }

        .ribbon-inner:before {
            left:0;
        }

        .ribbon-inner:after {
            right:0;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="invoice-ribbon"><div class="ribbon-inner">{{$vouchermaster->status}}</div></div>
                    <div class="card-body">
                        <div class="invoice-title">
                            <h1 class="font-size-20 text-center">{{ Auth::user()->getCompanyInfo->company_name }}<br>
                                <small class="font-size-10">{{ Auth::user()->getCompanyInfo->address }}
                                </small>
                            </h1>
                        </div>
                        <hr>
                        @if($vouchermaster->status!=='DELETED')
                            <h1 class="text-center text-uppercase">Journal Voucher</h1>
                        @else
                            <h1 class="text-center text-uppercase"><del>Journal Voucher</del></h1>
                        @endif
                        <div class="row">

                            <div class="col-sm-6 mt-3">
                                <address>
                                    <strong>Voucher No:</strong><br>
                                    {{request('voucher_no')}}<br>
                                </address>
                            </div>
                            <div class="col-sm-6 mt-3 text-sm-right">
                                <address>
                                    <strong>Voucher Date:</strong><br>
                                    {{$vouchermaster->voucher_date}}<br>
                                </address>
                            </div>
                        </div>
                        <div class="py-2 mt-3">
                            <h3 class="font-size-15 font-weight-bold">Voucher Details</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-nowrap">
                                <thead>
                                <tr>
                                    <th style="width: 70px;">#</th>
                                    <th>A/C Ledger Head</th>
                                    <th>Particulars</th>
                                    <th>Attachment</th>
                                    <th class="text-right">Debit</th>
                                    <th class="text-right">Credit</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($dr_total = 0)
                                @php($cr_total = 0)
                                @foreach($journals as $journal)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$journal->ledgerforvoucher->ledger_name}}</td>
                                        <td>{{$journal->narration}}</td>
                                        <td>
                                            @if(!empty($journal->journal_attachment))
                                                <a href="{{asset($journal->journal_attachment)}}" target="_blank">View</a>
                                            @endif
                                        </td>
                                        <td class="text-right">{{number_format($journal->dr_amt,2)}}</td>
                                        <td class="text-right">{{number_format($journal->cr_amt,2)}}</td>
                                    </tr>
                                    @php($dr_total = $dr_total +$journal->dr_amt )
                                    @php($cr_total = $cr_total +$journal->cr_amt )
                                @endforeach
                                <tr>
                                    <td colspan="4" class="border-0 text-right">
                                        <h4 class="m-0">Total</h4></td>
                                    <td class="border-0 text-right"><h4 class="m-0">{{number_format($dr_total,2)}}</h4></td>
                                    <td class="border-0 text-right"><h4 class="m-0">{{number_format($cr_total,2)}}</h4></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-12">
                            <strong>Amount in words :</strong> @numberToWord(890)
                        </div>
                        <div class="row">
                            <div class="col-xl-3 col-md-3 col-sm-6">
                                <div class="p-5 text-center">
                                    <p class="font-size-11 mb-3">@if($vouchermaster->entry_by>0){{$vouchermaster->entryBy->name}}@endif<br>
                                        @if($vouchermaster->entry_by>0)(At: {{$vouchermaster->entry_at}}) @endif</p>
                                    <p style="text-decoration: overline;font-weight: bold; margin-top: -10px">Entry By</p>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-3 col-sm-6">
                                <div class="p-5 text-center">
                                    <p class="font-size-11 mb-3">@if($vouchermaster->checked_by>0) {{$vouchermaster->checkedBy->name}}@endif<br>
                                        @if($vouchermaster->checked_by>0) (At: {{$vouchermaster->checked_at}}) @endif</p>
                                    <p style="text-decoration: overline; font-weight: bold; margin-top: -10px">Checked By</p>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-3 col-sm-6">
                                <div class="p-5 text-center">
                                    <p class="font-size-11 mb-3">@if($vouchermaster->approved_by>0) {{$vouchermaster->approvedBy->name}} @endif<br>
                                        @if($vouchermaster->approved_by>0) (At: {{$vouchermaster->approved_at}}) @endif</p>
                                    <p style="text-decoration: overline; font-weight: bold; margin-top: -10px">Approved By</p>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-3 col-sm-6">
                                <div class="p-5 text-center">
                                    <p class="font-size-11 mb-3">@if($vouchermaster->audited_by>0) {{$vouchermaster->auditedBy->name}} @endif<br>
                                        @if($vouchermaster->audited_by>0) (At: {{$vouchermaster->audited_at}}) @endif</p>
                                    <p style="text-decoration: overline; font-weight: bold; margin-top: -10px">Audited By</p>
                                </div>
                            </div>
                        </div>
                        <div class="d-print-none">
                            <div class="float-left">
                                @if($vouchermaster->status!=='DELETED')
                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-1"><i class="fa fa-print"></i></a>
                                    <a href="{{route('acc.voucher.journal.download',['voucher_no' => $vouchermaster->voucher_no])}}" class="btn btn-primary waves-effect waves-light mr-1" title="Download this voucher"><i class="fa fa-download"></i></a>
                                @endif
                            </div>
                            <form action="{{route('acc.voucher.journal.status.update', ['voucher_no'=>$vouchermaster->voucher_no])}}" method="post">
                                @csrf
                                @if($vouchermaster->status=='UNCHECKED' && $voucherCheckingPermission)
                                    <input type="hidden" value="CHECKED" name="status">
                                    <input type="hidden" value="{{ Auth::user()->id }}" name="checked_by">
                                    <button type="submit" class="btn btn-info float-right ml-3" onclick="return window.confirm('Are you confirm?');"> <i class="fa fa-check-double"></i> Check & Forward</button>
                                    <button name="reject_while_checked" type="submit" class="btn btn-danger float-right ml-3" onclick="return window.confirm('Are you confirm?');"> <i class="fa fa-ban"></i> Reject & Back</button>
                                    <input type="text" name="remarks_while_checked" class="form-control col-md-6 float-right" placeholder="Enter a note for the voucher, if necessary"></td>

                                @elseif($vouchermaster->status=='CHECKED' && $voucherApprovingPermission)
                                    <input type="hidden" value="APPROVED" name="status">
                                    <input type="hidden" value="{{ Auth::user()->id }}" name="approved_by">
                                    <button type="submit" class="btn btn-primary float-right ml-3" onclick="return window.confirm('Are you confirm?');"> <i class="fa fa-check-double"></i> Approve & Forward</button>
                                    <button name="reject_while_approved" type="submit" class="btn btn-danger float-right ml-3" onclick="return window.confirm('Are you confirm?');"> <i class="fa fa-ban"></i> Reject & Back</button>
                                    <input type="text" name="remarks_while_approved" class="form-control col-md-6 float-right" placeholder="Enter a note for the voucher, if necessary"></td>

                                @elseif($vouchermaster->status=='APPROVED' && $voucherAuditingPermission)
                                    <input type="hidden" value="AUDITED" name="status">
                                    <input type="hidden" value="{{ Auth::user()->id }}" name="audited_by">
                                    <button type="submit" class="btn btn-success float-right ml-3" onclick="return window.confirm('Are you confirm?');"> <i class="fa fa-check-double"></i> Audit & Lock</button>
                                    <button name="reject_while_audited" type="submit" class="btn btn-danger float-right ml-3" onclick="return window.confirm('Are you confirm?');"> <i class="fa fa-ban"></i> Reject & Back</button>
                                    <input type="text" name="remarks_while_audited" class="form-control col-md-6 float-right" placeholder="Enter a note for the voucher, if necessary"></td>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
