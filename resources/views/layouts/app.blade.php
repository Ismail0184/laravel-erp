<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>ERP Software | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Best ERP software solutions" name="description" />
    <meta content="Md Ismail Hossain | +880 1845854380" name="author" />
    <link rel="shortcut icon" href="{{asset('/')}}assets/images/favicon.ico" />

    <link href="{{asset('/')}}assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('/')}}assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('/')}}assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('/')}}assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('/')}}assets/css/bootstrap.min.css"  rel="stylesheet" type="text/css" />
    <link href="{{asset('/')}}assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('/')}}assets/css/app.min.css"  rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body data-sidebar="dark">
<div id="layout-wrapper">
    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="{{route('dashboard')}}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{asset('/')}}assets/images/logo.svg" alt="" height="22">
                                </span>
                        <span class="logo-lg">
                                    <img src="{{asset('/')}}assets/images/logo-dark.png" alt="" height="17">
                                </span>
                    </a>

                    <a href="{{route('dashboard')}}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{asset('/')}}assets/images/logo-light.svg" alt="" height="22">
                                </span>
                        <span class="logo-lg">
                                    <img src="{{asset('/')}}assets/images/logo-light.png" alt="" height="19">
                                </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>

                <!-- App company name-->
                <form class="app-search d-none d-lg-block">
                    <div class="position-relative">
                        <input type="text" class="form-control" value="Raresoft Limited" >
                    </div>
                </form>
            </div>

            <div class="d-flex">

                <div class="dropdown d-inline-block d-lg-none ml-2">
                    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-magnify"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                         aria-labelledby="page-header-search-dropdown">

                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>





                <div class="dropdown d-none d-lg-inline-block ml-1">
                    <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                        <i class="bx bx-fullscreen"></i>
                    </button>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-bell bx-tada"></i>
                        <span class="badge badge-danger badge-pill">3</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                         aria-labelledby="page-header-notifications-dropdown">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0"> Notifications </h6>
                                </div>
                                <div class="col-auto">
                                    <a href="#!" class="small"> View All</a>
                                </div>
                            </div>
                        </div>
                        <div data-simplebar style="max-height: 230px;">
                            <a href="#" class="text-reset notification-item">
                                <div class="media">
                                    <div class="avatar-xs mr-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class="bx bx-cart"></i>
                                                </span>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mt-0 mb-1">Your order is placed</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1">If several languages coalesce the grammar</p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="p-2 border-top">
                            <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="javascript:void(0)">
                                <i class="mdi mdi-arrow-right-circle mr-1"></i> View More..
                            </a>
                        </div>
                    </div>
                </div>
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="{{ Auth::user()->profile_photo_url }}"
                             alt="{{ Auth::user()->name }}">
                        <span class="d-none d-xl-inline-block ml-1">{{ Auth::user()->name }}</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        <a class="dropdown-item" href="{{route('profile.show')}}"><i class="bx bx-user font-size-16 align-middle mr-1"></i> Profile</a>
                        <a class="dropdown-item" href="#"><i class="bx bx-wallet font-size-16 align-middle mr-1"></i> My Wallet</a>
                        <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="bx bx-wrench font-size-16 align-middle mr-1"></i> Settings</a>
                        <a class="dropdown-item" href="#"><i class="bx bx-lock-open font-size-16 align-middle mr-1"></i> Lock screen</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="dropdown-item text-danger">
                            <i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i>
                            <span>{{ __('Log Out') }}</span>
                        </a>
                        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                        <i class="bx bx-cog bx-spin"></i>
                    </button>
                </div>

            </div>
        </div>
    </header>

    <div class="vertical-menu">
        <div data-simplebar class="h-100">
            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title">Menus</li>
                    <li>
                        <a href="{{route('dashboard')}}" class="waves-effect">
                            <i class="bx bx-home-circle"></i><span>Dashboards</span>
                        </a>
                    </li>
                    @if(session('module_id')=='11')
                        @foreach($mainmenus as $mainmenu)
                    <li>
                        <a href="{{$mainmenu->url}}" @if(count($mainmenu->subMenu) > 0) class="has-arrow waves-effect" @endif>
                            <i class="{{$mainmenu->faicon}}"></i>
                            <span>{{$mainmenu->main_menu_name}}</span>

                            @if($mainmenu->main_menu_id=='10076')
                                @if($totalResponsibleCount>0)
                                <span class="badge badge-pill badge-danger float-right">{{$totalResponsibleCount}}</span>
                                @endif
                            @elseif($mainmenu->main_menu_id=='10073')
                                <span class="badge badge-pill badge-primary float-right"></span>
                            @elseif($mainmenu->main_menu_id=='10074')
                                @if($totalRecommendationCount>0)
                                <span class="badge badge-pill badge-info float-right">{{$totalRecommendationCount}}</span>
                                @endif
                            @elseif($mainmenu->main_menu_id=='10075')
                                @if($totalApprovalCount>0)
                                <span class="badge badge-pill badge-success float-right">{{$totalApprovalCount}}</span>
                                @endif
                            @endif

                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @foreach($mainmenu->subMenu as $submenu)
                            <li>
                                <a href="{{route(''.$submenu->sub_url.'')}}">{{$submenu->sub_menu_name}}
                                    @if($submenu->sub_menu_id=='20266')
                                        @if($responsibleForLeaveCount>0)
                                            <span class="badge badge-pill badge-danger float-right">{{$responsibleForLeaveCount}}</span>
                                        @endif

                                    @elseif($submenu->sub_menu_id=='20264')
                                        @if($recommendationForLeaveCount>0)
                                            <span class="badge badge-pill badge-info float-right">{{$recommendationForLeaveCount}}</span>
                                        @endif

                                    @elseif($submenu->sub_menu_id=='20265')
                                        @if($approvalForLeaveCount>0)
                                            <span class="badge badge-pill badge-success float-right">{{$approvalForLeaveCount}}</span>
                                        @endif
                                    @endif

                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                        @endforeach

                    @else
                        @foreach($mainmenus as $mainmenu)
                            <li>
                                <a href="@if($mainmenu->main_menu_id=='10009'){{route(''.$mainmenu->url.'')}}@else
                        {{$mainmenu->url}}@endif" @if(count($mainmenu->subMenu) > 0) class="has-arrow waves-effect" @endif>
                                    <i class="{{$mainmenu->faicon}}"></i>
                                    <span>{{$mainmenu->main_menu_name}}</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    @foreach($mainmenu->subMenu as $submenu)
                                        <li><a href="{{route(''.$submenu->sub_url.'')}}">{{$submenu->sub_menu_name}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <!-- Sidebar -->
        </div>
    </div>
    <div class="main-content">
        <div class="page-content">
            @yield('body')
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>document.write(new Date().getFullYear())</script> © Raresoft.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-right d-none d-sm-block">
                            Design & Develop by Raresoft
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>


<!-- JAVASCRIPT -->
<script src="{{asset('/')}}assets/libs/jquery/jquery.min.js"></script>
<script src="{{asset('/')}}assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('/')}}assets/libs/metismenu/metisMenu.min.js"></script>
<script src="{{asset('/')}}assets/libs/simplebar/simplebar.min.js"></script>
<script src="{{asset('/')}}assets/libs/node-waves/waves.min.js"></script>
<script src="{{asset('/')}}assets/libs/select2/js/select2.min.js"></script>


<!-- Required datatable js -->
<script src="{{asset('/')}}assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{asset('/')}}assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Buttons examples -->
<script src="{{asset('/')}}assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('/')}}assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('/')}}assets/libs/jszip/jszip.min.js"></script>
<script src="{{asset('/')}}assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="{{asset('/')}}assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="{{asset('/')}}assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('/')}}assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('/')}}assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="{{asset('/')}}assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('/')}}assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('/')}}/js/pages/datatables.init.js"></script>
<script src="{{asset('/')}}assets/libs/apexcharts/apexcharts.min.js"></script>
<!-- Datatable init js -->
<script src="{{asset('/')}}assets/js/pages/dashboard.init.js"></script>
<script src="{{asset('/')}}assets/js/pages/dashboards.init.js"></script>
<script src="{{asset('/')}}assets/js/pages/datatables.init.js"></script>
<script src="{{asset('/')}}assets/js/app.js"></script>
<script src="{{asset('/')}}assets/js/pages/form-advanced.init.js"></script>
</body>
</html>
