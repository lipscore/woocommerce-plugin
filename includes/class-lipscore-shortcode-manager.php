<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Lipscore_Shortcode_Manager' ) ) :

class Lipscore_Shortcode_Manager {
    private static $instance = null;
    private $widget_manager;

    public function __construct() {
        $this->widget_manager = new Lipscore_Widget_Manager();
    }

    public static function get_instance() {
        if ( self::$instance == null ) {
            self::$instance = new Lipscore_Shortcode_Manager();
        }

        return self::$instance;
    }

    public function register_shortcodes() {
        add_shortcode( 'lipscore-small-rating', [ $this, 'render_small_rating_widget' ] );
        add_shortcode( 'lipscore-rating', [ $this, 'render_rating_widget' ] );
        add_shortcode( 'lipscore-reviews', [ $this, 'render_reviews_widget' ] );
        add_shortcode( 'lipscore-questions', [ $this, 'render_questions_widget' ] );
    }

    public function render_small_rating_widget() {
        ob_start();
        
        $this->widget_manager->add_small_rating();

        return ob_get_clean();
    }

    public function render_rating_widget() {
        ob_start();

        $this->widget_manager->add_rating();

        return ob_get_clean();
    }

    public function render_reviews_widget() {
        ob_start();
        
        $this->widget_manager->render_widget( 'reviews_widget' );

        return ob_get_clean();
    }

    public function render_questions_widget() {
        ob_start();
        
        $this->widget_manager->render_widget( 'questions_widget' );

        return ob_get_clean();
    }
}

endif;
