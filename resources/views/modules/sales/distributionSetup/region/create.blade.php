@extends('layouts.app')

@section('title')
    @php($title = 'Region')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('region_id')) Update @else Create @endif {{$title}}</h4>
                <form method="POST" action="@if(request('region_id')>0) {{route('sales.ds.region.update', ['region_id'=>$region->region_id])}} @else {{route('sales.ds.region.store')}} @endif">
                    @csrf
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">In-Charge Person <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                            <select class="form-control select2" name="in_charge_person" required="required">
                                <option value=""> -- Select users -- </option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" @if(request('region_id')>0) @if($user->id==$region->in_charge_person) selected @endif @endif>{{$user->id}} : {{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Region Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="region_name" @if(request('region_id')>0) value="{{$region->region_name}}" @endif class="form-control" required>
                        </div>
                    </div>
                    @if(request('region_id')>0)
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($region->status =='active') selected @endif value="active">Active</option>
                                    <option @if($region->status =='inactive') selected @endif value="inactive">Inactive</option>
                                    <option @if($region->status =='suspended') selected @endif value="suspended">Suspended</option>
                                    <option @if($region->status =='deleted') selected @endif value="deleted">Deleted</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('sales.ds.region.view')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('region_id')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
