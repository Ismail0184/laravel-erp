@extends('layouts.app')

@section('title')
    @php($title = 'Trade Scheme')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-header"><h4>{{$title}}</h4></div>

                <table class="table-bordered table" style="width: 100%">

                    <tr>
                        <th>Offer Name</th>
                        <th>:</th>
                        <td>{{$ts->offer_name}}</td>
                    </tr>
                    <tr>
                        <th>Scheme Duration</th>
                        <th>:</th>
                        <td>{{$ts->start_date}} to {{$ts->end_date}}</td>
                    </tr>
                    <tr>
                        <th>Buy Product Name</th>
                        <th>:</th>
                        <td>{{$ts->buyitem->item_name}}</td>
                    </tr>
                    <tr>
                        <th>Buy Item Qty</th>
                        <th>:</th>
                        <td>{{$ts->buy_item_qty}}</td>
                    </tr>

                    <tr>
                        <th>Gift Product Name</th>
                        <th>:</th>
                        <td>{{$ts->giftItem->item_name}}</td>
                    </tr>
                    <tr>
                        <th>Gift Item Qty</th>
                        <th>:</th>
                        <td>{{$ts->gift_item_qty}}</td>
                    </tr>
                    <tr>
                        <th>Calculation mode</th>
                        <th>:</th>
                        <td>{{$ts->calculation_mode}}</td>
                    </tr>

                    <tr>
                        <th>Gift Type</th>
                        <th>:</th>
                        <td>{{$ts->gift_type}}</td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <th>:</th>
                        <td>@if($ts->status     == 'active') <span class="badge badge-success">Active</span>
                            @elseif($ts->status == 'inactive') <span class="badge badge-warning">Inactive</span>
                            @elseif($ts->status == 'suspended') <span class="badge badge-danger">Suspended</span>
                            @elseif($ts->status == 'deleted') <span class="badge badge-danger"><del>Deleted</del></span>
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="form-group row justify-content-end">
                    <div class="col-sm-12">
                        <div>
                            <a class="btn btn-success" href="{{route('sales.ts.view')}}">Go Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
