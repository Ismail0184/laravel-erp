@extends('layouts.app')

@section('title')
    @php($title = 'Users') {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}} <a href="{{route('dev.user.createErpUser.create')}}" class="btn btn-success" style="margin-left: 87.2%"><i class="mdi mdi-plus mr-1"></i> Add New</a></h4>
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Designation</th>
                                <th>Department</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 10%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td style="text-align: center; vertical-align: middle">{{$loop->iteration}}</td>
                                    <td style="vertical-align: middle">@if($user->status == 'deleted')<del>{{$user->id}} : {{$user->name}}</del> @else {{$user->id}} : {{$user->name}}@endif</td>
                                    <td style="text-align:; vertical-align: middle">{{$user->email}}</td>
                                    <td style="text-align: left; vertical-align: middle">{{ $user->jobInfoTable->getDesignation->designation_name ?? '-' }}</td>
                                    <td style="text-align: left; vertical-align: middle">{{ $user->jobInfoTable->getDepartment->department_name ?? '-' }}</td>
                                    <td style="text-align: left; vertical-align: middle">{{ $user->type}}</td>
                                    <td style="vertical-align: middle">
                                        @if($user->status == 'active') <span class="badge badge-success">Active</span>
                                        @elseif($user->status == 'banned') <span class="badge badge-danger"><del>Banned</del></span>
                                        @endif
                                    </td>
                                    <td class="text-center" style="vertical-align: middle">
                                        <form action="{{route('dev.user.createUser.destroy', ['id' => $user->id])}}" method="post">
                                            @csrf
                                            <a href="{{route('dev.user.createUser.edit',['id' => $user->id])}}" title="Update" class="btn btn-success btn-sm">
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



