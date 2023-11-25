<?php

namespace App\Models\HRM\employee;

use App\Models\HRM\setup\HrmDocumentCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmEmployeeDocumentInfo extends Model
{
    use HasFactory;

    public static $document,$image, $imageName, $directory, $imageUrl;

    public static function getImageUrl($request)
    {
        self::$image        = $request->file('image');
        self::$imageName    = self::$image->getClientOriginalName();
        self::$directory    = 'assets/images/employee/'.$request->category_id.'/';
        self::$image->move(self::$directory, self::$imageName);
        return self::$directory.self::$imageName;
    }

    public static function storeDocumentInfo($request)
    {
        self::$document = new HrmEmployeeDocumentInfo();
        self::$document->employee_id = $request->employee_id;
        self::$document->category_id = $request->category_id;
        self::$document->doc_title = $request->doc_title;
        self::$document->doc_id = $request->doc_id;
        self::$document->doc_file = self::getImageUrl($request);
        self::$document->entry_by = $request->entry_by;
        self::$document->sconid = 1;
        self::$document->pcomid = 1;
        self::$document->save();
    }

    public static function destroyDocumentInfo($id)
    {
        self::$document = HrmEmployeeDocumentInfo::findOrfail($id);
        if (file_exists(self::$document->doc_file))
        {
            unlink(self::$document->doc_file);
        }
        self::$document->delete();
    }

    public function categorys()
    {
        return $this->belongsTo(HrmDocumentCategory::class,'category_id','id');
    }
}
