<?php

namespace App\Http\Controllers\Procurement\workorder;

use App\Http\Controllers\Controller;
use App\Models\Developer\DevWarehouse;
use App\Models\Procurement\Vendor\ProVendorInfo;
use App\Models\Procurement\workorder\ProPurchaseMaster;
use App\Models\Warehouse\warehouse\warehouse;
use Illuminate\Http\Request;
use Auth;
use Session;

class ProPurchaseMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('modules.porcurement.workorder.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.procurement.workorder.workorder-create');
    }
    public function directPurchaseCreate()
    {
        $vendors=ProVendorInfo::where('status','active')->get();
        $warehouses=warehouse::where('status','active')->get();
        $po_number = Auth::user()->id.date('YmdHis');
        if(Session::get('po_number')>0)
        {
            $masterData = ProPurchaseMaster::find(Session::get('po_number'));
            $poDatas = AccReceipt::where('po_number', Session::get('po_number'))->get();
            $COUNT_po_datas = AccReceipt::where('po_number', Session::get('po_number'))->count();
        } else {
            $masterData = '0';
            $poDatas = '0';
            $COUNT_po_datas = '0';

        }
        return view('modules.procurement.workorder.direct-purchase-create',
            compact(['vendors','po_number','masterData','poDatas','COUNT_po_datas']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
