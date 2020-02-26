<?php

namespace Inkl\OpenGraph\Api\Data;

interface TagInterface
{
	public function getProperty(): string;

	public function setProperty(string $property);

	public function getContent(): string;

	public function setContent(string $content);

}