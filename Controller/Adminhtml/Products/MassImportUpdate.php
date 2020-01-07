<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Controller\Adminhtml\Products;

class MassImportUpdate extends \Shirtee\Dropshipping\Controller\Adminhtml\Products
{
    public function execute()
    {
        $product_ids = $this->getRequest()->getParam('pid');
        if (!is_array($product_ids)) {
            $this->messageManager->addError(__('Please select one or more products.'));
        } else {
            try {
                $this->shirteeHelper->updateColorSizeOptions($product_ids);
                $process_data = $this->shirteeHelper->scheduleCreateModifyProducts($product_ids);

                $this->shirteeHelper->notifyShirteeCloud("cron_create_modify_products", $process_data);

                $this->messageManager->addSuccess(__('A total of %1 product(s) were scheduled for import/update.', count($product_ids)));
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }

        $this->_redirect($this->_redirect->getRefererUrl());
    }
}
