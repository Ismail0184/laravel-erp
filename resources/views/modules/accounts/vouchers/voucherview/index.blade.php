@extends('layouts.app')
@section('title')
    @php($title='Vouchers View')
    {{$title}}
@endsection

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">{{$title}}</h4>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#all-order" role="tab">
                                Search Specific Voucher
                            </a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content p-3">
                        <div class="tab-pane active" id="all-order" role="tabpanel">
                            <form method="post" action="{{route('acc.voucher.filter')}}" style="font-size: 11px">
                                @csrf
                                <div class="row">
                                    <div class="col-xl col-sm-6">
                                        <div class="form-group mt-3 mb-0">
                                            <label>From Date</label>
                                            <input type="date" class="form-control" name="f_date" value="{{ request('f_date') ? request('f_date') : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-xl col-sm-6">
                                        <div class="form-group mt-3 mb-0">
                                            <label>To Date</label>
                                            <input type="date" class="form-control" name="t_date" value="{{ request('t_date') ? request('t_date') : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-xl col-sm-6">
                                        <div class="form-group mt-3 mb-0">
                                            <label>Type</label>
                                            <select class="form-control select2-search-disable" name="journal_type">
                                                <option value="" selected>All</option>
                                                <option value="receipt" @if(request('journal_type')=='receipt') selected @endif >Receipt</option>
                                                <option value="payment" @if(request('journal_type')=='payment') selected @endif >Payment</option>
                                                <option value="journal" @if(request('journal_type')=='journal') selected @endif >Journal</option>
                                                <option value="contra" @if(request('journal_type')=='contra') selected @endif >Contra</option>
                                                <option value="bank-payment" @if(request('journal_type')=='bank-payment') selected @endif >Cheque Payment</option>
                                                <option value="purchase" @if(request('journal_type')=='purchase') selected @endif >Purchase</option>
                                                <option value="sales" @if(request('journal_type')=='sales') selected @endif >Sales</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl col-sm-6">
                                        <div class="form-group mt-3 mb-0">
                                            <label>Status</label>
                                            <select class="form-control select2-search-disable" name="status">
                                                <option value="" selected>All</option>
                                                <option value="UNCHECKED" @if(request('status')=='UNCHECKED') selected @endif >UNCHECKED</option>
                                                <option value="CHECKED" @if(request('status')=='CHECKED') selected @endif >CHECKED</option>
                                                <option value="APPROVED" @if(request('status')=='APPROVED') selected @endif >APPROVED</option>
                                                <option value="AUDITED" @if(request('status')=='AUDITED') selected @endif >AUDITED</option>
                                                <option value="DELETED" @if(request('status')=='DELETED') selected @endif >DELETED</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl col-sm-6">
                                        <div class="form-group mt-3 mb-0">
                                            <label>Voucher No</label>
                                            <input type="text" class="form-control" name="voucher_no" value="{{ request('voucher_no') ? request('voucher_no') : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-xl col-sm-6 align-self-end">
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-success w-md">View Vouchers</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th style="width: 5%; text-align: center">#</th>
                                <th style="width: 5%; text-align: center">Voucher No</th>
                                <th>Date</th>
                                <th>Received From</th>
                                <th>Amount</th>
                                <th>V.Type</th>
                                <th>J.Type</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 15%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($voucherViews as $voucherView)
                                <tr>
                                    <td class="text-center" style="vertical-align: middle">{{$loop->iteration}}</td>
                                    <td style="vertical-align: middle">@if($voucherView->status == 'DELETED')<del>{{$voucherView->voucher_no}}</del> @else {{$voucherView->voucher_no}} @endif</td>
                                    <td style="vertical-align: middle">{{$voucherView->voucher_date}}</td>
                                    <td style="vertical-align: middle">@if($voucherView->cash_bank_ledger) {{$voucherView->accledger->ledger_name}} @else N/A @endif</td>
                                    <td class="text-right" style="vertical-align: middle">{{number_format($voucherView->amount,2)}}</td>
                                    <td style="vertical-align: middle">
                                        @if($voucherView->voucher_type == 'single') <span class="badge badge-soft-primary">Single</span>
                                        @elseif($voucherView->voucher_type == 'multiple') <span class="badge badge-soft-danger">Multiple</span>
                                        @endif
                                    </td>
                                    <td style="vertical-align: middle">
                                        @if($voucherView->journal_type == 'receipt') <span class="badge badge-success">Receipt</span>
                                        @elseif($voucherView->journal_type == 'payment') <span class="badge badge-danger">Payment</span>
                                        @elseif($voucherView->journal_type == 'contra') <span class="badge badge-warning">Contra</span>
                                        @elseif($voucherView->journal_type == 'journal') <span class="badge badge-pink">Journal</span>
                                        @elseif($voucherView->journal_type == 'AUDITED') <span class="badge badge-pill">Bank Payment</span>
                                        @else($voucherView->journal_type == 'DELETED') <span class="badge badge-secondary">Others</span>
                                        @endif
                                    </td>
                                    </td>
                                    <td style="vertical-align: middle">
                                        @if($voucherView->status == 'UNCHECKED') <span class="badge badge-soft-dark">UNCHECKED</span>
                                        @elseif($voucherView->status == 'MANUAL') <span class="badge badge-soft-dark">MANUAL</span>
                                        @elseif($voucherView->status == 'CHECKED') <span class="badge badge-info">CHECKED</span>
                                        @elseif($voucherView->status == 'APPROVED') <span class="badge badge-warning">APPROVED</span>
                                        @elseif($voucherView->status == 'AUDITED') <span class="badge badge-success">AUDITED</span>
                                        @elseif($voucherView->status == 'DELETED') <span class="badge badge-danger"><del>DELETED</del></span>
                                        @endif
                                    </td>
                                    <td class="text-center" style="vertical-align: middle">
                                        @php($getVoucherDate=now()->diffInDays($voucherView->created_at))
                                        <form action="{{route('acc.voucher.receipt.voucher.destroy', ['voucher_no' => $voucherView->voucher_no])}}" method="post">
                                            @csrf
                                            <input type="hidden" name="journal_type" value="{{$voucherView->journal_type}}">
                                            <input type="hidden" name="voucher_type" value="{{$voucherView->voucher_type}}">
                                            <a target="_blank" href="@if($voucherView->journal_type == 'receipt'){{route('acc.voucher.receipt.show',['voucher_no' => $voucherView->voucher_no])}}@elseif($voucherView->journal_type == 'payment'){{route('acc.voucher.payment.show',['voucher_no' => $voucherView->voucher_no])}}@elseif($voucherView->journal_type == 'journal'){{route('acc.voucher.journal.show',['voucher_no' => $voucherView->voucher_no])}}@elseif($voucherView->journal_type == 'contra'){{route('acc.voucher.contra.show',['voucher_no' => $voucherView->voucher_no])}}@elseif($voucherView->journal_type == 'bank-payment'){{route('acc.voucher.chequepayment.show',['voucher_no' => $voucherView->voucher_no])}}@endif" title="View Voucher" class="btn btn-primary btn-sm">
                                                <i class="fa fa-book-reader"></i>
                                            </a>
                                            @if($voucherView->status !== 'DELETED')
                                                <a target="_blank" href="@if($voucherView->journal_type == 'receipt'){{route('acc.voucher.receipt.download',['voucher_no' => $voucherView->voucher_no])}}@elseif($voucherView->journal_type == 'payment'){{route('acc.voucher.payment.download',['voucher_no' => $voucherView->voucher_no])}}@elseif($voucherView->journal_type == 'journal'){{route('acc.voucher.journal.download',['voucher_no' => $voucherView->voucher_no])}}@elseif($voucherView->journal_type == 'contra'){{route('acc.voucher.contra.download',['voucher_no' => $voucherView->voucher_no])}}@elseif($voucherView->journal_type == 'bank-payment'){{route('acc.voucher.chequepayment.download',['voucher_no' => $voucherView->voucher_no])}}@endif" title="Download Voucher as PDF" class="btn btn-secondary btn-sm">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                                @if($voucherView->status=='UNCHECKED' || $voucherView->status=='MANUAL')
                                                    @if($getVoucherDate<2)
                                                        <a target="_blank" href="@if($voucherView->journal_type == 'receipt')@if($voucherView->voucher_type=='single'){{route('acc.voucher.receipt.voucher.edit',['voucher_no' => $voucherView->voucher_no])}} @elseif($voucherView->voucher_type=='multiple') {{route('acc.voucher.receipt.voucher.editMultiple',['voucher_no' => $voucherView->voucher_no])}} @endif
                                                        @elseif($voucherView->journal_type == 'payment')
                                                        @if($voucherView->voucher_type=='single'){{route('acc.voucher.payment.voucher.edit',['voucher_no' => $voucherView->voucher_no])}} @elseif($voucherView->voucher_type=='multiple') {{route('acc.voucher.payment.voucher.editMultiple',['voucher_no' => $voucherView->voucher_no])}} @endif
                                                        @elseif($voucherView->journal_type == 'journal')
                                                        {{route('acc.voucher.journal.voucher.edit',['voucher_no' => $voucherView->voucher_no])}}
                                                        @elseif($voucherView->journal_type == 'contra')
                                                        {{route('acc.voucher.contra.voucher.edit',['voucher_no' => $voucherView->voucher_no])}}
                                                        @elseif($voucherView->journal_type == 'bank-payment')
                                                        {{route('acc.voucher.chequepayment.voucher.edit',['voucher_no' => $voucherView->voucher_no])}}
                                                        @endif" title="Update" class="btn btn-success btn-sm" onclick="return confirm('Are you confirm to edit?');">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you confirm to delete?');">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    @endif
                                                @endif
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
