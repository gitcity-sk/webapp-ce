<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Setting;

class CreateRunnerSettingKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Setting::create([
            'key' => 'RUNNER_REGISTRATION_KEY',
            'value' => '-L7bu>4Z6eUPFTZh&MxbNcZC!}c'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Setting::where('key', 'RUNNER_REGISTRATION_KEY')->delete();
    }
}
