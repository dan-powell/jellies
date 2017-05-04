<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MinionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(DanPowell\Jellies\Models\Game\Miniontype::class, rand(3,6))->create();
        factory(DanPowell\Jellies\Models\Game\Miniontype::class)->states('basic')->create();
        factory(DanPowell\Jellies\Models\Game\Miniontype::class)->states('knight')->create();
    }
}
