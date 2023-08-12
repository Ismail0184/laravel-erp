@extends('layouts.app')

@section('title')
    @php($title = 'Dealer Info')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('sub_menu_id')) Update @else Create @endif {{$title}}  <small class="text-danger float-right"> field marked with * are mandatory</small></h4>
                <form method="POST" action="@if(request('sub_menu_id')>0) {{route('dev.sub-menu.update', ['sub_menu_id'=>$submenu->sub_menu_id])}} @else {{route('dev.sub-menu.store')}} @endif">
                    @csrf
                    @if(!request('dealer')>0)
                        <div class="form-group row mb-2">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Main Menu <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control select2" name="main_menu_id" required="required">
                                    <option value="">-- select main menu --</option>
                                    @foreach($mainmenus as $mainmenu)
                                        <option value="{{$mainmenu->main_menu_id}}" @if(request('sub_menu_id')>0) @if($submenu->main_menu_id==$mainmenu->main_menu_id) selected @endif @endif>{{$mainmenu->main_menu_id}} : {{$mainmenu->main_menu_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row mb-2">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Serial Number</label>
                        <div class="col-sm-9">
                            <input type="text" name="serial" @if(request('sub_menu_id')>0) value="{{$submenu->serial}}" @endif class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Sub Menu Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="sub_menu_name" @if(request('sub_menu_id')>0) value="{{$submenu->sub_menu_name}}" @endif class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Route <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="sub_url" @if(request('sub_menu_id')>0) value="{{$submenu->sub_url}}" @endif class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">FA Icon </label>
                        <div class="col-sm-9">
                            <input type="text" name="faicon" @if(request('sub_menu_id')>0) value="{{$submenu->faicon}}" @endif class="form-control" />
                        </div>
                    </div>
                    @if(request('sub_menu_id')>0)
                        <div class="form-group row mb-2">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($submenu->status =='active') selected @endif value="active">Active</option>
                                    <option @if($submenu->status =='inactive') selected @endif value="inactive">Inactive</option>
                                    <option @if($submenu->status =='suspended') selected @endif value="suspended">Suspended</option>
                                    <option @if($submenu->status =='deleted') selected @endif value="deleted">Deleted</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('dev.sub-menu.view')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('sub_menu_id')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
