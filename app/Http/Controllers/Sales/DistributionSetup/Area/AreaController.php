<?php

namespace App\Http\Controllers\Sales\DistributionSetup\Area;

use App\Http\Controllers\Controller;
use App\Models\Sales\DistributionSetup\SalRegion;
use App\Models\Sales\DistributorSetup\SalArea;
use App\Models\User;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = SalArea::all();
        return view('modules.sales.distributionSetup.area.index',compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $regions = SalRegion::where('status','active')->get();
        return view('modules.sales.distributionSetup.area.create',compact(['users','regions']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        SalArea::storeArea($request);
        return redirect('/sales/distribution-setup/area/')->with('store_message','A area has been successfully inserted');
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
        $regions = SalRegion::where('status','active')->get();
        $area = SalArea::findOrFail($id);
        return view('modules.sales.distributionSetup.area.create',compact(['users','regions','area']));
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
        SalArea::updateArea($request, $id);
        return redirect('/sales/distribution-setup/area/')->with('update_message','This area (UID = '.$id.') has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SalArea::destroyArea($id);
        return redirect('/sales/distribution-setup/area/')->with('destroy_message','This area (UID = '.$id.') has been deleted');
    }
}
