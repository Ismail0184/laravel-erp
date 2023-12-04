@extends('layouts.app')

@section('title')
    @php($title='Leave Application View') {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <br>
                    <div class="card-title text-center"><h4 style="text-decoration: underline">Leave Application Details</h4></div>
                    <div class="card-body">
                        <form action="{{route('ea.attendance.leaveApplication.destroy', ['id'=>$leaveApplication->id])}}" method="post">
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

                                    <th style="width: 20%">Responsible Person (During Leave)</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$leaveApplication->responsiblePerson->name}}</td>
                                </tr>
                                <tr>
                                    <th>Total Days</th>
                                    <th>:</th>
                                    <td>{{$leaveApplication->total_days}}</td>

                                    <th style="width: 20%">Recommended By</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$leaveApplication->RecommendedPerson->name}}</td>
                                </tr>

                                <tr>
                                    <th>Total Days</th>
                                    <th>:</th>
                                    <td>{{$leaveApplication->total_days}}</td>

                                    <th style="width: 20%">Approved By</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$leaveApplication->ApprovedPerson->name}}</td>
                                </tr>
                                <tr>
                                    <th>Application Status</th>
                                    <th>:</th>
                                    <td>
                                        @if($leaveApplication->status == 'GRANTED') <span class="badge badge-success">GRANTED</span>
                                        @elseif($leaveApplication->status == 'REJECTED') <span class="badge badge-danger">REJECTED</span>
                                        @elseif($leaveApplication->status == 'DRAFTED') <span class="badge badge-dark">DRAFTED</span>
                                        @elseif($leaveApplication->status == 'PENDING') <span class="badge badge-warning">PENDING</span>
                                        @elseif($leaveApplication->status == 'APPROVED') <span class="badge badge-pink">APPROVED</span>
                                        @elseif($leaveApplication->status == 'RECOMMENDED') <span class="badge badge-soft-success">RECOMMENDED</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 text-right">
                                        <a href="{{route('ea.attendance.leaveApplication')}}" type="submit" class="btn btn-danger mt-4 pr-4 pl-4 text-white">Cancel</a>
                                    </div>
                                    <div class="col-md-6 text-left">
                                        @csrf
                                        <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="status" value="active">
                                        <button href="{{route('ea.attendance.leaveApplication')}}" type="submit" class="btn btn-success mt-4 pr-4 pl-4 text-white" onclick="return window.confirm('Confirm?');">Verified</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



