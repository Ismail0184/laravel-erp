<?php

namespace App\Http\Controllers\Accounts\Products;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Products\AccProductGroup;
use Illuminate\Http\Request;

class AccProductGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = AccProductGroup::all();
        return view('modules.accounts.products.group.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.accounts.products.group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AccProductGroup::storeProductGroup($request);
        return redirect('/accounts/product/group/')->with('store_message','A product group has been created !!');
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
        $group = AccProductGroup::find($id);
        return view('modules.accounts.products.group.create',compact('group'));
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
        AccProductGroup::updateProductGroup($request, $id);
        return redirect('/accounts/product/group/')->with('update_message','A product group (uid='.$id.') has been updated !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AccProductGroup::destroyProductGroup($id);
        return redirect('/accounts/product/group/')->with('destroy_message','A product group (uid='.$id.') has been deleted !!');
    }
}
