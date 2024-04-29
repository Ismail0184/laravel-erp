<?php

namespace App\Http\Controllers\MIS\PermissionMatrix;

use App\Http\Controllers\Controller;
use App\Models\Developer\Builder\DevCompany;
use App\Models\Developer\Builder\DevGroup;
use App\Models\MIS\PermissionMatrix\warehouse\MisUserPermissionMatrixWarehouse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MISPMWarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('status','active')->whereNotIn('type',['developer'])->get();
        return view('modules.mis.permission-matrix.warehouse.index',compact('users'));
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
        $userWarehousePermissions =MisUserPermissionMatrixWarehouse::where('user_id',$id)->get();
        $groups = DevGroup::where('status','active')->get();
        $companies = DevCompany::where('status','active')->get();

        $warehouses = DB::table('wh_warehouses')->where('status','active')
            ->whereNotIn('warehouse_id', function($query) {
                $query->select('warehouse_id')
                    ->from('mis_user_permission_matrix_warehouses')
                    ->where('user_id',request('id'));})->get();
        return view('modules.mis.permission-matrix.warehouse.create',compact(['userWarehousePermissions','warehouses','userName','userDesignation','userDepartment','groups','companies']));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        MisUserPermissionMatrixWarehouse::storeUserWarehousePermission($request);
        return redirect('/mis/permission-matrix/warehouse/create/'.$request->user_id.'')->with('store_message','This warehouse has been added for the user!!');
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
        MisUserPermissionMatrixWarehouse::updateWarehousePermission($request, $id);
        if($request->status=='active'){
            return redirect('/mis/permission-matrix/warehouse/create/'.$request->user_id.'')->with('permission_active_message','This permission has been Re-activated!!');

        } elseif ($request->status=='inactive') {
            return redirect('/mis/permission-matrix/warehouse/create/'.$request->user_id.'')->with('permission_inactive_message','This permission has been inactivated!!');
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
