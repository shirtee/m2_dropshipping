<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Controller\Cloud;

class FetchOrder extends \Shirtee\Dropshipping\Controller\Cloud
{
    public function execute()
    {
    	try {
            $days = 3;
            $post_data = $this->getRequest()->getParams();
            if (isset($post_data["days"])) {
                if ($post_data["days"] != "" && $post_data["days"] > 0) {
                    $days = $post_data["days"];
                }
            }

        	$new_Arr = $this->shirteeHelper->getMagentoOrders($days);
            $count = count($new_Arr);

            if ($count > 0) {
                $msg = __('Total %1 orders are successfully get from Magento.', $count);
            } else {
                $msg = __('No any new orders are found.', $count);
            }

            $data = ["type" => "ShirteeCloud_FetchOrder", "ldata" => ["request" => $post_data, "response" => $new_Arr], "status" => 1, "error" => $msg];
            $this->shirteeHelper->doDebug($data);

            $response = $this->getResponse()->setBody(json_encode(["status" => "success", "msg" => $msg, "order_id" => $new_Arr]));
            return $response;
        } catch (Exception $e) {
            $data = ["type" => "ShirteeCloud_FetchOrder", "ldata" => ["request" => $post_data, "response" => ""], "status" => 0, "error" => $e->getMessage()];
            $this->shirteeHelper->doDebug($data);

            $response = $this->getResponse()->setBody(json_encode(["status" => "error", "msg" => $e->getMessage()]));
            return $response;
        }
    }
}
