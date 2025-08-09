<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
    'client_id', 'project_id', 'invoice_number', 'invoice_date', 'due_date',
    'sub_total', 'tax', 'total', 'status', 'notes'
];

    protected $dates = ['invoice_date', 'due_date'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($invoice) {
            if (empty($invoice->invoice_number)) {
                $prefix = date('Y') . '-INV-';
                $last = static::whereYear('created_at', date('Y'))->max('id') ?? 0;
                $invoice->invoice_number = $prefix . str_pad($last + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
