<?php

namespace App\Http\Controllers\Accounts\Vouchers;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccTransactions;
use App\Models\Accounts\Vouchers\AccChequePayment;
use App\Models\Accounts\Vouchers\AccContra;
use App\Models\Accounts\Vouchers\AccJournal;
use App\Models\Accounts\Vouchers\AccVoucherMaster;
use App\Models\Accounts\Vouchers\AccPayment;
use App\Models\Accounts\Vouchers\AccReceipt;
use Illuminate\Http\Request;
use Session;

class VoucherMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $initiate;

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->initiate = AccVoucherMaster::initiateVoucher($request);
        if ($request->journal_type=='receipt') {
            if ($request->voucher_type == 'multiple') {
                return redirect('/accounts/voucher/receipt/create-multiple');
            } else {
                return redirect('/accounts/voucher/receipt/create');
            }
        } elseif ($request->journal_type=='payment'){
            if ($request->voucher_type == 'multiple') {
                return redirect('/accounts/voucher/payment/create-multiple');
            } else {
                return redirect('/accounts/voucher/payment/create');
            }
        } elseif ($request->journal_type=='journal'){
            return redirect('/accounts/voucher/journal/create');
        }
        elseif ($request->journal_type=='contra'){
            return redirect('/accounts/voucher/contra/create');
        }
        elseif ($request->journal_type=='cheque'){
            return redirect('/accounts/voucher/chequepayment/create');
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
        AccVoucherMaster::updateVoucher($request, $id);
        if ($request->journal_type=='receipt') {
            if ($request->voucher_type == 'multiple') {
                return redirect('/accounts/voucher/receipt/create-multiple');
            } else {
                return redirect('/accounts/voucher/receipt/create');
            }
        } elseif ($request->journal_type=='payment'){
            if ($request->voucher_type == 'multiple') {
                return redirect('/accounts/voucher/payment/create-multiple');
            } else {
                return redirect('/accounts/voucher/payment/create');
            }
        } elseif ($request->journal_type=='journal'){
            return redirect('/accounts/voucher/journal/create');

        } elseif ($request->journal_type=='cheque'){
            return redirect('/accounts/voucher/chequepayment/create');

        } elseif ($request->journal_type=='contra'){
            return redirect('/accounts/voucher/contra/create');
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
        if ($request->journal_type=='receipt') {
            AccReceipt::destroyReceiptAllData($id);
            AccVoucherMaster::destroyVoucher($id);
            Session::forget('receipt_no');
            Session::forget('receipt_narration');
            if ($request->voucher_type == 'multiple') {
                return redirect('/accounts/voucher/receipt/create-multiple');
            } else {
                return redirect('/accounts/voucher/receipt/create');
            }
        } elseif ($request->journal_type=='payment'){
            AccPayment::destroyPaymentAllData($id);
            AccVoucherMaster::destroyVoucher($id);
            Session::forget('payment_no');
            Session::forget('payment_narration');
            if ($request->voucher_type == 'multiple') {
                return redirect('/accounts/voucher/payment/create-multiple');
            } else {
                return redirect('/accounts/voucher/payment/create');
            }
        } elseif ($request->journal_type=='journal'){
            AccJournal::destroyJournalAllData($id);
            AccVoucherMaster::destroyVoucher($id);
            Session::forget('journal_no');
            Session::forget('journal_narration');

            return redirect('/accounts/voucher/journal/create');
        } elseif ($request->journal_type=='contra'){
            AccContra::destroyContraAllData($id);
            AccVoucherMaster::destroyVoucher($id);
            Session::forget('contra_no');
            Session::forget('contra_narration');
            return redirect('/accounts/voucher/contra/create');
        } elseif ($request->journal_type=='cheque'){
            AccChequePayment::destroyCPaymentAllData($id);
            AccVoucherMaster::destroyVoucher($id);
            Session::forget('cpayment_no');
            Session::forget('cpayment_narration');
            return redirect('/accounts/voucher/chequepayment/create');
        }
    }

    public function deleteFullVoucher(Request $request, $id)
    {
        if ($request->has('recoveryDeletedReceiptVoucher')) {
            AccTransactions::recoveryDeletedTransaction($id);
            AccReceipt::recoveryDeletedReceiptVoucher($id);
            AccVoucherMaster::recoveryDeletedVoucher($id);
            return redirect('/accounts/voucher/receipt')->with('recovery_message', 'This receipt voucher (uid=' . $id . ') has been successfully recovered!!');

        } elseif ($request->has('recoveryDeletedPaymentVoucher')) {
            AccTransactions::recoveryDeletedTransaction($id);
            AccPayment::recoveryDeletedPaymentVoucher($id);
            AccVoucherMaster::recoveryDeletedVoucher($id);
            return redirect('/accounts/voucher/payment')->with('recovery_message','This payment voucher (uid='.$id.') has been successfully recovered!!');

        } elseif ($request->has('recoveryDeletedJournalVoucher')) {

            AccTransactions::recoveryDeletedTransaction($id);
            AccJournal::recoveryDeletedJournalVoucher($id);
            AccVoucherMaster::recoveryDeletedVoucher($id);
            return redirect('/accounts/voucher/journal')->with('recovery_message','This journal voucher (uid='.$id.') has been successfully recovered!!');

        } elseif ($request->has('recoveryDeletedContraVoucher')) {

            AccTransactions::recoveryDeletedTransaction($id);
            AccContra::recoveryDeletedContraVoucher($id);
            AccVoucherMaster::recoveryDeletedVoucher($id);
            return redirect('/accounts/voucher/contra')->with('recovery_message','This contra voucher (uid='.$id.') has been successfully recovered!!');



        } elseif ($request->journal_type=='receipt') {
            AccTransactions::deletedTransaction($id);
            AccReceipt::deletedReceiptVoucher($id);
            AccVoucherMaster::deletedVoucher($id);
            return redirect('/accounts/voucher/receipt')->with('destroy_message','This receipt voucher (uid='.$id.') has been successfully deleted!!');
        } elseif ($request->journal_type=='payment'){
            AccTransactions::deletedTransaction($id);
            AccPayment::deletedPaymentVoucher($id);
            AccVoucherMaster::deletedVoucher($id);
            return redirect('/accounts/voucher/payment')->with('destroy_message','This receipt voucher (uid='.$id.') has been successfully deleted!!');
        } elseif ($request->journal_type=='cheque'){
            AccTransactions::deletedTransaction($id);
            AccChequePayment::deletedCPaymentVoucher($id);
            AccVoucherMaster::deletedVoucher($id);
            return redirect('/accounts/voucher/chequepayment')->with('destroy_message','This cheque payment voucher (uid='.$id.') has been successfully deleted!!');

        } elseif ($request->journal_type=='journal'){
            AccTransactions::deletedTransaction($id);
            AccJournal::deletedJournalVoucher($id);
            AccVoucherMaster::deletedVoucher($id);
            return redirect('/accounts/voucher/journal')->with('destroy_message','This (uid='.$id.') receipt voucher has been successfully deleted!!');
        } elseif ($request->journal_type=='contra'){
            AccTransactions::deletedTransaction($id);
            AccContra::deletedContraVoucher($id);
            AccVoucherMaster::deletedVoucher($id);
            return redirect('/accounts/voucher/contra')->with('destroy_message','This (uid='.$id.') receipt voucher has been successfully deleted!!');
        }
    }
}
