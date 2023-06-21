<?php

namespace App\Http\Controllers\Accounts\Reports;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccLedger;
use App\Models\Accounts\AccLedgerGroup;
use App\Models\Developer\Reports\DevRepoptGroupLabel;
use Illuminate\Http\Request;
use PDF;

class AccReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $ledgerGroups;

    public function index()
    {
        $reportgroups = DevRepoptGroupLabel::where('status','active')->where('module_id',Session('module_id'))->orderBy('serial')->get();
        return view('modules.accounts.reports.index', compact('reportgroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function select()
    {
        $reportgroups = DevRepoptGroupLabel::where('status','active')->where('module_id',Session('module_id'))->orderBy('serial')->get();
        return view('modules.accounts.reports.index', compact('reportgroups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reportview(Request $request,$report_id)
    {
        $this->ledgerGroups = AccLedgerGroup::where('status',1)->orderBy('group_id','ASC')->get();
        $pdf = PDF::loadView('modules.accounts.reports.download', [
            'ledgerGroups'=>$this->ledgerGroups,
            'report_id' =>$report_id
        ]);
        return $pdf->stream('accounts_reportview.pdf');
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
        //
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
