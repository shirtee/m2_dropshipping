<?php
namespace Shirtee\Dropshipping\Cron;

class Helper {
    public $shirteeHelper;

    public function __construct(
        \Shirtee\Dropshipping\Helper\Data $shirteeHelper
    ) {
        $this->shirteeHelper = $shirteeHelper;
    }
}
