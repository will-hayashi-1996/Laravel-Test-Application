<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @routes <!-- Add this line -->
</head>
<body>
    <div id="app" data-page="{{ json_encode($page) }}"></div>
</body>
</html>