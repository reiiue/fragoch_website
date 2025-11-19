<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Fragoch Tourist Inn')</title>
    <meta name="description" content="@yield('description', 'Experience luxury at its finest. Book your perfect getaway at our 5-star hotel.')">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" rel="stylesheet" />
    <!-- Bootstrap Icon Picker CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-iconpicker@1.10.0/dist/css/bootstrap-iconpicker.min.css">

    
    <!-- Your global CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body class="font-sans antialiased">

    <!-- Page Content -->
    @yield('content')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icon Picker JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-iconpicker@1.10.0/dist/js/bootstrap-iconpicker.bundle.min.js"></script>

    <!-- Optional Analytics script -->
    @stack('scripts')
</body>
</html>
