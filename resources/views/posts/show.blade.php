<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Post</title>
</head>

<body>
	<a href="/posts">Home</a>
	<form action="/posts/update" method="post">
		{{ csrf_field() }}
		<input type="hidden" value="{{$post->id}}" name="id">
		<input type="text" value="{{$post->title}}" name="title">
		<input type="text" value="{{$post->body}}" name="body">
		<input type="submit" value="Update">
	</form>

	<a href="/posts/{{$post->id}}/delete">Delete</a>
</body>

</html>