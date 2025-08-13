@extends('Backend.Layout.App')

@section('content')
<div class="main-content">
    <!-- Header Section -->
    <div class="header-section">
        <div class="header-content">
            <h1><i class="fas fa-users"></i> Customer Management</h1>
            <p>Manage all customer information and interactions</p>
        </div>
        <div class="user-profile">
            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Admin">
            <span>Admin User</span>
        </div>
    </div>

    <!-- Filter Controls -->
    <div class="filter-controls">
        <!-- Branch Filter -->
     



      
     

        <!-- Quick Filters -->
        <div class="filter-group">
            <label for="quick-filter"><i class="fas fa-bolt"></i> Quick Filter</label>
            <select id="quick-filter" class="filter-select">
                <option value="">Select Period</option>
                <option value="thisweek"> This Week</option>
                <option value="lastweek">Last Week</option>
                <option value="month">This Month</option>
                <option value="year">This Year</option>
            </select>
        </div>

        <!-- Action Buttons -->
        <div class="filter-actions">
            <button class="btn btn-filter"><i class="fas fa-filter"></i> Apply Filters</button>
            <button class="btn btn-reset"><i class="fas fa-redo"></i> Reset</button>
        </div>
    </div>

    <!-- Customer Actions -->
    <div class="action-bar">
      
        
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="customer-search" placeholder="Search customers...">
            <button class="btn btn-search"><i class="fas fa-filter"></i> </button>
        </div>
    </div>

    <!-- Customers Table -->
    <div class="data-table-container">
        <table class="data-table">
          
            <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Service</th>
            <th>Branch</th>
        
            <th>Action</th>

        </tr>
    </thead>
    <tbody>
        @foreach($confirmedBookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->name }}</td>
                <td>{{ $booking->phone }}</td>
                <td>{{ $booking->service->name ?? '-' }}</td>
                <td>{{ $booking->branch->name ?? '-' }}</td>
                 <td>
                     <a href="" class="action-btn view-btn" title="Edit">
    <i class="fas fa-eye"></i>
</a>
                {{-- <a href="" class="action-btn edit-btn" title="Edit">
                    <i class="fas fa-edit"></i>
                </a> --}}
                  

              
            </td>
            </tr>
        @endforeach
    </tbody>
</table>
        </table>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            {{ $customers->links() }}
        </div>
    </div>
</div>



<style>
    /* Main Content Styles */
    .main-content {
        padding: 20px;
        background-color: #f8f9fa;
    }

    /* Header Section */
    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e0e0e0;
    }

    .header-content h1 {
        color: #2c3e50;
        margin-bottom: 5px;
        font-size: 1.8rem;
    }

    .header-content p {
        color: #7f8c8d;
        margin: 0;
    }

    .user-profile {
        display: flex;
        align-items: center;
    }

    .user-profile img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }

    /* Filter Controls */
    .filter-controls {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 25px;
        padding: 15px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .filter-group {
        flex: 1;
        min-width: 200px;
    }

    .filter-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #34495e;
    }

    .filter-select {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        background-color: white;
    }

    .date-range .date-inputs {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .date-range span {
        color: #7f8c8d;
    }

    .filter-actions {
        display: flex;
        align-items: flex-end;
        gap: 10px;
    }

    .btn-filter, .btn-reset {
        padding: 10px 15px;
        border-radius: 6px;
        font-weight: 500;
    }

    .btn-filter {
        background-color: #3498db;
        color: white;
        border: none;
    }

    .btn-reset {
        background-color: #f8f9fa;
        border: 1px solid #ddd;
    }

    /* Action Bar */
    .action-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .search-box {
        position: relative;
        display: flex;
        align-items: center;
    }

    .search-box i {
        position: absolute;
        left: 12px;
        color: #95a5a6;
    }

    #customer-search {
        padding: 10px 15px 10px 35px;
        border: 1px solid #ddd;
        border-radius: 6px;
        width: 250px;
    }

    .btn-search {
        margin-left: 10px;
        background-color: #f8f9fa;
        border: 1px solid #ddd;
    }

    /* Data Table */
    .data-table-container {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table th {
        background-color: #f8f9fa;
        padding: 15px;
        text-align: left;
        font-weight: 600;
        color: #2c3e50;
        border-bottom: 2px solid #e0e0e0;
    }

    .data-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #f1f1f1;
        vertical-align: middle;
    }

    .data-table tr:hover {
        background-color: #f8f9fa;
    }

    .sortable {
        cursor: pointer;
        position: relative;
    }

    .sortable:hover {
        color: #3498db;
    }

    /* Customer Info */
    .customer-info {
        display: flex;
        align-items: center;
    }

    .customer-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
        object-fit: cover;
    }

    .customer-info small {
        color: #7f8c8d;
        font-size: 0.8rem;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 5px;
    }

    .btn-view, .btn-edit, .btn-delete {
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        border: none;
        color: white;
    }

    .btn-view {
        background-color: #3498db;
    }

    .btn-edit {
        background-color: #f39c12;
    }

    .btn-delete {
        background-color: #e74c3c;
    }

    /* Pagination */
    .pagination-wrapper {
        padding: 15px;
        display: flex;
        justify-content: center;
    }

    /* Modal Styles */
    .profile-header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }

    .profile-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin-right: 20px;
        object-fit: cover;
        border: 3px solid #f1f1f1;
    }

    .profile-info h3 {
        margin: 0;
        color: #2c3e50;
    }

    .customer-meta {
        margin-top: 5px;
    }

    .badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        margin-right: 5px;
    }

    .detail-section {
        margin-bottom: 25px;
    }

    .detail-section h4 {
        color: #2c3e50;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    /* Responsive Styles */
    @media (max-width: 992px) {
        .filter-controls {
            flex-direction: column;
        }
        
        .filter-group {
            width: 100%;
        }
        
        .action-bar {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
        
        .search-box {
            width: 100%;
        }
        
        #customer-search {
            width: 100%;
        }
    }

    @media (max-width: 768px) {
        .data-table {
            display: block;
            overflow-x: auto;
        }
        
        .header-section {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
    }
</style>

<script>
$(document).ready(function() {
    // View Customer Modal
    $('.view-customer').click(function() {
        const customerId = $(this).data('id');
        
        // In a real app, you would fetch this data via AJAX
        // This is just a simulation
        const customerData = {
            id: customerId,
            name: "Customer Name",
            email: "customer@example.com",
            phone: "(123) 456-7890",
            gender: "Female",
            dob: "1990-05-15",
            status: "Active",
            lastVisit: "2023-05-20",
            visitCount: 12,
            totalSpend: 1250.50,
            joinDate: "2020-01-15",
            notes: "Preferred stylist: Jane Doe. Allergic to certain hair products.",
            appointments: [
                { date: "2023-05-20", service: "Haircut & Color", amount: 120.00 },
                { date: "2023-04-15", service: "Manicure", amount: 45.00 },
                { date: "2023-03-10", service: "Facial Treatment", amount: 80.00 }
            ]
        };

        // Populate modal
        $('#customerName').text(customerData.name);
        $('#customerId').text('ID: #' + customerData.id);
        $('#customerStatus').text(customerData.status);
        $('#customerEmail').text(customerData.email);
        $('#customerPhone').text(customerData.phone);
        $('#customerGender').text(customerData.gender);
        $('#customerDob').text(new Date(customerData.dob).toLocaleDateString());
        $('#customerLastVisit').text(new Date(customerData.lastVisit).toLocaleDateString());
        $('#customerVisitCount').text(customerData.visitCount);
        $('#customerTotalSpend').text('$' + customerData.totalSpend.toFixed(2));
        $('#customerJoinDate').text(new Date(customerData.joinDate).toLocaleDateString());
        $('#customerNotes').text(customerData.notes || 'No notes available');
        
        // Set avatar (random for demo)
        $('#customerAvatar').attr('src', 'https://randomuser.me/api/portraits/women/' + Math.floor(Math.random() * 100) + '.jpg');
        
        // Populate appointments
        const appointmentsList = $('#customerAppointments');
        appointmentsList.empty();
        
        if (customerData.appointments && customerData.appointments.length > 0) {
            customerData.appointments.forEach(appt => {
                appointmentsList.append(`
                    <div class="appointment-item">
                        <div class="appointment-date">${new Date(appt.date).toLocaleDateString()}</div>
                        <div class="appointment-service">${appt.service}</div>
                        <div class="appointment-amount">$${appt.amount.toFixed(2)}</div>
                    </div>
                `);
            });
        } else {
            appointmentsList.append('<p>No recent appointments</p>');
        }
        
        // Set edit link
        $('#editCustomerBtn').attr('href', '/admin/customers/' + customerId + '/edit');
        
        // Show modal
        $('#viewCustomerModal').modal('show');
    });

    // Table sorting
    $('.sortable').click(function() {
        const sortField = $(this).data('sort');
        const isActive = $(this).hasClass('active');
        const isAsc = $(this).hasClass('asc');
        
        // Reset all sort indicators
        $('.sortable i').removeClass('fa-sort-up fa-sort-down').addClass('fa-sort');
        $('.sortable').removeClass('active asc desc');
        
        // Set new sort state
        $(this).addClass('active');
        if (isActive && isAsc) {
            $(this).addClass('desc');
            $(this).find('i').removeClass('fa-sort').addClass('fa-sort-down');
        } else {
            $(this).addClass('asc');
            $(this).find('i').removeClass('fa-sort').addClass('fa-sort-up');
        }
        
        // In a real app, you would reload the data with the new sort order
        console.log('Sorting by', sortField, isActive && isAsc ? 'desc' : 'asc');
    });

    // Search functionality
    $('#customer-search').on('input', function() {
        const searchTerm = $(this).val().toLowerCase();
        $('.data-table tbody tr').each(function() {
            const rowText = $(this).text().toLowerCase();
            $(this).toggle(rowText.includes(searchTerm));
        });
    });

    // Filter application
    $('.btn-filter').click(function() {
        const branch = $('#branch-filter').val();
        const status = $('#status-filter').val();
        const fromDate = $('#from-date').val();
        const toDate = $('#to-date').val();
        const quickFilter = $('#quick-filter').val();
        
        // In a real app, you would submit these filters to the server
        console.log('Applying filters:', { branch, status, fromDate, toDate, quickFilter });
    });

    // Reset filters
    $('.btn-reset').click(function() {
        $('.filter-select').val('');
        $('.form-control').val('');
        // In a real app, you would reload the data without filters
    });
});
</script>
@endsection