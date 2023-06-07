<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ProductsAPITest extends TestCase
{
    public function testProductsResponseHaveAllFields(){
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
        $response = $this->get('/products?category=boots');
        $response->assertJsonFragment([
            'category'=>'boots'
        ]);
    }

    /*public function testPriceLessThanFilterWorks()
    {

    }*/


}
