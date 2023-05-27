<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResponse;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductService $service)
    {
    }

    public function show(Request $request, Product $product)
    {
        return new ProductResponse(
            [
                'product' => $product,
                'similarProduct' => $this->service->getSimilarProducts($product)
            ]
        );
    }
}
