<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Controller\Cloud;

class MassRemoveProduct extends \Shirtee\Dropshipping\Controller\Cloud
{
    public function execute()
    {
        $product_ids = [];
        $post_data = $this->getRequest()->getPostValue();
        if (isset($post_data["pid"])) {
            if (is_array($post_data["pid"])) {
                $product_ids = $post_data["pid"];
            }
        }

        if (count($product_ids) == 0) {
            $data = ["type" => "ShirteeCloud_MassRemoveProduct", "ldata" => ["request" => $post_data, "response" => $product_ids], "status" => 0, "error" => "Please select one or more products."];
            $this->shirteeHelper->doDebug($data);

            $response = $this->getResponse()->setBody(json_encode(["status" => "error", "msg" => __('Please select one or more products.')]));
            return $response;
        } else {
            try {
                $total_process = $this->shirteeHelper->scheduleRemoveProducts($product_ids);

                $data = ["type" => "ShirteeCloud_MassRemoveProduct", "ldata" => ["request" => $post_data, "response" => $total_process], "status" => 1, "error" => $total_process["count"]];
                $this->shirteeHelper->doDebug($data);
                
                $response = $this->getResponse()->setBody(json_encode(["status" => "success", "msg" => __('A total of %1 product(s) were scheduled for remove.', $total_process["count"]), "data" => $total_process]));
                return $response;
            } catch (\Exception $e) {
                $data = ["type" => "ShirteeCloud_MassRemoveProduct", "ldata" => ["request" => $post_data, "response" => ""], "status" => 0, "error" => $e->getMessage()];
                $this->shirteeHelper->doDebug($data);
                
                $response = $this->getResponse()->setBody(json_encode(["status" => "error", "msg" => $e->getMessage()]));
                return $response;
            }
        }
    }
}
