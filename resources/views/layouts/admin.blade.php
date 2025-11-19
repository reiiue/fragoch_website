<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title', 'Dashboard')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    @stack('styles')

    <style>
        body {
            overflow-x: hidden;
        }


        .content {
            flex-grow: 1;
            padding: 2rem;
            background: #f8f9fa;
        }
    </style>
</head>

<body>
<div class="d-flex">

@include('layouts.sidebar')



    <!-- Main Content -->
    <div class="content">
        @yield('content')
    </div>

</div>

<!-- Bootstrap + Lucide -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>


@stack('scripts')
</body>
</html>
