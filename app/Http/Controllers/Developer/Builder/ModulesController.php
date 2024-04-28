<?php

namespace App\Http\Controllers\Developer\Builder;

use App\Http\Controllers\Controller;
use App\Models\Developer\DevModule;
use Illuminate\Http\Request;

class ModulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $modules, $module;

    public function index()
    {
        $this->modules = DevModule::all();
        return view('modules.developer.module.index', ['modules' => $this->modules]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.developer.module.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DevModule::storeModule($request);
        return redirect('/developer/modules/')->with('store_message','New module inserted successfully!!');
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
        $this->module = DevModule::find($id);
        return view('modules.developer.module.create', ['module' =>$this->module]);

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
        DevModule::updateModule($request, $id);
        return redirect('/developer/modules/')->with('update_message','This module (uid = '.$id.') has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DevModule::destroyModule($id);
        return redirect('/developer/modules/')->with('destroy_message','This module (uid = '.$id.') has been successfully deleted');

    }
}
