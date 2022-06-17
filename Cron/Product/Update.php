<?php
namespace Shirtee\Dropshipping\Cron\Product;

class Update extends \Shirtee\Dropshipping\Cron\Helper {
    public function execute() {
        try {
            $this->shirteeHelper->cronUpdateProducts();
            echo json_encode(["status" => "success"]);
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "msg" => $e->getMessage()]);
        }
    }
}
