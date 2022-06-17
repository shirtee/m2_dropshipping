<?php
namespace Shirtee\Dropshipping\Cron\Product;

class Create extends \Shirtee\Dropshipping\Cron\Helper {
    public function execute() {
        try {
            $this->shirteeHelper->cronCreateProducts();
            echo json_encode(["status" => "success"]);
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "msg" => $e->getMessage()]);
        }
    }
}
