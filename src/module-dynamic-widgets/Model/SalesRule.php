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

use Magento\Checkout\Model\Session;
use Magento\Customer\Api\Data\GroupInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Quote\Model\Quote\Address;
use Magento\Quote\Model\Quote\AddressFactory;
use Magento\Store\Model\StoreManagerInterface;

class SalesRule {
	
	private $validator;
	
	private $storeManager;
	
	public function __construct(SalesRuleValidator $validator,
	                            StoreManagerInterface $storeManager) {
		$this->validator = $validator;
		$this->storeManager = $storeManager;
	}
	
	public function listAppliedRules($country = null, $region = null, $regionId = null, $postcode = null) {
		$customerGroupId = null;
		$websiteId = null;
		$address = null;
		$quote = ObjectManager::getInstance()->get(Session::class)->getQuote();
		if (!$quote || null == $quote->getId()) {
			$quoteAddressFactory = ObjectManager::getInstance()->create(AddressFactory::class);
			$address = $quoteAddressFactory->create()->setAddressType(Address::TYPE_SHIPPING);
			
			$storeId = $this->storeManager->getStore()->getId();
			$websiteId = $this->storeManager->getStore($storeId)->getWebsiteId();
			$customerGroupId = GroupInterface::NOT_LOGGED_IN_ID;
		} else {
			$address = $quote->getBillingAddress();
			$websiteId = $this->storeManager->getStore($quote->getStoreId())->getWebsiteId();
			$customerGroupId = $quote->getCustomerGroupId();
		}
		
		if (null == $address->getCountryId() && null != $country) {
			$address->setCountryId($country);
		}
		if (null == $address->getRegion() && null != $region) {
			$address->setRegion($region);
		}
		if (null == $address->getRegionId() && null != $regionId) {
			$address->setRegionId($regionId);
		}
		if (null == $address->getPostcode() && null != $postcode) {
			$address->setPostcode($postcode);
		}
		
		$this->validator->init($websiteId, $customerGroupId);
		$rules = $this->validator->listAppliedRules($address);
		
		return $rules;
	}
}