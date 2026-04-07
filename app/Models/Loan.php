<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property int $book_id
 * @property \Carbon\Carbon $loan_date
 * @property \Carbon\Carbon $due_date
 * @property \Carbon\Carbon|null $return_date
 * @property string $status
 * @property string|null $notes
 * @property int $fine_amount
 */
class Loan extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'loan_date',
        'due_date',
        'return_date',
        'status',
        'notes',
        'fine_amount',
    ];

    protected $casts = [
        'loan_date'   => 'date',
        'due_date'    => 'date',
        'return_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function isOverdue(): bool
    {
        return (in_array($this->status, ['approved', 'overdue']) && $this->due_date && $this->due_date->isPast());
    }

    public function daysOverdue(): int
    {
        if (!$this->isOverdue()) return 0;
        return abs((int) now()->startOfDay()->diffInDays($this->due_date->startOfDay()));
    }

    public function calculateFine(): int
    {
        $finePerDay = (int) Setting::get('fine_per_day', 1000);
        return $this->daysOverdue() * $finePerDay;
    }

    public static function statusBadgeClass(string $status): string
    {
        return match ($status) {
            'pending'  => 'badge-warning',
            'approved' => 'badge-primary',
            'returned' => 'badge-success',
            'rejected' => 'badge-danger',
            'overdue'  => 'badge-danger',
            default    => 'badge-secondary',
        };
    }

    public static function statusLabel(string $status): string
    {
        return match ($status) {
            'pending'  => 'Menunggu',
            'approved' => 'Dipinjam',
            'returned' => 'Dikembalikan',
            'rejected' => 'Ditolak',
            'overdue'  => 'Terlambat',
            default    => $status,
        };
    }
}
