@extends('layouts.app')

@section('title', 'Manage Complaints')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold"><i class="bi bi-chat-left-dots text-danger me-2"></i>Manage Complaints</h2>
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
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($complaints as $complaint)
                        <tr>
                            <td>{{ $complaint->id }}</td>
                            <td class="fw-bold">{{ $complaint->name }}</td>
                            <td><a href="mailto:{{ $complaint->email }}">{{ $complaint->email }}</a></td>
                            <td>{{ $complaint->subject }}</td>
                            <td>{{ Str::limit($complaint->message, 50) }}</td>
                            <td>
                                @if($complaint->status == 'pending')
                                    <span class="badge bg-warning text-dark rounded-pill">Pending</span>
                                @else
                                    <span class="badge bg-success rounded-pill">Resolved</span>
                                @endif
                            </td>
                            <td>{{ $complaint->created_at->format('M d, Y') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.complaints.show', $complaint) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 shadow-sm">
                                    <i class="bi bi-eye me-1"></i>View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">No complaints found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($complaints->hasPages())
            <div class="card-footer bg-white border-0 pt-3">
                {{ $complaints->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
