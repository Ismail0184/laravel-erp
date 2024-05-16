<?php

namespace App\Models\Accounts\Vouchers;

use App\Models\Accounts\AccLedger;
use Illuminate\Support\Facades\File;
use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;
use Auth;

class AccReceipt extends Model
{
    use HasFactory;

    public static $receipt, $image, $imageName, $directory, $imageUrl;

    public static function getImageUrl($request)
    {
        if (!empty($request->image)) {
            self::$image = $request->file('image');
            self::$imageName = self::$image->getClientOriginalName();
            self::$directory = 'assets/images/vouchers/receipt/'.$request->receipt_no.'/';
            self::$image->move(self::$directory, self::$imageName);
            return self::$directory . self::$imageName;
        }
    }

    public static function addReceiptData($request)
    {
        self::$receipt = new AccReceipt();
        self::$receipt->receipt_no = $request->receipt_no;
        self::$receipt->receipt_date = $request->receipt_date;
        self::$receipt->narration = $request->narration;
        self::$receipt->ledger_id = $request->ledger_id;
        self::$receipt->relevant_cash_head = $request->relevant_cash_head;
        self::$receipt->receipt_attachment = self::getImageUrl($request);
        if (($request->dr_amt>0) && ($request->cr_amt==0) ) {
            self::$receipt->dr_amt = $request->dr_amt;
            self::$receipt->cr_amt = 0;
            self::$receipt->type = 'Debit';
        } elseif (($request->cr_amt>0) && ($request->dr_amt==0)) {
            self::$receipt->dr_amt = 0;
            self::$receipt->cr_amt = $request->cr_amt;
            self::$receipt->type = 'Credit';
        }
        self::$receipt->status = 'MANUAL';
        self::$receipt->entry_by = $request->entry_by;
        self::$receipt->company_id        = Auth::user()->company_id ?? 0;
        self::$receipt->group_id          = Auth::user()->group_id ?? 0;
        self::$receipt->save();
        Session::put('receipt_narration', $request->narration);
    }

    public static function updateReceiptData($request, $id)
    {
        self::$receipt = AccReceipt::find($id);

        if ($request->file('image'))
        {
            if (file_exists(self::$receipt->receipt_attachment))
            {
                unlink(self::$receipt->receipt_attachment);
            }
            self::$imageUrl = self::getImageUrl($request);
        }
        else
        {
            self::$imageUrl = self::$receipt->receipt_attachment;
        }
        if ($request->file('image')) {
            self::$receipt->receipt_attachment = self::$imageUrl;
        }
        self::$receipt->receipt_no = $request->receipt_no;
        self::$receipt->receipt_date = $request->receipt_date;
        self::$receipt->narration = $request->narration;
        self::$receipt->ledger_id = $request->ledger_id;
        self::$receipt->relevant_cash_head = $request->relevant_cash_head;
        if (($request->dr_amt>0) && ($request->cr_amt==0) ) {
            self::$receipt->dr_amt = $request->dr_amt;
            self::$receipt->cr_amt = 0;
            self::$receipt->type = 'Debit';
        } elseif (($request->cr_amt>0) && ($request->dr_amt==0)) {
            self::$receipt->dr_amt = 0;
            self::$receipt->cr_amt = $request->cr_amt;
            self::$receipt->type = 'Credit';
        }
        self::$receipt->status = 'MANUAL';
        self::$receipt->entry_by = $request->entry_by;
        self::$receipt->save();
    }

    public static function deleteAttachmentWhileEdit($id)
    {
        self::$receipt = AccReceipt::find($id);

        if (file_exists(self::$receipt->receipt_attachment))
        {
            unlink(self::$receipt->receipt_attachment);
        }

        AccReceipt::where('id',$id)->update(['receipt_attachment'=>null]);
    }


    public static function addReceiptDataCr($request)
    {
        self::$receipt = new AccReceipt();
        self::$receipt->receipt_no = $request->receipt_no;
        self::$receipt->receipt_date = $request->receipt_date;
        self::$receipt->narration = $request->narration;
        self::$receipt->ledger_id = $request->relevant_cash_head;
        self::$receipt->relevant_cash_head = 0;
        self::$receipt->dr_amt = 0;
        self::$receipt->cr_amt = $request->amount;
        self::$receipt->type = 'Credit';
        self::$receipt->status = 'MANUAL';
        self::$receipt->entry_by = $request->entry_by;
        self::$receipt->company_id        = Auth::user()->company_id ?? 0;
        self::$receipt->group_id          = Auth::user()->group_id ?? 0;
        self::$receipt->save();
    }

    public static function destroyRceiptData($id)
    {
        self::$receipt = AccReceipt::find($id);
        if (file_exists(self::$receipt->receipt_attachment))
        {
            unlink(self::$receipt->receipt_attachment);
        }
        self::$receipt->delete();
    }

    public static function destroyReceiptAllData($id)
    {
        self::$receipt = AccReceipt::where('receipt_no', $id);
        $getFileLocation = 'assets/images/vouchers/receipt/'.$id;
        if (File::exists($getFileLocation)) {
            File::deleteDirectory($getFileLocation);
        }
        self::$receipt->delete();
    }

    public function ledger()
    {
        return $this->belongsTo(AccLedger::class, 'ledger_id','ledger_id');
    }

    public function ledgerforvoucher()
    {
        return $this->belongsTo(AccLedger::class, 'ledger_id','ledger_id');
    }

    public static function confirmReceiptVoucher($request, $id)
    {
        AccReceipt::where('receipt_no',$id)->update(['status'=>'UNCHECKED']);
    }

    public static function deletedReceiptVoucher($id)
    {
        $getFileLocation = 'assets/images/vouchers/receipt/'.$id;
        if (File::exists($getFileLocation)) {
            File::deleteDirectory($getFileLocation);
        }
        AccReceipt::where('receipt_no',$id)->update(['status'=>'DELETED']);
    }

    public static function recoveryDeletedReceiptVoucher($id)
    {
        AccReceipt::where('receipt_no',$id)->update(['status'=>'UNCHECKED']);
    }

    public static function statusupdate($request, $id)
    {
        AccReceipt::where('receipt_no',$id)->update(['status'=>$request->status]);
    }
}
