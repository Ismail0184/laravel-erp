<?php

namespace App\Models\Accounts\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccProductItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'item_id';

    public static $item;

    public static function storeItem($request)
    {
        self::$item = new AccProductItem();
        self::$item->item_id = $request->item_id;
        self::$item->serial = $request->serial;
        self::$item->custom_id = $request->custom_id;
        self::$item->item_name = $request->item_name;
        self::$item->item_description = $request->item_description;
        self::$item->consumable_type = $request->consumable_type;
        self::$item->product_nature = $request->product_nature;
        self::$item->sub_group_id = $request->sub_group_id;
        self::$item->unit_id = $request->unit_id;
        self::$item->brand_id = $request->brand_id;
        self::$item->pack_unit = $request->pack_unit;
        self::$item->sub_pack_size = $request->sub_pack_size;
        self::$item->pack_size = $request->pack_size;
        self::$item->g_weight = $request->g_weight;
        self::$item->p_price = $request->p_price;
        self::$item->s_price = $request->s_price;
        self::$item->f_price = $request->f_price;
        self::$item->d_price = $request->d_price;
        self::$item->t_price = $request->t_price;
        self::$item->m_price = $request->m_price;
        self::$item->production_cost = $request->production_cost;
        self::$item->material_cost = $request->material_cost;
        self::$item->conversion_cost = $request->conversion_cost;
        self::$item->SD = $request->SD;
        self::$item->SD_percentage = $request->SD_percentage;
        self::$item->VAT = $request->VAT;
        self::$item->VAT_percentage = $request->VAT_percentage;
        self::$item->re_purchase_level = $request->re_purchase_level;
        self::$item->shelf_life = $request->shelf_life;
        self::$item->H_S_code = $request->H_S_code;
        self::$item->status = 'active';
        self::$item->entry_by = $request->entry_by;
        self::$item->sconid = 1;
        self::$item->pcomid = 1;
        self::$item->save();
    }

    public static function updateItem($request, $id)
    {
        self::$item = AccProductItem::find($id);
        self::$item->serial = $request->serial;
        self::$item->custom_id = $request->custom_id;
        self::$item->item_name = $request->item_name;
        self::$item->item_description = $request->item_description;
        self::$item->consumable_type = $request->consumable_type;
        self::$item->product_nature = $request->product_nature;
        self::$item->unit_id = $request->unit_id;
        self::$item->brand_id = $request->brand_id;
        self::$item->pack_unit = $request->pack_unit;
        self::$item->sub_pack_size = $request->sub_pack_size;
        self::$item->pack_size = $request->pack_size;
        self::$item->g_weight = $request->g_weight;
        self::$item->p_price = $request->p_price;
        self::$item->s_price = $request->s_price;
        self::$item->f_price = $request->f_price;
        self::$item->d_price = $request->d_price;
        self::$item->t_price = $request->t_price;
        self::$item->m_price = $request->m_price;
        self::$item->production_cost = $request->production_cost;
        self::$item->material_cost = $request->material_cost;
        self::$item->conversion_cost = $request->conversion_cost;
        self::$item->SD = $request->SD;
        self::$item->SD_percentage = $request->SD_percentage;
        self::$item->VAT = $request->VAT;
        self::$item->VAT_percentage = $request->VAT_percentage;
        self::$item->re_purchase_level = $request->re_purchase_level;
        self::$item->shelf_life = $request->shelf_life;
        self::$item->H_S_code = $request->H_S_code;
        self::$item->status = $request->status;
        self::$item->entry_by = $request->entry_by;
        self::$item->sconid = 1;
        self::$item->pcomid = 1;
        self::$item->save();
    }

    public static function destroyProduct($id)
    {
        self::$item = AccProductItem::find($id);
        self::$item->status = 'deleted';
        self::$item->save();
    }

    public function subGroup()
    {
        return $this->belongsTo(AccProductSubGroup::class,'sub_group_id','sub_group_id');
    }

    public function brand()
    {
        return $this->belongsTo(AccProductBrand::class,'brand_id','brand_id');
    }

    public function unit()
    {
        return $this->belongsTo(AccProductUnit::class,'unit_id','unit_id');
    }

    public function group()
    {
        return $this->hasOneThrough(AccProductGroup::class, AccProductSubGroup::class,'sub_group_id','group_id');
    }
}
