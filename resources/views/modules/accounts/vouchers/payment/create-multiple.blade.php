@extends('layouts.app')

@section('title')
    @php($title = 'Multiple Payment Voucher')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Create {{$title}} <small><a href="{{route('acc.voucher.payment.create')}}">Single Entry</a></small><small class="text-danger float-right">(field marked with * are mandatorys)
                    </small>
                </h4>
                <form style="font-size: 11px" method="POST" action="@if(Session::get('payment_no')>0) {{route('acc.voucher.payment.mupdate', ['voucher_no'=>$masterData->voucher_no])}} @else {{route('acc.voucher.payment.initiate')}} @endif">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="entry_at" value="{{date('Y-m-d H:i:s')}}">
                    <input type="hidden" name="journal_type" value="payment">
                    <input type="hidden" name="voucher_type" value="multiple">
                    <input type="hidden" name="status" value="MANUAL">
                    <div class="form-group row mb-2">
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Paymt. No <span class="required text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="hidden" name="journal_type" value="payment" class="form-control" />
                            <input type="text" readonly name="voucher_no" @if(Session::get('payment_no')>0) value="{{Session::get('payment_no')}}" @else value="{{$paymentVoucher}}" @endif class="form-control" required />
                        </div>
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Date <span class="required text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="date" id="inputDate" oninput="enableInitiateButton()" name="voucher_date" min="{{ \Carbon\Carbon::now()->subDays($minDatePermission)->format('Y-m-d') }}" max="{{date('Y-m-d')}}" @if(Session::get('payment_no')>0) value="{{$masterData->voucher_date}}" @endif class="form-control" required />
                        </div>
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Person from</label>
                        <div class="col-sm-3">
                            <input type="text" name="person" @if(Session::get('payment_no')>0) value="{{$masterData->person}}" @endif class="form-control" />
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">of Bank</label>
                        <div class="col-sm-3">
                            <input type="text" name="cheque_of_bank" @if(Session::get('payment_no')>0) value="{{$masterData->cheque_of_bank}}" @endif class="form-control" />
                        </div>
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Cheque No</label>
                        <div class="col-sm-3">
                            <input type="text" name="cheque_no" @if(Session::get('payment_no')>0) value="{{$masterData->cheque_no}}" @endif class="form-control" />
                        </div>
                        <label for="horizontal-firstname-input" class="col-sm-1 col-form-label">Chq. Date</label>
                        <div class="col-sm-3">
                            <input type="date" name="cheque_date" @if(Session::get('payment_no')>0) value="{{$masterData->cheque_date}}" @endif class="form-control" />
                            <input type="hidden" name="cash_bank_ledger" value="0" class="form-control" />
                            <input type="hidden" name="amount" value="0" class="form-control" />
                        </div>
                    </div>
                    @if($COUNT_payments_data > 0)
                    @else
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-7">
                            <div>
                                @if(Session::get('payment_no'))
                                    <a href="{{route('acc.voucher.payment.cancelall', ['voucher_no' => $masterData->voucher_no, 'journal_type'=>'payment','voucher_type'=>'multiple'])}}" class="btn btn-danger w-md" onclick="return window.confirm('Confirm to cancel?');"> <i class="fa fa-window-close"></i> Cancel</a>
                                @else
                                    <a href="{{route('acc.voucher.payment.view')}}" class="btn btn-danger w-md"> <i class="fa fa-backward"></i> Go back</a>
                                @endif
                                <button type="submit" id="initiateButton" @if(Session::get('payment_no')) @else disabled @endif class="btn btn-success w-md">@if(Session::get('payment_no')) <i class="fa fa-edit"></i> Update @else <i class="fa fa-save"></i> Initiate & Proceed @endif</button>
                            </div>
                        </div>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    @if(Session::get('payment_no')>0)
            @if ($message = Session::get('destroy_message'))
                <p class="text-center text-danger">{{ $message }}</p>
            @elseif( $message = Session::get('store_message'))
                <p class="text-center text-success">{{ $message }}</p>
            @elseif( $message = Session::get('update_message'))
                <p class="text-center text-primary">{{ $message }}</p>
            @endif
            <table align="center" class="table table-striped table-bordered" style="width:98%; font-size: 11px">
                <thead class="table-success">
                <tr>
                    <th style="text-align: center; width: 1%">Type</th>
                    <th style="text-align: center">Accounts Ledger <span class="required text-danger">*</span></th>
                    <th style="text-align: center; width: 15%">Cost Center / Balance <span class="required text-danger">*</span></th>
                    <th style="text-align: center; width: 20%">Narration <span class="required text-danger">*</span></th>
                    <th style="text-align: center;width:15%;">Attachment</th>
                    <th style="width:12%; text-align:center">Amount <span class="required text-danger">*</span></th>
                    <th style="text-align:center;width: 10%">Action</th>
                </tr>
                </thead>
                <tbody>

                <form style="font-size: 11px;" method="POST" action="@if(request('id')>0) {{route('acc.voucher.payment.update', ['id'=>$editValue->id])}} @else {{route('acc.voucher.payment.store')}} @endif" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="payment_no" value="{{$masterData->voucher_no}}">
                    <input type="hidden" name="payment_date" value="{{$masterData->voucher_date}}">
                    <input type="hidden" name="amount" value="{{$masterData->amount}}">
                    <input type="hidden" name="relevant_cash_head" value="{{$masterData->cash_bank_ledger}}">
                    <input type="hidden" name="entry_by" value="{{$masterData->entry_by}}">
                    <input type="hidden" name="voucher_type" value="multiple">
                <tr id="debitInputSection" style="background-color: white; @if(request('id')>0) @if($editValue->type=='Debit') display:''; @else  display:none; @endif @endif">
                    <th style="vertical-align: middle; text-align: center">Debit</th>
                    <td style="vertical-align: middle">
                        <select id="debitInputLedger" oninput="blockCreditInputSection()" class="form-control select2" style="width: 100%" name="ledger_id" required="required">
                            <option value=""></option>
                            @foreach($expensesLedgers as $ledgers)
                                <option value="{{$ledgers->ledger_id}}" @if(request('id')>0) @if($ledgers->ledger_id==$editValue->ledger_id) selected @endif @endif>{{$ledgers->ledger_id}} : {{$ledgers->ledger_name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td style="vertical-align: middle">
                        <select id="inputCostCenter" oninput="blockCreditInputSection()" class="form-control select2" style="width: 100%" name="cc_code" required="required">
                            <option value=""></option>
                            @foreach($costcenters as $costCenter)
                                <option value="{{$costCenter->cc_code}}" @if(request('id')>0) @if($costCenter->cc_code==$editValue->cc_code) selected @endif @endif>{{$costCenter->cc_code}} : {{$costCenter->center_name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td style="vertical-align: middle">
                        <textarea  name="narration" id="inputDebitNarration" oninput="blockCreditInputSection()" class="form-control">@if(request('id')>0) {{$editValue->narration}} @else {{Session::get('payment_narration')}} @endif</textarea>
                    </td>
                    <td style="vertical-align: middle; text-align: right"><input type="file" name="image" style="width: 160px" />
                        @if(request('id')>0)
                            @if(!empty($editValue->payment_attachment))
                                <br>
                                <a href="{{asset($editValue->payment_attachment)}}" style="text-align: center;" class="btn btn-primary btn-sm" title="delete attachment" target="_blank"><i class="fa fa-book-open"></i></a>
                                <a href="{{route('acc.voucher.payment.deleteAttachmentPaymentVoucher', ['id'=>request('id')])}}" style="text-align: center" class="btn btn-danger btn-sm" title="delete attachment"><i class="fa fa-trash"></i></a>
                            @endif
                        @endif
                    </td>
                    <td style="vertical-align: middle">
                        <input type="number" id="inputDebitAmount" oninput="blockCreditInputSection()" name="dr_amt" style="text-align: center" class="form-control" @if(request('id')>0) value="{{$editValue->dr_amt}}" @endif autocomplete="off" step="any" placeholder="debit amt."   />
                    </td>
                    <td style="vertical-align: middle; text-align: center">
                        @if(request('id')>0)
                            <button type="submit" id="debitAddButton" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
                            <a href="{{route('acc.voucher.payment.multiple.create')}}" class="btn btn-danger" style="margin-top: 5px"> <i class="fa fa-window-close"></i> Cancel</a>
                        @else
                            <button type="submit" id="debitAddButton" class="btn btn-success btn-sm" disabled><i class="fa fa-plus"></i> Add</button>
                        @endif
                    </td>
                </tr>
                </form>
                <form style="font-size: 11px" method="POST" action="@if(request('id')>0) {{route('acc.voucher.payment.update', ['id'=>$editValue->id])}} @else {{route('acc.voucher.payment.store')}} @endif" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="payment_no" value="{{$masterData->voucher_no}}">
                    <input type="hidden" name="payment_date" value="{{$masterData->voucher_date}}">
                    <input type="hidden" name="cc_code" value="0">
                    <input type="hidden" name="amount" value="{{$masterData->amount}}">
                    <input type="hidden" name="relevant_cash_head" value="{{$masterData->cash_bank_ledger}}">
                    <input type="hidden" name="entry_by" value="{{$masterData->entry_by}}">
                    <input type="hidden" name="voucher_type" value="multiple">
                <tr id="creditInputSection" style="background-color: white; @if(request('id')>0) @if($editValue->type=='Credit') display:''; @else  display:none; @endif @endif">
                    <th style="vertical-align: middle; text-align: center">Credit</th>
                    <td style="vertical-align: middle">
                        <select class="form-control select2" style="width: 100%" name="ledger_id" id="selectedLedgerId" onchange="getLedgerBalance()" required="required">
                            <option value=""></option>
                            @foreach($paymentFromLedgers as $ledgers)
                                <option value="{{$ledgers->ledger_id}}" @if(request('id')>0) @if($ledgers->ledger_id==$editValue->ledger_id) selected @endif @endif>{{$ledgers->ledger_id}} : {{$ledgers->ledger_name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        @if($checkLedgerBalanceBeforeMakingPayment)
                            <input type="number" id="totalBalances" name="ledger_balance" @if(Session::get('payment_no')>0) value="{{$masterData->ledger_balance}}" @endif class="form-control" readonly placeholder="Ledger Balance" min="1"/>
                        @else
                            N/A
                        @endif
                    </td>
                    <td style="vertical-align: middle">
                        <textarea  name="narration" id="inputNarration" class="form-control" >@if(request('id')>0) {{$editValue->narration}} @else {{Session::get('payment_narration')}} @endif</textarea>
                    </td>
                    <td style="vertical-align: middle; text-align: right"><input type="file" id="inputImage" name="image" style="width: 160px" />
                        @if(request('id')>0)
                            @if(!empty($editValue->payment_attachment))
                                <br>
                                <a href="{{asset($editValue->payment_attachment)}}" style="text-align: center;" class="btn btn-primary btn-sm" title="delete attachment" target="_blank"><i class="fa fa-book-open"></i></a>
                                <a href="{{route('acc.voucher.payment.deleteAttachmentPaymentVoucher', ['id'=>request('id')])}}" style="text-align: center" class="btn btn-danger btn-sm" title="delete attachment"><i class="fa fa-trash"></i></a>
                            @endif
                        @endif
                    </td>
                    <td style="vertical-align: middle">
                        <input type="number" style="margin-top: 5px;text-align: center" name="cr_amt" id="inputField" required  class="form-control" @if(request('id')>0) value="{{$editValue->cr_amt}}" @endif autocomplete="off" step="any" placeholder="credit amt."  />
                    </td>
                    <td style="vertical-align: middle; text-align: center">
                        @if(request('id')>0)
                            <button type="submit" id="creditAddButton" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
                            <a href="{{route('acc.voucher.payment.multiple.create')}}" class="btn btn-danger" style="margin-top: 5px"> <i class="fa fa-window-close"></i> Cancel</a>
                        @else
                            <button type="submit" id="creditAddButton" class="btn btn-success btn-sm" disabled><i class="fa fa-plus"></i> Add</button>
                        @endif
                    </td>
                </tr>
                </form>
                </tbody>
            </table>
        </form>

        @if($COUNT_payments_data > 0)
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
                                    <th class="text-center">Cost Center</th>
                                    <th class="text-center">Attachment</th>
                                    <th class="text-center">Dr Amt</th>
                                    <th class="text-center">Cr Amt</th>
                                    <th class="text-center" style="width: 10%">Option</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($totalDebit = 0)
                                @php($totalCredit = 0)
                                @foreach($payments as $payment)
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle">{{$payment->id}}</td>
                                        <td style="vertical-align: middle">{{$payment->ledger_id}} : {{$payment->ledger->ledger_name}}</td>
                                        <td style="vertical-align: middle">{{$payment->narration}}</td>
                                        <td style="vertical-align: middle" class="text-center">{{$payment->getCostCenterData->center_name}}
                                        <td style="vertical-align: middle" class="text-center">
                                            @if(!empty($payment->payment_attachment))
                                                <a href="{{asset($payment->payment_attachment)}}" target="_blank">View</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td style="text-align: right; vertical-align: middle">{{number_format($payment->dr_amt,2)}}</td>
                                        <td style="text-align: right;vertical-align: middle">{{number_format($payment->cr_amt,2)}}</td>
                                        <td class="text-center" style="vertical-align: middle">
                                            <form action="{{route('acc.voucher.payment.destroy', ['id' => $payment->id])}}" method="post">
                                                @csrf
                                                <input type="hidden" name="voucher_type" value="multiple">
                                                <a href="{{route('acc.voucher.payment.editMultiple',['id' => $payment->id])}}" title="Update" class="btn btn-success btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you confirm to delete?');">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php($totalDebit = $totalDebit +$payment->dr_amt)
                                    @php($totalCredit = $totalCredit +$payment->cr_amt)
                                @endforeach
                                <tr>
                                    <th colspan="5" style="text-align: right">Total = </th>
                                    <th style="text-align: right">{{number_format($totalDebit,2)}}</th>
                                    <th style="text-align: right">{{number_format($totalCredit,2)}}</th>
                                    <th></th>
                                </tr>
                                </tbody>
                            </table>
                            <div>
                                <form action="{{route('acc.voucher.payment.cancelall', ['voucher_no' => $masterData->voucher_no])}}" method="post">
                                    @csrf
                                    <input type="hidden" name="journal_type" value="payment">
                                    <input type="hidden" name="voucher_type" value="multiple">
                                    <button type="submit" class="btn btn-danger float-left" onclick="return window.confirm('Are you sure you want to Delete the Voucher?');">Cancel & Delete All</button>
                                </form>
                                @if(number_format($totalDebit,2) === number_format($totalCredit,2))
                                    <form action="{{route('acc.voucher.payment.confirm', ['voucher_no' => $masterData->voucher_no])}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-success float-right" onclick="return window.confirm('Are you confirm?');">Confirm & Finish Voucher</button>
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
        function enableInitiateButton() {
            var inputDate = document.getElementById("inputDate").value;
            var submitButton = document.getElementById("initiateButton");
            if ((inputDate.trim() ) !== "") {
                submitButton.disabled = false;
            } else {
                submitButton.disabled = true;
            }
        }

        function blockCreditInputSection()
        {
            var debitInputLedger = document.getElementById("debitInputLedger").value;
            var inputCostCenter = document.getElementById("inputCostCenter").value;
            var inputDebitNarration = document.getElementById("inputDebitNarration").value;
            var inputDebitAmount = document.getElementById("inputDebitAmount").value;
            if ((debitInputLedger.trim() ) !== "") {
                document.getElementById('creditInputSection').style.display = 'none';
            } else {
                document.getElementById('creditInputSection').style.display = 'block';
            }
            var submitButton = document.getElementById("debitAddButton");
            if ((debitInputLedger.trim() &&  inputCostCenter.trim() &&  inputDebitNarration.trim() &&  inputDebitAmount.trim()) !== "") {
                submitButton.disabled = false;
            } else {
                submitButton.disabled = true;
            }
        }
    </script>

    <script>
        const field1 = document.getElementById('inputField');
        const field2 = document.getElementById('totalBalances');
        field1.addEventListener('input', function() {
            const value1 = parseFloat(field1.value);
            const value2 = parseFloat(field2.value);
            if (value1 > value2) {
                alert('Oops! Input amount exceeds ledger balance. Please reduce the amount and try again. Thank you');
                document.getElementById('inputField').value = '';
            }
        });
    </script>

    <script>
        const field3 = document.getElementById('editDrAmt');
        const field4 = document.getElementById('totalPaymentAmount');
        field3.addEventListener('input', function() {
            const value1 = parseFloat(field3.value);
            const value2 = parseFloat(field4.value);
            if (value1 > value2) {
                alert('Oops! Input amount exceeds ledger balance. Please reduce the amount and try again. Thank you');
                document.getElementById('editDrAmt').value = '';
            }
        });
    </script>

    <script>
        const field5 = document.getElementById('editCrAmt');
        const field6 = document.getElementById('totalPaymentAmount');
        field5.addEventListener('input', function() {
            const value1 = parseFloat(field5.value);
            const value2 = parseFloat(field6.value);
            if (value1 > value2) {
                alert('Oops! Input amount exceeds ledger balance. Please reduce the amount and try again. Thank you');
                document.getElementById('editCrAmt').value = '';
            }
        });
    </script>

    <script>
        var previousBalance = null;

        function getLedgerBalance() {
            const selectedLedgerId = document.getElementById("selectedLedgerId").value;
            // Store the value of inputField before making the AJAX call
            var inputFieldValue = document.getElementById('inputField').value;
            $.ajax({
                url: `/accounts/voucher/payment/find-ledger-balance/${selectedLedgerId}`,
                method: 'GET',
                success: function(response) {
                    document.getElementById("totalBalances").value = response.balance;
                    var getBalance = response.balance;

                    // Check if the balance has changed
                    if (previousBalance !== null && getBalance !== previousBalance) {
                        // If balance changed after the interval, clear inputField
                        document.getElementById('inputField').value = '';
                    }

                    if (getBalance === 0) {
                        @if($COUNT_payments_data > 0)
                        @else
                        document.getElementById('initiateButton').disabled = true;
                        @endif
                        document.getElementById('inputField').value = '';
                        document.getElementById('inputField').disabled = true;
                        document.getElementById('creditAddButton').disabled = true;
                        @if($COUNT_payments_data > 0)
                        @foreach($payments as $payment)
                        document.getElementById('editButton{{$payment->id}}').style.display = 'none';
                        @endforeach
                        @endif
                        document.getElementById('confirmButton').disabled = true;
                    } else if ((inputField.trim() ) !== "") {
                        document.getElementById('creditAddButton').disabled = false;
                        document.getElementById('inputField').disabled = false;
                    } else {
                        @if($COUNT_payments_data > 0)
                        @else
                        document.getElementById('initiateButton').disabled = false;
                        @endif
                        document.getElementById('inputField').disabled = false;
                        document.getElementById('creditAddButton').disabled = false;
                        @if($COUNT_payments_data > 0)
                        @foreach($payments as $payment)
                        document.getElementById('editButton{{$payment->id}}').style.display = '';
                        @endforeach
                        @endif
                        document.getElementById('confirmButton').disabled = false;
                    }

                    // Update the previous balance
                    previousBalance = getBalance;
                },
                error: function(error) {
                    console.error("Error fetching category balance:", error);
                }
            });

            var selectedLedgerIds = document.getElementById("selectedLedgerId").value;



            if ((selectedLedgerIds.trim() ) !== "") {
                document.getElementById('debitInputSection').style.display = 'none';
            } else {
                document.getElementById('debitInputSection').style.display = '';
            }
        }

        // Call getLedgerBalance initially
        getLedgerBalance();

        // Set interval to call getLedgerBalance every 1 seconds
        setInterval(getLedgerBalance, 1000);

    </script>

@endsection
