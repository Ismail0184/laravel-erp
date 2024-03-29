<?php

namespace App\Http\Controllers\HRM\payroll;

use App\Http\Controllers\Controller;
use App\Models\HRM\payroll\HrmPayrollSalaryScale;
use Illuminate\Http\Request;

class HrmPayrollSalaryScaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salaryScales = HrmPayrollSalaryScale::all();
        return view('modules.hrm.payroll.salaryScale.index',compact('salaryScales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.hrm.payroll.salaryScale.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        HrmPayrollSalaryScale::storeSalaryScale($request);
        return redirect('/hrm/payroll/salary-scale/')->with('store_message','Salary Scale has been created!!');
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
        $salaryScale = HrmPayrollSalaryScale::findOrfail($id);
        return view('modules.hrm.payroll.salaryScale.create',compact('salaryScale'));
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
        HrmPayrollSalaryScale::updateSalaryScale($request, $id);
        return redirect('/hrm/payroll/salary-scale/')->with('update_message','Salary Scale has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        HrmPayrollSalaryScale::destroySalaryScale($id);
        return redirect('/hrm/payroll/salary-scale/')->with('destroy_message','Salary Scale has been deleted!!');

    }
}
