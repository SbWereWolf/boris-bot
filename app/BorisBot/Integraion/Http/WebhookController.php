<?php

namespace App\Integraion\Http;

use App\BorisBot\BusinessLogic\Bot;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class WebhookController extends Controller
{
    public function input(Request $request)
    {
        $answerId = $request->input('id');

        $result = Bot::askNextQuestion($answerId);

        return $result;
    }
}
