@extends('layouts.app')

@section('title')
    @php($title = 'Early Leave Applications') {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}} <a href="{{route('ea.attendance.earlyLeaveApplication.create')}}" class="btn btn-success" style="margin-left: 71.9%"><i class="mdi mdi-plus mr-1"></i> Create Leave</a></h4>
                        @if ($message = Session::get('destroy_message'))
                            <p class="text-center text-danger">{{ $message }}</p>
                        @elseif( $message = Session::get('store_message'))
                            <p class="text-center text-success">{{ $message }}</p>
                        @elseif( $message = Session::get('send_message'))
                            <p class="text-center text-success">{{ $message }}</p>
                        @elseif( $message = Session::get('update_message'))
                            <p class="text-center text-primary">{{ $message }}</p>
                        @endif
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th style="width: 5%; text-align: center">#</th>
                                <th style="width: 5%; text-align: center">A.ID</th>
                                <th>Date</th>
                                <th>Departure Time</th>
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
                                    <td style="text-align: left; vertical-align: middle">{{$earlyLeaveApplication->date}}</td>
                                    <td style="vertical-align: middle">{{$earlyLeaveApplication->departure_time}}</td>
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
                                        <form action="{{route('ea.attendance.earlyLeaveApplication.destroy', ['id' => $earlyLeaveApplication->id])}}" method="post">
                                            @csrf
                                            <a href="{{route('ea.attendance.earlyLeaveApplication.show',['id' => $earlyLeaveApplication->id])}}" title="show" class="btn btn-primary btn-sm">
                                                <i class="fa fa-book-reader"></i>
                                            </a>
                                            @if($earlyLeaveApplication->status=='GRANTED')
                                                <a href="{{route('ea.attendance.earlyLeaveApplication.download',['id' => $earlyLeaveApplication->id])}}" title="download" class="btn btn-info btn-sm">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            @endif
                                            @if($earlyLeaveApplication->status=='DRAFTED')
                                                <a href="{{route('ea.attendance.earlyLeaveApplication.edit',['id' => $earlyLeaveApplication->id])}}" title="Update" class="btn btn-success btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you confirm to delete?');">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endif
                                        </form>
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
