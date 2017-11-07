<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Posts</title>
</head>

<body>
	<ul>
		@foreach($posts as $post)
		<li>
			<h1>{{$post->title}}</h1>
			<a href="/posts/{{$post->id}}">{{$post->body}}</a>
		</li>
		@endforeach
	</ul>

	<h1>Create post</h1>
	<a href="/posts/create">Create</a>
	<hr>

	<h1>Delete by Title</h1>
	<form action="/posts/delete-by-title" method="post">
		{{ csrf_field() }}
		<input type="text" name="title" placeholder="Enter title">
		<input type="submit" value="Delete By Title">
	</form>
	<hr>

	<h1>Find by Field</h1>
	<form action="/posts/find-by-title" method="post">
		{{ csrf_field() }}
		<input type="text" name="title" placeholder="Enter title">
		<input type="submit" value="Find By Title">
	</form>
</body>

</html>