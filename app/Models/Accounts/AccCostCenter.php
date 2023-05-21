<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccCostCenter extends Model
{
    use HasFactory;
    protected $primaryKey = 'cc_code';

    public static $costcenter;

    public static function storeCostCenter($request)
    {
        self::$costcenter = new AccCostCenter();
        self::$costcenter->center_name = $request->center_name;
        self::$costcenter->category_id = $request->category_id;
        self::$costcenter->status = 1;
        self::$costcenter->sconid = '1';
        self::$costcenter->pcomid = '1';
        self::$costcenter->entry_by = $request->entry_by;
        self::$costcenter->save();
    }
}
