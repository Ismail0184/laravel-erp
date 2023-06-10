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
                            <small class="font-size-11">Plot-43, Alam Arcade (4th Floor), Gulshan-2, Dhaka; PS; Dhaka-1212, Bangladesh
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
                                    Md Ismail Hossain
                                </address>
                            </div>
                            <div class="col-sm-6 mt-3 text-sm-right">
                                <address>
                                    <strong>Voucher Date:</strong><br>
                                    October 16, 2019<br>
                                    <strong>Entry At:</strong><br>
                                    October 16, 2019
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
                                <tr>
                                    <td>01</td>
                                    <td>Skote - Bootstrap 4 Admin Dashboard</td>
                                    <td></td>
                                    <td class="text-right">$499.00</td>
                                    <td class="text-right">$499.00</td>
                                </tr>
                                <tr>
                                    <td>02</td>
                                    <td>Skote - Bootstrap 4 Landing Template</td>
                                    <td class="text-right">$399.00</td>
                                </tr>
                                <tr>
                                    <td>03</td>
                                    <td>Veltrix - Bootstrap 4 Admin Template</td>
                                    <td class="text-right">$499.00</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-right">Sub Total</td>
                                    <td class="text-right">$1397.00</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="border-0 text-right">
                                        <strong>Shipping</strong></td>
                                    <td class="border-0 text-right">$13.00</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="border-0 text-right">
                                        <strong>Total</strong></td>
                                    <td class="border-0 text-right"><h4 class="m-0">$1410.00</h4></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-print-none">
                            <div class="float-right">
                                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-1"><i class="fa fa-print"></i></a>
                                            <a href="#" class="btn btn-primary w-md waves-effect waves-light">Send</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                </div>


@endsection
