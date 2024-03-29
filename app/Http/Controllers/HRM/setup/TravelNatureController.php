<?php

namespace App\Http\Controllers\HRM\setup;

use App\Http\Controllers\Controller;
use App\Models\HRM\setup\HrmTravelNature;
use Illuminate\Http\Request;

class TravelNatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $travelNatures = HrmTravelNature::all();
        return view('modules.hrm.setup.travelNature.index',compact('travelNatures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.hrm.setup.travelNature.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        HrmTravelNature::storeTravelNature($request);
        return redirect('/hrm/setup/travel-nature/')->with('store_message','A travel nature has been created!!');
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
        $travelNature = HrmTravelNature::findOrfail($id);
        return view('modules.hrm.setup.travelNature.create',compact('travelNature'));
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
        HrmTravelNature::updateTravelNature($request, $id);
        return redirect('/hrm/setup/travel-nature/')->with('update_message')->with('This travel nature (uid='.$id.') has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        HrmTravelNature::destroyTravelNature($id);
        return redirect('/hrm/setup/travel-nature/')->with('update_message','This travel nature (uid='.$id.') has beend deleted');
    }
}
