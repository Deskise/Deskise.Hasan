<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use \App\Helpers\Api\Versioning;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('make:apiController {name} {version?}', function () {
    $version = $this->arguments()['version'];
    $name = $this->arguments()['name'];

    if ($version===null)
    {
        $version = config('app.api_latest');
    }

    $version = Versioning::getVersion($version, $p, $n);
    if (in_array($version, Versioning::getAllowedVersions(), true) === false)
    {
        $this->error('Selected Api version Is Not Allowed');
        exit();
    }

    $controllerName = $n.'\\'.ucfirst($name).'Controller';

    Artisan::call('make:controller',['name' => $controllerName]);

})->purpose('Make New Controller For API Based on a version');
