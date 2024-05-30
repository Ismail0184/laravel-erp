<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>{{$ledger_name->ledger_name}} :: Transaction Statement</title>

    <style>
        .invoice-box {
            max-width: 800px;
            padding: 2px;
            margin-top: -35px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;

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
            line-height: 24px;
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

        .footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 1.5cm;
            text-align: center;
            border-top: 1px solid #ccc;
        }
        .footer .article p {
            font-size: 9px;
            display: inline-block;
            color:#707070;
        }
    </style>
</head>

<body>
<div class="invoice-box">
    <h3 style="text-align: center; font-size: 20px">{{ Auth::user()->getCompanyInfo->company_name }}
        <small style="font-size: 9px; font-weight: normal"><br>
            {{ Auth::user()->getCompanyInfo->address }}
        </small>
    </h3>
    <h3 style="text-align: center; font-size: 15px; margin-top: -10px">Transaction Statement</h3>
    <p style="text-align: center; font-size: 10px; ">@if(request('ledger_id')>0)Ledger Name: {{$ledger_name->ledger_id}} : {{$ledger_name->ledger_name}} @else All Transactions @endif </p>
    <p style="text-align: center; font-size: 10px;">Date Interval {{$request->f_date}} to {{$request->t_date}}</p>
    <table style="font-size: 11px">
        <thead>
        <tr class="heading">
            <td style="width: 2%; text-align: center;vertical-align: middle">#</td>
            <td style="width: 10%; text-align: center;vertical-align: middle">Date</td>
            <td style="width: 10%; text-align: center;vertical-align: middle">Voucher No</td>
            <td style="text-align: center; vertical-align: middle">Particulars</td>
            <td style="width: 5%; text-align: center; vertical-align: middle">Source</td>
            <td style="width: 15%; text-align: center; vertical-align: middle">Debit</td>
            <td style="width: 15%; text-align: center; vertical-align: middle">Credit</td>
            <td style="width: 15%; text-align: center; vertical-align: middle">Balance</td>
        </tr>
        </thead>
        <tr class="item">
            <td colspan="7">Opening Balance</td>
            <td style="text-align: right; vertical-align: middle">@if($openingBalance>0) (Dr) {{number_format($openingBalance,2)}} @elseif ($openingBalance<0) (Cr) {{number_format(substr($openingBalance,1),2)}}@else {{number_format(0,2)}} @endif</td>
        </tr>
        @php($total_dr_amount=0)
        @php($total_cr_amount=0)
        @foreach($transactions as $transaction)
            <tr class="item">
                <td style="text-align: center; vertical-align: middle">{{$loop->iteration}}</td>
                <td style="text-align: center; vertical-align: middle">{{$transaction->transaction_date}}</td>
                <td style="text-align: center; vertical-align: middle">{{$transaction->transaction_no}}</td>
                <td style="text-align: left; vertical-align: middle">{{$transaction->narration}}</td>
                <td style="text-align: center; vertical-align: middle">{{$transaction->vr_from}}</td>
                <td style="text-align: right; vertical-align: middle">{{number_format($transaction->dr_amt,2)}}</td>
                <td style="text-align: right; vertical-align: middle">{{number_format($transaction->cr_amt,2)}}</td>
                <td style="text-align: right; vertical-align: middle">@php($openingBalance=$openingBalance+($transaction->dr_amt-$transaction->cr_amt))
                    @if($openingBalance>0) (Dr) {{number_format($openingBalance,2)}} @elseif ($openingBalance<0) (Cr) {{number_format(substr($openingBalance,1),2)}} @endif
                </td>
            </tr>
            @php($total_dr_amount = $total_dr_amount+$transaction->dr_amt)
            @php($total_cr_amount = $total_cr_amount+$transaction->cr_amt)
        @endforeach
        <tr>
            <th colspan="5" style="text-align: right">Total</th>
            <td style="text-align: right; font-weight: bold">{{number_format($total_dr_amount,2)}}</td>
            <td style="text-align: right; font-weight: bold">{{number_format($total_cr_amount,2)}}</td>
            <td style="text-align: right; font-weight: bold">@if($openingBalance>0) (Dr) {{number_format($openingBalance,2)}} @elseif ($openingBalance<0) (Cr) {{number_format(substr($openingBalance,1),2)}} @endif</td>
        </tr>
    </table>
</div>
<div class="footer">
    <div class="article">
        <p><strong>Report Generated By:</strong> {{ Auth::user()->name }}</p>
        <p>, <strong>Report Generated At:</strong> {{ \Carbon\Carbon::now()->format('Y-m-d h:i:s A') }}</p>
    </div>
</div>
</body>
</html>
