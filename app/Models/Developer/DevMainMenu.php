<?php

namespace App\Models\Developer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevMainMenu extends Model
{
    use HasFactory;

    public function moduleformainmenu()
    {
        return $this->belongsTo(DevModule::class, 'module_id','module_id');
    }
}
