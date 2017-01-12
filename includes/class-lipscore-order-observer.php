<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Lipscore_Order_Observer' ) ) :

class Lipscore_Order_Observer {
    public function status_update( $order_id, $old_status, $new_status ) {
        $old_status = $this->normalize_status( $old_status );
        $new_status = $this->normalize_status( $new_status );

        if ( $this->is_reminder_required( $new_status ) ) {
            //$reminder = new Lipscore_Reminder();
            //$reminder->sendOrder($order_id);
            var_dump('SENDINGcheck_status_update');die();
        }
        die('check_status_update');
    }

    public function create( $order_id, $posted ) {
        $order = new WC_Order( $order_id );
        if ( !$order ) {
            return;
        }

        $status = $this->normalize_status( $order->get_status() );
        if ( $this->is_reminder_required( $status ) ) {
            var_dump('SENDINGcreation');die();
        }
        die('creation');
    }

    /*
    * Update/save an order by admin
    */
    public function meta_save( $order_id, $post ) {
        if ( !isset( $_POST['order_status'] ) ) {
            return;
        }

        $order = new WC_Order( $order_id );
        if ( !$order ) {
            return;
        }

        $old_status = $this->normalize_status( $order->get_status() );
        $new_status = $this->normalize_status( $_POST['order_status'] );

        if ( $old_status != $new_status  && $this->is_reminder_required( $new_status ) ) {
            var_dump('SENDINGcheck_meta_save');die();
        }
    }

    protected function is_reminder_required( $order_status ) {
        $valid_api_key = Lipscore_Settings::is_valid_api_key();
        $valid_status  = $order_status == Lipscore_Settings::order_status();

        return $valid_api_key && $valid_status;
    }

    protected function normalize_status( $order_status ) {
        return str_replace( 'wc-', '',  $order_status);
    }
}

endif;
