<?php

namespace App\Models;

use App\Models\Developer\Builder\DevCompany;
use App\Models\HRM\employee\HrmEmployeeJobInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    private static $user;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public static function storeUserWithData($request)
    {
        self::$user = new User();
        self::$user->id = $request->id;
        self::$user->email = $request->email;
        self::$user->name = $request->name;
        self::$user->type = 'employee';
        self::$user->profile_photo_path = $request->profile_photo_path;
        self::$user->password = Hash::make($request->password);
        self::$user->status = 'active';
        self::$user->save();
    }

    public static function getGid($company_id)
    {
        $company = DevCompany::findOrfail($company_id);
        return $company->group_id;
    }

    public static function storeUser($request)
    {
        self::$user = new User();
        self::$user->id = $request->id;
        self::$user->email = $request->email;
        self::$user->name = $request->name;
        self::$user->type = 'user';
        self::$user->profile_photo_path = $request->profile_photo_path;
        self::$user->password = Hash::make($request->password);
        self::$user->status = 'active';
        self::$user->company_id = $request->company_id;
        self::$user->group_id = self::getGid($request->company_id);
        self::$user->save();
    }

    public static function updateUser($request, $id)
    {
        self::$user = User::findOrfail($id);
        self::$user->email = $request->email;
        self::$user->name = $request->name;
        self::$user->type = $request->type;
        self::$user->profile_photo_path = $request->profile_photo_path;
        self::$user->status = $request->status;
        self::$user->company_id = $request->company_id;
        self::$user->group_id = self::getGid($request->group_id);
        self::$user->save();
    }

    public function jobInfoTable()
    {
        return $this->belongsTo(HrmEmployeeJobInfo::class,'id','employee_id');
    }

    public static function setDefaultCompany($request)
    {
        User::where('id',$request->user_id)->update(
            [
                'company_id'=>$request->company_id,
                'group_id' => self::getGid($request->company_id)
            ]);
    }
}
