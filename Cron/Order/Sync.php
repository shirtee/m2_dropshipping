<?php
namespace Shirtee\Dropshipping\Cron\Order;

class Sync extends \Shirtee\Dropshipping\Cron\Helper {
    public function execute() {
        try {
            $this->shirteeHelper->cronSyncOrders();
            echo json_encode(["status" => "success"]);
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "msg" => $e->getMessage()]);
        }
    }
}
