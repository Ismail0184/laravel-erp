<?php

namespace App\Http\Controllers\MIS\PermissionMatrix;

use App\Http\Controllers\Controller;
use App\Models\Developer\DevCompany;
use App\Models\MIS\PermissionMatrix\company\MisUserPermissionMatrixCompany;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MISPMCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('status','active')->whereNotIn('type',['developer'])->get();
        return view('modules.mis.permission-matrix.company.index',compact('users'));
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
        $userCompanyPermissions =MisUserPermissionMatrixCompany::where('user_id',$id)->get();

        $companies = DB::table('dev_companies')->where('status','active')
            ->whereNotIn('id', function($query) {
                $query->select('company_id')
                    ->from('mis_user_permission_matrix_companies')
                    ->where('user_id',request('id'));})->get();
        return view('modules.mis.permission-matrix.company.create',compact(['userCompanyPermissions','companies','userName','userDesignation','userDepartment']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        MisUserPermissionMatrixCompany::storeUserCompanyPermission($request);
        return redirect('/mis/permission-matrix/company/create/'.$request->user_id.'')->with('store_message','A new company has been added to this user!!');
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
        MisUserPermissionMatrixCompany::updateCompanyPermission($request, $id);
        if($request->status=='active'){
            return redirect('/mis/permission-matrix/company/create/'.$request->user_id.'')->with('permission_active_message','This permission has been Re-activated!!');
        } elseif ($request->status=='inactive') {
            return redirect('/mis/permission-matrix/company/create/'.$request->user_id.'')->with('permission_inactive_message','This permission has been inactivated!!');
        } else {
            return redirect('/mis/permission-matrix/company/create/'.$request->user_id.'')->with('','');
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
