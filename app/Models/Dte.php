<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dte extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'branch_office_id',
        'cashier_id',
        'folio',
        'cash_amount',
        'card_amount',
        'subtotal',
        'tax',
        'total',
        'ticket_serial_number',
        'ticket_hour',
        'ticket_transaction_number',
        'ticket_dispenser_number',
        'ticket_station_number',
        'ticket_sa',
        'ticket_number',
        'ticket_correlative',
        'entrance_hour',
        'exit_hour',
        'item_quantity',
        'created_at',
        'updated_at'
    ];
}