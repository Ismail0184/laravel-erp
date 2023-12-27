@extends('layouts.app')

@section('title')
    @php($title = 'Leave Requests') {{$title}}
@endsection

@section('body')




    <div class="container-fluid">
        <div class="row collapse" id="experience2">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#all-order" role="tab">
                                    Search Leave Applications
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
                                                <select class="form-control select2" name="journal_type">
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

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}} <span class="float-right" data-toggle="collapse" data-target="#experience2">Filter <i class="fa fa-filter"></i></span></h4>
                        @if ($message = Session::get('rejected_message'))
                            <p class="text-center text-danger">{{ $message }}</p>
                        @elseif( $message = Session::get('granted_message'))
                            <p class="text-center text-success">{{ $message }}</p>
                        @endif
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th style="width: 5%; text-align: center">#</th>
                                <th style="width: 5%; text-align: center">A.ID</th>
                                <th>Date</th>
                                <th>Applied By</th>
                                <th>Total Days</th>
                                <th>Remarks</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 10%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($leaveApplications as $leaveApplication)
                                <tr>
                                    <td style="text-align: center; vertical-align: middle">{{$loop->iteration}}</td>
                                    <td style="text-align: center; vertical-align: middle">{{$leaveApplication->id}}</td>
                                    <td style="text-align: left; vertical-align: middle">{{$leaveApplication->created_at}}</td>
                                    <td style="vertical-align: middle">{{$leaveApplication->AppliedBy->name}}</td>
                                    <td style="vertical-align: middle">{{$leaveApplication->total_days}}</td>
                                    <td style="vertical-align: middle">{{$leaveApplication->reason}}</td>
                                    <td style="vertical-align: middle">
                                        @if($leaveApplication->status == 'GRANTED') <span class="badge badge-success">GRANTED</span>
                                        @elseif($leaveApplication->status == 'DELETED') <span class="badge badge-soft-danger">DELETED</span>
                                        @elseif($leaveApplication->status == 'REJECTED') <span class="badge badge-danger">REJECTED</span>
                                        @elseif($leaveApplication->status == 'DRAFTED') <span class="badge badge-dark">DRAFTED</span>
                                        @elseif($leaveApplication->status == 'PENDING') <span class="badge badge-soft-dark">PENDING</span>
                                        @elseif($leaveApplication->status == 'APPROVED') <span class="badge badge-pink">APPROVED</span>
                                        @elseif($leaveApplication->status == 'RECOMMENDED') <span class="badge badge-soft-success">RECOMMENDED</span>
                                        @endif
                                    </td>
                                    <td class="text-center" style="vertical-align: middle">
                                        <a href="{{route('hrm.attendance.leave.show',['id' => $leaveApplication->id])}}" title="show" class="btn btn-primary btn-sm">
                                            <i class="fa fa-book-reader"></i>
                                        </a>
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
