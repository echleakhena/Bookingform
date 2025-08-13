@extends('Backend.Layout.App')

@section('content')
<div class="main-content">
    <div class="header">
        <h1>Services Management</h1>
       <div class="user-info">
             <span class="profile-username">
             <span class="fw-bold">{{ Auth::user()->name }}</span>
             </span>
            <div class="avatar-sm">
            <img src="{{ asset('User/'. Auth::user()->image) }}" alt="..." class="avatar-img rounded-circle" />
            </div>
            </div>
    </div>

    <!-- Service Actions -->
    <div class="actions-container">
        <a href="{{ route('create.service') }}" class="action-btn primary-btn" id="addServiceBtn">
            <i class="fas fa-plus"></i> Add New Service
        </a>
        <div class="search-container">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" id="serviceSearch" placeholder="Search services...">
            </div>
        </div>
    </div>

    <!-- Add/Edit Service Modal -->
    <div class="modal" id="serviceModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">Add New Service</h3>
                <span class="close-btn">&times;</span>
            </div>
            <div class="modal-body">
                <form id="serviceForm">
                    <input type="hidden" id="serviceId" name="id">
                    <div class="form-group">
                        <label for="serviceName">Service Name*</label>
                        <input type="text" id="serviceName" name="name" required>
                    </div>
                 
                    <div class="form-actions">
                        <button type="button" class="cancel-btn">Cancel</button>
                        <button type="submit" class="save-btn">Save Service</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Services Table -->
    <div class="services-table">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Service Name</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
           <tbody>
    @foreach ($services as $service)
        <tr>
            <td>{{ $service->id }}</td>
            <td>{{ $service->name }}</td>
            <td>{{ \Carbon\Carbon::parse($service->created_at)->format('d.m.Y') }}</td>
            <td>
                <a href="{{ route('formupdate.service', $service->id) }}" class="action-btn edit-btn" title="Edit">
                    <i class="fas fa-edit"></i>
                </a>

                <a href="{{ route('delete.service', $service->id) }}" class="action-btn delete-btn" title="Delete"
                   onclick="return confirm('Are you sure you want to delete this service?')">
                    <i class="fas fa-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach
</tbody>

        </table>
           <div class="mt-3">
    {{ $services->links('pagination::bootstrap-5') }}
</div> 
       
    </div>
</div>

<style>
    /* Services Page Specific Styles */
    .actions-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .search-container {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .action-btn {
        padding: 8px 12px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.3s;
        font-size: 0.9rem;
    }
    
    .primary-btn {
        background: var(--primary);
        color: white;
    }
    
    .primary-btn:hover {
        background: var(--secondary);
        transform: translateY(-2px);
    }
    
    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }
    
    .modal-content {
        background: white;
        border-radius: 10px;
        width: 100%;
        max-width: 500px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        overflow: hidden;
    }
    
    .modal-header {
        padding: 20px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .modal-header h3 {
        color: var(--primary);
        margin: 0;
    }
    
    .close-btn {
        font-size: 1.5rem;
        cursor: pointer;
        color: #777;
    }
    
    .close-btn:hover {
        color: var(--error);
    }
    
    .modal-body {
        padding: 20px;
    }
    
    /* Form Styles */
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-row {
        display: flex;
        gap: 15px;
    }
    
    .form-row .form-group {
        flex: 1;
    }
    
    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--dark);
    }
    
    .input-with-icon {
        position: relative;
    }
    
    .input-with-icon i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--primary);
    }
    
    .input-with-icon input {
        padding-left: 35px;
    }
    
    input[type="text"],
    input[type="number"] {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 16px;
    }
    
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
    }
    
    .cancel-btn {
        background: #f5f5f5;
        color: #333;
    }
    
    .save-btn {
        background: var(--primary);
        color: white;
    }
    
    /* Services Table Styles */
    .services-table {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
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
        padding: 8px 10px;
        margin: 2px;
    }
    
    /* Pagination Styles */
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        gap: 5px;
    }
    
    .pagination-btn {
        width: 40px;
        height: 40px;
        border: 1px solid #ddd;
        background: white;
        border-radius: 6px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
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
    @media (max-width: 768px) {
        .actions-container {
            flex-direction: column;
            align-items: stretch;
        }
        
        .form-row {
            flex-direction: column;
            gap: 0;
        }
        
        table {
            display: block;
            overflow-x: auto;
        }
    }
    
    @media (max-width: 480px) {
        td .action-btn {
            padding: 6px 8px;
            font-size: 0.8rem;
        }
    }
</style>
@endsection