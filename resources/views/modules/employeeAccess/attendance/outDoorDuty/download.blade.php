<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Outdoor Duty Application # {{request('id')}}</title>

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
            <td colspan="3">
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
            <td colspan="3">
                <h3 style="text-align: center; font-size: 15px; margin-top: -50px;">OUTDOOR DUTY APPLICATION</h3>
            </td>
        </tr>
        <tr class="information">
            <td colspan="3">
                <table class="topheading">
                    <tr>
                        <td>
                            <strong>Application ID :</strong>
                            {{request('id')}}<br />
                        </td>

                        <td>
                            <strong>Application Date:</strong>
                            {{$outdoorDutyApplication->created_at}}<br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>


        <tr class="heading">
            <td style="text-align: center; vertical-align: middle">Date</td>
            <td style="text-align: center; vertical-align: middle">OD Place</td>
            <td style="text-align: center; vertical-align: middle">OD Purpose</td>
        </tr>
        <tr class="item">
            <td style="text-align: center; vertical-align: middle">{{$outdoorDutyApplication->date}}</td>
            <td style="text-align: center; vertical-align: middle">{{$outdoorDutyApplication->od_place}}</td>
            <td style="text-align: center; vertical-align: middle">{{$outdoorDutyApplication->reason}}</td>
        </tr>
    </table>

    <table style="font-size: 11px; margin-top: 60px">
        <tr class="signature">
            <td style="text-align: center; width: 25%">{{$outdoorDutyApplication->AppliedBy->name}}</td>
            <td style="text-align: center; width: 25%">{{$outdoorDutyApplication->RecommendedPerson->name}}</td>
            <td style="text-align: center; width: 25%">{{$outdoorDutyApplication->ApprovedPerson->name}}</td>
            <td style="text-align: center; width: 25%">{{$outdoorDutyApplication->GrantPerson->name}}</td>
        </tr>
        <tr class="signature0">
            <td style="text-align: center">(at: {{$outdoorDutyApplication->created_at}})</td>
            <td style="text-align: center">(at: {{$outdoorDutyApplication->recommended_at}})</td>
            <td style="text-align: center">(at: {{$outdoorDutyApplication->approved_at}})</td>
            <td style="text-align: center">(at: {{$outdoorDutyApplication->granted_at}})</td>
        </tr>

        <tr class="signature2">
            <td style="text-align: center">----------------------------------</td>
            <td style="text-align: center">----------------------------------</td>
            <td style="text-align: center">----------------------------------</td>
            <td style="text-align: center">----------------------------------</td>
        </tr>

        <tr class="signature3">
            <th>Applied By</th>
            <th>Recommended By</th>
            <th>Approved By</th>
            <th>Granted By</th>
        </tr>
    </table>
</div>
</body>
</html>
