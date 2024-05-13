<?php

namespace App\Http\Controllers\Accounts\Vouchers;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccCostCenter;
use App\Models\Accounts\AccLedger;
use App\Models\Accounts\AccTransactions;
use App\Models\Accounts\Vouchers\AccVoucherMaster;
use App\Models\Accounts\Vouchers\AccPayment;
use App\Traits\SharedOtherOptionFunctionsTrait;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Session;
use Pdf;
use App\Traits\SharedFunctionsTrait;


class PaymentVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use SharedFunctionsTrait;
    use SharedOtherOptionFunctionsTrait;
    private $paymentVoucher,$ledgers,$voucher_type,$masterData,$payments,$editValue,$COUNT_payments_data,$paymntdatas,$payment,$vouchermaster,$costcenters,$next_transaction_id;


    public function index()
    {
        $this->paymntdatas = AccVoucherMaster::where('status','!=','MANUAL')->where('journal_type','payment')->where('entry_by',Auth::user()->id)->orderBy('voucher_no','DESC')->get();
        return view('modules.accounts.vouchers.payment.index', [
            'paymntdatas' =>$this->paymntdatas,
            'checkVoucherEditAccessByCreatedPerson' => $this->checkVoucherEditAccessByCreatedPerson()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paymentFrom = AccLedger::where('status','active')->where('show_in_transaction','1')->where('group_id',['1002'])->get();
        $paymentOn = AccLedger::where('status','active')->where('show_in_transaction','1')->whereNotIn('group_id',['1002'])->get();
        $this->costcenters = AccCostCenter::where('status','active')->get();
        $this->voucher_type ='2';
        $this->paymentVoucher = Auth::user()->id.$this->voucher_type.date('YmdHis');
        if(Session::get('payment_no')>0)
        {
            $this->masterData = AccVoucherMaster::find(Session::get('payment_no'));
            $this->payments = AccPayment::where('payment_no', Session::get('payment_no'))->get();
            $this->COUNT_payments_data = AccPayment::where('payment_no', Session::get('payment_no'))->count();
        }

        return view('modules.accounts.vouchers.payment.create', [
            'paymentVoucher' =>$this->paymentVoucher,
            'ledgers' => $paymentFrom,
            'ledgerss' => $paymentOn,
            'masterData' => $this->masterData,
            'payments' => $this->payments,
            'COUNT_payments_data' => $this->COUNT_payments_data,
            'costcenters' =>$this->costcenters,
            'minDatePermission' => $this->sharedFunction(),
            'checkLedgerBalanceBeforeMakingPayment' => $this->checkLedgerBalanceBeforeMakingPayment()
        ] );
    }


    public function createMultiple()
    {
        $this->costcenters = AccCostCenter::where('status','active')->get();
        $paymentFrom = AccLedger::where('status','active')->where('show_in_transaction','1')->where('group_id',['1002'])->get();
        $paymentOn = AccLedger::where('status','active')->where('show_in_transaction','1')->whereNotIn('group_id',['1002'])->get();

        $this->voucher_type ='2';
        $this->paymentVoucher = Auth::user()->id.$this->voucher_type.date('YmdHis');
        if(Session::get('payment_no')>0)
        {
            $this->masterData = AccVoucherMaster::find(Session::get('payment_no'));
            $this->payments = AccPayment::where('payment_no', Session::get('payment_no'))->get();
            $this->COUNT_payments_data = AccPayment::where('payment_no', Session::get('payment_no'))->count();
        }

        return view('modules.accounts.vouchers.payment.create-multiple', [
            'paymentVoucher' =>$this->paymentVoucher,
            'expensesLedgers' => $paymentOn,
            'paymentFromLedgers' => $paymentFrom,
            'ledgerss' => $this->ledgers,
            'masterData' => $this->masterData,
            'payments' => $this->payments,
            'COUNT_payments_data' => $this->COUNT_payments_data,
            'costcenters' =>$this->costcenters,
            'minDatePermission' => $this->sharedFunction(),
            'checkLedgerBalanceBeforeMakingPayment' => $this->checkLedgerBalanceBeforeMakingPayment()

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
        if ($request->voucher_type=='multiple') {
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
                AccVoucherMaster::amountEquality($request);
            }}
        if ($request->voucher_type=='multiple') {
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

        if ($this->vouchermaster->status=='UNCHECKED' && empty($this->vouchermaster->checker_person_viewed_at) && $this->findVoucherCheckOptionAccess()>0)
        {
            AccVoucherMaster::checkPersonView($id);
        }

        if ($this->vouchermaster->status=='CHECKED' && empty($this->vouchermaster->approving_person_viewed_at) && $this->findVoucherApproveOptionAccess()>0)
        {
            AccVoucherMaster::approvePersonView($id);
        }

        if ($this->vouchermaster->status=='APPROVED' && empty($this->vouchermaster->auditing_person_viewed_at) && $this->findVoucherAuditOptionAccess()>0)
        {
            AccVoucherMaster::auditorPersonView($id);
        }

        return view('modules.accounts.vouchers.payment.show', [
            'payments' =>$this->payment,
            'vouchermaster' =>$this->vouchermaster,
            'voucherCheckingPermission' => $this->findVoucherCheckOptionAccess(),
            'voucherApprovingPermission' => $this->findVoucherApproveOptionAccess(),
            'voucherAuditingPermission' => $this->findVoucherAuditOptionAccess()
        ]);
    }

    public function status($id)
    {
        $this->receipt = AccPayment::where('payment_no',$id)->get();
        $this->vouchermaster = AccVoucherMaster::findOrfail($id);
        return view('modules.accounts.vouchers.payment.status', [
            'voucherMaster' =>$this->vouchermaster,
            'voucherCheckingPermission' => $this->findVoucherCheckOptionAccess(),
            'voucherApprovingPermission' => $this->findVoucherApproveOptionAccess(),
            'voucherAuditingPermission' => $this->findVoucherAuditOptionAccess()

        ]);
    }

    public function voucherPrint($id)
    {
        $this->payment = AccPayment::where('payment_no',$id)->get();
        $this->vouchermaster = AccVoucherMaster::find($id);
        $pdf = PDF::loadView('modules.accounts.vouchers.payment.download', [
            'payments' =>$this->payment,
            'vouchermaster' =>$this->vouchermaster,
        ]);
        return $pdf->stream('paymentVoucher_'.$id.'.pdf');
    }

    public function downalodvoucher($id)
    {
        $this->payment = AccPayment::where('payment_no',$id)->get();
        $this->vouchermaster = AccVoucherMaster::find($id);
        $pdf = PDF::loadView('modules.accounts.vouchers.payment.download', [
            'payments' =>$this->payment,
            'vouchermaster' =>$this->vouchermaster,
        ]);
        return $pdf->download('paymentVoucher_'.$id.'.pdf');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paymentFrom = AccLedger::where('status','active')->where('show_in_transaction','1')->where('group_id',['1002'])->get();
        $paymentOn = AccLedger::where('status','active')->where('show_in_transaction','1')->whereNotIn('group_id',['1002'])->get();
        $this->costcenters = AccCostCenter::where('status','active')->get();
        $this->voucher_type ='2';
        $this->paymentVoucher = Auth::user()->id.$this->voucher_type.date('YmdHis');
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
            'ledgers' => $paymentFrom,
            'ledgerss' => $paymentOn,
            'masterData' => $this->masterData,
            'payments' => $this->payments,
            'editValue' => $this->editValue,
            'COUNT_payments_data' => $this->COUNT_payments_data,
            'costcenters' =>$this->costcenters,
            'minDatePermission' => $this->sharedFunction(),
            'checkLedgerBalanceBeforeMakingPayment' => $this->checkLedgerBalanceBeforeMakingPayment()
        ] );
    }

    public function deleteAttachmentPaymentVoucher($id)
    {
        AccPayment::deleteAttachmentWhileEdit($id);
        if(\request('voucher_type')=='multiple')
        {
            return redirect('/accounts/voucher/payment/edit-multiple/'.$id);
        } else {
            return redirect('/accounts/voucher/payment/edit/'.$id);
        }
    }

    public function editMultiple($id)
    {
        $paymentFrom = AccLedger::where('status','active')->where('show_in_transaction','1')->where('group_id',['1002'])->get();
        $paymentOn = AccLedger::where('status','active')->where('show_in_transaction','1')->whereNotIn('group_id',['1002'])->get();
        $this->costcenters = AccCostCenter::where('status','active')->get();
        $this->voucher_type ='2';
        $this->paymentVoucher = Auth::user()->id.$this->voucher_type.date('YmdHis');
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

        return view('modules.accounts.vouchers.payment.create-multiple', [
            'paymentVoucher' =>$this->paymentVoucher,
            'expensesLedgers' => $paymentOn,
            'paymentFromLedgers' => $paymentFrom,
            'masterData' => $this->masterData,
            'payments' => $this->payments,
            'editValue' => $this->editValue,
            'COUNT_payments_data' => $this->COUNT_payments_data,
            'costcenters' =>$this->costcenters,
            'minDatePermission' => $this->sharedFunction(),
            'checkLedgerBalanceBeforeMakingPayment' => $this->checkLedgerBalanceBeforeMakingPayment()
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
        if ($request->voucher_type=='multiple') {
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
        AccVoucherMaster::amountEquality($request);
        if ($request->voucher_type=='multiple') {
            return redirect('/accounts/voucher/payment/create-multiple')->with('destroy_message', 'This data (Uid = ' . $id . ') has been successfully deleted!!');
        } else {
            return redirect('/accounts/voucher/payment/create')->with('destroy_message', 'This data (Uid = ' . $id . ') has been successfully deleted!!');
        }
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
        $this->receipt = AccPayment::where('payment_no', Session::get('payment_no'))->get();
        AccTransactions::previousTransactionDeleteWhileEdit($id);
        foreach ($this->receipt as $receiptData) {
            AccTransactions::addPaymentVoucher($receiptData, $this->next_transaction_id);
        }
        AccPayment::confirmPaymentVoucher($request, $id);
        AccVoucherMaster::ConfirmVoucher($request, $id);
        Session::forget('payment_no');
        Session::forget('payment_narration');
        return redirect('/accounts/voucher/payment')->with('store_message','A payment voucher has been successfully created!!');
    }

    public function statusupdate(Request $request, $id)
    {
        AccPayment::statusupdate($request, $id);
        AccVoucherMaster::VoucherStatusUpdate($request, $id);
        return redirect('/accounts/voucher/payment')->with('store_message','This voucher has been successfully '.$request->status.' !!');
    }


    public function findLedgerBalance($id)
    {
        $paymentManualData = AccPayment::where('ledger_id',$id)->where('status',['MANUAL'])->sum(DB::raw('cr_amt'));
        $queryForLedgerBalance = AccTransactions::where('ledger_id',$id)->whereNotIn('status',['MANUAL','DELETED'])->sum(DB::raw('dr_amt - cr_amt'));
        $actualLedgerBalance = $queryForLedgerBalance - $paymentManualData;
        return response()->json(['balance' => $actualLedgerBalance]);
    }

    public function findLedgerBalanceWithoutManualData($id)
    {
        $queryForLedgerBalance = AccTransactions::where('ledger_id',$id)->whereNotIn('status',['MANUAL','DELETED'])->sum(DB::raw('dr_amt - cr_amt'));
        $actualLedgerBalance = $queryForLedgerBalance;
        return response()->json(['balance' => $actualLedgerBalance]);
    }
}
