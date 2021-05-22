<?php
/**
* 
* Geolocation para Magento 2
* 
* @category     Ã©lOOm
* @package      Modulo Geolocation
* @copyright    Copyright (c) 2021 Ã©lOOm (https://www.eloom.com.br)
* @version      1.0.0
* @license      https://www.eloom.com.br/license/
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