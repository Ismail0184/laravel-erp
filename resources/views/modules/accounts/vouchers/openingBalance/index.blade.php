@extends('layouts.app')

@section('title')
    @php($title='Accounts Opening Balance Entries')
    {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}}
                            <a type="button" href="{{route('acc.voucher.openingBalance.create')}}" class="btn btn-success" style="margin-left: 65.7%"><i class="mdi mdi-plus mr-1"></i> Create New</a></h4>
                        @if ($message = Session::get('destroy_message'))
                            <p class="text-center text-danger">{{ $message }}</p>
                        @elseif( $message = Session::get('store_message'))
                            <p class="text-center text-success">{{ $message }}</p>
                        @elseif( $message = Session::get('recovery_message'))
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
                                <th>Person</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 15%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($journaldatas as $journaldata)
                                <tr>
                                    <td class="text-center" style="vertical-align: middle">{{$loop->iteration}}</td>
                                    <td style="vertical-align: middle">@if($journaldata->status == 'DELETED')<del>{{$journaldata->voucher_no}}</del> @else {{$journaldata->voucher_no}} @endif</td>
                                    <td style="vertical-align: middle">{{$journaldata->voucher_date}}</td>
                                    <td style="vertical-align: middle">@if($journaldata->cash_bank_ledger) {{$journaldata->accledger->ledger_name}} @else N/A @endif</td>
                                    <td style="vertical-align: middle">
                                        @if($journaldata->status == 'UNCHECKED') <span class="badge badge-primary">UNCHECKED</span>
                                        @elseif($journaldata->status == 'MANUAL') <span class="badge badge-soft-dark">MANUAL</span>
                                        @elseif($journaldata->status == 'CHECKED') <span class="badge badge-info">CHECKED</span>
                                        @elseif($journaldata->status == 'APPROVED') <span class="badge badge-warning">APPROVED</span>
                                        @elseif($journaldata->status == 'AUDITED') <span class="badge badge-success">AUDITED</span>
                                        @elseif($journaldata->status == 'DELETED') <span class="badge badge-danger"><del>DELETED</del></span>
                                        @elseif($journaldata->status == 'REJECTED') <span class="badge badge-soft-danger">REJECTED</span>
                                        @endif
                                    </td>
                                    <td class="text-center" style="vertical-align: middle">
                                        @php($getVoucherDate=now()->diffInDays($journaldata->created_at))
                                        <form action="{{route('acc.voucher.journal.voucher.destroy', ['voucher_no' => $journaldata->voucher_no])}}" method="post">
                                            @csrf
                                            <input type="hidden" name="journal_type" value="{{$journaldata->journal_type}}">
                                            <input type="hidden" name="voucher_type" value="{{$journaldata->voucher_type}}">
                                            @if($journaldata->status !== 'DELETED' && $journaldata->status !== 'MANUAL')
                                                <a href="{{route('acc.voucher.journal.status',['voucher_no' => $journaldata->voucher_no])}}" title="Voucher Status" class="btn btn-info btn-sm" target="_blank">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endif
                                            <a href="{{route('acc.voucher.journal.show',['voucher_no' => $journaldata->voucher_no])}}" title="View Voucher" class="btn btn-primary btn-sm">
                                                <i class="fa fa-book-reader"></i>
                                            </a>
                                            @if($journaldata->status !== 'DELETED')
                                                @if($journaldata->status !== 'MANUAL')
                                                    <a href="{{route('acc.voucher.journal.download',['voucher_no' => $journaldata->voucher_no])}}" title="Download Voucher as PDF" class="btn btn-secondary btn-sm">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                    <a href="{{route('acc.voucher.journal.print',['voucher_no' => $journaldata->voucher_no])}}" title="Print" class="btn btn-pink btn-sm">
                                                        <i class="fa fa-print"></i>
                                                    </a>
                                                @endif
                                                @if($journaldata->status=='UNCHECKED' || $journaldata->status=='MANUAL' || $journaldata->status=='REJECTED')
                                                    @if($getVoucherDate <= $checkVoucherEditAccessByCreatedPerson && $checkVoucherEditAccessByCreatedPerson>0)
                                                        <a href="{{route('acc.voucher.journal.voucher.edit',['voucher_no' => $journaldata->voucher_no])}}" title="Update" class="btn btn-success btn-sm" onclick="return confirm('Are you confirm to edit?');">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you confirm to delete?');">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    @endif
                                                @endif
                                            @else
                                                @if($deletedVoucherRecoveryAccess>0)
                                                    <button type="submit" name="recoveryDeletedJournalVoucher" class="btn btn-success btn-sm" title="Undo Delete" onclick="return confirm('Are you confirm to recovery the deleted voucher?');">
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
