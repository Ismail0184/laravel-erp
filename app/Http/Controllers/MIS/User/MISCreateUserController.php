<?php

namespace App\Http\Controllers\MIS\User;

use App\Http\Controllers\Controller;
use App\Models\HRM\employee\HrmEmployee;
use App\Models\HRM\employee\HrmEmployeeJobInfo;
use App\Models\HRM\setup\HrmDesignation;
use App\Models\User;
use Illuminate\Http\Request;

class MISCreateUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = HrmEmployee::where('job_status','In Service')->orderBy('id','asc')->get();
        foreach ($employees as $employee)
        {
            $employee->getUser = User::find($employee->id);
        }
        return view('modules.mis.user.index',compact(['employees']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.mis.user.create');
    }

    public function createWithData($id)
    {
        $employee = HrmEmployee::findOrfail($id);
        return view('modules.mis.user.createWithData',compact(['employee']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeWithData(Request $request)
    {
        User::storeUserWithData($request);
        return redirect('/mis/user/create-user/')->with('store_message','This employee has been added as ERP user!!');
    }

    public function store(Request $request)
    {
        User::storeUserWithData($request);
        return redirect('/mis/user/create-user/')->with('store_message','This employee has been added as ERP user!!');
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
        //
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
        //
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
