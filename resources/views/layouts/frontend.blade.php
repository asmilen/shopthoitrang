<!DOCTYPE html>
<html>
<head>
    @include('frontend.partials.head')
</head>
<body>
	@include('frontend.partials.header')

	@yield('content')

	<div class="footer">
		@include('frontend.partials.footer')
	</div>

	@include('frontend.partials.scripts')
	@include('flash-message::sweetalert')
</body>
</html>