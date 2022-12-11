<?php

namespace App\BorisBot\BusinessLogic;

use App\BorisBot\DataAccess\DataBase\AnswerRepository;
use App\BorisBot\DataAccess\DataBase\Question;
use Mockery\Exception;

/* класс разруливает логику обработки данных */
class Bot
{
    public static function askNextQuestion(
        int $answerId
    ): Question {
        $repo = new AnswerRepository($answerId);

        /* следующий вопрос из ответа имеет приоритет, берём первым */
        $next = $repo->getAnswerNextQuestion();

        /* если для ответа не задан следующий вопрос,
         то смотрим в исходный вопрос */
        if (!$next->exists) {
            $next = $repo->getAnswerQuestionNextQuestion();
        }
        /* Если у вопроса нет следующего,
        то нам нечего вернуть,
        не знаю насколько это "законно",
        но падаем */
        /* Это ошибка бизнес логики,
        контроллер её ни каким особым образом не должен обрабатывать,
        специальный класс для исключения не заводим.
        Хотя если хочется вести учёт ошибок бизнес логики,
        вести учёт ошибок БД, и любых других ошибок,
         то можно сделать уникальный класс и по нему считать метрики */
        if (!$next->exists) {
            throw new Exception('Для ответа не найден следующий вопрос');
        }

        return $next;
    }
}
