<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentIssueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_issue', function (Blueprint $table) {
            //$table->increments('id');
            $table->integer('comment_id')->unsigned()->index();
            $table->foreign('comment_id')->references('id')->on('comments')->ondelete('cascade');

            $table->integer('issue_id')->unsigned()->index();
            $table->foreign('issue_id')->references('id')->on('issues')->ondelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_issue');
    }
}
