@extends('layouts.app')

@section('title')
    @php($title = 'Trade Schemes') {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}} <a href="{{route('sales.ts.create')}}" class="btn btn-success" style="margin-left: 80.3%"><i class="mdi mdi-plus mr-1"></i> Add New</a></h4>
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
                                <th>TS name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Item Description</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 10%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tsdatas as $data)
                                <tr>
                                    <td style="text-align: center">{{$loop->iteration}}</td>
                                    <td>@if($data->status == 'deleted')<del>{{$data->offer_name}}</del> @else {{$data->offer_name}}@endif</td>
                                    <td style="text-align: left">{{$data->start_date}}</td>
                                    <td style="text-align: left">{{$data->end_date}}</td>
                                    <td style="text-align: left">{{$data->buyitem->item_name}}</td>
                                    <td>
                                        @if($data->status     == 'active') <span class="badge badge-success">Active</span>
                                        @elseif($data->status == 'inactive') <span class="badge badge-warning">Inactive</span>
                                        @elseif($data->status == 'suspended') <span class="badge badge-danger">Suspended</span>
                                        @elseif($data->status == 'deleted') <span class="badge badge-danger"><del>Deleted</del></span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <form action="{{route('sales.ts.destroy', ['id' => $data->id])}}" method="post">
                                            @csrf
                                            <a href="{{route('sales.ts.show',['id' => $data->id])}}" title="show" class="btn btn-pink btn-sm">
                                                <i class="fa fa-book"></i>
                                            </a>
                                            <a href="{{route('sales.ts.edit',['id' => $data->id])}}" title="Update" class="btn btn-success btn-sm">
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
