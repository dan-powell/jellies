<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use DanPowell\Jellies\Repositories\Game\RealmRepository;

class RealmSeeder extends Seeder
{

    private $repo;

    public function __construct(RealmRepository $repo)
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

        $this->repo->generate(10);

    }
}
