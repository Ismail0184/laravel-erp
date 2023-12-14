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
                                    <th style="width: 20%">Recommend Person</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$leaveApplication->RecommendedPerson->name}}</td>
                                    <th style="width: 20%">Approve Person</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{$leaveApplication->ApprovedPerson->name}}</td>
                                </tr>
                                <tr>
                                    <th>Remarks <span class="required text-danger">*</span></th>
                                    <th>:</th>
                                    <td colspan="4">

                                        <input type="text" id="writeRemarks" oninput="updateInput2()" class="form-control" placeholder="Enter a note for the application, if necessary"></td>
                                </tr>
                            </table>

                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 text-right">
                                        <a href="{{route('ea.recommendation.leave')}}" type="submit" class="btn btn-primary mt-4 pr-4 pl-4 text-white">Go Back</a>
                                    </div>
                                    @if($leaveApplication->responsible_person_acceptance_status=='PENDING')
                                        <div class="col-md-6 text-left">
                                            <form action="{{route('ea.responsibleFor.leave.accept', ['id'=>$leaveApplication->id])}}" method="post">
                                                @csrf
                                                <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                                                <input type="hidden" name="status" value="PENDING">
                                                <input type="hidden" name="remarks_for_responsible_person" id="remarks_for_responsible_person">

                                                <button type="submit" class="btn btn-success mt-4 pr-4 pl-4 text-white" onclick="return window.confirm('Confirm?');">Accept <i class="fa fa-arrow-alt-circle-right"></i></button>
                                            </form>
                                            <form action="{{route('ea.responsibleFor.leave.reject', ['id'=>$leaveApplication->id])}}" method="post">
                                                @csrf
                                                <input type="hidden" name="remarks_for_responsible_person" id="remarks_for_responsible_person_reject">
                                                <button type="submit" class="btn btn-danger mt-4 pr-4 pl-4 text-white" onclick="return window.confirm('Confirm to delete?');"><i class="fa fa-arrow-alt-circle-left"></i> Reject</button>
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
    <script>
        function updateInput2() {
            var input1Value = document.getElementById('writeRemarks').value;
            document.getElementById('remarks_for_responsible_person').value = input1Value;
            document.getElementById('remarks_for_responsible_person_reject').value = input1Value;
        }
    </script>
@endsection
