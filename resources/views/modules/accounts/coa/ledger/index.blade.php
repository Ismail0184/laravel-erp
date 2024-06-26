@extends('layouts.app')

@section('title')
    @php($title='Accounts Ledger')
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}} <a href="{{route('acc.ledger.create')}}" class="btn btn-success" style="margin-left: 79.1%"><i class="mdi mdi-plus mr-1"></i> Add New</a></h4>
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
                                <th>Ledger Name</th>
                                <th>Ledger Group</th>
                                <th>Type</th>
                                <th>Show on entry</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 10%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ledgers as $ledger)
                                <tr>
                                    <td style="text-align: center">{{$loop->iteration}}</td>
                                    <td>@if($ledger->status == 'deleted')<del> {{$ledger->ledger_id}} : {{$ledger->ledger_name}} @else {{$ledger->ledger_id}} : {{$ledger->ledger_name}}@endif</td>
                                    <td>{{$ledger->accLedgerGroup->group_id}} : {{$ledger->accLedgerGroup->group_name}}</td>
                                    <td>{{$ledger->type}}</td>
                                    <td>@if($ledger->show_in_transaction == '1') <span class="badge badge-soft-success">Show</span>
                                        @elseif($ledger->show_in_transaction == '0') <span class="badge badge-soft-danger"><del>Hidden</del></span>
                                        @endif
                                    </td>
                                    <td>@if($ledger->status == 'active') <span class="badge badge-success">Active</span>
                                        @elseif($ledger->status == 'inactive') <span class="badge badge-warning">Inactive</span>
                                        @elseif($ledger->status == 'suspended') <span class="badge badge-danger">Suspended</span>
                                        @elseif($ledger->status == 'deleted') <span class="badge badge-danger"><del>Deleted</del></span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <form action="{{route('acc.ledger.destroy', ['ledger_id' => $ledger->ledger_id])}}" method="post">
                                            @csrf
                                            <a href="{{route('acc.ledger.edit',['ledger_id' => $ledger->ledger_id])}}" title="Update" class="btn btn-success btn-sm">
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



