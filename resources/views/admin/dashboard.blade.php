<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside>
            <div class="top">
                <div class="logo">
                    <h2>E-<span class="danger">Litera</span></h2>
                </div>
                <div class="close" id="close_btn">
                    <span class="material-symbols-sharp">close</span>
                </div>
            </div>
            <div class="sidebar">
                <a href="#" class="active">
                    <span class="material-symbols-sharp">grid_view</span>
                    <h3>Dashbord</h3>
                </a>
                <a href="#" data-target="mentor-apply">
                    <span class="material-symbols-sharp">person_outline</span>
                    <h3>Mentor Apply</h3>
                </a>
                <a href="#" data-target="course-apply">
                    <span class="material-symbols-sharp">receipt_long</span>
                    <h3>Course Apply</h3>
                </a>
                <a href="#" data-target="reports">
                    <span class="material-symbols-sharp">report_gmailerrorred</span>
                    <h3>Reports</h3>
                </a>
                <a href="#" data-target="settings">
                    <span class="material-symbols-sharp">settings</span>
                    <h3>Settings</h3>
                </a>
                <form method="POST" action="{{ route('logout') }}" id="logout_form" style="display: none;">
                    @csrf
                </form>

                <a href="#" onclick="document.getElementById('logout_form').submit(); return false;">
                    <span class="material-symbols-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main>
            <h1>Dashboard</h1>
            <div class="date">
                <input type="date">
            </div>
            <div class="insights">
                <div class="sales">
                    <h3>Total Sales</h3>
                    <h1>$25,024</h1>
                    <small>Last 24 Hours</small>
                </div>
            </div>

        </main>

        <!-- Right Section -->
        <div class="right">
            <div class="top">
                <button id="menu_bar">
                    <span class="material-symbols-sharp">menu</span>
                </button>
                
            </div>
        </div>
    </div>

    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
