<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>@yield("title")</title>

    <link href="{{asset('dist/plugins/pg-calendar/css/pignose.calendar.min.css')}}" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="{{asset('dist/plugins/chartist/css/chartist.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css')}}">
    <!-- Custom Stylesheet -->
    <link href="{{asset('dist/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('dist/plugins/fullcalendar/css/fullcalendar.min.css')}}" rel="stylesheet">
    @yield('css')
</head>

<body>

<!--**********************************
        Main wrapper start
    ***********************************-->
<div id="main-wrapper">

    <!--**********************************
        Nav header start
    ***********************************-->
    <div class="nav-header">
        <div class="brand-logo">
            <a href="{{route('home')}}">
                <b class="logo-abbr"><img src="{{asset('dist/images/logo.png')}}" alt="Logo"> </b>
                <span class="logo-compact"><img src="" alt=""></span>
                <span class="brand-title">
                        <img src="{{asset('dist/images/logo.png')}}" alt="">
                    </span>
            </a>
        </div>
    </div>
    <!--**********************************
        Nav header end
    ***********************************-->

    <!--**********************************
        Header start
    ***********************************-->
    <div class="header">
        <div class="header-content clearfix">

            <div class="nav-control">
                <div class="hamburger">
                    <span class="toggle-icon"><i class="icon-menu"></i></span>
                </div>
            </div>
            <div class="header-left">
                <div class="input-group icons">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1"><i
                                class="mdi mdi-magnify"></i></span>
                    </div>
                    <input type="search" class="form-control" placeholder="Search Dashboard"
                           aria-label="Search Dashboard">
                    <div class="drop-down animated flipInX d-md-none">
                        <form action="#">
                            <input type="text" class="form-control" placeholder="Search">
                        </form>
                    </div>
                </div>
            </div>
            <div class="header-right">
                <ul class="clearfix">
                    <li class="icons dropdown">
                        <a href="javascript:void(0)" data-toggle="dropdown">
                            <i class="mdi mdi-email-outline"></i>
                            <span class="badge badge-pill gradient-1">3</span>
                        </a>
                        <div class="drop-down animated fadeIn dropdown-menu">
                            <div class="dropdown-content-heading d-flex justify-content-between">
                                <span class="">New Messages</span>
                            </div>
                        </div>
                    </li>
                    <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                            <i class="mdi mdi-bell-outline"></i>
                            <span class="badge badge-pill gradient-2">3</span>
                        </a>
                        <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                            <div class="dropdown-content-heading d-flex justify-content-between">
                                <span class="">New Notifications</span>
                            </div>
                            <div class="dropdown-content-body">
                                <ul>
                                    <li>
                                        <a href="javascript:void()">
                                            <span class="mr-3 avatar-icon bg-success-lighten-2"><i
                                                    class="icon-present"></i></span>
                                            <div class="notification-content">
                                                <h6 class="notification-heading">Events near you</h6>
                                            </div>
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </li>
                    {{--                    Languages--}}
                    <li class="icons dropdown d-none d-md-flex">
                        <a href="javascript:void(0)" class="log-user" data-toggle="dropdown">
                            <span>English</span> <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i>
                        </a>
                        <div class="drop-down dropdown-language animated fadeIn  dropdown-menu">
                            <div class="dropdown-content-body">
                                <ul>
                                    <li><a href="javascript:void()">English</a></li>
                                    <li><a href="javascript:void()">Farsi</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    {{--                    Settings--}}
                    <li class="icons dropdown">
                        <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                            <span class="activity active"></span>
                            <img src="{{asset('dist/images/avatar/11.png')}}" height="40" width="40" alt="Profile">
                        </div>
                        <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                            <div class="dropdown-content-body">
                                <ul>
                                    <li>
                                        <a href="{{route('profile')}}"><i class="icon-user"></i>
                                            <span>Profile</span></a>
                                    </li>
                                    <hr class="my-2">

                                    <li>
                                        <form action="{{route('logout')}}" method="POST">
                                            @csrf
                                            <button class="btn btn-block"><i class="icon-key"></i> <span>Logout</span>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--**********************************
        Header end ti-comment-alt
    ***********************************-->

    <!--**********************************
        Sidebar start
    ***********************************-->
    <div class="nk-sidebar">
        <div class="nk-nav-scroll">
            <ul class="metismenu" id="menu">
                <li class="nav-label">Dashboard</li>

                <li>
                    <a class="" href="{{route('dashboard')}}" aria-expanded="false">
                        <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                    </a>
                </li>

                <li class="nav-label">Apps</li>

                <li>
                    <a class="" href="{{route('app_calendar')}}" aria-expanded="false">
                        <i class="icon-calender"></i><span class="nav-text">App Calendar</span>
                    </a>
                </li>

                <li class="nav-label">Menu</li>

                <li>
                    <a class="has-arrow" href="#" aria-expanded="false">
                        <i class="icon-people menu-icon"></i><span class="nav-text">Staff</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('staff.create')}}">Add New Staff</a></li>
                        <li><a href="{{route('staff.index')}}">Staff List</a></li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow" href="#" aria-expanded="false">
                        <i class="icon-people menu-icon"></i><span class="nav-text">Patients</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route("patient.create")}}">Add New Patient</a></li>
                        <li><a href="{{route("patient-record.create")}}">Add New Patient History</a></li>
                        <li><a href="{{route('patient.index')}}">Patient List</a></li>
                        <li><a href="{{route('patient-record.index')}}">Patient History</a></li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow" href="#" aria-expanded="false">
                        <i class="icon-clock menu-icon"></i><span class="nav-text">Schedule</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('schedule.create')}}">Add New Timetable</a></li>
                        <li><a href="{{route('freetime.create')}}">Add New Absent</a></li>
                        <li><a href="{{route('overtime.create')}}">Add New Overtime</a></li>
                        <li><a href="{{route('schedule.index')}}">Schedules</a></li>
                        <li><a href="{{route('overtime.index')}}">Overtime</a></li>
                        <li><a href="{{route('freetime.index')}}">Absent</a></li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow" href="#" aria-expanded="false">
                        <i class="icon-plus icon-menu"></i><span class="nav-text">Pharmacy</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('medicine.create')}}">Add New Medicine</a></li>
                        <li><a href="{{route('patient-medicine.create')}}">Add New Patient Medicine</a></li>
                        <li><a href="{{route('medicine.index')}}">Medicine List</a></li>
                        <li><a href="{{route('patient-medicine.index')}}">Patient Medicine List</a></li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow" href="#" aria-expanded="false">
                        <i class="icon-plus menu-icon"></i><span class="nav-text">Laboratory</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route("test.create")}}">Add New Test</a></li>
                        <li><a href="{{route('patient-test.create')}}">Add New Patient Test</a></li>
                        <li><a href="{{route('test.index')}}">Tests</a></li>
                        <li><a href="{{route("patient-test.index")}}">Patient Tests</a></li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow" href="#" aria-expanded="false">
                        <i class="icon-home menu-icon"></i><span class="nav-text">Room</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route("room.create")}}">Add New Room</a></li>
                        <li><a href="{{route('admit.create')}}">Add New Patient Admit</a></li>
                        <li><a href="{{route('room.index')}}">Room List</a></li>
                        <li><a href="{{route('admit.index')}}">Admit List</a></li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow" href="#" aria-expanded="false">
                        <i class="icon-plus menu-icon"></i><span class="nav-text">Treatments</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('treatment.create')}}">Add New Treatment</a></li>
                        <li><a href="{{route('patient-treatment.create')}}">Add New Patient Treatment</a></li>
                        <li><a href="{{route('treatment.index')}}">Treatment List</a></li>
                        <li><a href="{{route('patient-treatment.index')}}">Patient Treatments</a></li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow" href="#" aria-expanded="false">
                        <i class="icon-ecommerce-graph-increase menu-icon"></i><span class="nav-text">Finance</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="#">Add New Salary</a></li>
                        <li><a href="#">Add New Invoice</a></li>
                        <li><a href="#">Add New Expanse</a></li>
                        <li><a href="#">Salaries</a></li>
                        <li><a href="#">Invoices</a></li>
                        <li><a href="#">Expanses</a></li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow" href="#" aria-expanded="false">
                        <i class="icon-plus menu-icon"></i><span class="nav-text">Appointments</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('appointment.create')}}">Add New Appointments</a></li>
                        <li><a href="{{route('appointment.index')}}">Appointments</a></li>
                    </ul>
                </li>

                {{----------------------------------------------------------------------------------}}

                <li class="nav-label">Users</li>

                <li>
                    <a class="has-arrow" href="#" aria-expanded="false">
                        <i class="icon-user menu-icon"></i><span class="nav-text">Users</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="#">Add New User</a></li>
                        <li><a href="#">Users</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
    <!--**********************************
        Sidebar end
    ***********************************-->


    <!--**********************************
        Content start
    ***********************************-->

    <div class="content-body">
        <div class="container-fluid mt-3">
            @yield("content")
        </div>

    </div>
    <!--**********************************
        Content end
    ***********************************-->


    <!--**********************************
        Footer start
    ***********************************-->
    <div class="footer">
        <div class="copyright">
            <p>Copyright &copy; Designed & Developed by <a href="#">EzZat</a> 2024</p>
        </div>
    </div>
    <!--**********************************
        Footer end
    ***********************************-->
</div>
<!--**********************************
    Main wrapper end
***********************************-->

<!--**********************************
    Scripts
***********************************-->

<script src="{{asset('dist/plugins/common/common.min.js')}}"></script>
<script src="{{asset('dist/js/custom.min.js')}}"></script>
<script src="{{asset('dist/js/settings.js')}}"></script>
<script src="{{asset('dist/js/gleek.js')}}"></script>
<script src="{{asset('dist/js/styleSwitcher.js')}}"></script>
<script src="{{asset('dist/js/jquery.min.js')}}"></script>

<!-- Chartjs -->
<script src="{{asset('dist/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Circle progress -->
<script src="{{asset('dist/plugins/circle-progress/circle-progress.min.js')}}"></script>
<!-- Datamap -->
<script src="{{asset('dist/plugins/d3v3/index.js')}}"></script>
<script src="{{asset('dist/plugins/topojson/topojson.min.js')}}"></script>
<script src="{{asset('dist/plugins/datamaps/datamaps.world.min.js')}}"></script>
<!-- Morrisjs -->
{{--<script src="{{asset('dist/plugins/raphael/raphael.min.js')}}"></script>--}}
{{--<script src="{{asset('dist/plugins/morris/morris.min.js')}}"></script>--}}
<!-- Pignose Calender -->

<!-- ChartistJS -->
{{--<script src="{{asset('dist/plugins/chartist/js/chartist.min.js')}}"></script>--}}
{{--<script src="{{asset('dist/js/dashboard/dashboard-1.js')}}"></script>--}}

@yield('js')

</body>

</html>
