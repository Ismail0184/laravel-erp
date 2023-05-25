@extends('layouts.app')

@section('title')
    @php($title = 'Mani Menu')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('main_menu_id')) Update @else Create @endif {{$title}}  <small class="text-danger"> field marked with * are mandatory</small></h4>
                <form method="POST" action="@if(request('main_menu_id')>0) {{route('dev.main-menu.update', ['main_menu_id'=>$mainmenu->main_menu_id])}} @else {{route('dev.main-menu.store')}} @endif">
                    @csrf
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Serial Number</label>
                        <div class="col-sm-9">
                            <input type="text" name="serial" @if(request('main_menu_id')>0) value="{{$mainmenu->serial}}" @endif class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Main Menu Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="main_menu_name" @if(request('main_menu_id')>0) value="{{$mainmenu->main_menu_name}}" @endif class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">URL <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="url" @if(request('main_menu_id')>0) value="{{$mainmenu->url}}" @endif class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Quick Access URL</label>
                        <div class="col-sm-9">
                            <input type="text" name="quick_access_url" @if(request('main_menu_id')>0) value="{{$mainmenu->quick_access_url}}" @endif class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">FA Icon </label>
                        <div class="col-sm-9">
                            <input type="text" name="faicon" @if(request('main_menu_id')>0) value="{{$mainmenu->faicon}}" @endif class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">FA Icon Color</label>
                        <div class="col-sm-9">
                            <input type="text" name="fa_icon_color" @if(request('main_menu_id')>0) value="{{$mainmenu->fa_icon_color}}" @endif class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Notification Type</label>
                        <div class="col-sm-9">
                            <input type="text" name="notification_type" @if(request('main_menu_id')>0) value="{{$mainmenu->notification_type}}" @endif class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Section Type</label>
                        <div class="col-sm-9">
                            <input type="text" name="section_type" @if(request('main_menu_id')>0) value="{{$mainmenu->section_type}}" @endif class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Ledger Group <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="module_id" required="required">
                                <option value="">-- Module --</option>
                                @foreach($modules as $module)
                                    <option value="{{$module->module_id}}" @if(request('main_menu_id')>0) @if($mainmenu->module_id==$module->module_id) selected @endif @endif>{{$module->module_id}} : {{$module->modulename}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @if(request('main_menu_id')>0)
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
                                <button type="submit" class="btn btn-primary w-md">@if(request('main_menu_id')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
