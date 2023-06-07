<?php

namespace App\Http\Controllers\Accounts\COA;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccLedger;
use App\Models\Accounts\AccSubLedger;
use App\Models\Accounts\AccSubSubLedger;
use Illuminate\Http\Request;

class SubSubLedgerController extends Controller
{

    private  $subSubLedgers, $subledgers , $next_sub_sub_ledger_id;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->subSubLedgers = AccSubSubLedger::all();
        return view('modules.accounts.coa.subsubledger.index', ['subsubledgers' => $this->subSubLedgers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->subledgers = AccSubLedger::where('status','active')->get();
        return view('modules.accounts.coa.subsubledger.create',['subledgers' => $this->subledgers,
            'next_sub_sub_ledger_id' => $this->next_sub_sub_ledger_id
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
        AccSubSubLedger::storeSubSubLedger($request);
        AccLedger::storeSubSubLedgerAsLedger($request);
        return redirect('/accounts/coa/sub-sub-ledger')->with('store_message', 'The Sub-Sub-Ledger has been successfully inserted');
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
        $this->subsubledger = AccSubSubLedger::find($id);
        $this->subledgers = AccSubLedger::where('status','active')->get();
        return view('modules.accounts.coa.subsubledger.create',['subledgers' => $this->subledgers,
            'subsubledger' => $this->subsubledger
            ]);
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
        AccSubSubLedger::updateSubSubLedger($request, $id);
        AccLedger::updateSubSubLedgerAsLedger($request, $id);
        return redirect('/accounts/coa/sub-sub-ledger/')->with('update_message','This sub-sub-Ledger (uid = '.$id.') has been successfully updated');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AccSubSubLedger::destroySubSubLedger($id);
        return redirect('/accounts/coa/sub-sub-ledger/')->with('destroy_message','This Sub Sub Ledger (Uid = '.$id.') has been successfully deleted');
    }
}
