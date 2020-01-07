<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Controller\Adminhtml\Products;

class MassRemove extends \Shirtee\Dropshipping\Controller\Adminhtml\Products
{
    public function execute()
    {
        $product_ids = $this->getRequest()->getParam('pid');
        if (!is_array($product_ids)) {
            $this->messageManager->addError(__('Please select one or more products.'));
        } else {
            try {
                $process_data = $this->shirteeHelper->scheduleRemoveProducts($product_ids);

                $this->shirteeHelper->notifyShirteeCloud("cron_remove_products", $process_data);

                $this->messageManager->addSuccess(__('A total of %1 product(s) were scheduled for remove.', count($product_ids)));
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }

        $this->_redirect($this->_redirect->getRefererUrl());
    }
}
