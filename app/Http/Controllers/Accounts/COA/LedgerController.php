<?php

namespace App\Http\Controllers\Accounts\COA;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccClass;
use App\Models\Accounts\AccLedger;
use App\Models\Accounts\AccLedgerGroup;
use App\Models\Accounts\AccSubClass;
use Illuminate\Http\Request;

class LedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private  $ledger_id,$subclasses,$ledgergroups, $ledgers, $ledger;

    public function index()
    {
        $this->ledgers = AccLedger::all();
        return view('modules.accounts.coa.ledger.index', ['ledgers' => $this->ledgers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->ledgergroups = AccLedgerGroup::all()->where('status', 1);
        return view('modules.accounts.coa.ledger.create', [
            'ledgergroups'  => $this->ledgergroups
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AccLedger::storeLedger($request);
        return redirect('/accounts/coa/ledger/')->with('store_message', 'The Ledger has been successfully inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return '<h1 style="text-align: center">Team is building the page</h1>';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->ledgergroups = AccLedgerGroup::all()->where('status', 1);
        $this->ledger = AccLedger::find($id);
        return view('modules.accounts.coa.ledger.create', ['ledgergroups' =>$this->ledgergroups, 'ledger' => $this->ledger]);
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
        AccLedger::updateLedger($request, $id);
        return redirect('/accounts/coa/ledger/')->with('update_message','This Ledger (uid = '.$id.') has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AccLedger::destroyLedger($id);
        return redirect('/accounts/coa/ledger/')->with('destroy_message','This Ledger (uid = '.$id.') has been successfully deleted');

    }
}
