<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RealmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Generate some realms
        $realms = factory(DanPowell\Jellies\Models\Game\Realm::class, 5)->create();

        $realms->each(function($realm) {

            // Generate some enemies
            $enemies = [];
            for($i = 0; $i < rand(10,20); $i++) {
                $enemies[] = $realm->enemies()->save(factory(DanPowell\Jellies\Models\Game\Enemy::class)->make());
            }

            // Generate some zones
            $zones = factory(DanPowell\Jellies\Models\Game\Zone::class, rand(config('jellies.realm.zones.min'), config('jellies.realm.zones.max')))->make()->each(function($zone) use ($realm){
                $realm->zones()->save($zone);
            });

            $zones->each(function($zone) use ($realm, $enemies){

                $zone_enemies_ids = array_rand($enemies, rand(2,5));

                foreach($zone_enemies_ids as $enemy_id) {
                    $zone->enemies()->attach($enemies[$enemy_id]);
                }

                // Add some incursions
                $incursions = factory(DanPowell\Jellies\Models\Game\Incursion::class, rand(0,3))->create();

                $incursions->each(function($i) use ($zone) {
                    // Add some minions
                    $minions = factory(DanPowell\Jellies\Models\Game\Minion::class, rand(1,10))->create();
                    $i->minions()->attach($minions);

                    $zone->incursions()->save($i);
                });

            });
        });

    }
}
