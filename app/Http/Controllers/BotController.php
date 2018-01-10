<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;

/**
 *
 */
class BotController extends Controller
{
    protected $config = [];
    public function hear()
    {
        $botman = BotManFactory::create($this->config);

        // Give the bot something to listen for.
        $botman->hears('hello', function (BotMan $bot) {
            $bot->reply('Hello yourself.');
        });

        // Start listening
        $botman->listen();
    }
}
