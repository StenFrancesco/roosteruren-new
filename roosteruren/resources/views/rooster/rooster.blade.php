<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Rooster pagina</title>
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
	<body>
		<div id="app"><example-component></example-component></div>
		<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
	</body>
</html>
