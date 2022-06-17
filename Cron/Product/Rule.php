<?php
namespace Shirtee\Dropshipping\Cron\Product;

class Rule extends \Shirtee\Dropshipping\Cron\Helper {
    public function execute() {
        try {
            $this->shirteeHelper->getProductRules();
            echo json_encode(["status" => "success"]);
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "msg" => $e->getMessage()]);
        }
    }
}
