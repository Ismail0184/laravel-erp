<?php

namespace App\Http\Controllers\HRM\setup;

use App\Http\Controllers\Controller;
use App\Models\HRM\setup\HrmTravelScope;
use Illuminate\Http\Request;

class TravelScopeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $travelScopes = HrmTravelScope::all();
        return view('modules.hrm.setup.travelScope.index',compact('travelScopes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.hrm.setup.travelScope.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        HrmTravelScope::storeTravelScope($request);
        return redirect('/hrm/setup/travel-scope/')->with('store_message','A travel scope has been created!!');
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
        $travelScope = HrmTravelScope::findOrfail($id);
        return view('modules.hrm.setup.travelScope.create',compact('travelScope'));
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
        HrmTravelScope::updateTravelScope($request, $id);
        return redirect('/hrm/setup/travel-scope/')->with('update_message','This travel scope (uid='.$id.') has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        HrmTravelScope::destroyTravelScope($id);
        return redirect('/hrm/setup/travel-scope/')->with('destroy_message','This travel scope (uid='.$id.') has been deleted!!');
    }
}
