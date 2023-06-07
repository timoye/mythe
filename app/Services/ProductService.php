<?php

namespace App\Services;

use App\Models\Product;

class ProductService{
    public $products;

    public function selectNeededColumns(){
        $this->products=Product::select('sku','name','category','price');
        return $this;
    }
    public function filterCategory(){
        if (request()->filled('category')){
            $this->products=$this->products->where('category',request()->category);
        }
        return $this;
    }
    public function filterPriceLessThan(){
        if (request()->filled('priceLessThan')){
            $this->products=$this->products->where('price','<=',request()->priceLessThan);
        }
        return $this;
    }

    public function getProducts(){
        $this->products=$this->products->take(5)->get();
        return $this;
    }

    public function calculateDiscount(){
        $this->products->map(function ($product){
            $product['price']=(new ProductDiscountService($product))
                ->checkCategoryDiscount()
                ->checkSKUDiscount()
                ->getDiscount();
            return $product;
        });
        return $this;
    }

    public function getResultsJson(){
        return $this->products;
    }
}

