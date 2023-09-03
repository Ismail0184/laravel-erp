<?php

namespace App\Http\Controllers\HRM\setup;

use App\Http\Controllers\Controller;
use App\Models\HRM\setup\HrmJobExperience;
use Illuminate\Http\Request;

class JobExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobExperiences = HrmJobExperience::all();
        return view('modules.hrm.setup.jobExperience.index',compact('jobExperiences'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.hrm.setup.jobExperience.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        HrmJobExperience::storeJobExperience($request);
        return redirect('/hrm/setup/job-experience/')->with('store_message','A job experience has been successfully created!!');
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
        $jobExperience = HrmJobExperience::findOrfail($id);
        return view('modules.hrm.setup.jobExperience.create',compact('jobExperience'));
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
        HrmJobExperience::updateJobExperience($request, $id);
        return redirect('/hrm/setup/job-experience/')->with('update_message','This job experience (uid='.$id.') has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        HrmJobExperience::destroyJobExperience($id);
        return redirect('/hrm/setup/job-experience/')->with('destroy_message','This job experience (uid='.$id.') has been deleted!!');
    }
}
