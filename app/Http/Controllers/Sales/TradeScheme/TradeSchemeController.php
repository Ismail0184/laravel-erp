<?php

namespace App\Http\Controllers\Sales\TradeScheme;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Products\AccProductItem;
use App\Models\Sales\Dealer\SalDealerType;
use App\Models\Sales\TradeScheme\SalTradeScheme;
use Illuminate\Http\Request;

class TradeSchemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tsdatas = SalTradeScheme::all();
        return view('modules.Sales.tradeScheme.index',compact('tsdatas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = SalDealerType::where('status','active')->get();
        $items = AccProductItem::where('status','active')->get();
        return view('modules.sales.tradeScheme.create',compact(['types','items']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        SalTradeScheme::storeTS($request);
        return redirect('/sales/trade-scheme/')->with('store_message','This Trade Scheme has been successfully created!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ts = SalTradeScheme::findOrfail($id);
        return view('modules.sales.tradeScheme.show',compact('ts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $types = SalDealerType::where('status','active')->get();
        $items = AccProductItem::where('status','active')->get();
        $ts = SalTradeScheme::findOrfail($id);
        return view('modules.sales.tradeScheme.create',compact(['types','items','ts']));
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
        SalTradeScheme::updateTS($request, $id);
        return redirect('/sales/trade-scheme/')->with('update_message','This Trade Scheme (uid='.$id.') has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SalTradeScheme::destroyTS($id);
        return redirect('/sales/trade-scheme/')->with('destroy_message','This Trade Scheme (uid='.$id.') has been updated');
    }
}
