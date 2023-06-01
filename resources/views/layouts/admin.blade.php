<!doctype html>
<html lang="en">

<head>
	<title>@yield('title')</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
    @stack('up-style')
    @include('includes.style')
    @stack('down-style')
</head>

<body>
	<!-- WRAPPER -->
<div id="wrapper">
    <!-- NAVBAR -->
    @include('includes.navbar')
    <!-- END NAVBAR -->
    <!-- LEFT SIDEBAR -->
    @include('includes.sidebar')
    <!-- END LEFT SIDEBAR -->
    <!-- MAIN -->
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
           
            @yield('content')

        </div>
        <!-- END MAIN CONTENT -->
    </div>
    <!-- END MAIN -->
    <div class="clearfix"></div>
    @include('includes.footer')
</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	@stack('up-script')
    @include('includes.script')
    @stack('down-script')
    @include('sweetalert::alert')
</body>

</html>
