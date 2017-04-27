<?php

namespace DanPowell\Jellies\Http\Controllers;

use App\Http\Controllers\Controller;

use DanPowell\Jellies\Repositories\Game\IncursionRepository;
use DanPowell\Jellies\Repositories\Game\EncounterRepository;

class TestController extends Controller
{

    public function __construct(IncursionRepository $incursionRepo, EncounterRepository $encounterRepo)
    {
        $this->incursionRepo = $incursionRepo;
        $this->encounterRepo = $encounterRepo;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function processIncursion($id)
    {

        // Get all active incursions
        $incursion = $this->incursionRepo->queryAll()->active()->find($id);

        $this->encounterRepo->encounter($incursion);

        return redirect(route('incursion.show', $incursion->id));

    }

}
