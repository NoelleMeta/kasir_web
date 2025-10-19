<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // Item belongs to one transaction
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
