<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ee\License;
use App\Setting;

class AddLicenseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'license:add {license}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        Setting::create([
            'key' => License::LICENSE_SETTING_KEY,
            'value' => $this->argument('license')
        ]);

        return License::import();
    }
}
