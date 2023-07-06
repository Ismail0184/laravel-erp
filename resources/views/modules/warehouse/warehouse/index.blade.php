@extends('layouts.app')

@section('title')
    @php($title='Warehouse') {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}} <a href="{{route('wh.warehouse.create')}}" class="btn btn-success" style="margin-left: 83%"><i class="mdi mdi-plus mr-1"></i> Add New</a></h4>
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
                                <th>Name</th>
                                <th>Address</th>
                                <th>POC Name</th>
                                <th>POC Designation</th>
                                <th>POC Mobile</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 10%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($warehouses as $warehouse)
                                <tr>
                                    <td style="text-align: center">{{$loop->iteration}}</td>
                                    <td>{{$warehouse->warehouse_id}}</td>
                                    <td>@if($warehouse->status=='deleted')<del>{{$warehouse->warehouse_name}}</del> @else {{$warehouse->warehouse_name}} @endif</td>
                                    <td>{{$warehouse->address}}</td>
                                    <td>{{$warehouse->poc_name}}</td>
                                    <td>{{$warehouse->poc_designation}}</td>
                                    <td>{{$warehouse->poc_number}}</td>
                                    <td>
                                        @if($warehouse->status == 'active') <span class="badge badge-success">Active</span>
                                        @elseif($warehouse->status == 'inactive') <span class="badge badge-warning">Inactive</span>
                                        @elseif($warehouse->status == 'suspended') <span class="badge badge-danger">Suspended</span>
                                        @elseif($warehouse->status == 'deleted') <span class="badge badge-danger"><del>Deleted</del></span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <form action="{{route('wh.warehouse.destroy', ['warehouse_id' => $warehouse->warehouse_id])}}" method="post">
                                            @csrf
                                            <a href="{{route('wh.warehouse.edit',['warehouse_id' => $warehouse->warehouse_id])}}" title="Update" class="btn btn-success btn-sm">
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



