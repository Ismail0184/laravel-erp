@extends('layouts.app')

@section('title')
    @php($title = 'Meta Data') {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('id')) Update @else Create @endif {{$title}} <small class="text-danger float-right"> field marked with * are mandatory</small></h4>
                <form method="POST" action="@if(request('id')>0) {{route('dev.usageControl.meta.update', ['id'=>$meta->id])}} @else {{route('dev.usageControl.meta.store')}} @endif">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Meta Key <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="meta_key" @if(request('id')>0) value="{{$meta->meta_key}}" @endif class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Meta Value <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="meta_value" @if(request('id')>0) value="{{$meta->meta_value}}" @endif class="form-control" required>
                        </div>
                    </div>
                    @if(request('id')>0)
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($meta->status =='active') selected @endif value="active">Active</option>
                                    <option @if($meta->status =='postpone') selected @endif value="postpone">Postpone</option>
                                    </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('dev.usageControl.meta.view')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('id')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
