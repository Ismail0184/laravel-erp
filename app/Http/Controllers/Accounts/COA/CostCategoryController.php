<?php

namespace App\Http\Controllers\Accounts\COA;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccCostCategory;
use Illuminate\Http\Request;

class CostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $costcategories, $costcategory;

    public function index()
    {
        $this->costcategories = AccCostCategory::all();
        return view('modules.accounts.coa.costcategory.index', ['costcategories' =>$this->costcategories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.accounts.coa.costcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AccCostCategory::storeCostCategory($request);
        return redirect('/accounts/coa/cost-category/')->with('store_message','The Cost Category has been successfully inserted');
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
        $this->costcategory = AccCostCategory::find($id);
        return view('modules.accounts.coa.costcategory.create', ['costcategory' =>$this->costcategory]);
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
        AccCostCategory::updateCostCategory($request, $id);
        return redirect('/accounts/coa/cost-category/')->with('update_message','This Cost Category (uid = '.$id.') has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AccCostCategory::destroyCostCategory($id);
        return redirect('/accounts/coa/cost-category/')->with('destroy_message','This Cost Category (uid = '.$id.') has been successfully deleted');
    }
}
