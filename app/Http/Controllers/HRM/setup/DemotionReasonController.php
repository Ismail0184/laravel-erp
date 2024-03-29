<?php

namespace App\Http\Controllers\HRM\setup;

use App\Http\Controllers\Controller;
use App\Models\HRM\setup\HrmDemotionreason;
use App\Models\HRM\setup\HrmEduExamTitle;
use Illuminate\Http\Request;

class DemotionReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $demotionReasons = HrmDemotionreason::all();
        return view('modules.hrm.setup.demotionReason.index',compact('demotionReasons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.hrm.setup.demotionReason.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        HrmDemotionreason::storeDemotionReason($request);
        return redirect('/hrm/setup/demotion-reason/')->with('store_message','A demotion reason has been created!!');
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
        $demotionReason = HrmDemotionreason::findOrfail($id);
        return view('modules.hrm.setup.demotionReason.create',compact('demotionReason'));
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
        HrmDemotionreason::updateDemotionReason($request, $id);
        return redirect('/hrm/setup/demotion-reason/')->with('update_message','This demotion reason (uid='.$id.') has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        HrmDemotionreason::destroyDemotionReason($id);
        return redirect('/hrm/setup/demotion-reason/')->with('destroy_message','This demotion reason (uid='.$id.') has been deleted!!');
    }
}
