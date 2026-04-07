<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Auto-flag overdue
        Loan::where('status', 'approved')->where('due_date', '<', now())->update(['status' => 'overdue']);

        $user = Auth::user();

        $stats = [
            'active_loans'  => $user->loans()->whereIn('status', ['approved', 'overdue'])->count(),
            'total_loans'   => $user->loans()->count(),
            'returned'      => $user->loans()->where('status', 'returned')->count(),
            'pending'       => $user->loans()->where('status', 'pending')->count(),
        ];

        $activeLoans  = $user->loans()->with('book.category')
            ->whereIn('status', ['approved', 'overdue'])
            ->latest()
            ->get();

        $recentLoans  = $user->loans()->with('book')
            ->latest()
            ->take(5)
            ->get();

        return view('student.dashboard', compact('stats', 'activeLoans', 'recentLoans'));
    }
}
