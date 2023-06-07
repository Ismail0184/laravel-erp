@extends('layouts.app')

@section('title')
    COA Sub-Sub-Ledger
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">COA Sub-Sub-Ledger <a href="{{route('acc.sub-sub-ledger.create')}}" class="btn btn-success" style="margin-left: 76%"><i class="mdi mdi-plus mr-1"></i> Add New</a></h4>
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
                                <th>Sub-Sub-Ledger</th>
                                <th>Sub-Ledger</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 10%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subsubledgers as $subsubledger)
                                <tr>
                                    <td style="text-align: center">{{$loop->iteration}}</td>
                                    <td>@if($subsubledger->status == 'deleted')<del>{{$subsubledger->sub_sub_ledger_id}} : {{$subsubledger->sub_sub_ledger_name}}</del> @else {{$subsubledger->sub_sub_ledger_id}} : {{$subsubledger->sub_sub_ledger_name}}@endif</td>
                                    <td>{{$subsubledger->sub_ledger_id}} : {{$subsubledger->accSubLedgerGetforSubSubLedger->sub_ledger_name}}</td>
                                    <td>
                                        @if($subsubledger->status == 'active') <span class="badge badge-success">Active</span>
                                        @elseif($subsubledger->status == 'inactive') <span class="badge badge-warning">Inactive</span>
                                        @elseif($subsubledger->status == 'suspended') <span class="badge badge-danger">Suspended</span>
                                        @elseif($subsubledger->status == 'deleted') <span class="badge badge-danger"><del>Deleted</del></span>
                                        @endif                                    </td>
                                    <td class="text-center">
                                        <form action="{{route('acc.sub-sub-ledger.destroy', ['sub_sub_ledger_id' => $subsubledger->sub_sub_ledger_id])}}" method="post">
                                            @csrf
                                            <a href="{{route('acc.sub-sub-ledger.edit',['sub_sub_ledger_id' => $subsubledger->sub_sub_ledger_id])}}" title="Update" class="btn btn-success btn-sm">
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



