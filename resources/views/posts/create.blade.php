<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Posts</title>
</head>

<body>
	<a href="/posts">Home</a>
	<form action="/api/posts/create" method="post">
		{{csrf_field()}}
		<input type="hidden" name="user_id" value="{{Auth::id()}}">
		<input type="text" placeholder="Enter title" name="title" autofocus="true">
		<input type="text" placeholder="Enter body" name="body" autofocus="true">
		<input type="submit" value="Submit">
	</form>

</body>

</html>