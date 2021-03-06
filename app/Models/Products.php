<?php

namespace App\Models;

use App\Models\ProductGallery;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = [
        'categories_id',
        'users_id',
        'code',
        'name_product',
        'slug',
        'price',
        'discount',
        'stock',
        'discount_amount',
        'description',
        'ongkir',
        'ongkir_amount'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name_product'
            ]
        ];
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search-product'] ?? false, function ($query, $search) {
            return $query->where('name_product', 'like', '%' . $search . '%');
        });
    }

    public function galleries()
    {
        return $this->hasMany(ProductGallery::class, 'products_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }


}
