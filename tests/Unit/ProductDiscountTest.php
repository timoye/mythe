<?php

namespace Tests\Unit;

use App\Services\ProductDiscountService;
use PHPUnit\Framework\TestCase;

class ProductDiscountTest extends TestCase
{

    public function testDiscountWorksOnBootsCategory(){
        $product=[
            "sku"=> "000001",
            "name"=> "BV Lean leather ankle boots",
            "category"=> "boots",
            "price"=> 89000
        ];
        $product=(object) collect($product)->toArray();
        $price=(new ProductDiscountService($product))
            ->checkCategoryDiscount()
            ->checkSKUDiscount()
            ->getDiscount();
        $this->assertEquals('30%',$price['discount_percentage']);
    }

    public function testDiscountWorksOnSKU(){
        $product=[
            "sku"=> "000003",
            "name"=> "BV Lean leather ankle boots",
            "category"=> "sandals",
            "price"=> 89000
        ];
        $product=(object) collect($product)->toArray();
        $price=(new ProductDiscountService($product))
            ->checkCategoryDiscount()
            ->checkSKUDiscount()
            ->getDiscount();
        $this->assertEquals('15%',$price['discount_percentage']);
    }

    public function testWhenMultipleDiscountsCollideTheBiggestDiscountMustBeApplied(){
        $product=[
            "sku"=> "000003",
            "name"=> "BV Lean leather ankle boots",
            "category"=> "boots",
            "price"=> 89000
        ];
        $product=(object) collect($product)->toArray();
        $price=(new ProductDiscountService($product))
            ->checkCategoryDiscount()
            ->checkSKUDiscount()
            ->getDiscount();
        $this->assertEquals('30%',$price['discount_percentage']);
    }

    public function testPriceCurrencyIsAlwaysEUR(){
        $product=[
            "sku"=> "000001",
            "name"=> "BV Lean leather ankle boots",
            "category"=> "boots",
            "price"=> 89000
        ];
        $product=(object) collect($product)->toArray();
        $price=(new ProductDiscountService($product))
            ->checkCategoryDiscount()
            ->checkSKUDiscount()
            ->getDiscount();
        $this->assertEquals('EUR',$price['currency']);
    }

    public function testWhenProductDoesNotHaveDiscountFinalIsOriginal(){
        $product=[
            "sku"=> "000004",
            "name"=> "Naima embellished suede sandals",
            "category"=> "sandals",
            "price"=> 79500
        ];
        $product=(object) collect($product)->toArray();
        $price=(new ProductDiscountService($product))
            ->checkCategoryDiscount()
            ->checkSKUDiscount()
            ->getDiscount();
        $this->assertEquals($price['original'],$price['final']);
    }

    public function testWhenProductDoesNotHaveDiscountDiscountPercentageIsNull(){
        $product=[
            "sku"=> "000004",
            "name"=> "Naima embellished suede sandals",
            "category"=> "sandals",
            "price"=> 79500
        ];
        $product=(object) collect($product)->toArray();
        $price=(new ProductDiscountService($product))
            ->checkCategoryDiscount()
            ->checkSKUDiscount()
            ->getDiscount();
        $this->assertNull($price['discount_percentage']);
    }

    public function testWhenProductHasDiscountOriginalIsTheOriginalPrice(){
        $product=[
            "sku"=> "000003",
            "name"=> "Naima embellished suede sandals",
            "category"=> "sandals",
            "price"=> 79500
        ];
        $product=(object) collect($product)->toArray();
        $price=(new ProductDiscountService($product))
            ->checkCategoryDiscount()
            ->checkSKUDiscount()
            ->getDiscount();
        $this->assertEquals($product->price,$price['original']);
    }

    public function testWhenProductHasDiscountFinalIsAmountWithDiscountApplied(){
        $product=[
            "sku"=> "000003",
            "name"=> "Naima embellished suede sandals",
            "category"=> "sandals",
            "price"=> 79500
        ];
        $product=(object) collect($product)->toArray();
        $price=(new ProductDiscountService($product))
            ->checkCategoryDiscount()
            ->checkSKUDiscount()
            ->getDiscount();
        $discount_amount=$price['original']-$price['final'];
        $this->assertEquals($discount_amount,((int)$price['discount_percentage']/100*$product->price));
    }
    public function testWhenProductHasDiscountDiscountPercentageHasPercentSign(){
        $product=[
            "sku"=> "000003",
            "name"=> "Naima embellished suede sandals",
            "category"=> "sandals",
            "price"=> 79500
        ];
        $product=(object) collect($product)->toArray();
        $price=(new ProductDiscountService($product))
            ->checkCategoryDiscount()
            ->checkSKUDiscount()
            ->getDiscount();
        $this->assertTrue(str_contains($price['discount_percentage'],'%'));
    }
}
