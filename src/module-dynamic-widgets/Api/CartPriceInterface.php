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

namespace Eloom\DynamicWidgets\Api;

/**
 * Interface for managing Cart Price Promotions.
 * @api
 * @since 100.0.2
 */
interface CartPriceInterface {
	
	/**
	 *
	 * @param string $country
	 * @param string $region
	 * @param string $regionId
	 * @param string $postcode
	 * @return string
	 * @throws \Magento\Framework\Exception\LocalizedException
	 */
	public function listByAddress($country, $region, $regionId, $postcode);
}