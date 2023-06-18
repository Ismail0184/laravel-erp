<?php

namespace App\Http\Controllers\Accounts\Vouchers;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccLedger;
use App\Models\Accounts\Vouchers\AccVoucherMaster;
use Illuminate\Http\Request;
use Auth;
use Session;
use PDF;

class ChequePaymentVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $cpaymentVoucher,$ledgers,$vouchertype,$masterData,$cpayments,$editValue,$COUNT_cpayments_data,$cpaymntdatas,$cpayment,$vouchermaster,$costcenters;

    public function index()
    {
        $this->cpaymntdatas = AccVoucherMaster::where('status','!=','MANUAL')->where('journal_type','cpayment')->orderBy('voucher_no','DESC')->get();
        return view('modules.accounts.vouchers.chequepayment.index', ['cpaymntdatas' =>$this->cpaymntdatas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->ledgers = AccLedger::where('status','active')->where('show_in_transaction','1')->where('group_id','1002')->whereBetween('ledger_id',['1002000200010000','1002000201000000'])->get();
        $this->vouchertype ='5';
        $this->cpaymentVoucher = Auth::user()->id.$this->vouchertype.date('YmdHis');
        if(Session::get('payment_no')>0)
        {
            $this->masterData = AccVoucherMaster::find(Session::get('cpayment_no'));
            $this->cpayments = AccPayment::where('cpayment_no', Session::get('cpayment_no'))->get();
            $this->COUNT_cpayments_data = AccPayment::where('cpayment_no', Session::get('cpayment_no'))->count();
        }
        return view('modules.accounts.vouchers.chequepayment.create', [
            'cpaymentVoucher' =>$this->cpaymentVoucher,
            'ledgers' => $this->ledgers,
            'ledgerss' => $this->ledgers,
            'masterData' => $this->masterData,
            'cpayments' => $this->cpayments,
            'COUNT_cpayments_data' => $this->COUNT_cpayments_data,
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
