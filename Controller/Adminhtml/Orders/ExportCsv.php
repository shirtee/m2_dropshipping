<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Controller\Adminhtml\Orders;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Controller\ResultFactory;

class ExportCsv extends \Shirtee\Dropshipping\Controller\Adminhtml\Orders
{
    public function execute()
    {
        $resultLayout = $this->resultFactory->create(ResultFactory::TYPE_LAYOUT);
        $content = $resultLayout->getLayout()->getChildBlock('adminhtml.shirtee.order.grid', 'grid.export');

        return $this->fileFactory->create(
            'shirtee_orders.csv',
            $content->getCsvFile(),
            DirectoryList::VAR_DIR
        );
    }
}
