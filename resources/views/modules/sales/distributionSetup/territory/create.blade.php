@extends('layouts.app')

@section('title')
    @php($title = 'Territory')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('territory_id')) Update @else Create @endif {{$title}}</h4>
                <form method="POST" action="@if(request('territory_id')>0) {{route('sales.ds.territory.update', ['territory_id'=>$territory->territory_id])}} @else {{route('sales.ds.territory.store')}} @endif">
                    @csrf
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Area <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                            <select class="form-control select2" name="area_id" required="required">
                                <option value=""> -- Select area -- </option>
                                @foreach($areas as $area)
                                    <option value="{{$area->area_id}}" @if(request('territory_id')>0) @if($area->area_id==$territory->area_id) selected @endif @endif>{{$area->area_id}} : {{$area->area_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">In-Charge Person <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                            <select class="form-control select2" name="in_charge_person" required="required">
                                <option value=""> -- Select users -- </option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" @if(request('territory_id')>0) @if($user->id==$territory->in_charge_person) selected @endif @endif>{{$user->id}} : {{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Territory Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="territory_name" @if(request('territory_id')>0) value="{{$territory->territory_name}}" @endif class="form-control" required>
                        </div>
                    </div>
                    @if(request('territory_id')>0)
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($territory->status =='active') selected @endif value="active">Active</option>
                                    <option @if($territory->status =='inactive') selected @endif value="inactive">Inactive</option>
                                    <option @if($territory->status =='suspended') selected @endif value="suspended">Suspended</option>
                                    <option @if($territory->status =='deleted') selected @endif value="deleted">Deleted</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('sales.ds.territory.view')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('territory_id')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
