<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Products;
use App\Http\Controllers\API\ProductsController;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;
use Mockery;
use Carbon\Carbon;

class ProductsContollerTest extends TestCase
{

    public function test_show_returns_product()
    {   
        $arrayProduct = json_decode(file_get_contents(__DIR__.'/../../products.json'));

        $product = Products::query()->updateOrCreate([
            'code' => $arrayProduct[0]->code,
        ], [
            'code' => (int) preg_replace("/[^0-9]/", "", $arrayProduct[0]->code),
            'status' => "draft",
            'imported_t' => Carbon::now(),
            'url' => $arrayProduct[0]->url,
            'creator' => $arrayProduct[0]->creator,
            'created_t' => $arrayProduct[0]->created_t,
            'last_modified_t' => $arrayProduct[0]->last_modified_t,
            'product_name' => $arrayProduct[0]->product_name,
            'quantity' => $arrayProduct[0]->quantity,
            'brands' => $arrayProduct[0]->brands,
            'categories' => $arrayProduct[0]->categories,
            'labels' => $arrayProduct[0]->labels,
            'cities' => $arrayProduct[0]->cities,
            'purchase_places' => $arrayProduct[0]->purchase_places,
            'ingredients_text' => $arrayProduct[0]->ingredients_text,
            'traces' =>$arrayProduct[0]->traces,
            'serving_size' => $arrayProduct[0]->serving_size,
            'serving_quantity' => (float) $arrayProduct[0]->serving_quantity,
            'nutriscore_score' => (int) $arrayProduct[0]->nutriscore_score,
            'nutriscore_grade' => $arrayProduct[0]->nutriscore_grade,
            'main_category' => $arrayProduct[0]->main_category,
            'image_url' => $arrayProduct[0]->image_url,
        ]);

        $controller = new ProductsController();
        $response = $controller->show($product->id);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->status());
        $this->assertEquals($product->id, $response->getData()->data->id);
    }

    public function test_destroy_returns_not_found()
    {
        $controller = new ProductsController();
        $response = $controller->destroy(999);

        $this->assertEquals($response ->status(), 422);
    }
}
