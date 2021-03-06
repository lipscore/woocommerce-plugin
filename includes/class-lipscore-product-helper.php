<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Lipscore_Product_Helper' ) ) :

class Lipscore_Product_Helper {
    public function product_data( $product ) {
        return array(
            'name'         => $product->get_title(),
            'brand'        => '',
            'sku_values'   => [$product->get_sku()],
            'internal_id'  => (string) $product->get_id(),
            'url'          => get_permalink($product->get_id()),
            'image_url'    => $this->image_url( $product ),
            'price'        => $product->get_price(),
            'currency'     => get_woocommerce_currency(),
            'category'     => $this->product_category( $product ),
            'gtin'         => $this->product_gtin( $product )
        );
    }

    public function richsnippet_product_data( $product ) {
        return array(
            'description'  => get_the_excerpt($product->get_id()),
            'availability' => $this->availability( $product )
        );
    }

    protected function product_category( $product ) {
        $terms = get_the_terms( $product->get_id(), 'product_cat' );

        if ( is_wp_error( $terms ) || empty( $terms ) || !is_array( $terms ) ) {
            return '';
        } else {
            return current( $terms )->name;
        }
    }

    protected function product_gtin( $product ) {
        $gtin_attr = Lipscore_Settings::gtin_attr();

        if (!$gtin_attr) {
            return '';
        }

        $gtin = $product->get_attribute($gtin_attr);
        if (!$gtin) {
            $gtin = get_post_meta($product->get_id(), $gtin_attr, true);
        }

        return $gtin;
    }

    protected function image_url ( $product ) {
        return wp_get_attachment_url( $product->get_image_id() );
    }

    protected function availability( $product ) {
        $stock = $product->is_in_stock() ? 'InStock' : 'OutOfStock';
        return 'http://schema.org/' . $stock;
    }
}

endif;
