@extends('layouts.app')

@section('title')
    @php($title='Late Atten. Application View') {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if($earlyLeaveApplication->employee_id == Auth::user()->id)
                        <br>
                        <div class="card-title text-center"><h4 style="text-decoration: underline">Eartly Leave Application Details</h4></div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th style="width: 20%">Application ID</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$earlyLeaveApplication->id}}</td>
                                    <th style="width: 20%">Date</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$earlyLeaveApplication->date}}</td>
                                </tr>

                                <tr>
                                    <th>Early Leave Reason</th>
                                    <th>:</th>
                                    <td>{{$earlyLeaveApplication->reason}}</td>
                                    <th>Departure Time</th>
                                    <th>:</th>
                                    <td>{{$earlyLeaveApplication->departure_time}}</td>
                                </tr>

                                <tr>
                                    <th>Recommended By</th>
                                    <th>:</th>
                                    <td>
                                        {{$earlyLeaveApplication->RecommendedPerson->name}}
                                        @empty($earlyLeaveApplication->recommended_at)
                                            - <span class="badge badge-danger">PENDING</span><br>
                                        @else
                                            {{$earlyLeaveApplication->recommended_at}}
                                        @endempty
                                    </td>
                                    <th style="width: 20%">Approved By</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$earlyLeaveApplication->ApprovedPerson->name}}
                                        @empty($earlyLeaveApplication->approved_at)
                                            - <span class="badge badge-danger">PENDING</span><br>
                                        @else
                                            {{$earlyLeaveApplication->approved_at}}
                                        @endempty
                                    </td>
                                </tr>
                                <tr>
                                    <th>HR View Status</th>
                                    <th>:</th>
                                    <td>
                                        @if($earlyLeaveApplication->hrm_viewed=='no')
                                            <span class="badge badge-danger">PENDING</span>
                                        @else
                                            <span class="badge badge-success">Done</span>
                                        @endif
                                        <br>
                                        @if($earlyLeaveApplication->hrm_viewed=='yes') - {{$earlyLeaveApplication->hrm_viewed_at}} @endif
                                    </td>

                                    <th style="width: 20%">GRANTED By</th>
                                    <th style="width: 1%">:</th>
                                    <td>
                                        @if($earlyLeaveApplication->granted_by > 0)
                                            {{$earlyLeaveApplication->GrantPerson->name}}
                                        @endif
                                        @empty($earlyLeaveApplication->granted_at)
                                            - <span class="badge badge-danger">PENDING</span><br>
                                        @else
                                            {{$earlyLeaveApplication->granted_at}}
                                        @endempty
                                    </td>
                                </tr>
                            </table>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 text-right">
                                        <a href="{{route('ea.attendance.earlyLeaveApplication')}}" type="submit" class="btn btn-primary mt-4 pr-4 pl-4 text-white">Go Back</a>
                                    </div>
                                    @if($earlyLeaveApplication->status=='DRAFTED')
                                        <div class="col-md-6 text-left">
                                            <form action="{{route('ea.attendance.earlyLeaveApplication.destroy', ['id'=>$earlyLeaveApplication->id])}}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger mt-4 pr-4 pl-4 text-white" onclick="return window.confirm('Confirm to delete?');">Delete</button>
                                            </form>
                                            <form action="{{route('ea.attendance.earlyLeaveApplication.send', ['id'=>$earlyLeaveApplication->id])}}" method="post">
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
