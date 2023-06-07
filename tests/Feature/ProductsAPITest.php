<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ProductsAPITest extends TestCase
{
    const PRODUCTS = '[
    {
        "sku": "000001",
        "name": "BV Lean leather ankle boots",
        "category": "boots",
        "price": {
            "original": 89000,
            "final": 62300,
            "discount_percentage": "30%",
            "currency": "EUR"
        }
    },
    {
        "sku": "000003",
        "name": "Ashlington leather ankle boots",
        "category": "boots",
        "price": {
            "original": 71000,
            "final": 49700,
            "discount_percentage": "30%",
            "currency": "EUR"
        }
    },
    {
        "sku": "000002",
        "name": "BV Lean leather ankle boots",
        "category": "boots",
        "price": {
            "original": 99000,
            "final": 69300,
            "discount_percentage": "30%",
            "currency": "EUR"
        }
    },
    {
        "sku": "000004",
        "name": "Naima embellished suede sandals",
        "category": "sandals",
        "price": {
            "original": 79500,
            "final": 79500,
            "discount_percentage": null,
            "currency": "EUR"
        }
    },
    {
        "sku": "000005",
        "name": "Nathane leather sneakers",
        "category": "sneakers",
        "price": {
            "original": 59000,
            "final": 59000,
            "discount_percentage": null,
            "currencddy": "EUR"
        }
    }
]';


    public function testProductsResponseHaveAllFields(){
        Http::fake([
            '*' => Http::response(self::PRODUCTS, 200),
        ]);
        $response = $this->get('/products');
        $response->assertStatus(200)
            ->assertJsonStructure([
                [
                    'sku',
                    'name',
                    'category',
                    'price' => [
                        'original',
                        'final',
                        'discount_percentage',
                        'currency'
                    ]
                ]
            ]);
    }

    public function testCategoryFilterWorks()
    {
        Http::fake([
            '*' => Http::response(self::PRODUCTS, 200),
        ]);
        $response = $this->get('/products?category=boots');
        $response->assertJsonFragment([
            'category'=>'boots'
        ]);
    }

    /*public function testPriceLessThanFilterWorks()
    {

    }*/


}
