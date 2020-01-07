<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Block\Adminhtml;

class Order extends \Magento\Backend\Block\Widget\Grid\Container
{
    public function _construct()
    {
        $this->_blockGroup = 'Shirtee_Dropshipping';
        $this->_controller = 'adminhtml_order';

        $this->buttonList->add('get_orders', [
			'label' => __('Update List'),
			'class' => 'action-default scalable add primary',
			'onclick' => 'setLocation("'.$this->getUrl('shirtee_dropshipping/orders/fetch').'")'
		]);

        parent::_construct();
        $this->removeButton('add');
    }
}
