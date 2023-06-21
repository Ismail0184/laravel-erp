<?php

namespace App\Models\Developer\Reports;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevRepoptGroupLabel extends Model
{
    use HasFactory;

    protected $primaryKey = 'optgroup_label_id';

    public function reports()
    {
        return $this->hasMany(DevReport::class,'optgroup_label_id','optgroup_label_id');
        //return $this->hasMany(DevSubMenu::class, 'main_menu_id', 'main_menu_id')->orderBy('serial');

    }
}
