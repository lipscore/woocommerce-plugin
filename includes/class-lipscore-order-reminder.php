<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Lipscore_Order_Reminder' ) ) :

class Lipscore_Order_Reminder {
    protected $products_helper;

    public function __construct() {
        $this->products_helper = new Lipscore_Product_Helper();
    }

    public function send_order( $order ) {
        if ( !$order || !is_a( $order, 'WC_Order' ) ) {
            return;
        }

        $data = array(
            'purchase' => $this->order_data( $order ),
            'products' => $this->products_data( $order )
        );

        $this->send( $data );
    }

    public function order_data( $order ) {
        return array(
            'buyer_email'      => $order->billing_email,
            'buyer_name'       => sprintf( '%s %s', $order->shipping_first_name, $order->shipping_last_name ),
            'discount_descr'   => Lipscore_Settings::coupon_description(),
            'discount_voucher' => Lipscore_Settings::coupon_code(),
            'purchased_at'     => (int) strtotime( $order->order_date ),
            'lang'             => Lipscore_Settings::locale()
        );
    }

    protected function products_data( $order ) {
        $products_data = array();

        $items = $order->get_items();
        foreach ($items as $item) {
            $product = new WC_Product( $item[ 'product_id' ] );
            if ( ! $product ) {
                continue;
            }
            $products_data[ $product->get_id() ] = $this->products_helper->product_data( $product );
        }

        return array_values( $products_data );
    }

    protected function send( $data ) {
        if ( ! Lipscore_Settings::is_valid_api_key() ) {
            return;
        }

        $api_key = Lipscore_Settings::api_key();
        $secret  = Lipscore_Settings::secret();
        $api_url = lipscore()->config->api_url();

        wp_remote_post(
            "$api_url/purchases?api_key=$api_key",
            array(
                'timeout' => 3,
                'body'    => json_encode($data),
                'headers' => array(
                    'Content-Type'    => 'application/json',
                    'X-Authorization' => $secret
                )
            )
        );
    }
}

endif;
