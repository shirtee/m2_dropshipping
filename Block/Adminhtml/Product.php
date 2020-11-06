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

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $shirteeHelper = $objectManager->create('Shirtee\Dropshipping\Helper\Data');

        if ($shirteeHelper->is_dropshipping == "1") {
            $this->buttonList->add('add_product', [
                'label' => __('Add Product'),
                'class' => 'action-default scalable add primary',
                'onclick' => 'setLocation("'.$this->getUrl('shirtee_dropshipping/products/add').'")'
            ]);
        } else if ($shirteeHelper->is_dropshipping == "0") {
            $this->buttonList->add('get_products', [
                'label' => __('Get Products from Shirtee'),
                'class' => 'action-default scalable add primary',
                'onclick' => 'setLocation("'.$this->getUrl('shirtee_dropshipping/products/fetch').'")'
            ]);
        }

        parent::_construct();
        $this->removeButton('add');
    }
}
