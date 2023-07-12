@extends('layouts.app')

@section('title')
    @php($title='Product Sub-Group') {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}} <a href="{{route('acc.product.sub-group.create')}}" class="btn btn-success" style="margin-left: 77.5%"><i class="mdi mdi-plus mr-1"></i> Add New</a></h4>
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
                                <th>ID</th>
                                <th>Sub Group Name</th>
                                <th>Group Name</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 10%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subGroups as $subGroup)
                                <tr>
                                    <td style="text-align: center">{{$loop->iteration}}</td>
                                    <td>{{$subGroup->sub_group_id}}</td>
                                    <td>@if($subGroup->status=='deleted')<del>{{$subGroup->sub_group_name}}</del> @else {{$subGroup->sub_group_name}} @endif</td>
                                    <td>{{$subGroup->group->group_name}}</td>
                                    <td>
                                        @if($subGroup->status == 'active') <span class="badge badge-success">Active</span>
                                        @elseif($subGroup->status == 'inactive') <span class="badge badge-warning">Inactive</span>
                                        @elseif($subGroup->status == 'suspended') <span class="badge badge-danger">Suspended</span>
                                        @elseif($subGroup->status == 'deleted') <span class="badge badge-danger"><del>Deleted</del></span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <form action="{{route('acc.product.sub-group.destroy', ['sub_group_id' => $subGroup->sub_group_id])}}" method="post">
                                            @csrf
                                            <a href="{{route('acc.product.sub-group.edit',['sub_group_id' => $subGroup->sub_group_id])}}" title="Update" class="btn btn-success btn-sm">
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



