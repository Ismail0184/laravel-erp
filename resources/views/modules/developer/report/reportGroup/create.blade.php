@extends('layouts.app')

@section('title')
    @php($title = 'Report Group') {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('id')) Update @else Create @endif {{$title}} <small class="text-danger float-right"> field marked with * are mandatory</small></h4>
                <form method="POST" action="@if(request('id')>0) {{route('dev.reportGroupLabels.update', ['id'=>$reportGroup->optgroup_label_id])}} @else {{route('dev.reportGroupLabels.store')}} @endif" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Module<span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="module_id" required="required">
                                <option value=""> -- Select Module -- </option>
                                @foreach($modules as $module)
                                    <option value="{{$module->module_id}}" @if(request('id')>0) @if($reportGroup->module_id==$module->module_id) selected @endif @endif >{{$module->module_id}} : {{$module->modulename}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Serial</label>
                        <div class="col-sm-9">
                            <input type="text" name="serial" @if(request('id')>0) value="{{$reportGroup->serial}}" @endif class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Report Group ID <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="optgroup_label_id" @if(request('id')>0) value="{{$reportGroup->optgroup_label_id}}" readonly @endif class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Report Group Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="optgroup_label_name" @if(request('id')>0) value="{{$reportGroup->optgroup_label_name}}" @endif class="form-control" required>
                        </div>
                    </div>

                    @if(request('id')>0)
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($reportGroup->status =='active') selected @endif value="active">Active</option>
                                    <option @if($reportGroup->status =='inactive') selected @endif value="inactive">Inactive</option>
                                    <option @if($reportGroup->status =='suspended') selected @endif value="suspended">Suspended</option>
                                    <option @if($reportGroup->status =='deleted') selected @endif value="deleted">Deleted</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('dev.reportGroupLabels.view')}}"><i class="fa fa-backward"></i> Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('id')) <i class="fa fa-edit"></i> Update @else <i class="fa fa-save"></i> Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
