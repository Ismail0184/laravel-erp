@extends('layouts.app')

@section('title')
    @php($title='Voucher Status') {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if($voucherMaster->entry_by == Auth::user()->id)
                        <br>
                        <div class="card-title text-center"><h4 style="text-decoration: underline">Voucher Status</h4></div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th style="width: 20%">Voucher No</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$voucherMaster->voucher_no}}</td>
                                    <th style="width: 20%">Voucher Date</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$voucherMaster->voucher_date}}</td>
                                </tr>
                                <tr>
                                    <th>Paid From</th>
                                    <th>:</th>
                                    <td>{{$voucherMaster->person}}</td>
                                    <th>Time</th>
                                    <th>:</th>
                                    <td>{{$voucherMaster->departure_time}}</td>
                                </tr>
                            </table>

                            <table class="table" style="width: 100%">
                                <tr class="text-center @if($voucherMaster->checked_status=='CHECKED') bg-soft-success @elseif($voucherMaster->checked_status=='REJECTED') bg-danger @else  bg-soft-danger @endif text-black"><th colspan="9">Checked Status</th></tr>
                                <tr>
                                    <th style="width: 15%">Person</th>
                                    <th style="width: 1%">:</th>
                                    <td style="width: 15%">
                                        @if($voucherMaster->checked_by>0)
                                            {{$voucherMaster->checkedBy->name}}
                                        @else
                                            Don't know yet.
                                        @endif
                                    </td>

                                    <th style="width: 10%">View Status</th>
                                    <th style="width: 1%">:</th>
                                    <td style="width: 15%">
                                        @empty($voucherMaster->checker_person_viewed_at)
                                            <span class="badge badge-danger">PENDING</span>
                                        @else
                                            <span class="badge badge-success">Viewed</span>
                                        @endempty
                                    </td>

                                    <th style="width: 10%">Viewed At</th>
                                    <th style="width: 1%">:</th>
                                    <td>
                                        @empty($voucherMaster->checker_person_viewed_at)
                                            <span class="badge badge-danger">PENDING</span>
                                        @else
                                            {{$voucherMaster->checker_person_viewed_at}}
                                        @endempty
                                    </td>
                                <tr/>
                                <tr>
                                    <th>Checked Status</th>
                                    <th style="width: 1%">:</th>
                                    <td>
                                        @if($voucherMaster->checked_status == 'REJECTED') <span class="badge badge-soft-danger">REJECTED</span>
                                        @elseif($voucherMaster->checked_status == 'PENDING') <span class="badge badge-danger">PENDING</span>
                                        @elseif($voucherMaster->checked_status == 'CHECKED') <span class="badge badge-success">CHECKED</span>
                                        @endif
                                    </td>

                                    <th>Checked At</th>
                                    <th style="width: 1%">:</th>
                                    <td>@empty($voucherMaster->checked_at)
                                            <span class="badge badge-danger">PENDING</span>
                                        @else {{$voucherMaster->checked_at}} @endempty</td>


                                    <th>Remarks</th>
                                    <th style="width: 1%">:</th>
                                    <td style="width: 25%">@empty($voucherMaster->remarks_while_checked) - @else {{$voucherMaster->remarks_while_checked}} @endempty</td>
                                </tr>
                            </table>

                            <table class="table" style="width: 100%">
                                <tr class="text-center @if($voucherMaster->approved_status=='APPROVED') bg-soft-success @elseif($voucherMaster->approved_status=='REJECTED') bg-danger @else  bg-soft-danger @endif text-black"><th colspan="9">Approved Status</th></tr>
                                <tr>
                                    <th style="width: 15%">Person</th>
                                    <th style="width: 1%">:</th>
                                    <td style="width: 15%">
                                        @if($voucherMaster->approved_by>0)
                                            {{$voucherMaster->approvedBy->name}}
                                        @else
                                            Don't know yet.
                                        @endif
                                    </td>
                                    <th style="width: 10%">View Status</th>
                                    <th style="width: 1%">:</th>
                                    <td style="width: 15%">
                                        @empty($voucherMaster->approving_person_viewed_at)
                                            <span class="badge badge-danger">PENDING</span>
                                        @else
                                            <span class="badge badge-success">Viewed</span>
                                        @endempty
                                    </td>
                                    <th style="width: 10%">Viewed At</th>
                                    <th style="width: 1%">:</th>
                                    <td>
                                        @empty($voucherMaster->approving_person_viewed_at)
                                            <span class="badge badge-danger">PENDING</span><br>
                                        @else
                                            {{$voucherMaster->approving_person_viewed_at}}
                                        @endempty
                                    </td>
                                <tr/>
                                <tr>
                                    <th>Approved Status</th>
                                    <th style="width: 1%">:</th>
                                    <td>
                                        @if($voucherMaster->approved_status == 'REJECTED') <span class="badge badge-soft-danger">REJECTED</span>
                                        @elseif($voucherMaster->approved_status == 'APPROVED') <span class="badge badge-success">APPROVED</span>
                                        @elseif($voucherMaster->approved_status == 'PENDING') <span class="badge badge-danger">PENDING</span>
                                        @endif
                                    </td>
                                    <th>Approved At</th>
                                    <th style="width: 1%">:</th>
                                    <td>@empty($voucherMaster->approved_at)
                                            <span class="badge badge-danger">PENDING</span>
                                        @else {{$voucherMaster->approved_at}}
                                        @endempty
                                    </td>
                                    <th>Remarks</th>
                                    <th style="width: 1%">:</th>
                                    <td style="width: 25%">@empty($voucherMaster->remarks_while_approved) - @else {{$voucherMaster->remarks_while_approved}} @endempty</td>
                                </tr>
                            </table>

                            <table class="table" style="width: 100%">
                                <tr class="text-center @if($voucherMaster->audited_status=='AUDITED') bg-soft-success @elseif($voucherMaster->audited_status=='REJECTED') bg-danger @else  bg-soft-danger @endif text-black"><th colspan="9">Audited Status</th></tr>
                                <tr>
                                    <th style="width: 15%">Person</th>
                                    <th style="width: 1%">:</th>
                                    <td style="width: 15%">@if($voucherMaster->audited_by>0)
                                            {{$voucherMaster->auditedBy->name}}
                                        @else
                                            Don't know yet.
                                        @endif
                                    </td>
                                    <th style="width: 10%">View Status</th>
                                    <th style="width: 1%">:</th>
                                    <td style="width: 15%">
                                        @empty($voucherMaster->auditing_person_viewed_at)
                                            <span class="badge badge-danger">PENDING</span>
                                        @else
                                            <span class="badge badge-success">Viewed</span>
                                        @endempty
                                    </td>
                                    <th style="width: 10%">Viewed At</th>
                                    <th style="width: 1%">:</th>
                                    <td>
                                        @empty($voucherMaster->auditing_person_viewed_at)
                                            <span class="badge badge-danger">PENDING</span><br>
                                        @else
                                            {{$voucherMaster->auditing_person_viewed_at}}
                                        @endempty
                                    </td>
                                <tr/>
                                <tr>
                                    <th>Audited Status</th>
                                    <th style="width: 1%">:</th>
                                    <td>
                                        @if($voucherMaster->audited_status == 'REJECTED') <span class="badge badge-soft-danger">REJECTED</span>
                                        @elseif($voucherMaster->audited_status == 'AUDITED') <span class="badge badge-success">AUDITED</span>
                                        @elseif($voucherMaster->audited_status == 'PENDING') <span class="badge badge-danger">PENDING</span>
                                        @endif
                                    </td>
                                    <th>Audited At</th>
                                    <th style="width: 1%">:</th>
                                    <td>@empty($voucherMaster->audited_at)
                                            <span class="badge badge-danger">PENDING</span>
                                        @else {{$voucherMaster->audited_at}}
                                        @endempty
                                    </td>
                                    <th>Remarks</th>
                                    <th style="width: 1%">:</th>
                                    <td style="width: 25%">@empty($voucherMaster->remarks_while_audited) - @else {{$voucherMaster->remarks_while_audited}} @endempty</td>
                                </tr>
                            </table>



                            <div class="container">
                                <div class="row">
                                    @if($voucherMaster->status=='GRANTED')
                                        <div class="col-lg-12 text-center">
                                            <a href="{{route('ea.attendance.earlyLeaveApplication')}}" type="submit" class="btn btn-danger mt-4 pr-4 pl-4 text-white"><i class="fa fa-arrow-alt-circle-left"></i> Go Back</a>
                                            <a href="{{route('ea.attendance.earlyLeaveApplication.download', ['id'=>$voucherMaster->id])}}" type="submit" class="btn btn-info mt-4 pr-4 pl-4 text-white"><i class="fa fa-download"></i> Download</a>
                                        </div>
                                    @endif

                                    @if($voucherMaster->status=='DRAFTED')
                                        <div class="col-lg-5 text-right">
                                            <a href="{{route('ea.attendance.earlyLeaveApplication')}}" type="submit" class="btn btn-primary mt-4 pr-4 pl-4 text-white"><i class="fa fa-arrow-alt-circle-left"></i> Go Back</a>
                                        </div>

                                        <div class="col-lg-2 text-center">
                                            <form action="{{route('ea.attendance.earlyLeaveApplication.destroy', ['id'=>$voucherMaster->id])}}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger mt-4 pr-4 pl-4 text-white" onclick="return window.confirm('Confirm to delete?');">Delete <i class="fa fa-eraser"></i></button>
                                            </form>
                                        </div>
                                        <div class="col-lg-5 text-left">
                                            <form action="{{route('ea.attendance.earlyLeaveApplication.send', ['id'=>$voucherMaster->id])}}" method="post">
                                                @csrf
                                                <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                                                <input type="hidden" name="status" value="PENDING">
                                                <button type="submit" class="btn btn-success mt-4 pr-4 pl-4 text-white" onclick="return window.confirm('Confirm?');">Send <i class="fa fa-arrow-alt-circle-right"></i></button>
                                            </form>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @else
                        <p class="text-center text-danger">
                            You are trying to view unauthorized access.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
