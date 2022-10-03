<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Lipscore_Widget_Helper' ) ) :

class Lipscore_Widget_Helper {
    public function product_attrs( $productData ) {
        $attrs = array(
            'data-ls-product-name'   => $productData['name'],
            'data-ls-brand'          => $productData['brand'],
            'data-ls-sku'            => implode( ';', $productData['sku_values'] ),
            'data-ls-product-id'     => $productData['internal_id'],
            'data-ls-image-url'      => $productData['image_url'],
            'data-ls-price'          => $productData['price'],
            'data-ls-price-currency' => $productData['currency'],
            'data-ls-category'       => $productData['category'],
            'data-ls-gtin'           => implode( ';', $productData['gtin'] )
        );
        return static::to_string( $attrs );
    }

    public function richsnippet_product_attrs( $productData ) {
        $attrs = array(
            'ls-description'  => $productData['description'],
            'ls-availability' => $productData['availability']
        );
        return static::to_string( $attrs );
    }

    protected function to_string( $attrs ) {
        $strAttrs = array();
        foreach ($attrs as $attr => $value) {
            $value = htmlspecialchars( $value );
            $strAttrs[] = "$attr=\"$value\"";
        }
        return implode( ' ', $strAttrs );
    }
}

endif;
