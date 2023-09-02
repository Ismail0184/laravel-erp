<?php

namespace App\Http\Controllers\HRM\setup;

use App\Http\Controllers\Controller;
use App\Models\HRM\setup\HrmHolidays;
use Illuminate\Http\Request;

class HolidaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $holidays = HrmHolidays::all();
        return view('modules.hrm.setup.holidays.index',compact('holidays'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.hrm.setup.holidays.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        HrmHolidays::storeHoliday($request);
        return redirect('/hrm/setup/holidays/')->with('store_message','A holiday has been successfully created!!');
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
        $holiday = HrmHolidays::findOrfail($id);
        return view('modules.hrm.setup.holidays.create',compact('holiday'));
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
        HrmHolidays::updateHoliday($request, $id);
        return redirect('/hrm/setup/holidays/')->with('update_message','This holiday (uid='.$id.') has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        HrmHolidays::destroyHoliday($id);
        return redirect('/hrm/setup/holidays/')->with('destroy_message','This holiday (uid='.$id.') has been deleted!!');
    }
}
