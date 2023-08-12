<?php

namespace App\Http\Controllers\Sales\Dealer;

use App\Http\Controllers\Controller;
use App\Models\Sales\Dealer\SalDealerType;
use Illuminate\Http\Request;

class DealerTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = SalDealerType::all();
        return view('modules.sales.dealer.type.index',compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.sales.dealer.type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        SalDealerType::storeType($request);
        return redirect('/sales/dealer/type/')->with('store_message','This Dealer Type has been successfully inserted!!');
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
        $type = SalDealerType::find($id);
        return view('modules.sales.dealer.type.create',compact('type'));
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
        SalDealerType::updateType($request, $id);
        return redirect('/sales/dealer/type/')->with('update_message','This type (uid='.$id.') has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SalDealerType::destroyDealerType($id);
        return redirect('/sales/dealer/type/')->with('destroy_message','This dealer type is deleted');
    }
}
