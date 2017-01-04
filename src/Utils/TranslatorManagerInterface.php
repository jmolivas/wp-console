<?php

/**
 * @file
 * Contains \WP\Console\Utils\TranslatorManagerInterface.
 */

namespace WP\Console\Utils;

use Symfony\Component\Translation\Translator;

interface TranslatorManagerInterface
{

    /**
     * @param $language
     * @param $directoryRoot
     * @return $this
     */
    public function loadCoreLanguage($language, $directoryRoot);

    /**
     * @param $language
     * @return $this
     */
    public function changeCoreLanguage($language);

    /**
     * @param $language
     * @param $directoryRoot
     *
     * @return void
     */
    public function loadResource($language, $directoryRoot);

    /**
     * @return Translator
     */
    public function getTranslator();

    /**
     * @return string
     */
    public function getLanguage();

    /**
     * @param $key
     *
     * @return string
     */
    public function trans($key);
}
