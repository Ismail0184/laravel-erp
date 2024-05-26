<?php

namespace App\Models\Accounts\Vouchers;

use App\Models\Accounts\AccLedger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Session;
use Auth;

class AccContra extends Model
{
    use HasFactory;

    public static $contra,$image, $imageName, $directory, $imageUrl;

    public static function getImageUrl($request)
    {
        if (!empty($request->image)) {
            self::$image = $request->file('image');
            self::$imageName = self::$image->getClientOriginalName();
            self::$directory = 'assets/images/vouchers/contra/'.$request->contra_no.'/';
            self::$image->move(self::$directory, self::$imageName);
            return self::$directory . self::$imageName;
        }
    }

    public static function addContraData($request)
    {
        self::$contra = new AccContra();
        self::$contra->contra_no = $request->contra_no;
        self::$contra->contra_date = $request->contra_date;
        self::$contra->narration = $request->narration;
        self::$contra->ledger_id = $request->ledger_id;
        self::$contra->relevant_cash_head = $request->relevant_cash_head;
        self::$contra->contra_attachment = self::getImageUrl($request);
        if($request->dr_amt>0 && $request->cr_amt=='') {
            self::$contra->dr_amt = $request->dr_amt;
            self::$contra->cr_amt = 0;
            self::$contra->type = 'Debit';
        } elseif ($request->cr_amt>0 && $request->dr_amt==''){
            self::$contra->dr_amt = 0;
            self::$contra->cr_amt = $request->cr_amt;
            self::$contra->type = 'Credit';
        }
        self::$contra->status = 'MANUAL';
        self::$contra->entry_by = $request->entry_by;
        self::$contra->company_id = Auth::user()->company_id ?? 0;
        self::$contra->group_id = Auth::user()->group_id ?? 0;
        self::$contra->save();
        Session::put('contra_narration', $request->narration);
    }

    public static function updateContraData($request, $id)
    {
        self::$contra = AccContra::find($id);
        if ($request->file('image'))
        {
            if (file_exists(self::$contra->contra_attachment))
            {
                unlink(self::$contra->contra_attachment);
            }
            self::$imageUrl = self::getImageUrl($request);
        }
        else
        {
            self::$imageUrl = self::$contra->contra_attachment;
        }
        if ($request->file('image')) {
            self::$contra->contra_attachment = self::$imageUrl;
        }

        self::$contra->contra_no = $request->contra_no;
        self::$contra->contra_date = $request->contra_date;
        self::$contra->narration = $request->narration;
        self::$contra->ledger_id = $request->ledger_id;
        self::$contra->relevant_cash_head = $request->relevant_cash_head;
        if($request->dr_amt>0 && $request->cr_amt==0) {
            self::$contra->dr_amt = $request->dr_amt;
            self::$contra->cr_amt = 0;
        } elseif ($request->cr_amt>0 && $request->dr_amt==0){
            self::$contra->dr_amt = 0;
            self::$contra->cr_amt = $request->cr_amt;
        }
        self::$contra->status = 'MANUAL';
        self::$contra->entry_by = $request->entry_by;
        self::$contra->company_id = Auth::user()->company_id ?? 0;
        self::$contra->group_id = Auth::user()->group_id ?? 0;
        self::$contra->save();
    }

    public static function deleteAttachmentWhileEdit($id)
    {
        self::$contra = AccContra::find($id);

        if (file_exists(self::$contra->contra_attachment))
        {
            unlink(self::$contra->contra_attachment);
        }
        AccContra::where('id',$id)->update(['contra_attachment'=>null]);
    }

    public static function destroyContraData($id)
    {
        self::$contra = AccContra::find($id);
        self::$contra->delete();
    }

    public static function destroyContraAllData($id)
    {
        self::$contra = AccContra::where('contra_no', $id);
        $getFileLocation = 'assets/images/vouchers/contra/'.$id;
        if (File::exists($getFileLocation)) {
            File::deleteDirectory($getFileLocation);
        }
        self::$contra->delete();
    }

    public function ledger()
    {
        return $this->belongsTo(AccLedger::class, 'ledger_id','ledger_id');
    }

    public static function confirmContraVoucher($request, $id)
    {
        AccContra::where('contra_no',$id)->update(['status'=>'UNCHECKED']);
    }

    public static function deletedContraVoucher($id)
    {
        AccContra::where('contra_no',$id)->update(['status'=>'DELETED']);
    }

    public static function statusupdate($request, $id)
    {
        AccContra::where('contra_no',$id)->update(['status'=>$request->status]);
    }

    public function ledgerforvoucher()
    {
        return $this->belongsTo(AccLedger::class, 'ledger_id','ledger_id');
    }
}
