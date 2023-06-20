<?php

namespace App\Http\Controllers\Accounts\Vouchers;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Vouchers\AccVoucherMaster;
use Illuminate\Http\Request;

class VoucherViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $voucherViews;

    public function index()
    {
        $this->voucherViews = AccVoucherMaster::orderBy('voucher_no','DESC')->get();
        return view('modules.accounts.vouchers.voucherview.index',['voucherViews' =>$this->voucherViews]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filterVoucher(Request $request)
    {
        $f_data = $request->f_date;
        $t_data = $request->t_date;
        $this->voucherViews = AccVoucherMaster::whereBetween('voucher_date',[$f_data,$t_data])->orderBy('voucher_no','DESC')->get();
        return view('modules.accounts.vouchers.voucherview.index',['voucherViews' =>$this->voucherViews]);
        return $f_data;
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
