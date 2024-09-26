<!DOCTYPE html>
<html lang="en">
	<head>

		
		@include('layout.css')

	</head>

	<body class="main-body app sidebar-mini dark-theme">

		<!-- Loader -->
		<div id="global-loader">
			<img src="{{asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		<!-- /Loader -->

		<!-- Page -->
		<div class="page" >
            <div class="app-sidebar__overlay" data-toggle="sidebar"></div>

				@include('layout.sidbar')

				<!-- main-content -->
				<div class="main-content app-content">

					@include('layout.header')

					<!-- container -->
					@yield('content')
					<!-- /Container -->
				</div>
				
				<!-- /main-content -->
				<!-- /Container -->
			</div>
			<!-- /main-content -->

			<!-- Sidebar-right-->

                {{-- @include('layout.sidebar_2') --}}
				
			<!--/Sidebar-right-->

		

			<!-- Footer opened -->
                @include('layout.footer')
			<!-- Footer closed -->

		</div>
		<!-- End Page -->

		<!-- Back-to-top -->
		<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>
		
        @include('layout.js')

	</body>
</html>