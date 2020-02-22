<?php

namespace App\Interfaces;

interface HasTranslationMethods
{
    /**
     * @param string $language
     *
     * @return HasTranslationMethods
     */
    public function translate(string $language): HasTranslationMethods;
}