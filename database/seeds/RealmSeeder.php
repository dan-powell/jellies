<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use DanPowell\Jellies\Repositories\Game\TypeRepository;

class RealmSeeder extends Seeder
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

        $realms = factory(DanPowell\Jellies\Models\Game\Realm::class, rand(1,4))->create();

        $types = $this->repo->query()->get();

        foreach($realms as $realm) {
            for ($i = 0; $i < rand(0, 2); $i++) {
                $realm->types()->save($types->random());
            }
        }

    }
}
