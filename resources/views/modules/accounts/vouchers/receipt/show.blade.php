@extends('layouts.app')

@section('title')
    Voucher View
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-title">
                            <h1 class="font-size-20 text-center">International Consumer Products Bangladesh Limited<br>
                                <small class="font-size-10">Plot-43, Alam Arcade (4th Floor), Gulshan-2, Dhaka; PS; Dhaka-1212, Bangladesh
                                </small>
                            </h1>
                        </div>
                        <hr>
                        <h1 class="text-center text-uppercase">Receipt Voucher</h1>
                        <div class="row">

                            <div class="col-sm-6 mt-3">
                                <address>
                                    <strong>Voucher No:</strong><br>
                                    {{request('voucher_no')}}<br>
                                    <strong>Entry By:</strong><br>
                                    {{$vouchermaster->entryBy->name}}
                                </address>
                            </div>
                            <div class="col-sm-6 mt-3 text-sm-right">
                                <address>
                                    <strong>Voucher Date:</strong><br>
                                    {{$vouchermaster->voucher_date}}<br>
                                    <strong>Entry At:</strong><br>
                                    {{$vouchermaster->entry_at}}
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
                                    <th class="text-right">Debit</th>
                                    <th class="text-right">Credit</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($dr_total = 0)
                                @php($cr_total = 0)
                                @foreach($receipts as $receipt)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$receipt->ledgerforvoucher->ledger_name}}</td>
                                        <td>{{$receipt->narration}}</td>
                                        <td class="text-right">{{number_format($receipt->dr_amt,2)}}</td>
                                        <td class="text-right">{{number_format($receipt->cr_amt,2)}}</td>
                                    </tr>
                                    @php($dr_total = $dr_total +$receipt->dr_amt )
                                    @php($cr_total = $cr_total +$receipt->cr_amt )
                                @endforeach
                                <tr>
                                    <td colspan="3" class="border-0 text-right">
                                        <h4 class="m-0">Total</h4></td>
                                    <td class="border-0 text-right"><h4 class="m-0">{{number_format($dr_total,2)}}</h4></td>
                                    <td class="border-0 text-right"><h4 class="m-0">{{number_format($cr_total,2)}}</h4></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-print-none">
                            <div class="float-right">
                                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-1"><i class="fa fa-print"></i></a>
                                <a href="{{route('acc.voucher.receipt.download',['voucher_no' => $vouchermaster->voucher_no])}}" class="btn btn-primary waves-effect waves-light mr-1"><i class="fa fa-download"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
