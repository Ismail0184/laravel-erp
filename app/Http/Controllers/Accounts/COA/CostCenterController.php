<?php

namespace App\Http\Controllers\Accounts\COA;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccCostCategory;
use App\Models\Accounts\AccCostCenter;
use Illuminate\Http\Request;

class CostCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    private $costcenters, $costcenter, $costcategories;

    public function index()
    {
        $this->costcenters = AccCostCenter::all();
        return view('modules.accounts.coa.costcenter.index', ['costcenters' =>$this->costcenters]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->costcategories = AccCostCategory::all();
        $this->costcenter = AccCostCenter::all();
        return view('modules.accounts.coa.costcenter.create', ['costcenter' =>$this->costcenter], ['costcategories' => $this->costcategories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AccCostCenter::storeCostCenter($request);
        return redirect('/accounts/coa/cost-center/')->with('store_message','This Cost Center has been successfully inserted');
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
        $this->costcenter = AccCostCenter::find($id);
        $this->costcategories = AccCostCategory::all();
        return view('modules.accounts.coa.costcenter.create',['costcenter' => $this->costcenter],['costcategories' =>$this->costcategories]);
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
        AccCostCenter::updateCostCenter($request, $id);
        return redirect('/accounts/coa/cost-center/')->with('update_message','This Cost Centre (uid = '.$id.') has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AccCostCenter::destroyCostCenter($id);
        return redirect('/accounts/coa/cost-center/')->with('destroy_message','This Cost Centre (uid = '.$id.') has been successfully deleted');

    }
}
