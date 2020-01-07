<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Plugin\Grid\Column\Renderer;

class Massaction
{
    public $shirteeHelper;

    public function __construct(\Shirtee\Dropshipping\Helper\Data $shirteeHelper)
    {
        $this->shirteeHelper = $shirteeHelper;
    }

    public function aroundRender($subject, \Closure $proceed, \Magento\Framework\DataObject $row)
    {
        $is_cron_create = $row->getData('is_cron_create');
        $is_cron_modify = $row->getData('is_cron_modify');
        $is_cron_remove = $row->getData('is_cron_remove');

        $process_img = $this->shirteeHelper->getImageDirPath("adminhtml", "process.gif");

        if ($is_cron_create != "" && $is_cron_create == "1") {
            $result = '<div class="process_img"><img src="'.$process_img.'" title="Creating..." /></div>';
        } elseif ($is_cron_modify != "" && $is_cron_modify == "1") {
            $result = '<div class="process_img"><img src="'.$process_img.'" title="Updating..." /></div>';
        } elseif ($is_cron_remove != "" && $is_cron_remove == "1") {
            $result = '<div class="process_img"><img src="'.$process_img.'" title="Removing..." /></div>';
        } else {
            $result = $proceed($row);
        }

        return $result;
    }
}
