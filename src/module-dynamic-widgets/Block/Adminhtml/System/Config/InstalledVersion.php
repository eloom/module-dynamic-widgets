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
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Module\ModuleResource;

class InstalledVersion extends Field {
	
	protected function _getElementHtml(AbstractElement $element) {
		$objectManager = ObjectManager::getInstance();
		$moduleResource = $objectManager->create(ModuleResource::class);
		
		$dbVersion = (string)$moduleResource->getDbVersion('Eloom_DynamicWidgets');
		
		$element->setValue($dbVersion);
		
		return '<strong>' . $element->getEscapedValue() . '</strong> - [<a href="https://github.com/eloom/module-dynamic-widgets/releases" target="_blank">' . __('Releases') . '</a>]';
	}
}
