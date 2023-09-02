@extends('layouts.app')

@section('title')
    @php($title = 'Holiday')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('id')) Update @else Create @endif {{$title}} <small class="text-danger float-right"> field marked with * are mandatory</small></h4>
                <form method="POST" action="@if(request('id')>0) {{route('hrm.setup.holidays.update', ['id'=>$holiday->id])}} @else {{route('hrm.setup.holidays.store')}} @endif">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Date <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="date" name="holiday_date" @if(request('id')>0) value="{{$holiday->holiday_date}}" @endif class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Holiday Reason <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="reason" @if(request('id')>0) value="{{$holiday->reason}}" @endif class="form-control" required>
                        </div>
                    </div>
                    @if(request('id')>0)
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($holiday->status =='active') selected @endif value="active">Active</option>
                                    <option @if($holiday->status =='inactive') selected @endif value="inactive">Inactive</option>
                                    <option @if($holiday->status =='used') selected @endif value="suspended">Used</option>
                                    <option @if($holiday->status =='deleted') selected @endif value="deleted">Deleted</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('hrm.setup.holidays.view')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('id')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
