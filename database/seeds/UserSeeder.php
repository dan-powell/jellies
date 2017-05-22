<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use DanPowell\Jellies\Repositories\Game\TypeRepository;

class UserSeeder extends Seeder
{

    private $repo;

    public function __construct(TypeRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Create the test user
        $test_user = factory(DanPowell\Jellies\Models\User::class)->states('test')->create();

        // Give them some messages
        factory(DanPowell\Jellies\Models\Ui\Message::class, rand(3,6))->make()->each(function($i) use ($test_user) {
            $test_user->messages()->save($i);
        });

        $types = $this->repo->query()->get();

        foreach ($types as $type) {
            if(rand(0,3) > 2) {
                $test_user->types()->save($type, ['quantity' => rand(3,12)]);
            }
        }

        // Create a new user with a blank account
        factory(DanPowell\Jellies\Models\User::class, 1)->states('new')->create();

        // Create some NPC's
        factory(DanPowell\Jellies\Models\User::class, rand(20, 30))->states('npc')->create()->each(function($user) use ($types) {
            for($i=0; $i < rand(0,10); $i++) {
                $minion = $user->minions()->save(factory(DanPowell\Jellies\Models\Game\Minion::class)->make());

                foreach ($types as $type) {
                    if(rand(0,3) > 2) {
                        $minion->types()->save($type, ['quantity' => rand(1,3)]);
                    }
                }

            }
        });

    }
}
