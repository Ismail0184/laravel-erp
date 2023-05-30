@extends('layouts.app')

@section('title')
    @php($title = 'Receipt Voucher')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('ledger_id')) Update @else Create @endif {{$title}}</h4>
                <form method="POST" action="@if(request('ledger_id')>0) {{route('acc.ledger.update', ['ledger_id'=>$ledger->ledger_id])}} @else {{route('acc.ledger.store')}} @endif">
                    @csrf
                    <div class="form-group row mb-2">
                        <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">Date <span class="required text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="date" name="ledger_id" @if(request('ledger_id')>0) value="{{$ledger->ledger_id}}" @endif class="form-control" required>
                        </div>

                        <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">Receipt No <span class="required text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="text" readonly name="ledger_id" @if(request('ledger_id')>0) value="{{$ledger->ledger_id}}" @else value="23434"  @endif class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-2 col-form-label">Ledger Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="text" name="ledger_name" @if(request('ledger_id')>0) value="{{$ledger->ledger_name}}" @endif class="form-control" required>
                        </div>
                    </div>
                    @if(request('ledger_id')>0)
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($ledgergroup->status ==1) selected @endif value="1">Active</option>
                                    <option @if($ledgergroup->status ==0) selected @endif value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('acc.voucher.receipt.view')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('ledger_id')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
