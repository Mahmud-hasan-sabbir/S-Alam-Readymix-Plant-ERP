<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ReferenceType;
use App\Models\datasetting\materials;
use App\Models\datasetting\category;
use App\Models\datasetting\storeName;
use App\Models\datasetting\unit;

class ImportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //______________MASTER________________//

        materials::create([
            'category_id' => '1',
            'name'=>'Black Stone',
            'description'=>'test',
            'status'=>'1',
        ]);
        materials::create([
            'category_id' => '1',
            'name'=>'Mixed Builder',
            'description'=>'test',
            'status'=>'1',
        ]);
        materials::create([
            'category_id' => '1',
            'name'=>'Dubai',
            'description'=>'test',
            'status'=>'1',
        ]);
        materials::create([
            'category_id' => '1',
            'name'=>'10MM',
            'description'=>'test',
            'status'=>'1',
        ]);
        materials::create([
            'category_id' => '2',
            'name'=>'PCC Cement',
            'description'=>'test',
            'status'=>'1',
        ]);
        materials::create([
            'category_id' => '2',
            'name'=>'OPC Cement',
            'description'=>'test',
            'status'=>'1',
        ]);
        materials::create([
            'category_id' => '2',
            'name'=>'Beg Cement',
            'description'=>'test',
            'status'=>'1',
        ]);
        materials::create([
            'category_id' => '3',
            'name'=>'Sand',
            'description'=>'test',
            'status'=>'1',
        ]);
        materials::create([
            'category_id' => '4',
            'name'=>'Admixer',
            'description'=>'test',
            'status'=>'1',
        ]);
        materials::create([
            'category_id' => '5',
            'name'=>'Bricks',
            'description'=>'test',
            'status'=>'1',
        ]);

        category::create([
            'name'=>'Stone',
            'description'=>'test',
            'status'=>'1',
        ]);
        category::create([
            'name'=>'Cement',
            'description'=>'test',
            'status'=>'1',
        ]);
        category::create([
            'name'=>'Sand',
            'description'=>'test',
            'status'=>'1',
        ]);
        category::create([
            'name'=>'Admixer',
            'description'=>'test',
            'status'=>'1',
        ]);
        category::create([
            'name'=>'Bricks',
            'description'=>'test',
            'status'=>'1',
        ]);

        storeName::create([
            'name'=>'Black Stone',
            'description'=>'test',
            'status'=>'1',
        ]);
        storeName::create([
            'name'=>'Mixed Builder',
            'description'=>'test',
            'status'=>'1',
        ]);
        storeName::create([
            'name'=>'Dubai',
            'description'=>'test',
            'status'=>'1',
        ]);
        storeName::create([
            'name'=>'10MM',
            'description'=>'test',
            'status'=>'1',
        ]);
        storeName::create([
            'name'=>'PCC Cement',
            'description'=>'test',
            'status'=>'1',
        ]);
        storeName::create([
            'name'=>'OPC Cement',
            'description'=>'test',
            'status'=>'1',
        ]);
        storeName::create([
            'name'=>'Beg Cement',
            'description'=>'test',
            'status'=>'1',
        ]);
        storeName::create([
            'name'=>'Sand',
            'description'=>'test',
            'status'=>'1',
        ]);
        storeName::create([
            'name'=>'Admixer',
            'description'=>'test',
            'status'=>'1',
        ]);
        storeName::create([
            'name'=>'Bricks',
            'description'=>'test',
            'status'=>'1',
        ]);
        unit::create([
            'name'=>'KG',
            'description'=>'test',
            'status'=>'1',
        ]);




    }
}
