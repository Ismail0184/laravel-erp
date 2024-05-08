@extends('layouts.app')

@section('title')
    @php($title = 'Cheque Payment Voucher')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Create {{$title}} <small class="text-danger float-right">(field marked with * are mandatory)
                    </small>
                </h4>
                <form style="font-size: 11px" method="POST" action="@if(Session::get('cpayment_no')>0) {{route('acc.voucher.chequepayment.mupdate', ['voucher_no'=>$masterData->voucher_no])}} @else {{route('acc.voucher.chequepayment.initiate')}} @endif">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="entry_at" value="{{date('Y-m-d H:i:s')}}">
                    <input type="hidden" name="journal_type" value="cheque">
                    <input type="hidden" name="voucher_type" value="single">
                    <input type="hidden" name="status" value="MANUAL">
                    <div class="form-group row mb-2">
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Paymt. No <span class="required text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="text" readonly name="voucher_no" @if(Session::get('cpayment_no')>0) value="{{Session::get('cpayment_no')}}" @else value="{{$cpaymentVoucher}}" @endif class="form-control" required />
                        </div>
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Date <span class="required text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="date" name="voucher_date" min="{{ \Carbon\Carbon::now()->subDays($minDatePermission)->format('Y-m-d') }}" max="{{date('Y-m-d')}}" @if(Session::get('cpayment_no')>0) value="{{$masterData->voucher_date}}" @else value="{{date('Y-m-d')}}"  @endif class="form-control" required />
                        </div>
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Person to</label>
                        <div class="col-sm-3">
                            <input type="text" name="person" @if(Session::get('cpayment_no')>0) value="{{$masterData->person}}" @endif class="form-control" />
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Cheque No</label>
                        <div class="col-sm-3">
                            <input type="text" name="cheque_no" @if(Session::get('cpayment_no')>0) value="{{$masterData->cheque_no}}" @endif class="form-control" />
                        </div>
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Chq. Date</label>
                        <div class="col-sm-3">
                            <input type="date" name="cheque_date" @if(Session::get('cpayment_no')>0) value="{{$masterData->cheque_date}}" @endif class="form-control" />
                        </div>
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Maty. Date</label>
                        <div class="col-sm-3">
                            <input type="hidden" name="cheque_of_bank" value="N/A" class="form-control" />
                            <input type="date" name="maturity_date" @if(Session::get('cpayment_no')>0) value="{{$masterData->maturity_date}}" @endif class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Bank <span class="required text-danger">*</span></label>
                        <div @if($checkBankBalanceBeforeIssuingAnyCheque) class="col-sm-4" @else class="col-sm-7" @endif>
                            <select class="form-control select2" style="width: 100%" name="cash_bank_ledger" id="selectedLedgerId" onchange="getLedgerBalance()" required="required">
                                <option value=""> -- select bank account -- </option>
                                @foreach($ledgers as $ledgers)
                                    <option value="{{$ledgers->ledger_id}}" @if(Session::get('cpayment_no')>0) @if($ledgers->ledger_id==$masterData->cash_bank_ledger) selected @endif @endif>{{$ledgers->ledger_id}} : {{$ledgers->ledger_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        @if($checkBankBalanceBeforeIssuingAnyCheque)
                            <div class="col-sm-3">
                                <input type="number" id="totalBalances" name="ledger_balance" @if(Session::get('cpayment_no')>0) value="{{$masterData->ledger_balance}}" @endif class="form-control" readonly placeholder="Bank Balance" min="1"/>
                            </div>
                        @endif

                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Amount<span class="required text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="number" id="inputField" name="amount" @if(Session::get('cpayment_no')>0) value="{{$masterData->amount}}" @endif required class="form-control" step="any" placeholder="Cheque Amount" min="1"/>
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-7">
                            <div>
                                @if(Session::get('cpayment_no'))
                                    <a href="{{route('acc.voucher.chequepayment.cancelall', ['voucher_no' => $masterData->voucher_no, 'journal_type'=>'cheque'])}}" class="btn btn-danger w-md" onclick="return window.confirm('Confirm to cancel?');"> <i class="fa fa-window-close"></i> Cancel</a>
                                @else
                                    <a href="{{route('acc.voucher.chequepayment.view')}}" class="btn btn-danger w-md"> <i class="fa fa-backward"></i> Go back</a>
                                @endif
                                <button type="submit" id="initiateButton" class="btn btn-success w-md">@if(Session::get('cpayment_no')) <i class="fa fa-edit"></i> Update @else <i class="fa fa-save"></i> Initiate & Proceed @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(Session::get('cpayment_no')>0)
        <form style="font-size: 11px" method="POST" action="@if(request('id')>0) {{route('acc.voucher.chequepayment.update', ['id'=>$editValue->id])}} @else {{route('acc.voucher.chequepayment.store')}} @endif">
            @csrf
            @if ($message = Session::get('destroy_message'))
                <p class="text-center text-danger">{{ $message }}</p>
            @elseif( $message = Session::get('store_message'))
                <p class="text-center text-success">{{ $message }}</p>
            @elseif( $message = Session::get('update_message'))
                <p class="text-center text-primary">{{ $message }}</p>
            @endif
            <input type="hidden" name="cpayment_no" value="{{$masterData->voucher_no}}">
            <input type="hidden" name="cpayment_date" value="{{$masterData->voucher_date}}">
            <input type="hidden" name="amount" value="{{$masterData->amount}}">
            <input type="hidden" name="relevant_cash_head" value="{{$masterData->cash_bank_ledger}}">
            <input type="hidden" name="receipt_date" value="{{$masterData->voucher_date}}">
            <input type="hidden" name="entry_by" value="{{$masterData->entry_by}}">
            <table align="center" class="table table-striped table-bordered" style="width:98%; font-size: 11px">
                <thead class="table-success">
                <tr>
                    <th style="text-align: center">Vendor, Payment & Expenses Ledger <span class="required text-danger">*</span></th>
                    <th style="text-align: center; width: 15%">Cost Center <span class="required text-danger">*</span></th>
                    <th style="text-align: center; width: 20%">Narration <span class="required text-danger">*</span></th>
                    <th style="text-align: center;width:15%;">Attachment</th>
                    @if(request('id')>0)
                        <th style="width:15%; text-align:center">Amount (Dr & Cr)</th>
                    @endif
                    <th style="text-align:center;width: 10%">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr style="background-color: white">
                    <td style="vertical-align: middle">
                        <select style="width: 100%" class="form-control select2" name="ledger_id" required="required">
                            <option value=""></option>
                            @foreach($ledgerss as $ledgers)
                                <option value="{{$ledgers->ledger_id}}" @if(request('id')>0) @if($ledgers->ledger_id==$editValue->ledger_id) selected @endif @endif>{{$ledgers->ledger_id}} : {{$ledgers->ledger_name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td style="vertical-align: middle">
                        <select style="width: 100%" class="form-control select2" name="cc_code" required="required">
                            <option value=""></option>
                            @foreach($costcenters as $costCenter)
                                <option value="{{$costCenter->cc_code}}" @if(request('id')>0) @if($costCenter->cc_code==$editValue->cc_code) selected @endif @endif>{{$costCenter->cc_code}} : {{$costCenter->center_name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td style="vertical-align: middle">
                        <textarea  name="narration" style="height: 70px" class="form-control" style="height: 38px">@if(request('id')>0) {{$editValue->narration}} @else {{Session::get('cpayment_narration')}} @endif</textarea>
                    </td>
                    <td style="vertical-align: middle; text-align: right">
                        <input type="file" style="width: 160px"  name="image" />
                        @if(request('id')>0)
                            @if(!empty($editValue->payment_attachment))
                                <br>
                                <a href="{{asset($editValue->payment_attachment)}}" style="text-align: center;" class="btn btn-primary btn-sm" title="delete attachment" target="_blank"><i class="fa fa-book-open"></i></a>
                                <a href="{{route('acc.voucher.payment.deleteAttachmentPaymentVoucher', ['id'=>request('id')])}}" style="text-align: center" class="btn btn-danger btn-sm" title="delete attachment"><i class="fa fa-trash"></i></a>
                            @endif
                        @endif
                    </td>
                    @if(request('id')>0)
                        <td style="vertical-align: middle">
                            <input type="hidden" name="totalPaymentAmount" id="totalPaymentAmount"  class="form-control text-center" value="{{$masterData->amount}}" autocomplete="off" step="any"  />
                            <input type="number" name="dr_amt" id="editDrAmt"  class="form-control text-center" @if(request('id')>0) value="{{$editValue->dr_amt}}" @endif @if($editValue->cr_amt) readonly @endif autocomplete="off" step="any"  />
                            <input type="number" name="cr_amt" id="editCrAmt"  class="form-control mt-1 text-center" @if(request('id')>0) value="{{$editValue->cr_amt}}" @endif @if($editValue->dr_amt) readonly @endif  autocomplete="off" step="any" />
                        </td>
                    @else
                        <td style="vertical-align: middle; display: none">
                            <input type="number" name="dr_amt"  class="form-control" value="{{$masterData->amount}}" autocomplete="off" step="any" min="1" required />
                        </td>
                    @endif
                    <td style="vertical-align: middle; text-align: center">
                        @if(request('id')>0)
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Update</button>
                            <a href="{{route('acc.voucher.chequepayment.create')}}" class="btn btn-danger btn-sm" style="margin-top: 5px"> <i class="fa fa-window-close"></i> Cancel</a>
                        @else
                            <button type="submit" class="btn btn-success"> <i class="fa fa-plus"></i> Add</button>
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
        </form>

        @if($COUNT_cpayments_data > 0)
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;font-size: 11px">
                                <thead class="table-success">
                                <tr>
                                    <th style="width: 5%; text-align: center">#</th>
                                    <th>Account Head</th>
                                    <th>Narration</th>
                                    <th class="text-center">Type</th>
                                    <th>Debit Amount</th>
                                    <th>Credit Amount</th>
                                    <th class="text-center" style="width: 10%">Option</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($totalDebit = 0)
                                @php($totalCredit = 0)
                                @foreach($cpayments as $cpayment)
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle">{{$cpayment->id}}</td>
                                        <td style="vertical-align: middle">{{$cpayment->ledger_id}} : {{$cpayment->ledger->ledger_name}}</td>
                                        <td style="vertical-align: middle">{{$cpayment->narration}}</td>
                                        <td style="vertical-align: middle" class="text-center">{{$cpayment->type}}</td>
                                        <td style="text-align: right; vertical-align: middle">{{number_format($cpayment->dr_amt,2)}}</td>
                                        <td style="text-align: right;vertical-align: middle">{{number_format($cpayment->cr_amt,2)}}</td>
                                        <td class="text-center" style="vertical-align: middle">
                                            <form action="{{route('acc.voucher.chequepayment.destroy', ['id' => $cpayment->id])}}" method="post">
                                                @csrf
                                                <a href="{{route('acc.voucher.chequepayment.edit',['id' => $cpayment->id])}}" title="Update" class="btn btn-success btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you confirm to delete?');">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php($totalDebit = $totalDebit +$cpayment->dr_amt)
                                    @php($totalCredit = $totalCredit +$cpayment->cr_amt)
                                @endforeach
                                <tr>
                                    <th colspan="4" style="text-align: right">Total = </th>
                                    <th style="text-align: right">{{number_format($totalDebit,2)}}</th>
                                    <th style="text-align: right">{{number_format($totalCredit,2)}}</th>
                                    <th></th>
                                </tr>
                                </tbody>
                            </table>
                            <div>
                                <form action="{{route('acc.voucher.chequepayment.cancelall', ['voucher_no' => $masterData->voucher_no])}}" method="post">
                                    @csrf
                                    <input type="hidden" name="journal_type" value="cheque">
                                    <input type="hidden" name="voucher_type" value="single">
                                    <button type="submit" class="btn btn-danger float-left" onclick="return window.confirm('Are you sure you want to Delete the Voucher?');"><i class="fa fa-trash"></i> Cancel & Delete All</button>
                                </form>
                                @if(number_format($totalDebit,2) === number_format($totalCredit,2))
                                    <form action="{{route('acc.voucher.chequepayment.confirm', ['voucher_no' => $masterData->voucher_no])}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-success float-right" onclick="return window.confirm('Are you confirm?');"><i class="fa fa-check-double"></i> Confirm & Finish Voucher</button>
                                    </form>
                                @else
                                    <div class="alert alert-danger float-right col-sm-5" role="alert" style="font-size: 11px">
                                        Invalid Voucher. Debit ({{$totalDebit}}) and Credit ({{$totalCredit}}) amount are not equal !!
                                    </div>
                                @endif
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif @endif

    <script>
        // Get references to the input fields
        const field1 = document.getElementById('inputField');
        const field2 = document.getElementById('totalBalances');
        // Add event listener to field1
        field1.addEventListener('input', function() {
            // Convert field values to numbers
            const value1 = parseFloat(field1.value);
            const value2 = parseFloat(field2.value);
            // Check if field1 value exceeds field2 value
            if (value1 > value2) {
                alert('Oops! Input amount exceeds bank balance. Please reduce the amount and try again. Thank you');
                document.getElementById('inputField').value = '';
            }
        });
    </script>

    <script>
        function getLedgerBalance() {
            const selectedLedgerId = document.getElementById("selectedLedgerId").value;
            $.ajax({
                url: `/accounts/voucher/payment/find-ledger-balance/${selectedLedgerId}`,
                method: 'GET',
                success: function(response) {
                    document.getElementById("totalBalances").value = response.balance;
                    var getBalance =  response.balance;
                    if (getBalance === 0) {
                        document.getElementById('initiateButton').disabled = true;
                    } else {
                        document.getElementById('initiateButton').disabled = false;
                    }
                    document.getElementById('inputField').value = '';
                },
                error: function(error) {
                    console.error("Error fetching category balance:", error);
                }
            });
        }
        getTypeBalance();
    </script>
@endsection
