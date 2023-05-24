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
                                    <img src="{{asset('/')}}assets/images/logo-light.png" alt="" height="50" width="80">
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
                        <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle mr-1"></i> Profile</a>
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
                    @if(session('module_id')==1)

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-store"></i>
                            <span>Admin Setup / Config</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('acc.class.view')}}">Class</a></li>
                        </ul>
                    </li>
                    <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-store"></i>
                                <span>Chart of Accounts</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{route('acc.class.view')}}">Class</a></li>
                                <li><a href="{{route('acc.sub-class.view')}}">Sub Class</a></li>
                                <li><a href="{{route('acc.ledger-group.view')}}">Ledger Group</a></li>
                                <li><a href="{{route('acc.ledger.view')}}">Ledger</a></li>
                                <li><a href="{{route('acc.sub-ledger.view')}}">Sub Ledger</a></li>
                                <li><a href="{{route('acc.sub-sub-ledger.view')}}">Sub Sub-ledger</a></li>
                                <li><a href="{{route('acc.cost-category.view')}}">Cost Category</a></li>
                                <li><a href="{{route('acc.cost-center.view')}}">Cost Center</a></li>
                                <li><a href="ecommerce-add-product.html">@php(Session('module_id'))</a></li>
                                <li><a href="ecommerce-add-product.html">{{ session('module_id') }}</a></li>
                                <li><a href="ecommerce-add-product.html">{{Session::get('module_id')}}</a></li>
                            </ul>
                        </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-store"></i>
                            <span>Vouchers</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="ecommerce-products.html">Products</a></li>
                            <li><a href="ecommerce-product-detail.html">Product Detail</a></li>
                            <li><a href="ecommerce-orders.html">Orders</a></li>
                            <li><a href="ecommerce-customers.html">Customers</a></li>
                            <li><a href="ecommerce-cart.html">Cart</a></li>
                            <li><a href="ecommerce-checkout.html">Checkout</a></li>
                            <li><a href="ecommerce-shops.html">Shops</a></li>
                            <li><a href="ecommerce-add-product.html">Add Product</a></li>
                        </ul>
                    </li>

                    @elseif(session('module_id')==2)
                    @endif
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-bitcoin"></i>
                            <span>Crypto</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="crypto-wallet.html">Wallet</a></li>
                            <li><a href="crypto-buy-sell.html">Buy/Sell</a></li>
                            <li><a href="crypto-exchange.html">Exchange</a></li>
                            <li><a href="crypto-lending.html">Lending</a></li>
                            <li><a href="crypto-orders.html">Orders</a></li>
                            <li><a href="crypto-kyc-application.html">KYC Application</a></li>
                            <li><a href="crypto-ico-landing.html">ICO Landing</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-envelope"></i>
                            <span>Email</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="email-inbox.html">Inbox</a></li>
                            <li><a href="email-read.html">Read Email</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-receipt"></i>
                            <span>Invoices</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="invoices-list.html">Invoice List</a></li>
                            <li><a href="invoices-detail.html">Invoice Detail</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-briefcase-alt-2"></i>
                            <span>Projects</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="projects-grid.html">Projects Grid</a></li>
                            <li><a href="projects-list.html">Projects List</a></li>
                            <li><a href="projects-overview.html">Project Overview</a></li>
                            <li><a href="projects-create.html">Create New</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-task"></i>
                            <span>Tasks</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="tasks-list.html">Task List</a></li>
                            <li><a href="tasks-kanban.html">Kanban Board</a></li>
                            <li><a href="tasks-create.html">Create Task</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bxs-user-detail"></i>
                            <span>Contacts</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="contacts-grid.html">User Grid</a></li>
                            <li><a href="contacts-list.html">User List</a></li>
                            <li><a href="contacts-profile.html">Profile</a></li>
                        </ul>
                    </li>
                    <li class="menu-title">Pages</li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-user-circle"></i>
                            <span>Authentication</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="auth-login.html">Login</a></li>
                            <li><a href="auth-register.html">Register</a></li>
                            <li><a href="auth-recoverpw.html">Recover Password</a></li>
                            <li><a href="auth-lock-screen.html">Lock Screen</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-file"></i>
                            <span>Utility</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="pages-starter.html">Starter Page</a></li>
                            <li><a href="pages-maintenance.html">Maintenance</a></li>
                            <li><a href="pages-comingsoon.html">Coming Soon</a></li>
                            <li><a href="pages-timeline.html">Timeline</a></li>
                            <li><a href="pages-faqs.html">FAQs</a></li>
                            <li><a href="pages-pricing.html">Pricing</a></li>
                            <li><a href="pages-404.html">Error 404</a></li>
                            <li><a href="pages-500.html">Error 500</a></li>
                        </ul>
                    </li>

                    <li class="menu-title">Components</li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-tone"></i>
                            <span>UI Elements</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="ui-alerts.html">Alerts</a></li>
                            <li><a href="ui-buttons.html">Buttons</a></li>
                            <li><a href="ui-cards.html">Cards</a></li>
                            <li><a href="ui-carousel.html">Carousel</a></li>
                            <li><a href="ui-dropdowns.html">Dropdowns</a></li>
                            <li><a href="ui-grid.html">Grid</a></li>
                            <li><a href="ui-images.html">Images</a></li>
                            <li><a href="ui-lightbox.html">Lightbox</a></li>
                            <li><a href="ui-modals.html">Modals</a></li>
                            <li><a href="ui-rangeslider.html">Range Slider</a></li>
                            <li><a href="ui-session-timeout.html">Session Timeout</a></li>
                            <li><a href="ui-progressbars.html">Progress Bars</a></li>
                            <li><a href="ui-sweet-alert.html">Sweet-Alert</a></li>
                            <li><a href="ui-tabs-accordions.html">Tabs & Accordions</a></li>
                            <li><a href="ui-typography.html">Typography</a></li>
                            <li><a href="ui-video.html">Video</a></li>
                            <li><a href="ui-general.html">General</a></li>
                            <li><a href="ui-colors.html">Colors</a></li>
                            <li><a href="ui-rating.html">Rating</a></li>
                            <li><a href="ui-notifications.html">Notifications</a></li>
                            <li><a href="ui-image-cropper.html">Image Cropper</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="waves-effect">
                            <i class="bx bxs-eraser"></i>
                            <span class="badge badge-pill badge-danger float-right">10</span>
                            <span>Forms</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="form-elements.html">Form Elements</a></li>
                            <li><a href="form-layouts.html">Form Layouts</a></li>
                            <li><a href="form-validation.html">Form Validation</a></li>
                            <li><a href="form-advanced.html">Form Advanced</a></li>
                            <li><a href="form-editors.html">Form Editors</a></li>
                            <li><a href="form-uploads.html">Form File Upload</a></li>
                            <li><a href="form-xeditable.html">Form Xeditable</a></li>
                            <li><a href="form-repeater.html">Form Repeater</a></li>
                            <li><a href="form-wizard.html">Form Wizard</a></li>
                            <li><a href="form-mask.html">Form Mask</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-list-ul"></i>
                            <span>Tables</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="tables-basic.html">Basic Tables</a></li>
                            <li><a href="tables-datatable.html">Data Tables</a></li>
                            <li><a href="tables-responsive.html">Responsive Table</a></li>
                            <li><a href="tables-editable.html">Editable Table</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bxs-bar-chart-alt-2"></i>
                            <span>Charts</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="charts-apex.html">Apex Charts</a></li>
                            <li><a href="charts-echart.html">E Charts</a></li>
                            <li><a href="charts-chartjs.html">Chartjs Chart</a></li>
                            <li><a href="charts-flot.html">Flot Chart</a></li>
                            <li><a href="charts-tui.html">Toast UI Chart</a></li>
                            <li><a href="charts-knob.html">Jquery Knob Chart</a></li>
                            <li><a href="charts-sparkline.html">Sparkline Chart</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-aperture"></i>
                            <span>Icons</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="icons-boxicons.html">Boxicons</a></li>
                            <li><a href="icons-materialdesign.html">Material Design</a></li>
                            <li><a href="icons-dripicons.html">Dripicons</a></li>
                            <li><a href="icons-fontawesome.html">Font awesome</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-map"></i>
                            <span>Maps</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="maps-google.html">Google Maps</a></li>
                            <li><a href="maps-vector.html">Vector Maps</a></li>
                            <li><a href="maps-leaflet.html">Leaflet Maps</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-share-alt"></i>
                            <span>Multi Level</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li><a href="javascript: void(0);">Level 1.1</a></li>
                            <li><a href="javascript: void(0);" class="has-arrow">Level 1.2</a>
                                <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="javascript: void(0);">Level 2.1</a></li>
                                    <li><a href="javascript: void(0);">Level 2.2</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
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
<!-- Right Sidebar -->
<div class="right-bar">
    <div data-simplebar class="h-100">
        <div class="rightbar-title px-3 py-4">
            <a href="javascript:void(0);" class="right-bar-toggle float-right">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
            <h5 class="m-0">Settings</h5>
        </div>
        <!-- Settings -->
        <hr class="mt-0" />
        <h6 class="text-center mb-0">Choose Layouts</h6>

        <div class="p-4">
            <div class="mb-2">
                <img src="{{asset('/')}}assets/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="">
            </div>
            <div class="custom-control custom-switch mb-3">
                <input type="checkbox" class="custom-control-input theme-choice" id="light-mode-switch" checked />
                <label class="custom-control-label" for="light-mode-switch">Light Mode</label>
            </div>

            <div class="mb-2">
                <img src="{{asset('/')}}assets/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail" alt="">
            </div>
            <div class="custom-control custom-switch mb-3">
                <input type="checkbox" class="custom-control-input theme-choice" id="dark-mode-switch" data-bsStyle="{{asset('/')}}assets/css/bootstrap-dark.min.css" data-appStyle="{{asset('/')}}assets/css/app-dark.min.css" />
                <label class="custom-control-label" for="dark-mode-switch">Dark Mode</label>
            </div>

            <div class="mb-2">
                <img src="{{asset('/')}}assets/images/layouts/layout-3.jpg" class="img-fluid img-thumbnail" alt="">
            </div>
            <div class="custom-control custom-switch mb-5">
                <input type="checkbox" class="custom-control-input theme-choice" id="rtl-mode-switch" data-appStyle="{{asset('/')}}assets/css/app-rtl.min.css" />
                <label class="custom-control-label" for="rtl-mode-switch">RTL Mode</label>
            </div>
        </div>
    </div>
</div>
<div class="rightbar-overlay"></div>

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
