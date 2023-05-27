<?php


namespace App\Services;


use App\Models\Product;

class ProductService
{
    public function getSimilarProducts(Product $product): array
    {
        // выбранный товар
        $selectedProduct = $product->toArray();

        // количество похожих товаров для вывода
        $limit = 15;

        $selectedProductNameWords = preg_split('/\s+/', $selectedProduct["name"]);
        $products = Product::query()
            ->where('id', '!=', $selectedProduct['id'])
            ->get()
            ->toArray();

        $similarProducts = [];

        // вычисление коэффициента сходства для каждого найденного товара
        foreach ($products as $product) {
            // коэффициент сходства по названию
            $productNameWords = preg_split('/\s+/', $product[Product::FIELD_NAME]);

            $intersectWords = array_intersect($selectedProductNameWords, $productNameWords);
            $uniqueWords = array_unique(array_merge($selectedProductNameWords, $productNameWords));

            // коэффициент сходства по совпадению слов
            $similarityByName = count($intersectWords) / count($uniqueWords);
            // коэффициент сходства по частоте просмотров
            $similarityByViews = $product[Product::FIELD_VIEWS] / $selectedProduct[Product::FIELD_VIEWS];

            // общий коэффициент сходства
            $similarProducts[] = array_merge(
                $product,
                ['similarity' => $similarityByName + $similarityByViews]
            );
        }

        // сортировка найденных товаров по убыванию коэффициента сходства
        usort(
            $similarProducts,
            function ($a, $b) {
                return $b["similarity"] <=> $a["similarity"];
            }
        );

        return array_slice($similarProducts, 0, min($limit, count($similarProducts)));
    }
}
