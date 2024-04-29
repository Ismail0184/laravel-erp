<?php

namespace App\Http\Controllers\Developer\Builder;

use App\Http\Controllers\Controller;
use App\Models\Developer\Builder\DevModule;
use App\Models\Developer\Reports\DevRepoptGroupLabel;
use Illuminate\Http\Request;

class DevReportGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reportGroups = DevRepoptGroupLabel::orderBy('id','asc')->get();
        return view('modules.developer.report.reportGroup.index',compact('reportGroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modules = DevModule::where('status','1')->get();
        return view('modules.developer.report.reportGroup.create',compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DevRepoptGroupLabel::storeReportLabel($request);
        return redirect('/developer/builder/report-group-labels/')->with('store_message','Report group has been created successfully!!');
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
        $modules = DevModule::where('status','1')->get();
        $reportGroup = DevRepoptGroupLabel::findOrfail($id);
        return view('modules.developer.report.reportGroup.create',compact(['modules','reportGroup']));
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
        DevRepoptGroupLabel::updateReportLabel($request, $id);
        return redirect('/developer/builder/report-group-labels/')->with('update_message','This report group (uid='.$id.') has been updated!!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DevRepoptGroupLabel::destroyReportLabel($id);
        return redirect('/developer/builder/report-group-labels/')->with('destroy_message','This report group (uid='.$id.') has been deleted!!');

    }
}
