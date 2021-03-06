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
 * @copyright  Copyright (c) 2009 One Pica, Inc.
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

/**
 * Grand Total and Landed Cost DAP Renderer
 *
 * @category   OnePica
 * @package    OnePica_AvaTax
 * @author     OnePica Codemaster <codemaster@onepica.com>
 */
class OnePica_AvaTax_Block_Sales_Order_Totals_ImportDuties extends Mage_Core_Block_Abstract
{
    public function getSource()
    {
        return $this->getParentBlock()->getSource();
    }

    /**
     * Add this total to parent
     *
     * @throws \Varien_Exception
     */
    public function initTotals()
    {
        if ((float)$this->getSource()->getAvataxLandedCostImportDutiesAmount() == 0) {
            return $this;
        }

        $total = new Varien_Object(
            array(
                'code'  => 'avatax_landed_cost_import_duties_amount',
                'field' => 'avatax_landed_cost_import_duties_amount',
                'value' => $this->getSource()->getAvataxLandedCostImportDutiesAmount(),
                'label' => $this->__('Customs Duty and Import Tax')
            )
        );

        $this->getParentBlock()->addTotal($total, 'tax');

        return $this;
    }
}
