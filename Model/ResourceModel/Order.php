<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Model\ResourceModel;

class Order extends \Magento\Framework\Model\ResourceModel\Db\VersionControl\AbstractDb
{
    protected function _construct()
    {
        $this->_init('shirtee_orders', 'oid');
    }

    protected function _initUniqueFields()
    {
        $this->_uniqueFields = [['field' => 'magento_oid', 'title' => __('Magento Order ID')]];
        return $this;
    }
}
