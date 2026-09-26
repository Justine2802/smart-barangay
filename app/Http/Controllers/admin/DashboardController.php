<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DocumentRequest;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get total users count
        $totalUsers = User::count();

        // Get pending requests count
        $pendingRequests = DocumentRequest::where('status', 'pending')->count();

        // Get requests completed today
        $completedToday = DocumentRequest::where('status', 'completed')
            ->whereDate('updated_at', Carbon::today())
            ->count();

        // Get recent requests with user and document type
        $recentRequests = DocumentRequest::with(['user', 'documentType'])
            ->latest()
            ->take(10)
            ->get();

        // Get request types distribution
        $requestTypes = DocumentRequest::select('document_type_id', DB::raw('count(*) as count'))
            ->groupBy('document_type_id')
            ->with('documentType')
            ->get()
            ->map(function ($item) use ($totalUsers) {
                return (object)[
                    'name' => $item->documentType->name,
                    'count' => $item->count,
                    'percentage' => round(($item->count / max(1, DocumentRequest::count())) * 100)
                ];
            });

        // Get today's stats
        $todayStats = (object)[
            'new_users' => User::whereDate('created_at', Carbon::today())->count(),
            'new_requests' => DocumentRequest::whereDate('created_at', Carbon::today())->count(),
            'completed_requests' => $completedToday
        ];

        return view('admin.dashboard', compact(
            'totalUsers',
            'pendingRequests',
            'completedToday',
            'recentRequests',
            'requestTypes',
            'todayStats'
        ));
    }
}
