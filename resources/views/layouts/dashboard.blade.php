<!doctype html>

<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
    <link rel="icon" type="image/png" href="images/DB_16х16.png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test 1</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">


    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">


    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--
    <link rel="canonical" href="http://www.example.com/">
    -->
    <style>
        .required:after {
          content:" *";
          color: red;
        }
    </style>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,500,300,100,700,900' rel='stylesheet'
        type='text/css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- inject:css -->
    <link rel="stylesheet" href="css/lib/getmdl-select.min.css">
    <link rel="stylesheet" href="css/lib/nv.d3.min.css">
    <link rel="stylesheet" href="css/application.min.css">
    <!-- endinject -->
     @include('layouts.yajra')

</head>

<body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header is-small-screen">
        <header class="mdl-layout__header">
            <div class="mdl-layout__header-row">
                <div class="mdl-layout-spacer"></div>

                <div class="avatar-dropdown" id="icon">
                    <span>{{ Auth::user()->name }}</span>
                    <img src="images/Icon.png">
                </div>
                <!-- Account dropdawn-->
                <ul class="mdl-menu mdl-list mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect mdl-shadow--2dp account-dropdown"
                    for="icon">
                    <li class="mdl-list__item mdl-list__item--two-line">
                        <span class="mdl-list__item-primary-content">
                            <span class="material-icons mdl-list__item-avatar"></span>
                            <span>{{ Auth::user()->name }}</span>
                            <span class="mdl-list__item-sub-title">{{ Auth::user()->email }}</span>
                        </span>
                    </li>

                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <li class="mdl-menu__item mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-icon text-color--secondary">exit_to_app</i>
                                Log out
                            </span>
                        </li>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>

            </div>
        </header>

        <div class="mdl-layout__drawer">
            <header>TEST 1</header>
            <div class="scroll__wrapper" id="scroll__wrapper">
                <div class="scroller" id="scroller">
                    <div class="scroll__container" id="scroll__container">
                        <nav class="mdl-navigation">
                            <a class="mdl-navigation__link {{ Route::currentRouteName() == 'home' ? 'mdl-navigation__link--current' : '' }}" href="{{ route('home') }}">
                                <i class="material-icons" role="presentation">dashboard</i>
                                Dashboard
                            </a>
                            <a class="mdl-navigation__link {{ Route::currentRouteName() == 'company' ? 'mdl-navigation__link--current' : '' }}" href="{{ route('company') }}">
                                <i class="material-icons" role="presentation">work</i>
                                Company
                            </a>
                            <a class="mdl-navigation__link {{ Route::currentRouteName() == 'employee' ? 'mdl-navigation__link--current' : '' }}" href="{{ route('employee') }}">
                                <i class="material-icons" role="presentation">person</i>
                                Employee
                            </a>
                            <div class="mdl-layout-spacer"></div>
                            <hr>

                        </nav>
                    </div>
                </div>

            </div>
        </div>

        <main class="mdl-layout__content">

            <div class="mdl-grid mdl-grid--no-spacing dashboard">

                <div
                    class="mdl-grid mdl-cell mdl-cell--9-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone mdl-cell--top">

                    @yield('content')

                </div>
            </div>

        </main>

    </div>
    @yield('modal')
    <!-- inject:js -->
    <script src="js/d3.min.js"></script>
    <script src="js/getmdl-select.min.js"></script>
    <script src="js/material.min.js"></script>
    <script src="js/nv.d3.min.js"></script>
    <script src="js/layout/layout.min.js"></script>
    <script src="js/scroll/scroll.min.js"></script>
    <script src="js/widgets/charts/discreteBarChart.min.js"></script>
    <script src="js/widgets/charts/linePlusBarChart.min.js"></script>
    <script src="js/widgets/charts/stackedBarChart.min.js"></script>
    <script src="js/widgets/employer-form/employer-form.min.js"></script>
    <script src="js/widgets/line-chart/line-charts-nvd3.min.js"></script>
    <script src="js/widgets/map/maps.min.js"></script>
    <script src="js/widgets/pie-chart/pie-charts-nvd3.min.js"></script>
    <script src="js/widgets/table/table.min.js"></script>
    <script src="js/widgets/todo/todo.min.js"></script>

    @yield('script')
    <!-- endinject -->

    
</body>

</html>
