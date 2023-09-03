<?php

namespace App\Http\Controllers\HRM\setup;

use App\Http\Controllers\Controller;
use App\Models\HRM\setup\HrmEduExamTitle;
use Illuminate\Http\Request;

class EduExamTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eduExamTitles = HrmEduExamTitle::all();
        return view('modules.hrm.setup.eduExamTitle.index',compact('eduExamTitles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.hrm.setup.eduExamTitle.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        HrmEduExamTitle::storeEduExamTitle($request);
        return redirect('/hrm/setup/education-exam-title/')->with('store_message','A exam titile has been successfully created!!');
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
        $eduExamTitle = HrmEduExamTitle::findOrfail($id);
        return view('modules.hrm.setup.eduExamTitle.create',compact('eduExamTitle'));
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
        HrmEduExamTitle::updateEduExamTitle($request, $id);
        return redirect('/hrm/setup/education-exam-title/')->with('update_message','This exam title (uid='.$id.') has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        HrmEduExamTitle::destroyEduExamTitle($id);
        return redirect('/hrm/setup/education-exam-title/')->with('destroy_message','This exam title (uid='.$id.') has been deleted!!');
    }
}
