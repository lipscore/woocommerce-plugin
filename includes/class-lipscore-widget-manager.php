<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Lipscore_Widget_Manager' ) ) :

class Lipscore_Widget_Manager {
    public function add_small_rating() {
        echo "<div class=\"lipscore-wc-loop-rating\">";
        $this->render_widget( 'rating_widget', array( 'rating_type' => 'class="lipscore-rating-small"' ) );
        echo "</div>";
    }

    public function add_rating() {
        echo "<div class=\"woocommerce-product-rating\">";
        $this->render_widget( 'rating_widget', array( 'rating_type' => 'id="lipscore-rating"' ) );
        echo "</div>";
    }

    public function add_reviews_tab( $tabs = array() ) {
        add_filter(
            'woocommerce_product_lipscorereviews_tab_title',
            array( $this, 'add_html_to_reviews_tab_title' ),
            1000
        );

        $tabs['lipscorereviews'] = array(
            'title'    => __( 'Reviews', 'woocommerce' ),
            'priority' => 30,
            'callback' => array( $this, 'reviews_tab_content' )
        );
        return $tabs;
    }

    public function add_styles() {
        if ( Lipscore::is_woocommerce() ) {
            wp_enqueue_style( 'lipscore-styles', Lipscore::assets_url( 'css/widget.css' ), array(), Lipscore::VERSION );
        }
    }

    public function add_scripts() {
        if ( Lipscore::is_woocommerce() ) {
            wp_enqueue_script(
                'lipscore-js', Lipscore::assets_url( 'js/widget.js' ), array( 'jquery' ), Lipscore::VERSION, true
            );
        }
    }

    public function reviews_tab_content() {
        $this->render_widget( 'reviews_widget' );
    }

    public function add_html_to_reviews_tab_title( $title ) {
        $review_count_html = '<span id="js-lipscore-reviews-tab-count" style="display: none;">&nbsp;(<span class="lipscore-review-count"></span>)</span>';
        $title = '<span id="js-lipscore-reviews-tab">' . $title . '</span>';
        return $title . $review_count_html;
    }

    protected function render_widget( $file, $args = array() ) {
        $template = new Lipscore_Template($file, $args);
        $template->render();
    }
}

endif;
