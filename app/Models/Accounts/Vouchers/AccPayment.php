<?php

namespace App\Models\Accounts\Vouchers;

use App\Models\Accounts\AccCostCenter;
use App\Models\Accounts\AccLedger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Session;

class AccPayment extends Model
{
    use HasFactory;

    public static $payment, $image, $imageName, $directory, $imageUrl;

    public static function getImageUrl($request)
    {
        if (!empty($request->image)) {
            self::$image = $request->file('image');
            self::$imageName = self::$image->getClientOriginalName();
            self::$directory = 'assets/images/vouchers/payment/'.$request->payment_no.'/';
            self::$image->move(self::$directory, self::$imageName);
            return self::$directory . self::$imageName;
        }
    }

    public static function addPaymentData($request)
    {
        self::$payment = new AccPayment();
        self::$payment->balance = $request->balance;
        self::$payment->payment_no = $request->payment_no;
        self::$payment->payment_date = $request->payment_date;
        self::$payment->narration = $request->narration;
        self::$payment->ledger_id = $request->ledger_id;
        self::$payment->relevant_cash_head = $request->relevant_cash_head;
        self::$payment->payment_attachment = self::getImageUrl($request);

        if (($request->dr_amt>0) && ($request->cr_amt==0) ) {
            self::$payment->dr_amt = $request->dr_amt;
            self::$payment->cr_amt = 0;
            self::$payment->type = 'Debit';
        } elseif (($request->cr_amt>0) && ($request->dr_amt==0)) {
            self::$payment->dr_amt = 0;
            self::$payment->cr_amt = $request->cr_amt;
            self::$payment->type = 'Credit';
        }
        self::$payment->cc_code = $request->cc_code;
        self::$payment->status = 'MANUAL';
        self::$payment->entry_by = $request->entry_by;
        self::$payment->company_id = 1;
        self::$payment->group_id = 1;
        if (($request->voucher_type=='multiple') && ($request->cr_amt>0) &&  ($request->dr_amt>0)) {

        } elseif (($request->voucher_type=='multiple') && ($request->cr_amt==0) &&  ($request->dr_amt==0))
        { } else {
            self::$payment->save();
        }
        Session::put('payment_narration', $request->narration);
    }

    public static function deleteAttachmentWhileEdit($id)
    {
        self::$payment = AccPayment::find($id);

        if (file_exists(self::$payment->payment_attachment))
        {
            unlink(self::$payment->payment_attachment);
        }

        AccPayment::where('id',$id)->update(['payment_attachment'=>null]);
    }

    public static function addPaymentDataCr($request)
    {
        self::$payment = new AccPayment();
        self::$payment->payment_no = $request->payment_no;
        self::$payment->payment_date = $request->payment_date;
        self::$payment->narration = $request->narration;
        self::$payment->ledger_id = $request->relevant_cash_head;
        self::$payment->relevant_cash_head = 0;
        self::$payment->dr_amt = 0;
        self::$payment->cr_amt = $request->amount;
        self::$payment->cc_code = 0;
        self::$payment->type = 'Credit';
        self::$payment->status = 'MANUAL';
        self::$payment->entry_by = $request->entry_by;
        self::$payment->company_id = 1;
        self::$payment->group_id = 1;
        self::$payment->save();
    }

    public static function updatePaymentData($request, $id)
    {
        self::$payment = AccPayment::find($id);
        if ($request->file('image'))
        {
            if (file_exists(self::$payment->payment_attachment))
            {
                unlink(self::$payment->payment_attachment);
            }
            self::$imageUrl = self::getImageUrl($request);
        }
        else
        {
            self::$imageUrl = self::$payment->payment_attachment;
        }
        if ($request->file('image')) {
            self::$payment->payment_attachment = self::$imageUrl;
        }
        self::$payment->payment_no = $request->payment_no;
        self::$payment->payment_date = $request->payment_date;
        self::$payment->narration = $request->narration;
        self::$payment->ledger_id = $request->ledger_id;
        self::$payment->relevant_cash_head = $request->relevant_cash_head;
        if (($request->voucher_type=='multiple') && ($request->dr_amt>0) && ($request->cr_amt==0) ) {
            self::$payment->dr_amt = $request->dr_amt;
            self::$payment->cr_amt = 0;
            self::$payment->type = 'Debit';
        } elseif (($request->voucher_type=='multiple') && ($request->cr_amt>0) && ($request->dr_amt==0)) {
            self::$payment->dr_amt = 0;
            self::$payment->cr_amt = $request->cr_amt;
            self::$payment->type = 'Credit';
        } elseif (($request->voucher_type=='multiple') && ($request->cr_amt>0) &&  ($request->dr_amt>0)) {
            self::$payment->dr_amt = 0;
            self::$payment->cr_amt = 0;
        } elseif (($request->voucher_type=='single') && ($request->dr_amt>0) && ($request->cr_amt==0)) {
            self::$payment->dr_amt = $request->dr_amt;
            self::$payment->cr_amt = 0;
            self::$payment->type = 'Debit';
        } elseif (($request->voucher_type=='single') && ($request->cr_amt>0) && ($request->dr_amt==0)) {
            self::$payment->dr_amt = 0;
            self::$payment->cr_amt = $request->cr_amt;;
            self::$payment->type = 'Credit';
        } else {
            self::$payment->dr_amt = 0;
            self::$payment->cr_amt = 0;
        }
        self::$payment->status = 'MANUAL';
        self::$payment->entry_by = $request->entry_by;
        self::$payment->company_id = 1;
        self::$payment->group_id = 1;
        self::$payment->save();
    }

    public static function destroyPaymentData($id)
    {
        self::$payment = AccPayment::find($id);
        if (file_exists(self::$payment->payment_attachment))
        {
            unlink(self::$payment->payment_attachment);
        }
        self::$payment->delete();
    }

    public static function destroyPaymentAllData($id)
    {
        self::$payment = AccPayment::where('payment_no', $id);
        $getFileLocation = 'assets/images/vouchers/payment/'.$id;
        if (File::exists($getFileLocation)) {
            File::deleteDirectory($getFileLocation);
        }
        self::$payment->delete();
    }

    public static function confirmPaymentVoucher($request, $id)
    {
        AccPayment::where('payment_no',$id)->update(['status'=>'UNCHECKED']);
    }

    public function ledgerforvoucher()
    {
        return $this->belongsTo(AccLedger::class, 'ledger_id','ledger_id');
    }

    public function ledger()
    {
        return $this->belongsTo(AccLedger::class, 'ledger_id','ledger_id');
    }

    public static function deletedPaymentVoucher($id)
    {
        $getFileLocation = 'assets/images/vouchers/payment/'.$id;
        if (File::exists($getFileLocation)) {
            File::deleteDirectory($getFileLocation);
        }
        AccPayment::where('payment_no',$id)->update(['status'=>'DELETED']);
    }

    public static function statusupdate($request, $id)
    {
        AccPayment::where('payment_no',$id)->update(['status'=>$request->status]);
    }

    public function getCostCenterData()
    {
        return $this->belongsTo(AccCostCenter::class,'cc_code','cc_code');
    }
}
