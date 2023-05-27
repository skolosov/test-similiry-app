<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::query()->create(
            [
                Product::FIELD_NAME => 'красная рубашка',
                Product::FIELD_VIEWS => 10
            ]
        );
        Product::query()->create(
            [
                Product::FIELD_NAME => 'синяя рубашка',
                Product::FIELD_VIEWS => 5
            ]
        );
        Product::query()->create(
            [
                Product::FIELD_NAME => 'желтая рубашка',
                Product::FIELD_VIEWS => 3
            ]
        );
        Product::query()->create(
            [
                Product::FIELD_NAME => 'зеленые шорты',
                Product::FIELD_VIEWS => 2
            ]
        );
        Product::query()->create(
            [
                Product::FIELD_NAME => 'зеленые брюки',
                Product::FIELD_VIEWS => 7
            ]
        );
        Product::query()->create(
            [
                Product::FIELD_NAME => 'серые джинсы',
                Product::FIELD_VIEWS => 4
            ]
        );
        Product::query()->create(
            [
                Product::FIELD_NAME => 'белая футболка',
                Product::FIELD_VIEWS => 3
            ]
        );
        Product::factory(40)->create();
    }
}
