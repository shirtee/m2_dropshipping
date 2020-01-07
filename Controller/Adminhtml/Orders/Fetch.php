<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Controller\Adminhtml\Orders;

class Fetch extends \Shirtee\Dropshipping\Controller\Adminhtml\Orders
{
    public function execute()
    {
    	$resultRedirect = $this->resultRedirectFactory->create();

    	try {
        	$new_Arr = $this->shirteeHelper->getMagentoOrders();
            $count = count($new_Arr);
        	if ($count > 0) {
        		$this->messageManager->addSuccessMessage(__('Total %1 orders are successfully get from Magento.', $count));
        	} else {
        		$this->messageManager->addSuccessMessage(__('No any new orders are found.', $count));
        	}
        } catch (Exception $e) {
        	$this->messageManager->addErrorMessage($e->getMessage());
        }

        return $resultRedirect->setPath('shirtee_dropshipping/orders/index', ['_current' => true]);
    }
}
