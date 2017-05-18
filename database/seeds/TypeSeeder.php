<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = factory(DanPowell\Jellies\Models\Game\Type::class, rand(32,64))->create();

        foreach($types as $type) {
            for ($i = 0; $i < rand(0, 3); $i++) {
                $type->effective()->save($types->random());
            }
            for ($i = 0; $i < rand(0, 3); $i++) {
                $type->ineffective()->save($types->random());
            }
            for ($i = 0; $i < rand(0, 2); $i++) {
                $type->modifiers()->save(factory(DanPowell\Jellies\Models\Game\Modifier::class)->make());
            }
        }

    }
}
