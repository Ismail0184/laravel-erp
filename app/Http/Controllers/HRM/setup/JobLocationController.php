<?php

namespace App\Http\Controllers\HRM\setup;

use App\Http\Controllers\Controller;
use App\Models\HRM\setup\HrmJobLocation;
use Illuminate\Http\Request;

class JobLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $joblocations = HrmJobLocation::all();
        return view('modules.hrm.setup.jobLocation.index',compact('joblocations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.hrm.setup.joblocation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        HrmJobLocation::storeJobLocation($request);
        return redirect('/hrm/setup/job-location/')->with('store_message','A job location has been successfully created!!');
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
        $joblocation = HrmJobLocation::findOrfail($id);
        return view('modules.hrm.setup.jobLocation.create',compact('joblocation'));
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
        HrmJobLocation::updateJobLocation($request, $id);
        return redirect('/hrm/setup/job-location/')->with('update_message','This job location (uid='.$id.') has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        HrmJobLocation::destroyJobLocation($id);
        return redirect('/hrm/setup/job-location/')->with('destroy_message','This job location (uid='.$id.') has been deleted!!');
    }
}
