<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materials = factory(DanPowell\Jellies\Models\Game\Material::class, rand(32,64))->create();

        foreach($materials as $material) {
            for ($i = 0; $i < rand(0, 3); $i++) {
                $material->effective()->save($materials->random());
            }
            for ($i = 0; $i < rand(0, 3); $i++) {
                $material->ineffective()->save($materials->random());
            }
            for ($i = 0; $i < rand(0, 2); $i++) {
                $material->modifiers()->save(factory(DanPowell\Jellies\Models\Game\Modifier::class)->make());
            }
        }

    }
}
