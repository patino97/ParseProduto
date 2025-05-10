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
use App\Http\Controllers\API\Response;

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

    public function show($id): JsonResponse
    {
            try {
    
                $products = Products::where('id', $id)->first();
    
                if (!$products) {
                    return response()->json([
                        'status' => false,
                        'error' => 'Cliente nao encontrado.',
                    ], JsonResponse::HTTP_NOT_FOUND);
                }
    
                return $this->responseSuccess('Produtos recuperados com sucesso', new ProductsResource($products));
            
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'error' => 'Erro ao buscar cliente.',
                    'details' => $e->getMessage(),
                ], 422);
            }
    }

    public function update(UpdateProductsRequest $request, $id): JsonResponse
    {
        try {
            $products = Products::where('id', $id)->first();

            if (!$products) {
                return response()->json([
                    'status' => false,
                    'error' => 'Produto nao encontrado.',
                ], JsonResponse::HTTP_NOT_FOUND);
            }
            
            $validatedData = $request->validated();
            $products->update($validatedData);
           
            return $this->responseSuccess('Products updated Successfully', new ProductsResource($products));
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => 'Erro ao atualizar produto.',
                'details' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy($id): JsonResponse
    {
     try {
        $products = Products::where('id', $id)->first();

            if (!$products) {
                return response()->json([
                    'status' => false,
                    'error' => 'Produto nao encontrado.',
                ], JsonResponse::HTTP_NOT_FOUND);
            }   
            $products->delete();

            return $this->responseDeleted();

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => 'Erro ao deletar produto.',
                'details' => $e->getMessage(),
            ], 422);
        }
    }

   
}
