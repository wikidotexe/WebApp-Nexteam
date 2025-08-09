<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'description',
        'quantity',
        'unit_price',
        'total'
    ];

    // Hitung total otomatis kalau belum diisi
    protected static function booted()
    {
        static::creating(function ($item) {
            if (is_null($item->total)) {
                $item->total = $item->quantity * $item->unit_price;
            }
        });

        static::updating(function ($item) {
            if ($item->isDirty(['quantity', 'unit_price'])) {
                $item->total = $item->quantity * $item->unit_price;
            }
        });
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
