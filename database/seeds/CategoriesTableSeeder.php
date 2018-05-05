<?php

use Illuminate\Database\Seeder;

use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'id' => 1,
                'code' => 'ao',
                'name' => 'ao',
            ],
            [
                'id' => 2,
                'code' => 'quan',
                'name' => 'quan',
            ],
        ];

        foreach ($categories as $category) {
            Category::forceCreate([
                'id' => $category['id'],
                'code' => $category['code'] ? : $category['id'],
                'name' => $category['name'],
                'status' => true,
                'created_by' => 1,
                'updated_by' => 1,
            ]);
        }
    }
}
