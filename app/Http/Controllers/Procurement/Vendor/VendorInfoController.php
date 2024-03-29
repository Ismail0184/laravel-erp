<?php

namespace App\Http\Controllers\Procurement\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Procurement\Vendor\ProVendorCategory;
use App\Models\Procurement\Vendor\ProVendorInfo;
use Illuminate\Http\Request;
use function Termwind\renderUsing;

class VendorInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendorinfos = ProVendorInfo::all();
        return view('modules.procurement.vendor.vendorinfo.index',compact('vendorinfos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys = ProVendorCategory::where('status','active')->get();
        return view('modules.procurement.vendor.vendorinfo.create',compact('categorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ProVendorInfo::storeVendor($request);
        return redirect('/procurement/vendor/vendorinfo/')->with('store_message','A new vendor has been successfully created!!');
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
        $categorys = ProVendorCategory::where('status','active')->get();
        $vendorinfo = ProVendorInfo::find($id);
        return view('modules.procurement.vendor.vendorinfo.create',compact('categorys','vendorinfo'));
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
        ProVendorInfo::updateVendor($request, $id);
        return redirect('/procurement/vendor/vendorinfo/')->with('update_message','A new vendor has been successfully updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProVendorInfo::destroyVendor($id);
        return redirect('/procurement/vendor/vendorinfo/')->with('destroy_message','A new vendor has been successfully deleted!!');
    }
}
