<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Lipscore_Locale_Helper' ) ) :

class Lipscore_Locale_Helper {
    protected static $_available_locales = array('en', 'it', 'no', 'es', 'pt-BR', 'ru', 'sv', 'cs', 'nl', 'da', 'ja', 'de', 'fi', 'fr', 'pl', 'ko', 'pt-PT');

    public static function shop_locale() {
        $locale_code = get_locale();
        list( $language, $region ) = array_pad( explode( '_', $locale_code ), 2, '' );

        $locale = self::available_locale( $language . '-' . $region );
        if ( is_null( $locale ) ) {
            $locale = self::available_locale( $language );
        }
        if ( is_null( $locale ) ) {
            $locale = self::available_locale( $region );
        }
        return $locale ? $locale : 'en';
    }

    protected static function available_locale( $language ) {
        $language = strtolower( $language );
        foreach ( self::$_available_locales as $locale ) {
            if ( strtolower( $locale ) === $language ) {
                return $locale;
            }
        }
        return null;
    }
}

endif;
