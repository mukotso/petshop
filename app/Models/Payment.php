<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Payment extends Model
{
    use HasFactory, HasUuids;

    protected  $fillable = ['uuid','type','details'];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y h:i a',
        'updated_at' => 'datetime:d/m/Y h:i a',
        'details'=> 'array',
    ];
}
