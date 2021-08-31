<?php
use Illuminate\Support\Facades\Route;
$text = "Hello, User!";
$title = "Hello page";


Route::get('/', function () use($text, $title) {
    return <<<php
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>$title</title>
</head>
<body>
    <h1>$text</h1>
</body>
</html>
php;
});

Route::get('/info', function () {
    phpinfo();
});

Route::get('/news', function () {
    return <<<php
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>News</title>
</head>
<body>
    <div>
        <h1>Some news</h1>
        <ul>
            <li>News</li>
            <li>Other news</li>
            <li>And news</li>
        </ul>
    </div>
</body>
</html>
php;
});
