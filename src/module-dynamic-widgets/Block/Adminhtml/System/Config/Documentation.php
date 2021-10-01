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

namespace Eloom\DynamicWidgets\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class Documentation extends Field {
	
	protected function _getElementHtml(AbstractElement $element) {
		return '<a href="https://docs.eloom.tech/dynamic-widgets/" target="_blank">' . __('Documentation') . '</a>';
	}
}
