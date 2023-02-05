@extends('layouts.app')

@section('title')
    COA Sub-Class
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">COA Sub-Class <a href="{{route('acc.sub-class.create')}}" class="btn btn-primary" style="margin-left: 81.30%">Add New</a></h4>
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
                                <th>Code</th>
                                <th>Name</th>
                                <th>Class</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 15%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subClasses as $subClass)
                                <tr>
                                    <td style="text-align: center">{{$loop->iteration}}</td>
                                    <td style="text-align: center">{{$subClass->id}}</td>
                                    <td>{{$subClass->sub_class_id}}</td>
                                    <td>{{$subClass->sub_class_name}}</td>
                                    <td>{{$subClass->accClass->class_id}} : {{$subClass->accClass->class_name}}</td>
                                    <td>@if($subClass->status == '1') <span class="badge badge-success">Active</span> @elseif($subClass->status == '0') <span class="badge badge-danger">Inactive</span> @endif</td>
                                    <td class="text-center">
                                        <form action="{{route('acc.sub-class.destroy', ['id' => $subClass->id])}}" method="post">
                                            @csrf
                                            <a href="{{route('acc.class.show',['id' => $subClass->id])}}" title="View" class="btn btn-primary btn-sm">
                                                <i class="fa fa-book"></i>
                                            </a>
                                            <a href="{{route('acc.sub-class.edit',['id' => $subClass->id])}}" title="Update" class="btn btn-success btn-sm">
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



