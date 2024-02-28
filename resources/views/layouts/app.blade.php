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
		<!-- Main Header-->
            @include('layouts.nav')
		<!-- End Main Header-->

        <!-- Sidebar -->
        @include('layouts.sidebar')
		<!-- End Sidebar -->

        <div class="main-content side-content pt-0">

            {{-- toster start --}}
            @if(session()->has('SUCCESS_MESSAGE'))
                <div class="alert alert-success fade show m-2" role="alert">
                    <span class="alert-inner--icon"><i class="fe fe-bell"></i></span>
                    <span class="alert-inner--text">{{ session()->get('SUCCESS_MESSAGE') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif
            @if(session()->has('ERROR_MESSAGE'))
                <div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
                    <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
                    <span class="alert-inner--text">{{ session()->get('ERROR_MESSAGE') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif
            {{-- toster end --}}

            <!-- Content -->
            @yield('content')
            <!-- End Content -->
        </div>

		<!-- Main Footer-->
            @include('layouts.footer')
		<!--End Footer-->

    </div>

    @include('layouts.script')
</body>

</html>
