<?php

namespace App\Http\Controllers\Accounts\Products;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Products\AccProductBrand;
use App\Models\Accounts\Products\AccProductItem;
use App\Models\Accounts\Products\AccProductSubGroup;
use App\Models\Accounts\Products\AccProductUnit;
use Illuminate\Http\Request;

class AccProductItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = AccProductItem::all();
        return view('modules.accounts.products.item.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subGroups = AccProductSubGroup::where('status','active')->orderBy('sub_group_id')->get();
        $brands = AccProductBrand::where('status','active')->get();
        $units = AccProductUnit::where('status','active')->get();
        return view('modules.accounts.products.item.create',compact(['subGroups','brands','units']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AccProductItem::storeItem($request);
        return redirect('/accounts/product/item/')->with('store_message','A new product has been successfully added!!');
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
        $subGroups = AccProductSubGroup::where('status','active')->orderBy('sub_group_id')->get();
        $brands = AccProductBrand::where('status','active')->get();
        $units = AccProductUnit::where('status','active')->get();
        $item = AccProductItem::find($id);
        return view('modules.accounts.products.item.create',compact(['subGroups','brands','units','item']));
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
        AccProductItem::updateItem($request, $id);
        return redirect('/accounts/product/item/')->with('update_message','This product (uid='.$id.') has been successfully updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AccProductItem::destroyProduct($id);
        return redirect('/accounts/product/item/')->with('update_message','This product (uid='.$id.') has been deleted!!');

    }
}
