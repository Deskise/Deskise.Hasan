<?php

namespace App\Console\Commands;

use App\Helpers\APIHelper;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;


class MakeApiController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:apiController {name} {version?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make New Controller For API Based on a version';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $version = $this->arguments()['version'];
        $name = $this->arguments()['name'];

        if ($version===null)
        {
            $version = config('app.api_latest');
        }

        $version = APIHelper::getVersion($version, $p, $n);
        if (in_array($version, APIHelper::getAllowedVersions(), true) === false)
        {
            $this->error('Selected Api version Is Not Allowed');
            return self::INVALID;
        }

        $name = explode('\\', $name);
        foreach ($name as $key => $item)
        {
            $name[$key] = ucwords($item);
        }

        $controllerName = $n.'\\'.ucwords(implode('\\',$name)).'Controller';

        Artisan::call('make:controller',['name' => $controllerName]);

        $this->info("{$controllerName} Controller Created Successfully");
        return self::SUCCESS;
    }
}
