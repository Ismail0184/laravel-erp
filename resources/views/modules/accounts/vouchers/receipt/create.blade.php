@extends('layouts.app')

@section('title')
    @php($title = 'Receipt Voucher')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('ledger_id')) Update @else Create @endif {{$title}} <small class="text-danger">(field marked with * are mandatory)
                    </small></h4>
                <form style="font-size: 11px" method="POST" action="@if(request('ledger_id')>0) {{route('acc.ledger.update', ['ledger_id'=>$ledger->ledger_id])}} @else {{route('acc.ledger.store')}} @endif">
                    @csrf
                    <div class="form-group row mb-2">
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Receipt No <span class="required text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="text" readonly name="ledger_id" @if(request('ledger_id')>0) value="{{$ledger->ledger_id}}" @else value="{{$receiptVoucher}}"  @endif class="form-control" required>
                        </div>

                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Date <span class="required text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="date" name="ledger_id" min="" max="{{date('Y-m-d')}}" @if(request('ledger_id')>0) value="{{$ledger->ledger_id}}" @endif class="form-control" required>
                        </div>

                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Person from</label>
                        <div class="col-sm-3">
                            <input type="text" name="ledger_id" @if(request('ledger_id')>0) value="{{$ledger->ledger_id}}" @endif class="form-control" required>
                        </div>
                    </div>


                    <div class="form-group row mb-2">
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">of Bank</label>
                        <div class="col-sm-3">
                            <input type="text" name="ledger_id" @if(request('ledger_id')>0) value="{{$ledger->ledger_id}}" @endif class="form-control" required>
                        </div>

                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Cheque No</label>
                        <div class="col-sm-3">
                            <input type="text" name="ledger_id" @if(request('ledger_id')>0) value="{{$ledger->ledger_id}}" @endif class="form-control" required>
                        </div>

                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Chq. Date</label>
                        <div class="col-sm-3">
                            <input type="text" name="ledger_id" @if(request('ledger_id')>0) value="{{$ledger->ledger_id}}" @endif class="form-control" required>
                        </div>
                    </div>


                    <div class="form-group row justify-content-end">
                        <div class="col-sm-7">
                            <div>
                                <!--a class="btn btn-danger" href="{{route('acc.voucher.receipt.view')}}">Cancel</a-->
                                <button type="submit" class="btn btn-primary w-md">@if(request('ledger_id')) Update @else Initiate & Proceed @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
