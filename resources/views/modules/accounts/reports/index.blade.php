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
                        </li>
                        <small class="text-danger" style="margin-left: 400px">field marked with * are mandatory</small>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-3">
                        <div class="tab-pane active" id="all-order" role="tabpanel">
                            <form method="post" target="_blank" action="@if(request('report_id')>0){{route('acc.generatereport',['report_id'=>request('report_id')])}}@endif" style="font-size: 11px">
                                @csrf
                                    @if(request('report_id')=='1001001' || request('report_id')=='1001002')
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Status <span class="required text-danger">*</span></label>
                                                <select class="form-control select2-search-disable" name="status">
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                    <option value="suspended">Suspended</option>
                                                    <option value="deleted">Deleted</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @elseif(request('report_id')=='1002001')
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Accounts Head / Ledger <span class="required text-danger">*</span></label>
                                                <select class="form-control select2" name="ledger_id" required>
                                                    <option value="%">All Transactions</option>
                                                    @foreach($ledgers as $ledger)
                                                        <option value="{{$ledger->ledger_id}}">{{$ledger->ledger_id}} : {{$ledger->ledger_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Cost Center</label>
                                                <select class="form-control select2" name="cc_code" >
                                                    <option value="%"></option>
                                                    @foreach($costcenters as $costcenter)
                                                        <option value="{{$costcenter->cc_code}}">{{$costcenter->cc_code}} : {{$costcenter->center_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                                <label>Date from <span class="required text-danger">*</span> </label>
                                                <input type="date" class="form-control" required name="f_date" value="{{ request('f_date') ? request('f_date') : '' }}">
                                        </div>
                                        <div class="col-md-4">
                                                <label>Date to <span class="required text-danger">*</span></label>
                                                <input type="date" class="form-control" required name="t_date" value="{{ request('t_date') ? request('t_date') : '' }}">
                                        </div>
                                    </div>

                                @elseif(request('report_id')=='1004001')
                                        <div class="col-md-6">
                                            <label>As on <span class="required text-danger">*</span></label>
                                            <input type="date" class="form-control" required name="t_date" value="{{ request('t_date') ? request('t_date') : '' }}">
                                        </div>
                                    </div>
                                @endif

                                @if(request('report_id')>0)
                                    <hr>
                                    <div class="row">
                                        <div class="col-xl col-sm-6 align-self-end">
                                            <div class="mt-3">
                                                <a href="{{route('acc.select.report')}}" class="btn btn-danger w-md">Cancel</a>
                                                <button type="submit" class="btn btn-success w-md">Report Generate</button>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="alert alert-danger float-right col-sm-12" role="alert" style="font-size: 11px">
                                            Please select a report from left !!
                                        </div>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function reloadPage(selectElement) {
            var selectedValue = selectElement.value;
            window.location.href = "/accounts/select-accounts-report/report_id/" + selectedValue;
        }
    </script>
@endsection

