<?php

namespace Mageplaza\HelloWorld\Block;
use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Mageplaza\HelloWorld\Model\PostFactory;

class Display extends Template
{
	protected $_postFactory;
	public function __construct(
		Context $context,
		PostFactory $postFactory
	) {
		$this->_postFactory = $postFactory;
		parent::__construct($context);
	}

	public function sayHello()
	{
		return __('Hello World111111111111111');
	}

	public function sayHello2()
	{
		return __('Hello World2222222222222222');
	}

	public function getPostCollection(){
		$post = $this->_postFactory->create();
		return $post->getCollection();
	}
}