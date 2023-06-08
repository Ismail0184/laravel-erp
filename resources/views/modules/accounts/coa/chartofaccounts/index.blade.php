@extends('layouts.app')

@section('title')
    Chart of Accounts
@endsection


@section('body')
    <style>
        .tree {
            min-height:20px;
            padding:19px;
            margin-bottom:20px;

            -webkit-border-radius:4px;
            -moz-border-radius:4px;
            border-radius:4px;
            -webkit-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
            -moz-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
            box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05)
        }
        .tree li {
            list-style-type:none;
            margin:0;
            padding:10px 5px 0 5px;
            position:relative
        }
        .tree li::before, .tree li::after {
            content:'';
            left:-20px;
            position:absolute;
            right:auto
        }
        .tree li::before {
            border-left:1px solid #999;
            bottom:50px;
            height:100%;
            top:0;
            width:1px
        }
        .tree li::after {
            border-top:1px solid #999;
            height:20px;
            top:25px;
            width:25px
        }
        .tree li span {
            -moz-border-radius:5px;
            -webkit-border-radius:5px;
            border:1px solid #999;
            border-radius:5px;
            display:inline-block;
            padding:3px 8px;
            text-decoration:none
        }
        .tree li.parent_li>span {
            cursor:pointer
        }
        .tree>ul>li::before, .tree>ul>li::after {
            border:0
        }
        .tree li:last-child::before {
            height:30px
        }
        .tree li.parent_li>span:hover, .tree li.parent_li>span:hover+ul li span {
            background:#eee;
            border:1px solid #94a0b4;
            color:#000
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Chart of Accounts</h4>
                        <div class="tree well">
                            <ul>
                                @foreach($ledgergroups as $ledgergroup)
                                <li>
                                    <span><i class="icon-folder-open"></i>Group</span> <a href="">{{$ledgergroup->group_id}} : {{$ledgergroup->group_name}}</a>
                                    <ul>
                                        @foreach($ledgergroup->getAccLedger as $ledger)
                                        <li><span><i class="icon-minus-sign"></i> Ledger</span> <a href="">{{$ledger->ledger_id}} : {{$ledger->ledger_name}}</a>
                                            <ul>
                                                @foreach($ledger->subLedgers as $subledger)
                                                <li><span><i class="icon-minus-sign"></i> Sub</span> <a href="">{{$subledger->sub_ledger_id}} : {{$subledger->sub_ledger_name}}</a>
                                                    <ul>
                                                        @foreach($subledger->getSubLedger as $subsubledger)
                                                        <li><span><i class="icon-minus-sign"></i> Sub-sub</span> <a href="">{{$subsubledger->sub_sub_ledger_id}} : {{$subsubledger->sub_sub_ledger_name}}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script type="text/javascript">
        $(function () {
            $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
            //--------------------------------------------------
            var extra = $(".tree li.parent_li > span")
                .parent("li.parent_li")
                .find(" > ul > li");
            extra.hide("fast");
            //----------------------------------------------------

            $('.tree li.parent_li > span').on('click', function (e) {
                var children = $(this).parent('li.parent_li').find(' > ul > li');
                if (children.is(":visible")) {
                    children.hide('fast');
                    $(this).attr('title', 'Expand this branch').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
                } else {
                    children.show('fast');
                    $(this).attr('title', 'Collapse this branch').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
                }
                e.stopPropagation();
            });
        });
    </script>
@endsection
