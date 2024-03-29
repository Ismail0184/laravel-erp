<?php

namespace App\Http\Controllers\Procurement\workorder;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Products\AccProductItem;
use App\Models\Procurement\Vendor\ProVendorInfo;
use App\Models\Procurement\workorder\ProPurchaseInvoice;
use App\Models\Procurement\workorder\ProPurchaseMaster;
use App\Models\Warehouse\warehouse\warehouse;
use App\Models\Warehouse\warehouse\WhWarehouse;
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
        $limit = 20;
        $workOrderViews = ProPurchaseMaster::query()->limit($limit)->get();
        return view('modules.procurement.workorder.workorderview.index',compact('workOrderViews'));
    }

    public function filterWorkOrder(Request $request)
    {
        $f_data = $request->f_date;
        $t_data = $request->t_date;
        $journal_type = $request->journal_type;
        $po_type = $request->po_type;
        $status = $request->status;
        $workorder = $request->po_no;
        $query = ProPurchaseMaster::query();
        if ($f_data && $t_data) {
            $query->whereBetween('po_date', [$f_data,$t_data]);
        }
        if($po_type)
        {
            $query->where('po_type',$journal_type);
        }
        if($status)
        {
            $query->where('status',$status);
        }
        if($workorder)
        {
            $query->where('po_no',$workorder);
        }
        $workOrderViews = $query->get();
        return view('modules.procurement.workorder.workorderview.index',compact('workOrderViews'));
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
        $warehouses=WhWarehouse::where('status','active')->get();
        $po_no = Auth::user()->id.date('YmdHis');
        if(Session::get('po_no')>0)
        {
            $masterData = ProPurchaseMaster::find(Session::get('po_no'));
            $poDatas = ProPurchaseInvoice::where('po_no', Session::get('po_no'))->get();
            $COUNT_po_datas = ProPurchaseInvoice::where('po_no', Session::get('po_no'))->count();
            $items = AccProductItem::where('status','active')->get();
        } else {
            $masterData = '0';
            $poDatas = '0';
            $COUNT_po_datas = '0';
            $items = '0';
        }
        return view('modules.procurement.workorder.direct-purchase-create',
            compact(['vendors','po_no','masterData','poDatas','COUNT_po_datas','warehouses','items']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ProPurchaseMaster::initiateDirectPurchase($request);
        return redirect('/procurement/direct-purchase/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        if(Session::get('po_no')>0)
        {
            $masterData = ProPurchaseMaster::find(Session::get('po_no'));
            $poDatas = ProPurchaseInvoice::where('po_no', Session::get('po_no'))->get();
            $COUNT_po_datas = ProPurchaseInvoice::where('po_no', Session::get('po_no'))->count();
            $items = AccProductItem::where('status','active')->get();
        } else {
            $masterData = '0';
            $poDatas = '0';
            $COUNT_po_datas = '0';
            $items = '0';
        }
        if(\request('id')>0)
        {
            $this->editValue = ProPurchaseMaster::find($id);
        }
        return view('modules.procurement.workorder.direct-purchase-create',
            compact(['vendors',
                'po_no',
                'masterData','poDatas','COUNT_po_datas','warehouses','items']));
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
        ProPurchaseMaster::destroyPO($id);
        Session::forget('po_no');
        return redirect('/procurement/direct-purchase/create');
    }

    public function destroyall($id)
    {
        ProPurchaseInvoice::destroyInvoiceAll($id);
        ProPurchaseMaster::destroyPO($id);
        Session::forget('po_no');
        return redirect('/procurement/direct-purchase/create');
    }

    public function confirm(Request $request, $id)
    {
        ProPurchaseInvoice::confirmInvoice($request, $id);
        ProPurchaseMaster::confirmWorkOrder($request, $id);
        Session::forget('po_no');
        return redirect('/procurement/direct-purchase/create');
    }
}
