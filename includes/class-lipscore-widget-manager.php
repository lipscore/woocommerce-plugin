<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Lipscore_Widget_Manager' ) ) :

class Lipscore_Widget_Manager {
    public function add_small_rating() {
        $this->render_widget( 'rating_widget', array( 'rating_type' => 'class="lipscore-rating-small"' ) );
    }

    public function add_rating() {
        echo "<div class=\"woocommerce-product-rating\">";
        $this->render_widget( 'rating_widget', array( 'rating_type' => 'id="lipscore-rating"' ) );
        echo "</div>";
    }

    protected function render_widget( $file, $args = array() ) {
        $template = new Lipscore_Template($file, $args);
        $template->render();
    }
}

endif;
