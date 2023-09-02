<?php

namespace App\Http\Controllers\HRM\setup;

use App\Http\Controllers\Controller;
use App\Models\HRM\setup\HrmLeaveType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leaveTypes = HrmLeaveType::all();
        return view('modules.hrm.setup.leaveType.index',compact('leaveTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.hrm.setup.leaveType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        HrmLeaveType::storeLeaveType($request);
        return redirect('/hrm/setup/leave-type/')->with('store_message','A leave type has been successfully created!!');
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
        $leaveType = HrmLeaveType::findOrfail($id);
        return view('modules.hrm.setup.leaveType.create',compact('leaveType'));
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
        HrmLeaveType::updateLeaveType($request, $id);
        return redirect('/hrm/setup/leave-type/')->with('update_message','This leave type (uid='.$id.') has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        HrmLeaveType::destroyLeaveType($id);
        return redirect('/hrm/setup/leave-type/')->with('destory_message','This leave type (uid='.$id.') has been deleted!!');
    }
}
