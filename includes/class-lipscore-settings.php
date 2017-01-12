<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Lipscore_Settings' ) ) :

class Lipscore_Settings {
    const DEFAULT_API_KEY              = '889c3f3e4b6ac67269261324';
    const DEFAULT_LOCALE               = 'auto';
    const DEFAULT_ORDER_STATUS         = 'wc-completed';
    const DEFAULT_COUPON_CODE          = '';
    const DEFAULT_COUPON_DESCRIPTION   = '';

    public static function api_key() {
        return get_option( 'lipscore_api_key', self::DEFAULT_API_KEY );
    }

    public static function locale() {
        $locale = get_option( 'lipscore_locale', self::DEFAULT_LOCALE );
        if ( $locale == 'auto') {
            $locale = Lipscore_Locale_Helper::shop_locale();
        }

        return $locale;
    }

    public static function order_status() {
        return get_option( 'lipscore_order_status', self::DEFAULT_ORDER_STATUS );
    }

    public static function coupon_code() {
        return get_option( 'lipscore_coupon_code', self::DEFAULT_COUPON_CODE );
    }

    public static function coupon_description() {
        return get_option( 'lipscore_coupon_description', self::DEFAULT_COUPON_DESCRIPTION );
    }

    public static function is_default_api_key() {
        return self::DEFAULT_API_KEY == self::api_key();
    }

    public static function is_valid_api_key() {
        return self::api_key() && !self::is_default_api_key();
    }
}

endif;
