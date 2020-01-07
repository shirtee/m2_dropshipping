<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Model\ResourceModel;

class CronProduct extends \Magento\Framework\Model\ResourceModel\Db\VersionControl\AbstractDb
{
    protected function _construct()
    {
        $this->_init('shirtee_cron_product', 'scpid');
    }

    protected function _initUniqueFields()
    {
        $this->_uniqueFields = [['field' => 'shirtee_pid', 'title' => __('Shirtee Product ID')]];
        return $this;
    }
}
