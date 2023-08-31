<?php

namespace App\Http\Controllers\HRM\setup;

use App\Http\Controllers\Controller;
use App\Models\HRM\setup\HrmEduSubject;
use Illuminate\Http\Request;

class EduSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eduSubjects = HrmEduSubject::all();
        return view('modules.hrm.setup.eduSubject.index',compact('eduSubjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.hrm.setup.eduSubject.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        HrmEduSubject::storeEduSubject($request);
        return redirect('/hrm/setup/education-subject/')->with('store_message','A education subject has been created!!');
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
        $eduSubject = HrmEduSubject::findOrfail($id);
        return view('modules.hrm.setup.eduSubject.create',compact('eduSubject'));
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
        HrmEduSubject::updateEduSubject($request, $id);
        return redirect('/hrm/setup/education-subject/')->with('update_message','This educational subject (uid='.$id.') has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        HrmEduSubject::where('id',$id)->update(['status'=>'deleted']);
        return redirect('/hrm/setup/education-subject/')->with('destroy_message','This educational subject (uid='.$id.') has been deleted!!');
    }
}
