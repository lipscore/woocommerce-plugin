<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Lipscore_Initializer' ) ) :

class Lipscore_Initializer {
    public function add_script() {
        $api_key   = Lipscore_Settings::api_key();
        $assetsUrl = lipscore()->config->assets_url();
        $locale    = Lipscore_Settings::locale();
        $script_attributes = apply_filters('lipscore_script_attributes', array(
            'data-cfasync' => 'false',
            'type' => 'text/javascript'
        ));

        $attrs_string = '';
        foreach ($script_attributes as $key => $value) {
            $attrs_string .= sprintf('%s="%s" ', esc_attr($key), esc_attr($value));
        }
        $attrs_string = trim ( $attrs_string );

        echo "
            <script {$attrs_string}>
            //<![CDATA[
            window.lipscoreInit = function() {
                lipscore.init({
                    apiKey: \"{$api_key}\"
                });
            };
            (function() {
                var scr = document.createElement('script'); scr.async = 1; scr.setAttribute(\"data-cfasync\", false);
                scr.charset = \"utf-8\";
                scr.src = \"$assetsUrl/$locale/lipscore-v1.js\";
                document.getElementsByTagName('head')[0].appendChild(scr);
            })();
            //]]>
            </script>
        ";
    }
}

endif;
