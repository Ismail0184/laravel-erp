<?php

namespace App\Http\Controllers\Accounts\Vouchers;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccCostCenter;
use App\Models\Accounts\AccLedger;
use App\Models\Accounts\Vouchers\AccVoucherMaster;
use App\Models\Accounts\Vouchers\AccPayment;
use Illuminate\Http\Request;
use Auth;
use Session;
use Pdf;

class PaymentVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $paymentVoucher,$ledgers,$vouchertype,$masterData,$payments,$editValue,$COUNT_payments_data,$paymntdatas,$payment,$vouchermaster,$costcenters;


    public function index()
    {
        $this->paymntdatas = AccVoucherMaster::where('status','!=','MANUAL')->where('journal_type','payment')->get();
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
        $this->costcenters = AccCostCenter::where('status','active')->get();
        $this->vouchertype ='2';
        $this->paymentVoucher = Auth::user()->id.$this->vouchertype.date('YmdHis');
        if(Session::get('payment_no')>0)
        {
            $this->masterData = AccVoucherMaster::find(Session::get('payment_no'));
            $this->payments = AccPayment::where('payment_no', Session::get('payment_no'))->get();
            $this->COUNT_payments_data = AccPayment::where('payment_no', Session::get('payment_no'))->count();
        }

        return view('modules.accounts.vouchers.payment.create', [
            'paymentVoucher' =>$this->paymentVoucher,
            'ledgers' => $this->ledgers,
            'ledgerss' => $this->ledgers,
            'masterData' => $this->masterData,
            'payments' => $this->payments,
            'COUNT_payments_data' => $this->COUNT_payments_data,
            'costcenters' =>$this->costcenters
        ] );
    }


    public function createMultiple()
    {
        $this->ledgers = AccLedger::where('status','active')->where('show_in_transaction','1')->get();
        $this->costcenters = AccCostCenter::where('status','active')->get();
        $this->vouchertype ='2';
        $this->paymentVoucher = Auth::user()->id.$this->vouchertype.date('YmdHis');
        if(Session::get('payment_no')>0)
        {
            $this->masterData = AccVoucherMaster::find(Session::get('payment_no'));
            $this->payments = AccPayment::where('payment_no', Session::get('payment_no'))->get();
            $this->COUNT_payments_data = AccPayment::where('payment_no', Session::get('payment_no'))->count();
        }

        return view('modules.accounts.vouchers.payment.create-multiple', [
            'paymentVoucher' =>$this->paymentVoucher,
            'ledgers' => $this->ledgers,
            'ledgerss' => $this->ledgers,
            'masterData' => $this->masterData,
            'payments' => $this->payments,
            'COUNT_payments_data' => $this->COUNT_payments_data,
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
        AccPayment::addPaymentData($request);
        if ($request->vouchertype=='multiple') {
        } else {
            $this->masterData = AccVoucherMaster::find(Session::get('payment_no'));
            $this->payments = AccPayment::where('payment_no', Session::get('payment_no'))->get();
            $totalDebit = 0;
            $totalCredit = 0;
            foreach ($this->payments as $payments){
                $totalDebit = $totalDebit + $payments->dr_amt;
                $totalCredit = $totalCredit + $payments->cr_amt;
            }
            if(number_format($totalDebit,2) === number_format($this->masterData->amount,2) && number_format($totalDebit,2) !== number_format($totalCredit,2))
            {
                AccPayment::addPaymentDataCr($request);
            }}
        if ($request->vouchertype=='multiple') {
            return redirect('/accounts/voucher/payment/create-multiple')->with('store_message', 'A payment data successfully added!!');
        } else {
            return redirect('/accounts/voucher/payment/create')->with('store_message', 'A payment data successfully added!!');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->payment = AccPayment::where('payment_no',$id)->get();
        $this->vouchermaster = AccVoucherMaster::find($id);
        return view('modules.accounts.vouchers.payment.show', [
            'payments' =>$this->payment,
            'vouchermaster' =>$this->vouchermaster,
        ]);
    }

    public function downalodvoucher($id)
    {
        $this->payment = AccPayment::where('payment_no',$id)->get();
        $this->vouchermaster = AccVoucherMaster::find($id);
        $pdf = PDF::loadView('modules.accounts.vouchers.payment.download', [
            'payments' =>$this->payment,
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
        $this->vouchertype ='2';
        $this->paymentVoucher = Auth::user()->id.$this->vouchertype.date('YmdHis');
        if(Session::get('payment_no')>0)
        {
            $this->masterData = AccVoucherMaster::find(Session::get('payment_no'));
            $this->payments = AccPayment::where('payment_no', Session::get('payment_no'))->get();
            $this->COUNT_payments_data = AccPayment::where('payment_no', Session::get('payment_no'))->count();
        }
        if(\request('id')>0)
        {
            $this->editValue = AccPayment::find($id);
        }

        return view('modules.accounts.vouchers.payment.create', [
            'paymentVoucher' =>$this->paymentVoucher,
            'ledgers' => $this->ledgers,
            'ledgerss' => $this->ledgers,
            'masterData' => $this->masterData,
            'payments' => $this->payments,
            'editValue' => $this->editValue,
            'COUNT_payments_data' => $this->COUNT_payments_data,
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
        AccPayment::updatePaymentData($request, $id);
        if ($request->vouchertype=='multiple') {
            return redirect('/accounts/voucher/payment/create-multiple')->with('update_message', 'This data (uid=' . $id . ') has been successfully updated!!');
        } else {
            return redirect('/accounts/voucher/payment/create')->with('update_message', 'This data (uid=' . $id . ') has been successfully updated!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        AccPayment::destroyPaymentData($id);
        if ($request->vouchertype=='multiple') {
            return redirect('/accounts/voucher/payment/create-multiple')->with('destroy_message', 'This data (Uid = ' . $id . ') has been successfully deleted!!');
        } else {
            return redirect('/accounts/voucher/payment/create')->with('destroy_message', 'This data (Uid = ' . $id . ') has been successfully deleted!!');
        }
    }

    public function confirm(Request $request, $id)
    {
        AccPayment::confirmPaymentVoucher($request, $id);
        AccVoucherMaster::ConfirmVoucher($request, $id);
        Session::forget('payment_no');
        Session::forget('payment_narration');
        return redirect('/accounts/voucher/payment')->with('store_message','A payment voucher has been successfully created!!');
    }

    public function statusupdate(Request $request, $id)
    {
        AccPayment::statusupdate($request, $id);
        AccVoucherMaster::receiptVoucherStatusUpdate($request, $id);
        return redirect('/accounts/voucher/payment')->with('store_message','This voucher has been successfully '.$request->status.' !!');
    }
}
