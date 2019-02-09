<!DOCTYPE html>
<html lang="ru" class="default-style">
<head>
    <title>CRM v1.0</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;subset=cyrillic,cyrillic-ext" rel="stylesheet">
    <link rel="stylesheet" href="/assets/vendor/fonts/fontawesome.css">
    <link rel="stylesheet" href="/assets/vendor/fonts/ionicons.css">
    <link rel="stylesheet" href="/assets/vendor/fonts/linearicons.css">
    <link rel="stylesheet" href="/assets/vendor/fonts/open-iconic.css">
    <link rel="stylesheet" href="/assets/vendor/fonts/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="/assets/vendor/css/rtl/bootstrap.css" class="theme-settings-bootstrap-css">
    <link rel="stylesheet" href="/assets/vendor/css/rtl/appwork.css" class="theme-settings-appwork-css">
    <link rel="stylesheet" href="/assets/vendor/css/rtl/theme-corporate.css" class="theme-settings-theme-css">
    <link rel="stylesheet" href="/assets/vendor/css/rtl/colors.css" class="theme-settings-colors-css">
    <link rel="stylesheet" href="/assets/vendor/css/rtl/uikit.css">
    <link rel="stylesheet" href="/assets/css/demo.css">
    <script src="/assets/vendor/js/material-ripple.js"></script>
    <script src="/assets/vendor/js/layout-helpers.js"></script>
    <script src="/assets/vendor/js/pace.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css">
</head>
<body>
    <div class="page-loader">
        <div class="bg-primary"></div>
    </div>
    <div class="layout-wrapper layout-2">
        <div class="layout-inner">
            <div id="layout-sidenav" class="layout-sidenav sidenav sidenav-vertical bg-dark">
                <div class="app-brand demo">
                    <span class="app-brand-logo demo bg-primary">
                        <svg viewBox="0 0 148 80" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs><linearGradient id="a" x1="46.49" x2="62.46" y1="53.39" y2="48.2" gradientUnits="userSpaceOnUse"><stop stop-opacity=".25" offset="0"></stop><stop stop-opacity=".1" offset=".3"></stop><stop stop-opacity="0" offset=".9"></stop></linearGradient><linearGradient id="e" x1="76.9" x2="92.64" y1="26.38" y2="31.49" xlink:href="#a"></linearGradient><linearGradient id="d" x1="107.12" x2="122.74" y1="53.41" y2="48.33" xlink:href="#a"></linearGradient></defs><path style="fill: #fff;" transform="translate(-.1)" d="M121.36,0,104.42,45.08,88.71,3.28A5.09,5.09,0,0,0,83.93,0H64.27A5.09,5.09,0,0,0,59.5,3.28L43.79,45.08,26.85,0H.1L29.43,76.74A5.09,5.09,0,0,0,34.19,80H53.39a5.09,5.09,0,0,0,4.77-3.26L74.1,35l16,41.74A5.09,5.09,0,0,0,94.82,80h18.95a5.09,5.09,0,0,0,4.76-3.24L148.1,0Z"></path><path transform="translate(-.1)" d="M52.19,22.73l-8.4,22.35L56.51,78.94a5,5,0,0,0,1.64-2.19l7.34-19.2Z" fill="url(#a)"></path><path transform="translate(-.1)" d="M95.73,22l-7-18.69a5,5,0,0,0-1.64-2.21L74.1,35l8.33,21.79Z" fill="url(#e)"></path><path transform="translate(-.1)" d="M112.73,23l-8.31,22.12,12.66,33.7a5,5,0,0,0,1.45-2l7.3-18.93Z" fill="url(#d)"></path></svg>
                    </span>
                    <a href="{{ route('index') }}" class="app-brand-text demo sidenav-text font-weight-normal ml-2">CRM v1.0</a>
                    <a href="javascript:void(0)" class="layout-sidenav-toggle sidenav-link text-large ml-auto"><i class="ion ion-md-menu align-middle"></i></a>
                </div>
                <div class="sidenav-divider mt-0"></div>
                <ul class="sidenav-inner py-1">
                    <li class="sidenav-item{{ ((Route::currentRouteName() == 'index') ? ' active' : '') }}"><a href="{{ route('index') }}" class="sidenav-link"><i class="sidenav-icon ion ion-ios-home"></i><div>Главная</div></a></li>
                    <li class="sidenav-divider mb-1"></li>
                    <li class="sidenav-header small font-weight-semibold">Номенклатура</li>
                    <li class="sidenav-item{{ ((Route::currentRouteName() == 'categories') ? ' active' : '') }}"><a href="{{ route('categories') }}" class="sidenav-link"><i class="sidenav-icon ion ion-ios-journal"></i><div>Категории</div></a></li>
                    <li class="sidenav-item{{ ((Route::currentRouteName() == 'goods') ? ' active' : '') }}"><a href="{{ route('goods') }}" class="sidenav-link"><i class="sidenav-icon ion ion-md-cube d-block"></i><div>Товары</div></a></li>
                    <li class="sidenav-header small font-weight-semibold">Склады</li>
                    <li class="sidenav-item{{ ((Route::currentRouteName() == 'providers') ? ' active' : '') }}"><a href="{{ route('providers') }}" class="sidenav-link"><i class="sidenav-icon ion ion-md-bookmarks d-block"></i><div>Поставщики</div></a></li>
                    <li class="sidenav-item{{ ((Route::currentRouteName() == 'stocks') ? ' active' : '') }}"><a href="{{ route('stocks') }}" class="sidenav-link"><i class="sidenav-icon ion ion-ios-archive d-block"></i><div>Склады</div></a></li>
                    <li class="sidenav-item{{ ((Route::currentRouteName() == 'purchases') ? ' active' : '') }}"><a href="{{ route('purchases') }}" class="sidenav-link"><i class="sidenav-icon ion ion-md-archive d-block"></i><div>Приходы</div></a></li>
                    <li class="sidenav-header small font-weight-semibold">Торговля</li>
                    <li class="sidenav-item{{ ((Route::currentRouteName() == 'currencies') ? ' active' : '') }}"><a href="{{ route('currencies') }}" class="sidenav-link"><i class="sidenav-icon ion ion-ios-cash d-block"></i><div>Валюты</div></a></li>
                    <li class="sidenav-item{{ ((Route::currentRouteName() == 'orders') ? ' active' : '') }}"><a href="{{ route('orders') }}" class="sidenav-link"><i class="sidenav-icon ion ion-md-appstore d-block"></i><div>Заказы</div></a></li>
                    <li class="sidenav-item{{ ((Route::currentRouteName() == 'clients') ? ' active' : '') }}"><a href="{{ route('clients') }}" class="sidenav-link"><i class="sidenav-icon ion ion ion-ios-people d-block"></i><div>Клиенты</div></a></li>
                    <li class="sidenav-header small font-weight-semibold">Логистика</li>
                    <li class="sidenav-item{{ ((Route::currentRouteName() == 'sends') ? ' active' : '') }}"><a href="{{ route('sends') }}" class="sidenav-link"><i class="sidenav-icon ion ion-md-log-out d-block"></i><div>Отправки</div></a></li>
                </ul>
            </div>
            <div class="layout-container">
                <nav class="layout-navbar navbar navbar-expand-lg align-items-lg-center bg-white container-p-x" id="layout-navbar">
                    <a href="{{ route('index') }}" class="navbar-brand app-brand demo d-lg-none py-0 mr-4">
                        <span class="app-brand-logo demo bg-primary"><svg viewBox="0 0 148 80" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs><linearGradient id="a" x1="46.49" x2="62.46" y1="53.39" y2="48.2" gradientUnits="userSpaceOnUse"><stop stop-opacity=".25" offset="0"></stop><stop stop-opacity=".1" offset=".3"></stop><stop stop-opacity="0" offset=".9"></stop></linearGradient><linearGradient id="e" x1="76.9" x2="92.64" y1="26.38" y2="31.49" xlink:href="#a"></linearGradient><linearGradient id="d" x1="107.12" x2="122.74" y1="53.41" y2="48.33" xlink:href="#a"></linearGradient></defs><path style="fill: #fff;" transform="translate(-.1)" d="M121.36,0,104.42,45.08,88.71,3.28A5.09,5.09,0,0,0,83.93,0H64.27A5.09,5.09,0,0,0,59.5,3.28L43.79,45.08,26.85,0H.1L29.43,76.74A5.09,5.09,0,0,0,34.19,80H53.39a5.09,5.09,0,0,0,4.77-3.26L74.1,35l16,41.74A5.09,5.09,0,0,0,94.82,80h18.95a5.09,5.09,0,0,0,4.76-3.24L148.1,0Z"></path><path transform="translate(-.1)" d="M52.19,22.73l-8.4,22.35L56.51,78.94a5,5,0,0,0,1.64-2.19l7.34-19.2Z" fill="url(#a)"></path><path transform="translate(-.1)" d="M95.73,22l-7-18.69a5,5,0,0,0-1.64-2.21L74.1,35l8.33,21.79Z" fill="url(#e)"></path><path transform="translate(-.1)" d="M112.73,23l-8.31,22.12,12.66,33.7a5,5,0,0,0,1.45-2l7.3-18.93Z" fill="url(#d)"></path></svg></span>
                        <span class="app-brand-text demo font-weight-normal ml-2">CRM v1.0</span>
                    </a>
                    <div class="layout-sidenav-toggle navbar-nav d-lg-none align-items-lg-center mr-auto">
                        <a class="nav-item nav-link px-0 mr-lg-4" href="javascript:void(0)">
                            <i class="ion ion-md-menu text-large align-middle"></i>
                        </a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#layout-navbar-collapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="navbar-collapse collapse" id="layout-navbar-collapse">
                        <hr class="d-lg-none w-100 my-2">
                        <div class="navbar-nav align-items-lg-center">
                            <label class="nav-item navbar-text navbar-search-box p-0 active">
                                <i class="ion ion-ios-search navbar-icon align-middle"></i>
                                <span class="navbar-search-input pl-2">
                                    <input type="text" class="form-control navbar-text mx-2" placeholder="Найти..." style="width:200px">
                                </span>
                            </label>
                        </div>
                        <div class="navbar-nav align-items-lg-center ml-auto">
                            <div class="demo-navbar-user nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                                    <span class="d-inline-flex flex-lg-row-reverse align-items-center align-middle">
                                        {{--<img src="assets/img/avatars/1.png" alt class="d-block ui-w-30 rounded-circle">--}}
                                        <span class="px-1 mr-lg-2 ml-2 ml-lg-0">{{ Auth::user()->email }}</span>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="javascript:void(0)" class="dropdown-item"><i class="ion ion-ios-person text-lightest"></i> &nbsp; Профиль</a>                            
                                    <div class="dropdown-divider"></div>
                                    <a href="{{ route('logout') }}" class="dropdown-item"><i class="ion ion-ios-log-out text-danger"></i> &nbsp; Выход</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
                <div class="layout-content">
                    @yield('content')                    
                    <nav class="layout-footer footer bg-footer-theme">
                        <div class="container-fluid d-flex flex-wrap justify-content-between text-center container-p-x pb-3">
                            <div class="pt-3">
                                <span class="footer-text font-weight-bolder">CRM v1.0</span> ©
                            </div>                            
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <div class="layout-overlay layout-sidenav-toggle"></div>
    </div>
    <script src="/assets/vendor/libs/popper/popper.js"></script>
    <script src="/assets/vendor/js/bootstrap.js"></script>
    <script src="/assets/vendor/js/sidenav.js"></script>
    <script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="/assets/vendor/libs/chartjs/chartjs.js"></script>
    <script src="/assets/js/demo.js"></script>
    @yield('js')
</body>
</html>