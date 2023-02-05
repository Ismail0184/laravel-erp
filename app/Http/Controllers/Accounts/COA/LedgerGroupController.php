<?php

namespace App\Http\Controllers\Accounts\COA;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccClass;
use App\Models\Accounts\AccLedgerGroup;
use App\Models\Accounts\AccSubClass;
use Illuminate\Http\Request;

class LedgerGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $subclasses, $classes, $ledgergroups, $ledgergroup;

    public function index()
    {
        $this->ledgergroups = AccLedgerGroup::all();
        return view('modules.accounts.coa.ledgergroup.index', ['ledgergroups' =>$this->ledgergroups]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->classes = AccClass::all()->where('status', 1);
        $this->subclasses = AccSubClass::all()->where('status', 1);
        return view('modules.accounts.coa.ledgergroup.create',
            ['classes'       => $this->classes,
                'subclasses' => $this->subclasses
            ],
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AccLedgerGroup::storeLedgerGroup($request);
        return redirect('/accounts/coa/ledger-group/')->with('store_message','The Ledger Group has been successfully created');

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
        $this->classes      = AccClass::all()->where('status', 1);
        $this->subclasses   = AccSubClass::all()->where('status', 1);
        $this->ledgergroup  = AccLedgerGroup::find($id);
        return view('modules.accounts.coa.ledgergroup.create',
            [
                'classes'       => $this->classes,
                'subclasses'    => $this->subclasses,
                'ledgergroup'   => $this->ledgergroup
            ],
        );
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getAllSubClass()
    {
        return response()->json(AccSubClass::where('class_id', $_GET['id'])->get());

    }
}
