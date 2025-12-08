<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Penagihan Hutang')</title>

    {{-- BOOTSTRAP CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- GOOGLE FONT --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    {{-- CUSTOM STYLE --}}
    <style>
        body {
            background: linear-gradient(135deg, #d1eaff, #f7faff);
            font-family: 'Poppins', sans-serif;
        }

        /* SIDEBAR */
        #sidebar {
            position: fixed;
            top: 0;
            left: -260px;
            width: 250px;
            height: 100%;
            background: white;
            padding: 20px;
            box-shadow: 3px 0 15px rgba(0,0,0,0.1);
            transition: 0.3s ease;
            z-index: 999;
            border-top-right-radius: 18px;
            border-bottom-right-radius: 18px;
        }
        #sidebar.show {
            left: 0;
        }

        /* OVERLAY */
        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.4);
            display: none;
            z-index: 998;
        }

        nav {
            background: #4982deff;
            color: white;
            font-size: 22px;
            padding: 15px 25px;
            font-weight: 700;
            border-bottom-left-radius: 18px;
            border-bottom-right-radius: 18px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .hamburger {
    font-size: 28px;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.hamburger.active {
    transform: rotate(180deg);
}

    </style>
</head>

<body>

   {{-- SIDEBAR --}}
<div id="sidebar">

    {{-- HAMBURGER INSIDE SIDEBAR --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <span class="hamburger" onclick="toggleSidebar()" style="font-size: 26px; cursor:pointer;">
            ☰
        </span>
    </div>

    <a href="{{ route('dashboard') }}" class="d-block mb-3 fw-semibold text-decoration-none">
        Dashboard
    </a>

    <a href="{{ route('customers.index') }}" class="d-block mb-3 fw-semibold text-decoration-none">
        Kelola Debitur
    </a>
</div>


    {{-- OVERLAY --}}
    <div id="overlay" onclick="toggleSidebar()"></div>

    {{-- NAVBAR --}}
    <nav>
        <span class="hamburger" onclick="toggleSidebar()">☰</span>
        Aplikasi Penagihan Hutang
    </nav>

    {{-- PAGE CONTENT --}}
    <div class="container mt-4">
        @yield('content')
    </div>

    {{-- BOOTSTRAP JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- SIDEBAR SCRIPT --}}
    <script>
           function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const hamburgers = document.querySelectorAll('.hamburger');

    sidebar.classList.toggle('show');

    if (sidebar.classList.contains('show')) {
        overlay.style.display = 'block';

        // PUTAR semua hamburger (navbar & sidebar)
        hamburgers.forEach(h => h.classList.add('active'));

    } else {
        overlay.style.display = 'none';

        // KEMBALIKAN ke normal
        hamburgers.forEach(h => h.classList.remove('active'));
    }
}

    </script>

</body>
</html>
