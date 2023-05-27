<?php

namespace App\Models\Developer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevSubMenu extends Model
{
    use HasFactory;

    public function mainmenuforsubmenu()
    {
        return $this->belongsTo(DevMainMenu::class, 'main_menu_id', 'main_menu_id');
    }
}
