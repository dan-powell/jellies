<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class EnemySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = factory(DanPowell\Jellies\Models\Game\Enemy::class, 10)->create();
    }
}
