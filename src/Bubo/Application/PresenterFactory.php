<?php

namespace Bubo\Application;

use Nette;
use Nette\DI\IContainer;
use Nette\Application\PresenterFactory as NettePresenterFactory;

/**
 * Default Bubo presenter loader.
 *
 */
class PresenterFactory extends NettePresenterFactory
{

    protected $appNamespace = 'BuboApp';

    /**
     * Constructor
     * @param string $baseDir
     * @param Nette\ComponentModel\Container $container
     */
    public function __construct($baseDir, Nette\DI\Container $container)
    {
            parent::__construct($baseDir, $container);
    }

    /**
     * Formats presenter class name from its name.
     * @param  string
     * @return string
     */
    public function formatPresenterClass($presenter)
    {
        $chunks = explode(':', $presenter);
        $presenterName = array_pop($chunks) . 'Presenter';
        $class = $this->appNamespace .
                 '\\' . str_replace(':', 'Module\\', implode(':', $chunks) . ':') .
                 $presenterName;
        return $class;
    }



    /**
     * Formats presenter name from class name.
     * @param  string
     * @return string
     */
    public function unformatPresenterClass($class)
    {
            return substr(str_replace('Module\\', ':', substr($class, 0, -9)), 8);
    }

    /**
     * @param \Nette\DI\IContainer $container
     * @return \Bubo\Application\PresenterFactory
     */
    public static function factory(IContainer $container)
    {
        $appDir = $container->parameters['appDir'];
        return new PresenterFactory($appDir, $container);
    }

}
