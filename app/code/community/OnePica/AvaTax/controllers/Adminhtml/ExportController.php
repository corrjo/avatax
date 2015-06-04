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
 * Admin export controller
 *
 * @category   OnePica
 * @package    OnePica_AvaTax
 * @author     OnePica Codemaster <codemaster@onepica.com>
 */
class OnePica_AvaTax_Adminhtml_ExportController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Check if is allowed
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('avatax');
    }

    /**
     * Log action
     *
     * @return $this
     */
    public function logAction() {
        $fileName = 'avatax-log-' . gmdate('U') . '.sql';
        //$content = $this->getLayout()->createBlock('avatax/adminhtml_export_log_grid')->getSql();
        //$content = Mage::getModel('avatax/records_log')->getExportSql();
        $content = Mage::getModel('avatax/export')
            ->setAdapter(Mage::getModel('avatax/export_adapter_sql'))
            ->setEntity(Mage::getModel('avatax/export_entity_log'))
            ->getContent();
        $this->_sendResponse($fileName, $content);
        return $this;
    }

    /**
     * Queue action
     *
     * @return $this
     */
    public function queueAction()
    {
        $fileName = 'avatax-queue-' . gmdate('U') . '.sql';
        //$content = $this->getLayout()->createBlock('avatax/adminhtml_export_queue_grid')->getSql();
        //$content = Mage::getModel('avatax/records_queue')->getExportSql();
        $content = Mage::getModel('avatax/export')
            ->setAdapter(Mage::getModel('avatax/export_adapter_sql'))
            ->setEntity(Mage::getModel('avatax/export_entity_queue'))
            ->getContent();
        $this->_sendResponse($fileName, $content);
        return $this;
    }

    /**
     * Send response
     *
     * @param string $fileName
     * @param string $content
     * @param string $contentType
     * @return $this
     */
    protected function _sendResponse($fileName, $content, $contentType = 'application/octet-stream')
    {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK', '');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename=' . $fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        return $this;
    }
}
