@extends('layouts.app')

@section('title')
    @php($title = 'Master Menu Permission') {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}}</h4>
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
                                <th>Employee Name</th>
                                <th>Designation</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 10%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td style="text-align: center; vertical-align: middle">{{$loop->iteration}}</td>
                                    <td style="text-align: center; vertical-align: middle">{{$user->id}}</td>
                                    <td style="vertical-align: middle">@if($user->status == 'deleted')<del>{{$user->name}}</del> @else {{$user->name}}@endif</td>
                                    <td style="text-align: left; vertical-align: middle">{{ $user->jobInfoTable->getDesignation->designation_name ?? '-' }}</td>
                                    <td style="text-align: left; vertical-align: middle">{{ $user->jobInfoTable->getDepartment->department_name ?? '-' }}</td>
                                    <td style="vertical-align: middle">
                                        @if($user->status == 'active') <span class="badge badge-success">Active</span>
                                        @elseif($user->status == 'banned') <span class="badge badge-danger"><del>Banned</del></span>
                                        @endif
                                    </td>
                                    <td class="text-center" style="vertical-align: middle">
                                        <a href="{{route('mis.permissionMatrix.mainMenu.create',['id' => $user->id])}}" title="Update" class="btn btn-primary btn-sm">
                                            <i class="fa fa-plus"></i>
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
