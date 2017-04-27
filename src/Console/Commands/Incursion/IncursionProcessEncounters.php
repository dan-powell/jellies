<?php

namespace DanPowell\Jellies\Console\Commands\Incursion;

use Illuminate\Console\Command;
use DanPowell\Jellies\Repositories\Game\IncursionRepository;
use DanPowell\Jellies\Repositories\Game\EncounterRepository;

use DanPowell\Jellies\Jobs\IncursionEncounter;

class IncursionProcessEncounters extends Command
{

    protected $repo;
    protected $encounterRepo;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'incursion:encounters {--queue}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Processes an encounter for all incursions. Optionally use --queue to send all encounters to queue for delayed processing';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(IncursionRepository $repo, EncounterRepository $encounterRepo)
    {
        parent::__construct();
        $this->repo = $repo;
        $this->encounterRepo = $encounterRepo;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Get all active incursions
        $incursions = $this->repo->queryAll()->active()->get();

        foreach($incursions as $incursion) {
            if ($this->option('queue')) {
                // Send the job to the queue
                dispatch(new IncursionEncounter($incursion));
            } else {
                $this->encounterRepo->encounter($incursion);
            }

        }

    }
}
