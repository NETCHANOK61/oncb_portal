<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting...</title>
</head>
<body onload="document.forms['redirectForm'].submit()">
    <form name="redirectForm" action="{{ $redirectUrl }}" method="POST">
        @csrf
        <input type="hidden" name="data" value="{{ json_encode($data) }}">
        <noscript>
            <input type="submit" value="Click here if you are not redirected">
        </noscript>
    </form>
</body>
</html>
