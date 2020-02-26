<?php

namespace Inkl\OpenGraph\Model;

use Inkl\OpenGraph\Api\Data\TagInterface;

class Tag implements TagInterface
{
	/** @var string */
	private $property;
	/** @var string */
	private $content;

	/**
	 * @return string
	 */
	public function getProperty(): string
	{
		return $this->property;
	}

	/**
	 * @param string $property
	 * @return $this
	 */
	public function setProperty(string $property)
	{
		$this->property = $property;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getContent(): string
	{
		return $this->content;
	}

	/**
	 * @param string $content
	 * @return $this
	 */
	public function setContent(string $content)
	{
		$this->content = $content;
		return $this;
	}
}
