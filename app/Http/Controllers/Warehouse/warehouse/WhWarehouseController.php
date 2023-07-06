<?php

namespace App\Http\Controllers\Warehouse\warehouse;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccLedger;
use App\Models\Warehouse\warehouse\WhWarehouse;
use Illuminate\Http\Request;
use function Termwind\renderUsing;

class WhWarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouses = WhWarehouse::all();
        return view('modules.warehouse.warehouse.index', compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ledgerss=AccLedger::where('status','active')->get();
        return view('modules.warehouse.warehouse.create',compact('ledgerss'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        WhWarehouse::storeWarehouse($request);
        return redirect('/warehouse/warehouse/')->with('store_message','A warehouse has been successfully created!!');
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
        $ledgerss=AccLedger::where('status','active')->get();
        $warehouse = WhWarehouse::find($id);
        return view('modules.warehouse.warehouse.create',compact('ledgerss','warehouse'));

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
        WhWarehouse::updateWarehouse($request, $id);
        return redirect('/warehouse/warehouse/')->with('update_message','This warehouse (Uid = '.$id.') has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        WhWarehouse::destroyWarehouse($id);
        return redirect('/warehouse/warehouse/')->with('destroy_message','This warehouse (Uid = '.$id.') has been deleted!!');
    }
}
