<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProducts(){

        $products= (new ProductService())
            ->selectNeededColumns()
            ->filterCategory()
            ->filterPriceLessThan()
            ->getProducts(5)
            ->calculateDiscount()
            ->getResultsJson();

       return $products;

    }
}
