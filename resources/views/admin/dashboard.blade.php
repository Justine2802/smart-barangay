@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <h2 class="mb-4">Admin Dashboard</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-2 text-muted">Total Users</h6>
                        <h2 class="card-title mb-0">{{ $totalUsers ?? 0 }}</h2>
                    </div>
                    <div class="text-primary">
                        <i class="bi bi-people fs-1"></i>
                    </div>
                </div>
                <a href="{{ route('admin.users') }}" class="btn btn-sm btn-outline-primary mt-3">View All Users</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-2 text-muted">Pending Requests</h6>
                        <h2 class="card-title mb-0">{{ $pendingRequests ?? 0 }}</h2>
                    </div>
                    <div class="text-warning">
                        <i class="bi bi-clock-history fs-1"></i>
                    </div>
                </div>
                <a href="{{ route('admin.requests', ['status' => 'pending']) }}" class="btn btn-sm btn-outline-warning mt-3">View Pending</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-2 text-muted">Completed Today</h6>
                        <h2 class="card-title mb-0">{{ $completedToday ?? 0 }}</h2>
                    </div>
                    <div class="text-success">
                        <i class="bi bi-check-circle fs-1"></i>
                    </div>
                </div>
                <a href="{{ route('admin.requests', ['status' => 'completed']) }}" class="btn btn-sm btn-outline-success mt-3">View Completed</a>
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
                                <th>User</th>
                                <th>Document</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentRequests ?? [] as $request)
                            <tr>
                                <td>#{{ $request->id }}</td>
                                <td>{{ $request->user->full_name }}</td>
                                <td>{{ $request->document_type->name }}</td>
                                <td>
                                    <span class="badge bg-{{ $request->status_color }}">
                                        {{ $request->status }}
                                    </span>
                                </td>
                                <td>{{ $request->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('admin.requests.show', $request) }}" class="btn btn-sm btn-outline-primary">View</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No recent requests</td>
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
                <h5 class="card-title mb-0">Quick Stats</h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h6 class="text-muted">Request Types</h6>
                    <div class="progress" style="height: 20px;">
                        @foreach($requestTypes ?? [] as $type)
                        <div class="progress-bar" role="progressbar" style="width: {{ $type->percentage }}%" 
                             title="{{ $type->name }}: {{ $type->count }}">
                            {{ $type->percentage }}%
                        </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <h6 class="text-muted">Today's Activity</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="bi bi-person-plus text-success"></i>
                            New Users: {{ $todayStats->new_users ?? 0 }}
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-file-earmark-plus text-primary"></i>
                            New Requests: {{ $todayStats->new_requests ?? 0 }}
                        </li>
                        <li>
                            <i class="bi bi-check2-circle text-success"></i>
                            Completed: {{ $todayStats->completed_requests ?? 0 }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
