<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'branch_office_id',
        'cashier_id',
        'cash_amount',
        'card_amount',
        'quantity',
        'created_at',
        'updated_at'
    ];
}