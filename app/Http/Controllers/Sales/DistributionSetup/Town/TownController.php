<?php

namespace App\Http\Controllers\Sales\DistributionSetup\Town;

use App\Http\Controllers\Controller;
use App\Models\Sales\DistributionSetup\SalTerritory;
use App\Models\Sales\DistributionSetup\SalTown;
use App\Models\User;
use Illuminate\Http\Request;

class TownController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $towns = SalTown::all();
        return view('modules.sales.distributionSetup.town.index',compact(['towns']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $territories = SalTerritory::where('status','active')->get();
        $users = User::all();
        return view('modules.sales.distributionSetup.town.create',compact('territories','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        SalTown::storeTown($request);
        return redirect('/sales/distribution-setup/town/')->with('store_message','A new town has been successfully inserted!!');
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
        $territories = SalTerritory::where('status','active')->get();
        $users = User::all();
        $town = SalTown::findOrFail($id);
        return view('modules.sales.distributionSetup.town.create',compact('territories','users','town'));

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
        SalTown::updateTown($request, $id);
        return redirect('/sales/distribution-setup/town/')->with('update_message','This town (Uid='.$id.') has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SalTown::destroyTown($id);
        return redirect('/sales/distribution-setup/town/')->with('destroy_message','This town (Uid='.$id.') has been deleted!!');
    }
}
