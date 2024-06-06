<?php

namespace App\Http\Middleware;

use App\Models\Developer\Builder\DevSubMenu;
use App\Models\MIS\PermissionMatrix\subMenu\MisUserPermissionMatrixSubMenu;
use Closure;
use Illuminate\Http\Request;
use Auth;

class CheckSubPageViewAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user()->id;
        $getPageID = DevSubMenu::where('sub_url',$request->route()->getName())->first();
        $subMenuId = $getPageID->sub_menu_id ??  0000000;
        $requiredPermission = MisUserPermissionMatrixSubMenu::where('user_id',$user)->where('sub_menu_id',$subMenuId)->where('status','active')->count();

        if ($requiredPermission==0) {
            return redirect('/no-access'); // or abort(403);
        }

        return $next($request);
    }
}
