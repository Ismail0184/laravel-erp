<?php

namespace App\Http\Controllers\Accounts\Vouchers;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccCostCenter;
use App\Models\Accounts\AccLedger;
use App\Models\Accounts\Vouchers\AccJournal;
use App\Models\Accounts\Vouchers\AccVoucherMaster;
use Illuminate\Http\Request;
use Auth;
use Session;

class JournalVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $journalVoucher,$ledgers,$vouchertype,$masterData,$journals,$editValue,$COUNT_journals_data,$journaldatas,$journal,$vouchermaster,$costcenters;


    public function index()
    {
        $this->journaldatas = AccVoucherMaster::where('status','!=','MANUAL')->where('journal_type','journal')->get();
        return view('modules.accounts.vouchers.journal.index', ['journaldatas' =>$this->journaldatas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->ledgers = AccLedger::where('status','active')->where('show_in_transaction','1')->get();
        $this->costcenters = AccCostCenter::where('status','active')->get();
        $this->vouchertype ='3';
        $this->journalVoucher = Auth::user()->id.$this->vouchertype.date('YmdHis');
        if(Session::get('journal_no')>0)
        {
            $this->masterData = AccVoucherMaster::find(Session::get('journal_no'));
            $this->payments = AccJournal::where('payment_no', Session::get('journal_no'))->get();
            $this->COUNT_payments_data = AccJournal::where('journal_no', Session::get('journal_no'))->count();
        }

        return view('modules.accounts.vouchers.journal.create', [
            'journalVoucher' =>$this->journalVoucher,
            'ledgers' => $this->ledgers,
            'ledgerss' => $this->ledgers,
            'masterData' => $this->masterData,
            'journals' => $this->journals,
            'COUNT_journals_data' => $this->COUNT_journals_data,
            'costcenters' =>$this->costcenters
        ] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
}
