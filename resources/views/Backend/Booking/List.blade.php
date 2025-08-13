@extends('Backend.Layout.App')

@section('content')

<div class="main-content">
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

    <!-- Booking Actions -->
    <div class="actions-container">
        <div class="left-actions">
            {{-- <a href="{{ route('create.booking') }}" class="action-btn primary-btn">
                <i class="fas fa-plus"></i> Add New Booking
            </a> --}}
            
            <!-- Branch Filter Dropdown -->
            <div class="filter-dropdown">
                <select id="branch-filter" class="filter-select">
                    <option value="">All Branches</option>
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
                <i class="fas fa-chevron-down"></i>
            </div>
            
            <!-- Status Filter Dropdown -->
            <div class="filter-dropdown">
                <select id="status-filter" class="filter-select">
                    <option value="">All Statuses</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="processing">Processing</option>
                    <option value="cancel">cancel</option>
                </select>
                <i class="fas fa-chevron-down"></i>
            </div>
             <div class="filter-dropdown">
    {{-- <select id="time-filter" class="filter-select">
        <option value="">select time to filter</option>
        <option value="last_week" {{ $time == 'last_week' ? 'selected' : '' }}>last week</option>
        <option value="this_week" {{ $time == 'this_week' ? 'selected' : '' }}>this week</option>
    </select> --}}
    {{-- <i class="fas fa-chevron-down"></i> --}}
</div>

<script>
    document.getElementById('time-filter').addEventListener('change', function () {
        const selected = this.value;
        if (selected) {
            window.location.href = `?time=${selected}`;
        }
    });
</script>

          
        </div>
        
        <div class="search-container">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search bookings..." id="booking-search">
            </div>
        </div>
    </div>

    <!-- Bookings Table -->
    
    <div class="bookings-table">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Contact</th>
                    <th>Branch</th>
                    {{-- <th>Services</th> --}}
                    <th>Booking Date</th>
                    <th>Status</th>
                    {{-- <th>Created</th> --}}
                    
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
   @foreach ($bookings->sortByDesc('id')->take(10)  as $booking)
    <tr data-branch="{{ $booking->branch_id }}" data-status="{{ $booking->status }}">
        <td>{{ $booking->id }}</td>
        <td>
            <div class="customer-info">
                <strong>{{ $booking->name }}</strong>
            </div>
        </td>
         <td>
            <div>{{ $booking->phone }}</div>
        </td>
        <td>{{ $booking->branch->name ?? 'N/A' }}</td>
       
        {{-- <td>
            <div class="service-item">
                <input type="checkbox" id="service-{{ $booking->id }}" checked disabled>
                <label for="service-{{ $booking->id }}">{{ $booking->service->name ?? 'N/A' }}</label>
            </div>
        </td> --}}
        <td>
      
    <div> {{ \Carbon\Carbon::parse($booking->booking_date)->format('d.m.Y') }}</div>
    <div>{{ \Carbon\Carbon::parse($booking->booking_time)->format('h:ia') }}</div>


        </td>
        {{-- <td>{{ $booking->note ?? 'No special requests' }}</td> --}}
      <td>
    <span style="
        @if($booking->status == 'confirmed') color: green;
        @elseif($booking->status == 'processing') color: orange;
        @elseif($booking->status == 'cancel') color: red;
        @else color: gray;
        @endif
    ">
        {{ ucfirst($booking->status) }}
    </span>
</td>

       {{-- <td> <div>{{ $booking->created_at }}</div></td>  --}}
      <td>
    <a href="{{ route('view.booking', $booking->id) }}" class="action-btn view-btn" title="View Booking">
        <i class="fas fa-eye"></i>
    </a>
    <a href="{{ route('formupdate.booking', $booking->id) }}" class="action-btn edit-btn" title="Edit Booking">
        <i class="fas fa-edit"></i>
    </a>
</td>

    </tr>
    
@endforeach

</tbody>
        </table>
       <div class="mt-3">
    {{ $bookings->links('pagination::bootstrap-5') }}
</div> 
       
    </div>
</div>


<style>
    /* Bookings Page Specific Styles */
    .actions-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .left-actions {
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }
    
    .search-container {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .action-btn {
        padding: 10px 15px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
        text-decoration: none;
    }
    
    .primary-btn {
        background: var(--primary);
        color: white;
    }
    
    .primary-btn:hover {
        background: var(--secondary);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    /* Filter Dropdown Styles */
    .filter-dropdown {
        position: relative;
        display: inline-block;
        min-width: 180px;
    }
    
    .filter-select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        padding: 10px 35px 10px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        background-color: white;
        font-size: 14px;
        cursor: pointer;
        width: 100%;
        outline: none;
        transition: border-color 0.3s;
    }
    
    .filter-select:focus {
        border-color: var(--primary);
    }
    
    .filter-dropdown i {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        color: #777;
    }
    
    /* Bookings Table Styles */
    .bookings-table {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    
    .customer-info {
        display: flex;
        flex-direction: column;
    }
    
    .service-item {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
    }
    
    .service-item input[type="checkbox"] {
        width: 16px;
        height: 16px;
        margin-right: 8px;
        accent-color: var(--primary);
        cursor: pointer;
    }
    
    .service-item label {
        cursor: pointer;
        transition: color 0.2s;
    }
    
    .service-item input[type="checkbox"]:checked + label {
        color: var(--success);
        font-weight: 500;
    }
    
    .status {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        display: inline-block;
        text-transform: capitalize;
    }
    
    .status.confirmed {
        background: #e8f5e9;
        color: var(--success);
    }
    
    .status.pending {
        background: #fff8e1;
        color: var(--warning);
    }
    
    .status.cancelled {
        background: #ffebee;
        color: var(--error);
    }
    
    .view-btn {
        background: #4a6bdf;
        color: white;
    }
    
    .edit-btn {
        background: var(--primary);
        color: white;
    }
    
    .delete-btn {
        background: var(--error);
        color: white;
    }
    
    /* Action buttons in table */
    td .action-btn {
        padding: 8px 12px;
        margin: 2px;
    }
    
    /* Pagination Styles */
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 25px;
        gap: 5px;
    }
    
    .pagination-btn {
        width: 40px;
        height: 40px;
        border: 1px solid #ddd;
        background: white;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: var(--dark);
        transition: all 0.3s;
    }
    
    .pagination-btn:hover {
        background: #f5f5f5;
    }
    
    .pagination-btn.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }
    
    .pagination-btn.disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    /* Responsive Styles */
    @media (max-width: 992px) {
        table {
            display: block;
            overflow-x: auto;
        }
        
        .service-item {
            white-space: nowrap;
        }
    }
    
    @media (max-width: 768px) {
        .actions-container {
            flex-direction: column;
            align-items: stretch;
        }
        
        .left-actions {
            flex-direction: column;
            align-items: stretch;
            gap: 10px;
        }
        
        .filter-dropdown {
            width: 100%;
        }
        
        td .action-btn {
            display: block;
            margin-bottom: 5px;
            width: 100%;
            text-align: center;
        }
    }
    
    @media (max-width: 480px) {
        .pagination-btn {
            width: 35px;
            height: 35px;
            font-size: 0.9rem;
        }
        
        td, th {
            padding: 10px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Branch filter functionality
    const branchFilter = document.getElementById('branch-filter');
    const statusFilter = document.getElementById('status-filter');
    const searchInput = document.getElementById('booking-search');
    const bookingRows = document.querySelectorAll('.bookings-table tbody tr');
    
    function filterBookings() {
        const branchValue = branchFilter.value;
        const statusValue = statusFilter.value;
        const searchValue = searchInput.value.toLowerCase();
        
        bookingRows.forEach(row => {
            const branchMatch = !branchValue || row.getAttribute('data-branch') === branchValue;
            const statusMatch = !statusValue || row.getAttribute('data-status') === statusValue;
            const textMatch = !searchValue || 
                row.textContent.toLowerCase().includes(searchValue);
            
            if (branchMatch && statusMatch && textMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
    
    // Add event listeners
    branchFilter.addEventListener('change', filterBookings);
    statusFilter.addEventListener('change', filterBookings);
    searchInput.addEventListener('input', filterBookings);
});
</script>
@endsection