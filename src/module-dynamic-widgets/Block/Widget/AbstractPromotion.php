<?php
/**
* 
* Dynamic Widgets para Magento 2
* 
* @category     elOOm
* @package      Modulo DynamicWidgets
* @copyright    Copyright (c) 2021 Ã©lOOm (https://eloom.tech)
* @version      1.0.0
* @license      https://eloom.tech/license/
*
*/
declare(strict_types=1);

namespace Eloom\DynamicWidgets\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\StoreManagerInterface;

class AbstractPromotion extends Template {

	protected $scopeConfig;

	public function __construct(Context $context,
	                            StoreManagerInterface $storeManager,
	                            array $data = []) {
		parent::__construct($context, $data);

		$this->scopeConfig = $context->getScopeConfig();
		$this->storeManager = $storeManager;
	}

	protected function getStoreId() {
		return $this->storeManager->getStore()->getId();
	}

	protected function _toHtml() {
		//if (!$this->getSlider() || !$this->getItensCollection()->getSize()) {
		//	return '';
		//}

		return parent::_toHtml();
	}

	public function getAlias() {
		return md5(uniqid('', true));
	}
}