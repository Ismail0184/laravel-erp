@extends('layouts.app')

@section('title')
    @php($title = 'Vendor Category') {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}} <a href="{{route('pro.vendor.category.create')}}" class="btn btn-success" style="margin-left: 79%"><i class="mdi mdi-plus mr-1"></i> Add New</a></h4>
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
                                <th>Id</th>
                                <th>Category Name</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 10%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categorys as $category)
                                <tr>
                                    <td style="text-align: center">{{$loop->iteration}}</td>
                                    <td>{{$category->id}}</td>
                                    <td>@if($category->status == 'deleted')<del> {{$category->category_name}} </del> @else {{$category->category_name}} @endif</td>
                                    <td>{{$category->getType->vendor_type}}</td>
                                    <td style="vertical-align: middle">
                                        @if($category->status == 'active') <span class="badge badge-success">Active</span>
                                        @elseif($category->status == 'inactive') <span class="badge badge-soft-danger">Inactive</span>
                                        @elseif($category->status == 'deleted') <span class="badge badge-danger"><del>DELETED</del></span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <form action="{{route('pro.vendor.category.destroy', ['id' => $category->id])}}" method="post">
                                            @csrf
                                            <a href="{{route('pro.vendor.category.edit',['id' => $category->id])}}" title="Update" class="btn btn-success btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button category="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you confirm to delete?');">
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



