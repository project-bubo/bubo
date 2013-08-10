<?php

namespace Bubo\Application;

use Nette\Application\PresenterFactory as NettePresenterFactory;

/**
 * Default Bubo presenter loader.
 *
 */
class PresenterFactory extends NettePresenterFactory
{

	/**
	 * Formats presenter class name from its name.
	 * @param  string
	 * @return string
	 */
	public function formatPresenterClass($presenter)
	{
		return str_replace(':', 'Module\\Presetners\\', $presenter) . 'Presenter';
	}



	/**
	 * Formats presenter name from class name.
	 * @param  string
	 * @return string
	 */
	public function unformatPresenterClass($class)
	{
		return str_replace('Module\\Presenters\\', ':', substr($class, 0, -9));
	}

}
