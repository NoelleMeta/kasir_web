<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Satu transaksi punya banyak item
    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
