<?php

namespace Inkl\OpenGraph\Block;

use Inkl\OpenGraph\Model\Provider\RouteProvider;
use Inkl\OpenGraph\Model\Provider\TagProvider;
use Magento\Framework\View\Element\Template;

class Tags extends \Magento\Framework\View\Element\Template
{
	/**
	 * @var RouteProvider
	 */
	private $routeProvider;
	/**
	 * @var TagProvider
	 */
	private $tagProvider;

	/**
	 * @param Template\Context $context
	 * @param RouteProvider $routeProvider
	 * @param TagProvider $tagProvider
	 * @param array $data
	 */
	public function __construct(Template\Context $context,
	                            RouteProvider $routeProvider,
	                            TagProvider $tagProvider,
	                            array $data = [])
	{
		parent::__construct($context, $data);
		$this->routeProvider = $routeProvider;
		$this->tagProvider = $tagProvider;
	}

	public function getTags()
	{
		return $this->tagProvider->getByRouteName($this->routeProvider->getCurrentName());
	}

}