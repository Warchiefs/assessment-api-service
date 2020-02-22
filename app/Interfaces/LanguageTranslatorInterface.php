<?php

namespace App\Interfaces;

interface LanguageTranslatorInterface
{
    /**
     * @param string $sourceText
     * @param string $resultLanguage
     *
     * @return string
     */
    public function translate(string $sourceText, string $resultLanguage): string;
}