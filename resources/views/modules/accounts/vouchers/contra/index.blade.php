@extends('layouts.app')

@section('title')
    @php($title='Contra Vouchers')
    {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}}
                            <a type="button" href="{{route('acc.voucher.contra.create')}}" class="btn btn-success" style="margin-left: 77.8%"><i class="mdi mdi-plus mr-1"></i> Create New</a></h4>
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
                            @foreach($contradatas as $contradata)
                                <tr>
                                    <td class="text-center" style="vertical-align: middle">{{$loop->iteration}}</td>
                                    <td style="vertical-align: middle">@if($contradata->status == 'DELETED')<del>{{$contradata->voucher_no}}</del> @else {{$contradata->voucher_no}} @endif</td>
                                    <td style="vertical-align: middle">{{$contradata->voucher_date}}</td>
                                    <td style="vertical-align: middle">@if($contradata->cash_bank_ledger) {{$contradata->accledger->ledger_name}} @else N/A @endif</td>
                                    <td class="text-right" style="vertical-align: middle">{{number_format($contradata->amount,2)}}</td>
                                    <td style="vertical-align: middle">{{$contradata->entryBy->name}}<br>
                                        At: {{$contradata->entry_at}}</td>
                                    <td style="vertical-align: middle">
                                        @if($contradata->status == 'UNCHECKED') <span class="badge badge-primary">UNCHECKED</span>
                                        @elseif($contradata->status == 'MANUAL') <span class="badge badge-soft-dark">MANUAL</span>
                                        @elseif($contradata->status == 'CHECKED') <span class="badge badge-info">CHECKED</span>
                                        @elseif($contradata->status == 'APPROVED') <span class="badge badge-warning">APPROVED</span>
                                        @elseif($contradata->status == 'AUDITED') <span class="badge badge-success">AUDITED</span>
                                        @elseif($contradata->status == 'DELETED') <span class="badge badge-danger"><del>DELETED</del></span>
                                        @elseif($contradata->status == 'REJECTED') <span class="badge badge-soft-danger">REJECTED</span>
                                        @endif
                                    </td>
                                    <td class="text-center" style="vertical-align: middle">
                                        @php($getVoucherDate=now()->diffInDays($contradata->created_at))
                                        <form action="{{route('acc.voucher.contra.voucher.destroy', ['voucher_no' => $contradata->voucher_no])}}" method="post">
                                            <input type="hidden" name="journal_type" value="{{$contradata->journal_type}}">
                                            <input type="hidden" name="voucher_type" value="{{$contradata->voucher_type}}">
                                            @csrf
                                            @if($contradata->status !== 'DELETED' && $contradata->status !== 'MANUAL')
                                                <a href="{{route('acc.voucher.contra.status',['voucher_no' => $contradata->voucher_no])}}" title="Voucher Status" class="btn btn-info btn-sm" target="_blank">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endif
                                            <a href="{{route('acc.voucher.contra.show',['voucher_no' => $contradata->voucher_no])}}" title="View Voucher" class="btn btn-primary btn-sm">
                                                <i class="fa fa-book-reader"></i>
                                            </a>
                                            @if($contradata->status !== 'DELETED')
                                                @if($contradata->status !== 'MANUAL')
                                                    <a href="{{route('acc.voucher.contra.download',['voucher_no' => $contradata->voucher_no])}}" title="Download Voucher as PDF" class="btn btn-secondary btn-sm">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                    <a href="{{route('acc.voucher.contra.print',['voucher_no' => $contradata->voucher_no])}}" title="Print" class="btn btn-pink btn-sm">
                                                        <i class="fa fa-print"></i>
                                                    </a>
                                                @endif
                                                @if($contradata->status=='UNCHECKED' || $contradata->status=='MANUAL' || $contradata->status=='REJECTED')
                                                    @if($getVoucherDate <= $checkVoucherEditAccessByCreatedPerson && $checkVoucherEditAccessByCreatedPerson>0)
                                                        <a href="@if($contradata->voucher_type=='single'){{route('acc.voucher.contra.voucher.edit',['voucher_no' => $contradata->voucher_no])}} @elseif($contradata->voucher_type=='multiple') {{route('acc.voucher.contra.voucher.editMultiple',['voucher_no' => $contradata->voucher_no])}} @endif" title="Update" class="btn btn-success btn-sm" onclick="return confirm('Are you confirm to edit?');">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you confirm to delete?');">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    @endif
                                                @endif
                                            @else
                                                @if($deletedVoucherRecoveryAccess>0 && $contradata->status !== 'MANUAL')
                                                    <button type="submit" name="recoveryDeletedPaymentVoucher" class="btn btn-success btn-sm" title="Undo Delete" onclick="return confirm('Are you confirm to recovery the deleted voucher?');">
                                                        <i class="fa fa-undo"></i>
                                                    </button>
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
