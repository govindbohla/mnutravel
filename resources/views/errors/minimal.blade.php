{{--
    Deliberately self-contained (no DB queries, no FrontLayoutComposer)
    since these pages must still render if the database itself is why
    the request failed.
--}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} - MNU Travels</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #F8FAFC; color: #222222; }
        .error-wrapper { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 2rem 1rem; }
        .error-code { font-size: 5rem; font-weight: 700; color: #1E4DB7; line-height: 1; }
        .btn-primary { background-color: #1E4DB7; border-color: #1E4DB7; }
        .btn-primary:hover { background-color: #D72638; border-color: #D72638; }
    </style>
</head>
<body>
    <div class="error-wrapper">
        <div class="text-center">
            <img src="/assets/img/logo.png" alt="MNU Travels" style="max-width: 100px;" class="mb-4">
            <div class="error-code">{{ $code }}</div>
            <h1 class="h4 mb-2">{{ $title }}</h1>
            <p class="text-muted mb-4">{{ $message }}</p>
            <a href="/" class="btn btn-primary">Back to Home</a>
        </div>
    </div>
</body>
</html>
