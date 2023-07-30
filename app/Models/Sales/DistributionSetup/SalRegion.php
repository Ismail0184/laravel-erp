<?php

namespace App\Models\Sales\DistributionSetup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalRegion extends Model
{
    use HasFactory;
    protected $primaryKey = 'region_id';

    public static $region;

    public static function storeRegion()
    {
        self::$region = new SalRegion();

    }
}
