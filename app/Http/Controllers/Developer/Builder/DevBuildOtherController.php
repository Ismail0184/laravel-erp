<?php

namespace App\Http\Controllers\Developer\Builder;

use App\Http\Controllers\Controller;
use App\Models\Developer\Builder\DevBuilderOther;
use Illuminate\Http\Request;

class DevBuildOtherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $others = DevBuilderOther::all();
        return view('modules.developer.builder.other.index',compact('others'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.developer.builder.other.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DevBuilderOther::storeOtherOption($request);
        return redirect('/developer/builder/other')->with('store_message','A new options has been successfully created!!');
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
        $other = DevBuilderOther::find($id);
        return view('modules.developer.builder.other.create',compact('other'));
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
        DevBuilderOther::updateOtherOption($request, $id);
        return redirect('/developer/builder/other')->with('update_message','This options (uid='.$id.') has been successfully updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DevBuilderOther::destroyOtherOption($id);
        return redirect('/developer/builder/other')->with('destroy_message','This options (uid='.$id.') has been successfully deleted!!');
    }
}
