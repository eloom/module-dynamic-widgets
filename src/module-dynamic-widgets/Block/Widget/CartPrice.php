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

use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Widget\Block\BlockInterface;

class CartPrice extends AbstractPromotion implements BlockInterface {

	public function __construct(Context $context,
	                            StoreManagerInterface $storeManager,
	                            array $data = []) {

		parent::__construct($context, $storeManager, $data);
	}

	public function getConfig() {
		$data = [
			'loading' => false
		];

		return json_encode($data);
	}
}