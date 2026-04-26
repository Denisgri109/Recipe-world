@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold"><i class="bi bi-people text-primary me-2"></i>Manage Users</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">Back to Dashboard</a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Joined</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $user->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->is_admin)
                                    <span class="badge bg-danger rounded-pill">Admin</span>
                                @elseif($user->is_banned)
                                    <span class="badge bg-dark rounded-pill">Banned</span>
                                @else
                                    <span class="badge bg-secondary rounded-pill">User</span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-primary" title="Edit User">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    @if(!$user->is_admin)
                                        @if($user->is_banned)
                                            <form action="{{ route('admin.users.unban', $user) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-success" title="Unban User">
                                                    <i class="bi bi-unlock"></i>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.users.ban', $user) }}" method="POST" class="delete-form d-inline" data-confirm-message="Are you sure you want to ban this user?">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-warning" title="Ban User">
                                                    <i class="bi bi-lock"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="delete-form d-inline" data-confirm-message="Are you sure you want to permanently delete this user?">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete User">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
            <div class="card-footer bg-white border-0 pt-3">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
