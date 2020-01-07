<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Block\Adminhtml;

class Help extends \Magento\Backend\Block\AbstractBlock implements \Magento\Framework\Data\Form\Element\Renderer\RendererInterface
{
    public $shirteeHelper;

    public function __construct(
        \Shirtee\Dropshipping\Helper\Data $shirteeHelper
    ) {
        $this->shirteeHelper = $shirteeHelper;
    }

    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $element  = null;
        $version  = $this->shirteeHelper->getModuleVersion();
        $logopath = $this->shirteeHelper->getImageDirPath("adminhtml", "logo.png");
        $html     = <<<HTML
<div style="border:1px solid #ccc; padding:15px; text-align:center;">
<img src="$logopath" width="200"/>
<p>
<strong>Shirtee Dropshipping Module v$version</strong><br />
Lorem Ipsum is simply dummy text of the printing and typesetting industry.
</p><br />
<p>
Website: <a href="https://www.shirtee.com" target="_blank">www.shirtee.com</a>
<br />Like, share and follow us on 
<a href="https://www.facebook.com/shirtee.de/" target="_blank">Facebook</a>, 
<a href="https://www.youtube.com/channel/UCMngeJszAvtvIEYoAk-z4pw" target="_blank">Youtube</a>, 
<a href="https://www.instagram.com/shirtee.de/" target="_blank">Instagram</a>, and 
<a href="https://de.pinterest.com/shirteeshirts/" target="_blank">Pinterest</a>.<br />
If you have any questions send email at 
<a href="mailto:magento@shirtee.com">magento@shirtee.com</a>.
</p>
</div>
HTML;
        return $html;
    }
}
