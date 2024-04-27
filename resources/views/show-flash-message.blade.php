<!-- resources/views/show-flash-message.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Flash Message</title>
</head>
<body>
    @if (session()->has('message'))
        <div>{{ session('message') }}</div>
    @else
        <div>No flash message available.</div>
    @endif
</body>
</html>
