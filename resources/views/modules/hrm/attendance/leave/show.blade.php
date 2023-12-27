@extends('layouts.app')

@section('title')
    @php($title='Leave Application View') {{$title}}
@endsection

@section('body')
    <style>
        th,td {
            vertical-align: middle;
        }
    </style>
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
                                    <th>Leave Type</th>
                                    <th>:</th>
                                    <td>{{$leaveApplication->leaveType->leave_type_name}}</td>
                                    <th style="width: 20%">Leave Reason</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$leaveApplication->reason}}</td>
                                </tr>
                                <tr>
                                    <th>Mobile (During Leave)</th>
                                    <th>:</th>
                                    <td>{{$leaveApplication->leave_mobile_number}}</td>
                                    <th style="width: 20%">Leave Address</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$leaveApplication->leave_address}}</td>
                                </tr>

                                <tr>
                                    <th>Leave Duration</th>
                                    <th>:</th>
                                    <td>{{$leaveApplication->start_date}} <strong>to</strong> {{$leaveApplication->end_date}}</td>
                                    <th>Total Days</th>
                                    <th>:</th>
                                    <td>{{$leaveApplication->total_days}} @if($leaveApplication->total_days > 1) Days @else Day @endif</td>

                                </tr>
                                <tr>
                                    <th>Remarks <span class="required text-danger">*</span></th>
                                    <th>:</th>
                                    <td colspan="4">

                                        <input type="text" id="writeRemarks" oninput="updateInput2()" class="form-control" placeholder="Enter a note for the application, if necessary"></td>
                                </tr>
                            </table>
                            <table class="table">
                                <tr class="text-center bg-soft-success text-black"><th colspan="9">Responsible Person Acceptance Status</th></tr>
                                <tr>
                                    <th>Person</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$leaveApplication->RecommendedPerson->name}}</td>

                                    <th>View Status</th>
                                    <th style="width: 1%">:</th>
                                    <td>
                                        @empty($leaveApplication->responsible_person_viewed_at)
                                            <span class="badge badge-danger">PENDING</span>
                                        @else
                                            <span class="badge badge-success">Viewed</span>
                                        @endempty
                                    </td>

                                    <th>Viewed At</th>
                                    <th style="width: 1%">:</th>
                                    <td>
                                        @empty($leaveApplication->responsible_person_viewed_at)
                                            <span class="badge badge-danger">PENDING</span>
                                        @else
                                            {{$leaveApplication->responsible_person_viewed_at}}
                                        @endempty
                                    </td>
                                <tr/>
                                <tr>
                                    <th>Acceptance Status</th>
                                    <th style="width: 1%">:</th>
                                    <td>
                                        @if($leaveApplication->responsible_person_acceptance_status == 'REJECTED') <span class="badge badge-soft-danger">REJECTED</span>
                                        @elseif($leaveApplication->responsible_person_acceptance_status == 'PENDING') <span class="badge badge-danger">PENDING</span>
                                        @elseif($leaveApplication->responsible_person_acceptance_status == 'ACCEPTED') <span class="badge badge-success">ACCEPTED</span>
                                        @endif
                                    </td>

                                    <th>Acceptance At</th>
                                    <th style="width: 1%">:</th>
                                    <td>@empty($leaveApplication->responsible_person_acceptance_at)
                                            <span class="badge badge-danger">PENDING</span>
                                        @else {{$leaveApplication->responsible_person_acceptance_at}} @endempty</td>


                                    <th>Remarks</th>
                                    <th style="width: 1%">:</th>
                                    <td style="width: 25%">@empty($leaveApplication->remarks_for_responsible_person) N/A @else {{$leaveApplication->remarks_for_responsible_person}} @endempty</td>
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
                            <table style="width: 100%">
                                <td style="width: 60%"><table  class="table">
                                        <thead class="thead-light">
                                        </thead>
                                        <tbody>
                                        @php($total = 0)
                                        @php($total_leave_taken = 0)
                                        <tr class="text-center bg-primary text-white font-size-11">
                                            <td class="text-left">Leave Categories</td>
                                            @foreach($leave_taken as $type)
                                                <td>{{$type['leave_type_name']}}</td>
                                            @endforeach
                                        </tr>
                                        <tr class="font-size-11">
                                            <td>Leave Policy</td>
                                            @foreach($leave_taken as $type)
                                                <td style="text-align: center">{{$type['yearly_leave_days']}}</td>
                                            @endforeach
                                        </tr>
                                        <tr class="font-size-11">
                                            <td>Leave Taken</td>
                                            @foreach($leave_taken as $type)
                                                <td style="text-align: center">@if($type['total_leave_taken']==0) - @else {{$type['total_leave_taken']}} @endif</td>
                                            @endforeach
                                        </tr>
                                        <tr class="font-size-11">
                                            <td>Applied (Pending Approval)</td>
                                            @foreach($leave_taken as $type)
                                                <td style="text-align: center">@if($type['total_leave_applied']==0) - @else {{$type['total_leave_applied']}} @endif</td>
                                            @endforeach
                                        </tr>
                                        </tbody>
                                        <tfoot class="thead-light">
                                        <tr class="font-size-11">
                                            <th>Leave Balance</th>
                                            @foreach($leave_taken as $type)
                                                <th style="text-align: center">{{$type['yearly_leave_days']-$type['total_leave_taken']}}</th>
                                            @endforeach
                                        </tr>
                                        </tfoot>
                                    </table></td>
                                <td style="width: 40%; vertical-align: top"><table  class="table">
                                        <thead>
                                        <tr class="text-center bg-danger text-white font-size-11">
                                            <th colspan="3">Latest Leave Records</th>
                                        </tr>
                                        @if(count($leaveHistories) > 0)
                                            @foreach($leaveHistories as $leaveHistory)
                                                <tr class="font-size-11">
                                                    <td>From {{$leaveHistory->start_date}} to {{$leaveHistory->end_date}}</td>
                                                    <td>{{$leaveHistory->total_days}}
                                                        @if($leaveHistory->total_days>1)
                                                            Days
                                                        @else
                                                            Day
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($leaveHistory->status == 'GRANTED') <span class="badge badge-success">GRANTED</span>
                                                        @elseif($leaveHistory->status == 'DELETED') <span class="badge badge-soft-danger">DELETED</span>
                                                        @elseif($leaveHistory->status == 'REJECTED') <span class="badge badge-danger">REJECTED</span>
                                                        @elseif($leaveHistory->status == 'DRAFTED') <span class="badge badge-dark">DRAFTED</span>
                                                        @elseif($leaveHistory->status == 'PENDING') <span class="badge badge-soft-dark">PENDING</span>
                                                        @elseif($leaveHistory->status == 'APPROVED') <span class="badge badge-pink">APPROVED</span>
                                                        @elseif($leaveHistory->status == 'RECOMMENDED') <span class="badge badge-soft-success">RECOMMENDED</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="font-size-11">
                                                <td colspan="3" class="text-center">No leave has been taken yet</td>
                                            </tr>
                                        @endif
                                        </thead>
                                    </table></td>
                            </table>
                            <div class="container">
                                <div class="row">
                                    @if($leaveApplication->status=='GRANTED')
                                        <div class="col-lg-12 text-center">
                                            <a href="{{route('hrm.attendance.leave')}}" type="submit" class="btn btn-primary mt-4 pr-4 pl-4 text-white">Go Back</a>
                                            <a href="{{route('ea.attendance.leaveApplication.download', ['id'=>$leaveApplication->id])}}" type="submit" class="btn btn-info mt-4 pr-4 pl-4 text-white"><i class="fa fa-download"></i> Download</a>
                                        </div>
                                    @endif
                                    @if($leaveApplication->status=='APPROVED')
                                            <div class="col-lg-4 text-right">
                                                <a href="{{route('ea.attendance.leaveApplication')}}" type="submit" class="btn btn-primary mt-4 pr-4 pl-4 text-white"><i class="fa fa-arrow-alt-circle-left"></i> Go Back</a>
                                            </div>

                                            <div class="col-lg-3 text-center">
                                                <form action="{{route('hrm.attendance.leave.reject', ['id'=>$leaveApplication->id])}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="remarks_while_granted" id="remarks_while_granted_reject">
                                                    <button type="submit" class="btn btn-danger mt-4 pr-4 pl-4 text-white" onclick="return window.confirm('Confirm to delete?');"><i class="fa fa-arrow-alt-circle-left"></i> Reject & Send Back</button>
                                                </form>
                                            </div>

                                            <div class="col-lg-5 text-left">
                                                <form action="{{route('hrm.attendance.leave.approve', ['id'=>$leaveApplication->id])}}" method="post">
                                                @csrf
                                                <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                                                <input type="hidden" name="status" value="PENDING">
                                                <input type="hidden" name="remarks_while_granted" id="remarks_while_granted">

                                                <button type="submit" class="btn btn-success mt-4 pr-4 pl-4 text-white" onclick="return window.confirm('Confirm?');">Granted the application <i class="fa fa-arrow-alt-circle-right"></i></button>
                                            </form>
                                            </div></div>
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
    <script>
        function updateInput2() {
            var input1Value = document.getElementById('writeRemarks').value;
            document.getElementById('remarks_while_granted').value = input1Value;
            document.getElementById('remarks_while_granted_reject').value = input1Value;
        }
    </script>
@endsection
