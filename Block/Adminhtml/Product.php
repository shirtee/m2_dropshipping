<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Block\Adminhtml;

class Product extends \Magento\Backend\Block\Widget\Grid\Container
{
    public function _construct()
    {
        $this->_blockGroup = 'Shirtee_Dropshipping';
        $this->_controller = 'adminhtml_product';

        $this->buttonList->add('get_products', [
			'label' => __('Get Products from Shirtee'),
			'class' => 'action-default scalable add primary',
			'onclick' => 'setLocation("'.$this->getUrl('shirtee_dropshipping/products/fetch').'")'
		]);

        parent::_construct();
        $this->removeButton('add');
    }
}
