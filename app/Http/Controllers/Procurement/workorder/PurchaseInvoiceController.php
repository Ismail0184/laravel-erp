<?php

namespace App\Http\Controllers\Procurement\workorder;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Products\AccProductItem;
use App\Models\Procurement\Vendor\ProVendorInfo;
use App\Models\Procurement\workorder\ProPurchaseInvoice;
use App\Models\Procurement\workorder\ProPurchaseMaster;
use App\Models\Warehouse\warehouse\WhWarehouse;
use Illuminate\Http\Request;
use Auth;
use Session;

class PurchaseInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ProPurchaseInvoice::storeInvoice($request);
        return redirect('/procurement/direct-purchase/create')->with('store_message','A item has been added!!');
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
        $vendors=ProVendorInfo::where('status','active')->get();
        $warehouses=WhWarehouse::where('status','active')->get();
        $po_no = Auth::user()->id.date('YmdHis');
        $masterData = ProPurchaseMaster::find(Session::get('po_no'));
        $poDatas = ProPurchaseInvoice::where('po_no', Session::get('po_no'))->get();
        $COUNT_po_datas = ProPurchaseInvoice::where('po_no', Session::get('po_no'))->count();
        $items = AccProductItem::where('status','active')->get();
        $editValue = ProPurchaseInvoice::findOrFail($id);
        return view('modules.procurement.workorder.direct-purchase-create',
            compact(['vendors','po_no','masterData','poDatas','COUNT_po_datas','warehouses','items','editValue']));
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
        ProPurchaseInvoice::updateInvoice($request, $id);
        return redirect('/procurement/direct-purchase/create')->with('update_message','This product (uid='.$id.') has been successfully updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProPurchaseInvoice::destroyInvoice($id);
        return redirect('/procurement/direct-purchase/create')->with('update_message','This product (uid='.$id.') has been deleted!');
    }
}
