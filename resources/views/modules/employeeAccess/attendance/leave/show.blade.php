@extends('layouts.app')

@section('title')
    @php($title='Leave Application View') {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if($leaveApplication->employee_id == Auth::user()->id)
                    <br>
                    <div class="card-title text-center"><h4 style="text-decoration: underline">Leave Application Details</h4></div>
                    <div class="card-body">
                        <table class="table">
                                <tr>
                                    <th style="width: 20%">Application ID</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$leaveApplication->id}}</td>
                                    <th style="width: 20%">Leave Reason</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$leaveApplication->reason}}</td>
                                </tr>
                                <tr>
                                    <th>Leave Type</th>
                                    <th>:</th>
                                    <td>{{$leaveApplication->leaveType->leave_type_name}}</td>
                                    <th style="width: 20%">Leave Address</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$leaveApplication->leave_address}}</td>
                                </tr>

                                <tr>
                                    <th>Responsible Person</th>
                                    <th>:</th>
                                    <td>{{$leaveApplication->responsiblePerson->name}}</td>
                                    <th style="width: 20%">Mobile (During Leave)</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$leaveApplication->leave_mobile_number}}</td>
                                </tr>
                                <tr>
                                    <th>Leave Duration</th>
                                    <th>:</th>
                                    <td>{{$leaveApplication->start_date}} <strong>to</strong> {{$leaveApplication->end_date}}</td>
                                    <th>Total Days</th>
                                    <th>:</th>
                                    <td>{{$leaveApplication->total_days}} @if($leaveApplication->total_days > 1) Days @else Day @endif</td>
                                </tr>
                        </table>
                        <table class="table">
                            <tr class="text-center bg-soft-success text-black"><th colspan="9">Recommendation Status</th></tr>
                            <tr>
                                <th>Person</th>
                                <th style="width: 1%">:</th>
                                <td>{{$leaveApplication->RecommendedPerson->name}}</td>

                                <th>View Status</th>
                                <th style="width: 1%">:</th>
                                <td>
                                    @empty($leaveApplication->recommended_viewed_at)
                                        <span class="badge badge-danger">PENDING</span>
                                    @else
                                        <span class="badge badge-success">Viewed</span>
                                    @endempty
                                </td>

                                <th>Viewed At</th>
                                <th style="width: 1%">:</th>
                                <td>
                                    @empty($leaveApplication->recommended_viewed_at)
                                        <span class="badge badge-danger">PENDING</span>
                                    @else
                                        {{$leaveApplication->recommended_viewed_at}}
                                    @endempty
                                </td>
                            <tr/>
                            <tr>
                                <th>Recommend Status</th>
                                <th style="width: 1%">:</th>
                                <td>
                                    @if($leaveApplication->recommended_status == 'REJECTED') <span class="badge badge-soft-danger">REJECTED</span>
                                    @elseif($leaveApplication->recommended_status == 'PENDING') <span class="badge badge-danger">PENDING</span>
                                    @elseif($leaveApplication->recommended_status == 'RECOMMENDED') <span class="badge badge-success">RECOMMENDED</span>
                                    @endif
                                </td>

                                <th>Recommended At</th>
                                <th style="width: 1%">:</th>
                                <td>@empty($leaveApplication->recommended_at)
                                    <span class="badge badge-danger">PENDING</span>
                                    @else {{$leaveApplication->recommended_at}} @endempty</td>


                                <th>Remarks</th>
                                <th style="width: 1%">:</th>
                                <td>@empty($leaveApplication->remarks_while_recommended) N/A @else {{$leaveApplication->remarks_while_recommended}} @endempty</td>
                            </tr>
                        </table>

                        <table class="table">
                            <tr class="text-center bg-soft-success text-black"><th colspan="9">Approval Status</th></tr>
                            <tr>
                                <th>Person</th>
                                <th style="width: 1%">:</th>
                                <td>{{$leaveApplication->ApprovedPerson->name}}</td>
                                <th>View Status</th>
                                <th style="width: 1%">:</th>
                                <td>
                                    @empty($leaveApplication->approved_viewed_at)
                                        <span class="badge badge-danger">PENDING</span>
                                    @else
                                        <span class="badge badge-success">Viewed</span>
                                    @endempty
                                </td>
                                <th>Viewed At</th>
                                <th style="width: 1%">:</th>
                                <td>
                                    @empty($leaveApplication->approved_viewed_at)
                                        <span class="badge badge-danger">PENDING</span><br>
                                    @else
                                        {{$leaveApplication->approved_viewed_at}}
                                    @endempty
                                </td>
                            <tr/>
                            <tr>
                                <th>Approve Status</th>
                                <th style="width: 1%">:</th>
                                <td>
                                    @if($leaveApplication->approved_status == 'REJECTED') <span class="badge badge-soft-danger">REJECTED</span>
                                    @elseif($leaveApplication->approved_status == 'APPROVED') <span class="badge badge-success">APPROVED</span>
                                    @elseif($leaveApplication->approved_status == 'PENDING') <span class="badge badge-danger">PENDING</span>
                                    @endif
                                </td>
                                <th>Approved At</th>
                                <th style="width: 1%">:</th>
                                <td>@empty($leaveApplication->approved_at)
                                        <span class="badge badge-danger">PENDING</span>
                                    @else {{$leaveApplication->approved_at}}
                                    @endempty
                                </td>
                                <th>Remarks</th>
                                <th style="width: 1%">:</th>
                                <td>@empty($leaveApplication->remarks_while_approved) N/A @else {{$leaveApplication->remarks_while_approved}} @endempty</td>
                            </tr>
                        </table>

                        <table class="table">
                            <tr class="text-center bg-soft-success text-black"><th colspan="9">Granted Status (by HR department)</th></tr>
                            <tr>
                                <th>Person</th>
                                <th style="width: 1%">:</th>
                                <td>@if($leaveApplication->granted_by>0)
                                        {{$leaveApplication->GrantPerson->name}}
                                    @else
                                        Don't know yet.
                                    @endif
                                </td>
                                <th>View Status</th>
                                <th style="width: 1%">:</th>
                                <td>
                                    @empty($leaveApplication->granted_viewed_at)
                                        <span class="badge badge-danger">PENDING</span>
                                    @else
                                        <span class="badge badge-success">Viewed</span>
                                    @endempty
                                </td>
                                <th>Viewed At</th>
                                <th style="width: 1%">:</th>
                                <td>
                                    @empty($leaveApplication->granted_viewed_at)
                                        <span class="badge badge-danger">PENDING</span><br>
                                    @else
                                        {{$leaveApplication->granted_viewed_at}}
                                    @endempty
                                </td>
                            <tr/>
                            <tr>
                                <th>Granted Status</th>
                                <th style="width: 1%">:</th>
                                <td>
                                    @if($leaveApplication->granted_status == 'REJECTED') <span class="badge badge-soft-danger">REJECTED</span>
                                    @elseif($leaveApplication->granted_status == 'APPROVED') <span class="badge badge-success">APPROVED</span>
                                    @elseif($leaveApplication->granted_status == 'PENDING') <span class="badge badge-danger">PENDING</span>
                                    @endif
                                </td>
                                <th>Granted At</th>
                                <th style="width: 1%">:</th>
                                <td>@empty($leaveApplication->granted_at)
                                        <span class="badge badge-danger">PENDING</span>
                                    @else {{$leaveApplication->granted_at}}
                                    @endempty
                                </td>
                                <th>Remarks</th>
                                <th style="width: 1%">:</th>
                                <td>@empty($leaveApplication->remarks_while_granted) N/A @else {{$leaveApplication->remarks_while_granted}} @endempty</td>
                            </tr>
                        </table>



                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 text-right">
                                        <a href="{{route('ea.attendance.leaveApplication')}}" type="submit" class="btn btn-primary mt-4 pr-4 pl-4 text-white">Go Back</a>
                                    </div>
                                    @if($leaveApplication->status=='DRAFTED')
                                    <div class="col-md-6 text-left">
                                        <form action="{{route('ea.attendance.leaveApplication.destroy', ['id'=>$leaveApplication->id])}}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-danger mt-4 pr-4 pl-4 text-white" onclick="return window.confirm('Confirm to delete?');">Delete</button>
                                        </form>
                                        <form action="{{route('ea.attendance.leaveApplication.send', ['id'=>$leaveApplication->id])}}" method="post">
                                            @csrf
                                            <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                                            <input type="hidden" name="status" value="PENDING">
                                        <button type="submit" class="btn btn-success mt-4 pr-4 pl-4 text-white" onclick="return window.confirm('Confirm?');">Send</button>
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
