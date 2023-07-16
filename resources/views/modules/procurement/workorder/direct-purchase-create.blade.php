@extends('layouts.app')

@section('title')
    @php($title = 'Purchase')
    {{$title}}
@endsection

@section('body')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Create {{$title}} <small class="text-danger float-right">(field marked with * are mandatorys)
                    </small>
                </h4>
                <form style="font-size: 11px" method="POST" action="@if(Session::get('po_no')>0) {{route('pro.workorder.update', ['po_no'=>$masterData->po_no])}} @else {{route('pro.workorder.initiate')}} @endif">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="entry_at" value="{{date('Y-m-d H:i:s')}}">
                    <input type="hidden" name="status" value="MANUAL">
                    <input type="hidden" name="po_type" value="DP">
                    <div class="form-group row mb-2">
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Po No <span class="required text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="hidden" name="journal_type" value="journal" class="form-control" />
                            <input type="text" readonly name="po_no" @if(Session::get('po_no')>0) value="{{Session::get('po_no')}}" @else value="{{$po_no}}" @endif class="form-control" required />
                        </div>
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Po Date <span class="required text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="date" name="po_date" min="" max="{{date('Y-m-d')}}" @if(Session::get('po_no')>0) value="{{$masterData->po_date}}" @endif class="form-control" required />
                        </div>
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Warehouse</label>
                        <div class="col-sm-3">
                            <select class="form-control select2" name="warehouse_id" required="required">
                                <option value=""></option>
                                @foreach($warehouses as $warehouse)
                                    <option value="{{$warehouse->warehouse_id}}" @if(Session::get('po_no')>0) @if($warehouse->warehouse_id==$masterData->warehouse_id) selected @endif @endif>{{$warehouse->warehouse_id}} : {{$warehouse->warehouse_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Vendor <span class="required text-danger">*</span></label>
                        <div class="col-sm-3">
                            <select class="form-control select2" name="vendor_id" required="required">
                                <option value=""></option>
                                @foreach($vendors as $vendor)
                                    <option value="{{$vendor->vendor_id}}" @if(Session::get('po_no')>0) @if($vendor->vendor_id==$masterData->vendor_id) selected @endif @endif>{{$vendor->vendor_id}} : {{$vendor->vendor_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Tax(%)</label>
                        <div class="col-sm-3">
                            <input type="number" name="tax" @if(Session::get('po_no')>0) value="{{$masterData->tax}}" @endif class="form-control" />
                        </div>
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">VAT(%)</label>
                        <div class="col-sm-3">
                            <input type="number" name="vat" @if(Session::get('po_no')>0) value="{{$masterData->vat}}" @endif class="form-control" />
                        </div>
                    </div>
                    @if($COUNT_po_datas > 0)
                    @else
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-7">
                                <div>
                                    @if(Session::get('po_no'))
                                        <a href="{{route('pro.workorder.cancel', ['po_no' => $masterData->po_no, 'journal_type'=>'journal'])}}" class="btn btn-danger w-md" onclick="return window.confirm('Confirm to cancel?');">Cancel</a>
                                    @endif
                                    <button type="submit" class="btn btn-success w-md">@if(Session::get('po_no')) Update @else Initiate & Proceed @endif</button>
                                </div>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    @if(Session::get('po_no')>0)
        <form style="font-size: 11px" method="POST" action="@if(request('id')>0) {{route('pro.workorder.product.update', ['id'=>$editValue->id])}} @else {{route('pro.workorder.product.store')}} @endif">
            @csrf
            @if ($message = Session::get('destroy_message'))
                <p class="text-center text-danger">{{ $message }}</p>
            @elseif( $message = Session::get('store_message'))
                <p class="text-center text-success">{{ $message }}</p>
            @elseif( $message = Session::get('update_message'))
                <p class="text-center text-primary">{{ $message }}</p>
            @endif
            <input type="hidden" name="po_no" value="{{$masterData->po_no}}">
            <input type="hidden" name="po_date" value="{{$masterData->po_date}}">
            <input type="hidden" name="vendor_id" value="{{$masterData->vendor_id}}">
            <input type="hidden" name="warehouse_id" value="{{$masterData->warehouse_id}}">
            <input type="hidden" name="po_type" value="{{$masterData->po_type}}">
            <input type="hidden" name="entry_by" value="{{$masterData->entry_by}}">
            <table align="center" class="table table-striped table-bordered" style="width:98%; font-size: 11px">
                <thead class="table-success">
                <tr>
                    <th style="text-align: center">Item Name <span class="required text-danger">*</span></th>
                    <th style="text-align: center; width: 15%">Item Details</th>
                    <th style="text-align: center; width: 12%">Buy Qty <span class="required text-danger">*</span></th>
                    <th style="text-align: center;width:12%;">Unit Price <span class="required text-danger">*</span></th>
                    <th style="width:12%; text-align:center">Amount <span class="required text-danger">*</span></th>
                    <th style="text-align:center;width: 5%">Action <span class="required text-danger">*</span></th>
                </tr>
                </thead>
                <tbody>
                <tr style="background-color: white">
                    <td style="vertical-align: middle">
                        <select class="form-control select2" name="item_id" required="required">
                            <option>-- select a choose --</option>
                            @foreach($items as $item)
                            <option value="{{$item->item_id}}" @if(request('id')>0) @if($item->item_id==$editValue->item_id) selected @endif @endif >{{$item->custom_id}} : {{$item->item_name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td style="vertical-align: middle">
                        <textarea  name="item_details" class="form-control" style="height: 70px">@if(request('id')>0) {{$editValue->item_details}} @else {{Session::get('journal_narration')}} @endif</textarea>
                    </td>
                    <td style="vertical-align: middle"><input type="number" name="qty" style="text-align: center" class="form-control" @if(request('id')>0) value="{{$editValue->qty}}" @endif autocomplete="off" step="any" /></td>
                    <td style="vertical-align: middle">
                        <input type="number" name="rate" style="text-align: center" class="form-control" @if(request('id')>0) value="{{$editValue->rate}}" @endif autocomplete="off" step="any" />
                    </td>
                    <td style="vertical-align: middle">
                        <input type="number" style="text-align: center" name="amount"  class="form-control" @if(request('id')>0) value="{{$editValue->amount}}" @endif autocomplete="off" step="any" />
                    </td>
                    <td style="vertical-align: middle">
                        @if(request('id')>0)
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{route('pro.direct-purchase.create')}}" class="btn btn-danger" style="margin-top: 5px">Cancel</a>
                        @else
                            <button type="submit" class="btn btn-success">Add</button>
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
        @if($COUNT_po_datas > 0)
            <table class="table table-striped table-bordered dt-responsive nowrap" align="center" style="border-collapse: collapse; border-spacing: 0; width: 98%;font-size: 11px">
                <thead class="table-success">
                <tr>
                    <th style="width: 5%; text-align: center">#</th>
                    <th style="width: 5%; text-align: center">Uid</th>
                    <th>Item Name</th>
                    <th>Item Details</th>
                    <th>Qty</th>
                    <th>Rate</th>
                    <th>Amount</th>
                    <th class="text-center" style="width: 10%">Option</th>
                </tr>
                </thead>
                <tbody style="background-color: white">
                @foreach($poDatas as $poData)
                    <tr>
                        <td style="text-align: center; vertical-align: middle">{{$loop->iteration}}</td>
                        <td style="text-align: center; vertical-align: middle">{{$poData->id}}</td>
                        <td style="text-align: left; vertical-align: middle">{{$poData->item->item_name}}</td>
                        <td style="text-align: left; vertical-align: middle">{{$poData->item_details}}</td>
                        <td style="text-align: center; vertical-align: middle">{{$poData->qty}}</td>
                        <td style="text-align: right; vertical-align: middle">{{number_format($poData->rate,2)}}</td>
                        <td style="text-align: right; vertical-align: middle">{{number_format($poData->amount,2)}}</td>
                        <td class="text-center" style="vertical-align: middle">
                            <form action="{{route('pro.workorder.product.destroy', ['id' => $poData->id])}}" method="post">
                                @csrf
                                <input type="hidden" name="vouchertype" value="multiple">
                                <a href="{{route('pro.workorder.product.edit',['id' => $poData->id])}}" title="Update" class="btn btn-success btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you confirm to delete?');">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot style="background-color: white">
                <td colspan="4" style="border: none">
                <div style="margin-top: 20px">
                    <form action="{{route('pro.workorder.cancelall',['po_no' => $masterData->po_no])}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger float-left" onclick="return window.confirm('Are you confirm?');">Cancel & Delete All</button>
                    </form>
                </div></td>
                <td colspan="4" style="border: none">
                    <div style="margin-top: 20px">
                    <form action="{{route('pro.workorder.confirm', ['po_no' => $masterData->po_no])}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-success float-right" onclick="return window.confirm('Are you confirm?');">Confirm & Finish Voucher</button>
                    </form>
                    </div>
                </td>
                </tfoot>
            </table>
        @endif @endif
@endsection
