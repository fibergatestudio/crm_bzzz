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
    <script src="assets/vendor/js/pace.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="/assets/vendor/css/pages/authentication.css">
</head>
<body>
    <div class="page-loader">
        <div class="bg-primary"></div>
    </div>
    <div class="authentication-wrapper authentication-2 ui-bg-cover ui-bg-overlay-container px-4" style="background-image: url('/assets/img/bg/21.jpg');">
        <div class="ui-bg-overlay bg-dark opacity-25"></div>
        <div class="authentication-inner py-5">
            <div class="card">
                <div class="p-4 p-sm-5">
                    <div class="d-flex justify-content-center align-items-center pb-2 mb-4">
                        <div class="ui-w-60">
                            <div class="w-100 position-relative" style="padding-bottom: 54%">
                                <svg class="w-100 h-100 position-absolute" viewBox="0 0 148 80" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs><linearGradient id="a" x1="46.49" x2="62.46" y1="53.39" y2="48.2" gradientUnits="userSpaceOnUse"><stop stop-opacity=".25" offset="0"></stop><stop stop-opacity=".1" offset=".3"></stop><stop stop-opacity="0" offset=".9"></stop></linearGradient><linearGradient id="e" x1="76.9" x2="92.64" y1="26.38" y2="31.49" xlink:href="#a"></linearGradient><linearGradient id="d" x1="107.12" x2="122.74" y1="53.41" y2="48.33" xlink:href="#a"></linearGradient></defs><path class="fill-primary" transform="translate(-.1)" d="M121.36,0,104.42,45.08,88.71,3.28A5.09,5.09,0,0,0,83.93,0H64.27A5.09,5.09,0,0,0,59.5,3.28L43.79,45.08,26.85,0H.1L29.43,76.74A5.09,5.09,0,0,0,34.19,80H53.39a5.09,5.09,0,0,0,4.77-3.26L74.1,35l16,41.74A5.09,5.09,0,0,0,94.82,80h18.95a5.09,5.09,0,0,0,4.76-3.24L148.1,0Z"></path><path transform="translate(-.1)" d="M52.19,22.73l-8.4,22.35L56.51,78.94a5,5,0,0,0,1.64-2.19l7.34-19.2Z" fill="url(#a)"></path><path transform="translate(-.1)" d="M95.73,22l-7-18.69a5,5,0,0,0-1.64-2.21L74.1,35l8.33,21.79Z" fill="url(#e)"></path><path transform="translate(-.1)" d="M112.73,23l-8.31,22.12,12.66,33.7a5,5,0,0,0,1.45-2l7.3-18.93Z" fill="url(#d)"></path></svg>
                            </div>
                        </div>
                    </div>
                    <h5 class="text-center text-muted font-weight-normal mb-4">Авторизация</h5>
                    @if (session('status'))
                        <p style="text-align: center; color: crimson;">Пользователь с такими учётными данными не найден</p>
                    @endif
                    <form action="{{ route('auth') }}" method="post">
                        <div class="form-group">
                            <label for="mail" class="form-label">Email</label>
                            <input id="mail" name="mail" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label d-flex justify-content-between align-items-end">
                                <div>Пароль</div>
                                {{--<a href="javascript:void(0)" class="d-block small">Forgot password?</a>--}}
                            </label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                        <div class="d-flex justify-content-between align-items-center m-0">
                            <label class="custom-control custom-checkbox m-0">
                                <input name="remember" type="checkbox" class="custom-control-input" value="1" checked="checked">
                                <span class="custom-control-label">Запомнить меня</span>
                            </label>
                            <button type="submit" class="btn btn-primary">Войти</button>
                        </div>
                    </form>          
                </div>
                {{--<div class="card-footer py-3 px-4 px-sm-5">
                    <div class="text-center text-muted">
                        Don't have an account yet? <a href="javascript:void(0)">Sign Up</a>
                    </div>
                </div>--}}
            </div>
        </div>
    </div>
    <script src="/assets/vendor/libs/popper/popper.js"></script>
    <script src="/assets/vendor/js/bootstrap.js"></script>
    <script src="/assets/vendor/js/sidenav.js"></script>
    <script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="/assets/js/demo.js"></script>
</body>
</html>