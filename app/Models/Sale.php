<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'sale_date',
        'invoice_no',
        'subtotal',
        'discount',
        'tax',
        'total',
        'note',
        'created_by',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

   public function items()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}