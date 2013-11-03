<?php
namespace Bubo\Application\UI;

use Bubo\Localization\TranslatorAwareInterface;

use Nette\Application\UI\Presenter as NettePresenter;
use Nette\ComponentModel\IComponent;

use GettextTranslator;

/**
 * Parent of all presenters in Bubo application.
 * Supports handling of "native" components.
 */
class Presenter extends NettePresenter
{

    /**
     * Array mapping the component name (key) to component class (value)
     * Component name is representer by regular expression.
     * @var array
     */
    protected $nativeControlMap = array();


    /** @var GettextTranslator\Gettext */
    protected $translator;


    /**
     * Injects translator
     * @param GettextTranslator\Gettext
     */
    public function injectTranslator(GettextTranslator\Gettext $translator)
    {
        $this->translator = $translator;
    }

    /**
     *
     * @return GettextTranslator\Gettext
     */
    public function getTranslator() {
        return $this->translator;
    }

    /**
     * Customized template factory (utilizing injected Gettext translator)
     * @param  string|NULL
     * @return Nette\Templating\ITemplate
     */
    public function createTemplate($class = NULL)
    {
        $template = parent::createTemplate($class);
        $this->translator->setLang($this->getFullLang());
        $template->setTranslator($this->translator);
        return $template;
    }

    /**
     * Generic component factory method
     * @param string $name
     * @return IComponent  the created component
     */
    public function createComponent($name)
    {
        if (is_array($this->nativeControlMap)) {

            foreach ($this->nativeControlMap as $regexp => $classPrefix) {
                if (preg_match($regexp, $name)) {
                    $className = sprintf('BuboApp\\%s\\%s', $classPrefix, ucfirst($name));
                    if (class_exists($className)) {
                        // TODO check signature of constructor
                        $component = new $className($this, $name);
                        if ($component instanceof TranslatorAwareInterface) {
                            $component->setTranslator($this->context->translator);
                        }
                        return $component;
                    }
                }
            }

        }
        return parent::createComponent($name);
    }

}