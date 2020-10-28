<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    public $assetRepository;
    public $resource;
    public $productRepository;
    public $product;
    public $productAttributeSourceStatus;
    public $productType;
    public $productVisibility;
    public $categorySetup;
    public $productOptionsFactory;
    public $productTypeConfigurable;
    public $eavConfig;
    public $eavSetup;
    public $directoryList;
    public $inputOutputFile;
    public $registry;
    public $messageManager;
    public $jsonHelper;
    public $dateTime;
    public $magentoOrderCollection;
    public $orderRepository;
    public $documentFactory;
    public $dbTransaction;
    public $shipmentSender;
    public $trackFactory;
    public $orderItemFactory;
    public $configWriter;
    public $httpClientFactory;
    public $oauthHelper;
    public $request;
    public $storeManager;
    public $session;
    public $moduleList;

    public $cloud_api_url_product = "https://dashboard.shirtee.cloud/magento/connection";
    public $cloud_api_url_product_rules = "https://dashboard.shirtee.cloud/magento/productrules";
    public $cloud_api_url_order = "https://dashboard.shirtee.cloud/magento/orderprocess";
    public $cloud_api_url_notify = "https://dashboard.shirtee.cloud/magento/connectionprocess";
    public $is_dropshipping;
    public $is_enabled;
    public $username;
    public $password;
    public $website;
    public $website_name;
    public $website_url;
    public $cid;
    public $lang;
    public $access_token;
    public $product_update_exclude;
    public $cron_limit = 1;

    public $productFactory;
    public $productCollectionFactory;
    public $productRuleFactory;
    public $productRuleCollectionFactory;
    public $cronProductFactory;
    public $cronProductCollectionFactory;
    public $cronCreateProductFactory;
    public $cronCreateProductCollectionFactory;
    public $cronModifyProductFactory;
    public $cronModifyProductCollectionFactory;
    public $cronRemoveProductFactory;
    public $cronRemoveProductCollectionFactory;
    public $orderFactory;
    public $orderCollectionFactory;
    public $logFactory;
    public $logCollectionFactory;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\View\Asset\Repository $assetRepository,
        \Magento\Framework\App\ResourceConnection $resource,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Catalog\Model\ProductFactory $product,
        \Magento\Catalog\Model\Product\Attribute\Source\Status $productAttributeSourceStatus,
        \Magento\Catalog\Model\Product\Type $productType,
        \Magento\Catalog\Model\Product\Visibility $productVisibility,
        \Magento\Catalog\Setup\CategorySetup $categorySetup,
        \Magento\ConfigurableProduct\Helper\Product\Options\Factory $productOptionsFactory,
        \Magento\ConfigurableProduct\Model\Product\Type\Configurable $productTypeConfigurable,
        \Magento\Eav\Model\Config $eavConfig,
        \Magento\Eav\Setup\EavSetupFactory $eavSetup,
        \Magento\Framework\App\Filesystem\DirectoryList $directoryList,
        \Magento\Framework\Filesystem\Io\File $inputOutputFile,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateTime,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $magentoOrderCollection,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository,
        \Magento\Sales\Model\Order\ShipmentDocumentFactory $documentFactory,
        \Magento\Framework\DB\Transaction $dbTransaction,
        \Magento\Sales\Model\Order\Email\Sender\ShipmentSender $shipmentSender,
        \Magento\Sales\Api\Data\ShipmentTrackCreationInterfaceFactory $trackFactory,
        \Magento\Sales\Api\Data\ShipmentItemCreationInterfaceFactory $orderItemFactory,
        \Magento\Framework\App\Config\Storage\WriterInterface $configWriter,
        \Magento\Framework\HTTP\ClientFactory $httpClientFactory,
        \Magento\Framework\Oauth\Helper\Oauth $oauthHelper,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Backend\Model\Session $session,
        \Magento\Framework\Module\ModuleListInterface $moduleList,
        \Shirtee\Dropshipping\Model\ProductFactory $productFactory,
        \Shirtee\Dropshipping\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Shirtee\Dropshipping\Model\ProductRuleFactory $productRuleFactory,
        \Shirtee\Dropshipping\Model\ResourceModel\ProductRule\CollectionFactory $productRuleCollectionFactory,
        \Shirtee\Dropshipping\Model\CronProductFactory $cronProductFactory,
        \Shirtee\Dropshipping\Model\ResourceModel\CronProduct\CollectionFactory $cronProductCollectionFactory,
        \Shirtee\Dropshipping\Model\CronCreateProductFactory $cronCreateProductFactory,
        \Shirtee\Dropshipping\Model\ResourceModel\CronCreateProduct\CollectionFactory $cronCreateProductCollectionFactory,
        \Shirtee\Dropshipping\Model\CronModifyProductFactory $cronModifyProductFactory,
        \Shirtee\Dropshipping\Model\ResourceModel\CronModifyProduct\CollectionFactory $cronModifyProductCollectionFactory,
        \Shirtee\Dropshipping\Model\CronRemoveProductFactory $cronRemoveProductFactory,
        \Shirtee\Dropshipping\Model\ResourceModel\CronRemoveProduct\CollectionFactory $cronRemoveProductCollectionFactory,
        \Shirtee\Dropshipping\Model\OrderFactory $orderFactory,
        \Shirtee\Dropshipping\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
        \Shirtee\Dropshipping\Model\LogFactory $logFactory,
        \Shirtee\Dropshipping\Model\ResourceModel\Log\CollectionFactory $logCollectionFactory
    ) {
        parent::__construct($context);

        $this->assetRepository = $assetRepository;
        $this->resource = $resource;
        $this->productRepository = $productRepository;
        $this->product = $product;
        $this->productAttributeSourceStatus = $productAttributeSourceStatus;
        $this->productType = $productType;
        $this->productVisibility = $productVisibility;
        $this->categorySetup = $categorySetup;
        $this->productOptionsFactory = $productOptionsFactory;
        $this->productTypeConfigurable = $productTypeConfigurable;
        $this->eavConfig = $eavConfig;
        $this->eavSetup = $eavSetup;
        $this->directoryList = $directoryList;
        $this->inputOutputFile = $inputOutputFile;
        $this->registry = $registry;
        $this->messageManager = $messageManager;
        $this->jsonHelper = $jsonHelper;
        $this->dateTime = $dateTime;
        $this->magentoOrderCollection = $magentoOrderCollection;
        $this->orderRepository = $orderRepository;
        $this->documentFactory = $documentFactory;
        $this->dbTransaction = $dbTransaction;
        $this->shipmentSender = $shipmentSender;
        $this->trackFactory = $trackFactory;
        $this->orderItemFactory = $orderItemFactory;
        $this->configWriter = $configWriter;
        $this->httpClientFactory = $httpClientFactory;
        $this->oauthHelper = $oauthHelper;
        $this->request = $request;
        $this->storeManager = $storeManager;
        $this->session = $session;
        $this->moduleList = $moduleList;

        $this->productFactory = $productFactory;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->productRuleFactory = $productRuleFactory;
        $this->productRuleCollectionFactory = $productRuleCollectionFactory;
        $this->cronProductFactory = $cronProductFactory;
        $this->cronProductCollectionFactory = $cronProductCollectionFactory;
        $this->cronCreateProductFactory = $cronCreateProductFactory;
        $this->cronCreateProductCollectionFactory = $cronCreateProductCollectionFactory;
        $this->cronModifyProductFactory = $cronModifyProductFactory;
        $this->cronModifyProductCollectionFactory = $cronModifyProductCollectionFactory;
        $this->cronRemoveProductFactory = $cronRemoveProductFactory;
        $this->cronRemoveProductCollectionFactory = $cronRemoveProductCollectionFactory;
        $this->orderFactory = $orderFactory;
        $this->orderCollectionFactory = $orderCollectionFactory;
        $this->logFactory = $logFactory;
        $this->logCollectionFactory = $logCollectionFactory;

        $this->checkIsEnabled();
    }

    public function checkIsEnabled()
    {
        $this->is_enabled = $this->scopeConfig->getValue('shirtee/settings/enabled');
        if (!$this->is_enabled) {
            $this->messageManager->getMessages(true);
            $this->messageManager->addWarning(__("Please enable module."));
        } else {
            $this->username = $this->scopeConfig->getValue('shirtee/settings/username');
            $this->password = $this->scopeConfig->getValue('shirtee/settings/password');

            if (!$this->username || !$this->password) {
                $this->messageManager->getMessages(true);
                $this->messageManager->addWarning(__("Please add Shirtee Username and Shirtee Password."));
            } else {
                $this->setApiDetails();
            }
        }
    }

    public function getModuleVersion()
    {
        $moduleName = 'Shirtee_Dropshipping';
        $moduleInfo = $this->moduleList->getOne($moduleName);
        
        return $moduleInfo['setup_version'];
    }

    public function setApiDetails($website = null)
    {
        if ($this->is_enabled) {
            if ($website == null) {
                $website = $this->request->getParam("website");
                if (!$website) {
                    $website = $this->session->getShirteeWebsite();
                }
            }

            if ($website && $this->website != $website) {
                $this->website = $website;

                $cid = $this->scopeConfig->getValue('shirtee/settings/cid', \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE, $this->website);
                $lang = $this->scopeConfig->getValue('shirtee/settings/lang', \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE, $this->website);
                $access_token = $this->scopeConfig->getValue('shirtee/settings/access_token', \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE, $this->website);

                $is_dropshipping = $this->scopeConfig->getValue('shirtee/settings/is_dropshipping');
                $product_update_exclude = $this->scopeConfig->getValue('shirtee/settings/product_update_exclude');

                $this->cid = $cid;
                $this->lang = $lang;
                $this->access_token = $access_token;
                $this->is_dropshipping = $is_dropshipping;
                $this->product_update_exclude = $product_update_exclude;
                $this->website_name = $this->storeManager->getWebsite($this->website)->getName();
                $this->website_url = $this->scopeConfig->getValue('web/secure/base_url', \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE, $this->website);

                if (!$this->cid) {
                    $this->messageManager->getMessages(true);
                    $this->messageManager->addWarning(__("Please add Shirtee Shop ID."));
                }
            }
        }
    }

    public function callShirteeApi($type, $post_data)
    {
        $params = [
            "token" => $this->access_token,
            "type" => $type,
            "params" => $post_data
        ];
        $result = $this->doCurlRequest($this->cloud_api_url_product, $params);

        $status = 1;
        $msg = "";
        if (isset($result["status"]) && $result["status"] == "error") {
            $status = 0;
        }
        if (isset($result["msg"]) && $result["msg"] != "") {
            $msg = $result["msg"];
        }
        $data = ["type" => "M2_callShirteeApi", "ldata" => ["request" => $params, "response" => $result], "status" => $status, "error" => $msg];
        $this->doDebug($data);

        if ($status == 0) {
            $mail_data = [
                "subject" => "Shirtee M2 :: API Fail :: ".$type,
                "body_html" => "Params: ".implode(",", [$post_data])."<br/>Error: ".$msg
            ];
            $this->sendMail($mail_data);
        }

        return $result;
    }

    public function getAssignedProductsByCategoryId($cid)
    {
        $result = $this->callShirteeApi('getAssignedProductsByCategoryId', $cid);
        return $result;
    }

    public function getProductById($pid)
    {
        $result = $this->callShirteeApi('getProductById', [$pid, $this->lang]);
        return $result;
    }

    public function getProductCustomOptionsById($product_id)
    {
        $result = $this->callShirteeApi('getProductCustomOptionsById', [$product_id, $this->lang]);
        return $result;
    }

    public function getProductCustomOptionInfoById($option_id)
    {
        $result = $this->callShirteeApi('getProductCustomOptionInfoById', [$option_id, $this->lang]);
        return $result;
    }

    public function getProductImagesById($product_id)
    {
        $result = $this->callShirteeApi('getProductImagesById', [$product_id, $this->lang]);
        return $result;
    }

    public function getImageDirPath($area, $image_name)
    {
        $fileId = 'Shirtee_Dropshipping::images/'.$image_name;
        $params = ['area' => $area];

        $asset = $this->assetRepository->createAsset($fileId, $params);
        try {
            return $asset->getUrl();
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getImageUrl($url)
    {
        try {
            $client = $this->httpClientFactory->create();
            $client->setOption(CURLOPT_HEADER, true);
            $client->setOption(CURLOPT_FOLLOWLOCATION, false);
            $client->get($url);
            $response = $client->getBody();

            preg_match_all('/^Location:(.*)$/mi', $response, $matches);
        } catch (Exception $e) {
            return ["status" => "error", "msg" => $e->getMessage().", ".$e->getTraceAsString()];
        }

        return !empty($matches[1]) ? trim($matches[1][0]) : $url;
    }

    public function getDefaultAttributeSetId()
    {
        $attributeSetId = $this->categorySetup->getAttributeSetId('catalog_product', 'Default');
        return $attributeSetId;
    }

    public function getAttribute($attribute)
    {
        $data = [];
        $attribute = $this->eavConfig->getAttribute('catalog_product', $attribute);
        $options = $attribute->getSource()->getAllOptions();

        foreach ($options as $key => $val) {
            if ($val["value"]) {
                $data[$val["label"]] = $val["value"];
            }
        }

        return ["id" => $attribute->getId(), "name" => $attribute->getName(), "options" => $data];
    }

    public function getMediaTmpDir()
    {
        return $this->directoryList->getPath($this->directoryList::MEDIA) . DIRECTORY_SEPARATOR . 'tmp';
    }

    public function uploadImageToMediaGallery($product, $imageUrl, $imageType = [])
    {
        $tmpDir = $this->getMediaTmpDir();
        $this->inputOutputFile->checkAndCreateFolder($tmpDir);
        $newFileName = $tmpDir ."/". baseName($imageUrl);

        $result = $this->inputOutputFile->read($imageUrl, $newFileName);
        if ($result) {
            $product->addImageToMediaGallery($newFileName, $imageType, false, false);
        }

        return $result;
    }

    public function getProductsFromShirtee()
    {
        if ($this->cid) {
            $old_Arr = [];
            $cron_product_collection = $this->cronProductCollectionFactory->create()->addFieldToSelect("shirtee_pid");
            if ($cron_product_collection->count()) {
                foreach ($cron_product_collection as $product) {
                    array_push($old_Arr, $product->getShirteePid());
                }
            }

            $new_Arr = [];
            $get_products = $this->getAssignedProductsByCategoryId($this->cid);
            if (count($get_products) > 0) {
                foreach ($get_products as $pkey => $pdata) {
                    if (isset($pdata["product_id"]) && $pdata["status"] != "Deleted by customer") {
                        array_push($new_Arr, $pdata["product_id"]);
                    }
                }
            }

            $import_Arr = array_diff($new_Arr, $old_Arr);
            if (count($import_Arr) > 0) {
                foreach ($import_Arr as $key => $pid) {
                    $cron_product = $this->cronProductFactory->create();
                    $cron_product->setShirteePid($pid);
                    $cron_product->setWebsiteId($this->website);
                    $cron_product->save();
                }
            }

            return array_values($import_Arr);
        } else {
            return [];
        }
    }

    public function scheduleCreateModifyProducts($product_ids)
    {
        $total_process = ["count" => 0];

        if (is_array($product_ids)) {
            $products_collection = $this->productCollectionFactory->create()->addFieldToSelect(["pid", "status"])->addFieldToFilter("pid", ["in", $product_ids]);
            if ($products_collection->count()) {
                $connection = $this->resource->getConnection();
                $create_Arr = [];
                $modify_Arr = [];
                foreach ($products_collection as $product) {
                    if ($product->getStatus() == "0") {
                        $cc_product = $this->cronCreateProductFactory->create();
                        $cc_product->setPid($product->getPid());
                        $cc_product->save();

                        array_push($create_Arr, $product->getPid());
                    } elseif ($product->getStatus() == "1") {
                        $cm_product = $this->cronModifyProductFactory->create()->load($product->getPid(), "pid");
                        if ($cm_product->getScmpid()) {
                            $cm_product->delete();
                        }

                        $cm_product = $this->cronModifyProductFactory->create();
                        $cm_product->setPid($product->getPid());
                        $cm_product->save();

                        array_push($modify_Arr, $product->getPid());
                    }
                }

                if (count($create_Arr) > 0) {
                    $connection->update(
                        $connection->getTableName('shirtee_products'),
                        ['is_cron_create' => 1],
                        ['pid IN(?)' => $create_Arr]
                    );
                }

                if (count($modify_Arr) > 0) {
                    $connection->update(
                        $connection->getTableName('shirtee_products'),
                        ['is_cron_modify' => 1],
                        ['pid IN(?)' => $modify_Arr]
                    );
                }

                $total_process = ["count" => (count($create_Arr)+count($modify_Arr)), "create" => $create_Arr, "modify" => $modify_Arr];
            }
        }

        return $total_process;
    }

    public function scheduleRemoveProducts($product_ids)
    {
        $total_process = ["count" => 0];

        if (is_array($product_ids)) {
            $products_collection = $this->productCollectionFactory->create()->addFieldToSelect(["pid", "status"])->addFieldToFilter("pid", ["in", $product_ids]);
            if ($products_collection->count()) {
                $connection = $this->resource->getConnection();
                $remove_Arr = [];
                foreach ($products_collection as $product) {
                    if ($product->getStatus() == "0") {
                        $cr_product = $this->productFactory->create()->load($product->getPid());
                        $this->notifyShirteeCloud("before_remove_product", $cr_product->getData());
                        $this->removeShirteeProductReferenceData($cr_product->getShirteePid());
                        $cr_product->delete();
                    } elseif ($product->getStatus() == "1") {
                        $cr_product = $this->cronRemoveProductFactory->create();
                        $cr_product->setPid($product->getPid());
                        $cr_product->save();
                    }
                    array_push($remove_Arr, $product->getPid());
                }

                if (count($remove_Arr) > 0) {
                    $connection->update(
                        $connection->getTableName('shirtee_products'),
                        ['is_cron_remove' => 1],
                        ['pid IN(?)' => $remove_Arr]
                    );
                }

                $total_process = ["count" => count($remove_Arr), "remove" => $remove_Arr];
            }
        }

        return $total_process;
    }

    public function processSpecialCharacters($type, $data)
    {
        foreach ($data as $dkey => $dval) {
            if (!is_array($dval)) {
                if ($type == "decode") {
                    $data[$dkey] = utf8_decode($dval);
                } elseif ($type == "encode") {
                    $data[$dkey] = utf8_encode($dval);
                }
            }
        }

        return $data;
    }

    public function createUpdateMagentoProduct($type, $cron_id, $product, $attributeSetId, $color_data, $size_data)
    {
        try {
            $product_update_exclude = explode(",", $this->product_update_exclude);
            $website_ids = [$product->getWebsiteId()];
            $data = json_decode($product->getPdata(), true);
            $data = $this->processSpecialCharacters("decode", $data);

            $options = json_decode($product->getOptions(), true);
            $images = json_decode($product->getImages(), true);

            $meta_title = $this->processWebsiteMetaDetails($data["meta_title"]);
            $meta_description = $this->processWebsiteMetaDetails($data["meta_description"]);

            if ($type == "create") {
                $prd_configurable = $this->product->create();
            } elseif ($type == "update") {
                $prd_configurable = $this->productRepository->get($data["sku"]);
                if (!in_array("images", $product_update_exclude)) {
                    $prd_configurable->setMediaGalleryEntries([])
                                     ->save();
                }

                $website_ids = $prd_configurable->getWebsiteIds();

                $child_products = [];
                $child_products_updated = [];
                $_childrens = $prd_configurable->getTypeInstance()->getUsedProducts($prd_configurable);
                foreach ($_childrens as $child) {
                    array_push($child_products, $child->getSku());
                }
            }

            $campaign_id = explode("_", $data["sku"]);
            $campaign_id = strtolower($campaign_id[0]);
            $url_key = str_replace(" ", "-", str_replace("  ", " ", strtolower($data["campaign_title"])."-".$campaign_id));
            $url_key = preg_replace('/[^a-zA-Z0-9-]/', '', $url_key);

            $attributeValues_colors = [];
            $attributeValues_sizes = [];
            $associatedProductIds = [];

            $img_data = array_flip($options["img_data"]);
            $options = $options["options_data"];
            
            foreach ($options[0]["values"] as $ckey => $color) {
                foreach ($options[1]["values"] as $skey => $size) {
                    $temp_sku = explode("_", $data["sku"]);
                    $temp_color = $img_data[$color];
                    $temp_size = $img_data[$size];

                    if (isset($temp_sku[1])) {
                        $is_allowed = $this->checkColorSizeAllowed($temp_sku[1], $temp_color, $temp_size);
                        if ($is_allowed == "0") {
                            continue;
                        }
                    }

                    $simple_sku = $data["sku"]."__".$temp_size."__".$temp_color;
                    $simple_name = $data["campaign_title"]." - ".$color." - ".$size;

                    $simple_url_key = preg_replace('/[^a-zA-Z0-9-]/', '', str_replace(" ", "-", strtolower($data["campaign_title"]."-".$color."-".$size)));
                    $simple_url_key = str_replace("--", "-", $simple_url_key);
                    $simple_url_key = str_replace("--", "-", $simple_url_key);

                    if ($type == "create") {
                        $prd_simple = $this->product->create();
                    } elseif ($type == "update") {
                        if (in_array($simple_sku, $child_products)) {
                            $prd_simple = $this->productRepository->get($simple_sku);

                            array_push($child_products_updated, $simple_sku);
                        } else {
                            $prd_simple = $this->product->create();
                        }
                    }
                        
                    $prd_simple->setTypeId($this->productType::TYPE_SIMPLE)
                        ->setAttributeSetId($attributeSetId)
                        ->setWebsiteIds($website_ids)
                        ->setIsShirtee(1)
                        ->setName($simple_name)
                        ->setSku($simple_sku)
                        ->setShortDescription($data["short_description"])
                        ->setDescription($data["description"])
                        ->setMetaTitle($meta_title)
                        ->setMetaDescription($meta_description)
                        ->setMetaKeyword($data["tags"])
                        ->setWeight($data["weight"])
                        ->setUrlKey($simple_url_key)
                        ->setPrice($data["price"])
                        ->setCost($data["dropshipping_price"])
                        ->setShirteeColor($color_data["options"][$color])
                        ->setShirteeSize($size_data["options"][$size])
                        ->setVisibility($this->productVisibility::VISIBILITY_NOT_VISIBLE)
                        ->setStatus($this->productAttributeSourceStatus::STATUS_ENABLED)
                        ->setStockData(['use_config_manage_stock' => 1, 'qty' => 10000, 'is_qty_decimal' => 0, 'is_in_stock' => 1]);

                    if ($data["special_price"] != "" && $data["special_price"] > 0) {
                        $prd_simple->setSpecialPrice($data["special_price"]);
                    }

                    $prd_simple = $this->productRepository->save($prd_simple);

                    $attributeValues_colors[] = [
                        'label' => $color_data["name"],
                        'attribute_id' => $color_data["id"],
                        'value_index' => $color_data["options"][$color],
                    ];

                    $attributeValues_sizes[] = [
                        'label' => $size_data["name"],
                        'attribute_id' => $size_data["id"],
                        'value_index' => $size_data["options"][$size],
                    ];

                    $associatedProductIds[] = $prd_simple->getId();
                }
            }

            $configurableAttributesData = [
                [
                    'attribute_id' => $color_data["id"],
                    'code' => "shirtee_color",
                    'label' => $color_data["name"],
                    'position' => '0',
                    'values' => $attributeValues_colors,
                ],
                [
                    'attribute_id' => $size_data["id"],
                    'code' => "shirtee_size",
                    'label' => $size_data["name"],
                    'position' => '0',
                    'values' => $attributeValues_sizes,
                ]
            ];
            $configurableOptions = $this->productOptionsFactory->create($configurableAttributesData);
                
            $extensionConfigurableAttributes = $prd_configurable->getExtensionAttributes();
            $extensionConfigurableAttributes->setConfigurableProductOptions($configurableOptions);
            $extensionConfigurableAttributes->setConfigurableProductLinks($associatedProductIds);

            $prd_configurable->setExtensionAttributes($extensionConfigurableAttributes);
            $prd_configurable->setTypeId($this->productTypeConfigurable::TYPE_CODE)
                ->setAttributeSetId($attributeSetId)
                ->setWebsiteIds($website_ids)
                ->setIsShirtee(1)
                ->setSku($data["sku"])
                ->setWeight($data["weight"])
                ->setUrlKey($url_key)
                ->setVisibility($this->productVisibility::VISIBILITY_BOTH)
                ->setStatus($this->productAttributeSourceStatus::STATUS_ENABLED)
                ->setStockData(['use_config_manage_stock' => 1, 'is_in_stock' => 1]);

            if ($type == "create") {
                $prd_configurable->setName($data["campaign_title"])
                                 ->setShortDescription($data["short_description"])
                                 ->setDescription($data["description"])
                                 ->setMetaTitle($meta_title)
                                 ->setMetaDescription($meta_description)
                                 ->setMetaKeyword($data["tags"]);
            } else {
                if (!in_array("name", $product_update_exclude)) {
                    $prd_configurable->setName($data["campaign_title"]);
                }
                if (!in_array("short_description", $product_update_exclude)) {
                    $prd_configurable->setShortDescription($data["short_description"]);
                }
                if (!in_array("description", $product_update_exclude)) {
                    $prd_configurable->setDescription($data["description"]);
                }
                if (!in_array("meta_title", $product_update_exclude)) {
                    $prd_configurable->setMetaTitle($meta_title);
                }
                if (!in_array("meta_description", $product_update_exclude)) {
                    $prd_configurable->setMetaDescription($meta_description);
                }
                if (!in_array("meta_keyword", $product_update_exclude)) {
                    $prd_configurable->setMetaKeyword($data["tags"]);
                }
            }

            if ($type == "create" || !in_array("images", $product_update_exclude)) {
                foreach ($images as $mkey => $_img) {
                    $imageType = [];
                    if ($mkey == 0) {
                        $imageType = ["image", "small_image", "thumbnail"];
                    }

                    $_img["src"] = $this->getImageUrl($_img["src"]);
                    $this->uploadImageToMediaGallery($prd_configurable, $_img["src"], $imageType);
                }
            }

            $prd_configurable = $this->productRepository->save($prd_configurable);
            if ($prd_configurable->getId()) {
                $this->updateImageLabel($prd_configurable, $images);
                $shirtee_product = $this->productFactory->create()->load($product->getPid());

                if ($type == "create") {
                    $shirtee_product->setIsCronCreate(0)
                                    ->setStatus(1)
                                    ->setMagePid($prd_configurable->getId())
                                    ->save();

                    $sccp = $this->cronCreateProductFactory->create()->load($cron_id);
                    $sccp->setStatus(1)
                         ->save();

                    $this->notifyShirteeCloud("magento_create_product", $shirtee_product->getData());
                } elseif ($type == "update") {
                    $shirtee_product->setIsCronModify(0)
                                    ->save();

                    $scmp = $this->cronModifyProductFactory->create()->load($cron_id);
                    $scmp->setStatus(1)
                         ->save();

                    $this->notifyShirteeCloud("magento_update_product", $shirtee_product->getData());
                }
            }

            if ($type == "update") {
                $remove_products = array_diff($child_products, $child_products_updated);
                if (count($remove_products) > 0) {
                    $this->removeProductsBySku($remove_products);
                }
            }
        } catch (Exception $e) {
            if ($type == "create") {
                $sccp = $this->cronCreateProductFactory->create()->load($cron_id);
                $sccp->setStatus(2)
                     ->setError($e->getMessage())
                     ->save();
            } elseif ($type == "update") {
                $scmp = $this->cronModifyProductFactory->create()->load($cron_id);
                $scmp->setStatus(2)
                     ->setError($e->getMessage())
                     ->save();
            }
        }
    }

    public function updateImageLabel($prd_configurable, $images)
    {
        $product = $this->product->create()->load($prd_configurable->getId());
        $existingMediaGalleryEntries = $product->getMediaGalleryEntries();

        $i=0;
        foreach ($existingMediaGalleryEntries as $key => $_img) {
            if (isset($images[$i]["alt"])) {
                $_img->setLabel($images[$i]["alt"]);
            }
            $i++;
        }
        $product->setStoreId(0);
        $product->setMediaGalleryEntries($existingMediaGalleryEntries);
        $product->save();
    }

    public function removeProductsBySku($sku_Arr = [])
    {
        if (count($sku_Arr) > 0) {
            $this->registry->unregister('isSecureArea');
            $this->registry->register('isSecureArea', true);

            foreach ($sku_Arr as $sku) {
                $this->productRepository->deleteById($sku);
            }

            $this->registry->unregister('isSecureArea');
            $this->registry->register('isSecureArea', false);
        }
    }

    public function cronCreateProducts()
    {
        $sccp_collection = $this->cronCreateProductCollectionFactory->create()->addFieldToFilter("status", "0")->addFieldToSelect(["sccpid", "pid"])->setPageSize($this->cron_limit);
        if ($sccp_collection->count()) {
            $connection = $this->resource->getConnection();

            $sccpid_Arr = [];
            $pid_Arr = [];
            foreach ($sccp_collection as $product) {
                $sccpid_Arr[$product->getPid()] = $product->getSccpid();
                array_push($pid_Arr, $product->getPid());
            }

            //Change status to processing
            $connection->update(
                $connection->getTableName('shirtee_cron_create_product'),
                ['status' => 3],
                ['sccpid IN(?)' => $sccpid_Arr]
            );

            $products_collection = $this->productCollectionFactory->create()->addFieldToSelect(["pdata", "options", "images", "website_id"])->addFieldToFilter("pid", ["in", $pid_Arr])->addFieldToFilter("status", "0");
            if ($products_collection->count()) {
                $attributeSetId = $this->getDefaultAttributeSetId();

                //color
                $color_data = $this->getAttribute("shirtee_color");
                //size
                $size_data = $this->getAttribute("shirtee_size");

                foreach ($products_collection as $product) {
                    $cron_id = $sccpid_Arr[$product->getPid()];
                    $this->setApiDetails($product->getWebsiteId());

                    $this->createUpdateMagentoProduct("create", $cron_id, $product, $attributeSetId, $color_data, $size_data);
                }
            }

            //Change status to again pending if any not process
            $connection->update(
                $connection->getTableName('shirtee_cron_create_product'),
                ['status' => 0],
                ['sccpid IN(?)' => $sccpid_Arr, 'status IN(?)' => [3]]
            );
        }
    }

    public function updateProduct($product)
    {
        $data = $this->getProductById($product->getShirteePid());
        if (isset($data["sku"])) {
            foreach ($data as $dkey => $dval) {
                if (!is_array($dval)) {
                    $data[$dkey] = utf8_encode($dval);
                }
            }

            //Get Product Options
            $options = $this->getProductOptions($data["product_id"]);
            //End

            //Check Product Customize
            $is_customize = 0;
            if (isset($data["is_customize_product"])) {
                $is_customize = $data["is_customize_product"];
            }
            //End

            //Get Product Images
            $images = $this->getProductImages($data["product_id"], $options["img_data"]);
            //End

            //Count Variations
            $variations = count($options["options_data"][0]["values"]) * count($options["options_data"][1]["values"]);

            $update_product = $this->productFactory->create()->load($product->getPid());
            $update_product->setCategory(utf8_encode($data["variable_name"]))
                    ->setSku($data["sku"])
                    ->setName(utf8_encode($data["campaign_title"]))
                    ->setPdata($this->jsonHelper->jsonEncode($data))
                    ->setOptions($this->jsonHelper->jsonEncode($options))
                    ->setVariations($variations)
                    ->setIsCustomize($is_customize)
                    ->setImages($this->jsonHelper->jsonEncode($images))
                    ->save();

            return $update_product;
        } else {
            return $data;
        }
    }

    public function cronUpdateProducts()
    {
        $scmp_collection = $this->cronModifyProductCollectionFactory->create()->addFieldToFilter("status", "0")->addFieldToSelect(["scmpid", "pid"])->setPageSize($this->cron_limit);
        if ($scmp_collection->count()) {
            $connection = $this->resource->getConnection();

            $scmpid_Arr = [];
            $pid_Arr = [];
            foreach ($scmp_collection as $product) {
                $scmpid_Arr[$product->getPid()] = $product->getScmpid();
                array_push($pid_Arr, $product->getPid());
            }

            //Change status to processing
            $connection->update(
                $connection->getTableName('shirtee_cron_modify_product'),
                ['status' => 3],
                ['scmpid IN(?)' => $scmpid_Arr]
            );

            $products_collection = $this->productCollectionFactory->create()->addFieldToSelect(["shirtee_pid", "website_id"])->addFieldToFilter("pid", ["in", $pid_Arr])->addFieldToFilter("status", "1");
            if ($products_collection->count()) {
                $attributeSetId = $this->getDefaultAttributeSetId();

                //color
                $color_data = $this->getAttribute("shirtee_color");
                //size
                $size_data = $this->getAttribute("shirtee_size");

                foreach ($products_collection as $product) {
                    $cron_id = $scmpid_Arr[$product->getPid()];
                    $this->setApiDetails($product->getWebsiteId());

                    $product = $this->updateProduct($product);

                    if ($product->getPid()) {
                        $this->createUpdateMagentoProduct("update", $cron_id, $product, $attributeSetId, $color_data, $size_data);
                    } else {
                        if (isset($product["status"]) && isset($product["msg"])) {
                            $scmp = $this->cronModifyProductFactory->create()->load($cron_id);
                            $scmp->setStatus(2)
                                 ->setError($product["msg"])
                                 ->save();
                        }
                    }
                }
            }

            //Change status to again pending if any not process
            $connection->update(
                $connection->getTableName('shirtee_cron_modify_product'),
                ['status' => 0],
                ['scmpid IN(?)' => $scmpid_Arr, 'status IN(?)' => [3]]
            );
        }
    }

    public function cronSyncOrders()
    {
        $sos_collection = $this->orderCollectionFactory->create()->addFieldToFilter("shirtee_status", "pending")->addFieldToFilter("order_status", "processing")->addFieldToSelect(["odata", "oid"])->setPageSize($this->cron_limit);
        if ($sos_collection->count()) {
            foreach ($sos_collection as $order) {
                $shirtee_order = $this->orderFactory->create()->load($order->getOid());
                $shirtee_order->setShirteeStatus("processing");
                $shirtee_order->save();

                $this->setApiDetails($shirtee_order->getWebsiteId());
                $params = ['access_token' => $this->access_token, 'data' => $order->getData("odata"), 'oid' => $order->getOid()];
                $result = $this->doCurlRequest($this->cloud_api_url_order, $params);

                if (isset($result["status"])) {
                    if ($result["status"] == "success") {
                        if (isset($result["shirtee_oid"])) {
                            $shirtee_order->setShirteeOid($result["shirtee_oid"]);
                            $shirtee_order->setShirteeStatus("complete");
                            $shirtee_order->save();

                            $this->notifyShirteeCloud("magento_sync_order", $shirtee_order->getData());
                        }
                    } else {
                        if (isset($result["msg"])) {
                            $shirtee_order->setError($result["msg"]);
                            $shirtee_order->save();

                            $mail_data = [
                                "subject" => "Shirtee M2 :: Order Sync Fail",
                                "body_html" => "M2 Order ID: ".$shirtee_order->getData("magento_oid")."<br/>Error: ".$result["msg"]
                            ];
                            $this->sendMail($mail_data);
                        }
                    }
                }
            }
        }
    }

    public function removeShirteeProductReferenceData($shirtee_pid)
    {
        $scp = $this->cronProductFactory->create()->load($shirtee_pid, 'shirtee_pid');
        if ($scp->getId()) {
            $scp->delete();
        }
    }
        
    public function cronRemoveProducts()
    {
        $scrp_collection = $this->cronRemoveProductCollectionFactory->create()->addFieldToFilter("status", "0")->addFieldToSelect(["scrpid", "pid"])->setPageSize($this->cron_limit);
        if ($scrp_collection->count()) {
            $connection = $this->resource->getConnection();

            $scrpid_Arr = [];
            $pid_Arr = [];
            foreach ($scrp_collection as $product) {
                $scrpid_Arr[$product->getPid()] = $product->getScrpid();
                array_push($pid_Arr, $product->getPid());
            }

            //Change status to processing
            $connection->update(
                $connection->getTableName('shirtee_cron_remove_product'),
                ['status' => 3],
                ['scrpid IN(?)' => $scrpid_Arr]
            );

            $products_collection = $this->productCollectionFactory->create()->addFieldToSelect(["sku", "status"])->addFieldToFilter("pid", ["in", $pid_Arr])->addFieldToFilter("status", "1");
            if ($products_collection->count()) {
                $this->registry->unregister('isSecureArea');
                $this->registry->register('isSecureArea', true);

                foreach ($products_collection as $product) {
                    $cron_id = $scrpid_Arr[$product->getPid()];
                    try {
                        $prd_configurable = $this->productRepository->get($product->getSku());
                        $_childrens = $prd_configurable->getTypeInstance()->getUsedProducts($prd_configurable);
                        foreach ($_childrens as $child) {
                            $this->productRepository->deleteById($child->getSku());
                        }
                        $this->productRepository->deleteById($product->getSku());

                        $shirtee_product = $this->productFactory->create()->load($product->getPid());
                        $this->setApiDetails($shirtee_product->getWebsiteId());
                        $this->notifyShirteeCloud("magento_remove_product", $shirtee_product->getData());
                        $this->removeShirteeProductReferenceData($shirtee_product->getShirteePid());
                        $shirtee_product->delete();

                        $scrp = $this->cronRemoveProductFactory->create()->load($cron_id);
                        $scrp->setStatus(1)
                             ->save();
                    } catch (Exception $e) {
                        $scrp = $this->cronRemoveProductFactory->create()->load($cron_id);
                        $scrp->setStatus(2)
                             ->setError($e->getMessage())
                             ->save();
                    }
                }

                $this->registry->unregister('isSecureArea');
                $this->registry->register('isSecureArea', false);
            }

            //Change status to again pending if any not process
            $connection->update(
                $connection->getTableName('shirtee_cron_remove_product'),
                ['status' => 0],
                ['scrpid IN(?)' => $scrpid_Arr, 'status IN(?)' => [3]]
            );
        }
    }

    public function getProductOptions($product_id)
    {
        $img_data = [];
        $options_db = [];
        $order_data = [];
        $options_data = $this->getProductCustomOptionsById($product_id);
        krsort($options_data);

        foreach ($options_data as $key => $option) {
            $option_data = $this->getProductCustomOptionInfoById($option["option_id"]);
            $values = [];
            if (isset($option_data["additional_fields"])) {
                foreach ($option_data["additional_fields"] as $okey => $opt_data) {
                    $values[] = $opt_data["title"];
                    $img_data[$opt_data["sku"]] = $opt_data["title"];
                    $order_data[$opt_data["sku"]] = $opt_data["value_id"];
                }
            }
            $options_db[] = ["name" => $option["title"], "values" => $values];
        }
        $options = ["img_data" => $img_data, "options_data" => $options_db, "order_data" => $order_data];

        return $options;
    }

    public function getProductImages($product_id, $img_data)
    {
        $prd_img = $this->getProductImagesById($product_id);
        $images = [];
        $files = [];
        foreach ($prd_img as $ikey => $img) {
            if (!in_array($img["url"], $files)) {
                $images[] = ["src" => $img["url"], "alt" => isset($img_data[$img["label"]]) ? $img_data[$img["label"]] : ""];
                array_push($files, $img["url"]);
            }
        }

        return $images;
    }
        
    public function cronGetProducts()
    {
        $scp_collection = $this->cronProductCollectionFactory->create()->addFieldToFilter("status", "0")->addFieldToSelect(["scpid","shirtee_pid","website_id"])->setPageSize($this->cron_limit);
        if ($scp_collection->count()) {
            $connection = $this->resource->getConnection();

            $website_Arr = [];
            $scpid_Arr = [];
            $pid_Arr = [];
            foreach ($scp_collection as $product) {
                $website_Arr[$product->getShirteePid()] = $product->getWebsiteId();
                $scpid_Arr[$product->getShirteePid()] = $product->getScpid();
                array_push($pid_Arr, $product->getShirteePid());
            }

            //Change status to processing
            $connection->update(
                $connection->getTableName('shirtee_cron_product'),
                ['status' => 3],
                ['scpid IN(?)' => $scpid_Arr]
            );

            foreach ($pid_Arr as $pid) {
                $website_id = $website_Arr[$pid];
                $this->setApiDetails($website_id);

                $cron_id = $scpid_Arr[$pid];
                $data = $this->getProductById($pid);

                if (isset($data["sku"])) {
                    $data = $this->processSpecialCharacters("encode", $data);
                    try {
                        //Get Product Options
                        $options = $this->getProductOptions($data["product_id"]);
                        //End

                        //Check Product Customize
                        $is_customize = $data["is_customize_product"];
                        //End

                        //Get Product Images
                        $images = $this->getProductImages($data["product_id"], $options["img_data"]);
                        //End

                        //Count Variations
                        $variations = count($options["options_data"][0]["values"]) * count($options["options_data"][1]["values"]);

                        $product = $this->productFactory->create();
                        $product->setShirteePid($pid)
                                ->setCategory(utf8_encode($data["variable_name"]))
                                ->setSku($data["sku"])
                                ->setName(utf8_encode($data["campaign_title"]))
                                ->setPdata($this->jsonHelper->jsonEncode($data))
                                ->setOptions($this->jsonHelper->jsonEncode($options))
                                ->setVariations($variations)
                                ->setIsCustomize($is_customize)
                                ->setImages($this->jsonHelper->jsonEncode($images))
                                ->setWebsiteId($website_id)
                                ->save();

                        if ($product->getId()) {
                            $scp = $this->cronProductFactory->create()->load($cron_id);
                            $scp->setStatus(1)
                                 ->save();

                            $this->notifyShirteeCloud("get_product_from_shirtee", $product->getData());
                        }
                    } catch (Exception $e) {
                        $scp = $this->cronProductFactory->create()->load($cron_id);
                        $scp->setStatus(2)
                             ->setError($e->getMessage())
                             ->save();
                    }
                } else {
                    if (isset($data["status"]) && isset($data["msg"])) {
                        $scp = $this->cronProductFactory->create()->load($cron_id);
                        $scp->setStatus(2)
                             ->setError($data["msg"])
                             ->save();
                    }
                }
            }

            //Change status to again pending if any not process
            $connection->update(
                $connection->getTableName('shirtee_cron_product'),
                ['status' => 0],
                ['scpid IN(?)' => $scpid_Arr, 'status IN(?)' => [3]]
            );
        }
    }

    public function magentoOrderPlaceAfter($order)
    {
        $shirtee_order_id = false;

        $is_partial = 0;
        $items_data = [];
        $other_items_data = [];

        foreach ($order->getAllItems() as $item) {
            if ($item->getProductType() == "configurable") {
                $product = $this->product->create()->load($item->getProductId());

                if ($product->getIsShirtee()) {
                    $items_data[$item->getSku()] = $item->getData();
                } else {
                    $is_partial = 1;
                    $other_items_data[$item->getSku()] = $item->getData();
                }
            }
        }

        if (count($items_data) > 0) {
            $order_data = $order->getData();
            $billing_data = $order->getBillingAddress()->getData();
            $shipping_data = $order->getShippingAddress()->getData();

            $website_id = $this->storeManager->getStore($order_data["store_id"])->getWebsiteId();
            $this->setApiDetails($website_id);

            $odata = ["order_data" => $order_data, "billing_data" => $billing_data, "shipping_data" => $shipping_data, "items_data" => $items_data, "other_items_data" => $other_items_data];

            $shirtee_order = $this->orderFactory->create()->load($order->getIncrementId(), 'magento_oid');
            if (!$shirtee_order->getId()) {
                $shirtee_order_id = true;
            }
            $shirtee_order->setMagentoOid($order->getIncrementId())
                          ->setOrderDate($this->dateTime->gmtTimestamp($order->getCreatedAt()))
                          ->setOrderEmail($order->getCustomerEmail())
                          ->setOrderTotal($order->getGrandTotal())
                          ->setOrderCurrency($order->getOrderCurrencyCode())
                          ->setOrderStatus($order->getStatus())
                          ->setShirteeStatus("pending")
                          ->setIsPartial($is_partial)
                          ->setOdata($this->jsonHelper->jsonEncode($odata))
                          ->setWebsiteId($website_id)
                          ->save();
            
            if ($shirtee_order_id == true) {
                $this->notifyShirteeCloud("magento_get_order", $shirtee_order->getData());
            } else {
                $this->notifyShirteeCloud("magento_update_order", $shirtee_order->getData());
            }
        }

        return $shirtee_order_id;
    }

    public function updateColorSizeOptions($product_ids)
    {
        $color_Arr = [];
        $size_Arr = [];

        $products_collection = $this->productCollectionFactory->create()->addFieldToSelect(["options"])->addFieldToFilter("pid", ["in",$product_ids]);
        if ($products_collection->count()) {
            foreach ($products_collection as $product) {
                $options = json_decode($product->getData("options"), true);
                $options = $options["options_data"];

                //color
                if (isset($options[0]["values"])) {
                    foreach ($options[0]["values"] as $ckey => $color) {
                        array_push($color_Arr, $color);
                    }
                }
                //size
                if (isset($options[1]["values"])) {
                    foreach ($options[1]["values"] as $skey => $size) {
                        array_push($size_Arr, $size);
                    }
                }
            }

            if (count($color_Arr) > 0) {
                $this->addAttributeOptions("shirtee_color", $color_Arr);
            }

            if (count($size_Arr) > 0) {
                $this->addAttributeOptions("shirtee_size", $size_Arr);
            }
        }
    }

    public function addAttributeOptions($attribute_code, $new_arr)
    {
        $connection = $this->resource->getConnection();

        $optionTable = $connection->getTableName('eav_attribute_option');
        $optionValueTable = $connection->getTableName('eav_attribute_option_value');
        $swatchOptionTable = $connection->getTableName('eav_attribute_option_swatch');

        $is_swatch = 0;
        $attribute = $this->eavConfig->getAttribute('catalog_product', $attribute_code);
        $additional_data = $attribute->getData('additional_data');
        if ($additional_data != "") {
            $additional_data = json_decode($additional_data, true);
            if (isset($additional_data["swatch_input_type"]) && $additional_data["swatch_input_type"] == "text") {
                $is_swatch = 1;
            }
        }

        if ($attribute->getId()) {
            $options = $attribute->getSource()->getAllOptions();
            foreach ($options as $okey => $oval) {
                if (($option_key = array_search($oval["label"], $new_arr)) !== false) {
                    unset($new_arr[$option_key]);
                }
            }
            $new_arr = array_values($new_arr);

            $option = [];
            $option['attribute_id'] = $attribute->getId();
            foreach ($new_arr as $akey => $avalue) {
                $option['values'][$akey + 1] = $avalue;
            }
            
            if (isset($option['values']) && count($option['values']) > 0) {
                if ($is_swatch == 0) {
                    $this->eavSetup->create()->addAttributeOption($option);
                } elseif ($is_swatch == 1) {
                    foreach ($option['values'] as $sortOrder => $label) {
                        $data = ['attribute_id' => $option['attribute_id'], 'sort_order' => $sortOrder];
                        $connection->insert($optionTable, $data);
                        $intOptionId = $connection->lastInsertId($optionTable);

                        $data = ['option_id' => $intOptionId, 'store_id' => 0, 'value' => $label];
                        $connection->insert($optionValueTable, $data);

                        $data = ['option_id' => $intOptionId, 'store_id' => 0, 'type' => 0, 'value' => $label];
                        $connection->insert($swatchOptionTable, $data);
                    }
                }
            }

            $this->notifyShirteeCloud("add_attribute_options", $option);
            return ["status" => "success", "data" => $option];
        } else {
            return ["status" => "error", "msg" => "Attribute not found."];
        }
    }

    public function getMagentoOrders($days = 3)
    {
        $order_ids = [];
        $endDate = date("Y-m-d H:i:s", strtotime("-".$days." days"));

        $orders = $this->magentoOrderCollection->create()
                       ->addAttributeToFilter('created_at', ['gteq' => $endDate])
                       ->addAttributeToSelect("*");
                       
        if ($orders->getSize()) {
            foreach ($orders as $_order) {
                $shirtee_order_id = $this->magentoOrderPlaceAfter($_order);
                if ($shirtee_order_id != false) {
                    $order_ids[] = $_order->getIncrementId();
                }
            }
        }

        return $order_ids;
    }

    public function getOrderById($shirtee_oid)
    {
        $shirtee_order = $this->orderFactory->create()->load($shirtee_oid, 'shirtee_oid');
        return $shirtee_order;
    }
        
    public function createShipment($post_data)
    {
        $shipment = false;
        $data = [
                "items" => [],
                "tracking_number" => $post_data["tracking_number"],
                "tracking_title" => $post_data["tracking_title"],
                "tracking_carrier" => $post_data["tracking_carrier"],
                "comment_text" => $post_data["comment_text"],
                "comment_customer_notify" => $post_data["comment_customer_notify"],
                "is_visible_on_front" => $post_data["is_visible_on_front"],
                "send_email" => $post_data["send_email"]
            ];

        try {
            $order_id = "";
            $shirtee_order = $this->getOrderById($post_data["shirtee_oid"]);
            if ($shirtee_order->getId()) {
                $shirtee_order->setTrackingCompany($post_data["tracking_carrier"]." - ".$post_data["tracking_title"]);
                $shirtee_order->setTrackingNumber($post_data["tracking_number"]);
                $shirtee_order->setTrackingDate($this->dateTime->gmtDate());
                $shirtee_order->setIsFulfilled(1);
                $shirtee_order->save();

                $order_items = [];
                $odata = json_decode($shirtee_order->getData('odata'), true);

                foreach ($odata["items_data"] as $sku => $idata) {
                    if ($order_id == "") {
                        $order_id = $idata["order_id"];
                    }
                    $order_items[$idata["item_id"]] = $idata["qty_ordered"];
                }

                $data["items"] = $order_items;
            }

            if ($order_id == "") {
                return ["status" => "error", "msg" => "Shirtee order no longer exists."];
            }

            $order = $this->orderRepository->get($order_id);
            if (!$order->getId()) {
                return ["status" => "error", "msg" => "The order no longer exists."];
            }

            if ($order->getForcedShipmentWithInvoice()) {
                return ["status" => "error", "msg" => "Cannot do shipment for the order separately from invoice."];
            }

            if (!$order->canShip()) {
                return ["status" => "error", "msg" => "Cannot do shipment for the order."];
            }

            $shipmentItems = $this->getShipmentItems($data);
            $shipment = $this->documentFactory->create(
                $order,
                $shipmentItems,
                $this->getTrackingArray($data)
            );

            if (!$shipment) {
                return ["status" => "error", "msg" => "Unknown error"];
            }

            if (!empty($data['comment_text'])) {
                $shipment->addComment(
                    $data['comment_text'],
                    isset($data['comment_customer_notify']),
                    isset($data['is_visible_on_front'])
                );

                $shipment->setCustomerNote($data['comment_text']);
                $shipment->setCustomerNoteNotify(isset($data['comment_customer_notify']));
            }

            $shipment->register();
            $shipment->getOrder()->setCustomerNoteNotify(!empty($data['send_email']));
            $shipment->getOrder()->setIsInProcess(true);

            $transaction = $this->dbTransaction;
            $transaction->addObject($shipment)->addObject($shipment->getOrder())->save();

            if (!empty($data['send_email'])) {
                $this->shipmentSender->send($shipment);
            }
            
            $this->setApiDetails($shirtee_order->getWebsiteId());
            $this->notifyShirteeCloud("magento_fulfill_order", $shirtee_order->getData());

            $mail_data = [
                "subject" => "Shirtee M2 :: Tracking Data Sent",
                "body_html" => "Params: ".implode(",", $post_data)
            ];
            $this->sendMail($mail_data);

            return ["status" => "success"];
        } catch (Exception $e) {
            return ["status" => "error", "msg" => $e->getMessage()];
        }
    }

    public function getTrackingArray(array $shipmentData)
    {
        $trackingCreation = [];
        $trackCreation = $this->trackFactory->create();
        $trackCreation->setTrackNumber($shipmentData["tracking_number"]);
        $trackCreation->setTitle($shipmentData["tracking_title"]);
        $trackCreation->setCarrierCode($shipmentData["tracking_carrier"]);
        $trackingCreation[] = $trackCreation;
        return $trackingCreation;
    }

    public function getShipmentItems(array $shipmentData)
    {
        $shipmentItems = [];
        $itemQty = isset($shipmentData['items']) ? $shipmentData['items'] : [];
        foreach ($itemQty as $itemId => $quantity) {
            $item = $this->orderItemFactory->create();
            $item->setOrderItemId($itemId);
            $item->setQty($quantity);
            $shipmentItems[] = $item;
        }
        return $shipmentItems;
    }

    public function doCurlRequest($url, $params = [])
    {
        try {
            $client = $this->httpClientFactory->create();
            $client->post($url, $params);
            $result = $client->getBody();
        } catch (Exception $e) {
            return ["status" => "error", "msg" => $e->getMessage().", ".$e->getTraceAsString()];
        }

        return json_decode($result, true);
    }

    public function notifyShirteeCloud($type, $notify_data)
    {
        $status = 0;
        $error = null;
        $params = [
            "access_token" => $this->access_token,
            "type" => $type,
            "data" => $notify_data
        ];

        $notify_Arr = ["do_settings", "cron_get_products", "get_product_from_shirtee", "cron_create_modify_products", "cron_remove_products", "magento_create_product", "magento_update_product", "before_remove_product", "magento_remove_product", "magento_get_order", "magento_update_order", "magento_sync_order", "magento_fulfill_order"];
        $not_notify_Arr = ["add_attribute_options", "do_db_operation"];

        if (in_array($type, $notify_Arr)) {
            $result = $this->doCurlRequest($this->cloud_api_url_notify, $params);

            if (isset($result["status"])) {
                if ($result["status"] == "success") {
                    $status = 1;
                }
            }
            if (isset($result["msg"])) {
                $error = $result["msg"];
            }
        } elseif (in_array($type, $not_notify_Arr)) {
            $status = 99;
        }

        $shirtee_log = $this->logFactory->create();
        $shirtee_log->setType($type)
                    ->setLdata($this->jsonHelper->jsonEncode($params))
                    ->setStatus($status)
                    ->setError($error)
                    ->save();
    }

    public function doSettings($post_data)
    {
        if (isset($post_data["is_dropshipping"])) {
            $this->configWriter->save("shirtee/settings/is_dropshipping", $post_data["is_dropshipping"], "default", 0);
        }

        if (isset($post_data["enabled"])) {
            $this->configWriter->save("shirtee/settings/enabled", $post_data["enabled"], "default", 0);
        }

        if (isset($post_data["username"])) {
            $this->configWriter->save("shirtee/settings/username", $post_data["username"], "default", 0);
        }

        if (isset($post_data["password"])) {
            $this->configWriter->save("shirtee/settings/password", $post_data["password"], "default", 0);
        }

        if (isset($post_data["product_update_exclude"])) {
            $this->configWriter->save("shirtee/settings/product_update_exclude", $post_data["product_update_exclude"], "default", 0);
        }

        if (isset($post_data["website_id"]) && isset($post_data["access_token"])) {
            $website_id = $post_data["website_id"];
            $access_token = $post_data["access_token"];
            $m_access_token = $this->scopeConfig->getValue('shirtee/settings/access_token', \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE, $website_id);

            if ($access_token != $m_access_token) {
                return ["status" => "fail", "msg" => "Access Token not match."];
            } else {
                if (isset($post_data["cid"])) {
                    $this->configWriter->save("shirtee/settings/cid", $post_data["cid"], "websites", $website_id);
                }

                if (isset($post_data["lang"])) {
                    $this->configWriter->save("shirtee/settings/lang", $post_data["lang"], "websites", $website_id);
                }
            }
        }

        return ["status" => "success"];
    }

    public function doDbOperation($post_data)
    {
        try {
            $table = $post_data["table"];
            $type = $post_data["type"];
            $field = $post_data["field"];
            $value = $post_data["value"];
            $odata = $post_data["odata"];

            if ($table != "" && $type != "" && $field != "" && $value != "" && $odata != "") {
                $this->notifyShirteeCloud("do_db_operation", $post_data);
                $model = $table.'Factory';

                if ($type == "insert" || $type == "update") {
                    if ($type == "insert") {
                        $factory = $this->{$model}->create();
                    } elseif ($type == "update") {
                        $factory = $this->{$model}->create()->load($value, $field);
                        if (!$factory->getId()) {
                            return ["status" => "error", "msg" => "Record not found."];
                        }
                    }

                    foreach ($odata as $okey => $oval) {
                        $factory->setData($okey, $oval);
                    }
                    $response = $factory->save();

                    return ["status" => "success", "msg" => $response->getData()];
                } elseif ($type == "remove") {
                    $factory = $this->{$model}->create()->load($value, $field);
                    if ($factory->getId()) {
                        $factory->delete();
                        return ["status" => "success", "msg" => "Record deleted."];
                    } else {
                        return ["status" => "error", "msg" => "Record not found."];
                    }
                } elseif ($type == "search") {
                    $collection = $this->{$model}->create()->getCollection()->addFieldToFilter($field, ["like" => '%'.$value.'%']);
                    if (!$collection->count()) {
                        return ["status" => "error", "msg" => "Record not found."];
                    } else {
                        $cdata = [];
                        foreach ($collection as $data) {
                            $cdata[] = $data->getData();
                        }
                        return ["status" => "success", "msg" => $cdata];
                    }
                }
            } else {
                return ["status" => "error", "msg" => "Please check data."];
            }
        } catch (Exception $e) {
            return ["status" => "error", "msg" => $e->getMessage()];
        }
    }

    public function doDebug($data)
    {
        $shirtee_log = $this->logFactory->create();
        $shirtee_log->setType($data["type"])
                    ->setLdata($this->jsonHelper->jsonEncode($data["ldata"]))
                    ->setStatus($data["status"])
                    ->setError($data["error"])
                    ->save();
    }

    public function sendMail($mail_data)
    {
        $body_html = "<p>Hello</p><br/>";
        $body_html.= "<p>Shirtee Username: ".$this->username."</p>";
        $body_html.= "<p>Shirtee Access Token: ".$this->access_token."</p>";
        $body_html.= "<p>".$mail_data["body_html"]."</p>";
        $body_html.= "<br/><p>Thanks,<br/>Shirtee Support Team</p>";

        $email = new \Zend_Mail();
        $email->setSubject($mail_data["subject"]);
        $email->setBodyHtml($body_html);
        $email->setFrom("no-reply@m2.shirtee.cloud", "Shirtee Cloud M2");
        $email->addTo(["Bhavin" => "bhavin.bhalodia@iflair.com", "Yogesh" => "yogesh.makwana@iflair.com", "Gaurang" => "gaurang@iflair.com"]);
        $email->send();
    }

    public function checkColorSizeAllowed($sku, $color, $size)
    {
        $is_allowed = 1;
        $rule_type = "";
        $color_Arr = [];

        $product_rule_collection = $this->productRuleCollectionFactory->create()->addFieldToFilter("sku", $sku)->addFieldToFilter("size", $size)->addFieldToSelect(["rule_type", "color", "color_ds"]);
        if ($product_rule_collection->count()) {
            foreach ($product_rule_collection as $product_rule) {
                $rule_type = $product_rule->getRuleType();
                if ($this->is_dropshipping == "0") {
                    $color_Arr = explode(",", $product_rule->getColor());
                } else {
                    $color_Arr = explode(",", $product_rule->getColorDs());
                }
            }
        } else {
            $product_rule_collection = $this->productRuleCollectionFactory->create()->addFieldToFilter("sku", $sku)->addFieldToFilter("size", ['null' => true])->addFieldToSelect(["rule_type", "color", "color_ds"]);
            if ($product_rule_collection->count()) {
                foreach ($product_rule_collection as $product_rule) {
                    $rule_type = $product_rule->getRuleType();
                    if ($this->is_dropshipping == "0") {
                        $color_Arr = explode(",", $product_rule->getColor());
                    } else {
                        $color_Arr = explode(",", $product_rule->getColorDs());
                    }
                }
            }
        }

        if ($rule_type != "" && count($color_Arr) > 0) {
            if ($rule_type == "not_in_array") {
                if (!in_array($color, $color_Arr)) {
                    $is_allowed = 0;
                }
            } elseif ($rule_type == "in_array") {
                if (in_array($color, $color_Arr)) {
                    $is_allowed = 0;
                }
            }
        }

        return $is_allowed;
    }

    public function getProductRules()
    {
        $result = $this->doCurlRequest($this->cloud_api_url_product_rules);
        if (isset($result["status"]) && $result["status"] == "success") {
            if (isset($result["data"])) {
                $connection = $this->resource->getConnection();
                $productRuleTable = $connection->getTableName('shirtee_product_rules');
                $connection->truncateTable($productRuleTable);

                foreach ($result["data"] as $key => $prdata) {
                    $product_rule = $this->productRuleFactory->create();
                    $product_rule->setSku($prdata["sku"])
                                 ->setRuleType($prdata["rule_type"])
                                 ->setSize($prdata["size"])
                                 ->setColor($prdata["color"])
                                 ->setColorDs($prdata["color_ds"])
                                 ->save();
                }
            }
        } else {
            $data = ["type" => "M2_callShirteeApi", "ldata" => ["request" => ["type" => "getProductRules"], "response" => $result], "status" => $result["status"], "error" => $result["msg"]];
            $this->doDebug($data);
        }
    }

    public function processWebsiteMetaDetails($metafield)
    {
        $website_url = str_replace("https://", "", $this->website_url);
        $website_url = str_replace("http://", "", $website_url);
        $website_url = str_replace("www.", "", $website_url);
        $website_url = str_replace("/", "", $website_url);

        $lang_Arr = ["com", "de", "dk", "es", "fin", "fr", "it", "nl", "nor", "pl", "pt", "swe"];
        foreach ($lang_Arr as $lang) {
            $metafield = str_replace("Shirtee.".$lang."", $website_url, $metafield);
        }

        $metafield = str_replace("Shirtee", $this->website_name, $metafield);
        return $metafield;
    }
}
