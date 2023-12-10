@extends('layouts.app')

@section('title')
    @php($title='Outdoor Duty Application View') {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if($outdoorDutyApplication->employee_id == Auth::user()->id)
                        <br>
                        <div class="card-title text-center"><h4 style="text-decoration: underline">Outdoor Duty Application Details</h4></div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th style="width: 20%">Application ID</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$outdoorDutyApplication->id}}</td>
                                    <th style="width: 20%">OD Purpose</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$outdoorDutyApplication->reason}}</td>
                                </tr>

                                <tr>
                                    <th style="width: 20%">Responsible Person <br>(During OD)</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$outdoorDutyApplication->responsiblePerson->name}}</td>
                                    <th style="width: 20%">Recommended By</th>
                                    <th style="width: 1%">:</th>
                                    <td>

                                        {{$outdoorDutyApplication->RecommendedPerson->name}}
                                        @empty($outdoorDutyApplication->recommended_at)
                                            - <span class="badge badge-danger">PENDING</span><br>
                                        @else
                                            {{$outdoorDutyApplication->recommended_at}}
                                        @endempty
                                    </td>
                                </tr>

                                <tr>
                                    <th>OD Place</th>
                                    <th>:</th>
                                    <td>{{$outdoorDutyApplication->od_place}}</td>
                                    <th style="width: 20%">Approved By</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$outdoorDutyApplication->ApprovedPerson->name}}
                                        @empty($outdoorDutyApplication->approved_at)
                                            - <span class="badge badge-danger">PENDING</span><br>
                                        @else
                                            {{$outdoorDutyApplication->approved_at}}
                                        @endempty
                                    </td>
                                </tr>
                                <tr>
                                    <th>HR View Status</th>
                                    <th>:</th>
                                    <td>
                                        @if($outdoorDutyApplication->hrm_viewed=='no')
                                            <span class="badge badge-danger">PENDING</span>
                                        @else
                                            <span class="badge badge-success">Done</span>
                                        @endif
                                        <br>
                                        @if($outdoorDutyApplication->hrm_viewed=='yes') - {{$outdoorDutyApplication->hrm_viewed_at}} @endif
                                    </td>

                                    <th style="width: 20%">GRANTED By</th>
                                    <th style="width: 1%">:</th>
                                    <td>
                                        @if($outdoorDutyApplication->granted_by > 0)
                                            {{$outdoorDutyApplication->GrantPerson->name}}
                                        @endif
                                        @empty($outdoorDutyApplication->granted_at)
                                            - <span class="badge badge-danger">PENDING</span><br>
                                        @else
                                            {{$outdoorDutyApplication->granted_at}}
                                        @endempty
                                    </td>
                                </tr>
                            </table>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 text-right">
                                        <a href="{{route('ea.attendance.outdoorDuty')}}" type="submit" class="btn btn-primary mt-4 pr-4 pl-4 text-white">Go Back</a>
                                    </div>
                                    @if($outdoorDutyApplication->status=='DRAFTED')
                                        <div class="col-md-6 text-left">
                                            <form action="{{route('ea.attendance.outdoorDuty.destroy', ['id'=>$outdoorDutyApplication->id])}}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger mt-4 pr-4 pl-4 text-white" onclick="return window.confirm('Confirm to delete?');">Delete</button>
                                            </form>
                                            <form action="{{route('ea.attendance.outdoorDuty.send', ['id'=>$outdoorDutyApplication->id])}}" method="post">
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
