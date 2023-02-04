@extends('layouts.app')

@section('title')
    @php($title = 'Ledger Group')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('id')) Update @else Create @endif {{$title}}</h4>
                <form method="POST" action="@if(request('id')>0) {{route('acc.ledger-group.update', ['id'=>$subClasses->id])}} @else {{route('acc.ledger-group.store')}} @endif">
                    @csrf
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Class <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="class_id" required>
                                <option></option>
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}" @if(request('id')>0) @if($subClasses->class_id==$class->id) selected @endif @endif>{{$class->id}} : {{$class->class_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Sub-Class <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="class_id" required>
                                <option></option>
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}" @if(request('id')>0) @if($subClasses->class_id==$class->id) selected @endif @endif>{{$class->id}} : {{$class->class_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Ledger Group Code <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="sub_class_id" @if(request('id')>0) value="{{$subClasses->sub_class_id}}" @endif class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Ledger Group Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="sub_class_name" @if(request('id')>0) value="{{$subClasses->sub_class_name}}" @endif class="form-control" required>
                        </div>
                    </div>
                    @if(request('id')>0)
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
                                <button type="submit" class="btn btn-primary w-md">@if(request('id')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
