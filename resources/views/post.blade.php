<!DOCTYPE html>

<title>My Blog</title>
<link rel="stylesheet" href="/app.css">

<body>
    <article>
        <h1>
            {{ $post->title }}
        </h1>

        <div>
            <!-- Use this if you dont want to escape the text.
            Take caution cause Laravel wont escape or handle this if it has issues -->
            {!! $post->body !!}
        </div>
    </article>

    <a href="/">Go back</a>
</body>