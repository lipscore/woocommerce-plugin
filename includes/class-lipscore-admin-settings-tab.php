<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Lipscore_Admin_Settings_Tab' ) ) :

class Lipscore_Admin_Settings_Tab {
    public function init( $settings_tabs ) {
        $settings_tabs['settings_tab_lipscore'] = __( 'Lipscore', 'woocommerce-settings-tab-lipscore' );
        return $settings_tabs;
    }

    public function update_settings() {
        woocommerce_update_options( $this->get_settings() );
    }

    public function tab_content() {
        echo "<div class=\"lipscore-settings\">";
        WC_Admin_Settings::output_fields( $this->get_settings() );
        echo "</div>";
    }

    public function add_assets() {
        wp_enqueue_style('lipscore-admin-styles', Lipscore::assets_url( 'css/admin.css' ) );
    }

    protected function get_settings() {
        $settings = array(
            'title' => array(
                'name'     => __( 'Lipscore Settings', 'woocommerce-settings-tab-lipscore' ),
                'type'     => 'title',
                'id'       => 'lipscore_section_title'
            )
        );
        $api_key = array(
            'name' => __( 'Api Key', 'woocommerce-settings-tab-lipscore' ),
            'type' => 'text',
            'desc' => __( "", 'woocommerce-settings-tab-lipscore' ),
            'id'   => 'lipscore_api_key'
        );

        $settings['api_key'] = $this->api_key_setting();
        $settings['locale']  = $this->locale_setting();

        $settings['section_end'] = array(
            'type' => 'sectionend',
            'id' => 'lipscore_section_end'
        );

        return apply_filters( 'wc_settings_tab_lipscore_settings', $settings );
    }

    protected function api_key_setting() {
        $description = '';
        if ( Lipscore_Settings::is_default_api_key() ) {
            $description = __( '<span class="notice notice-warning notice-alt">Your Lipscore installation is set up using a Demo Account. Please sign up with your own account on <a href="http://lipscore.com/" target="_blank">www.lipscore.com</a> to get access to all available features.', 'woocommerce-settings-tab-lipscore</span>' );
        }

        return array(
            'name'      => __( 'Api Key', 'woocommerce-settings-tab-lipscore' ),
            'type'      => 'text',
            'desc'      => $description,
            'id'        => 'lipscore_api_key',
            'default'   => Lipscore_Settings::DEFAULT_API_KEY
        );
    }

    protected function locale_setting() {
        return array(
            'name'      => __( 'Interface Locale', 'woocommerce-settings-tab-lipscore' ),
            'type'      => 'select',
            'desc'      => 'If "Auto" is selected, the store locale will be used.',
            'id'        => 'lipscore_locale',
            'default'   => Lipscore_Settings::DEFAULT_LOCALE,
            'options'   => array(
                'auto' => __( 'Auto', 'woocommerce-settings-tab-lipscore' ),
                'cz'   => __( 'Czech', 'woocommerce-settings-tab-lipscore' ),
                'dk'   => __( 'Danish', 'woocommerce-settings-tab-lipscore' ),
                'nl'   => __( 'Dutch', 'woocommerce-settings-tab-lipscore' ),
                'en'   => __( 'English', 'woocommerce-settings-tab-lipscore' ),
                'fi'   => __( 'Finnish', 'woocommerce-settings-tab-lipscore' ),
                'fr'   => __( 'French', 'woocommerce-settings-tab-lipscore' ),
                'de'   => __( 'German', 'woocommerce-settings-tab-lipscore' ),
                'it'   => __( 'Italian', 'woocommerce-settings-tab-lipscore' ),
                'ja'   => __( 'Japanese', 'woocommerce-settings-tab-lipscore' ),
                'no'   => __( 'Norwegian', 'woocommerce-settings-tab-lipscore' ),
                'br'   => __( 'Portuguese (Brazil)', 'woocommerce-settings-tab-lipscore' ),
                'ru'   => __( 'Russian', 'woocommerce-settings-tab-lipscore' ),
                'es'   => __( 'Spanish', 'woocommerce-settings-tab-lipscore' ),
                'se'   => __( 'Swedish', 'woocommerce-settings-tab-lipscore' )
            )
        );
    }
}

endif;
