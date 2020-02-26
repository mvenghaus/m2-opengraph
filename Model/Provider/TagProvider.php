<?php

namespace Inkl\OpenGraph\Model\Provider;

class TagProvider
{
	/**
	 * @var array
	 */
	private $routeHandler;

	/**
	 * @param array $routeHandler
	 */
	public function __construct(array $routeHandler)
	{
		$this->routeHandler = $routeHandler;
	}

	public function getByRouteName($routeName)
	{
		if (isset($this->routeHandler[$routeName]))
		{
			return $this->routeHandler[$routeName]->getTags();
		}

		return $this->routeHandler['default']->getTags();
	}
}