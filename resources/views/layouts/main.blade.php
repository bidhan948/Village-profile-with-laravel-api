<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/datepicker.css')}}">

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script> -->
    <script src="{{asset('js/chartjs.min.js')}}"></script>
    <script src="{{asset('js/chart-label.js')}}"></script>
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed text-sm">
    @include('sweetalert::alert')
    @livewireStyles
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-user"></i> <span class="px-2">{{ auth()->user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> <span class="px-3">{{ __('Logout') }}</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{url('/')}}" class="brand-link">
                <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">{{ auth()->user()->name }}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                    </div>
                </div> -->

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('report.survey') }}" class="nav-link">
                                <i class="nav-icon fas fa-file-invoice"></i>
                                <p>
                                    {{ __('???????????????') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('transfer.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-exchange-alt"></i>
                                <p>
                                    {{ __('??????????????????????????????????????? ???????????????') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    {{ __('?????????????????????????????????') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview @yield('menu_open_meeting')">
                            <a href="#" class="nav-link">
                                <i class="fas fa-business-time nav-icon "></i>
                                <p class="px-2 font-weight-bold">
                                    {{ __('????????????') }}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: @yield('meeting_child_meeting')">
                                <li class="nav-item">
                                    <a href="{{ route('committee-formed.index') }}" class="nav-link @yield('meeting_committe_formed')">
                                    <i class="nav-icon fas fa-users-cog"></i>
                                        <p class="px-2">{{ __('??????????????? ?????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('meeting.index') }}" class="nav-link @yield('meeting')">
                                    <i class="nav-icon fas fa-clock"></i>
                                        <p class="px-2">{{ __('???????????? ??????????????????????????????') }}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview @yield('menu_open_system')">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-wrench"></i>
                                <p class="px-2 font-weight-bold">
                                    {{ __('??????????????????????????? ???????????????????????????') }}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: @yield('s_child_system')">
                                <li class="nav-item">
                                    <a href="{{ route('role.index') }}" class="nav-link @yield('setting_role_system')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-2">{{ __('??????????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('fiscal-year.index') }}" class="nav-link @yield('setting_fiscal_system')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-2">{{ __('?????????????????? ???????????? ') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('post.index') }}" class="nav-link @yield('setting_post_system')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-2">{{ __('???????????? ????????????????????? ??????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('permission-manage.index') }}" class="nav-link @yield('setting_permission_system')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-2">{{ __('?????????????????? ?????????????????????') }}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview @yield('menu_open')">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p class="px-2 font-weight-bold">
                                    {{ __(' ???????????????????????????') }}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: @yield('s_child')">
                                <li class="nav-item">
                                    <a href="{{ route('relation.index') }}" class="nav-link @yield('setting_relation')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-2">{{ __('????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('marriage.index') }}" class="nav-link @yield('setting_marriage')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-2">{{ __('????????????????????? ??????????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('allowance-type.index') }}" class="nav-link @yield('setting_allowance_type')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-2">{{ __('????????????????????? ??????????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('occupation.index') }}" class="nav-link @yield('setting_occupation')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-2">{{ __('????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('education.index') }}" class="nav-link @yield('setting_education')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-2">{{ __('?????????????????????????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('disability_type.index') }}" class="nav-link @yield('setting_disability')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-2">{{ __('?????????????????????????????? ???????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('disability_card.index') }}" class="nav-link @yield('setting_disability_card')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-2">{{ __('?????????????????????????????? ??????????????? ???????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('disability_tool.index') }}" class="nav-link @yield('setting_disability_tool')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-2">{{ __('?????????????????????????????? ?????????????????? ?????????????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('foreign_country.index') }}" class="nav-link @yield('setting_foreign_country')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-2">{{ __('??????????????? ????????????/??????????????? ????????????????????? ') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('foreign-settlement-reason.index') }}" class="nav-link @yield('setting_foreign_country_reason')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-2">{{ __('??????????????? ?????????????????? ????????????????????? ????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('remitance.index') }}" class="nav-link @yield('setting_remitance')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-2">{{ __('???????????????????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('drinking-water-source.index') }}" class="nav-link @yield('setting_drinking_water_source')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-2">{{ __('?????????????????????????????? ???????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('water-purify.index') }}" class="nav-link @yield('setting_water_purify')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-1">{{ __('???????????? ???????????? ??????????????? ???????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('toilet-type.index') }}" class="nav-link @yield('setting_toilet_type')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-1">{{ __('??????????????? (??????????????????)') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('gender.index') }}" class="nav-link @yield('setting_gender')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-1">{{ __('???????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('fuel.index') }}" class="nav-link @yield('setting_fuel')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-1">{{ __('???????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('waste-management.index') }}" class="nav-link @yield('setting_waste_management')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-1">{{ __('??????????????? ??????????????????????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('animal.index') }}" class="nav-link @yield('setting_animal')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-1">{{ __('???????????????/??????????????? ?????? ???????????????????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('material.index') }}" class="nav-link @yield('setting_material')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-1">{{ __('????????????????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('floor.index') }}" class="nav-link @yield('setting_floor')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-1">{{ __('?????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('roof.index') }}" class="nav-link @yield('setting_roof')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-1">{{ __('???????????? ') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('training.index') }}" class="nav-link @yield('setting_training')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-1">{{ __('???????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('social-training.index') }}" class="nav-link @yield('setting_social_training')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-1">{{ __('????????????????????? ???????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('wall.index') }}" class="nav-link @yield('setting_wall')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-1">{{ __('?????????????????? ') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('service.index') }}" class="nav-link @yield('setting_service')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-1">{{ __('?????????????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('health-service.index') }}" class="nav-link @yield('setting_health_service')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-1">{{ __('??????????????????????????? ????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('disease.index') }}" class="nav-link @yield('setting_disease')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-1">{{ __('??????????????? ?????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('disaster.index') }}" class="nav-link @yield('setting_disaster')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-1">{{ __('??????????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('union-body.index') }}" class="nav-link @yield('setting_union_body')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-1">{{ __('????????? ??????????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('yearly-income.index') }}" class="nav-link @yield('setting_yearly_income')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-1">{{ __('????????????????????? ?????????????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('yearly-expenditure.index') }}" class="nav-link @yield('setting_yearly_expenditure')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-1">{{ __('????????????????????? ????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('irrigation-type.index') }}" class="nav-link @yield('setting_irrigation_type')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-1">{{ __('???????????????????????? ???????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('ownership.index') }}" class="nav-link @yield('setting_ownership')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-1">{{ __('???????????????????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('industry-type.index') }}" class="nav-link @yield('setting_industry_type')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-1">{{ __('?????????????????? ??????????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('unit.index') }}" class="nav-link @yield('setting_unit')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-1">{{ __('????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('entertainment.index') }}" class="nav-link @yield('setting_entertainment')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-1">{{ __('????????????????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('forest-type.index') }}" class="nav-link @yield('setting_forest_type')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-1">{{ __('???????????? ???????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('road-type.index') }}" class="nav-link @yield('setting_road_type')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-1">{{ __('??????????????? ??????????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('religion.index') }}" class="nav-link @yield('setting_religion')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-1">{{ __('????????????') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('crop.index') }}" class="nav-link @yield('setting_crop')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="px-1">{{ __('????????????') }}</p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="{{ route('province.index') }}" class="nav-link @yield('setting_province')">
                                <i class="far fa-circle nav-icon"></i>
                                <p class="px-2">{{ __('??????????????????') }}</p>
                                </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('municipal.index') }}" class="nav-link @yield('setting_municipal')">
                                <i class="far fa-circle nav-icon"></i>
                                <p class="px-2">{{ __('???????????????????????????') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('ward.index') }}" class="nav-link @yield('setting_ward')">
                                <i class="far fa-circle nav-icon"></i>
                                <p class="px-2">{{ __('???????????????') }}</p>
                            </a>
                        </li> --}}
                    </ul>
                    </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            @yield('main_content')
                        </div>
                    </div>
                </div>
            </section>
            <!-- Main content -->
            <!-- /.content -->
        </div>
    </div>
    @livewireScripts
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    {{-- <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script> --}}
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    {{-- <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script> --}}
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <script src="{{ asset('js/datepicker.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>


    @yield('scripts')
</body>

</html>