<?php

namespace App\BorisBot\DataAccess\DataBase;

use Mockery\Exception;

/** Класс реализует работу с БД,
 * изолируем знания о структуре БД в этом классе
 */
class AnswerRepository
{
    private int $answerId;

    private Answer $answer;
    private bool $wasBooted = false;

    public function __construct(int $answerId)
    {
        $this->answerId = $answerId;
    }

    public function getAnswerNextQuestion(): Question
    {
        /** @var Question $question */
        $question = $this->getAnswer()->nextQuestion()->firstOrNew();

        return $question;
    }

    private function getAnswer()
    {
        if (!$this->wasBooted) {
            /* @var Answer $answer */
            $answer = Answer::query()->findOrFail($this->answerId);
            $this->answer = $answer;

            $this->wasBooted = true;
        }

        return $this->answer;
    }

    public function getAnswerQuestionNextQuestion(): Question
    {
        /* @var Question $question */
        $question = $this->getAnswer()->question()->first();
        if (!$question) {
            /* в ТЗ не сказано как обрабатывать такие ситуации,
            значит ситуация исключительная,
            и пусть пользователь кода сам решает,
             что ему делать дальше */
            /* Исключение конечно должно иметь свой класс,
            что бы вызывающий код мог верно обработать это исключение*/
            throw new Exception(
                'Ответ не имеет вопроса, чините как хотите'
            );
        }

        /* @var Question $result */
        $result = $question->nextQuestion()->firstOrNew();

        return $result;
    }
}
