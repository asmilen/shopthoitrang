<?php

use Illuminate\Database\Seeder;
use App\Models\Attribute;

class AttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $attributes = [
            [
                'id' => 1,
                'slug' => 'material',
                'name' => 'Chất liệu',
            ],
            [
                'id' => 2,
                'slug' => 'size',
                'name' => 'size',
            ],
            [
                'id' => 3,
                'slug' => 'color',
                'name' => 'Màu sắc',
            ],
        ];

        foreach ($attributes as $attribute) {
            Attribute::forceCreate([
                'id' => $attribute['id'],
                'slug' => $attribute['slug'] ? : $attribute['id'],
                'name' => $attribute['name'],
                'created_by' => 1,
                'updated_by' => 1,
            ]);
        }
    }
}
