<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, HasUuids , SoftDeletes;


    protected  $fillable = ['uuid','title','price','description','metadata','category_id'];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y h:i a',
        'updated_at' => 'datetime:d/m/Y h:i a',
        'metadata'=>'array',
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

}
