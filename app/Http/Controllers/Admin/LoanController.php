<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        $query = Loan::with(['user', 'book']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->whereHas('user', fn($q) => $q->where('name', 'like', '%' . $request->search . '%'))
                  ->orWhereHas('book', fn($q) => $q->where('title', 'like', '%' . $request->search . '%'));
        }

        // Auto-flag overdue
        Loan::where('status', 'approved')->where('due_date', '<', now())->update(['status' => 'overdue']);

        $loans = $query->latest()->paginate(15)->withQueryString();
        return view('admin.loans.index', compact('loans'));
    }

    public function show(Loan $loan)
    {
        $loan->load(['user', 'book.category']);
        return view('admin.loans.show', compact('loan'));
    }

    public function create()
    {
        $members = User::where('role', 'murid')->where('is_active', true)->orderBy('name')->get();
        $books   = Book::orderBy('title')->get();
        return view('admin.loans.create', compact('members', 'books'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'notes'   => 'nullable|string',
        ]);

        $user = User::findOrFail($data['user_id']);
        $book = Book::findOrFail($data['book_id']);

        $maxLoan = (int) Setting::get('max_loan_per_user', 3);
        if ($user->activeLoans()->count() >= $maxLoan) {
            return back()->with('error', "Anggota sudah mencapai batas maksimal {$maxLoan} pinjaman aktif.");
        }

        if (!$book->isAvailable()) {
            return back()->with('error', 'Stok buku tidak tersedia.');
        }

        $days = (int) Setting::get('loan_duration_days', 7);

        Loan::create([
            'user_id'   => $data['user_id'],
            'book_id'   => $data['book_id'],
            'loan_date' => today(),
            'due_date'  => today()->addDays($days),
            'status'    => 'approved',
            'notes'     => $data['notes'] ?? null,
        ]);

        return redirect()->route('admin.loans.index')
            ->with('success', 'Peminjaman berhasil dicatat.');
    }

    public function approve(Loan $loan)
    {
        if ($loan->status !== 'pending') {
            return back()->with('error', 'Peminjaman tidak dalam status menunggu.');
        }

        if (!$loan->book->isAvailable()) {
            return back()->with('error', 'Stok buku tidak tersedia.');
        }

        $days = (int) Setting::get('loan_duration_days', 7);
        $loan->update([
            'status'    => 'approved',
            'loan_date' => today(),
            'due_date'  => today()->addDays($days),
        ]);

        return back()->with('success', 'Peminjaman disetujui.');
    }

    public function reject(Request $request, Loan $loan)
    {
        if ($loan->status !== 'pending') {
            return back()->with('error', 'Peminjaman tidak dalam status menunggu.');
        }

        $loan->update([
            'status' => 'rejected',
            'notes'  => $request->input('notes', 'Ditolak oleh admin.'),
        ]);

        return back()->with('success', 'Peminjaman ditolak.');
    }

    public function returnBook(Loan $loan)
    {
        if (!in_array($loan->status, ['approved', 'overdue'])) {
            return back()->with('error', 'Peminjaman tidak dapat dikembalikan.');
        }

        $fine = $loan->calculateFine();

        $loan->update([
            'status'      => 'returned',
            'return_date' => today(),
            'fine_amount' => $fine,
        ]);

        $message = 'Buku berhasil dikembalikan.';
        if ($fine > 0) {
            $message .= ' Denda: Rp ' . number_format($fine, 0, ',', '.');
        }

        return back()->with('success', $message);
    }
}
