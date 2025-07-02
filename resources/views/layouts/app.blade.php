<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libretto Book Review System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Libretto</a>
            <div class="navbar-nav">
                <a class="nav-link" href="/authors">Authors</a>
                <a class="nav-link" href="/genres">Genres</a>
                <a class="nav-link" href="/books">Books</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>