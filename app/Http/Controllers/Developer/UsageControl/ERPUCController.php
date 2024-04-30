<?php

namespace App\Http\Controllers\Developer\UsageControl;

use App\Http\Controllers\Controller;
use App\Models\Developer\UsageControl\DevUsageControlMeta;
use Illuminate\Http\Request;

class ERPUCController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usageControlData = DevUsageControlMeta::all();
        return view('modules.developer.usageControl.index',compact('usageControlData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.developer.usageControl.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DevUsageControlMeta::storeMetaData($request);
        return redirect('/developer/usage-control/meta/')->with('store_message','New meta data has been created!!');
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
        $meta = DevUsageControlMeta::findOrfail($id);
        return view('modules.developer.usageControl.create',compact('meta'));
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
        DevUsageControlMeta::updateMetaData($request, $id);
        return redirect('/developer/usage-control/meta/')->with('update_message','This meta data ('.$id.') has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DevUsageControlMeta::destroyMetaData($id);
        return redirect('/developer/usage-control/meta/')->with('destroy_message','This meta data ('.$id.') has been deleted!!');
    }
}
