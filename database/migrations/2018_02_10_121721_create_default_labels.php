<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Label;

class CreateDefaultLabels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $labels = [
            [
                'title' => 'bug',
                'color' => 'badge-danger',
                'description' => 'Application bug'
            ],
            [
                'title' => 'Missing docs',
                'color' => 'badge-warning',
                'description' => 'Missing docummentation'
            ],
        ];

        foreach ($labels as $label) {
            Label::create($label);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
