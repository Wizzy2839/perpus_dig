<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function index()
    {
        // Auto-flag overdue
        Loan::where('status', 'approved')->where('due_date', '<', now())->update(['status' => 'overdue']);

        $loans = Auth::user()->loans()->with('book')->latest()->paginate(10);
        return view('student.loans.index', compact('loans'));
    }

    public function create(Request $request)
    {
        $book = null;
        if ($request->filled('book_id')) {
            $book = Book::findOrFail($request->book_id);
        }
        $books = Book::orderBy('title')->get();
        return view('student.loans.create', compact('book', 'books'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'book_id' => 'required|exists:books,id',
            'notes'   => 'nullable|string|max:500',
        ]);

        $user = Auth::user();
        $book = Book::findOrFail($data['book_id']);

        // Check max active loans
        $maxLoan = (int) Setting::get('max_loan_per_user', 3);
        if ($user->activeLoans()->count() >= $maxLoan) {
            return back()->with('error', "Batas maksimal pinjaman aktif adalah {$maxLoan} buku.");
        }

        // Check if already has pending/active loan for this book
        $existing = $user->loans()
            ->where('book_id', $book->id)
            ->whereIn('status', ['pending', 'approved', 'overdue'])
            ->exists();

        if ($existing) {
            return back()->with('error', 'Kamu sudah memiliki pinjaman aktif atau menunggu untuk buku ini.');
        }

        if (!$book->isAvailable()) {
            return back()->with('error', 'Stok buku sedang tidak tersedia.');
        }

        $days = (int) Setting::get('loan_duration_days', 7);

        Loan::create([
            'user_id'   => $user->id,
            'book_id'   => $book->id,
            'loan_date' => today(),
            'due_date'  => today()->addDays($days),
            'status'    => 'pending',
            'notes'     => $data['notes'] ?? null,
        ]);

        return redirect()->route('student.loans.index')
            ->with('success', 'Permohonan peminjaman berhasil dikirim. Tunggu konfirmasi petugas.');
    }
}
