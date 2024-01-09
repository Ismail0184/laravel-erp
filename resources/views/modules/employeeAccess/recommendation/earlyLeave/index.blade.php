@extends('layouts.app')

@section('title')
    @php($title = 'Recommendation for Early Leave Applications') {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}}</h4>
                        @if ($message = Session::get('rejected_message'))
                            <p class="text-center text-danger">{{ $message }}</p>
                        @elseif( $message = Session::get('recommended_message'))
                            <p class="text-center text-success">{{ $message }}</p>
                        @endif
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th style="width: 5%; text-align: center">#</th>
                                <th style="width: 5%; text-align: center">A.ID</th>
                                <th>Applied By</th>
                                <th>Departure Date & Time</th>
                                <th>Remarks</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 10%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($earlyLeaveApplications as $earlyLeaveApplication)
                                <tr>
                                    <td style="text-align: center; vertical-align: middle">{{$loop->iteration}}</td>
                                    <td style="text-align: center; vertical-align: middle">{{$earlyLeaveApplication->id}}</td>
                                    <td style="vertical-align: middle">{{$earlyLeaveApplication->AppliedBy->name}}</td>
                                    <td style="vertical-align: middle">{{$earlyLeaveApplication->date}} : {{$earlyLeaveApplication->departure_time}}</td>
                                    <td style="vertical-align: middle">{{$earlyLeaveApplication->reason}}</td>
                                    <td style="vertical-align: middle">
                                        @if($earlyLeaveApplication->status == 'GRANTED') <span class="badge badge-success">GRANTED</span>
                                        @elseif($earlyLeaveApplication->status == 'DELETED') <span class="badge badge-soft-danger">DELETED</span>
                                        @elseif($earlyLeaveApplication->status == 'REJECTED') <span class="badge badge-danger">REJECTED</span>
                                        @elseif($earlyLeaveApplication->status == 'DRAFTED') <span class="badge badge-dark">DRAFTED</span>
                                        @elseif($earlyLeaveApplication->status == 'PENDING') <span class="badge badge-soft-dark">PENDING</span>
                                        @elseif($earlyLeaveApplication->status == 'APPROVED') <span class="badge badge-pink">APPROVED</span>
                                        @elseif($earlyLeaveApplication->status == 'RECOMMENDED') <span class="badge badge-soft-success">RECOMMENDED</span>
                                        @endif
                                    </td>
                                    <td class="text-center" style="vertical-align: middle">
                                        <a href="{{route('ea.recommendation.earlyLeave.show',['id' => $earlyLeaveApplication->id])}}" title="show" class="btn btn-primary btn-sm">
                                            <i class="fa fa-book-reader"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
