<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function accountasal()
    {
        return $this->belongsTo(Account::class, 'account_asal_id');
    }

    public function accounttujuan()
    {
        return $this->belongsTo(Account::class, 'account_tujuan_id');
    }
}
