<?php

namespace App\BorisBot\DataAccess\DataBase;

use Mockery\Exception;

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
            throw new Exception(
                'Ответ не имеет вопроса, чините как хотите'
            );
        }

        /* @var Question $result */
        $result = $question->nextQuestion()->firstOrNew();

        return $result;
    }
}
