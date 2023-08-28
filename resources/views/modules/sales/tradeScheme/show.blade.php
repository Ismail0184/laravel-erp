@extends('layouts.app')

@section('title')
    @php($title = 'Dealer Info')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-header"><h4>{{$title}}</h4></div>

                <table class="table-bordered table" style="width: 100%">
                    <tr>
                        <th style="width: 30%">Region</th>
                        <th>:</th>
                        <td>{{$dealer->region->region_name}}</td>
                    </tr>
                    <tr>
                        <th>Area</th>
                        <th>:</th>
                        <td>{{$dealer->area->area_name}}</td>
                    </tr>
                    <tr>
                        <th>Territory</th>
                        <th>:</th>
                        <td>{{$dealer->territory->territory_name}}</td>
                    </tr>
                    <tr>
                        <th>Town</th>
                        <th>:</th>
                        <td>{{$dealer->town->town_name}}</td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <th>:</th>
                        <td>{{$dealer->category->category_name}}</td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <th>:</th>
                        <td>{{$dealer->type->type_name}}</td>
                    </tr>
                    <tr>
                        <th>Serial Number</th>
                        <th>:</th>
                        <td>{{$dealer->serial}}</td>
                    </tr>
                    <tr>
                        <th>Dealer Custom Code</th>
                        <th>:</th>
                        <td>{{$dealer->dealer_custom_id}}</td>
                    </tr>
                    <tr>
                        <th>Dealer Name</th>
                        <th>:</th>
                        <td>{{$dealer->dealer_name}}</td>
                    </tr>
                    <tr>
                        <th>Proprietor Name</th>
                        <th>:</th>
                        <td>{{$dealer->proprietor_name}}</td>
                    </tr>
                    <tr>
                        <th>Mobile</th>
                        <th>:</th>
                        <td>{{$dealer->mobile}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <th>:</th>
                        <td>{{$dealer->email}}</td>
                    </tr>
                    <tr>
                        <th>Contact Person</th>
                        <th>:</th>
                        <td>{{$dealer->contact_person}}</td>
                    </tr>
                    <tr>
                        <th>Contact Person Designation</th>
                        <th>:</th>
                        <td>{{$dealer->contact_person_designation}}</td>
                    </tr>
                    <tr>
                        <th>Contact Person Mobile</th>
                        <th>:</th>
                        <td>{{$dealer->contact_person_mobile}}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <th>:</th>
                        <td>{{$dealer->address}}</td>
                    </tr>
                    <tr>
                        <th>National ID</th>
                        <th>:</th>
                        <td>{{$dealer->nid}}</td>
                    </tr>
                    <tr>
                        <th>Passport</th>
                        <th>:</th>
                        <td>{{$dealer->passport}}</td>
                    </tr>
                    <tr>
                        <th>TIN</th>
                        <th>:</th>
                        <td>{{$dealer->TIN}}</td>
                    </tr>
                    <tr>
                        <th>BIN</th>
                        <th>:</th>
                        <td>{{$dealer->BIN}}</td>
                    </tr>
                    <tr>
                        <th>BIN</th>
                        <th>:</th>
                        <td>{{$dealer->ledger_id}}</td>
                    </tr>
                    <tr>
                        <th>Commission</th>
                        <th>:</th>
                        <td>{{$dealer->commission}}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <th>:</th>
                        <td>@if($dealer->status     == 'active') <span class="badge badge-success">Active</span>
                            @elseif($dealer->status == 'inactive') <span class="badge badge-warning">Inactive</span>
                            @elseif($dealer->status == 'suspended') <span class="badge badge-danger">Suspended</span>
                            @elseif($dealer->status == 'deleted') <span class="badge badge-danger"><del>Deleted</del></span>
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="form-group row justify-content-end">
                    <div class="col-sm-9">
                        <div>
                            <a class="btn btn-danger" href="{{route('sales.dealer.view')}}">Go Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
