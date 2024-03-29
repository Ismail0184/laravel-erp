<?php

namespace App\Http\Controllers\Procurement\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Procurement\Vendor\ProVendorCategory;
use App\Models\Procurement\Vendor\ProVendorType;
use Illuminate\Http\Request;

class VendorCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = ProVendorCategory::all();
        return view('modules.procurement.vendor.category.index',compact('categorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = ProVendorType::where('status','active')->get();
        return view('modules.procurement.vendor.category.create',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ProVendorCategory::storeCategory($request);
        return redirect('/procurement/vendor/category/')->with('store_message','A new vendor category has been successfully created!!');
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
        $category = ProVendorCategory::find($id);
        $types = ProVendorType::where('status','active')->get();
        return view('modules.procurement.vendor.category.create',compact('category','types'));
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
        ProVendorCategory::updateCategory($request, $id);
        return redirect('/procurement/vendor/category/')->with('update_message','This vendor category (uid='.$id.') has been successfully updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProVendorCategory::destroyCategory($id);
        return redirect('/procurement/vendor/category/')->with('update_message','This vendor category (uid='.$id.') has been successfully deleted!!');

    }
}
