@extends('layouts.app')

@section('title')
    @php($title = 'Region') {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}} <a href="{{route('sales.ds.region.create')}}" class="btn btn-success" style="margin-left: 82.8%"><i class="mdi mdi-plus mr-1"></i> Add New</a></h4>
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
                                <th style="width: 5%; text-align: center">Region ID</th>
                                <th>Region name</th>
                                <th>In-charge Person</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 10%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($regions as $region)
                                <tr>
                                    <td style="text-align: center">{{$loop->iteration}}</td>
                                    <td style="text-align: center">{{$region->region_id}}</td>
                                    <td>@if($region->status == 'deleted')<del>{{$region->region_name}}</del> @else {{$region->region_name}}@endif</td>
                                    <td>{{$region->user->name}}</td>
                                    <td>
                                        @if($region->status == 'active') <span class="badge badge-success">Active</span>
                                        @elseif($region->status == 'inactive') <span class="badge badge-warning">Inactive</span>
                                        @elseif($region->status == 'suspended') <span class="badge badge-danger">Suspended</span>
                                        @elseif($region->status == 'deleted') <span class="badge badge-danger"><del>Deleted</del></span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <form action="{{route('sales.ds.region.destroy', ['region_id' => $region->region_id])}}" method="post">
                                            @csrf
                                            <a href="{{route('sales.ds.region.edit',['region_id' => $region->region_id])}}" title="Update" class="btn btn-success btn-sm">
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



