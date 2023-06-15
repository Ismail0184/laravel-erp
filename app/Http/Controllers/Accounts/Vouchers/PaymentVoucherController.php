<?php

namespace App\Http\Controllers\Accounts\Vouchers;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccLedger;
use App\Models\Accounts\Vouchers\AccJournalMaster;
use App\Models\Accounts\Vouchers\AccPayment;
use Illuminate\Http\Request;
use Auth;
use Session;

class PaymentVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $paymentVoucher,$ledgers,$vouchertype,$masterData,$payments,$editValue,$COUNT_payments_data,$paymntdatas,$payment,$vouchermaster;


    public function index()
    {
        $this->paymntdatas = AccJournalMaster::where('status','!=','MANUAL')->where('journal_type','payment')->get();
        return view('modules.accounts.vouchers.payment.index', ['paymntdatas' =>$this->paymntdatas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->ledgers = AccLedger::where('status','active')->where('show_in_transaction','1')->get();
        $this->vouchertype ='2';
        $this->paymenttVoucher = Auth::user()->id.$this->vouchertype.date('YmdHis');
        if(Session::get('payment_no')>0)
        {
            $this->masterData = AccJournalMaster::find(Session::get('payment_no'));
            $this->receipts = AccPayment::where('payment_no', Session::get('payment_no'))->get();
            $this->COUNT_receipts_data = AccPayment::where('payment_no', Session::get('payment_no'))->count();
        }

        return view('modules.accounts.vouchers.payment.create', [
            'paymentVoucher' =>$this->paymenttVoucher,
            'ledgers' => $this->ledgers,
            'ledgerss' => $this->ledgers,
            'masterData' => $this->masterData,
            'payment' => $this->payment,
            'COUNT_payments_data' => $this->COUNT_payments_data
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
