@extends('layouts.app')

@section('title')
    @php($title = 'Companies') {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}} <a href="{{route('dev.company.create')}}" class="btn btn-success" style="margin-left: 83%"><i class="mdi mdi-plus mr-1"></i> Add New</a></h4>
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
                                <th>Company Name</th>
                                <th>Group Name</th>
                                <th>Address</th>
                                <th>Website</th>
                                <th>Logo</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 10%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($companies as $company)
                                <tr>
                                    <td style="text-align: center; vertical-align: middle">{{$loop->iteration}}</td>
                                    <td style="text-align: left; vertical-align: middle">{{$company->id}} : @if($company->status == 'deleted')<del>{{$company->company_name}}</del> @else {{$company->company_name}}@endif</td>
                                    <td style="text-align: left; vertical-align: middle">{{$company->group_id}} : {{$company->getGroup->group_name}}</td>
                                    <td style="text-align: left; vertical-align: middle">{{$company->website}}</td>
                                    <td style="text-align: left; vertical-align: middle">{{$company->website}}</td>
                                    <td style="text-align: left; vertical-align: middle"><img src="{{asset($company->logo)}}" alt="" style="height: 50px; width: 50px"></td>
                                    <td style="vertical-align: middle">
                                        @if($company->status == 'active') <span class="badge badge-success">Active</span>
                                        @elseif($company->status == 'inactive') <span class="badge badge-warning">Inactive</span>
                                        @elseif($company->status == 'suspended') <span class="badge badge-danger">Suspended</span>
                                        @elseif($company->status == 'deleted') <span class="badge badge-danger"><del>Deleted</del></span>
                                        @endif
                                    </td>
                                    <td class="text-center" style="vertical-align: middle">
                                        <form action="{{route('dev.company.destroy', ['id' => $company->id])}}" method="post">
                                            @csrf
                                            <a href="{{route('dev.company.edit',['id' => $company->id])}}" title="Update" class="btn btn-success btn-sm">
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



