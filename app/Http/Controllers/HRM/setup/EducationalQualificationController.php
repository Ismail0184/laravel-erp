<?php

namespace App\Http\Controllers\HRM\setup;

use App\Http\Controllers\Controller;
use App\Models\HRM\setup\HrmEduQualification;
use Illuminate\Http\Request;

class EducationalQualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eduQuas = HrmEduQualification::all();
        return view('modules.hrm.setup.educationalQualification.index',compact('eduQuas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.hrm.setup.educationalQualification.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        HrmEduQualification::storeEduQua($request);
        return redirect('/hrm/setup/educational-qualification/')->with('store_message','A new educational qualification has been successfully created!!');
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
        $eduQua = HrmEduQualification::findOrfail($id);
        return view('modules.hrm.setup.educationalQualification.create',compact('eduQua'));
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
        HrmEduQualification::updateEduQua($request, $id);
        return redirect('/hrm/setup/educational-qualification/')->with('update_message','This educational qualification (uid='.$id.') has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        HrmEduQualification::destroyEduQua($id);
        return redirect('/hrm/setup/educational-qualification/')->with('destroy_message','This educational qualification (uid='.$id.') has been deleted!!');
    }
}
