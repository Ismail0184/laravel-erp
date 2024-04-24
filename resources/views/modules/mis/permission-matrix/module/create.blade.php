@extends('layouts.app')

@section('title')
    @php($title = 'Module')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Add {{$title}} <small class="text-danger float-right"> field marked with * are mandatory</small></h4>
                <form method="POST" action="{{route('mis.permissionMatrix.module.store')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="permitted_by" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="user_id" value="{{ request('id') }}">

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Employee / User Name</label>
                        <div class="col-sm-3">
                            <input type="text" name="name" readonly value="{{$userName}}" class="form-control" required>
                        </div>

                        <div class="col-sm-3">
                            <input type="text" name="name" readonly value="{{$userDesignation}}" class="form-control" required>
                        </div>

                        <div class="col-sm-3">
                            <input type="text" name="name" readonly value="{{$userDepartment}}" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Modules<span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" multiple name="module_id[]" required="required">
                                <option value=""> -- Select Module -- </option>
                                @foreach($modules as $module)
                                    <option value="{{$module->module_id}}" >{{$module->module_id}} : {{$module->modulename}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('mis.permissionMatrix.module')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">Add</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Permitted Modules</h4>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th style="width: 5%; text-align: center">#</th>
                                <th>Module Name</th>
                                <th>Short Name</th>
                                <th>Fa Icon</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 10%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($userModulePermissions as $user)
                                <tr>
                                    <td style="text-align: center; vertical-align: middle">{{$loop->iteration}}</td>
                                    <td style="text-align:left; vertical-align: middle">{{$user->module_id}} : {{$user->getModuleData->modulename}}</td>
                                    <td style="text-align: left; vertical-align: middle">{{$user->getModuleData->module_short_name}}</td>
                                    <td style="text-align: left; vertical-align: middle">{{$user->getModuleData->fa_icon}}</td>
                                    <td style="vertical-align: middle">
                                        @if($user->status == 'active') <span class="badge badge-success">Active</span>
                                        @elseif($user->status == 'inactive') <span class="badge badge-danger"><del>Inactive</del></span>
                                        @endif
                                    </td>
                                    <td class="text-center" style="vertical-align: middle">
                                        <form action="{{route('mis.permissionMatrix.module.update', ['id' => $user->module_id])}}" method="post">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ request('id') }}">
                                            @if($user->status == 'active')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Inactive" onclick="return confirm('Are you confirm to Inactive?');">
                                                    Inactive
                                                </button>
                                                <input type="hidden" name="status" value="inactive">
                                            @else

                                                <button type="submit" class="btn btn-success btn-sm" title="Active" onclick="return confirm('Are you confirm to Active?');">
                                                    Re-active
                                                </button>
                                                <input type="hidden" name="status" value="active">
                                            @endif

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
