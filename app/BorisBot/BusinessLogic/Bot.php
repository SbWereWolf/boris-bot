<?php

namespace App\BorisBot\BusinessLogic;

use App\BorisBot\DataAccess\DataBase\AnswerRepository;
use App\BorisBot\DataAccess\DataBase\Question;
use Mockery\Exception;

class Bot
{
    public static function askNextQuestion(
        int $answerId
    ): Question {
        $repo = new AnswerRepository($answerId);

        $next = $repo->getAnswerNextQuestion();
        if (!$next->exists) {
            $next = $repo->getAnswerQuestionNextQuestion();
        }
        if (!$next->exists) {
            throw new Exception('Для ответа не найден следующий вопрос');
        }

        return $next;
    }
}
