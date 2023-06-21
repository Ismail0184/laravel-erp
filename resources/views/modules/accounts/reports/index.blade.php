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
                            <select class="form-control" style="border: none; overflow: hidden" size="50" name="report_id" onchange="reloadPage(this)">
                                @foreach($reportgroups as $group)
                                    <optgroup label="{{$group->optgroup_label_name}}"></optgroup>
                                    @foreach($group->reports as $report)
                                    <option value="{{$report->report_id}}" @if(request('report_id')==$report->report_id) selected @endif>{{$report->report_name}}</option>
                                    @endforeach
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
                        </li><small class="text-danger float-right">field marked with * are mandatory</small>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content p-3">
                        <div class="tab-pane active" id="all-order" role="tabpanel">
                            <form method="post" action="{{route('acc.voucher.filter')}}" style="font-size: 11px">
                                @csrf
                                <div class="row">
                                    @if(request('report_id')=='1001001')
                                        <div class="col-xl col-sm-6">
                                            <div class="form-group mt-3 mb-0">
                                                <label>Status</label>
                                                <select class="form-control select2-search-disable" name="status">
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                    <option value="suspended">Suspended</option>
                                                    <option value="deleted">Deleted</option>
                                                </select>
                                            </div>
                                        </div>
                                    @elseif(request('report_id')=='1001002')
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
                                            <label>Voucher No</label>
                                            <input type="text" class="form-control" name="voucher_no" value="{{ request('voucher_no') ? request('voucher_no') : '' }}">
                                        </div>
                                    </div>

                                    @endif
                                    @if(request('report_id')>0)
                                        <br>
                                    <div class="col-xl col-sm-6 align-self-end">
                                        <div class="mt-3">
                                            <a href="{{route('acc.select.report')}}" class="btn btn-danger w-md">Cancel</a>
                                            <button type="submit" class="btn btn-primary w-md">Report Generate</button>
                                        </div>
                                    </div>
                                        @else
                                            <div class="alert alert-danger float-right col-sm-5" role="alert" style="font-size: 11px">
                                                Please select a report from left !!
                                            </div>
                                        @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function reloadPage(selectElement) {
        var selectedValue = selectElement.value;
        window.location.href = "/accounts/select-accounts-report/report_id/" + selectedValue;
    }
</script>
