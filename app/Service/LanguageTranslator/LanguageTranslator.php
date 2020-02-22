<?php

namespace App\Service\LanguageTranslator;

use App\Interfaces\LanguageTranslatorClientInterface;
use App\Interfaces\LanguageTranslatorInterface;

/**
 * Class LanguageTranslator
 *
 * @package App\Service\LanguageTranslator
 */
class LanguageTranslator implements LanguageTranslatorInterface
{
    /**
     * @var LanguageTranslatorClientInterface
     */
    private $client;

    /**
     * LanguageTranslator constructor.
     *
     * @param LanguageTranslatorClientInterface $client
     */
    public function __construct(LanguageTranslatorClientInterface $client)
    {
        $this->client = $client;
        $this->client->setSourceLanguage(config('translation.source_language'));
    }

    /**
     * @param string $sourceText
     * @param string $resultLanguage
     *
     * @return string
     */
    public function translate(string $sourceText, string $resultLanguage): string
    {
        if ($resultLanguage === config('translation.source_language')) {
            return $sourceText;
        }

        return $this->client
            ->setResultLanguage($resultLanguage)
            ->translate($sourceText);
    }
}