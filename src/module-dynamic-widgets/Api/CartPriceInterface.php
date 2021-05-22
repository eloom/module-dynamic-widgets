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