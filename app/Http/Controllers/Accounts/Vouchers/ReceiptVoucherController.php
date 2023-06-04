<?php

namespace App\Http\Controllers\Accounts\Vouchers;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccLedger;
use App\Models\Accounts\Vouchers\AccJournalMaster;
use App\Models\Accounts\Vouchers\AccReceipt;
use Illuminate\Http\Request;
use Auth;
use Session;
class ReceiptVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $receiptVoucher,$ledgers,$vouchertype,$masterData,$receipts,$editValue,$COUNT_receipts_data;

    public function index()
    {
        return view('modules.accounts.vouchers.receipt.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->ledgers = AccLedger::all();
        $this->vouchertype ='1';
        $this->receiptVoucher = Auth::user()->id.$this->vouchertype.date('YmdHis');
        if(Session::get('receipt_no')>0)
        {
            $this->masterData = AccJournalMaster::find(Session::get('receipt_no'));
            $this->receipts = AccReceipt::where('receipt_no', Session::get('receipt_no'))->get();
            $this->COUNT_receipts_data = AccReceipt::where('receipt_no', Session::get('receipt_no'))->count();
        }
        return view('modules.accounts.vouchers.receipt.create', [
            'receiptVoucher' =>$this->receiptVoucher,
            'ledgers' => $this->ledgers,
            'ledgerss' => $this->ledgers,
            'masterData' => $this->masterData,
            'receipts' => $this->receipts,
            'COUNT_receipts_data' => $this->COUNT_receipts_data
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
        AccReceipt::addReceiptData($request);
        $this->masterData = AccJournalMaster::find(Session::get('receipt_no'));
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
        }
        return redirect('/accounts/voucher/receipt/create')->with('store_message','A receipt data successfully added!!');
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
        $this->ledgers = AccLedger::all();
        $this->vouchertype ='1';
        $this->receiptVoucher = Auth::user()->id.$this->vouchertype.date('YmdHis');
        if(Session::get('receipt_no')>0)
        {
            $this->masterData = AccJournalMaster::find(Session::get('receipt_no'));
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
            'COUNT_receipts_data' => $this->COUNT_receipts_data

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
        return redirect('/accounts/voucher/receipt/create')->with('update_message','This data (uid='.$id.') successfully updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AccReceipt::destroyRceiptData($id);
        return redirect('/accounts/voucher/receipt/create')->with('destroy_message','This data (Uid = '.$id.') has been successfully deleted!!');
    }
}
