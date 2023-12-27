@extends('layouts.app')

@section('title')
    @php($title='Early Leave Application View') {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if($earlyLeaveApplication->employee_id == Auth::user()->id)
                        <br>
                        <div class="card-title text-center"><h4 style="text-decoration: underline">Early Leave Application Details</h4></div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th style="width: 20%">Application ID</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$earlyLeaveApplication->id}}</td>
                                    <th style="width: 20%">Early Leave Reason</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$earlyLeaveApplication->reason}}</td>
                                </tr>
                                <tr>
                                    <th>Departure Date</th>
                                    <th>:</th>
                                    <td>{{$earlyLeaveApplication->date}}</td>
                                    <th>Time</th>
                                    <th>:</th>
                                    <td>{{$earlyLeaveApplication->departure_time}}</td>
                                </tr>
                            </table>
                            <table class="table">
                                <tr class="text-center @if($earlyLeaveApplication->responsible_person_acceptance_status!=='ACCEPTED')bg-soft-danger @else bg-soft-success @endif text-black"><th colspan="9">Responsible Person Acceptance Status</th></tr>
                                <tr>
                                    <th>Person</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$earlyLeaveApplication->RecommendedPerson->name}}</td>

                                    <th>View Status</th>
                                    <th style="width: 1%">:</th>
                                    <td>
                                        @empty($earlyLeaveApplication->responsible_person_viewed_at)
                                            <span class="badge badge-danger">PENDING</span>
                                        @else
                                            <span class="badge badge-success">Viewed</span>
                                        @endempty
                                    </td>

                                    <th>Viewed At</th>
                                    <th style="width: 1%">:</th>
                                    <td>
                                        @empty($earlyLeaveApplication->responsible_person_viewed_at)
                                            <span class="badge badge-danger">PENDING</span>
                                        @else
                                            {{$earlyLeaveApplication->responsible_person_viewed_at}}
                                        @endempty
                                    </td>
                                <tr/>
                                <tr>
                                    <th>Acceptance Status</th>
                                    <th style="width: 1%">:</th>
                                    <td>
                                        @if($earlyLeaveApplication->responsible_person_acceptance_status == 'REJECTED') <span class="badge badge-soft-danger">REJECTED</span>
                                        @elseif($earlyLeaveApplication->responsible_person_acceptance_status == 'PENDING') <span class="badge badge-danger">PENDING</span>
                                        @elseif($earlyLeaveApplication->responsible_person_acceptance_status == 'ACCEPTED') <span class="badge badge-success">ACCEPTED</span>
                                        @endif
                                    </td>

                                    <th>Acceptance At</th>
                                    <th style="width: 1%">:</th>
                                    <td>@empty($earlyLeaveApplication->responsible_person_acceptance_at)
                                            <span class="badge badge-danger">PENDING</span>
                                        @else {{$earlyLeaveApplication->responsible_person_acceptance_at}} @endempty</td>


                                    <th>Remarks</th>
                                    <th style="width: 1%">:</th>
                                    <td style="width: 25%">@empty($earlyLeaveApplication->remarks_for_responsible_person) N/A @else {{$earlyLeaveApplication->remarks_for_responsible_person}} @endempty</td>
                                </tr>
                            </table>
                            <table class="table">
                                <tr class="text-center @if($earlyLeaveApplication->recommended_status!=='RECOMMENDED')bg-soft-danger @else bg-soft-success @endif text-black"><th colspan="9">Recommendation Status</th></tr>
                                <tr>
                                    <th>Person</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$earlyLeaveApplication->RecommendedPerson->name}}</td>

                                    <th>View Status</th>
                                    <th style="width: 1%">:</th>
                                    <td>
                                        @empty($earlyLeaveApplication->recommended_viewed_at)
                                            <span class="badge badge-danger">PENDING</span>
                                        @else
                                            <span class="badge badge-success">Viewed</span>
                                        @endempty
                                    </td>

                                    <th>Viewed At</th>
                                    <th style="width: 1%">:</th>
                                    <td>
                                        @empty($earlyLeaveApplication->recommended_viewed_at)
                                            <span class="badge badge-danger">PENDING</span>
                                        @else
                                            {{$earlyLeaveApplication->recommended_viewed_at}}
                                        @endempty
                                    </td>
                                <tr/>
                                <tr>
                                    <th>Recommend Status</th>
                                    <th style="width: 1%">:</th>
                                    <td>
                                        @if($earlyLeaveApplication->recommended_status == 'REJECTED') <span class="badge badge-soft-danger">REJECTED</span>
                                        @elseif($earlyLeaveApplication->recommended_status == 'PENDING') <span class="badge badge-danger">PENDING</span>
                                        @elseif($earlyLeaveApplication->recommended_status == 'RECOMMENDED') <span class="badge badge-success">RECOMMENDED</span>
                                        @endif
                                    </td>

                                    <th>Recommended At</th>
                                    <th style="width: 1%">:</th>
                                    <td>@empty($earlyLeaveApplication->recommended_at)
                                            <span class="badge badge-danger">PENDING</span>
                                        @else {{$earlyLeaveApplication->recommended_at}} @endempty</td>


                                    <th>Remarks</th>
                                    <th style="width: 1%">:</th>
                                    <td style="width: 25%">@empty($earlyLeaveApplication->remarks_while_recommended) N/A @else {{$earlyLeaveApplication->remarks_while_recommended}} @endempty</td>
                                </tr>
                            </table>

                            <table class="table">
                                <tr class="text-center @if($earlyLeaveApplication->approved_status!=='APPROVED')bg-soft-danger @else bg-soft-success @endif text-black"><th colspan="9">Approval Status</th></tr>
                                <tr>
                                    <th>Person</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$earlyLeaveApplication->ApprovedPerson->name}}</td>
                                    <th>View Status</th>
                                    <th style="width: 1%">:</th>
                                    <td>
                                        @empty($earlyLeaveApplication->approved_viewed_at)
                                            <span class="badge badge-danger">PENDING</span>
                                        @else
                                            <span class="badge badge-success">Viewed</span>
                                        @endempty
                                    </td>
                                    <th>Viewed At</th>
                                    <th style="width: 1%">:</th>
                                    <td>
                                        @empty($earlyLeaveApplication->approved_viewed_at)
                                            <span class="badge badge-danger">PENDING</span><br>
                                        @else
                                            {{$earlyLeaveApplication->approved_viewed_at}}
                                        @endempty
                                    </td>
                                <tr/>
                                <tr>
                                    <th>Approve Status</th>
                                    <th style="width: 1%">:</th>
                                    <td>
                                        @if($earlyLeaveApplication->approved_status == 'REJECTED') <span class="badge badge-soft-danger">REJECTED</span>
                                        @elseif($earlyLeaveApplication->approved_status == 'APPROVED') <span class="badge badge-success">APPROVED</span>
                                        @elseif($earlyLeaveApplication->approved_status == 'PENDING') <span class="badge badge-danger">PENDING</span>
                                        @endif
                                    </td>
                                    <th>Approved At</th>
                                    <th style="width: 1%">:</th>
                                    <td>@empty($earlyLeaveApplication->approved_at)
                                            <span class="badge badge-danger">PENDING</span>
                                        @else {{$earlyLeaveApplication->approved_at}}
                                        @endempty
                                    </td>
                                    <th>Remarks</th>
                                    <th style="width: 1%">:</th>
                                    <td style="width: 25%">@empty($earlyLeaveApplication->remarks_while_approved) N/A @else {{$earlyLeaveApplication->remarks_while_approved}} @endempty</td>
                                </tr>
                            </table>

                            <table class="table">
                                <tr class="text-center @if($earlyLeaveApplication->granted_status!=='GRANTED')bg-soft-danger @else bg-soft-success @endif text-black"><th colspan="9">Granted Status (by HR department)</th></tr>
                                <tr>
                                    <th>Person</th>
                                    <th style="width: 1%">:</th>
                                    <td>@if($earlyLeaveApplication->granted_by>0)
                                            {{$earlyLeaveApplication->GrantPerson->name}}
                                        @else
                                            Don't know yet.
                                        @endif
                                    </td>
                                    <th>View Status</th>
                                    <th style="width: 1%">:</th>
                                    <td>
                                        @empty($earlyLeaveApplication->granted_viewed_at)
                                            <span class="badge badge-danger">PENDING</span>
                                        @else
                                            <span class="badge badge-success">Viewed</span>
                                        @endempty
                                    </td>
                                    <th>Viewed At</th>
                                    <th style="width: 1%">:</th>
                                    <td>
                                        @empty($earlyLeaveApplication->granted_viewed_at)
                                            <span class="badge badge-danger">PENDING</span><br>
                                        @else
                                            {{$earlyLeaveApplication->granted_viewed_at}}
                                        @endempty
                                    </td>
                                <tr/>
                                <tr>
                                    <th>Granted Status</th>
                                    <th style="width: 1%">:</th>
                                    <td>
                                        @if($earlyLeaveApplication->granted_status == 'REJECTED') <span class="badge badge-soft-danger">REJECTED</span>
                                        @elseif($earlyLeaveApplication->granted_status == 'GRANTED') <span class="badge badge-success">GRANTED</span>
                                        @elseif($earlyLeaveApplication->granted_status == 'PENDING') <span class="badge badge-danger">PENDING</span>
                                        @endif
                                    </td>
                                    <th>Granted At</th>
                                    <th style="width: 1%">:</th>
                                    <td>@empty($earlyLeaveApplication->granted_at)
                                            <span class="badge badge-danger">PENDING</span>
                                        @else {{$earlyLeaveApplication->granted_at}}
                                        @endempty
                                    </td>
                                    <th>Remarks</th>
                                    <th style="width: 1%">:</th>
                                    <td style="width: 25%">@empty($earlyLeaveApplication->remarks_while_granted) N/A @else {{$earlyLeaveApplication->remarks_while_granted}} @endempty</td>
                                </tr>
                            </table>



                            <div class="container">
                                <div class="row">
                                    @if($earlyLeaveApplication->status=='GRANTED')
                                        <div class="col-lg-12 text-center">
                                            <a href="{{route('ea.attendance.earlyLeaveApplication')}}" type="submit" class="btn btn-danger mt-4 pr-4 pl-4 text-white"><i class="fa fa-arrow-alt-circle-left"></i> Go Back</a>
                                            <a href="{{route('ea.attendance.earlyLeaveApplication.download', ['id'=>$earlyLeaveApplication->id])}}" type="submit" class="btn btn-info mt-4 pr-4 pl-4 text-white"><i class="fa fa-download"></i> Download</a>
                                        </div>
                                    @endif

                                    @if($earlyLeaveApplication->status=='DRAFTED')
                                        <div class="col-lg-5 text-right">
                                            <a href="{{route('ea.attendance.earlyLeaveApplication')}}" type="submit" class="btn btn-primary mt-4 pr-4 pl-4 text-white"><i class="fa fa-arrow-alt-circle-left"></i> Go Back</a>
                                        </div>

                                        <div class="col-lg-2 text-center">
                                            <form action="{{route('ea.attendance.earlyLeaveApplication.destroy', ['id'=>$earlyLeaveApplication->id])}}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger mt-4 pr-4 pl-4 text-white" onclick="return window.confirm('Confirm to delete?');">Delete <i class="fa fa-eraser"></i></button>
                                            </form>
                                        </div>
                                        <div class="col-lg-5 text-left">
                                            <form action="{{route('ea.attendance.earlyLeaveApplication.send', ['id'=>$earlyLeaveApplication->id])}}" method="post">
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
