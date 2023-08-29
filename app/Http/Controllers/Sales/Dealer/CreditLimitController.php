<?php

namespace App\Http\Controllers\Sales\Dealer;

use App\Http\Controllers\Controller;
use App\Models\Sales\Dealer\SalDealerCreditLimit;
use App\Models\Sales\Dealer\SalDealerInfo;
use Illuminate\Http\Request;

class CreditLimitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $creditLimits = SalDealerCreditLimit::all();
        return view('modules.sales.creditLimit.index',compact('creditLimits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dealers = SalDealerInfo::where('status','active')->get();
        return view('modules.sales.creditLimit.create',compact(['dealers']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        SalDealerCreditLimit::storeCreditLimit($request);
        return redirect('/sales/credit-limit-request/')->with('store_message','A credit limit request has been successfully created!!');
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
        $dealers = SalDealerInfo::where('status','active')->get();
        $cl = SalDealerCreditLimit::findOrfail($id);
        return view('modules.sales.creditLimit.create',compact(['dealers','cl']));
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
        SalDealerCreditLimit::updateCreditLimit($request, $id);
        return redirect('/sales/credit-limit-request/')->with('update_message','This credit limit request (uid='.$id.') has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SalDealerCreditLimit::destroyCreditLimit($id);
        return redirect('/sales/credit-limit-request/')->with('destroy_message','This credit limit request (uid='.$id.') has been deleted!!');
    }
}
