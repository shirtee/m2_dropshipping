<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Controller\Adminhtml\Products;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Controller\ResultFactory;

class ExportCsv extends \Shirtee\Dropshipping\Controller\Adminhtml\Products
{
    public function execute()
    {
        $resultLayout = $this->resultFactory->create(ResultFactory::TYPE_LAYOUT);
        $content = $resultLayout->getLayout()->getChildBlock('adminhtml.shirtee.product.grid', 'grid.export');

        return $this->fileFactory->create(
            'shirtee_products.csv',
            $content->getCsvFile(),
            DirectoryList::VAR_DIR
        );
    }
}
