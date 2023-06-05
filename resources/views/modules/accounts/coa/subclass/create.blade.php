@extends('layouts.app')

@section('title')
    @php($title = 'Create Sub Class')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('sub_class_id')) Update @else Create @endif Sub-Class</h4>
                <form method="POST" action="@if(request('sub_class_id')>0) {{route('acc.sub-class.update', ['sub_class_id'=>$subClasses->sub_class_id])}} @else {{route('acc.sub-class.store')}} @endif">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                @if(!(request('sub_class_id')))
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Class <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="class_id" required>
                                <option> -- select a class -- </option>
                                @foreach($classes as $class)
                                <option value="{{$class->class_id}}" @if(request('sub_class_id')>0) @if($subClasses->class_id==$class->class_id) selected @endif @endif>{{$class->class_id}} : {{$class->class_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif

                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Sub Class Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="sub_class_name" @if(request('sub_class_id')>0) value="{{$subClasses->sub_class_name}}" @endif class="form-control" required>
                        </div>
                    </div>
                    @if(request('sub_class_id')>0)
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($subClasses->status ==1) selected @endif value="1">Active</option>
                                    <option @if($subClasses->status ==0) selected @endif value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('acc.sub-class.view')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('sub_class_id')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
