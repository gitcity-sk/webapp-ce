<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;

/**
 *
 */
class BotController extends Controller
{
    protected $config = [];
    public function hear()
    {
        $botman = app('botman');

        // Give the bot something to listen for.
        $botman->hears('', function (BotMan $bot) {
            $bot->reply('Hello yourself.');
        });

        // Start listening
        $botman->listen();
    }
}
