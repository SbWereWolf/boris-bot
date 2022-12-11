<?php

namespace App\BorisBot\DataAccess\DataBase;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    /** @var int Вопрос */
    private int $question_id;

    /** @var int Следующий вопрос */
    private ?int $next_question_id;

    /**
     * @return BelongsTo
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * @return BelongsTo
     */
    public function nextQuestion()
    {
        return $this->belongsTo(Question::class, 'next_question_id');
    }
}
