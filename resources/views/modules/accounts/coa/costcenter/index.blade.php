@extends('layouts.app')

@section('title')
    @php($title = 'Cost Center') {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}} <a href="{{route('acc.cost-center.create')}}" class="btn btn-success" style="margin-left: 82.8%"><i class="mdi mdi-plus mr-1"></i> Add New</a></h4>
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
                                <th style="width: 5%; text-align: center">Uid</th>
                                <th>Cost Center name</th>
                                <th>Category name</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 10%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($costcenters as $costcenter)
                                <tr>
                                    <td style="text-align: center">{{$loop->iteration}}</td>
                                    <td style="text-align: center">{{$costcenter->cc_code}}</td>
                                    <td>@if($costcenter->status == 'deleted')<del>{{$costcenter->center_name}}</del> @else {{$costcenter->center_name}}@endif</td>
                                    <td>{{$costcenter->costcategoryforcostcenter->category_name}}</td>
                                    <td>
                                        @if($costcenter->status == 'active') <span class="badge badge-success">Active</span>
                                        @elseif($costcenter->status == 'inactive') <span class="badge badge-warning">Inactive</span>
                                        @elseif($costcenter->status == 'suspended') <span class="badge badge-danger">Suspended</span>
                                        @elseif($costcenter->status == 'deleted') <span class="badge badge-danger"><del>Deleted</del></span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <form action="{{route('acc.cost-center.destroy', ['cc_code' => $costcenter->cc_code])}}" method="post">
                                            @csrf
                                            <a href="{{route('acc.cost-center.edit',['cc_code' => $costcenter->cc_code])}}" title="Update" class="btn btn-success btn-sm">
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



