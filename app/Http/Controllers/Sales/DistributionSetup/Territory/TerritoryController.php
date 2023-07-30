<?php

namespace App\Http\Controllers\Sales\DistributionSetup\Territory;

use App\Http\Controllers\Controller;
use App\Models\Sales\DistributionSetup\SalArea;
use App\Models\Sales\DistributionSetup\SalTerritory;
use App\Models\User;
use Illuminate\Http\Request;

class TerritoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $territories = SalTerritory::all();
        return view('modules.sales.distributionSetup.territory.index',compact('territories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = SalArea::where('status','active')->get();
        $users = User::all();
        return view('modules.sales.distributionSetup.territory.create',compact(['areas','users']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        SalTerritory::storeTerritory($request);
        return redirect('/sales/distribution-setup/territory/')->with('store_message','A territory has been successfully inserted!!');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
