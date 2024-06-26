@extends('layouts.app')

@section('title')
    @php($title = 'Other Options') {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}} <a href="{{route('dev.builder.other.create')}}" class="btn btn-success" style="margin-left: 81.4%"><i class="mdi mdi-plus mr-1"></i> Add New</a></h4>
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
                                <th>Option Name</th>
                                <th>key</th>
                                <th>Route</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 10%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($others as $other)
                                <tr>
                                    <td style="text-align: center">{{$loop->iteration}}</td>
                                    <td>@if($other->status == 'deleted')<del>{{$other->name}}</del> @else {{$other->name}}@endif</td>
                                    <td style="text-align: left">{{$other->key}}</td>
                                    <td style="text-align: left">{{$other->route}}</td>
                                    <td>
                                        @if($other->status == 'active') <span class="badge badge-success">Active</span>
                                        @elseif($other->status == 'inactive') <span class="badge badge-warning">Inactive</span>
                                        @elseif($other->status == 'suspended') <span class="badge badge-danger">Suspended</span>
                                        @elseif($other->status == 'deleted') <span class="badge badge-danger"><del>Deleted</del></span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <form action="{{route('dev.builder.other.destroy', ['id' => $other->id])}}" method="post">
                                            @csrf
                                            <a href="{{route('dev.builder.other.edit',['id' => $other->id])}}" title="Update" class="btn btn-success btn-sm">
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



