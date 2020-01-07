<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Block\Adminhtml\Product;

class Header extends \Magento\Backend\Block\Template
{
    public $cronProductCollectionFactory;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Shirtee\Dropshipping\Model\ResourceModel\CronProduct\CollectionFactory $cronProductCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->cronProductCollectionFactory = $cronProductCollectionFactory;
    }

    public function getCronProductData()
    {
        //pending
        $pending = 0;
        $cron_product_collection = $this->cronProductCollectionFactory->create()->addFieldToSelect("status")->addFieldToFilter("status", ["in" => [0,3]]);
        $pending = $cron_product_collection->count();

        //complete
        $complete = 0;
        $cron_product_collection = $this->cronProductCollectionFactory->create()->addFieldToSelect("status")->addFieldToFilter("status", 1);
        $complete = $cron_product_collection->count();

        return ["pending" => $pending, "complete" => $complete];
    }
}
