<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class IncursionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(DanPowell\Jellies\Models\Game\Incursion::class, 10)->create()->each(function($i) {
            $minions = factory(DanPowell\Jellies\Models\Game\Minion::class, rand(1,10))->create();
            $i->minions()->attach($minions);
        });
    }
}
