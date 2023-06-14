<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Receipt Voucher # {{request('voucher_no')}}</title>

    <style>
        .invoice-box {
            max-width: 800px;
            padding: 2px;
            margin-top: -35px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: black;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: middle;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 15px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {

        }

        .topheading {
            margin-top: -40px;
        }
        tr.signature  td
        {
            padding: 0px;
            line-height: 10px;
        }
        tr.signature0  td
        {
            padding: 0px;
            line-height: 15px;
        }
        tr.signature2  td
        {
            padding: 0px;
            line-height: 5px;
        }
        tr.signature3 th
        {
            padding: 0px;
            line-height: 10px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;margin-top: -20px;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
<div class="invoice-box">
    <table style="font-size: 11px">
        <tr class="top">
            <td colspan="5">
                <table>
                    <tr>
                        <td>
                            <h3 style="text-align: center; font-size: 20px">International Consumer Products Bangladesh Ltd.<small style="font-size: 9px; font-weight: normal"><br>
                                    Plot-43, Alam Arcade (4th Floor), Gulshan-2, Dhaka; PS; Dhaka-1212, Bangladesh</small></h3><br/>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td colspan="5">
                <h3 style="text-align: center; font-size: 25px; margin-top: -60px;">RECEIPT VOUCHER</h3>
            </td>
        </tr>

        <tr class="information">
            <td colspan="5">
                <table class="topheading">
                    <tr>
                        <td>
                            <strong>Voucher No :</strong>
                            {{request('voucher_no')}}<br />
                        </td>

                        <td>
                            <strong>Voucher Date:</strong>
                            {{ date($vouchermaster->voucher_date)}}<br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>


        <tr class="heading">
            <td style="width: 2%; text-align: center;vertical-align: middle">#</td>
            <td style="text-align: center; vertical-align: middle">A/C Ledger Head</td>
            <td style="text-align: center; vertical-align: middle">Particulars</td>
            <td style="width: 15%; text-align: center; vertical-align: middle">Debit</td>
            <td style="width: 15%; text-align: center; vertical-align: middle">Credit</td>
        </tr>
        @php($dr_total = 0)
        @php($cr_total = 0)
        @foreach($receipts as $receipt)
        <tr class="item">
            <td style="text-align: center; vertical-align: middle">{{$loop->iteration}}</td>
            <td style="text-align: left; vertical-align: middle">{{$receipt->ledgerforvoucher->ledger_name}}</td>
            <td style="text-align: left; vertical-align: middle">{{$receipt->narration}}</td>
            <td style="text-align: right; vertical-align: middle">{{number_format($receipt->dr_amt,2)}}</td>
            <td style="text-align: right; vertical-align: middle">{{number_format($receipt->cr_amt,2)}}</td>
        </tr>
            @php($dr_total = $dr_total +$receipt->dr_amt )
            @php($cr_total = $cr_total +$receipt->cr_amt )
        @endforeach
        <tr>
            <th colspan="3" style="text-align: right">Total</th>
            <th style="text-align: right">{{number_format($dr_total,2)}}</th>
            <th style="text-align: right">{{number_format($cr_total,2)}}</th>
        </tr>
        <tr>
            <th colspan="5" style="text-align: left">Amount in Word : @numberToWord($dr_total)</th>
        </tr>
    </table>

    <table style="font-size: 11px; margin-top: 20px">
        <tr class="signature">
            <td style="text-align: center; width: 25%">@if($vouchermaster->entry_by>0) {{$vouchermaster->entryBy->name}} @endif</td>
            <td style="text-align: center; width: 25%">@if($vouchermaster->checked_by>0) {{$vouchermaster->checkedBy->name}} @endif</td>
            <td style="text-align: center; width: 25%">@if($vouchermaster->approved_by>0) {{$vouchermaster->approvedBy->name}} @endif</td>
            <td style="text-align: center; width: 25%">@if($vouchermaster->audited_by>0) {{$vouchermaster->auditedBy->name}} @endif</td>
        </tr>
        <tr class="signature0">
            <td style="text-align: center">@if($vouchermaster->entry_by>0) (at: {{$vouchermaster->entry_at}}) @endif</td>
            <td style="text-align: center">@if($vouchermaster->checked_by>0) (at: {{$vouchermaster->checked_at}}) @endif</td>
            <td style="text-align: center">@if($vouchermaster->approved_by>0) (at: {{$vouchermaster->approved_at}}) @endif</td>
            <td style="text-align: center">@if($vouchermaster->audited_by>0) (at: {{$vouchermaster->audited_at}}) @endif</td>
        </tr>

        <tr class="signature2">
            <td style="text-align: center">----------------------------------</td>
            <td style="text-align: center">----------------------------------</td>
            <td style="text-align: center">----------------------------------</td>
            <td style="text-align: center">----------------------------------</td>
        </tr>

        <tr class="signature3">
            <th>Entry By</th>
            <th>Checked By</th>
            <th>Approved By</th>
            <th>Audited By</th>
        </tr>
    </table>
</div>
</body>
</html>
