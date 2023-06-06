<?php

namespace App\Services;

class ProductDiscountService{
    public $product;
    public $category_discount;
    public $sku_discount;
    public $has_discount;

    public function __construct($product)
    {
        $this->product=$product;
    }

    public function checkCategoryDiscount(){
        if (in_array($this->product->category,['boots'])){
            $this->category_discount='30';
            $this->has_discount=true;
        }
        return $this;
    }

    public function checkSKUDiscount(){
        if (in_array($this->product->sku,['000003'])){
            $this->sku_discount='15';
            $this->has_discount=true;
        }
        return $this;
    }

    public function getDiscount(){
        if (!$this->has_discount){
            return $this->noDiscount();
        }
        $use_discount=$this->category_discount>$this->sku_discount ? $this->category_discount : $this->sku_discount;
        return $this->useDiscount($use_discount);
    }

    public function noDiscount(){
        return [
            "original" => $this->product->price,
            "final" => $this->product->price,
            "discount_percentage" => null,
            "currency" => "EUR"
        ];
    }

    public function useDiscount($discount){
        $final=$this->product->price- ($discount/100)*$this->product->price;
        return [
            "original" => $this->product->price,
            "final" => $final,
            "discount_percentage" => "$discount%",
            "currency" => "EUR"
        ];
    }

}
