<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ourclients extends Model
{
    use HasFactory;
    protected $fillable = ['name_clients', 'information', 'links', 'image', 'status'];
}
