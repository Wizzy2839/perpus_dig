<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate   = $request->input('end_date', now()->format('Y-m-d'));

        $loans = Loan::with(['user', 'book.category'])
            ->whereBetween('loan_date', [$startDate, $endDate])
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $summary = [
            'total'     => Loan::whereBetween('loan_date', [$startDate, $endDate])->count(),
            'returned'  => Loan::whereBetween('loan_date', [$startDate, $endDate])->where('status', 'returned')->count(),
            'overdue'   => Loan::whereBetween('loan_date', [$startDate, $endDate])->whereIn('status', ['overdue'])->count(),
            'total_fine'=> Loan::whereBetween('loan_date', [$startDate, $endDate])->sum('fine_amount'),
        ];

        return view('admin.reports.index', compact('loans', 'summary', 'startDate', 'endDate'));
    }
}
