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
                                    <th>Start Date</th>
                                    <th>:</th>
                                    <td>{{$leaveApplication->start_date}}</td>
                                    <th style="width: 20%">Mobile (During Leave)</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$leaveApplication->leave_mobile_number}}</td>
                                </tr>
                                <tr>
                                    <th>End Date</th>
                                    <th>:</th>
                                    <td>{{$leaveApplication->end_date}}</td>
                                    <th>Total Days</th>
                                    <th>:</th>
                                    <td>{{$leaveApplication->total_days}} @if($leaveApplication->total_days > 1) Days @else Day @endif</td>


                                </tr>
                                <tr>
                                    <th style="width: 20%">Responsible Person <br>(During Leave)</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$leaveApplication->responsiblePerson->name}}</td>
                                    <th style="width: 20%">Recommended By</th>
                                    <th style="width: 1%">:</th>
                                    <td>

                                        {{$leaveApplication->RecommendedPerson->name}}
                                        @empty($leaveApplication->recommended_at)
                                         - <span class="badge badge-danger">PENDING</span><br>
                                        @else
                                        {{$leaveApplication->recommended_at}}
                                        @endempty
                                    </td>
                                </tr>

                                <tr>
                                    <th>Applied At</th>
                                    <th>:</th>
                                    <td>{{$leaveApplication->created_at}}</td>
                                    <th style="width: 20%">Approved By</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$leaveApplication->ApprovedPerson->name}}
                                        @empty($leaveApplication->approved_at)
                                            - <span class="badge badge-danger">PENDING</span><br>
                                        @else
                                            {{$leaveApplication->approved_at}}
                                        @endempty
                                    </td>
                                </tr>
                                <tr>
                                    <th>HR View Status</th>
                                    <th>:</th>
                                    <td>
                                        @if($leaveApplication->hrm_viewed=='no')
                                            <span class="badge badge-danger">PENDING</span>
                                        @else
                                            <span class="badge badge-success">Done</span>
                                        @endif
                                        <br>
                                        @if($leaveApplication->hrm_viewed=='yes') - {{$leaveApplication->hrm_viewed_at}} @endif
                                    </td>

                                    <th style="width: 20%">GRANTED By</th>
                                    <th style="width: 1%">:</th>
                                    <td>
                                        @if($leaveApplication->granted_by > 0)
                                        {{$leaveApplication->GrantPerson->name}}
                                        @endif
                                        @empty($leaveApplication->granted_at)
                                            - <span class="badge badge-danger">PENDING</span><br>
                                        @else
                                            {{$leaveApplication->granted_at}}
                                        @endempty
                                    </td>
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
