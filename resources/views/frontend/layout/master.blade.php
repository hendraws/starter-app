@include('frontend.layout.header')
@include('frontend.layout.navbar')
<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-8">
					<!-- row -->
					<div class="row">
					@yield('content')

					</div>
					<!-- /row -->

				</div>
				<div class="col-md-4">

					<!-- widget  -->
					@include('frontend.layout.widget')

				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

    @include('frontend.layout.footer')
