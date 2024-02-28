<!DOCTYPE html>
<html class="no-js">

@include('layouts.header')

<body class="ltr main-body leftmenu">

    <!-- Loader -->
	<div id="global-loader">
		<img src="{{asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
	</div>
	<!-- End Loader -->

    <div class="page">
        <div class="page main-signin-wrapper">
            <!-- Content -->
            @yield('content')
            <!-- End Content -->
        </div>

    </div>

    @include('layouts.script')
</body>

</html>

