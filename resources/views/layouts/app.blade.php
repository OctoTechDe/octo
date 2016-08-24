<!DOCTYPE html>
<html lang="en">
<head>
    <title>Octo</title>

    <!-- META SECTION -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- END META SECTION -->
    <title>Laravel</title>

    <!-- CSS INCLUDE -->
    <link href="/css/styles.css" rel="stylesheet">
    <!-- EOF CSS INCLUDE -->

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<!-- APP WRAPPER -->
<div class="app">

    <!-- START APP CONTAINER -->
    <div class="app-container">
        <!-- START APP HEADER -->
        <div class="app-header">
            <div class="container container-boxed">
                <ul class="app-header-buttons visible-mobile">
                    <li><a href="#" class="btn btn-link btn-icon" data-navigation-horizontal-toggle="true"><span class="icon-menu"></span></a></li>
                </ul>
                <a href="index.html" class="app-header-logo app-header-logo-light app-header-logo-condensed">Project</a>

                <ul class="app-header-buttons pull-right">
                    <li>
                        <div class="contact contact-lg contact-ps-controls">
                            <div class="contact-container">
                                <a href="#">{{ Auth::user()->name }}</a>
                                <span>Administrator</span>
                            </div>
                            <div class="contact-controls">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-default btn-icon" data-toggle="dropdown" aria-expanded="true"><span class="icon-cog"></span></button>
                                    <ul class="dropdown-menu dropdown-left">
                                        <li><a href="#"><span class="icon-portrait"></span> Profil</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#"><span class="icon-exit-right"></span> Log Out</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- END APP HEADER  -->

        <!-- START APP CONTENT -->
        <div class="app-content">
            <div class="app-navigation-horizontal margin-bottom-15">
                <div class="container container-boxed">
                    <nav>
                        <ul>
                            <li class="openable active">
                                <a href="#"><span class="icon-knife"></span> Administration</a>
                                <ul>
                                    <li><a href="pages-bank-main.html">API</a></li>
                                    <li><a href="pages-bank-main.html">Users</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            <!-- START PAGE CONTAINER -->
            <div class="container container-boxed">

                <form class="form-horizontal">
                    <div class="block block-condensed">
                        <div class="app-heading app-heading-small">
                            <div class="title">
                                <h2>API</h2>
                                <p>Personal Access Tokens</p>
                            </div>
                            <div class="heading-elements">
                                <a href="#" class="btn btn-default btn-clean"><span class="icon-key"></span> Create Token</a>
                            </div>
                        </div>
                        <div class="block-content">
                            @yield('content')
                        </div>
                    </div>
                </form>

            </div>
            <!-- END PAGE CONTAINER -->

        </div>
        <!-- END APP CONTENT -->

    </div>
    <!-- END APP CONTAINER -->

</div>
<!-- END APP WRAPPER -->


<!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="/js/theme.js"></script>
</body>
</html>
