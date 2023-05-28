<?php


namespace App\Services;


use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function getSimilarProducts(Product $product): array
    {
        $excludedIDs = [];

        // выбранный товар
        $selectedProduct = $product->toArray();
        $excludedIDs[] = $selectedProduct['id'];


        // количество похожих товаров для вывода
        $limit = 15;

        $selectedProductNameWords = preg_split('/\s+/', $selectedProduct[Product::FIELD_NAME]);


        $matchesString = $this->generateMatchString(count($selectedProductNameWords));

        $remainingProductsQuery = Product::query();
        $remainingProductsQuery->selectRaw("*, $matchesString * views as relevance", [$selectedProductNameWords]);
        $remainingProductsQuery->whereNotIn('id', $excludedIDs); // исключаем текущий товар

        $remainingProductsQuery = DB::query()
            ->selectRaw("*, IF(relevance, relevance, views) as similar")
            ->fromSub($remainingProductsQuery, 'products')
            ->orderBy('similar', 'desc')
            ->orderByRaw('RAND()')
            ->limit($limit);
        return $remainingProductsQuery
            ->get()
            ->toArray();
    }

    public function generateMatchString(int $findWordsCount): string
    {
        $matches = [];
        for($i = 0; $i < $findWordsCount; $i++){
            $matches[] = 'MATCH(name) AGAINST(? IN BOOLEAN MODE)';
        }
        return "(" . implode(' + ', $matches) . ")";
    }
}
