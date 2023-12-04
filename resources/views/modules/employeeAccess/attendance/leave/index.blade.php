@extends('layouts.app')

@section('title')
    @php($title = 'Leave Applications') {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}} <a href="{{route('ea.attendance.leaveApplication.create')}}" class="btn btn-success" style="margin-left: 75.7%"><i class="mdi mdi-plus mr-1"></i> Create Leave</a></h4>
                        @if ($message = Session::get('destroy_message'))
                            <p class="text-center text-danger">{{ $message }}</p>
                        @elseif( $message = Session::get('store_message'))
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
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Total Days</th>
                                <th>Remarks</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 10%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($leaveApplications as $leaveApplication)
                                <tr>
                                    <td style="text-align: center; vertical-align: middle">{{$loop->iteration}}</td>
                                    <td style="text-align: center; vertical-align: middle">{{$leaveApplication->id}}</td>
                                    <td style="text-align: left; vertical-align: middle">{{$leaveApplication->created_at}}</td>
                                    <td style="vertical-align: middle">{{$leaveApplication->start_date}}</td>
                                    <td style="vertical-align: middle">{{$leaveApplication->end_date}}</td>
                                    <td style="vertical-align: middle">{{$leaveApplication->total_days}}</td>
                                    <td style="vertical-align: middle">{{$leaveApplication->reason}}</td>
                                    <td style="vertical-align: middle">
                                        @if($leaveApplication->status == 'GRANTED') <span class="badge badge-success">GRANTED</span>
                                        @elseif($leaveApplication->status == 'REJECTED') <span class="badge badge-danger">REJECTED</span>
                                        @elseif($leaveApplication->status == 'DRAFTED') <span class="badge badge-dark">DRAFTED</span>
                                        @elseif($leaveApplication->status == 'PENDING') <span class="badge badge-warning">PENDING</span>
                                        @elseif($leaveApplication->status == 'APPROVED') <span class="badge badge-pink">APPROVED</span>
                                        @elseif($leaveApplication->status == 'RECOMMENDED') <span class="badge badge-soft-success">RECOMMENDED</span>
                                        @endif
                                    </td>
                                    <td class="text-center" style="vertical-align: middle">
                                        <form action="{{route('hrm.employee.destroy', ['id' => $leaveApplication->id])}}" method="post">
                                            @csrf
                                            <a href="{{route('hrm.employee.show',['id' => $leaveApplication->id])}}" title="show" target="_blank" class="btn btn-primary btn-sm">
                                                <i class="fa fa-book-reader"></i>
                                            </a>
                                            <a href="{{route('hrm.employee.edit',['id' => $leaveApplication->id])}}" title="Update" class="btn btn-success btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you confirm to delete?');">
                                                <i class="fa fa-trash"></i>
                                            </button>
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



