@extends('layouts.app')

@section('title')
    Create Class
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('id')) Update @else Create @endif Class</h4>
                <form method="POST" action="@if(request('id')>0) {{route('acc.class.update', ['id'=>$class->id])}} @else {{route('acc.class.store')}} @endif">
                    @csrf
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Code <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="class_id" @if(request('id')>0) value="{{$class->class_id}}" @endif class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="class_name" @if(request('id')>0) value="{{$class->class_name}}" @endif class="form-control" required>
                        </div>
                    </div>
                    @if(request('id')>0)
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($class->status ==1) selected @endif value="1">Active</option>
                                    <option @if($class->status ==0) selected @endif value="0">Inactive</option>
\                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('acc.class.view')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('id')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
