<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'author',
        'publisher',
        'isbn',
        'year',
        'description',
        'stock',
        'cover',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function activeLoansCount(): int
    {
        return $this->loans()->whereIn('status', ['approved', 'overdue'])->count();
    }

    public function availableStock(): int
    {
        return max(0, $this->stock - $this->activeLoansCount());
    }

    public function isAvailable(): bool
    {
        return $this->availableStock() > 0;
    }
}
