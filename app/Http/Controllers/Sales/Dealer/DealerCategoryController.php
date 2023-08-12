<?php

namespace App\Http\Controllers\Sales\Dealer;

use App\Http\Controllers\Controller;
use App\Models\Sales\Dealer\SalDealerCategory;
use Illuminate\Http\Request;

class DealerCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = SalDealerCategory::all();
        return view('modules.sales.dealer.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.sales.dealer.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        SalDealerCategory::storeDealerCategory($request);
        return redirect('/sales/dealer/category/')->with('store_message','A new category has been successfully inserted!!');
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
        $category = SalDealerCategory::find($id);
        return view('modules.sales.dealer.category.create',compact('category'));
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
        SalDealerCategory::updateDealerCategory($request, $id);
        return redirect('/sales/dealer/category/')->with('update_message','This category (Uid='.$id.') has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SalDealerCategory::destroyDealerCategory($id);
        return redirect('/sales/dealer/category/')->with('destroy_message','This category (Uid='.$id.') has been deleted!!');
    }
}
