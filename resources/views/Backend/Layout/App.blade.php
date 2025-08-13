<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maple Salon Dashboard</title>
      <link rel="icon" href="../assets/img/leak.png" type="image/x-icon" />
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary: #891b96;
            --secondary: #d434bc;
            --accent: #c77dff;
            --light: #faf5ff;
            --dark: #3a0a3a;
            --success: #5a8b46;
            --error: #ff4d6d;
            --warning: #ffaa00;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }
        
        a {
            text-decoration: none;
            color: inherit;
        }
        
        .dashboard-container {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: 100vh;
        }
        
        /* Sidebar Styles */
        .sidebar {
            background: var(--dark);
            color: white;
            padding: 20px 0;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            height: 100vh;
        }
        
        .logo {
            text-align: center;
            padding: 0 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .logo h2 {
            color: white;
            font-size: 1.5rem;
            margin: 0;
        }
        
        .nav-menu {
            margin-top: 30px;
        }
        
        .nav-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 5px 0;
        }
        
        .nav-item:hover, .nav-item.active {
            background: var(--primary);
        }
        
        .nav-item i {
            margin-right: 10px;
            font-size: 1.1rem;
            min-width: 24px;
        }
        
        /* Main Content Styles */
        .main-content {
            padding: 20px;
            overflow-x: hidden;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .header h1 {
            color: var(--primary);
            margin: 0;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-info h3 {
            color: var(--dark);
            font-size: 1rem;
            margin-bottom: 10px;
        }
        
        .stat-info p {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--primary);
            margin: 0;
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        
        .bookings { background: #e3f2fd; color: #1976d2; }
        .revenue { background: #e8f5e9; color: var(--success); }
        .customers { background: #f3e5f5; color: var(--primary); }
        .services { background: #fff8e1; color: var(--warning); }
        
        /* Bookings Table */
        .bookings-table {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-top: 30px;
            overflow-x: auto;
        }
        
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .table-header h2 {
            color: var(--dark);
            margin: 0;
        }
        
        .search-bar {
            display: flex;
            align-items: center;
            background: #f5f5f5;
            padding: 8px 15px;
            border-radius: 20px;
            min-width: 250px;
        }
        
        .search-bar input {
            border: none;
            background: transparent;
            outline: none;
            margin-left: 10px;
            width: 100%;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }
        
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        
        th {
            color: var(--dark);
            font-weight: 600;
            background-color: #f9f9f9;
        }
        
        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-block;
        }
        
        .confirmed { background: #e8f5e9; color: var(--success); }
        .pending { background: #fff8e1; color: var(--warning); }
        .cancelled { background: #ffebee; color: var(--error); }
        
        .action-btn {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 5px;
            font-size: 0.8rem;
            transition: opacity 0.3s ease;
        }
        
        .action-btn:hover {
            opacity: 0.9;
        }
        
        .edit-btn { background: var(--primary); color: white; }
        .cancel-btn { background: var(--error); color: white; }
        
        /* Responsive Styles */
        @media (max-width: 992px) {
            .dashboard-container {
                grid-template-columns: 80px 1fr;
            }
            
            .logo h2, .nav-item span {
                display: none;
            }
            
            .nav-item {
                justify-content: center;
                padding: 15px 0;
            }
            
            .nav-item i {
                margin-right: 0;
                font-size: 1.3rem;
            }
        }
        
        @media (max-width: 768px) {
            .stats-container {
                grid-template-columns: 1fr 1fr;
            }
        }
        
        @media (max-width: 576px) {
            .dashboard-container {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                display: none;
            }
            
            .stats-container {
                grid-template-columns: 1fr;
            }
            
            .header, .table-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .search-bar {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    
    <div class="dashboard-container">
        
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <h2>Maple Salon</h2>
            </div>
            <div class="nav-menu">
                <a href="{{ url('/Admin') }}" class="nav-item active">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('list.booking') }}" class="nav-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Bookings</span>
                </a>
                {{-- <a href="{{ route('list.customer') }}" class="nav-item">
                    <i class="fas fa-users"></i>
                    <span>Customers</span>
                </a> --}}
                <a href="{{ route('list.service') }}" class="nav-item">
                    <i class="fas fa-cut"></i>
                    <span>Services</span>
                </a>
                <a href="{{ route('list.branch') }}" class="nav-item">
                    <i class="fas fa-store"></i>
                    <span>Branch</span>
                </a>
                 <a href="{{ route('list.user') }}" class="nav-item">
                    <i class="fas fa-user"></i>
                    <span>User</span>
                </a>
                {{-- <a href="" class="nav-item">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a> --}}
                  <a href="{{ route('login') }}" class="nav-item">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>
        
        <!-- Main Content -->
        @yield('content')

    
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Navigation menu active state
            const currentPath = window.location.pathname;
            const navItems = document.querySelectorAll('.nav-item');
            
            navItems.forEach(item => {
                const linkPath = item.getAttribute('href');
                if (currentPath.includes(linkPath.split('/').pop())) {
                    navItems.forEach(i => i.classList.remove('active'));
                    item.classList.add('active');
                }
                
                item.addEventListener('click', function() {
                    navItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                });
            });
            
            // Search functionality
            const searchInput = document.querySelector('.search-bar input');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const rows = document.querySelectorAll('tbody tr');
                    
                    rows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        row.style.display = text.includes(searchTerm) ? '' : 'none';
                    });
                });
            }
            
            // Action buttons
            const editButtons = document.querySelectorAll('.edit-btn');
            const cancelButtons = document.querySelectorAll('.cancel-btn');
            
            editButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const bookingId = this.closest('tr').querySelector('td').textContent;
                    alert(`Edit booking ${bookingId}`);
                });
            });
            
            cancelButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const bookingId = this.closest('tr').querySelector('td').textContent;
                    if (confirm(`Are you sure you want to cancel booking ${bookingId}?`)) {
                        const statusSpan = this.closest('tr').querySelector('.status');
                        statusSpan.textContent = 'Cancelled';
                        statusSpan.className = 'status cancelled';
                    }
                });
            });
        });
    </script>
</body>
</html>