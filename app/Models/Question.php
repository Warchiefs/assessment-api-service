<?php

namespace App\Models;

use App\Interfaces\HasTranslationMethods;
use App\Traits\TranslationMethods;
use Carbon\Carbon;

class Question extends AbstractModel implements HasTranslationMethods
{
    use TranslationMethods;

    public $text;
    public $createdAt;
    public $choices = [];

    const CREATED_AT_FORMAT = 'Y-m-d\TH:i:s.v\Z';

    /**
     * @param array $array
     *
     * @return Question|null
     */
    public static function fromArray(array $array): ?Question
    {
        $instance = new self();

        foreach ($array as $fieldKey => $fieldValue) {
            if ($fieldKey === 'text') {
                $instance->text = $fieldValue;
            }

            if ($fieldKey === 'createdAt') {
                $instance->setCreatedAt(Carbon::parse($fieldValue, config('app.timezone')));
            }

            if ($fieldKey === 'choices') {
                foreach ($fieldValue as $choiceArray) {
                    $instance->choices[] = Choice::fromArray($choiceArray);
                }
            }
        }

        return $instance;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt(Carbon $createdAt): void
    {
        $this->createdAt = $createdAt->format(self::CREATED_AT_FORMAT);
    }

    /**
     * @return array
     */
    protected function getFieldsForTranslation(): array
    {
        return ['text', 'choices'];
    }
}
