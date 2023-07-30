<?php

namespace App\Http\Controllers\Sales\DistributionSetup\Region;

use App\Http\Controllers\Controller;
use App\Models\Sales\DistributionSetup\SalRegion;
use App\Models\User;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = SalRegion::all();
        return view('modules.sales.distributionSetup.region.index',compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('modules.sales.distributionSetup.region.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        SalRegion::storeRegion($request);
        return redirect('/sales/distribution-setup/region/')->with('store_message','A region has been successfully inserted');
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
        $users = User::all();
        $region = SalRegion::findOrFail($id);
        return view('modules.sales.distributionSetup.region.create',compact(['users','region']));
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
        SalRegion::updateRegion($request, $id);
        return redirect('/sales/distribution-setup/region/')->with('update_message','This Region (UID='.$id.') has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SalRegion::destroyRegion($id);
        return redirect('/sales/distribution-setup/region/')->with('destroy_message','This Region (UID='.$id.') has been deleted');
    }
}
