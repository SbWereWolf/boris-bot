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

        /* можно добавить обработку ошибок,
        ошибку писать в лог или ещё куда,
        в ответе отдавать только 500ку */
        $result = Bot::askNextQuestion($answerId);

        return $result;
    }
}
