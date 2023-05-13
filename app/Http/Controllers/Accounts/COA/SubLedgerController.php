<?php

namespace App\Http\Controllers\Accounts\COA;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccLedger;
use App\Models\Accounts\AccSubLedger;
use Illuminate\Http\Request;

class SubLedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $subledgers, $subledger, $ledgers;

    public function index()
    {
        $this->subledgers = AccSubLedger::all();
        return view('modules.accounts.coa.subledger.index', ['subledgers' => $this->subledgers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->ledgers = AccLedger::all();
        return view('modules.accounts.coa.subledger.create', ['ledgers' => $this->ledgers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AccSubLedger::storeSubLedger($request);
        AccLedger::storeSubLedgerAsLedger($request);
        return redirect('/accounts/coa/sub-ledger/')->with('store_message', 'The Sub-Ledger has been successfully inserted');
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
    public function edit($sub_ledger_id)
    {
        $this->subledger    = AccSubLedger::find($sub_ledger_id);
        $this->ledgers      = AccLedger::all();
        return view('modules.accounts.coa.subledger.create', ['subledger' => $this->subledger], ['ledgers' => $this->ledgers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sub_ledger_id)
    {
        AccSubLedger::updateSubLedger($request, $sub_ledger_id);
        AccLedger::updateSubLedgerAsLedger($request, $sub_ledger_id);
        return redirect('/accounts/coa/sub-ledger/')->with('update_message','This Sub-Ledger (uid = '.$sub_ledger_id.') has been successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AccSubLedger::destroySubLedger($id);
        return redirect('/accounts/coa/sub-ledger/')->with('destroy_message','This Sub-Ledger (uid = '.$id.') has been successfully deleted');
    }
}
