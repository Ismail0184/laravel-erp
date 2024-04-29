<?php

namespace App\Http\Controllers\MIS\PermissionMatrix;

use App\Http\Controllers\Controller;
use App\Models\MIS\PermissionMatrix\module\MisUserPermissionMatrixModule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MISPMModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('status','active')->whereNotIn('type',['developer'])->get();
        return view('modules.mis.permission-matrix.module.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $userNames = User::findOrfail($id);
        $userName = $userNames->name;
        $userDesignation = $userNames->jobInfoTable->getDesignation->designation_name ?? '-';
        $userDepartment = $userNames->jobInfoTable->getDepartment->department_name ?? '-';
        $userModulePermissions =MisUserPermissionMatrixModule::where('user_id',$id)->get();

        $modules = DB::table('dev_modules')->where('status','1')
            ->whereNotIn('module_id', function($query) {
                $query->select('module_id')
                    ->from('mis_user_permission_matrix_modules')
                    ->where('user_id',request('id'));})->get();
        return view('modules.mis.permission-matrix.module.create',compact(['userModulePermissions','modules','userName','userDesignation','userDepartment']));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        MisUserPermissionMatrixModule::storeUserModulePermission($request);
        return redirect('/mis/permission-matrix/module/create/'.$request->user_id.'')->with('store_message','This module has been added!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        MisUserPermissionMatrixModule::updateModulePermission($request, $id);
        if($request->status=='active'){
            return redirect('/mis/permission-matrix/module/create/'.$request->user_id.'')->with('permission_active_message','This permission has been Re-activated!!');
        } elseif ($request->status=='inactive') {
            return redirect('/mis/permission-matrix/module/create/'.$request->user_id.'')->with('permission_inactive_message','This permission has been inactivated!!');
        } else {
            return redirect('/mis/permission-matrix/module/create/'.$request->user_id.'')->with('','');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
