<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'work_date', 'hours', 'notes'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
