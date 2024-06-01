<?php

namespace App\Http\Controllers\Accounts\Vouchers;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccCostCenter;
use App\Models\Accounts\AccLedger;
use App\Models\Accounts\Vouchers\AccJournal;
use App\Models\Accounts\Vouchers\AccVoucherMaster;
use App\Traits\SharedFunctionsTrait;
use App\Traits\SharedOtherOptionFunctionsTrait;
use Illuminate\Http\Request;
use Auth;
use Session;

class AccOpeningBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use SharedFunctionsTrait;
    use SharedOtherOptionFunctionsTrait;
    private $journalVoucher,$ledgers,$vouchertype,$masterData,$journals,$editValue,$COUNT_journals_data,$journaldatas,$journal,$vouchermaster,$costcenters,$next_transaction_id;


    public function index()
    {
        $this->journaldatas = AccVoucherMaster::where('journal_type','journal')->where('entry_by',Auth::user()->id)->where('company_id',Auth::user()->company_id)->where('group_id',Auth::user()->group_id)->orderBy('voucher_no','DESC')->get();
        return view('modules.accounts.vouchers.openingBalance.index', [
            'journaldatas' =>$this->journaldatas,
            'checkVoucherEditAccessByCreatedPerson' => $this->checkVoucherEditAccessByCreatedPerson(),
            'deletedVoucherRecoveryAccess' => $this->deletedVoucherRecoveryAccess()

        ]);
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
        $this->journalVoucher = $this->voucherNumberGenerate('0');
        if(Session::get('opening_journal_no')>0)
        {
            $this->masterData = AccVoucherMaster::findOrfail(Session::get('opening_journal_no'));
            $this->journals = AccJournal::where('opening_journal_no', Session::get('opening_journal_no'))->get();
            $this->COUNT_journals_data = AccJournal::where('opening_journal_no', Session::get('opening_journal_no'))->count();
        }

        return view('modules.accounts.vouchers.openingBalance.create', [
            'journalVoucher' =>$this->journalVoucher,
            'ledgers' => $this->ledgers,
            'ledgerss' => $this->ledgers,
            'masterData' => $this->masterData,
            'journals' => $this->journals,
            'COUNT_journals_data' => $this->COUNT_journals_data,
            'costcenters' =>$this->costcenters,
            'minDatePermission' => $this->sharedFunction(),
            'checkLedgerBalanceBeforeMakingJournal' => $this->checkLedgerBalanceBeforeMakingJournal()
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
