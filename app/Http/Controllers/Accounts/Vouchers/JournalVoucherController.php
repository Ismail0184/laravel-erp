<?php

namespace App\Http\Controllers\Accounts\Vouchers;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccCostCenter;
use App\Models\Accounts\AccLedger;
use App\Models\Accounts\AccTransactions;
use App\Models\Accounts\Vouchers\AccJournal;
use App\Models\Accounts\Vouchers\AccVoucherMaster;
use Illuminate\Http\Request;
use Auth;
use Session;
use Pdf;

class JournalVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $journalVoucher,$ledgers,$vouchertype,$masterData,$journals,$editValue,$COUNT_journals_data,$journaldatas,$journal,$vouchermaster,$costcenters,$next_transaction_id;


    public function index()
    {
        $this->journaldatas = AccVoucherMaster::where('status','!=','MANUAL')->where('journal_type','journal')->orderBy('voucher_no','DESC')->get();
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
            $this->journals = AccJournal::where('journal_no', Session::get('journal_no'))->get();
            $this->COUNT_journals_data = AccJournal::where('journal_no', Session::get('journal_no'))->count();
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
        AccJournal::addJournalData($request);
        return redirect('/accounts/voucher/journal/create')->with('store_message', 'A journal data successfully added!!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->journal = AccJournal::where('journal_no',$id)->get();
        $this->vouchermaster = AccVoucherMaster::find($id);
        return view('modules.accounts.vouchers.journal.show', [
            'journals' =>$this->journal,
            'vouchermaster' =>$this->vouchermaster,
        ]);
    }

    public function downalodvoucher($id)
    {
        $this->journal = AccJournal::where('journal_no',$id)->get();
        $this->vouchermaster = AccVoucherMaster::find($id);
        $pdf = PDF::loadView('modules.accounts.vouchers.journal.download', [
            'journals' =>$this->journal,
            'vouchermaster' =>$this->vouchermaster,
        ]);
        return $pdf->stream('voucher.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->ledgers = AccLedger::where('status','active')->where('show_in_transaction','1')->get();
        $this->costcenters = AccCostCenter::where('status','active')->get();
        $this->vouchertype ='3';
        $this->journalVoucher = Auth::user()->id.$this->vouchertype.date('YmdHis');
        if(Session::get('payment_no')>0)
        {
            $this->masterData = AccVoucherMaster::find(Session::get('journal_no'));
            $this->journals = AccJournal::where('journal_no', Session::get('journal_no'))->get();
            $this->COUNT_payments_data = AccJournal::where('journal_no', Session::get('journal_no'))->count();
        }
        if(\request('id')>0)
        {
            $this->editValue = AccJournal::find($id);
        }

        return view('modules.accounts.vouchers.journal.create', [
            'journalVoucher' =>$this->journalVoucher,
            'ledgers' => $this->ledgers,
            'ledgerss' => $this->ledgers,
            'masterData' => $this->masterData,
            'journals' => $this->journals,
            'editValue' => $this->editValue,
            'COUNT_journals_data' => $this->COUNT_journals_data,
            'costcenters' =>$this->costcenters
        ] );
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
        AccJournal::updateJournalData($request, $id);
        return redirect('/accounts/voucher/journal/create')->with('update_message', 'This data (uid=' . $id . ') has been successfully updated!!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AccJournal::destroyJournalData($id);
        return redirect('/accounts/voucher/journal/create')->with('destroy_message', 'This data (Uid = ' . $id . ') has been successfully deleted!!');
    }

    public function confirm(Request $request, $id)
    {
        function next_transaction_id()
        {   $jv_no=AccTransactions::max('transaction_no');
            $p_id= date("Ymd")."0000";
            if($jv_no>$p_id)
                $jv=$jv_no+1;
            else
                $jv=$p_id+1;
            return $jv;
        }
        $this->next_transaction_id = next_transaction_id();
        $this->journal = AccJournal::where('journal_no', Session::get('journal_no'))->get();
        AccTransactions::previousTransactionDeleteWhileEdit($id);
        foreach ($this->journal as $journalData) {
            AccTransactions::addJournalVoucher($journalData, $this->next_transaction_id);
        }
        AccJournal::confirmJournalVoucher($request, $id);
        AccVoucherMaster::ConfirmVoucher($request, $id);
        Session::forget('journal_no');
        Session::forget('journal_narration');
        return redirect('/accounts/voucher/journal')->with('store_message','A journal voucher has been successfully created!!');
    }

    public function statusupdate(Request $request, $id)
    {
        AccJournal::statusupdate($request, $id);
        AccVoucherMaster::VoucherStatusUpdate($request, $id);
        return redirect('/accounts/voucher/journal')->with('store_message','This voucher has been successfully '.$request->status.' !!');
    }
}
