@extends('layouts.app')

@section('title')
    @php($title = 'Travel Scope') {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}} <a href="{{route('hrm.setup.travelScope.create')}}" class="btn btn-success" style="margin-left: 81.9%"><i class="mdi mdi-plus mr-1"></i> Add New</a></h4>
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
                                <th style="width: 5%; text-align: center">ID</th>
                                <th>Travel Scope</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 10%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($travelScopes as $travelScope)
                                <tr>
                                    <td style="text-align: center">{{$loop->iteration}}</td>
                                    <td style="text-align: center">{{$travelScope->id}}</td>
                                    <td>@if($travelScope->status == 'deleted')<del>{{$travelScope->travel_scope_name}}</del> @else {{$travelScope->travel_scope_name}}@endif</td>
                                    <td>
                                        @if($travelScope->status == 'active') <span class="badge badge-success">Active</span>
                                        @elseif($travelScope->status == 'inactive') <span class="badge badge-warning">Inactive</span>
                                        @elseif($travelScope->status == 'suspended') <span class="badge badge-danger">Suspended</span>
                                        @elseif($travelScope->status == 'deleted') <span class="badge badge-danger"><del>Deleted</del></span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <form action="{{route('hrm.setup.travelScope.destroy', ['id' => $travelScope->id])}}" method="post">
                                            @csrf
                                            <a href="{{route('hrm.setup.travelScope.edit',['id' => $travelScope->id])}}" title="Update" class="btn btn-success btn-sm">
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



