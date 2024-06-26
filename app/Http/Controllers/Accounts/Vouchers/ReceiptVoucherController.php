<?php

namespace App\Http\Controllers\Accounts\Vouchers;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccLedger;
use App\Models\Accounts\AccTransactions;
use App\Models\Accounts\Vouchers\AccVoucherMaster;
use App\Models\Accounts\Vouchers\AccReceipt;
use Illuminate\Http\Request;
use Auth;
use Session;
use PDF;
use App\Traits\SharedFunctionsTrait;
use App\Traits\SharedOtherOptionFunctionsTrait;

class ReceiptVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use SharedFunctionsTrait;
    use SharedOtherOptionFunctionsTrait;

    private $receiptVoucher,$ledgers,$vouchertype,$masterData,$receipts,$editValue,$COUNT_receipts_data,$receiptdatas,$receipt,$vouchermaster,$next_transaction_id;

    public function index()
    {
        $this->receiptdatas = AccVoucherMaster::where('journal_type','receipt')->where('entry_by',Auth::user()->id)->where('company_id',Auth::user()->company_id)->where('group_id',Auth::user()->group_id)->orderBy('voucher_no','DESC')->get();
        return view('modules.accounts.vouchers.receipt.index', [
            'receiptdatas' =>$this->receiptdatas,
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
        $receivedFrom = AccLedger::where('status','active')->where('show_in_transaction','1')->whereNotIn('group_id',['1002'])->get();
        $receivedOn = AccLedger::where('status','active')->where('show_in_transaction','1')->where('group_id',['1002'])->get();
        $this->receiptVoucher = $this->voucherNumberGenerate('1');
        if(Session::get('receipt_no')>0)
        {
            AccTransactions::previousTransactionDeleteWhileEdit(Session::get('receipt_no'));
            $this->masterData = AccVoucherMaster::find(Session::get('receipt_no'));
            $this->receipts = AccReceipt::where('receipt_no', Session::get('receipt_no'))->get();
            $this->COUNT_receipts_data = AccReceipt::where('receipt_no', Session::get('receipt_no'))->count();
        }
        return view('modules.accounts.vouchers.receipt.create', [
            'receiptVoucher' =>$this->receiptVoucher,
            'ledgers' => $receivedFrom,
            'ledgerss' => $receivedOn,
            'masterData' => $this->masterData,
            'receipts' => $this->receipts,
            'COUNT_receipts_data' => $this->COUNT_receipts_data,
            'minDatePermission' => $this->sharedFunction()
            ] );
    }

    public function createMultiple()
    {
        $this->ledgers = AccLedger::where('status','active')->where('show_in_transaction','1')->get();
        $this->receiptVoucher = $this->voucherNumberGenerate(1);
        if(Session::get('receipt_no')>0)
        {
            AccTransactions::previousTransactionDeleteWhileEdit(Session::get('receipt_no'));
            $this->masterData = AccVoucherMaster::find(Session::get('receipt_no'));
            $this->receipts = AccReceipt::where('receipt_no', Session::get('receipt_no'))->get();
            $this->COUNT_receipts_data = AccReceipt::where('receipt_no', Session::get('receipt_no'))->count();
        }
        return view('modules.accounts.vouchers.receipt.create-multiple',
            [
                'receiptVoucher' =>$this->receiptVoucher,
                'ledgers' => $this->ledgers,
                'ledgerss' => $this->ledgers,
                'masterData' => $this->masterData,
                'receipts' => $this->receipts,
                'COUNT_receipts_data' => $this->COUNT_receipts_data,
                'minDatePermission' => $this->sharedFunction()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AccReceipt::addReceiptData($request);
        if ($request->voucher_type=='multiple') {

        } else {

        $this->masterData = AccVoucherMaster::find(Session::get('receipt_no'));
        $this->receipts = AccReceipt::where('receipt_no', Session::get('receipt_no'))->get();
        $totalDebit = 0;
        $totalCredit = 0;
        foreach ($this->receipts as $receipts){
            $totalDebit = $totalDebit + $receipts->dr_amt;
            $totalCredit = $totalCredit + $receipts->cr_amt;
        }
        if(number_format($totalDebit,2) === number_format($this->masterData->amount,2) && number_format($totalDebit,2) !== number_format($totalCredit,2))
        {
            AccReceipt::addReceiptDataCr($request);
            AccVoucherMaster::amountEquality($request);
        }}
        if ($request->voucher_type=='multiple') {
            return redirect('/accounts/voucher/receipt/create-multiple')->with('store_message', 'A receipt data successfully added!!');
        } else {
            return redirect('/accounts/voucher/receipt/create')->with('store_message', 'A receipt data successfully added!!');
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
        $this->receipt = AccReceipt::where('receipt_no',$id)->get();
        $this->vouchermaster = AccVoucherMaster::findOrfail($id);

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

        return view('modules.accounts.vouchers.receipt.show', [
            'receipts' =>$this->receipt,
            'vouchermaster' =>$this->vouchermaster,
            'voucherCheckingPermission' => $this->findVoucherCheckOptionAccess(),
            'voucherApprovingPermission' => $this->findVoucherApproveOptionAccess(),
            'voucherAuditingPermission' => $this->findVoucherAuditOptionAccess()

         ]);
    }

    public function status($id)
    {
        $this->receipt = AccReceipt::where('receipt_no',$id)->get();
        $this->vouchermaster = AccVoucherMaster::findOrfail($id);
        return view('modules.accounts.vouchers.receipt.status', [
            'receipts' =>$this->receipt,
            'vouchermaster' =>$this->vouchermaster,
            'voucherCheckingPermission' => $this->findVoucherCheckOptionAccess(),
            'voucherApprovingPermission' => $this->findVoucherApproveOptionAccess(),
            'voucherAuditingPermission' => $this->findVoucherAuditOptionAccess()

        ]);
    }

    public function voucherPrint($id)
    {
        $this->receipt = AccReceipt::where('receipt_no',$id)->get();
        $this->vouchermaster = AccVoucherMaster::findOrfail($id);
        $pdf = PDF::loadView('modules.accounts.vouchers.receipt.download', [
            'receipts' =>$this->receipt,
            'vouchermaster' =>$this->vouchermaster,
        ]);
        return $pdf->stream('receiptVoucher_'.$id.'.pdf');
    }

    public function downalodvoucher($id)
    {
        $this->receipt = AccReceipt::where('receipt_no',$id)->get();
        $this->vouchermaster = AccVoucherMaster::findOrfail($id);
        $pdf = PDF::loadView('modules.accounts.vouchers.receipt.download', [
            'receipts' =>$this->receipt,
            'vouchermaster' =>$this->vouchermaster,
        ]);
        return $pdf->download('receiptVoucher_'.$id.'.pdf');
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
        $this->receiptVoucher = $this->voucherNumberGenerate(1);
        if(Session::get('receipt_no')>0)
        {
            AccVoucherMaster::voucherEdit(Session::get('receipt_no'));
            $this->masterData = AccVoucherMaster::find(Session::get('receipt_no'));
            $this->receipts = AccReceipt::where('receipt_no', Session::get('receipt_no'))->get();
            $this->COUNT_receipts_data = AccReceipt::where('receipt_no', Session::get('receipt_no'))->count();

        }
        if(\request('id')>0)
        {
            $this->editValue = AccReceipt::find($id);
        }
        return view('modules.accounts.vouchers.receipt.create', [
            'receiptVoucher' =>$this->receiptVoucher,
            'ledgers' => $this->ledgers,
            'ledgerss' => $this->ledgers,
            'masterData' => $this->masterData,
            'receipts' => $this->receipts,
            'editValue' => $this->editValue,
            'COUNT_receipts_data' => $this->COUNT_receipts_data,
            'minDatePermission' => $this->sharedFunction()

        ] );
    }

    public function deleteAttachmentReceiptVoucher($id)
    {
        AccReceipt::deleteAttachmentWhileEdit($id);
        if(\request('voucher_type')=='multiple')
        {
            return redirect('/accounts/voucher/receipt/edit-multiple/'.$id);
        } else {
            return redirect('/accounts/voucher/receipt/edit/'.$id);
        }
    }

    public function editMultiple($id)
    {
        $this->ledgers = AccLedger::where('status','active')->where('show_in_transaction','1')->get();
        $this->receiptVoucher = $this->voucherNumberGenerate(1);
        if(Session::get('receipt_no')>0)
        {
            AccVoucherMaster::voucherEdit(Session::get('receipt_no'));
            $this->masterData = AccVoucherMaster::find(Session::get('receipt_no'));
            $this->receipts = AccReceipt::where('receipt_no', Session::get('receipt_no'))->get();
            $this->COUNT_receipts_data = AccReceipt::where('receipt_no', Session::get('receipt_no'))->count();

        }
        if(\request('id')>0)
        {
            $this->editValue = AccReceipt::find($id);
        }
        return view('modules.accounts.vouchers.receipt.create-multiple', [
            'receiptVoucher' =>$this->receiptVoucher,
            'ledgers' => $this->ledgers,
            'ledgerss' => $this->ledgers,
            'masterData' => $this->masterData,
            'receipts' => $this->receipts,
            'editValue' => $this->editValue,
            'COUNT_receipts_data' => $this->COUNT_receipts_data,
            'minDatePermission' => $this->sharedFunction()

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
        AccReceipt::updateReceiptData($request, $id);
        if ($request->voucher_type=='multiple') {
            return redirect('/accounts/voucher/receipt/create-multiple')->with('update_message', 'This data (uid=' . $id . ') has been successfully updated!!');
        } else {
            return redirect('/accounts/voucher/receipt/create')->with('update_message', 'This data (uid=' . $id . ') has been successfully updated!!');
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
        AccReceipt::destroyRceiptData($id);
        AccVoucherMaster::amountEquality($request);
        if ($request->voucher_type=='multiple') {
            return redirect('/accounts/voucher/receipt/create-multiple')->with('destroy_message', 'This data (Uid = ' . $id . ') has been successfully deleted!!');
        } else {
            return redirect('/accounts/voucher/receipt/create')->with('destroy_message', 'This data (Uid = ' . $id . ') has been successfully deleted!!');
        }
    }

    public function confirm(Request $request, $id)
    {
        $this->next_transaction_id = $this->transactionNumberGenerate();
        $this->receipt = AccReceipt::where('receipt_no', Session::get('receipt_no'))->get();
        AccTransactions::previousTransactionDeleteWhileEdit($id);
        foreach ($this->receipt as $receiptData) {
            AccTransactions::addReceiptVoucher($receiptData, $this->next_transaction_id);
        }
        AccReceipt::confirmReceiptVoucher($request, $id);
        AccVoucherMaster::amountEquality($request);
        AccVoucherMaster::ConfirmVoucher($request, $id);
        Session::forget('receipt_no');
        Session::forget('receipt_narration');
        return redirect('/accounts/voucher/receipt')->with('store_message','A receipt voucher has been successfully created!!');
    }

    public function statusupdate(Request $request, $id)
    {
        AccReceipt::statusupdate($request, $id);
        AccVoucherMaster::VoucherStatusUpdate($request, $id);
        return redirect('/accounts/voucher/receipt')->with('store_message','This voucher has been successfully '.$request->status.' !!');
    }
}
