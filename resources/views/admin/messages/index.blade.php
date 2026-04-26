@extends('layouts.app')

@section('title', 'Manage Messages')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold"><i class="bi bi-envelope-paper text-danger me-2"></i>Manage Messages</h2>
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
                        <th>Message Preview</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $msg)
                        <tr>
                            <td>{{ $msg->id }}</td>
                            <td class="fw-bold">{{ $msg->name }}</td>
                            <td><a href="mailto:{{ $msg->email }}">{{ $msg->email }}</a></td>
                            <td>{{ $msg->subject }}</td>
                            <td>{{ Str::limit($msg->message, 40) }}</td>
                            <td>
                                @if($msg->status == 'pending')
                                    <span class="badge bg-warning text-dark rounded-pill">Pending</span>
                                @else
                                    <span class="badge bg-success rounded-pill">Resolved</span>
                                @endif
                            </td>
                            <td>{{ $msg->created_at->format('M d, Y') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 shadow-sm">
                                    <i class="bi bi-eye me-1"></i>View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">No messages found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($messages->hasPages())
            <div class="card-footer bg-white border-0 pt-3">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
