@extends('layouts.app')

@section('title')
    @php($title = 'Meta Data') {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}} <a href="{{route('dev.usageControl.meta.create')}}" class="btn btn-success" style="margin-left: 83.6%"><i class="mdi mdi-plus mr-1"></i> Add New</a></h4>
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
                                <th style="text-align: center">Meta Name</th>
                                <th style="text-align: center">Meta Id</th>
                                <th>Meta Value</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 10%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($usageControlData as $data)
                                <tr>
                                    <td style="text-align: center">{{$loop->iteration}}</td>
                                    <td style="text-align: left">{{$data->meta_name}}</td>
                                    <td style="text-align: left">{{$data->meta_key}}</td>
                                    <td>@if($data->status == 'postpone')<del>{{$data->meta_value}}</del> @else {{$data->meta_value}}@endif</td>

                                    <td>
                                        @if($data->status == 'active') <span class="badge badge-success">Active</span>
                                        @elseif($data->status == 'postpone') <span class="badge badge-danger"><del>Postpone</del></span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <form action="{{route('dev.usageControl.meta.destroy', ['id' => $data->id])}}" method="post">
                                            @csrf
                                            <a href="{{route('dev.usageControl.meta.edit',['id' => $data->id])}}" title="Update" class="btn btn-success btn-sm">
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
