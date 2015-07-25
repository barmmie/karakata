<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
        <h1>Thanks for signing up</h1>

<p>We just need you to <a href='{{url("register/confirm/{$user->confirmation_token}")}}'></a>confirm your email address real quick</p>
</body>
</html>