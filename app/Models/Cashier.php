<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'branch_office_id',
        'cashier'
    ];

    public function branch_office()
    {
        return $this->belongsTo(BranchOffice::class);
    }
}
