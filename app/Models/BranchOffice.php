<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchOffice extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'branch_office',
        'address',
        'opening_date'
    ];

    public function cashiers()
    {
        return $this->hasMany(Cashier::class);
    }
}
