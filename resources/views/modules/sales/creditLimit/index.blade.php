@extends('layouts.app')

@section('title')
    @php($title = 'Credit Limit Requests') {{$title}}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}} <a href="{{route('sales.cl.create')}}" class="btn btn-success" style="margin-left: 76.4%"><i class="mdi mdi-plus mr-1"></i> Add New</a></h4>
                        @if ($message = Session::get('destroy_message'))
                            <p class="text-center text-danger">{{ $message }}</p>
                        @elseif( $message = Session::get('store_message'))
                            <p class="text-center text-success">{{ $message }}</p>
                        @elseif( $message = Session::get('update_message'))
                            <p class="text-center text-primary">{{ $message }}</p>
                        @endif
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th style="width: 5%; text-align: center">#</th>
                                <th>Dealer Name</th>
                                <th>Ledger Balance</th>
                                <th>Credit Limit Request</th>
                                <th style="width: 20%">Remarks</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 10%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($creditLimits as $data)
                                <tr>
                                    <td style="text-align: center">{{$loop->iteration}}</td>
                                    <td>@if($data->status == 'deleted')<del>{{$data->dealer->dealer_name}}</del> @else {{$data->dealer->ledger_id.' : '.$data->dealer->dealer_name}}@endif</td>
                                    <td style="text-align: left">{{$data->current_balance}}</td>
                                    <td style="text-align: left">{{$data->requested_limit}}</td>
                                    <td style="text-align: left">{{$data->remarks}}</td>
                                    <td>
                                        @if($data->status     == 'APPROVED') <span class="badge badge-success">APPROVED</span>
                                        @elseif($data->status == 'UNAPPROVED') <span class="badge badge-soft-dark">UNAPPROVED</span>
                                        @elseif($data->status == 'REJECTED') <span class="badge badge-danger">REJECTED</span>
                                        @elseif($data->status == 'HOLD') <span class="badge badge-soft-danger"><del>HOLD</del></span>
                                        @elseif($data->status == 'deleted') <span class="badge badge-danger"><del>Deleted</del></span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <form action="{{route('sales.cl.destroy', ['id' => $data->id])}}" method="post">
                                            @csrf
                                            <a href="{{route('sales.cl.edit',['id' => $data->id])}}" title="Update" class="btn btn-success btn-sm">
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
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
