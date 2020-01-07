<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Controller\Cloud;

class FetchProduct extends \Shirtee\Dropshipping\Controller\Cloud
{
    public function execute()
    {
    	try {
            $website = $this->getRequest()->getParam("website");
            if ($website) {
                $this->shirteeHelper->setApiDetails($website);

            	$new_Arr = $this->shirteeHelper->getProductsFromShirtee();
                $count = count($new_Arr);

            	if ($count > 0) {
            		$msg = __('Total %1 products are successfully get from Shirtee.', $count);
            	} else {
                    $msg = __('No any new products are found from Shirtee.', $count);
            	}

                $data = ["type" => "ShirteeCloud_FetchProduct", "ldata" => ["request" => $website, "response" => $new_Arr], "status" => 1, "error" => $msg];
                $this->shirteeHelper->doDebug($data);

                $response = $this->getResponse()->setBody(json_encode(["status" => "success", "msg" => $msg, "product_id" => $new_Arr]));
                return $response;
            } else {
                $data = ["type" => "ShirteeCloud_FetchProduct", "ldata" => ["request" => "", "response" => ""], "status" => 0, "error" => "Website is not blank."];
                $this->shirteeHelper->doDebug($data);

                $response = $this->getResponse()->setBody(json_encode(["status" => "error", "msg" => "Website is not blank."]));
                return $response;
            }
        } catch (Exception $e) {
            $data = ["type" => "ShirteeCloud_FetchProduct", "ldata" => ["request" => $website, "response" => ""], "status" => 0, "error" => $e->getMessage()];
            $this->shirteeHelper->doDebug($data);

            $response = $this->getResponse()->setBody(json_encode(["status" => "error", "msg" => $e->getMessage()]));
            return $response;
        }
    }
}
