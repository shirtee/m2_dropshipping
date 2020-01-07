<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Controller\Adminhtml\Products;

class Fetch extends \Shirtee\Dropshipping\Controller\Adminhtml\Products
{
    public function execute()
    {
    	$resultRedirect = $this->resultRedirectFactory->create();
    	try {
            $new_Arr = $this->shirteeHelper->getProductsFromShirtee();
            $count = count($new_Arr);

            $this->shirteeHelper->notifyShirteeCloud("cron_get_products", $new_Arr);
            
            if ($count > 0) {
                $this->messageManager->addSuccessMessage(__('Total %1 products are successfully get from Shirtee.', $count));
            } else {
                $this->messageManager->addSuccessMessage(__('No any new products are found from Shirtee.', $count));
            }
        } catch (Exception $e) {
        	$this->messageManager->addErrorMessage($e->getMessage());
        }

        return $resultRedirect->setPath($this->_redirect->getRefererUrl());
    }
}
