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
                                    <th style="width: 20%">Responsible Person</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$leaveApplication->responsiblePerson->name}}</td>
                                    <th style="width: 20%">Approve Person</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$leaveApplication->ApprovedPerson->name}}
                                        @empty($leaveApplication->approved_at)
                                            - <span class="badge badge-danger">PENDING</span><br>
                                        @else
                                            {{$leaveApplication->approved_at}}
                                        @endempty
                                    </td>
                                </tr>
                            </table>

                            <table class="table mb-0">
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
                                        <td style="text-align: center">{{$type['total_leave_taken']}}</td>
                                    @endforeach
                                </tr>
                                <tr class="font-size-11">
                                    <td>Applied (Pending Approval)</td>
                                    @foreach($leave_taken as $type)
                                        <td style="text-align: center">{{$type['total_leave_applied']}}</td>
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
                            </table>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 text-right">
                                        <a href="{{route('ea.recommendation.leave')}}" type="submit" class="btn btn-primary mt-4 pr-4 pl-4 text-white">Go Back</a>
                                    </div>
                                    @if($leaveApplication->status=='PENDING')
                                        <div class="col-md-6 text-left">
                                            <form action="{{route('ea.recommendation.leave.reject', ['id'=>$leaveApplication->id])}}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger mt-4 pr-4 pl-4 text-white" onclick="return window.confirm('Confirm to delete?');">Reject</button>
                                            </form>
                                            <form action="{{route('ea.recommendation.leave.recommend', ['id'=>$leaveApplication->id])}}" method="post">
                                                @csrf
                                                <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                                                <input type="hidden" name="status" value="PENDING">
                                                <button type="submit" class="btn btn-success mt-4 pr-4 pl-4 text-white" onclick="return window.confirm('Confirm?');">Recommend the Application</button>
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
