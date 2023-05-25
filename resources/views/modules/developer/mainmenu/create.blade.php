@extends('layouts.app')

@section('title')
    @php($title = 'Mani Menu')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('module_id')) Update @else Create @endif {{$title}}  <small class="text-danger"> field marked with * are mandatory</small></h4>
                <form method="POST" action="@if(request('module_id')>0) {{route('dev.modules.update', ['module_id'=>$module->module_id])}} @else {{route('dev.modules.store')}} @endif">
                    @csrf
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Serial Number</label>
                        <div class="col-sm-9">
                            <input type="text" name="serial" @if(request('module_id')>0) value="{{$module->serial}}" @endif class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Module Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="modulename" @if(request('module_id')>0) value="{{$module->modulename}}" @endif class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Module Short Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="module_short_name" @if(request('module_id')>0) value="{{$module->module_short_name}}" @endif class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">FA Icon </label>
                        <div class="col-sm-9">
                            <input type="text" name="fa_icon" @if(request('module_id')>0) value="{{$module->fa_icon}}" @endif class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">FA Icon Color</label>
                        <div class="col-sm-9">
                            <input type="text" name="fa_icon_color" @if(request('module_id')>0) value="{{$module->fa_icon_color}}" @endif class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Notification Type</label>
                        <div class="col-sm-9">
                            <input type="text" name="notification_type" @if(request('module_id')>0) value="{{$module->notification_type}}" @endif class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Section Type</label>
                        <div class="col-sm-9">
                            <input type="text" name="section_type" @if(request('module_id')>0) value="{{$module->section_type}}" @endif class="form-control" />
                        </div>
                    </div>
                    @if(request('module_id')>0)
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($module->status ==1) selected @endif value="1">Active</option>
                                    <option @if($module->status ==0) selected @endif value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('dev.main-menu.view')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('module_id')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
