<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'title', 'description', 'rate',
        'billing_type', 'amount', 'status', 'start_date', 'end_date', 'due_date'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function timesheets()
    {
        return $this->hasMany(Timesheet::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
