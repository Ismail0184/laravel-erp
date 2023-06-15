<?php

namespace App\Http\Controllers\Accounts\Vouchers;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Vouchers\AccJournalMaster;
use App\Models\Accounts\Vouchers\AccPayment;
use App\Models\Accounts\Vouchers\AccReceipt;
use Illuminate\Http\Request;
use Session;

class JournalMasterController extends Controller
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
        $this->initiate = AccJournalMaster::initiateVoucher($request);
        if ($request->journal_type=='receipt') {
            if ($request->vouchertype == 'multiple') {
                return redirect('/accounts/voucher/receipt/create-multiple');
            } else {
                return redirect('/accounts/voucher/receipt/create');
            }
        } elseif ($request->journal_type=='payment'){
            if ($request->vouchertype == 'multiple') {
                return redirect('/accounts/voucher/payment/create-multiple');
            } else {
                return redirect('/accounts/voucher/payment/create');
            }
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
        AccJournalMaster::updateVoucher($request, $id);
        if ($request->journal_type=='receipt') {
            if ($request->vouchertype == 'multiple') {
                return redirect('/accounts/voucher/receipt/create-multiple');
            } else {
                return redirect('/accounts/voucher/receipt/create');
            }
        } elseif ($request->journal_type=='payment'){
            if ($request->vouchertype == 'multiple') {
                return redirect('/accounts/voucher/payment/create-multiple');
            } else {
                return redirect('/accounts/voucher/payment/create');
            }
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
            AccJournalMaster::destroyVoucher($id);
            Session::forget('receipt_no');
            Session::forget('receipt_narration');
            if ($request->vouchertype == 'multiple') {
                return redirect('/accounts/voucher/receipt/create-multiple');
            } else {
                return redirect('/accounts/voucher/receipt/create');
            }
        } elseif ($request->journal_type=='payment'){
            AccPayment::destroyPaymentAllData($id);
            AccJournalMaster::destroyVoucher($id);
            Session::forget('payment_no');
            Session::forget('payment_narration');
            if ($request->vouchertype == 'multiple') {
                return redirect('/accounts/voucher/payment/create-multiple');
            } else {
                return redirect('/accounts/voucher/payment/create');
            }
        }
    }

    public function deleteFullVoucher(Request $request, $id)
    {
        if ($request->journal_type=='receipt') {
            AccReceipt::deletedReceiptVoucher($id);
            AccJournalMaster::deletedVoucher($id);
            if ($request->vouchertype == 'multiple') {
                return redirect('/accounts/voucher/receipt/create-multiple')->with('destroy_message','This (uid='.$id.') receipt voucher has been successfully deleted!!');
            } else {
                return redirect('/accounts/voucher/receipt/create')->with('destroy_message','This (uid='.$id.') receipt voucher has been successfully deleted!!');
            }
        } elseif ($request->journal_type=='payment'){
            AccPayment::deletedPaymentVoucher($id);
            AccJournalMaster::deletedVoucher($id);
            if ($request->vouchertype == 'multiple') {
                return redirect('/accounts/voucher/payment/create-multiple')->with('destroy_message','This (uid='.$id.') receipt voucher has been successfully deleted!!');
            } else {
                return redirect('/accounts/voucher/payment/create')->with('destroy_message','This (uid='.$id.') receipt voucher has been successfully deleted!!');
            }
        }
    }
}
