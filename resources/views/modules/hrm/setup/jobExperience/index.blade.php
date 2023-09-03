@extends('layouts.app')

@section('title')
    @php($title = 'Job Experiences') {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}} <a href="{{route('hrm.setup.jobExperience.create')}}" class="btn btn-success" style="margin-left: 79.5%"><i class="mdi mdi-plus mr-1"></i> Add New</a></h4>
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
                                <th style="width: 5%; text-align: center">ID</th>
                                <th>jobExperience Name</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 10%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($jobExperiences as $jobExperience)
                                <tr>
                                    <td style="text-align: center">{{$loop->iteration}}</td>
                                    <td style="text-align: center">{{$jobExperience->id}}</td>
                                    <td>@if($jobExperience->status == 'deleted')<del>{{$jobExperience->job_experience_name}}</del> @else {{$jobExperience->job_experience_name}}@endif</td>
                                    <td>
                                        @if($jobExperience->status == 'active') <span class="badge badge-success">Active</span>
                                        @elseif($jobExperience->status == 'inactive') <span class="badge badge-warning">Inactive</span>
                                        @elseif($jobExperience->status == 'suspended') <span class="badge badge-danger">Suspended</span>
                                        @elseif($jobExperience->status == 'deleted') <span class="badge badge-danger"><del>Deleted</del></span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <form action="{{route('hrm.setup.jobExperience.destroy', ['id' => $jobExperience->id])}}" method="post">
                                            @csrf
                                            <a href="{{route('hrm.setup.jobExperience.edit',['id' => $jobExperience->id])}}" title="Update" class="btn btn-success btn-sm">
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



