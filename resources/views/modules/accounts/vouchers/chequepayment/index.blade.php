@extends('layouts.app')

@section('title')
    @php($title='Cheque Payment Vouchers')
    {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}}
                            <a type="button" href="{{route('acc.voucher.chequepayment.create')}}" class="btn btn-success" style="margin-left: 70.5%"><i class="mdi mdi-plus mr-1"></i> Create New</a></h4>
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
                                <th>Received From</th>
                                <th>Amount</th>
                                <th>Entry By</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 15%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cpaymntdatas as $cpaymntdata)
                                <tr>
                                    <td class="text-center" style="vertical-align: middle">{{$loop->iteration}}</td>
                                    <td style="vertical-align: middle">@if($cpaymntdata->status == 'DELETED')<del>{{$cpaymntdata->voucher_no}}</del> @else {{$cpaymntdata->voucher_no}} @endif</td>
                                    <td style="vertical-align: middle">{{$cpaymntdata->voucher_date}}</td>
                                    <td style="vertical-align: middle">@if($cpaymntdata->cash_bank_ledger) {{$cpaymntdata->accledger->ledger_name}} @else N/A @endif</td>
                                    <td class="text-right" style="vertical-align: middle">{{number_format($cpaymntdata->amount,2)}}</td>
                                    <td style="vertical-align: middle">{{$cpaymntdata->entryBy->name}}<br>
                                        At: {{$cpaymntdata->entry_at}}</td>
                                    <td style="vertical-align: middle">
                                        @if($cpaymntdata->status == 'UNCHECKED') <span class="badge badge-soft-dark">UNCHECKED</span>
                                        @elseif($cpaymntdata->status == 'MANUAL') <span class="badge badge-soft-dark">MANUAL</span>
                                        @elseif($cpaymntdata->status == 'CHECKED') <span class="badge badge-info">CHECKED</span>
                                        @elseif($cpaymntdata->status == 'APPROVED') <span class="badge badge-warning">APPROVED</span>
                                        @elseif($cpaymntdata->status == 'AUDITED') <span class="badge badge-success">AUDITED</span>
                                        @elseif($cpaymntdata->status == 'DELETED') <span class="badge badge-danger"><del>DELETED</del></span>
                                        @endif
                                    </td>
                                    <td class="text-center" style="vertical-align: middle">
                                        @php($getVoucherDate=now()->diffInDays($cpaymntdata->created_at))
                                        <form action="{{route('acc.voucher.chequepayment.voucher.destroy', ['voucher_no' => $cpaymntdata->voucher_no])}}" method="post">
                                            <input type="hidden" name="journal_type" value="{{$cpaymntdata->journal_type}}">
                                            <input type="hidden" name="vouchertype" value="{{$cpaymntdata->vouchertype}}">
                                            @csrf
                                            <a href="{{route('acc.voucher.chequepayment.show',['voucher_no' => $cpaymntdata->voucher_no])}}" title="View Voucher" class="btn btn-primary btn-sm">
                                                <i class="fa fa-book-reader"></i>
                                            </a>
                                            @if($cpaymntdata->status !== 'DELETED')
                                                <a href="{{route('acc.voucher.chequepayment.download',['voucher_no' => $cpaymntdata->voucher_no])}}" title="Download Voucher as PDF" class="btn btn-secondary btn-sm">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                                @if($cpaymntdata->status=='UNCHECKED' || $cpaymntdata->status=='MANUAL')
                                                    @if($getVoucherDate<2)
                                                        <a href="@if($cpaymntdata->vouchertype=='single'){{route('acc.voucher.chequepayment.voucher.edit',['voucher_no' => $cpaymntdata->voucher_no])}} @elseif($cpaymntdata->vouchertype=='multiple') {{route('acc.voucher.payment.voucher.editMultiple',['voucher_no' => $cpaymntdata->voucher_no])}} @endif" title="Update" class="btn btn-success btn-sm" onclick="return confirm('Are you confirm to edit?');">
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



