<?php

namespace App\BorisBot\DataAccess\DataBase;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Question extends Model
{
    /** @var string Суть вопроса */
    private string $meaning;

    /** @var int Опрос */
    private int $survey_id;

    /** @var int Следующий вопрос */
    private ?int $next_question_id;

    /**
     * @return BelongsTo
     */
    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    /**
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * @return HasOne
     */
    public function nextQuestion(): HasOne
    {
        return $this->hasOne(Question::class, 'next_question_id');
    }
}
