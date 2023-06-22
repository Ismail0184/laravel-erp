<?php

namespace App\Http\Controllers\Accounts\Reports;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccCostCenter;
use App\Models\Accounts\AccLedger;
use App\Models\Accounts\AccLedgerGroup;
use App\Models\Accounts\AccTransactions;
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
        $ledgers = AccLedger::where('status','active')->orderBy('ledger_name','ASC')->get();
        $costcenters = AccCostCenter::where('status','active')->get();
        return view('modules.accounts.reports.index', compact('reportgroups','ledgers','costcenters'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generateReport(Request $request,$report_id)
    {

        $request=$request;
        if(request('report_id')=='1001001') {
            $this->ledgerGroups = AccLedgerGroup::where('status', 1)->orderBy('group_id', 'ASC')->get();
            $pdf = PDF::loadView('modules.accounts.reports.chartofaccounts', [
                'ledgerGroups' => $this->ledgerGroups,
                'report_id' => $report_id
            ]);
            return $pdf->stream('chartofaccounts.pdf');
        }
        elseif (request('report_id')=='1001002')
        {

        }
        elseif (request('report_id')=='1002001')
        {
            $ledger_id = $request->ledger_id;
            $f_date = $request->f_date;
            $t_date = $request->t_date;
            $cc_code = $request->cc_code;
            $status = 'deleted';

            $openingBalance = AccTransactions::where('transaction_date', '<', $request->f_date)->where('ledger_id',$request->ledger_id)
                ->sum('dr_amt')-AccTransactions::where('transaction_date', '<', $request->f_date)->where('ledger_id',$request->ledger_id)
                    ->sum('cr_amt');;

            $query = AccTransactions::query()->orderBy('id','ASC');

            if ($f_date && $t_date) {
                $query->whereBetween('transaction_date', [$f_date,$t_date]);
            }
            if($ledger_id>0)
            {
                $query->where('ledger_id',$ledger_id);
            }
            if($cc_code>0)
            {
                $query->where('cc_code',$cc_code);
            }
            if($status=='deleted')
            {
                $query->whereNotIn('status',['deleted']);
            }
            $transactions = $query->get();
            $ledger_name=AccLedger::find($request->ledger_id);

            $pdf = PDF::loadView('modules.accounts.reports.transactionStatement', compact('transactions','openingBalance','request','ledger_name'));
            return $pdf->stream('transaction_statement.pdf');
        } elseif (request('report_id')=='1004001') {
            $query = AccTransactions::query()->groupBy('ledger_id')->orderBy('ledger_id','ASC')
                ->select('ledger_id')
                ->get();
            $transactions = $query;
            $pdf = PDF::loadView('modules.accounts.reports.trialBalance',compact('transactions','request'));
            return $pdf->stream('trialBalance.pdf');
        }
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
