<?php
/**
* 
* Geolocation para Magento 2
* 
* @category     elOOm
* @package      Modulo Geolocation
* @copyright    Copyright (c) 2021 Ã©lOOm (https://eloom.tech)
* @version      1.0.0
* @license      https://eloom.tech/license/
*
*/
declare(strict_types=1);

namespace Eloom\DynamicWidgets\Model;

use Eloom\Core\Enumeration\HttpStatus;
use Eloom\DynamicWidgets\Api\CartPriceInterface;
use Eloom\DynamicWidgets\Helper\Data;
use Magento\Checkout\Helper\Cart;
use Magento\Directory\Model\RegionFactory;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Store\Model\StoreManagerInterface;

class CartPrice implements CartPriceInterface {
	
	private $regionFactory;
	
	private $storeManager;
	
	private $helper;
	
	private $serializer;
	
	private $salesRule;
	
	private $cartHelper;
	
	public function __construct(RegionFactory $regionFactory,
	                            StoreManagerInterface $storeManager,
	                            Data $helper,
	                            Json $serializer = null,
	                            SalesRule $salesRule,
	                            Cart $cartHelper) {
		$this->regionFactory = $regionFactory;
		$this->storeManager = $storeManager;
		$this->helper = $helper;
		$this->serializer = $serializer ?: ObjectManager::getInstance()->get(Json::class);
		$this->salesRule = $salesRule;
		$this->cartHelper = $cartHelper;
	}
	
	/**
	 * @inheritDoc
	 */
	public function listByAddress($country, $region, $regionId, $postcode) {
		$response = ['code' => HttpStatus::OK()->getCode()];
		
		try {
			if ($this->cartHelper->getItemsCount()) {
				$rules = $this->salesRule->listAppliedRules($country, $region, $regionId, $postcode);
				$response['data'] = $rules;
			}
		} catch (\Exception $e) {
			$response['code'] = HttpStatus::BAD_GATEWAY()->getCode();
			$response['data'] = __($e->getMessage());
		}
		
		return $this->serializer->serialize($response);
	}
}