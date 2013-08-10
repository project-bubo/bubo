<?php
namespace Bubo\Localization;

use Nette\Localization\ITranslator;

/**
 * TranslatorAwareInterface
 * @author jurasm2
 */
interface TranslatorAwareInterface {

    public function setTranslator(ITranslator $translator);

}
