<?php

namespace App\Http\Controllers\Accounts\Vouchers;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccCostCenter;
use App\Models\Accounts\AccLedger;
use App\Models\Accounts\AccTransactions;
use App\Models\Accounts\Vouchers\AccContra;
use App\Models\Accounts\Vouchers\AccJournal;
use App\Models\Accounts\Vouchers\AccVoucherMaster;
use Illuminate\Http\Request;
use Auth;
use Session;
use PDF;
use App\Traits\SharedFunctionsTrait;
use App\Traits\SharedOtherOptionFunctionsTrait;

class ContraVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use SharedFunctionsTrait;
    use SharedOtherOptionFunctionsTrait;

    private $contraVoucher,$ledgers,$vouchertype,$masterData,$contras,$editValue,$COUNT_contras_data,$contradatas,$contra,$vouchermaster,$costcenters;


    public function index()
    {
        $this->contradatas = AccVoucherMaster::where('journal_type','contra')->where('entry_by',Auth::user()->id)->where('company_id',Auth::user()->company_id)->where('group_id',Auth::user()->group_id)->orderBy('voucher_no','DESC')->get();
        return view('modules.accounts.vouchers.contra.index',
            [
                'contradatas' =>$this->contradatas,
                'checkVoucherEditAccessByCreatedPerson' => $this->checkVoucherEditAccessByCreatedPerson(),
                'deletedVoucherRecoveryAccess' => $this->deletedVoucherRecoveryAccess()

            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->ledgers = AccLedger::where('status','active')->where('show_in_transaction','1')->where('group_id','1002')->get();
        $this->contraVoucher = $this->voucherNumberGenerate('4');
        if(Session::get('contra_no')>0)
        {
            $this->masterData = AccVoucherMaster::find(Session::get('contra_no'));
            $this->contras = AccContra::where('contra_no', Session::get('contra_no'))->get();
            $this->COUNT_contras_data = AccContra::where('contra_no', Session::get('contra_no'))->count();
        }

        return view('modules.accounts.vouchers.contra.create', [
            'contraVoucher' =>$this->contraVoucher,
            'contraFromLedgers' => $this->ledgers,
            'expensesLedgers' => $this->ledgers,
            'masterData' => $this->masterData,
            'contras' => $this->contras,
            'COUNT_contras_data' => $this->COUNT_contras_data,
            'costcenters' =>$this->costcenters,
            'minDatePermission' => $this->sharedFunction(),
            'checkLedgerBalanceBeforeMakingContra' => $this->checkLedgerBalanceBeforeMakingContra()
        ] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AccContra::addContraData($request);
        return redirect('/accounts/voucher/contra/create')->with('store_message', 'A contra data added successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->contra = AccContra::where('contra_no',$id)->get();
        $this->vouchermaster = AccVoucherMaster::findOrfail($id);
        if ($this->vouchermaster->status=='UNCHECKED' && empty($this->vouchermaster->checker_person_viewed_at) && $this->findVoucherCheckOptionAccess()>0)
        {
            AccVoucherMaster::checkPersonView($id);
        }

        if ($this->vouchermaster->status=='CHECKED' && empty($this->vouchermaster->approving_person_viewed_at) && $this->findVoucherApproveOptionAccess()>0)
        {
            AccVoucherMaster::approvePersonView($id);
        }

        if ($this->vouchermaster->status=='APPROVED' && empty($this->vouchermaster->auditing_person_viewed_at) && $this->findVoucherAuditOptionAccess()>0)
        {
            AccVoucherMaster::auditorPersonView($id);
        }

        return view('modules.accounts.vouchers.contra.show', [
            'contras' =>$this->contra,
            'vouchermaster' =>$this->vouchermaster,
            'voucherCheckingPermission' => $this->findVoucherCheckOptionAccess(),
            'voucherApprovingPermission' => $this->findVoucherApproveOptionAccess(),
            'voucherAuditingPermission' => $this->findVoucherAuditOptionAccess()
        ]);
    }

    public function status($id)
    {
        $this->receipt = AccContra::where('contra_no',$id)->get();
        $this->vouchermaster = AccVoucherMaster::findOrfail($id);
        return view('modules.accounts.vouchers.contra.status', [
            'voucherMaster' =>$this->vouchermaster,
            'voucherCheckingPermission' => $this->findVoucherCheckOptionAccess(),
            'voucherApprovingPermission' => $this->findVoucherApproveOptionAccess(),
            'voucherAuditingPermission' => $this->findVoucherAuditOptionAccess()

        ]);
    }

    public function voucherPrint($id)
    {
        $this->contra = AccContra::where('contra_no',$id)->get();
        $this->vouchermaster = AccVoucherMaster::find($id);
        $pdf = PDF::loadView('modules.accounts.vouchers.contra.print', [
            'contras' =>$this->contra,
            'vouchermaster' =>$this->vouchermaster,
        ]);
        return $pdf->stream('contraVoucher_'.$id.'.pdf');
    }

    public function downalodvoucher($id)
    {
        $this->contra = AccContra::where('contra_no',$id)->get();
        $this->vouchermaster = AccVoucherMaster::find($id);
        $pdf = PDF::loadView('modules.accounts.vouchers.contra.download', [
            'contras' =>$this->contra,
            'vouchermaster' =>$this->vouchermaster,
        ]);
        return $pdf->download('contraVoucher_'.$id.'.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->ledgers = AccLedger::where('status','active')->where('show_in_transaction','1')->get();
        $this->contraVoucher = $this->voucherNumberGenerate('4');
        if(Session::get('contra_no')>0)
        {
            $this->masterData = AccVoucherMaster::find(Session::get('contra_no'));
            $this->contras = AccContra::where('contra_no', Session::get('contra_no'))->get();
            $this->COUNT_contras_data = AccContra::where('contra_no', Session::get('contra_no'))->count();
        }
        if(\request('id')>0)
        {
            $this->editValue = AccContra::find($id);
        }

        return view('modules.accounts.vouchers.contra.create', [
            'contraVoucher' =>$this->contraVoucher,
            'contraFromLedgers' => $this->ledgers,
            'expensesLedgers' => $this->ledgers,
            'masterData' => $this->masterData,
            'contras' => $this->contras,
            'editValue' => $this->editValue,
            'COUNT_contras_data' => $this->COUNT_contras_data,
            'costcenters' =>$this->costcenters,
            'minDatePermission' => $this->sharedFunction(),
            'checkLedgerBalanceBeforeMakingContra' => $this->checkLedgerBalanceBeforeMakingContra()
        ] );
    }

    public function deleteAttachmentContraVoucher($id)
    {
        AccContra::deleteAttachmentWhileEdit($id);
        return redirect('/accounts/voucher/contra/edit/'.$id);
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
        AccContra::updateContraData($request, $id);
        return redirect('/accounts/voucher/contra/create')->with('update_message', 'This data (uid=' . $id . ') has been successfully updated!!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        AccContra::destroyContraData($id);
        AccVoucherMaster::amountEquality($request);
        return redirect('/accounts/voucher/contra/create')->with('destroy_message', 'This data (Uid = ' . $id . ') has been successfully deleted!!');
    }

    public function confirm(Request $request, $id)
    {
        $this->next_transaction_id = $this->transactionNumberGenerate();
        $this->contra = AccContra::where('contra_no', Session::get('contra_no'))->get();
        AccTransactions::previousTransactionDeleteWhileEdit($id);
        foreach ($this->contra as $contraData) {
            AccTransactions::addContraVoucher($contraData, $this->next_transaction_id);
        }
        AccContra::confirmContraVoucher($request, $id);
        AccVoucherMaster::ConfirmVoucher($request, $id);
        Session::forget('contra_no');
        Session::forget('contra_narration');
        return redirect('/accounts/voucher/contra')->with('store_message','A contra voucher has been successfully created!!');
    }

    public function statusupdate(Request $request, $id)
    {
        AccContra::statusupdate($request, $id);
        AccVoucherMaster::VoucherStatusUpdate($request, $id);
        return redirect('/accounts/voucher/contra')->with('store_message','This voucher has been successfully '.$request->status.' !!');
    }
}
