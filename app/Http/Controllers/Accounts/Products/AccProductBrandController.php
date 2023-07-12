<?php

namespace App\Http\Controllers\Accounts\Products;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Products\AccProductBrand;
use Illuminate\Http\Request;

class AccProductBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = AccProductBrand::all();
        return view('modules.accounts.products.brand.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.accounts.products.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AccProductBrand::storeBrand($request);
        return redirect('/accounts/product/brand/')->with('store_message','A new brand has been successfully created');
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
        $brand = AccProductBrand::find($id);
        return view('modules.accounts.products.brand.create',compact('brand'));
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
        AccProductBrand::updateBrand($request, $id);
        return redirect('/accounts/product/brand/')->with('update_message','This brand (uid='.$id.') has been successfully updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AccProductBrand::destroyBrand($id);
        return redirect('/accounts/product/brand/')->with('destroy_message','This brand (uid='.$id.') has been deleted!!');
    }
}
