<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Get active requests count (pending, processing)
        $activeRequests = $user->documentRequests()
            ->whereIn('status', ['pending', 'processing'])
            ->count();

        // Get requests ready for pickup
        $readyRequests = $user->documentRequests()
            ->where('status', 'ready')
            ->count();

        // Get user's recent requests with document type
        $recentRequests = $user->documentRequests()
            ->with('documentType')
            ->latest()
            ->take(5)
            ->get()
            ->each(function ($request) {
                $request->status_color = match($request->status) {
                    'pending' => 'warning',
                    'processing' => 'info',
                    'ready' => 'success',
                    'completed' => 'primary',
                    'rejected' => 'danger',
                    default => 'secondary'
                };
            });

        return view('dashboard', compact(
            'activeRequests',
            'readyRequests',
            'recentRequests'
        ));
    }
}