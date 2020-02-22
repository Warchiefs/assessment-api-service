<?php

namespace App\Models;

use App\Interfaces\HasTranslationMethods;
use App\Traits\TranslationMethods;

class Choice extends AbstractModel implements HasTranslationMethods
{
    use TranslationMethods;

    public $text;

    /**
     * @param array $array
     *
     * @return Choice|null
     */
    public static function fromArray(array $array): ?Choice
    {
        $instance = new self();

        if ($array['text'] ?? false) {
            $instance->text = $array['text'];
        }

        return $instance;
    }

    /**
     * @return array
     */
    protected function getFieldsForTranslation(): array
    {
        return ['text'];
    }
}
