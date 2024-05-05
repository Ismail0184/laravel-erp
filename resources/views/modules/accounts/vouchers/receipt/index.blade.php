@extends('layouts.app')

@section('title')
    @php($title='Receipt Vouchers')
    {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}}
                            <a type="button" href="{{route('acc.voucher.receipt.create')}}" class="btn btn-success" style="margin-left: 77.40%"><i class="mdi mdi-plus mr-1"></i> Create New</a></h4>
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
                                <th>Type</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 15%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($receiptdatas as $receiptdata)
                                <tr>
                                    <td class="text-center" style="vertical-align: middle">{{$loop->iteration}}</td>
                                    <td style="vertical-align: middle">@if($receiptdata->status == 'DELETED')<del>{{$receiptdata->voucher_no}}</del> @else {{$receiptdata->voucher_no}} @endif</td>
                                    <td style="vertical-align: middle">{{$receiptdata->voucher_date}}</td>
                                    <td style="vertical-align: middle">@if($receiptdata->cash_bank_ledger) {{$receiptdata->accledger->ledger_name}} @else N/A @endif</td>
                                    <td class="text-right" style="vertical-align: middle">{{number_format($receiptdata->amount,2)}}</td>
                                    <td style="vertical-align: middle">{{$receiptdata->entryBy->name}}<br>
                                    At: {{$receiptdata->entry_at}}</td>
                                    <td style="vertical-align: middle">
                                        @if($receiptdata->voucher_type == 'single') <span class="badge badge-soft-primary">Single</span>
                                        @elseif($receiptdata->voucher_type == 'multiple') <span class="badge badge-soft-danger">Multiple</span>
                                        @endif
                                    </td>
                                    <td style="vertical-align: middle">
                                        @if($receiptdata->status == 'UNCHECKED') <span class="badge badge-soft-dark">UNCHECKED</span>
                                        @elseif($receiptdata->status == 'MANUAL') <span class="badge badge-soft-dark">MANUAL</span>
                                        @elseif($receiptdata->status == 'CHECKED') <span class="badge badge-info">CHECKED</span>
                                        @elseif($receiptdata->status == 'APPROVED') <span class="badge badge-warning">APPROVED</span>
                                        @elseif($receiptdata->status == 'AUDITED') <span class="badge badge-success">AUDITED</span>
                                        @elseif($receiptdata->status == 'DELETED') <span class="badge badge-danger"><del>DELETED</del></span>
                                        @elseif($receiptdata->status == 'REJECTED') <span class="badge badge-soft-danger">REJECTED</span>
                                        @endif
                                    </td>
                                    <td class="text-center" style="vertical-align: middle">
                                        @php($getVoucherDate=now()->diffInDays($receiptdata->created_at))
                                        <form action="{{route('acc.voucher.receipt.voucher.destroy', ['voucher_no' => $receiptdata->voucher_no])}}" method="post">
                                            @csrf
                                            <input type="hidden" name="journal_type" value="{{$receiptdata->journal_type}}">
                                            <input type="hidden" name="voucher_type" value="{{$receiptdata->voucher_type}}">
                                            <a href="{{route('acc.voucher.receipt.status',['voucher_no' => $receiptdata->voucher_no])}}" title="Voucher Status" class="btn btn-info btn-sm" target="_blank">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{route('acc.voucher.receipt.show',['voucher_no' => $receiptdata->voucher_no])}}" title="View Voucher" class="btn btn-primary btn-sm">
                                                <i class="fa fa-book-reader"></i>
                                            </a>
                                            @if($receiptdata->status !== 'DELETED')
                                            <a href="{{route('acc.voucher.receipt.download',['voucher_no' => $receiptdata->voucher_no])}}" title="Download Voucher as PDF" class="btn btn-secondary btn-sm">
                                                <i class="fa fa-download"></i>
                                            </a>
                                            <a href="{{route('acc.voucher.receipt.print',['voucher_no' => $receiptdata->voucher_no])}}" title="Print" class="btn btn-pink btn-sm">
                                                <i class="fa fa-print"></i>
                                            </a>

                                                @if($receiptdata->status=='UNCHECKED' || $receiptdata->status=='MANUAL')
                                                @if($getVoucherDate <= $checkVoucherEditAccessByCreatedPerson)
                                            <a href="@if($receiptdata->voucher_type=='single'){{route('acc.voucher.receipt.voucher.edit',['voucher_no' => $receiptdata->voucher_no])}} @elseif($receiptdata->voucher_type=='multiple') {{route('acc.voucher.receipt.voucher.editMultiple',['voucher_no' => $receiptdata->voucher_no])}} @endif" title="Update" class="btn btn-success btn-sm" onclick="return confirm('Are you confirm to edit?');">
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



