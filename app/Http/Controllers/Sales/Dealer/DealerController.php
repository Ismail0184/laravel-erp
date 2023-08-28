<?php

namespace App\Http\Controllers\Sales\Dealer;

use App\Http\Controllers\Controller;
use App\Models\Developer\DevMainMenu;
use App\Models\Sales\Dealer\SalDealerCategory;
use App\Models\Sales\Dealer\SalDealerInfo;
use App\Models\Sales\Dealer\SalDealerType;
use App\Models\Sales\DistributionSetup\SalTerritory;
use App\Models\Sales\DistributionSetup\SalTown;
use Illuminate\Http\Request;

class DealerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dealers = SalDealerInfo::all();
        return view('modules.sales.dealer.dealerinfo.index',compact(['dealers']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $territories = SalTerritory::where('status','active')->get();
        $towns = SalTown::where('status','active')->get();
        $categories = SalDealerCategory::where('status','active')->get();
        $types = SalDealerType::where('status','active')->get();
        return view('modules.sales.dealer.dealerinfo.create',compact(['territories','towns','categories','types']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        SalDealerInfo::storeDealer($request);
        return redirect('/sales/dealer/info/')->with('store_message','A new dealer has been successfully created!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dealer = SalDealerInfo::findOrfail($id);
        $territories = SalTerritory::where('status','active')->get();
        $towns = SalTown::where('status','active')->get();
        $categories = SalDealerCategory::where('status','active')->get();
        $types = SalDealerType::where('status','active')->get();
        return view('modules.sales.dealer.dealerinfo.show',compact(['dealer','territories','towns','categories','types']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dealer = SalDealerInfo::findOrfail($id);
        $territories = SalTerritory::where('status','active')->get();
        $towns = SalTown::where('status','active')->get();
        $categories = SalDealerCategory::where('status','active')->get();
        $types = SalDealerType::where('status','active')->get();

        return view('modules.sales.dealer.dealerinfo.create',compact(['territories','towns','categories','types','dealer']));
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
        SalDealerInfo::updateDealer($request,$id);
        return redirect('/sales/dealer/info/')->with('update_message','This dealer (uid='.$id.') has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SalDealerInfo::destroyDealer($id);
        return redirect('/sales/dealer/info/')->with('destroy_message','This dealer (uid='.$id.') has been deleted!!');
    }
}
