<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\UpdateProductsRequest;
use App\Http\Requests\Products\CreateProductsRequest;
use App\Http\Resources\Products\ProductsResource;
use App\Models\Products;
use Essa\APIToolKit\Api\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Js;

class ProductsController extends Controller
{
    use ApiResponse;
    
    public function __construct()
    {

    }

    public function index(): JsonResponse|AnonymousResourceCollection
    {
      try {
        $products = Products::useFilters()->get();

        return ProductsResource::collection($products);
        
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => 'Erro ao buscar produtods.',
                'details' => $e->getMessage(),
            ], 422);
        }
    }

    public function store(CreateProductsRequest $request): JsonResponse
    {
        $products = Products::create($request->validated());

        return $this->responseCreated('Products created successfully', new ProductsResource($products));
    }

    public function show(Products $products): JsonResponse
    {
        return $this->responseSuccess(null, new ProductsResource($products));
    }

    public function update(UpdateProductsRequest $request, Products $products): JsonResponse
    {
        $products->update($request->validated());

        return $this->responseSuccess('Products updated Successfully', new ProductsResource($products));
    }

    public function destroy(Products $products): JsonResponse
    {
        $products->delete();

        return $this->responseDeleted();
    }

   
}
