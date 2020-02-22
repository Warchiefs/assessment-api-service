<?php

namespace App\Interfaces;

interface LanguageTranslatorClientInterface
{
    /**
     * @param string $language
     *
     * @return LanguageTranslatorClientInterface
     */
    public function setSourceLanguage(string $language): LanguageTranslatorClientInterface;

    /**
     * @param string $language
     *
     * @return LanguageTranslatorClientInterface
     */
    public function setResultLanguage(string $language): LanguageTranslatorClientInterface;

    /**
     * @param string $text
     *
     * @return string
     */
    public function translate(string $text): string;
}