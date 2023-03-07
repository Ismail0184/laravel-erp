@extends('layouts.app')

@section('title')
    COA Ledger Group
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">COA Ledger Group <a href="{{route('acc.ledger.create')}}" class="btn btn-primary" style="margin-left: 79.30%">Add New</a></h4>
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
                                <th style="width: 5%; text-align: center">Uid</th>
                                <th>Ledger</th>
                                <th>Ledger Group</th>
                                <th>Sub-Class</th>
                                <th>Class</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 15%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ledgers as $ledger)
                                <tr>
                                    <td style="text-align: center">{{$loop->iteration}}</td>
                                    <td style="text-align: center">{{$ledger->id}}</td>
                                    <td>{{$ledger->ledger_id}} : {{$ledger->ledger_name}}</td>
                                    <td>{{$ledger->accLedgerGroup->group_name}}</td>
                                    <td>{{$ledger->accSubClass->sub_class_name}}</td>
                                    <td>{{$ledger->accClass->class_name}}</td>
                                    <td>@if($ledger->status == '1') <span class="badge badge-success">Active</span> @elseif($ledger->status == '0') <span class="badge badge-danger">Inactive</span> @endif</td>
                                    <td class="text-center">
                                        <form action="{{route('acc.ledger.destroy', ['id' => $ledger->id])}}" method="post">
                                            @csrf
                                            <a href="{{route('acc.ledger.show',['id' => $ledger->id])}}" title="View" class="btn btn-primary btn-sm">
                                                <i class="fa fa-book"></i>
                                            </a>
                                            <a href="{{route('acc.ledger.edit',['id' => $ledger->id])}}" title="Update" class="btn btn-success btn-sm">
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



