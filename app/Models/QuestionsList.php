<?php

namespace App\Models;

use App\Interfaces\HasTranslationMethods;
use App\Traits\TranslationMethods;

class QuestionsList extends AbstractModel implements HasTranslationMethods
{
    use TranslationMethods;

    public $data = [];

    public static function fromArray(array $array): QuestionsList
    {
        $instance = new self();

        foreach ($array as $questionArray) {
            $instance->data[] = Question::fromArray($questionArray);
        }

        return $instance;
    }

    public function addQuestion(Question $question)
    {
        $this->data[] = $question;
    }

    protected function getFieldsForTranslation(): array
    {
        return ['data'];
    }
}
