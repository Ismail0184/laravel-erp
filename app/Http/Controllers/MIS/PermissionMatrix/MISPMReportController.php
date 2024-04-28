<?php

namespace App\Http\Controllers\MIS\PermissionMatrix;

use App\Http\Controllers\Controller;
use App\Models\Developer\Reports\DevRepoptGroupLabel;
use App\Models\MIS\PermissionMatrix\company\MisUserPermissionMatrixCompany;
use App\Models\MIS\PermissionMatrix\module\MisUserPermissionMatrixModule;
use App\Models\MIS\PermissionMatrix\report\MisUserPermissionMatrixReport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MISPMReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('status','active')->whereNotIn('type',['developer'])->get();
        return view('modules.mis.permission-matrix.report.index',compact('users'));
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
        $userReportPermissions =MisUserPermissionMatrixReport::where('user_id',$id)->get();
        $companies = MisUserPermissionMatrixCompany::where('status','active')->where('user_id',$id)->get();
        $modules = MisUserPermissionMatrixModule::where('status','active')->get();
        $reportGroups = DevRepoptGroupLabel::where('status','active')->orderBy('id','asc')->get();

        $reports = DB::table('dev_reports')->where('status','active')
            ->whereNotIn('report_id', function($query) {
                $query->select('report_id')
                    ->from('mis_user_permission_matrix_reports')
                    ->where('user_id',request('id'));})->get();
        return view('modules.mis.permission-matrix.report.create',compact(['userReportPermissions','reports','userName','userDesignation','userDepartment','modules','companies','reportGroups']));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        MisUserPermissionMatrixReport::storeUserReportPermission($request);
        return redirect('/mis/permission-matrix/reports/create/'.$request->user_id.'')->with('store_message','Repors have been added for the user!!');
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
        MisUserPermissionMatrixReport::updateReportPermission($request, $id);
        if($request->status=='active'){
            return redirect('/mis/permission-matrix/reports/create/'.$request->user_id.'')->with('permission_active_message','This permission has been Re-activated!!');

        } elseif ($request->status=='inactive') {
            return redirect('/mis/permission-matrix/reports/create/'.$request->user_id.'')->with('permission_inactive_message','This permission has been inactivated!!');
        } else {
            return $request->status;
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
