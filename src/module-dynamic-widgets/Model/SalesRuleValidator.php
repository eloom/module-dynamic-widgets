<?php
/**
* 
* Geolocation para Magento 2
* 
* @category     Ã©lOOm
* @package      Modulo Geolocation
* @copyright    Copyright (c) 2021 Ã©lOOm (https://eloom.tech)
* @version      1.0.0
* @license      https://eloom.tech/license/
*
*/
declare(strict_types=1);

namespace Eloom\DynamicWidgets\Model;

use Magento\SalesRule\Model\ResourceModel\Rule\CollectionFactory;
use Magento\SalesRule\Model\Utility;

class SalesRuleValidator {
	
	private $websiteId;
	
	private $customerGroupId;
	
	protected $collectionFactory;
	
	protected $validatorUtility;
	
	public function __construct(CollectionFactory $collectionFactory,
	                            Utility $utility) {
		$this->collectionFactory = $collectionFactory;
		$this->validatorUtility = $utility;
	}
	
	public function init($websiteId, $customerGroupId) {
		$this->setWebsiteId($websiteId)->setCustomerGroupId($customerGroupId);
		
		return $this;
	}
	
	protected function _getRules($address = null) {
		$rules = $this->collectionFactory->create()
			->setValidationFilter(
				$this->getWebsiteId(),
				$this->getCustomerGroupId(),
				null,
				null,
				$address
			)
			->addFieldToFilter('is_active', 1)
			->load();
		
		return $rules;
	}
	
	public function listAppliedRules($address) {
		$index = 0;
		$rules = [];
		
		foreach ($this->_getRules() as $rule) {
			if ($this->validatorUtility->canProcessRule($rule, $address)) {
				$rules[] = ['index' => $index++, 'name' => $rule->getName(), 'message' => $rule->getDescription()];
			}
		}
		$total = count($rules);
		foreach ($rules as $key => $rule) {
			$rule['total'] = $total;
			$rules[$key] = $rule;
		}
		
		return $rules;
	}
	
	/**
	 * @return mixed
	 */
	public function getWebsiteId() {
		return $this->websiteId;
	}
	
	/**
	 * @param mixed $websiteId
	 */
	public function setWebsiteId($websiteId) {
		$this->websiteId = $websiteId;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getCustomerGroupId() {
		return $this->customerGroupId;
	}
	
	/**
	 * @param mixed $customerGroupId
	 */
	public function setCustomerGroupId($customerGroupId) {
		$this->customerGroupId = $customerGroupId;
		return $this;
	}
}