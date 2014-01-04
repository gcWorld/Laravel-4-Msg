<!DOCTYPE html>
<html lang="de-DE">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Neue Nachricht</h2>

		<div>
			Du hast eine neue Nachricht von {{ $author }}.<br>
			<hr>
			<h3>{{ $sub }}</h3>
			{{ $mess }}
			<hr>

			<a href="{{ URL::to('msg/show/'.$id) }}">{{ URL::to('msg/show/'.$id) }}</a>
		</div>
	</body>
</html>