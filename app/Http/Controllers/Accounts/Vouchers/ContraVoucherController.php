<?php

namespace App\Http\Controllers\Accounts\Vouchers;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccCostCenter;
use App\Models\Accounts\AccLedger;
use App\Models\Accounts\Vouchers\AccContra;
use App\Models\Accounts\Vouchers\AccJournal;
use App\Models\Accounts\Vouchers\AccVoucherMaster;
use Illuminate\Http\Request;
use Auth;
use Session;

class ContraVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $contraVoucher,$ledgers,$vouchertype,$masterData,$contras,$editValue,$COUNT_contras_data,$contradatas,$contra,$vouchermaster,$costcenters;


    public function index()
    {
        $this->contradatas = AccVoucherMaster::where('status','!=','MANUAL')->where('journal_type','contra')->orderBy('voucher_no','DESC')->get();
        return view('modules.accounts.vouchers.contra.index', ['contradatas' =>$this->contradatas]);
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
        $this->vouchertype ='4';
        $this->journalVoucher = Auth::user()->id.$this->vouchertype.date('YmdHis');
        if(Session::get('contra_no')>0)
        {
            $this->masterData = AccVoucherMaster::find(Session::get('contra_no'));
            $this->contras = AccContra::where('contra_no', Session::get('contra_no'))->get();
            $this->COUNT_contras_data = AccContra::where('contra_no', Session::get('contra_no'))->count();
        }

        return view('modules.accounts.vouchers.contra.create', [
            'journalVoucher' =>$this->journalVoucher,
            'ledgers' => $this->ledgers,
            'ledgerss' => $this->ledgers,
            'masterData' => $this->masterData,
            'contras' => $this->contras,
            'COUNT_contras_data' => $this->COUNT_contras_data,
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
        AccContra::addContraData($request);
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
