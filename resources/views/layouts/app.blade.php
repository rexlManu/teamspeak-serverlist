<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>{{ env('APP_NAME') }} &bull; </title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts and Styles -->
    @yield('css_before')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.css') }}">

    <link rel="stylesheet" id="css-theme" href="{{ asset('assets/css/themes/xsam.css') }}">
@yield('css_after')

<!-- Scripts -->
    <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
</head>
<body>

<div id="page-container"
     class="sidebar-dark enable-page-overlay side-scroll page-header-fixed page-header-dark main-content-boxed side-trans-enabled">
    <div id="page-overlay"></div>

    <!-- Sidebar -->
    <!--
        Sidebar Mini Mode - Display Helper classes

        Adding 'smini-hide' class to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
        Adding 'smini-show' class to an element will make it visible (opacity: 1) when the sidebar is in mini mode
            If you would like to disable the transition animation, make sure to also add the 'no-transition' class to your element

        Adding 'smini-hidden' to an element will hide it when the sidebar is in mini mode
        Adding 'smini-visible' to an element will show it (display: inline-block) only when the sidebar is in mini mode
        Adding 'smini-visible-block' to an element will show it (display: block) only when the sidebar is in mini mode
    -->
    <nav id="sidebar" aria-label="Main Navigation" data-simplebar="init">
        <div class="simplebar-wrapper" style="margin: 0px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden;">
                        <div class="simplebar-content" style="padding: 0px;">
                            <!-- Side Header -->
                            <div class="content-header bg-primary">
                                <!-- Logo -->
                                <a class="text-dual d-inline-block" href="index.html">
                                    <i class="fa fa-campground"></i>
                                </a>
                                <!-- END Logo -->

                                <!-- Options -->
                                <div>
                                    <!-- Close Sidebar, Visible only on mobile screens -->
                                    <a class="d-lg-none text-white ml-2" data-toggle="layout"
                                       data-action="sidebar_close" href="javascript:void(0)">
                                        <i class="fa fa-times-circle"></i>
                                    </a>
                                    <!-- END Close Sidebar -->
                                </div>
                                <!-- END Options -->
                            </div>
                            <!-- END Side Header -->

                            <!-- User Info -->
                            <div class="smini-hidden">
                                <div class="content-side content-side-full bg-black-10 d-flex align-items-center">
                                    <a class="img-link d-inline-block" href="javascript:void(0)">
                                        <img class="img-avatar img-avatar48 img-avatar-thumb"
                                             src="{{ asset('assets/media/avatars/avatar8.jpg') }}" alt="">
                                    </a>
                                    <div class="ml-3">
                                        <a class="font-w600 text-dual" href="javascript:void(0)">Stella Smith</a>
                                        <div class="font-size-sm font-italic text-dual">Developer</div>
                                    </div>
                                </div>
                            </div>
                            <!-- END User Info -->

                            <!-- Side Navigation -->
                            <div class="content-side content-side-full">
                                <ul class="nav-main">
                                    <li class="nav-main-item">
                                        <a class="nav-main-link" href="">
                                            <i class="nav-main-link-icon far fa-user-circle"></i>
                                            <span class="nav-main-link-name">My Profile</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link" href="">
                                            <i class="nav-main-link-icon far fa-bell"></i>
                                            <span class="nav-main-link-name">Notifications</span>
                                            <span class="nav-main-link-badge badge badge-pill badge-info">6</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link" href="">
                                            <i class="nav-main-link-icon far fa-envelope-open"></i>
                                            <span class="nav-main-link-name">Messages</span>
                                            <span class="nav-main-link-badge badge badge-pill badge-info">1</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-heading">Home</li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link active" href="db_social_compact.html">
                                            <i class="nav-main-link-icon far fa-newspaper"></i>
                                            <span class="nav-main-link-name">News Feed</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link" href="">
                                            <i class="nav-main-link-icon far fa-gem"></i>
                                            <span class="nav-main-link-name">Marketplace</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-heading">Explore</li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link" href="">
                                            <i class="nav-main-link-icon far fa-calendar-alt"></i>
                                            <span class="nav-main-link-name">Events</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link" href="">
                                            <i class="nav-main-link-icon fa fa-users"></i>
                                            <span class="nav-main-link-name">Groups</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link" href="">
                                            <i class="nav-main-link-icon far fa-file-alt"></i>
                                            <span class="nav-main-link-name">Pages</span>
                                            <span class="nav-main-link-badge badge badge-pill badge-danger">32</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link" href="">
                                            <i class="nav-main-link-icon far fa-images"></i>
                                            <span class="nav-main-link-name">Photos</span>
                                            <span class="nav-main-link-badge badge badge-pill badge-warning">14</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu"
                                           aria-haspopup="true" aria-expanded="false" href="#">
                                            <i class="nav-main-link-icon fa fa-plus"></i>
                                            <span class="nav-main-link-name">More</span>
                                        </a>
                                        <ul class="nav-main-submenu">
                                            <li class="nav-main-item">
                                                <a class="nav-main-link" href="">
                                                    <i class="nav-main-link-icon far fa-clock"></i>
                                                    <span class="nav-main-link-name">On This Day</span>
                                                </a>
                                            </li>
                                            <li class="nav-main-item">
                                                <a class="nav-main-link" href="">
                                                    <i class="nav-main-link-icon far fa-newspaper"></i>
                                                    <span class="nav-main-link-name">Pages Feed</span>
                                                </a>
                                            </li>
                                            <li class="nav-main-item">
                                                <a class="nav-main-link" href="">
                                                    <i class="nav-main-link-icon fa fa-gamepad"></i>
                                                    <span class="nav-main-link-name">Games</span>
                                                    <span
                                                        class="nav-main-link-badge badge badge-pill badge-success">25</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-main-heading">Dashboards</li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link" href="be_pages_dashboard_all.html">
                                            <i class="nav-main-link-icon si si-arrow-left"></i>
                                            <span class="nav-main-link-name">Go Back</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- END Side Navigation -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="simplebar-placeholder" style="width: auto; height: 799px;"></div>
        </div>
        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
        </div>
        <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
        </div>
    </nav>
    <!-- END Sidebar -->

    <!-- Header -->
    <header id="page-header">
        <!-- Header Content -->
        <div class="content-header">
            <!-- Left Section -->

            <!-- END Left Section -->
            <div class="d-flex align-items-center">
                <!-- Logo -->
                <a class="link-fx font-size-lg font-w600 text-white" href="index.html">
                    <span class="text-white-75">Server</span><span class="text-white">List.de</span>
                </a>
                <!-- END Logo -->
            </div>

            <div>
                <a class="btn btn-primary text-white" href="{{ route('servers.list.view') }}">List</a>
                <a class="btn btn-primary text-white" href="{{ route('servers.create.view') }}">Add server</a>
                <a class="btn btn-primary text-white">FAQ</a>
            </div>
            <!-- Right Section -->

            <!-- END Right Section -->
        </div>
        <!-- END Header Content -->

        <!-- Header Search -->
        <div id="page-header-search" class="overlay-header bg-primary">
            <div class="content-header">
                <form class="w-100" action="be_pages_generic_search.html" method="POST">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-primary" data-toggle="layout"
                                    data-action="header_search_off">
                                <i class="fa fa-fw fa-times-circle"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control border-0" placeholder="Search your network.."
                               id="page-header-search-input" name="page-header-search-input">
                    </div>
                </form>
            </div>
        </div>
        <!-- END Header Search -->

        <!-- Header Loader -->
        <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
        <div id="page-header-loader" class="overlay-header bg-primary-darker">
            <div class="content-header">
                <div class="w-100 text-center">
                    <i class="fa fa-fw fa-2x fa-sun fa-spin text-white"></i>
                </div>
            </div>
        </div>
        <!-- END Header Loader -->
    </header>
    <!-- END Header -->

    <!-- Main Container -->
    <main id="main-container">
        @yield('content', '')
    </main>
    <!-- END Main Container -->

    <!-- Footer -->
    <footer id="page-footer" class="footer-static bg-white">
        <div class="content py-4">
            <!-- Footer Navigation -->
            <div class="row items-push font-size-sm border-bottom pt-4">
                <div class="col-6 col-md-4">
                    <h3 class="h5 font-w700">General</h3>
                    <ul class="list list-simple-mini">
                        <li>
                            <a class="font-w600" href="javascript:void(0)">
                                <i class="fa fa-fw fa-globe text-primary-light mr-1"></i> TOS
                            </a>
                        </li>
                        <li>
                            <a class="font-w600" href="javascript:void(0)">
                                <i class="fa fa-fw fa-globe text-primary-light mr-1"></i> Legal Notes
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-6 col-md-4">
                    <h3 class="h5 font-w700">Partner</h3>
                    <ul class="list list-simple-mini">
                        <li>
                            <a class="font-w600" href="javascript:void(0)">
                                <i class="fa fa-fw fa-globe text-primary-light mr-1"></i> REYFM
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h3 class="h5 font-w700">Statistics</h3>
                    <div>
                        <p class="font-w300">
                            Server tracked: <span class="font-weight-bold">{{ \App\Server::count() }}</span><br>
                            Version: <span class="font-weight-bold">1.1</span><br>
                            <?php $votes = 0 ?>
                            @foreach(\App\Server::all() as $server)
                                <?php $votes+=$server->votes ?>
                            @endforeach
                            Global votes: <span class="font-weight-bold">{{ $votes }}</span>
                        </p>
                    </div>
                </div>
            </div>
            <!-- END Footer Navigation -->

            <!-- Footer Copyright -->
            <div class="row font-size-sm pt-4">
                <div class="col-sm-6 order-sm-2 mb-1 mb-sm-0 text-center text-sm-right">
                    {{ env('APP_NAME') }} is not affiliated with TeamSpeak Systems GmbH.
                </div>
                <div class="col-sm-6 order-sm-1 text-center text-sm-left">
                    <a class="font-w600" href="#" target="_blank">{{ env('APP_NAME') }}</a> © <span
                        data-toggle="year-copy" class="js-year-copy-enabled">2019</span>
                </div>
            </div>
            <!-- END Footer Copyright -->
        </div>
    </footer>
    <!-- END Footer -->
</div>

<script src="{{ asset('assets/js/dashmix.core.min.js') }}"></script>
<script src="{{ asset('assets/js/dashmix.app.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/es6-promise/es6-promise.auto.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@include('sweet::alert')

@yield('js_after')
</body>
</html>
