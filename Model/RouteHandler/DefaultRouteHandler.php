<?php

namespace Inkl\OpenGraph\Model\RouteHandler;

use Inkl\OpenGraph\Api\Data\TagInterfaceFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Page\Config as PageConfig;
use Magento\Store\Model\StoreManagerInterface;

class DefaultRouteHandler
{
	/**
	 * @var TagInterfaceFactory
	 */
	private $tagFactory;
	/**
	 * @var PageConfig
	 */
	private $pageConfig;
	/**
	 * @var DirectoryList
	 */
	private $directoryList;
	/**
	 * @var StoreManagerInterface
	 */
	private $storeManager;
	/**
	 * @var RequestInterface
	 */
	private $request;

	/**
	 * @param TagInterfaceFactory $tagFactory
	 * @param PageConfig $pageConfig
	 * @param DirectoryList $directoryList
	 * @param StoreManagerInterface $storeManager
	 * @param RequestInterface $request
	 */
	public function __construct(TagInterfaceFactory $tagFactory,
	                            PageConfig $pageConfig,
	                            DirectoryList $directoryList,
	                            StoreManagerInterface $storeManager,
	                            RequestInterface $request)
	{
		$this->tagFactory = $tagFactory;
		$this->pageConfig = $pageConfig;
		$this->directoryList = $directoryList;
		$this->storeManager = $storeManager;
		$this->request = $request;
	}

	public function getTags()
	{
		$tags = [];
		$tags += $this->getTitleTag();
		$tags += $this->getDescriptionTag();
		$tags += $this->getImageTag();
		$tags += $this->getUrlTag();

		return $tags;
	}

	private function getTitleTag()
	{
		$tag = $this->tagFactory->create()
			->setProperty('og:title')
			->setContent($this->pageConfig->getTitle()->get() ?? '');

		return ['title' => $tag];
	}

	private function getDescriptionTag()
	{
		$tag = $this->tagFactory->create()
			->setProperty('og:description')
			->setContent($this->pageConfig->getDescription() ?? '');

		return ['description' => $tag];
	}

	private function getImageTag()
	{
		$defaultImagePath = $this->directoryList->getPath(DirectoryList::MEDIA) . '/opengraph/' . $this->storeManager->getStore()->getId() . '.jpg';
		if (!file_exists($defaultImagePath)) return [];

		$tag = $this->tagFactory->create()
			->setProperty('og:image')
			->setContent($this->storeManager->getStore()->getBaseUrl() . 'media/opengraph/' . $this->storeManager->getStore()->getId() . '.jpg');

		return ['image' => $tag];
	}

	private function getUrlTag()
	{
		$tag = $this->tagFactory->create()
			->setProperty('og:url')
			->setContent($this->storeManager->getStore()->getBaseUrl() . ltrim($this->request->getRequestUri(), '/'));

		return ['url' => $tag];
	}

}