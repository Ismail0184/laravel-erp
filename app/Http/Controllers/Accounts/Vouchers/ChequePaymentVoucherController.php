<?php

namespace App\Http\Controllers\Accounts\Vouchers;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccCostCenter;
use App\Models\Accounts\AccLedger;
use App\Models\Accounts\Vouchers\AccChequePayment;
use App\Models\Accounts\Vouchers\AccPayment;
use App\Models\Accounts\Vouchers\AccVoucherMaster;
use App\Traits\SharedFunctionsTrait;
use App\Traits\SharedOtherOptionFunctionsTrait;
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

    use SharedFunctionsTrait;
    use SharedOtherOptionFunctionsTrait;

    private $cpaymentVoucher,$ledgers,$vouchertype,$masterData,$cpayments,$editValue,$COUNT_cpayments_data,$cpaymntdatas,$cpayment,$vouchermaster,$costcenters;

    public function index()
    {
        $this->cpaymntdatas = AccVoucherMaster::where('entry_by',Auth::user()->id)->where('company_id',Auth::user()->company_id)->where('group_id',Auth::user()->group_id)->where('journal_type','cheque')->orderBy('voucher_no','DESC')->get();
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
        $this->ledgerss = AccLedger::where('status','active')->where('show_in_transaction','1')->whereNotIn('group_id',['1002'])->get();
        $this->costcenters = AccCostCenter::where('status','active')->get();
        $this->cpaymentVoucher = $this->voucherNumberGenerate('5');
        if(Session::get('cpayment_no')>0)
        {
            $this->masterData = AccVoucherMaster::find(Session::get('cpayment_no'));
            $this->cpayments = AccChequePayment::where('cpayment_no', Session::get('cpayment_no'))->get();
            $this->COUNT_cpayments_data = AccChequePayment::where('cpayment_no', Session::get('cpayment_no'))->count();
        }
        return view('modules.accounts.vouchers.chequepayment.create', [
            'cpaymentVoucher' =>$this->cpaymentVoucher,
            'ledgers' => $this->ledgers,
            'ledgerss' => $this->ledgerss,
            'masterData' => $this->masterData,
            'cpayments' => $this->cpayments,
            'COUNT_cpayments_data' => $this->COUNT_cpayments_data,
            'costcenters' =>$this->costcenters,
            'minDatePermission' => $this->sharedFunction(),
            'checkBankBalanceBeforeIssuingAnyCheque' => $this->checkBankBalanceBeforeIssuingAnyCheque()
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
            AccChequePayment::addCPaymentData($request);
            $this->masterData = AccVoucherMaster::find(Session::get('cpayment_no'));
            $this->payments = AccChequePayment::where('cpayment_no', Session::get('cpayment_no'))->get();
            $totalDebit = 0;
            $totalCredit = 0;
            foreach ($this->payments as $payments){
                $totalDebit = $totalDebit + $payments->dr_amt;
                $totalCredit = $totalCredit + $payments->cr_amt;
            }
            if(number_format($totalDebit,2) === number_format($this->masterData->amount,2) && number_format($totalDebit,2) !== number_format($totalCredit,2))
            {
                AccChequePayment::addCPaymentDataCr($request);
                AccVoucherMaster::amountEquality($request);
            }
            return redirect('/accounts/voucher/chequepayment/create')->with('store_message', 'A Cheque payment data successfully added!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->cpayment = AccChequePayment::where('cpayment_no',$id)->get();
        $this->vouchermaster = AccVoucherMaster::find($id);
        return view('modules.accounts.vouchers.chequepayment.show', [
            'cpayments' =>$this->cpayment,
            'vouchermaster' =>$this->vouchermaster,
        ]);
    }

    public function downalodvoucher($id)
    {
        $this->cpayment = AccChequePayment::where('cpayment_no',$id)->get();
        $this->vouchermaster = AccVoucherMaster::find($id);
        $pdf = PDF::loadView('modules.accounts.vouchers.chequepayment.download', [
            'cpayments' =>$this->cpayment,
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
        $this->paymentVoucher = $this->voucherNumberGenerate('5');
        if(Session::get('cpayment_no')>0)
        {
            $this->masterData = AccVoucherMaster::find(Session::get('cpayment_no'));
            $this->cpayments = AccChequePayment::where('cpayment_no', Session::get('cpayment_no'))->get();
            $this->COUNT_cpayments_data = AccChequePayment::where('cpayment_no', Session::get('cpayment_no'))->count();
        }
        if(\request('id')>0)
        {
            $this->editValue = AccChequePayment::find($id);
        }

        return view('modules.accounts.vouchers.chequepayment.create', [
            'cpaymentVoucher' =>$this->cpaymentVoucher,
            'ledgers' => $this->ledgers,
            'ledgerss' => $this->ledgers,
            'masterData' => $this->masterData,
            'cpayments' => $this->cpayments,
            'editValue' => $this->editValue,
            'COUNT_cpayments_data' => $this->COUNT_cpayments_data,
            'costcenters' =>$this->costcenters,
            'minDatePermission' => $this->sharedFunction(),
            'checkBankBalanceBeforeIssuingAnyCheque' => $this->checkBankBalanceBeforeIssuingAnyCheque()
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
        AccChequePayment::updateCPaymentData($request, $id);
        return redirect('/accounts/voucher/chequepayment/create')->with('update_message', 'This data (uid=' . $id . ') has been successfully updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        AccChequePayment::destroyCPaymentData($id);
        AccVoucherMaster::amountEquality($request);
        return redirect('/accounts/voucher/chequepayment/create')->with('destroy_message', 'This data (Uid = ' . $id . ') has been successfully deleted!!');
    }

    public function confirm(Request $request, $id)
    {
        AccChequePayment::confirmCPaymentVoucher($request, $id);
        AccVoucherMaster::amountEquality($request);
        AccVoucherMaster::ConfirmVoucher($request, $id);
        Session::forget('payment_no');
        Session::forget('payment_narration');
        return redirect('/accounts/voucher/chequepayment')->with('store_message','A cheque payment voucher has been successfully created!!');
    }

    public function statusupdate(Request $request, $id)
    {
        AccChequePayment::statusupdate($request, $id);
        AccVoucherMaster::VoucherStatusUpdate($request, $id);
        return redirect('/accounts/voucher/chequepayment')->with('store_message','This cheque payment voucher has been successfully '.$request->status.' !!');
    }
}
