<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Lipscore_Order_Helper' ) ) :

class Lipscore_Order_Helper {
    public function order_data( $order ) {
        var_dump($order);
    }
}

endif;
