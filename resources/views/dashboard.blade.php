@extends('layouts.dashboard')

@section('title', 'My Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <h2 class="mb-4">Welcome, {{ auth()->user()->first_name }}!</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-2 text-muted">Active Requests</h6>
                        <h2 class="card-title mb-0">{{ $activeRequests ?? 0 }}</h2>
                    </div>
                    <div class="text-primary">
                        <i class="bi bi-file-earmark-text fs-1"></i>
                    </div>
                </div>
                <a href="{{ route('requests.index', ['status' => 'active']) }}" class="btn btn-sm btn-outline-primary mt-3">View Active</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-2 text-muted">Ready for Pickup</h6>
                        <h2 class="card-title mb-0">{{ $readyRequests ?? 0 }}</h2>
                    </div>
                    <div class="text-success">
                        <i class="bi bi-check-circle fs-1"></i>
                    </div>
                </div>
                <a href="{{ route('requests.index', ['status' => 'ready']) }}" class="btn btn-sm btn-outline-success mt-3">View Ready</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Request Document</h5>
                <p class="card-text">Start a new document request</p>
                <a href="{{ route('requests.create') }}" class="btn btn-warning" style="background-color:#FA812F; border-color:#FA812F;">
                    <i class="bi bi-plus-circle"></i> New Request
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Recent Requests</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Document Type</th>
                                <th>Status</th>
                                <th>Requested</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentRequests ?? [] as $request)
                            <tr>
                                <td>#{{ $request->id }}</td>
                                <td>{{ $request->document_type->name }}</td>
                                <td>
                                    <span class="badge bg-{{ $request->status_color }}">
                                        {{ $request->status }}
                                    </span>
                                </td>
                                <td>{{ $request->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('requests.show', $request) }}" class="btn btn-sm btn-outline-primary">View</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No recent requests</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Quick Links</h5>
            </div>
            <div class="card-body">
                <div class="list-group">
                    <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-person me-2"></i> Update Profile
                    </a>
                    <a href="{{ route('requests.index') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-file-text me-2"></i> View All Requests
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="bi bi-question-circle me-2"></i> Help Center
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection