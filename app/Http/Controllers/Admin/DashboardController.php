<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_books'      => Book::count(),
            'total_members'    => User::where('role', 'murid')->count(),
            'active_loans'     => Loan::whereIn('status', ['approved', 'overdue'])->count(),
            'pending_loans'    => Loan::where('status', 'pending')->count(),
            'overdue_loans'    => Loan::where('status', 'overdue')->orWhere(function ($q) {
                $q->where('status', 'approved')->where('due_date', '<', now());
            })->count(),
            'returned_today'   => Loan::where('status', 'returned')
                ->whereDate('return_date', today())->count(),
        ];

        $recentLoans   = Loan::with(['user', 'book'])->latest()->take(7)->get();
        $pendingLoans  = Loan::with(['user', 'book'])->where('status', 'pending')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentLoans', 'pendingLoans'));
    }
}
