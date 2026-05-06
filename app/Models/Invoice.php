<?php

namespace App\Models;

use Illuminate\Console\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'type', 'is_paid', 'amount', 'payment_date'])]
#[Hidden(['created_at', 'updated_at'])]
class Invoice extends Model
{
    protected $table = 'invoices';

    public function casts(): array
    {
        return [
            'is_paid' => 'boolean',
            'amount' => 'decimal:2',
            'payment_date' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
