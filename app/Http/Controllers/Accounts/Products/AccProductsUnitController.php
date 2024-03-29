<?php

namespace App\Http\Controllers\Accounts\Products;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Products\AccProductUnit;
use Illuminate\Http\Request;

class AccProductsUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = AccProductUnit::all();
        return view('modules.accounts.products.unit.index',compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.accounts.products.unit.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AccProductUnit::storeUnit($request);
        return redirect('/accounts/product/unit/')->with('store_message','A new unit has been successfully inserted');
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
        $unit = AccProductUnit::find($id);
        return view('modules.accounts.products.unit.create',compact('unit'));
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
        AccProductUnit::updateUnit($request, $id);
        return redirect('/accounts/product/unit/')->with('update_message','This unit (uid='.$id.') has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AccProductUnit::destroyUnit($id);
        return redirect('/accounts/product/unit/')->with('update_message','This unit (uid='.$id.') has been deleted');
    }
}
