<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css')}}">

</head>

<body>
    @include('layout.admin-layout.sidebar')

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="header">
            <button class="toggle-sidebar">
                <i class="fas fa-bars"></i>
            </button>
            <div class="user-info">
                <div>
                    <h4>{{ Auth::guard('admins')->user()->name ?? 'Admin User' }}</h4>
                </div>
            </div>
        </header>
        <!-- Page Title -->
        @hasSection('page-title')
        <div class="page-title">
            @yield('page-title')
        </div>
        @endif

        <!-- Content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- Footer -->
        <footer class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved. </p>
        </footer>
    </div>

    <!-- JavaScript -->
    @stack('scripts')
    <script>
    document.querySelector('.toggle-sidebar')?.addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('active');
    });
    document.addEventListener('click', function(event) {
        const sidebar = document.querySelector('.sidebar');
        const toggleBtn = document.querySelector('.toggle-sidebar');

        if (window.innerWidth <= 768 &&
            !sidebar.contains(event.target) &&
            !toggleBtn.contains(event.target) &&
            sidebar.classList.contains('active')) {
            sidebar.classList.remove('active');
        }
    });

    // Active navigation link
    document.querySelectorAll('.nav-links a').forEach(link => {
        link.addEventListener('click', function(e) {
            // Close sidebar on mobile after clicking a link
            if (window.innerWidth <= 768) {
                document.querySelector('.sidebar').classList.remove('active');
            }
        });
    });

    // Auto-hide alerts after 5 seconds
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => {
                alert.remove();
            }, 500);
        });
    }, 5000);
    </script>
</body>

</html>