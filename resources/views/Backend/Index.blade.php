@extends('Backend.Layout.App')
@section('content')
<div class="main-content">
    <!-- Header -->
    <div class="header">
        <h1>Bookings Management</h1>
        <div class="user-info">
            <span class="profile-username">
                <span class="fw-bold">{{ Auth::user()->name }}</span>
            </span>
            <div class="avatar-sm">
                <img src="{{ asset('User/'. Auth::user()->image) }}" alt="..." class="avatar-img rounded-circle" />
            </div>
        </div>
    </div>
    
    <!-- Stats Cards -->
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-info">
                <h3>Today's Bookings</h3>
                <p>{{ $todaysBookings }}</p>
                <span class="trend {{ $trend >= 0 ? 'up' : 'down' }}">
                    @if($trend >= 0) ↑ @else ↓ @endif {{ abs(round($trend, 2)) }}% from yesterday
                </span>
            </div>
            <div class="stat-icon bookings">
                <i class="fas fa-calendar-check"></i>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <h3>Total Revenue</h3>
                <p>${{ number_format($totalRevenue, 2) }}</p>
                <span class="trend {{ $percentIncrease >= 0 ? 'up' : 'down' }}">
                    @if($percentIncrease >= 0) ↑ @else ↓ @endif {{ abs(round($percentIncrease, 2)) }}% from last week
                </span>
            </div>
            <div class="stat-icon revenue">
                <i class="fas fa-dollar-sign"></i>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <h3>All Bookings</h3>
                <p>{{ $totalBookings }}</p>
            </div>
            <div class="stat-icon customers">
                <i class="fas fa-book"></i>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <h3>Confirmed</h3>
                <p>{{ $confirmedBookings }}</p>
                <span class="status confirmed">confirmed</span>
            </div>
            <div class="stat-icon services">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>
    
    <!-- Filter Section -->
    <div class="dashboard-card">
        <div class="card-header">
            <h3>Filter Reports</h3>
        </div>
        <div class="card-body">
          <form class="filter-form" id="filterForm">
    @csrf
    <div class="filter-container">
        <div class="filter-select-group">
            <label for="period" class="filter-label">Filter Period</label>
            <div class="select-wrapper">
                <select class="filter-select" id="period" name="period">
                    <option value="this_week">This Week</option>
                    <option value="last_week">Last Week</option>
                    <option value="this_month">This Month</option>
                    <option value="last_month">Last Month</option>
                </select>
                <i class="fas fa-chevron-down select-arrow"></i>
            </div>
        </div>
        <button type="submit" class="filter-button">
            <i class="fas fa-filter"></i>
            <span>Apply Filter</span>
        </button>
    </div>
</form>

<style>
    /* Filter Form Styles */
    .filter-form {
        width: 100%;
        margin: 0;
        padding: 0;
    }

    .filter-container {
        display: flex;
        align-items: flex-end;
        gap: 15px;
        flex-wrap: wrap;
    }

    .filter-select-group {
        flex: 1;
        min-width: 200px;
    }

    .filter-label {
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
        color: #555;
        font-weight: 500;
    }

    .select-wrapper {
        position: relative;
    }

    .filter-select {
        width: 100%;
        padding: 10px 15px;
        padding-right: 35px;
        border: 1px solid #ddd;
        border-radius: 6px;
        background-color: white;
        font-size: 14px;
        color: #333;
        appearance: none;
        transition: all 0.3s ease;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }

    .filter-select:focus {
        outline: none;
        border-color: #6f42c1;
        box-shadow: 0 0 0 3px rgba(111, 66, 193, 0.1);
    }

    .select-arrow {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #777;
        pointer-events: none;
    }

    .filter-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 20px;
        background-color: #6f42c1;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .filter-button:hover {
        background-color: #5c35a1;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .filter-button:active {
        transform: translateY(0);
        box-shadow: 0 2px 3px rgba(0,0,0,0.1);
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .filter-container {
            flex-direction: column;
            align-items: stretch;
        }
        
        .filter-select-group {
            width: 100%;
        }
        
        .filter-button {
            width: 100%;
        }
    }
</style>
        </div>
    </div>
    
    <!-- Revenue & Status Summary -->
    <div class="dashboard-card">
        <div class="card-header">
            <h3>Revenue & Status Summary</h3>
        </div>
        <div class="card-body">
            <div class="summary-grid">
                <div class="summary-card">
                    <small>THIS WEEK</small>
                    <h4>${{ number_format($thisWeekRevenue, 2) }}</h4>
                </div>
                 <div class="summary-card">
                    <small>LAST WEEK</small>
                    <h4>${{ number_format($lastWeekRevenue, 2) }}</h4>
                </div>
                  
                
                <div class="summary-card">
                    <small>PROCESSING</small>
                    <h4>{{ $processingCount }}</h4>
                </div>
                <div class="summary-card">
                    <small>CONFIRMED</small>
                    <h4>{{ $confirmedBookings }}</h4>
                </div>
                 <div class="summary-card">
                    <small>CANCELLED</small>
                    <h4>{{ $cancelledCount }}</h4>
                </div>
               
                 <div class="summary-card">
                    <small>THIS MONTH</small>
                    <h4>${{ number_format($thisMonthPayment, 2) }}</h4>
                </div>
              <div class="summary-card">
                    <small>LAST MONTH</small>
                    <h4>${{ number_format($lastMonthPayment, 2) }}</h4>
                </div>
               
               
            </div>
        </div>
    </div>
</div>

<style>
    /* Main Layout */
    .main-content {
        padding: 20px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    /* Header Styles */
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }
    
    .header h1 {
        font-size: 24px;
        color: #333;
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
    
    .user-info span {
        font-size: 14px;
        color: #555;
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
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        padding: 20px;
        display: flex;
        justify-content: space-between;
    }
    
    .stat-info h3 {
        font-size: 14px;
        color: #666;
        margin: 0 0 10px 0;
    }
    
    .stat-info p {
        font-size: 24px;
        font-weight: 600;
        color: #333;
        margin: 0 0 5px 0;
    }
    
    .trend {
        font-size: 12px;
        display: block;
    }
    
    .trend.up {
        color: #28a745;
    }
    
    .trend.down {
        color: #dc3545;
    }
    
    .stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }
    
    .stat-icon.bookings { background-color: #6610f2; }
    .stat-icon.revenue { background-color: #20c997; }
    .stat-icon.customers { background-color: #fd7e14; }
    .stat-icon.services { background-color: #6f42c1; }
    
    .status {
        padding: 3px 8px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 500;
        display: inline-block;
    }
    
    .confirmed {
        background: #e8f5e9;
        color: #28a745;
    }
    
    /* Dashboard Card Styles */
    .dashboard-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        margin-bottom: 30px;
    }
    
    .card-header {
        padding: 15px 20px;
        border-bottom: 1px solid #eee;
    }
    
    .card-header h3 {
        font-size: 16px;
        color: #333;
        margin: 0;
    }
    
    .card-body {
        padding: 20px;
    }
    
    /* Filter Form */
    .filter-form {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
    }
    
    .form-group {
        margin-bottom: 0;
    }
    
    .form-group label {
        display: block;
        font-size: 12px;
        margin-bottom: 5px;
        color: #666;
    }
    
    .form-control {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }
    
    .btn-filter {
        background-color: #6f42c1;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    
    /* Summary Grid */
    .summary-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
    }
    
    .summary-card {
        padding: 15px;
        border-radius: 8px;
        background: #f8f9fa;
        text-align: center;
    }
    
    .summary-card small {
        font-size: 12px;
        color: #666;
        display: block;
        margin-bottom: 5px;
    }
    
    .summary-card h4 {
        font-size: 18px;
        margin: 0;
        color: #333;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Form submission handler
        document.getElementById('filterForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch("{{ route('filter.data') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    alert(data.error);
                    return;
                }
                
                // Update stats cards
                document.querySelector('.stat-card:nth-child(1) p').textContent = data.todaysBookings;
                const trendElement = document.querySelector('.stat-card:nth-child(1) .trend');
                trendElement.textContent = (data.trend >= 0 ? '↑ ' : '↓ ') + Math.abs(data.trend).toFixed(2) + '% from yesterday';
                trendElement.className = 'trend ' + (data.trend >= 0 ? 'up' : 'down');
                
                document.querySelector('.stat-card:nth-child(2) p').textContent = '$' + data.totalRevenue.toFixed(2);
                document.querySelector('.stat-card:nth-child(3) p').textContent = data.totalBookings;
                document.querySelector('.stat-card:nth-child(4) p').textContent = data.confirmedBookings;
                
                // Update summary grid
                const summaryCards = document.querySelectorAll('.summary-card h4');
                summaryCards[0].textContent = '$' + data.thisWeekPayment.toFixed(2);
                summaryCards[1].textContent = data.confirmedCount;
                summaryCards[2].textContent = '$' + data.lastWeekPayment.toFixed(2);
                summaryCards[3].textContent = data.processingCount;
                summaryCards[4].textContent = '$' + data.thisMonthPayment.toFixed(2);
                summaryCards[5].textContent = data.cancelledCount;
                summaryCards[6].textContent = '$' + data.lastMonthPayment.toFixed(2);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while filtering data');
            });
        });
    });
</script>
@endsection