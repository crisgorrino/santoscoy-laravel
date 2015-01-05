@section('meta')
	<meta charset="utf-8">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
	<!--<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">-->
	<meta name="description" content="Arquitectos Guadalajara" >
	<meta property="og:site_name" content="Santoscoy" name="application-name">
	<meta property="og:title" content="@yield('meta-og-title')" name="application-name">
	<meta property="og:type" content="website" name="application-name">
	<meta property="og:url" content="{{ url('') }}" name="application-name">
	<meta property="og:image" content="{{ asset('img/logo.jpg') }}" name="application-name">
@show

	<title>Santoscoy - @section('title')Arquitectos @show</title>

@section('style')
	<link rel="stylesheet" href="{{ asset('styles/main.css') }}" type="text/css" media="all">
@show