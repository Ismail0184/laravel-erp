@extends('layouts.app')

@section('title')
    @php($title='Select a report') {{$title}}
@endsection

@section('body')
    <div class="row">

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="col-xl col-sm-6">
                        <div class="form-group mt-3 mb-0">
                            <select class="form-control" style="border: none; overflow: hidden" size="30" name="journal_type">
                                @foreach($reports as $report)
                                <option value=""></option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#all-order" role="tab">
                                filter options
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
@endsection
