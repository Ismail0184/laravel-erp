@extends('layouts.app')

@section('title')
    @php($title='Payment Vouchers')
    {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}}
                            <a type="button" href="{{route('acc.voucher.payment.create')}}" class="btn btn-success" style="margin-left: 76.4%"><i class="mdi mdi-plus mr-1"></i> Create New</a></h4>
                        @if ($message = Session::get('destroy_message'))
                            <p class="text-center text-danger">{{ $message }}</p>
                        @elseif( $message = Session::get('store_message'))
                            <p class="text-center text-success">{{ $message }}</p>
                        @elseif( $message = Session::get('update_message'))
                            <p class="text-center text-primary">{{ $message }}</p>
                        @endif
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th style="width: 5%; text-align: center">#</th>
                                <th style="width: 5%; text-align: center">Voucher No</th>
                                <th>Date</th>
                                <th>Paid From</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 15%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paymntdatas as $paymntdata)
                                <tr>
                                    <td class="text-center" style="vertical-align: middle">{{$loop->iteration}}</td>
                                    <td style="vertical-align: middle">@if($paymntdata->status == 'DELETED')<del>{{$paymntdata->voucher_no}}</del> @else {{$paymntdata->voucher_no}} @endif</td>
                                    <td style="vertical-align: middle">{{$paymntdata->voucher_date}}</td>
                                    <td style="vertical-align: middle">@if($paymntdata->cash_bank_ledger) {{$paymntdata->accledger->ledger_name}} @else N/A @endif</td>
                                    <td class="text-right" style="vertical-align: middle">{{number_format($paymntdata->amount,2)}}</td>
                                    <td style="vertical-align: middle">
                                        @if($paymntdata->voucher_type == 'single') <span class="badge badge-soft-primary">Single</span>
                                        @elseif($paymntdata->voucher_type == 'multiple') <span class="badge badge-soft-info">Multiple</span>
                                        @endif
                                    </td>
                                    <td style="vertical-align: middle">
                                        @if($paymntdata->status == 'UNCHECKED') <span class="badge badge-soft-dark">UNCHECKED</span>
                                        @elseif($paymntdata->status == 'MANUAL') <span class="badge badge-soft-dark">MANUAL</span>
                                        @elseif($paymntdata->status == 'CHECKED') <span class="badge badge-info">CHECKED</span>
                                        @elseif($paymntdata->status == 'APPROVED') <span class="badge badge-warning">APPROVED</span>
                                        @elseif($paymntdata->status == 'AUDITED') <span class="badge badge-success">AUDITED</span>
                                        @elseif($paymntdata->status == 'DELETED') <span class="badge badge-danger"><del>DELETED</del></span>
                                        @elseif($paymntdata->status == 'REJECTED') <span class="badge badge-soft-danger">REJECTED</span>
                                        @endif
                                    </td>
                                    <td class="text-center" style="vertical-align: middle">
                                        @php($getVoucherDate=now()->diffInDays($paymntdata->created_at))
                                        <form action="{{route('acc.voucher.payment.voucher.destroy', ['voucher_no' => $paymntdata->voucher_no])}}" method="post">
                                            <input type="hidden" name="journal_type" value="{{$paymntdata->journal_type}}">
                                            <input type="hidden" name="voucher_type" value="{{$paymntdata->voucher_type}}">
                                            @csrf
                                            <a href="{{route('acc.voucher.payment.status',['voucher_no' => $paymntdata->voucher_no])}}" title="Voucher Status" class="btn btn-info btn-sm" target="_blank">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{route('acc.voucher.payment.show',['voucher_no' => $paymntdata->voucher_no])}}" title="View Voucher" class="btn btn-primary btn-sm">
                                                <i class="fa fa-book-reader"></i>
                                            </a>
                                            @if($paymntdata->status !== 'DELETED')
                                                <a href="{{route('acc.voucher.payment.download',['voucher_no' => $paymntdata->voucher_no])}}" title="Download Voucher as PDF" class="btn btn-secondary btn-sm">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                                <a href="{{route('acc.voucher.payment.print',['voucher_no' => $paymntdata->voucher_no])}}" title="Print" class="btn btn-pink btn-sm">
                                                    <i class="fa fa-print"></i>
                                                </a>
                                                @if($paymntdata->status=='UNCHECKED' || $paymntdata->status=='MANUAL' || $paymntdata->status=='REJECTED')
                                                    @if($getVoucherDate <= $checkVoucherEditAccessByCreatedPerson)
                                                        <a href="@if($paymntdata->voucher_type=='single'){{route('acc.voucher.payment.voucher.edit',['voucher_no' => $paymntdata->voucher_no])}} @elseif($paymntdata->voucher_type=='multiple') {{route('acc.voucher.payment.voucher.editMultiple',['voucher_no' => $paymntdata->voucher_no])}} @endif" title="Update" class="btn btn-success btn-sm" onclick="return confirm('Are you confirm to edit?');">
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



