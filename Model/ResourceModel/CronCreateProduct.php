<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Model\ResourceModel;

class CronCreateProduct extends \Magento\Framework\Model\ResourceModel\Db\VersionControl\AbstractDb
{
    protected function _construct()
    {
        $this->_init('shirtee_cron_create_product', 'sccpid');
    }

    protected function _initUniqueFields()
    {
        $this->_uniqueFields = [['field' => 'pid', 'title' => __('Product ID')]];
        return $this;
    }
}
