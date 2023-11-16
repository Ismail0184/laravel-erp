<?php

namespace App\Http\Controllers\HRM\setup;

use App\Http\Controllers\Controller;
use App\Models\HRM\setup\HrmBlood;
use Illuminate\Http\Request;

class BloodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bloods = HrmBlood::all();
        return view('modules.hrm.setup.blood.index',compact('bloods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.hrm.setup.blood.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        HrmBlood::storeBlood($request);
        return redirect('/hrm/setup/blood/')->with('store_message','A blood group has been successfully created!!');
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
        $blood = HrmBlood::findOrfail($id);
        return view('modules.hrm.setup.blood.create',compact('blood'));

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
        HrmBlood::updateBlood($request, $id);
        return redirect('/hrm/setup/blood/')->with('update_message','This blood group (uid='.$id.') has been updated!!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
