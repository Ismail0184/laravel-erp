<?php

namespace App\Models\employeeAccess\attendance;

use App\Models\HRM\setup\HrmLeaveType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EaLeaveApplication extends Model
{
    use HasFactory;

    public static $leaveApplication, $image, $imageName, $directory, $imageUrl;

    public static function getImageUrl($request)
    {
        if($request->file('image')) {
            self::$image = $request->file('image');
            self::$imageName = self::$image->getClientOriginalName();
            self::$directory = 'assets/application/leave/';
            self::$image->move(self::$directory, self::$imageName);
            return self::$directory . self::$imageName;
        }
    }

    public static function storeLeaveApplication($request)
    {
        self::$leaveApplication = new EALeaveApplication();
        self::$leaveApplication->employee_id = $request->employee_id;
        self::$leaveApplication->type = $request->type;
        self::$leaveApplication->start_date = $request->start_date;
        self::$leaveApplication->end_date = $request->end_date;
        self::$leaveApplication->total_days = $request->total_days;
        self::$leaveApplication->balance_days = $request->balance_days;
        self::$leaveApplication->reason = $request->reason;
        self::$leaveApplication->responsible_person = $request->responsible_person;
        self::$leaveApplication->leave_address = $request->leave_address;
        self::$leaveApplication->leave_mobile_number = $request->leave_mobile_number;
        self::$leaveApplication->image = self::getImageUrl($request);
        self::$leaveApplication->recommended_by = $request->recommended_by;
        self::$leaveApplication->approved_by = $request->approved_by;
        self::$leaveApplication->year = date('Y');
        self::$leaveApplication->sconid = 1;
        self::$leaveApplication->pcomid = 1;
        self::$leaveApplication->save();
    }

    public static function updateLeaveApplication($request, $id)
    {
        self::$leaveApplication = EALeaveApplication::findOrfail($id);
        if ($request->file('image'))
        {
            if (file_exists(self::$leaveApplication->image))
            { unlink(self::$leaveApplication->image);}
            self::$imageUrl = self::getImageUrl($request);
        } else {
            self::$imageUrl = self::$leaveApplication->image;
        }
        self::$leaveApplication->employee_id = $request->employee_id;
        self::$leaveApplication->type = $request->type;
        self::$leaveApplication->start_date = $request->start_date;
        self::$leaveApplication->end_date = $request->end_date;
        self::$leaveApplication->total_days = $request->total_days;
        self::$leaveApplication->balance_days = $request->balance_days;
        self::$leaveApplication->reason = $request->reason;
        self::$leaveApplication->responsible_person = $request->responsible_person;
        self::$leaveApplication->leave_address = $request->leave_address;
        self::$leaveApplication->leave_mobile_number = $request->leave_mobile_number;
        self::$leaveApplication->image = self::$imageUrl;
        self::$leaveApplication->recommended_by = $request->recommended_by;
        self::$leaveApplication->approved_by = $request->approved_by;
        self::$leaveApplication->status = 'DRAFTED';
        self::$leaveApplication->sconid = 1;
        self::$leaveApplication->pcomid = 1;
        self::$leaveApplication->save();
    }

    public function leaveType()
    {
        return $this->belongsTo(HrmLeaveType::class,'type','id');
    }

    public function AppliedBy()
    {
        return $this->belongsTo(User::class,'employee_id','id');
    }

    public function responsiblePerson()
    {
        return $this->belongsTo(User::class,'responsible_person','id');
    }

    public function RecommendedPerson()
    {
        return $this->belongsTo(User::class,'recommended_by','id');
    }

    public function ApprovedPerson()
    {
        return $this->belongsTo(User::class,'approved_by','id');
    }

    public function GrantPerson()
    {
        return $this->belongsTo(User::class,'granted_by','id');
    }

    public static function sendLeaveApplication($request, $id)
    {
        EALeaveApplication::where('id',$id)->update(
            [
                'status'=>$request->status,
                'sent_at' => now()
            ]);
    }

    public static function destroyLeaveApplication($id)
    {
        EALeaveApplication::where('id',$id)->update(['status'=>'DELETED']);
    }


    public static function responsiblePersonView($id)
    {
        EaLeaveApplication::where('id',$id)->update(
            [
                'responsible_person_viewed_at'=>now()
            ]);
    }
    public static function acceptLeaveApplication($request, $id)
    {
        EALeaveApplication::where('id',$id)->update(
            [
                'responsible_person_acceptance_status'=>'ACCEPTED',
                'remarks_for_responsible_person'=>$request->remarks_for_responsible_person,
                'responsible_person_acceptance_at'=>now()
            ]);
    }

    public static function rejectResLeaveApplication($request, $id)
    {
        EALeaveApplication::where('id',$id)->update(
            [
                'status'=>'REJECTED',
                'recommended_status'=>'REJECTED',
                'remarks_while_recommended'=>$request->remarks_while_recommended,
                'recommended_at'=>now()
            ]);
    }


    public static function recommendPersonView($id)
    {
        EaLeaveApplication::where('id',$id)->update(
            [
                'recommended_viewed_at'=>now()
            ]);
    }
    public static function recommendLeaveApplication($request, $id)
    {
        EALeaveApplication::where('id',$id)->update(
            [
                'status'=>'RECOMMENDED',
                'recommended_status'=>'RECOMMENDED',
                'remarks_while_recommended'=>$request->remarks_while_recommended,
                'recommended_at'=>now()
        ]);
    }

    public static function rejectLeaveApplication($request, $id)
    {
        EALeaveApplication::where('id',$id)->update(
            [
                'status'=>'REJECTED',
                'recommended_status'=>'REJECTED',
                'remarks_while_recommended'=>$request->remarks_while_recommended,
                'recommended_at'=>now()
            ]);
    }



    public static function approvePersonView($id)
    {
        EaLeaveApplication::where('id',$id)->update(
            [
                'approved_viewed_at'=>now()
            ]
        );
    }

    public static function approveLeaveApplication($request, $id)
    {
        EALeaveApplication::where('id',$id)->update(
            [
                'status'=>'APPROVED',
                'approved_status'=>'APPROVED',
                'remarks_while_approved'=>$request->remarks_while_approved,
                'approved_at'=>now()
            ]);
    }

    public static function rejectALeaveApplication($request, $id)
    {
        EALeaveApplication::where('id',$id)->update(
            [
                'status'=>'REJECTED',
                'approved_status'=>'REJECTED',
                'remarks_while_approved'=>$request->remarks_while_approved,
                'approved_at'=>now()
            ]);
    }


    public static function grantedPersonView($id)
    {
        EaLeaveApplication::where('id',$id)->update(
            [
                'granted_viewed_at'=>now()
            ]
        );
    }

    public static function grantedLeaveApplication($request, $id)
    {
        EALeaveApplication::where('id',$id)->update(
            [
                'granted_by'=>$request->entry_by,
                'status'=>'GRANTED',
                'granted_status'=>'GRANTED',
                'remarks_while_granted'=>$request->remarks_while_granted,
                'granted_at'=>now()
            ]);
    }

    public static function rejectGLeaveApplication($request, $id)
    {
        EALeaveApplication::where('id',$id)->update(
            [
                'status'=>'REJECTED',
                'approved_status'=>'REJECTED',
                'remarks_while_approved'=>$request->remarks_while_approved,
                'approved_at'=>now()
            ]);
    }
}
