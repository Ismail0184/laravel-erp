@extends('layouts.app')

@section('title')
    @php($title = 'Cost Category') {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}} <a href="{{route('acc.cost-category.create')}}" class="btn btn-success" style="margin-left: 81%"><i class="mdi mdi-plus mr-1"></i> Add New</a></h4>
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
                                <th>Cost Category name</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 10%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($costcategories as $costcategory)
                                <tr>
                                    <td style="text-align: center">{{$loop->iteration}}</td>
                                    <td style="text-align: center">{{$costcategory->id}}</td>
                                    <td>@if($costcategory->status == 'deleted')<del>{{$costcategory->category_name}}</del> @else {{$costcategory->category_name}}@endif</td>
                                    <td>
                                        @if($costcategory->status == 'active') <span class="badge badge-success">Active</span>
                                        @elseif($costcategory->status == 'inactive') <span class="badge badge-warning">Inactive</span>
                                        @elseif($costcategory->status == 'suspended') <span class="badge badge-danger">Suspended</span>
                                        @elseif($costcategory->status == 'deleted') <span class="badge badge-danger"><del>Deleted</del></span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <form action="{{route('acc.cost-category.destroy', ['id' => $costcategory->id])}}" method="post">
                                            @csrf
                                            <a href="{{route('acc.cost-category.edit',['id' => $costcategory->id])}}" title="Update" class="btn btn-success btn-sm">
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



