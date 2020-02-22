<?php

namespace App\Traits;

use App\Interfaces\HasTranslationMethods;
use App\Interfaces\LanguageTranslatorInterface;

trait TranslationMethods
{
    /**
     * @param string $language
     *
     * @return HasTranslationMethods
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function translate(string $language): HasTranslationMethods
    {
        if (!empty($this->getFieldsForTranslation())) {
            foreach ($this->getFieldsForTranslation() as $fieldForTranslation) {
                if (is_array($this->$fieldForTranslation)) {
                    foreach ($this->$fieldForTranslation as $i => $nestedFieldForTranslation) {
                        $this->$fieldForTranslation[$i] = $this->translateStringOrModel($nestedFieldForTranslation, $language);
                    }
                } else {
                    $this->$fieldForTranslation = $this->translateStringOrModel($this->$fieldForTranslation, $language);
                }
            }
        }

        return $this;
    }

    /**
     * @param $stringOrModelForTranslating
     * @param string $language
     *
     * @return HasTranslationMethods|string
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function translateStringOrModel($stringOrModelForTranslating, string $language)
    {

        if ($stringOrModelForTranslating instanceof HasTranslationMethods) {
            return $stringOrModelForTranslating->translate($language);
        } else {

            /**
             * @var $languageTranslator LanguageTranslatorInterface
             */
            $languageTranslator = app()->make(LanguageTranslatorInterface::class);
            return  $languageTranslator->translate($stringOrModelForTranslating, $language);
        }
    }

    /**
     * If you need translate specified model fields
     * or other models which contained in specified array
     *
     * @return array
     */
    abstract protected function getFieldsForTranslation(): array;
}