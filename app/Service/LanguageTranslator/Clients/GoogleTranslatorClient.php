<?php

namespace App\Service\LanguageTranslator\Clients;

use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Interfaces\LanguageTranslatorClientInterface;

/**
 * Class GoogleTranslatorClient
 *
 * @package App\Service\LanguageTranslator\Clients
 */
class GoogleTranslatorClient implements LanguageTranslatorClientInterface
{
    /**
     * @var GoogleTranslate
     */
    private $translator;

    /**
     * GoogleTranslatorClient constructor.
     */
    public function __construct()
    {
        $this->translator = new GoogleTranslate();
    }

    /**
     * @param string $language
     *
     * @return LanguageTranslatorClientInterface
     */
    public function setResultLanguage(string $language): LanguageTranslatorClientInterface
    {
        $this->translator->setTarget($language);
        return $this;
    }

    /**
     * @param string $language
     *
     * @return LanguageTranslatorClientInterface
     */
    public function setSourceLanguage(string $language): LanguageTranslatorClientInterface
    {
        $this->translator->setSource($language);
        return $this;
    }

    /**
     * @param string $text
     *
     * @return string
     * @throws \ErrorException
     */
    public function translate(string $text): string
    {
        return $this->translator->translate($text);
    }
}