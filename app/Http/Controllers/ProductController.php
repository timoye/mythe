<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductDiscountService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProducts(){

        $products= (new ProductService())
            ->start()
            ->filterCategory()
            ->getProducts()
            ->calculateDiscount()
            ->filterPriceLessThan()
            ->getResultsJson();

       return $products;

    }
}
