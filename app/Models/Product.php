<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_name',
        'product_description',
        'product_image',
        'sku',
        'actual_price',
        'selling_price',
        'brand_id',
        'qty',
        'status',
        'created_by',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'actual_price',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function product_attributes(){
        return $this->hasMany(ProductAttributes::class);
    }

    public function ProductGalleries()
    {
        return $this->hasMany(ProductGalleries::class);
    }
}
