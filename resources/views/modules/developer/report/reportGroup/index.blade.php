@extends('layouts.app')

@section('title')
    @php($title = 'Report Group Level') {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}} <a href="{{route('dev.reportGroupLabels.create')}}" class="btn btn-primary" style="margin-left: 77.7%"><i class="mdi mdi-plus mr-1"></i> Add New</a></h4>
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
                                <th>Report Group Name</th>
                                <th>Module Name</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 10%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reportGroups as $reportGroup)
                                <tr>
                                    <td style="text-align: center; vertical-align: middle">{{$loop->iteration}}</td>
                                    <td style="text-align: left; vertical-align: middle">{{$reportGroup->optgroup_label_id}} : @if($reportGroup->status == 'deleted')<del>{{$reportGroup->optgroup_label_name}}</del> @else {{$reportGroup->optgroup_label_name}}@endif</td>
                                    <td style="text-align: left; vertical-align: middle">{{$reportGroup->module_id}} : {{$reportGroup->getModuleInfo->modulename}}</td>
                                    <td style="vertical-align: middle">
                                        @if($reportGroup->status == 'active') <span class="badge badge-success">Active</span>
                                        @elseif($reportGroup->status == 'inactive') <span class="badge badge-warning">Inactive</span>
                                        @elseif($reportGroup->status == 'suspended') <span class="badge badge-danger">Suspended</span>
                                        @elseif($reportGroup->status == 'deleted') <span class="badge badge-danger"><del>Deleted</del></span>
                                        @endif
                                    </td>
                                    <td class="text-center" style="vertical-align: middle">
                                        <form action="{{route('dev.reportGroupLabels.destroy', ['id' => $reportGroup->optgroup_label_id])}}" method="post">
                                            @csrf
                                            <a href="{{route('dev.reportGroupLabels.edit',['id' => $reportGroup->optgroup_label_id])}}" title="Update" class="btn btn-success btn-sm">
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



