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
                            <a type="button" href="{{route('acc.voucher.receipt.create')}}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2" style="margin-left: 76.50%"><i class="mdi mdi-plus mr-1"></i> Create New</a></h4>
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
                            @foreach($receiptdatas as $receiptdata)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$receiptdata->voucher_no}}</td>
                                    <td>{{$receiptdata->voucher_date}}</td>
                                    <td>{{$receiptdata->accledger->ledger_name}}</td>
                                    <td class="text-right">{{number_format($receiptdata->amount,2)}}</td>
                                    <td>{{$receiptdata->entryBy->name}}<br>
                                    At: {{$receiptdata->entry_at}}</td>
                                    <td>@if($receiptdata->status == 'UNCHECKED') <span class="badge badge-soft-dark">UNCHECKED</span> @elseif($ledger->status == '0') <span class="badge badge-danger">Inactive</span> @endif</td>
                                    <td class="text-center">
                                        <form action="{{route('acc.voucher.receipt.view', ['ledger_id' => $receiptdata->ledger_id])}}" method="post">
                                            @csrf
                                            <a href="{{route('acc.voucher.receipt.view',['ledger_id' => $receiptdata->ledger_id])}}" title="View" class="btn btn-primary btn-sm">
                                                <i class="fa fa-book"></i>
                                            </a>
                                            <a href="{{route('acc.voucher.receipt.view',['ledger_id' => $receiptdata->ledger_id])}}" title="Update" class="btn btn-success btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you confirm to delete?');">
                                                <i class="fa fa-trash"></i>
                                            </button>
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



