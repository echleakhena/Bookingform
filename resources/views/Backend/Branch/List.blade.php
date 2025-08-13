@extends('Backend.Layout.App') 

@section('content')
<div class="main-content">
    <div class="header">
        <h1>Branch Management</h1>
         <div class="user-info">
             <span class="profile-username">
             <span class="fw-bold">{{ Auth::user()->name }}</span>
             </span>
            <div class="avatar-sm">
            <img src="{{ asset('User/'. Auth::user()->image) }}" alt="..." class="avatar-img rounded-circle" />
            </div>
            </div>
    </div>

    <!-- Branches Table -->
    <div class="bookings-table">
        <div class="table-header">
            <h2>All Branches</h2>
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search branches...">
            </div>
            <a href="{{ route('create.branch') }}" class="action-btn edit-btn">
                <i class="fas fa-plus"></i> Add New Branch
            </a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Branch Name</th>
                    <th>Location</th>
                    {{-- <th>Manager</th> --}}
                    <th>Contact</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
          <tbody>
    @foreach($branches as $branch)
    <tr>
        <td>{{ $branch->id }}</td>
        <td>{{ $branch->name }}</td>
        <td>{{ $branch->location }}</td>
        <td>{{ $branch->manager }}</td>
        {{-- <td>{{ $branch->phone }}</td> --}}
        <td>
            <span class="status {{ $branch->status == 'active' ? 'confirmed' : ($branch->status == 'inactive' ? 'cancelled' : 'pending') }}">
                {{ ucfirst($branch->status) }}
            </span>
        </td>
        <td>
            <a href="{{ route('formupdate.branch', $branch->id) }}" class="action-btn edit-btn">
                <i class="fas fa-edit"></i>
            </a>
           <form action="{{ route('delete.branch', $branch->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="action-btn cancel-btn">
                    <i class="fas fa-trash"></i>
                </button>
            </form>

        </td>
    </tr>
    @endforeach
</tbody>
        </table>
           <div class="mt-3">
    {{ $branches->links('pagination::bootstrap-5') }}
</div> 
    </div>
</div>


@endsection