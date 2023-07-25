<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Edu Afya') }}</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/datatables.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/feather/feather.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                <a href="index.html" class="logo">
                    <img src="{{ asset('assets/img/favicon.png')}}" width="35" height="35" alt=""> <span><img src="{{ asset('assets/img/small-logo.png')}}" width="95" height="25" alt=""></span>
                </a>
            </div>
        </div>
        <div class="container" style="padding-top: 100px;">
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="blog-view">
                            <article class="blog blog-single-post">
                                <h3 class="blog-title">ABOUT US</h3>
                                <div class="blog-content">
                                    <p>An online platform aimed at providing medical education through a series of educational videos and give a quick access to medical Doctors from various fields.</p>
                                </div>
                            </article>
                            <article class="blog blog-single-post">
                                <h3 class="blog-title">DISCLAIMER</h3>
                                <div class="blog-content">
                                    <p>All content and media published on the Edu Afya App is meant solely for educational purposes while observing the following;</p>
                                    <ol>
                                        <li>It should not be taken as personal medical advice or substitute for professional medical advice, diagnosis or treatment.</li>
                                        <li>If you have any questions regarding your own medical condition you are advised to consult your medical health provider.</li>
                                        <li>You should in no circumstance delay, disregard or discontinue professional medical advice basing on the information given on this application.</li>
                                        <li>In case of a medical emergency it is proper to seek immediate medical attention from the nearby medical centers; if you choose to rely on information given on this application then please do it at your own risk.</li>
                                        <li>The online interactive sessions with our medical professionals are based on the information provided by you and in the absence of a proper physical evaluation. Hence the advice or diagnosis given is only provisional and limited and may therefore be inconclusive.</li>
                                        <li>The online interactive sessions with our medical professionals are not meant to replace the physical sessions with health care professionals.</li>
                                        <li>Due to the limitations mentioned above regarding the online interactive sessions, the application does not guarantee any positive outcome regarding your own diagnosis or recommended treatment.</li>
                                    </ol>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}"></script>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/js/feather.min.js') }}"></script>

    <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>

    <script src="{{ asset('assets/js/select2.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>

    <script src="{{ asset('assets/js/jquery.waypoints.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexchart/chart-data.js') }}"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>