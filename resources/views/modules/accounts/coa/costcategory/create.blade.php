@extends('layouts.app')

@section('title')
    @php($title = 'Cost Category')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('sub_sub_ledger_id')) Update @else Create @endif {{$title}}</h4>
                <form method="POST" action="@if(request('sub_sub_ledger_id')>0) {{route('acc.sub-sub-ledger.update', ['sub_sub_ledger_id'=>$subledger->sub_sub_ledger_id])}} @else {{route('acc.sub-sub-ledger.store')}} @endif">
                    @csrf
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Sub-Ledger <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                            <select class="form-control select2" name="sub_ledger_id" required="required">
                                <option value=""> -- Select Ledger -- </option>
                                @foreach($subledgers as $subledger)
                                    <option value="{{$subledger->sub_ledger_id}}" @if(request('sub_sub_ledger_id')>0) @if($subledger->sub_ledger_id==$subsubledger->sub_ledger_id) selected @endif @endif>{{$subledger->sub_ledger_id}} : {{$subledger->sub_ledger_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Sub-Sub-Ledger Code <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="sub_sub_ledger_id" @if(request('sub_sub_ledger_id')>0) value="{{$subledger->sub_sub_ledger_id}}" @endif class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Sub-Sub-Ledger Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="sub_sub_ledger_name" @if(request('sub_sub_ledger_id')>0) value="{{$subledger->sub_sub_ledger_name}}" @endif class="form-control" required>
                        </div>
                    </div>
                    @if(request('sub_sub_ledger_id')>0)
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($subledger->status ==1) selected @endif value="1">Active</option>
                                    <option @if($subledger->status ==0) selected @endif value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('acc.sub-sub-ledger.view')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('sub_ledger_id')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
