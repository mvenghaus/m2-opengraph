<?php

namespace Inkl\OpenGraph\Model\Provider;

use Magento\Framework\App\RequestInterface;

class RouteProvider
{
	/**
	 * @var RequestInterface
	 */
	private $request;

	/**
	 * @param RequestInterface $request
	 */
	public function __construct(RequestInterface $request)
	{
		$this->request = $request;
	}

	public function getCurrentName()
	{
		return sprintf('%s_%s_%s', $this->request->getModuleName(), $this->request->getControllerName(), $this->request->getActionName());
	}

}