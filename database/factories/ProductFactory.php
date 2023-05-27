<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public const COLORS = [
        'желтые',
        'зеленые',
        'синие',
        'оранжевые',
        'черные',
        'белые',
        'фиолетовые',
        'коричневые',
        'голубые',
    ];

    public const CLOTHES = [
        'штаны',
        'кроссовки',
        'джинсы',
        'брюки'
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            Product::FIELD_NAME => Arr::random(self::COLORS) . ' ' . Arr::random(self::CLOTHES),
            Product::FIELD_VIEWS => 0,
//            Product::FIELD_VIEWS => $this->faker->randomNumber(1),
        ];
    }
}
