@extends('admin.layout')

@section('title', 'Users')
@section('page-title', 'User Management')

@section('content')
<div class="content-card">
    <h2>All Users</h2>
    
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Registered</th>
                <th>Total Orders</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                    <td>{{ $user->orders->count() }}</td>
                    <td><a href="{{ route('admin.users.show', $user) }}" class="btn btn-primary">View Details</a></td>
                </tr>
            @empty
                <tr><td colspan="5">No users found.</td></tr>
            @endforelse
        </tbody>
    </table>
    
    <div style="margin-top: 20px;">
        {{ $users->links() }}
    </div>
</div>
@endsection

