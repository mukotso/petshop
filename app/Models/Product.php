<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Product extends Model
{
    use HasFactory, HasUuids , Softdelete;


    protected  $fillable = ['uuid','title','price','description','metadata'];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y h:i a',
        'updated_at' => 'datetime:d/m/Y h:i a',
        'metadata'=>'array',
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'uuid', 'category_uuid');
    }

}
