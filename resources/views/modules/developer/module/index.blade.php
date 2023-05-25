@extends('layouts.app')

@section('title')
    @php($title = 'Modules')
    {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}} <a href="{{route('dev.modules.create')}}" class="btn btn-primary" style="margin-left: 86%">Add New</a></h4>
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
                                <th>Name</th>
                                <th>Short Name</th>
                                <th>Fa Icon</th>
                                <th>FA Icon Color</th>
                                <!--th>Notification Type</th-->
                                <th>Section Type</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 15%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($modules as $module)
                                <tr>
                                    <td style="text-align: center">{{$loop->iteration}}</td>
                                    <td style="text-align: center">{{$module->module_id}}</td>
                                    <td>{{$module->modulename}}</td>
                                    <td>{{$module->module_short_name}}</td>
                                    <td>{{$module->fa_icon}}</td>
                                    <td>{{$module->fa_icon_color}}</td>
                                    <!--td>{{$module->notification_type}}</td-->
                                    <td>{{$module->section_type}}</td>
                                    <td>@if($module->status == '1') <span class="badge badge-success">Active</span> @elseif($module->status == '0') <span class="badge badge-danger">Inactive</span> @endif</td>
                                    <td class="text-center">
                                        <form action="{{route('dev.modules.destroy', ['module_id' => $module->module_id])}}" method="post">
                                            @csrf
                                            <a href="{{route('dev.modules.show',['module_id' => $module->module_id])}}" title="View" class="btn btn-primary btn-sm">
                                                <i class="fa fa-book"></i>
                                            </a>
                                            <a href="{{route('dev.modules.edit',['module_id' => $module->module_id])}}" title="Update" class="btn btn-success btn-sm">
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



