@extends('layouts.app')

@section('title')
    @php($title = 'Dealer Info') {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}} <a href="{{route('sales.dealer.create')}}" class="btn btn-success" style="margin-left: 83.5%"><i class="mdi mdi-plus mr-1"></i> Add New</a></h4>
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
                                <th style="width: 5%; text-align: center">Dealer Id</th>
                                <th>Dealer name</th>
                                <th>Area</th>
                                <th>In-charge Person</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 10%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dealers as $dealer)
                                <tr>
                                    <td style="text-align: center">{{$loop->iteration}}</td>
                                    <td style="text-align: center">{{$dealer->town_id}}</td>
                                    <td>@if($dealer->status == 'deleted')<del>{{$dealer->town_name}}</del> @else {{$dealer->town_name}}@endif</td>
                                    <td>{{$dealer->territory->territory_name}}</td>
                                    <td>{{$dealer->user->name}}</td>
                                    <td>
                                        @if($dealer->status == 'active') <span class="badge badge-success">Active</span>
                                        @elseif($dealer->status == 'inactive') <span class="badge badge-warning">Inactive</span>
                                        @elseif($dealer->status == 'suspended') <span class="badge badge-danger">Suspended</span>
                                        @elseif($dealer->status == 'deleted') <span class="badge badge-danger"><del>Deleted</del></span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <form action="{{route('sales.ds.town.destroy', ['town_id' => $dealer->town_id])}}" method="post">
                                            @csrf
                                            <a href="{{route('sales.ds.town.edit',['town_id' => $dealer->town_id])}}" title="Update" class="btn btn-success btn-sm">
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
