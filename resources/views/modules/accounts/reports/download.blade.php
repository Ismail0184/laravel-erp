<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Chart of Accounts</title>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #999;
            padding: 2px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
<h3 style="text-align: center; font-size: 20px">International Consumer Products Bangladesh Ltd.<small style="font-size: 9px; font-weight: normal"><br>
                                    Plot-43, Alam Arcade (4th Floor), Gulshan-2, Dhaka; PS; Dhaka-1212, Bangladesh</small></h3>

                <h3 style="text-align: center; font-size: 20px;">Chart of Accounts</h3>


        <table style="font-size: 10px">
        <thead>
        <tr>
            <th style="text-align: center; vertical-align: middle;width: 15%">Ledger Group</th>
            <th style="text-align: center; vertical-align: middle; width: 30%">Ledger</th>
            <th style="width: 30%; text-align: center; vertical-align: middle">Sub Ledger</th>
            <th style="width: 30%; text-align: center; vertical-align: middle">Sub Sub Ledger</th>
        </tr>
        </thead>
        @foreach ($ledgerGroups as $group)
        <tr>
            <td colspan="4" style="text-align: left; vertical-align: middle">{{$group->group_name}}</td>
        </tr>
            @foreach($group->getAccLedger as $ledger)
                <tr>
                    <td></td>
                    <td colspan="3" style="text-align: left; vertical-align: middle">{{$ledger->ledger_id}} {{$ledger->ledger_name}}</td>
                </tr>
                @foreach($ledger->subLedgers as $subledger)
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2" style="text-align: left; vertical-align: middle">{{$subledger->sub_ledger_id}} : {{$subledger->sub_ledger_name}}</td>
                </tr>
                    @foreach($subledger->getSubLedger as $subsubledger)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: left; vertical-align: middle">{{$subsubledger->sub_sub_ledger_id}} : {{$subsubledger->sub_sub_ledger_name}}</td>
                        </tr>
                    @endforeach
               @endforeach
            @endforeach
        @endforeach
    </table>
</div>
</body>
</html>
