<?php

namespace App\Http\Controllers\Procurement\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Procurement\Vendor\ProVendorType;
use Illuminate\Http\Request;
use function Termwind\renderUsing;

class VendorTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = ProVendorType::all();
        return view('modules.procurement.vendor.type.index',compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.procurement.vendor.type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ProVendorType::storeType($request);
        return redirect('/procurement/vendor/type')->with('store_message','This type has been succcessfully created!!');
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
        $type = ProVendorType::find($id);
        return view('modules.procurement.vendor.type.create',compact('type'));
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
        ProVendorType::updateType($request,$id);
        return redirect('/procurement/vendor/type/')->with('update_message','This vendor type has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProVendorType::destroyType($id);
        return redirect('/procurement/vendor/type/')->with('destroy_message','This vendor type has been deleted');
    }
}
