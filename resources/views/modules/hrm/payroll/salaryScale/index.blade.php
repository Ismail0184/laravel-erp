@extends('layouts.app')

@section('title')
    @php($title = 'Salary Scale') {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}} <a href="{{route('hrm.payroll.salaryScale.create')}}" class="btn btn-success" style="margin-left: 82.4%"><i class="mdi mdi-plus mr-1"></i> Add New</a></h4>
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
                                <th style="width: 5%; text-align: center">UID</th>
                                <th>Code</th>
                                <th>Employee Name</th>
                                <th>Photo</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 10%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($salaryScales as $salaryScale)
                                <tr>
                                    <td style="text-align: center; vertical-align: middle">{{$loop->iteration}}</td>
                                    <td style="text-align: center; vertical-align: middle">{{$salaryScale->id}}</td>
                                    <td style="text-align: left; vertical-align: middle">{{$salaryScale->code}}</td>
                                    <td style="vertical-align: middle">@if($salaryScale->status == 'deleted')<del>{{$salaryScale->full_name}}</del> @else {{$salaryScale->full_name}}@endif</td>
                                    <td style="vertical-align: middle">
                                        @if($salaryScale->job_status == 'In Service') <span class="badge badge-success">In Service</span>
                                        @elseif($salaryScale->job_status == 'Not In Service') <span class="badge badge-danger"><del>Not In Service</del></span>
                                        @endif
                                    </td>
                                    <td class="text-center" style="vertical-align: middle">
                                        <form action="{{route('hrm.employee.destroy', ['id' => $employee->id])}}" method="post">
                                            @csrf
                                            <a href="{{route('hrm.employee.show',['id' => $employee->id])}}" title="show" target="_blank" class="btn btn-primary btn-sm">
                                                <i class="fa fa-book-reader"></i>
                                            </a>
                                            <a href="{{route('hrm.employee.edit',['id' => $employee->id])}}" title="Update" class="btn btn-success btn-sm">
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



