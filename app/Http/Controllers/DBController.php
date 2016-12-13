<?php

namespace App\Http\Controllers;
use Artisan;

class DBController extends Controller
{
	public function migrate() {
		echo '<br>init with Migrate tables ...';
		Artisan::call('migrate', ['--quiet' => true, '--force' => true]);
		echo '<br>... done with Migrate tables :)';
	}
}
