<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Lipscore_Product_Helper' ) ) :

class Lipscore_Product_Helper {
    public function product_data( $product ) {
        /*return array(
            'name'         => $product->getName(),
            'brand'        => $this->getAttributeValue($product, $brandAttr),
            'sku_values'   => array($this->getSku($product)),
            'internal_id'  => "{$product->getId()}",
            'url'          => $this->getUrl($product),
            'image_url'    => $this->getImageUrl($product),
            'price'        => $this->getPrice($product),
            'currency'     => $this->getCurrency(),
            'category'     => $this->getCategory($product)
        );*/
        return array(
            'name'         => '',
            'brand'        => '',
            'sku_values'   => array(),
            'internal_id'  => '',
            'url'          => '',
            'image_url'    => '',
            'price'        => '',
            'currency'     => '',
            'category'     => ''
        );
    }

    public function richsnippet_product_data( $product ) {
        /*return array(
            'description'  => $this->getDescription($product),
            'availability' => $this->getAvailability($product)
        );*/
        return array(
            'description'  => '',
            'availability' => ''
        );
    }
}

endif;
