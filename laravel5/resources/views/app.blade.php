<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Navicon and tittle -->
	<link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon; charset=binary">
	<title>Universidad Nacional de Colombia: Preprocessing UnalMed</title>

	<!-- CSS -->
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/lightbox.min.css') }}">
    
    <!-- Unal CSS -->
	<link rel="stylesheet" href="{{ asset('css/unal.css') }}" media="all"> 
	<link rel="stylesheet" href="{{ asset('css/base.css') }}" media="all"> 
	<link rel="stylesheet" href="{{ asset('css/form.css') }}" media="all">
	<link rel="stylesheet" href="{{ asset('css/reset.css') }}" media="all"> 
	
	<!-- Custom CSS -->
	<link rel="stylesheet" href="{{ asset('css/custom.css') }}"media="all">
	
	<!-- Responsive CSS -->
	<link rel="stylesheet" href="{{ asset('css/small.css') }}" media="only screen and (max-width: 767px)"> 	
	<link rel="stylesheet" href="{{ asset('css/phone.css') }}" media="only screen and (min-width: 768px) and (max-width: 991px)"> 
	<link rel="stylesheet" href="{{ asset('css/tablet.css') }}"  media="only screen and (min-width: 992px) and (max-width: 1199px)">

	<!--<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>-->
	
	<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>  	
	<script type="text/javascript" src="{{ asset('js/jquery-ui.js') }}"></script>
	
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"> -->

	<script type="text/javascript">
		var baseUrl = "{{ url('/') }}";
	</script>
</head>
<body>
	<!-- Header -->
	@include('components.header')
	<!-- Services -->
	@include('components.services')

	@yield('content')
	
	<!-- Footer -->
	@include('components.footer')

	<!-- Scripts
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script> -->

	<!--<script type="text/javascript" src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>-->
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  	
	<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/bootstrap-select.min.js') }}"></script>
	
	<!-- Unal Javascript -->
	<script type="text/javascript" src="{{ asset('js/unal.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/respond.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/lightbox.min.js') }}"></script>

	<!-- Custom Javascript -->
	<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>





</body>
</html>
