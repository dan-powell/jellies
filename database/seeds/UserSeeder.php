<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Create the test user
        $test = factory(DanPowell\Jellies\Models\User::class)->states('test')->create();

        // Give them some messages
        factory(DanPowell\Jellies\Models\Ui\Message::class, rand(3,6))->make()->each(function($i) use ($test) {
            $test->messages()->save($i);
        });

        // Give them some minions
        factory(DanPowell\Jellies\Models\Game\Minion::class, 1)->create()->each(function($i) use ($test) {
            $test->minions()->save($i);
        });

        // Create a new user with a blank account
        factory(DanPowell\Jellies\Models\User::class, 1)->states('new')->create();

        // Create a few other users
        factory(DanPowell\Jellies\Models\User::class, 4)->create()->each(function($i) {
            $i->minions()->save(factory(DanPowell\Jellies\Models\Game\Minion::class)->make());
        });

    }
}
