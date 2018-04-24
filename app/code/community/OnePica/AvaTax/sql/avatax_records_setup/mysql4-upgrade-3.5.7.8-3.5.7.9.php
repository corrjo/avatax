<?php
/**
 * OnePica_AvaTax
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0), a
 * copy of which is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   OnePica
 * @package    OnePica_AvaTax
 * @author     OnePica Codemaster <codemaster@onepica.com>
 * @copyright  Copyright (c) 2015 One Pica, Inc.
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

/** @var $installer Mage_Catalog_Model_Resource_Setup */
$installer = Mage::getResourceModel('catalog/setup', 'catalog_setup');
$installer->startSetup();

$setName = 'default';

$groupName = OnePica_AvaTax_Helper_LandedCost::AVATAX_PRODUCT_GROUP_LANDED_COST;
$installer->addAttributeGroup('catalog_product', $setName, $groupName, 200);

$installer->removeAttribute('catalog_product', OnePica_AvaTax_Helper_LandedCost::AVATAX_PRODUCT_LANDED_COST_ATTR_HSCODE);
$installer->removeAttribute('catalog_product', OnePica_AvaTax_Helper_LandedCost::AVATAX_PRODUCT_LANDED_COST_ATTR_UNIT_OF_WEIGHT);

$installer->endSetup();
