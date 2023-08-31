<?php

namespace App\Http\Controllers\HRM\setup;

use App\Http\Controllers\Controller;
use App\Models\HRM\setup\HrmEmploymentType;
use Illuminate\Http\Request;

class EmploymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employmentTypes = HrmEmploymentType::all();
        return view('modules.hrm.setup.employmentType.index',compact('employmentTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.hrm.setup.employmentType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        HrmEmploymentType::storeEmploymentType($request);
        return redirect('/hrm/setup/employment-type/')->with('store_message','A new employment type has been created!!');
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
        $employmentType = HrmEmploymentType::findOrfail($id);
        return view('modules.hrm.setup.employmentType.create',compact('employmentType'));
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
        HrmEmploymentType::updateEmploymentType($request, $id);
        return redirect('/hrm/setup/employment-type/')->with('update_message','This employment type (uid='.$id.') has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        HrmEmploymentType::destroyEmploymentType($id);
        return redirect('/hrm/setup/employment-type/')->with('destroy_message','This employment type (uid='.$id.') has been deleted!!');
    }
}
