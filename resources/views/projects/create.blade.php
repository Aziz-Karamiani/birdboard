<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BirdBoard</title>
</head>
<body>
<div class="container">
    <form action="/projects" method="POST" class="container form-control">
        @csrf
        <label>
            <input name="title">
        </label>
        <label>
            <textarea name="description" placeholder="description"></textarea>
        </label>
        <button class="submit" type="submit">Submit</button>
    </form>
</div>
</body>
</html>
