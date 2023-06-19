@extends('layouts.app')

@section('title')
    @php($title='Vouchers View')
    {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}}</h4>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th style="width: 5%; text-align: center">#</th>
                                <th style="width: 5%; text-align: center">Voucher No</th>
                                <th>Date</th>
                                <th>Received From</th>
                                <th>Amount</th>
                                <th>Type</th>
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
                                            <input type="hidden" name="vouchertype" value="{{$voucherView->vouchertype}}">
                                            <a href="@if($voucherView->journal_type == 'receipt'){{route('acc.voucher.receipt.show',['voucher_no' => $voucherView->voucher_no])}}@elseif($voucherView->journal_type == 'payment'){{route('acc.voucher.payment.show',['voucher_no' => $voucherView->voucher_no])}}@elseif($voucherView->journal_type == 'journal'){{route('acc.voucher.journal.show',['voucher_no' => $voucherView->voucher_no])}}@elseif($voucherView->journal_type == 'contra'){{route('acc.voucher.contra.show',['voucher_no' => $voucherView->voucher_no])}}@elseif($voucherView->journal_type == 'bank-payment'){{route('acc.voucher.chequepayment.show',['voucher_no' => $voucherView->voucher_no])}}@endif" title="View Voucher" class="btn btn-primary btn-sm">
                                                <i class="fa fa-book-reader"></i>
                                            </a>
                                            @if($voucherView->status !== 'DELETED')
                                                <a href="@if($voucherView->journal_type == 'receipt'){{route('acc.voucher.receipt.download',['voucher_no' => $voucherView->voucher_no])}}@elseif($voucherView->journal_type == 'payment'){{route('acc.voucher.payment.download',['voucher_no' => $voucherView->voucher_no])}}@elseif($voucherView->journal_type == 'journal'){{route('acc.voucher.journal.download',['voucher_no' => $voucherView->voucher_no])}}@elseif($voucherView->journal_type == 'contra'){{route('acc.voucher.contra.download',['voucher_no' => $voucherView->voucher_no])}}@elseif($voucherView->journal_type == 'bank-payment'){{route('acc.voucher.chequepayment.download',['voucher_no' => $voucherView->voucher_no])}}@endif" title="Download Voucher as PDF" class="btn btn-secondary btn-sm">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                                @if($voucherView->status=='UNCHECKED' || $voucherView->status=='MANUAL')
                                                    @if($getVoucherDate<2)
                                                        <a href="@if($voucherView->journal_type == 'receipt')@if($voucherView->vouchertype=='single'){{route('acc.voucher.receipt.voucher.edit',['voucher_no' => $voucherView->voucher_no])}} @elseif($voucherView->vouchertype=='multiple') {{route('acc.voucher.receipt.voucher.editMultiple',['voucher_no' => $voucherView->voucher_no])}} @endif
                                                        @elseif($voucherView->journal_type == 'payment')
                                                        @if($voucherView->vouchertype=='single'){{route('acc.voucher.payment.voucher.edit',['voucher_no' => $voucherView->voucher_no])}} @elseif($voucherView->vouchertype=='multiple') {{route('acc.voucher.payment.voucher.editMultiple',['voucher_no' => $voucherView->voucher_no])}} @endif
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
@endsection



