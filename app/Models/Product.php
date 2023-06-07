<?php

namespace App\Models;

use App\Services\ProductDiscountService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku','name','category','price'
    ];

    /*
     * the use of attributes, may be difficult to understand for debug sake
     */
    /*public function getPriceAttribute($value){
        return (new ProductDiscountService($this,$value))
            ->checkCategoryDiscount()
            ->checkSKUDiscount()
            ->getDiscount();
    }*/
}
