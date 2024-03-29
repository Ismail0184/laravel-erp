<?php

namespace App\Http\Controllers\Accounts\Products;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Products\AccProductGroup;
use App\Models\Accounts\Products\AccProductSubGroup;
use Illuminate\Http\Request;

class AccProductSubGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subGroups = AccProductSubGroup::all();
        return view('modules.accounts.products.sub-group.index',compact('subGroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = AccProductGroup::where('status','active')->get();
        return view('modules.accounts.products.sub-group.create',compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AccProductSubGroup::storeSubGroup($request);
        return redirect('/accounts/product/sub-group/')->with('store_message','A new sub-group has been successfully added');
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
        $groups = AccProductGroup::where('status','active')->get();
        $subGroup = AccProductSubGroup::find($id);
        return view('modules.accounts.products.sub-group.create',compact(['groups','subGroup']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        AccProductSubGroup::updateSubGroup($request, $id);
        return redirect('/accounts/product/sub-group/')->with('update_message','This sub-group (uid='.$id.') has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AccProductSubGroup::destroySubGroup($id);
        return redirect('/accounts/product/sub-group/')->with('destroy_message','This sub-group (uid='.$id.') has been deleted');
    }
}
